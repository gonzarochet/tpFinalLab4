<?php
namespace Controllers;

use Models\Invoice as Invoice;
use DAO\BD\InvoiceDAOBD as InvoiceDAOBD;
use DAO\BD\BookingDAOBD as BookingDAOBD;
use DAO\BD\CalendarDAOBD as CalendarDAOBD;

class InvoiceController
{
    private $invoiceDAO;

    public function __construct(){
        $this->invoiceDAO = new InvoiceDAOBD();
    }

    public function Add($bookingNr)
    {
        $bookingDAO = new BookingDAOBD();
        $booking=$bookingDAO->GetBookingBybookingNr($bookingNr);

        $invoice = new Invoice();
        $invoice->setInvoiceNr (2);
        $invoice->setDate(date('Y-m-d'));
        $invoice->setBooking($booking);
        $invoice->setValue($booking->getTotalPrice()/2);

        $this->invoiceDAO->Add($invoice);

        require_once(VIEWS_PATH."invoice-email-view.php"); //Email /send
    }
}
?>