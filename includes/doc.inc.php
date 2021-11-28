<?php
require 'dbh.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


    $sql_appointments = "SELECT * FROM tbl_appointments WHERE appointment_id ORDER BY appointment_id ASC;";
    $result_appointments = mysqli_query($conn, $sql_appointments);

    

if (isset($_POST["accept"])){
        if (isset($_SESSION["cart"])){
            $name = $_POST['hidden_name'];
            $lname = $_POST['hidden_lname'];
            $description = $_POST['hidden_description'];
            $schedule = $_POST['hidden_schedule'];
            $email_address = $_POST['hidden_email'];
            $address = $_POST['hidden_address'];
            $contact_number = $_POST['hidden_number'];

            $appointment_id = $_GET['id'];
            $item_array_id = array_column($_SESSION["cart"],"appointment_id");


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
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Appointment for Visiting/Consultations at Saint James Hospital';
                $mail->Body    = 'Good Day! '.$name.' '.$lname.' Your appointment scheduled at '.$schedule.' has been accepted and you can visit our facility at the said date.<br/><br/>Visit Information<br/>Name: '.$name.'<br/>Contact Number: '.$contact_number.'<br/>Address: '.$address.'<br/>Description: '.$description.'<br/>Appointment Date: '.$schedule;
                $mail->AltBody = 'TEST BODYALT';
        
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            if (!in_array($_GET["id"], $item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'appointment_id' => $_GET["id"],
                    'client_name' => $_POST["hidden_name"],
                    'client_schedule' => $_POST["hidden_schedule"],
                    'client_description' => $_POST["hidden_description"],
                    
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="doctorsAccepted.admin.php"</script>';
            }

            else{
                echo '<script>alert("Appointment Has been Added to your Schedule")</script>';
                echo '<script>window.location="doctorsAccepted.admin.php"</script>';
            }
        }

        else{
            $item_array = array(
                'appointment_id' => $_GET["id"],
                'client_name' => $_POST["hidden_name"],
                'client_schedule' => $_POST["hidden_schedule"],
                'client_description' => $_POST["hidden_description"],
            );
            $_SESSION["cart"][0] = $item_array;
        }

        //SQL query for inserting data to DB
        $sql2 ="INSERT INTO tbl_accepted_appointments (appointment_id, client_username, client_schedule) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql2)){
        header("Location: ./doctors.admin.php?error=sqlerror");
            exit();
        }

        else{
            //inserts data to DB
                
                mysqli_stmt_bind_param($stmt, "sss", $appointment_id, $name, $schedule);
                mysqli_stmt_execute($stmt);//execute the sql statement
                header("Location: ./doctorsAccepted.admin.php?schedule=success");
                exit(); 
            }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
 
    if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION["cart"] as $keys => $values){
                if($values["appointment_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("APPOINTMENT HAS BEEN REMOVED!")</script>';
                    echo '<script>window.location="doctorsAccepted.admin.php"</script>';
                }
            }
        }
    }