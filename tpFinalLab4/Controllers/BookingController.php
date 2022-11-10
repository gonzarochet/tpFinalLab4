<?php
namespace Controllers;

use DAO\BD\KeeperDAOBD as KeeperDAOBD;
use DAO\BD\PetDAOBD as PetDAOBD;
use DAO\BD\BookingDAOBD as BookingDAOBD;
use DAO\BD\CalendarDAOBD;
use DAO\BD\EmailDAOBD;
use Models\Booking as Booking;
use \DateTime;

class BookingController
{
    private $bookingDAO;
    private $petList;
    private $keeperList;
    private $emailList;

    public function __construct(){
        $this->bookingDAO = new BookingDAOBD();
        $this->petList=new PetDAOBD();        
        $this->keeperList=new KeeperDAOBD();
        $this->emailDAO=new EmailDAOBD;
    }

    //Función que levanta al View con la previsualización de la resera, y envía datos a Controladora Booking en caso de confirmar.
    public function ShowOwnerConfirmationView($startDate, $endDate, $petid,$keeperid)
    {
        $owner=$_SESSION["loggedOwner"];

        
        $pet=$this->petList->GetPetByPetId($petid);    

        require_once(VIEWS_PATH."booking-confirmation-owner.php"); //View con previsualizacion de la reserva y envia startDate, endDate, keeperid, petid a Booking/Add
    }

    //Función que crea el objeto booking y lo envía al BookingDAO para que se persita. 
    public function Add($petid,$startDate, $endDate, $keeperid) 
    {

        $pet=$this->petList->GetPetByPetId($petid);   //Busco el objeto pet para agregarlo en $booking.

        $keeper=$this->keeperList->GetKeeperByKeeperId($keeperid);  //Busco objeto Keeper para agregarlo en $booking.

        $datetime1 = new DateTime($startDate);
        $datetime2 = new DateTime($endDate);
        $difference = $datetime1->diff($datetime2);
    
        var_dump($difference->d);       

        $totalPrice=$keeper->getFee()*($difference->d+1);   //to calculate the total price: fee x nr of booked day
                                                        
        $booking= new Booking();
        $booking->setBookingDate(date('Y-m-d'));
        $booking->setStartDate($startDate);
        $booking->setEndDate($endDate);
        $booking->setKeeper($keeper);
        $booking->setPet($pet);
        $booking->setTotalPrice($totalPrice);
        $booking->setPaidAmount(0);
        $booking->setIsAccepted('No');
        
        $this->bookingDAO->Add($booking);

        $this->ShowListOwnerView();      //Una vez que confirmó y se agrega, redirecciono a la vista de reservas del owner para que la vea. 
    }

    //Función que muestra el listado de reservas solicitadas por el owner loggeado. 
    public function ShowListOwnerView()    
    {
        $bookingList=array();
        $owner=$_SESSION["loggedOwner"];
    
        $bookingListAll=$this->bookingDAO->GetBookingByOwner($owner->getOwnerId());

        foreach($bookingListAll as $booking)
        {
            if($booking->getPet()->getOwner() == $owner)
            {
                array_push($bookingList,$booking);
            }
        }
        require_once(VIEWS_PATH."list-owner-bookings.php");
    }

    //Función que muestra el listado de solicitudes de reservas que recibió el Keeper loggeado. 
    public function ShowListKeeperView()
    {
        $bookingList=array();
        $keeper=$_SESSION["loggedKeeper"];
    
        $bookingListAll=$this->bookingDAO->GetAll();

        foreach($bookingListAll as $booking)
        {
            if($booking->getKeeper() == $keeper)
            {
                array_push($bookingList,$booking);
            }
        }
        require_once(VIEWS_PATH."list-keeper-bookings.php");    //View que Muestra los datos generales de reserva, y permite hacer PREVIEW para ver datos completos de la mascota. 
    }                                                           //Cuando hago PREVIEW, mando bookingId a Booking/ShowKeeperConfirmationView

    /*Función que muestra previsualización completa de la  reserva (con los datos de la mascota). Permite aceptar la reserva por parte del keeper. 
    Si Keeper Acepta, manda datos a Booking/Confirmation*/
    public function ShowKeeperConfirmationView($bookingNr)
    {
        $booking=$this->bookingDAO->GetBookingBybookingNr($bookingNr);

        require_once(VIEWS_PATH."booking-confirmation-keeper.php");
    }    

    //Función que se ejecuta cuando el Keeper acepta el request de reserva. 
    public function Confirmation($bookingNr)
    {
        $this->bookingDAO->ConfirmBooking($bookingNr); //Updates IsConfirmed = 'Yes' in booking table. 

        $booking=$this->bookingDAO->GetBookingBybookingNr($bookingNr);
        $keeperid=$booking->getKeeper()->getKeeperId();
        $calendarList=new CalendarDAOBD();
        $calendarList->SetDatesUnavailable($keeperid,$booking->getStartDate(),$booking->getEndDate());       //Sets dates unavailable in calendar table. 
        
        require_once(VIEWS_PATH."invoice-view.php");


    }
}

?>