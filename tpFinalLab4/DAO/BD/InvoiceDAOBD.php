<?php 
namespace DAO\BD;

use Models\Invoice as Invoice;
use Models\Booking as Booking;
use Models\Owner as Owner;
use Models\Pet as Pet;

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
            $query = "CALL GetAllInvoices();";
            //$query="SELECT * FROM ".$this->tableName." I INNER JOIN BOOKING B ON I.BOOKINGNR=B.BOOKINGNR;";

            $this->connection=Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row)
            {
                $owner = new Owner();
                $owner->setOwnerId($row["ownerid"]);

                $pet = new Pet();
                $pet->setIdPet($row["petid"]);
                $pet->setName($row["name"]);
                $pet->setBirthDate($row["birthDate"]);
                $pet->setOwner($owner);
                
                $booking=new Booking();
                $booking->setBookingNumber($row["bookingNr"]);
                $booking->setBookingDate($row["bookingDate"]);
                $booking->setStartDate($row["startDate"]);
                $booking->setEndDate($row["endDate"]);
                $booking->setPet($pet);

                $invoice=new Invoice();
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

    public function GetNextInvoiceNr()
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

    public function GetInvoiceByInvoiceId($invoiceId)
    {
        $invoiceList=$this->GetAll();
            
        foreach ($invoiceList as $invoice)
        {
            if($invoiceId == $invoice->getInvoiceId())
            {
                $invoiceFound=$invoice;
            }
        }
        return $invoiceFound;
    }

    public function getInvoicesByBookingNr($bookingNr)
    {
        $invoiceList=$this->GetAll();
        $invoiceListReturn = array();
            
        foreach ($invoiceList as $invoice)
        {
            if($bookingNr == $invoice->getBooking()->getBookingNumber())
            {
                array_push($invoiceListReturn, $invoice);
            }
        }
        return $invoiceListReturn;


    }
}
?>