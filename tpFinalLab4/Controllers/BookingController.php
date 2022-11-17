<?php
namespace Controllers;

use DAO\BD\KeeperDAOBD as KeeperDAOBD;
use DAO\BD\PetDAOBD as PetDAOBD;
use DAO\BD\BookingDAOBD as BookingDAOBD;
use DAO\BD\CalendarDAOBD;
use DAO\BD\EmailDAOBD;
use Models\Booking as Booking;
use \DateTime;
use Exception;
use Models\Owner;
use Services\SessionsHelper;
use SessionHandler;

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

    //Función que levanta al View con la previsualización de la reserva, y envía datos a Controladora Booking en caso de confirmar.
    public function ShowOwnerConfirmationView($startDate, $endDate, $petid,$keeperid)
    {
        SessionsHelper::validateSession();
        $owner = new Owner();
        $owner = SessionsHelper::getOwnerSession();
        try{
            $pet=$this->petList->GetPetByPetId($petid);    
            $keeper=$this->keeperList->GetKeeperByKeeperId($keeperid);
            require_once(VIEWS_PATH."booking-confirmation-owner.php"); //View con previsualizacion de la reserva y envia startDate, endDate, keeperid, petid a Booking/Add
        }catch(Exception $ex){
            $this->ShowModalConfirmationView($ex->getMessage());
        }
    
    }

    private function ShowModalConfirmationView($message = "")
    {
        require_once(VIEWS_PATH . "/modal/modal-booking-confirmation.php");
    } 

    //Función que crea el objeto booking y lo envía al BookingDAO para que se persita. 
    public function Add($petid,$startDate, $endDate, $keeperid) 
    {
        $message = "";
        $flag = false;
        SessionsHelper::validateSessionOwner();

        try{
        $pet=$this->petList->GetPetByPetId($petid);   //Busco el objeto pet para agregarlo en $booking.

        $keeper=$this->keeperList->GetKeeperByKeeperId($keeperid);  //Busco objeto Keeper para agregarlo en $booking.

        $datetime1 = new DateTime($startDate);
        $datetime2 = new DateTime($endDate);
        $difference = $datetime1->diff($datetime2);
          

        $totalPrice=$keeper->getFee()*($difference->d+1);   //to calculate the total price: fee x nr of booked day
                                                        
        $booking= new Booking();
        $booking->setBookingDate(date('Y-m-d'));
        $booking->setStartDate($startDate);
        $booking->setEndDate($endDate);
        $booking->setKeeper($keeper);
        $booking->setPet($pet);
        $booking->setTotalPrice($totalPrice);
        $booking->setPaidAmount(0);
        $booking->setStatus('Pending');
        
        $this->bookingDAO->Add($booking);

        $message = "Booking Create with success ";
        $flag = true;
        }catch(Exception $ex){
            $message = $ex->getMessage();
        }finally{
            $this->ShowModalBookingAddView($message,$flag);
        }   
      //Una vez que confirmó y se agrega, redirecciono a la vista de reservas del owner para que la vea. 
    }

    private function ShowModalBookingAddView($message = "",$flag="")
    {
        require_once(VIEWS_PATH . "/modal/modal-booking-add.php");
    } 

    //Función que muestra el listado de reservas solicitadas por el owner loggeado. 
    public function ShowListOwnerView()    
    {
        SessionsHelper::validateSessionOwner();

        $bookingList=array();
        $owner=SessionsHelper::getOwnerSession();
        $bookingList=$this->bookingDAO->GetBookingsByOwnerId($owner->getOwnerId());  

        /*foreach($bookingListAll as $booking)
        {
            if($booking->getPet()->getOwner() == $owner)
            {
                array_push($bookingList,$booking);
            }
        } Es redundante*/
        require_once(VIEWS_PATH."list-owner-bookings.php");
    }

    //Función que muestra el listado de solicitudes de reservas que recibió el Keeper loggeado. 
    public function ShowListKeeperView()
    {
        SessionsHelper::validateSessionKeeper();
        $bookingList=array();
        $keeper=SessionsHelper::getKeeperSession();
    
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
        SessionsHelper::validateSession();

        $booking=$this->bookingDAO->GetBookingBybookingNr($bookingNr);
        require_once(VIEWS_PATH."booking-confirmation-keeper.php");
    }    

    //Función que se ejecuta cuando el Keeper acepta el request de reserva. 
    public function Accept($bookingNr)
    {
        SessionsHelper::validateSession();
        $this->bookingDAO->AcceptBooking($bookingNr); //Updates IsConfirmed = 'Yes' in booking table. 

        $booking=$this->bookingDAO->GetBookingBybookingNr($bookingNr);
        $keeperid=$booking->getKeeper()->getKeeperId();
        $calendarList=new CalendarDAOBD();
        $calendarList->SetDatesUnavailable($keeperid,$booking->getStartDate(),$booking->getEndDate());       //Sets dates unavailable in calendar table. 
        
        require_once(VIEWS_PATH."invoice-view.php");

    }

    //Funcion para cancelar una reserva solicitada
    public function Cancel($bookingNr)
    {
        SessionsHelper::validateSession();
        $this->bookingDAO->CancelBooking($bookingNr);
        $bookingList=$this->bookingDAO->GetAll();
        require_once(VIEWS_PATH."list-keeper-bookings.php");
    }

}
?>