<?php 
namespace DAO\BD;

use Models\Invoice as Invoice;
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
}
?>