<?php
namespace Models;

use Models\Keeper as Keeper;
use Models\Owner as Owner;

class Booking
{
    private $bookingNr;
    private $startDate;
    private $endDate;
    private $owner;
    private $keeper;
    private $isConfirmed;

    public function getBookingNumber(){
        return $this->bookingNr;
    }
    public function setBookingNumber($bookingNr)
    {
        $this->bookingNr=$bookingNr;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }
    public function setStartDate($startDate)
    {
        $this->startDate=$startDate;
    }
    public function getEndDate()
    {
        return $this->endDate;
    }
    public function setEndDate($endDate)
    {
        $this->endDate=$endDate;
    }
    public function getOwner()
    {
        return $this->owner;
    }
    public function setOwner(Owner $owner)
    {
        $this->owner=$owner;
    }
    public function getKeeper()
    {
        return $this->keeper;
    }
    public function setKeeper(Keeper $keeper)
    {
        $this->keeper=$keeper;
    }   
    public function getIsConfirmed()
    {
        return $this->isConfirmed;
    }
    public function setIsConfirmed($isConfirmed)
    {
        $this->isConfirmed=$isConfirmed;
    }

}
?>