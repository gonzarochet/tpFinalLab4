<?php
namespace Controllers;

use DAO\BD\KeeperDAOBD as KeeperDAOBD;
use DAO\BD\PetDAOBD as PetDAOBD;
use DAO\BD\BookingDAOBD as BookingDAOBD;
use Models\Booking as Booking;

class BookingController
{
    private $bookingDAO;

    public function __construct(){
        $this->bookingDAO = new BookingDAOBD();
    }


    public function ShowConfirmationView($startDate, $endDate, $keeperid)
    {
        $owner=$_SESSION["loggedOwner"];

        $petList=new PetDAOBD();
        $petList=$petList->GetPetsByOwnerId($owner->getOwnerId());        

        require_once(VIEWS_PATH."booking-confirmation.php");
    }

    public function Add($petid,$startDate, $endDate, $keeperid) //petid
    {
        
        $petList=new PetDAOBD();
        $pet=$petList->GetPetByPetId($petid);

        $keeperList=new KeeperDAOBD();
        $keeper=$keeperList->GetKeeperByKeeperId($keeperid);

        $booking= new Booking();
        $booking->setStartDate($startDate);
        $booking->setEndDate($endDate);
        $booking->setKeeper($keeper);
        $booking->setPet($pet);
        $booking->setIsConfirmed(0);

        
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
        require_once(VIEWS_PATH."list-bookings.php");
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