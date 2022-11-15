<?php
namespace DAO\BD;

use Models\Payment as Payment;
use Models\Invoice as Invoice;
use Models\Booking as Booking;
use \Exception as Exception;
use DAO\BD\Connection as Connection; 
use DAO\BD\IPaymentDAOBD as IPaymentDAOBD;

class PaymentDAOBD implements IPaymentDAOBD
{
    private $connection;
    private $tableName="payment";

    public function Add($payment)
    {
        try {
            $query="INSERT INTO ".$this->tableName." ( paymentDate, invoiceid, amount, paymentImage ) VALUES ( :paymentDate, :invoiceid, :amount, :paymentImage);";

            $parameters["paymentDate"]=$payment->getPaymentDate();
            $parameters["invoiceid"]=$payment->getInvoice()->getInvoiceId();
            $parameters["amount"]=$payment->getAmount();
            $parameters["paymentImage"]=$payment->getPaymentImage();

            $this->connection=Connection::GetInstance();
            $this->connection->Execute($query,$parameters);

        } catch (Exception $ex) {
            throw $ex;
        }
    }
   
    public function GetAll()
    {
        try{
            $paymentList=array();
            $query = "CALL GetAllPayments();";
            //$query="SELECT * FROM ".$this->tableName." P INNER JOIN INVOICE I ON P.INVOICEID=I.INVOICEID;";

            $this->connection=Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row)
            {
                $booking=new Booking();
                $booking->setBookingNumber($row["bookingNr"]);
                $booking->setBookingDate($row["bookingDate"]);
                //$booking->setKeeper($keeper);
                //$booking->setPet($pet);
                $booking->setStartDate($row["startDate"]);
                $booking->setEndDate($row["endDate"]);
                $booking->setTotalPrice($row["totalPrice"]);
                $booking->setPaidAmount($row["paidAmount"]);
                $booking->setStatus($row["status"]);
                
                $invoice=new Invoice();
                $invoice->setInvoiceId($row["invoiceid"]);
                $invoice->setInvoiceNr($row["invoiceNr"]);
                $invoice->setDate($row["invoiceDate"]);
                $invoice->setBooking($booking);   
                
                $payment=new Payment();
                $payment->setPaymentId($row["paymentid"]);
                $payment->setPaymentDate($row["paymentDate"]);
                $payment->setInvoice($invoice);
                $payment->setAmount($row["amount"]);
                $payment->setPaymentImage($row["paymentImage"]);

                array_push($paymentList, $payment);
            }

            return $paymentList;

        }catch(Exception $ex)
        {
            throw $ex;
        }
    }



}
?>