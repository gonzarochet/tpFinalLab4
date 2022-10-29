<?php
namespace Controllers;

use DAO\BD\KeeperDAOBD;
use DAO\BD\OwnerDAOBD;
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
        $ownerid=$owner->getOwnerId();
        require_once(VIEWS_PATH."booking-confirmation.php");
    }

    public function Add($startDate, $endDate, $keeperid, $ownerid)
    {
        $ownerList=new OwnerDAOBD();
        $owner=$ownerList->GetOwnerByOwnerId($ownerid);

        $keeperList=new KeeperDAOBD();
        $keeper=$keeperList->GetKeeperByKeeperId($keeperid);

        $booking= new Booking();
        $booking->setStartDate($startDate);
        $booking->setEndDate($endDate);
        $booking->setKeeper($keeper);
        $booking->setOwner($owner);

        $this->bookingDAO->Add($booking);

        $this->GetAllByOwner($owner);

    }

    public function ShowOwnerBooking()
    {
        $bookingList=array();
        $owner=$_SESSION["loggedOwner"];

        $bookingList=$this->bookingDAO->GetAll();

        foreach($bookingList as $booking)
        {
            if($booking->getOwner()->getOwnerId() == $owner)
            {
                array_push($bookingList,$booking);
            }
        }
        require_once(VIEWS_PATH."list-bookings.php");
    }

    public function GetAllByOwner($owner)
    {
        $bookingList=array();

        $bookingList=$this->bookingDAO->GetAll();

        foreach($bookingList as $booking)
        {
            if($booking->getOwner() == $owner)
            {
                array_push($bookingList,$booking);
            }
        }
        require_once(VIEWS_PATH."list-bookings.php");

    }




}


?>