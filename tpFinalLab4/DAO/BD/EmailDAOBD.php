<?php
namespace DAO\BD;


use \Exception as Exception;
use DAO\BD\Connection as Connection;

class EmailDAOBD implements IEmailDAOBD
{
    private $connection;
    private $tableName = "email";


    public function Add($sentDate, $emailRecipient, $body, $bookingNr, $message)
    {
        try 
        {

            $query="INSERT INTO ".$this->tableName." (sentDate,emailRecipient,body,bookingnr,message) VALUES (:sentDate,:emailRecipient,:body,:bookingnr,:message);";
            $parameters["sentDate"]=$sentDate;
            $parameters["emailRecipient"]=$emailRecipient;
            $parameters["body"]=$body;
            $parameters["bookingnr"]=$bookingNr;
            $parameters["message"]=$message;

            $this->connection=Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);

        } catch (Exception $ex) {
            throw $ex;
        }

    }

   
}

    ?>