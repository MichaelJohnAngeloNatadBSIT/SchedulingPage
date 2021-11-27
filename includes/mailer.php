<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'dbh.inc.php';


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
        $mail->Body    = 'Good Day! '.$first_name.' '.$last_name.' Your appointment scheduled at '.$appointment_date.' has been noted.<br/><br/>Visit Information<br/>Name: '.$first_name.' '.$last_name.'<br/>Contact Number: '.$contact_number.'<br/>Address: '.$address.'<br/>Description: '.$description.'<br/>Have attended in our facility: '.$prev_client.'<br/>Appointment Date: '.$appointment_date;
        $mail->AltBody = 'TEST BODYALT';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // if(empty($first_name) || empty($last_name) || empty($address) || empty($username) || empty($email_address) || empty($password) || empty($confirm_password)){
    //     header("Location: ../form.php?error=emptyfields&first-name=".$first_name."&last-name=".$last_name."&address=".address."&username=".$username."&email-address=".$email_address);
    //     exit();
    //     }
    //     //checks if invalid both email and usernam
    //     elseif(!filter_var($email_address, FILTER_VALIDATE_EMAIL) && !preg_match("../^[a-zA-Z0-9]*$../", $username)){
    //     header("Location: ../form.php?error=invalidemail&username=".$username);
    //     exit();
    //     }
    //     //checks if valid email
    //     elseif(!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
    //     header("Location: ../form.php?error=invalidemail&username=".$username);
    //     exit();
    //     }
    //     //checks if username must have a-z A-Z-0-9
    //     elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    //     header("Location: ../form.php?error=invalidusername&username=".$username."&email-address=".$email_address);
    //     exit();
    //     }
    //     //checks if password is same
    //     elseif($password !== $confirm_password){
    //     header("Location: ../form.php?error=passwordCheck&first-name=".$first_name."&last-name=".$last_name."&address=".address."&username=".$username."&email-address=".$email_address);
    //     exit();
    //     }

    $sql1 = "SELECT client_fname FROM tbl_appointments WHERE client_fname=?";//query for checking if username is taken
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql1)){
        header("Location: ../form.php?error=sqlerror1");//error for sql error
        exit();
    }

    else{
        //checks if username already taken
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck > 0){
        header("Location: ../form.php?error=usernametaken&email".$email_address);
            exit();
        }


        else{

            $sql2 ="INSERT INTO tbl_appointments (client_fname, client_lname, client_gender, client_number, client_email, client_address, client_description, client_schedule) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";//SQL query of insert in DB
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql2)){
                header("Location: ../form.php?error=sqlerror2");
                exit();
            }
            else{
                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ssssssss", $first_name, $last_name, $gender, $contact_number, $email_address, $address, $description, $appointment_date);//inserts the info to DB
                mysqli_stmt_execute($stmt);
                header("Location: ../form.php?sign-up=success");
                exit();
            }
        }
    }




}