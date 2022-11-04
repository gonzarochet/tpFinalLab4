<?php

namespace Services\PHPMailer;

use Services\PHPMailer\PHPMailer as PHPMailer;
use Services\PHPMailer\Exception as Exception;

class Mailer
{

    //Function that sends the email 
    public static function SendEmail($emailRecipient, $body)
    {

        //$bookingDAO = new BookingDAOBD();
        //$booking=$bookingDAO->GetBookingBybookingNr($bookingNr);

        try {
            $mail = new PHPMailer(true);
            // $this->mailDAO = new MailDAOBD();

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


            $mail->setFrom('pethero@gmail.com', 'Pet Hero');
            //$emailRecipient=$email;
            $mail->addAddress($emailRecipient, 'Receiver Name');

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "Pet Hero - Booking accepted";
            $mail->Body = $body;

            $message='Sent';
            if(!$mail->send()) {
                $message=$mail->ErrorInfo;
            } 

            //$this->mailDAO->Add(date('Y-m-d'),$emailRecipient,$this->mail->Body,$booking->getBookingNumber(),$message );

            return $message;
            //require_once(VIEWS_PATH."keeper-dashboard.php");

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
}
?>