<?php
namespace DAO\BD;

use PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\SMTP as SMTP;

//use DAO\BD\IBookingDAOBD as IBookingDAOBD;
use \Exception as Exception;
use DAO\BD\Connection as Connection;

class MailDAOBD //implements IBookingDAOBD
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