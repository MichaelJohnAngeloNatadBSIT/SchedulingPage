<?php

 if(isset($_POST['set-appointment'])){

    require 'dbh.inc.php';

    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $email_address= $_POST['e-mail-address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    
    //checks if empty fields
    if(empty($first_name) || empty($last_name) || empty($address) || empty($username) || empty($email_address) || empty($password) || empty($confirm_password)){
    header("Location: ../register.php?error=emptyfields&first-name=".$first_name."&last-name=".$last_name."&address=".address."&username=".$username."&email-address=".$email_address);
    exit();
    }
    //checks if invalid both email and usernam
    elseif(!filter_var($email_address, FILTER_VALIDATE_EMAIL) && !preg_match("../^[a-zA-Z0-9]*$../", $username)){
    header("Location: ../register.php?error=invalidemail&username=".$username);
    exit();
    }
    //checks if valid email
    elseif(!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
    header("Location: ../register.php?error=invalidemail&username=".$username);
    exit();
    }
    //checks if username must have a-z A-Z-0-9
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../register.php?error=invalidusername&username=".$username."&email-address=".$email_address);
    exit();
    }
    //checks if password is same
    elseif($password !== $confirm_password){
    header("Location: ../register.php?error=passwordCheck&first-name=".$first_name."&last-name=".$last_name."&address=".address."&username=".$username."&email-address=".$email_address);
    exit();
    }

    else{
        $sql1 = "SELECT customer_username FROM tbl_customer_accounts WHERE customer_username=?";//query for checking if username is taken
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql1)){
            header("Location: ../register.php?error=sqlerror");//error for sql error
            exit();
        }

        else{
            //checks if username already taken
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
            header("Location: ../register.php?error=usernametaken&email".$email_address);
                exit();
            }


            else{

                $sql2 ="INSERT INTO tbl_customer_accounts (customer_lastname, customer_firstname, customer_address, customer_username, customer_password, customer_email) VALUES (?, ?, ?, ?, ?, ?)";//SQL query of insert in DB
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql2)){
                    header("Location: ../register.php?error=sqlerror");
                    exit();
                }
                else{
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ssssss", $last_name, $first_name, $address, $username, $hashedPass, $email_address);//inserts the info to DB
                    mysqli_stmt_execute($stmt);
                    header("Location: ../register.php?sign-up=success");
                    exit();
                }
            }
        }

     }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
