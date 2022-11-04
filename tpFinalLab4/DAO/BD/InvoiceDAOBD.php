<?php 
namespace DAO\BD;

use Models\Invoice as Invoice;
use Models\Booking as Booking;
use \Exception as Exception;
use DAO\BD\Connection as Connection;

class InvoiceDAOBD implements IInvoiceDAOBD
{
    private $connection;
    private $tableName="invoice";

    public function Add($invoice)
    {
        try {
            $query="INSERT INTO ".$this->tableName." (invoiceNr, invoiceDate, bookingNr, value ) VALUES (:invoiceNr, :invoiceDate, :bookingNr, :value);";

            $parameters["invoiceNr"]=$invoice->getInvoiceNr();
            $parameters["invoiceDate"]=$invoice->getInvoiceDate();
            $parameters["bookingNr"]=$invoice->getBooking()->getBookingNumber();
            $parameters["value"]=$invoice->getValue();

            $this->connection=Connection::GetInstance();
            $this->connection->Execute($query,$parameters);

        } catch (Exception $ex) {
            throw $ex;
        }
    }
   
    public function GetAll()
    {
        try{
            $invoiceList=array();
            $query="SELECT * FROM ".$this->tableName." I INNER JOIN BOOKING B ON I.BOOKINGNR=B.BOOKINGNR;";

            $this->connection=Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row)
            {
                $invoice=new Invoice();
                $booking=new Booking();
                $booking->setBookingNumber($row["bookingNr"]);
                $booking->setBookingDate($row["bookingDate"]);
                $booking->setStartDate($row["startDate"]);
                $booking->setEndDate($row["endDate"]); //it's missing the keeper and pet id
                
                $invoice->setInvoiceId($row["invoiceid"]);
                $invoice->setInvoiceNr($row["invoiceNr"]);
                $invoice->setDate($row["invoiceDate"]);
                $invoice->setDate($row["invoiceDate"]);
                $invoice->setBooking($booking);
                $invoice->setValue($row["value"]);

                array_push($invoiceList, $invoice);
            }

            return $invoiceList;

        }catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetNextId()
        {
            try{
                
                $query="SELECT max(invoiceNr) as invoiceNr FROM ".$this->tableName;
    
                $this->connection=Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
    
                $maxBookingNr=0;
                foreach($resultSet as $row)
                {
                    $maxBookingNr=$row["invoiceNr"];
                }
            
                return $maxBookingNr+1;
            
        }catch(Exception $ex)
        {
            throw $ex;
        }
    }
}
?>