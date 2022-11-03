<?php
namespace Models;

class Invoice
{
    private $invoiceId;
    private $invoiceNr;
    private $invoiceDate;
    private $booking;
    private $value;

    public function getInvoiceId(){
        return $this->invoiceId;
    }
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId=$invoiceId;
    }
    public function getInvoiceNr(){
        return $this->invoiceNr;
    }
    public function setInvoiceNr($invoiceNr)
    {
        $this->invoiceNr=$invoiceNr;
    }
    public function getInvoiceDate(){
        return $this->invoiceDate;
    }
    public function setDate($invoiceDate)
    {
        $this->invoiceDate=$invoiceDate;
    }
    public function getBooking(){
        return $this->booking;
    }
    public function setBooking($booking)
    {
        $this->booking=$booking;
    }
    public function getValue(){
        return $this->value;
    }
    public function setValue($value)
    {
        $this->value=$value;
    }
}

?>