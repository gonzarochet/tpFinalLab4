<?php

namespace Controllers;

use PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\SMTP as SMTP;
use PHPMailer\Exception;
use DAO\BD\MailDAOBD as MailDAOBD;

class Mailer
{
    public $mail;
    private $mailDAO;

    public function __construct(){
        $mail = new PHPMailer(true);
        $this->mailDAO = new MailDAOBD();
        
         // Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('pethero@gmail.com', 'Pet Hero');

        $mail->Username = 'pethero390@gmail.com'; // YOUR gmail email
        $mail->Password = 'ibpniournxoysjsn'; 

        $this->mail=$mail;
    }

    public function sendEmail($booking)
    {
        try{
            $this->mail->setFrom('pethero@gmail.com', 'Pet Hero');
            $emailRecipient=$booking->getPet()->getOwner()->getUser()->getEmail();
            $this->mail->addAddress($emailRecipient, 'Receiver Name');

            $importeSena=$booking->getTotalPrice()/2;


            // Setting the email content
            $this->mail->IsHTML(true);
            $this->mail->Subject = "Pet Hero - Booking accepted";
            $this->mail->Body = 'Reserva aceptada. Para confirmar debe abonar el siguiente importe en concepto de seña:'.$importeSena; //pasar datos de reserva. 

            $message='Sent';
            if(!$this->mail->send()) {
                $message=$this->mail->ErrorInfo;
            } 

            $this->mailDAO->Add('2022-11-01',$emailRecipient,$this->mail->Body,$booking->getBookingNumber(),$message );

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
}
?>