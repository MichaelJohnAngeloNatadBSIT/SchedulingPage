<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;





//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if(isset($_POST['set-appointment'])){
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact-number'];
    $email_address = $_POST['email-address'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $appointment_date = $_POST['appointment-date'];
    $prev_client = $_POST['prev-client'];
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'saint.james.noreply@gmail.com';                     //SMTP username
        $mail->Password   = 'James@122334455';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('saint.james.noreply@gmail.com', 'Saint James Hospital');
        $mail->addAddress($email_address, 'Client');     //Add a recipient
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail_body= nl2br('Good Day! '.$first_name.' '.$last_name.' Your appointment scheduled at '.$appointment_date.' has been noted.<br/>Visit Information<br/>Name: '.$first_name.' '.$last_name.'<br/>Contact Number: '.$contact_number.'<br/>Address: '.$address.'<br/>Birthday: '.$birthday.'<br/>Description: '.$description.'<br/>Have attended in our facility: '.$prev_client.'<br/>Appointment Date: '.$appointment_date.'');
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Appointment for Visiting/Consultations at Saint James Hospital';
        $mail->Body    = 'Good Day! '.$first_name.' '.$last_name.' Your appointment scheduled at '.$appointment_date.' has been noted.<br/><br/>Visit Information<br/>Name: '.$first_name.' '.$last_name.'<br/>Contact Number: '.$contact_number.'<br/>Address: '.$address.'<br/>Birthday: '.$birthday.'<br/>Description: '.$description.'<br/>Have attended in our facility: '.$prev_client.'<br/>Appointment Date: '.$appointment_date;
        $mail->AltBody = 'TEST BODYALT';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}