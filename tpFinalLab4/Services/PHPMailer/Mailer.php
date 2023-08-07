<?php

namespace Services\PHPMailer;

use Services\PHPMailer\PHPMailer as PHPMailer;
use Services\PHPMailer\Exception as Exception;

class Mailer
{

    //Function that sends the email 
    public static function SendEmail($emailRecipient, $body,$pdfPath)
    {

        try {
            $mail = new PHPMailer(true);

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
            $mail->addAttachment($pdfPath);

            $message='Sent';
            if(!$mail->send()) {
                $message=$mail->ErrorInfo;
            } 

            return $message;

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
}
?>