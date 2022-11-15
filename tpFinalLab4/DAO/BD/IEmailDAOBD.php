<?php namespace DAO\BD;

interface IEmailDAOBD{
    public function Add($sentDate, $emailRecipient, $body, $bookingNr, $message);
}

?>