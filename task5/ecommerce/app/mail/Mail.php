<?php
namespace app\mail;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Mail {
    private $emailTo,$subject,$body,$mail;
    public function __construct($emailTo,$subject,$body) 
    {
        $this->emailTo = $emailTo;
        $this->body = $body;
        $this->subject = $subject;
        $this->mail = new PHPMailer(true);

        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = 'nti.php15@gmail.com';                     //SMTP username
        $this->mail->Password   = 'Stay@safe25';                               //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $this->mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
    }
    public function verficationCode() :bool
    {
         try {
             //Recipients
             $this->mail->setFrom('eelbarshly@gmail.com','Ecommerce');
             $this->mail->addAddress($this->emailTo);                       //Name is optional
             //Content
             $this->mail->isHTML(true);                                     //Set email format to HTML
             $this->mail->Subject = $this->subject;
             $this->mail->Body    = $this->body;

             $this->mail->send();
            //  echo 'Message has been sent';
             return true;
         } catch (Exception $e) {
            //  echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
             return false;
         }
    }
}



