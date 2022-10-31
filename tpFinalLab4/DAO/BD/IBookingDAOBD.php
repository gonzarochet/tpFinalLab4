<?php
namespace DAO\BD;
use Models\Booking as Booking;

interface IBookingDAOBD
{
    public function GetAll();
    public function Add(Booking $booking);
    public function GetBookingBybookingNr($bookingNr);
    public function ConfirmBooking($bookingNr);
    
}

?>