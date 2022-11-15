<?php
namespace Controllers;

use Models\Invoice as Invoice;
use DAO\BD\InvoiceDAOBD as InvoiceDAOBD;
use DAO\BD\BookingDAOBD as BookingDAOBD;
use DAO\BD\CalendarDAOBD as CalendarDAOBD;
use Services\PHPMailer\Mailer as Mailer;
use DAO\BD\EmailDAOBD as EmailDAOBD;


class InvoiceController
{
    private $invoiceDAO;
    private $bookingDAO;
    private $emailDAO;

    public function __construct(){
        $this->invoiceDAO = new InvoiceDAOBD();
        $this->bookingDAO=new BookingDAOBD();
        $this->emailDAO=new EmailDAOBD();
    }

    public function Add($bookingNr)
    {
        $booking=$this->bookingDAO->GetBookingBybookingNr($bookingNr);

        $invoice = new Invoice();
        $invoice->setInvoiceNr ($this->invoiceDAO->getNextInvoiceNr());
        $invoice->setDate(date('Y-m-d'));
        $invoice->setBooking($booking);
        $invoice->setValue($booking->getTotalPrice()/2);

        $this->invoiceDAO->Add($invoice);

        $email=$booking->getPet()->getOwner()->getUser()->getEmail();
        $initialDeposit=$booking->getTotalPrice()/2;

        $body='Booking Accepted. Please, pay the following initial deposit to confirm the booking: $'.$initialDeposit;
        $message=Mailer::SendEmail($email,$body);

        $this->emailDAO->Add(date('Y-m-d'),$email,$body,$bookingNr,$message);

        $bookingList=$this->bookingDAO->GetAll();
        require_once(VIEWS_PATH."list-keeper-bookings.php"); 
    }

    public function ShowListView()
    {
        $invoiceList=$this->invoiceDAO->GetAll();

        require_once(VIEWS_PATH."list-invoices.php");
    }
    
}
?>