<?php
namespace Controllers;

use DAO\BD\KeeperDAOBD as KeeperDAOBD;
use DAO\BD\PetDAOBD as PetDAOBD;
use DAO\BD\BookingDAOBD as BookingDAOBD;
use DAO\BD\CalendarDAOBD;
use Models\Booking as Booking;

class BookingController
{
    private $bookingDAO;

    public function __construct(){
        $this->bookingDAO = new BookingDAOBD();
    }


    public function ShowOwnerConfirmationView($startDate, $endDate, $keeperid)
    {
        $owner=$_SESSION["loggedOwner"];

        $petList=new PetDAOBD();
        $petList=$petList->GetPetsByOwnerId($owner->getOwnerId());        

        require_once(VIEWS_PATH."booking-confirmation-owner.php");
    }

    public function ShowKeeperConfirmationView($bookingNr)
    {

        $booking=$this->bookingDAO->GetBookingBybookingNr($bookingNr);

        require_once(VIEWS_PATH."booking-confirmation-keeper.php");
    }

    

    public function Add($petid,$startDate, $endDate, $keeperid) //petid
    {
        
        $petList=new PetDAOBD();
        $pet=$petList->GetPetByPetId($petid);

        $keeperList=new KeeperDAOBD();
        $keeper=$keeperList->GetKeeperByKeeperId($keeperid);
        
        $fee=0; //$fee=$keeper->getPrice()->getValue();   ver como traer de un objeto tarifa con vigencia?

        $booking= new Booking();
        $booking->setBookingDate(date('Y-m-d'));
        $booking->setStartDate($startDate);
        $booking->setEndDate($endDate);
        $booking->setKeeper($keeper);
        $booking->setPet($pet);
        $booking->setFee($fee);
        $booking->setPaidAmount(0);
        $booking->setIsConfirmed('No');

        
        $this->bookingDAO->Add($booking);

        $this->ShowListOwnerView();

    }

    public function ShowListOwnerView()
    {
        $bookingList=array();
        $owner=$_SESSION["loggedOwner"];
    
        $bookingListAll=$this->bookingDAO->GetAll();

        foreach($bookingListAll as $booking)
        {
            if($booking->getPet()->getOwner() == $owner)
            {
                array_push($bookingList,$booking);
            }
        }
        require_once(VIEWS_PATH."list-owner-bookings.php");
    }

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
        require_once(VIEWS_PATH."list-keeper-bookings.php");
    }

    public function Confirmation($bookingNr)
    {
        $this->bookingDAO->ConfirmBooking($bookingNr); //Sets IsConfirmed = 'Yes' in booking table. 

        $booking=$this->bookingDAO->GetBookingBybookingNr($bookingNr);
        $keeperid=$booking->getKeeper()->getKeeperId();
        $calendarList=new CalendarDAOBD();
        $calendarList->SetDatesUnavailable($keeperid,$booking->getStartDate(),$booking->getEndDate());       //Sets dates unavailable in calendar table. 
        
        $this->ShowListKeeperView();
        
    }

    /*
    public function GetAllByOwner($owner)
    {
        $bookingList=array();

        $bookingListAll=$this->bookingDAO->GetAll();

        foreach($bookingListAll as $booking)
        {
            if($booking->getOwner() == $owner)
            {
                array_push($bookingList,$booking);
            }
        }
        require_once(VIEWS_PATH."list-bookings.php");

    }*/




}


?>