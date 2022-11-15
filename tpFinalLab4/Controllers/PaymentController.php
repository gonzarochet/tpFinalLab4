<?php
namespace Controllers;

use Models\Payment as Payment;
use DAO\BD\PaymentDAOBD as PaymentDAOBD;
use DAO\BD\InvoiceDAOBD as InvoiceDAOBD;
use DAO\BD\BookingDAOBD as BookingDAOBD;

class PaymentController
{
    private $paymentDAO;
    private $invoiceDAO;
    private $bookingDAO;

    public function __construct(){
        $this->paymentDAO = new PaymentDAOBD();
        $this->invoiceDAO = new InvoiceDAOBD();
        $this->bookingDAO = new BookingDAOBD();
    }

    public function ShowAddView($bookingNr)
    {
        $listInvoices = $this->invoiceDAO->getInvoicesByBookingNr($bookingNr);
        require_once(VIEWS_PATH."add-payment.php");
    }

    public function Add($invoiceid, $amount, $paymentDate,$paymentImage)
    {
        $invoice=$this->invoiceDAO->GetInvoiceByInvoiceId($invoiceid);

        $payment = new Payment();
        $payment->setPaymentDate ($paymentDate);
        $payment->setInvoice($invoice);
        $payment->setAmount($amount);
        $payment->setPaymentImage($paymentImage);

        $this->paymentDAO->Add($payment);
        
        $this->ConfirmBooking($invoice->getBooking()->getBookingNumber()); //Cambia estado de reserva a confirmada
    
        //$bookingList=$this->bookingDAO->GetBookingsByOwnerId($invoice->getBooking()->getPet()->getOwner()->getOwnerId());
        //require_once(VIEWS_PATH."list-owner-bookings.php");

        $message="Payment Successfully added";
        $this->ShowListView($invoice->getBooking()->getBookingNumber(),$message);

    }

    public function ShowListView($bookingNr, $message="")
    {
        $paymentListAll=$this->paymentDAO->GetAll();
        $paymentList=array();

        foreach ($paymentListAll as $payment)
        {
            if($payment->getInvoice()->getBooking()->getBookingNumber()== $bookingNr)
            {
                array_push($paymentList,$payment);
            }
        }
        require_once(VIEWS_PATH."list-payments.php");
    }   

    public function ConfirmBooking($bookingNr)
    {
        $this->bookingDAO->ConfirmBooking($bookingNr);
    }
}
?>