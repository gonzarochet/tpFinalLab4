<?php
namespace Models;

use Models\Keeper as Keeper;
use Models\Pet as Pet;

class Booking
{
    private $bookingNr;
    private $bookingDate;
    private $startDate;
    private $endDate;
    private $pet;
    private $keeper;
    private $fee;
    private $paidAmount;
    private $isAccepted;

    public function getBookingNumber(){
        return $this->bookingNr;
    }
    public function setBookingNumber($bookingNr)
    {
        $this->bookingNr=$bookingNr;
    }
    public function getBookingDate()
    {
        return $this->bookingDate;
    }
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate=$bookingDate;
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
    public function getPet()
    {
        return $this->pet;
    }
    public function setPet(Pet $pet)
    {
        $this->pet=$pet;
    }
    public function getKeeper()
    {
        return $this->keeper;
    }
    public function setKeeper(Keeper $keeper)
    {
        $this->keeper=$keeper;
    }   
    public function getIsAccepted()
    {
        return $this->isAccepted;
    }
    public function setIsAccepted($isAccepted)
    {
        $this->isAccepted=$isAccepted;
    }
    public function getFee()
    {
        return $this->fee;
    }
    public function setFee($fee)
    {
        $this->fee=$fee;
    }
    public function getPaidAmount()
    {
        return $this->paidAmount;
    }
    public function setPaidAmount($paidAmount)
    {
        $this->paidAmount=$paidAmount;
    }

}
?>