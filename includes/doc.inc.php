<?php
require 'dbh.inc.php';


    $sql_appointments = "SELECT * FROM tbl_appointments WHERE appointment_id ORDER BY appointment_id ASC;";
    $result_appointments = mysqli_query($conn, $sql_appointments);

if (isset($_POST["accept"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"appointment_id");
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
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="doctorsAccepted.admin.php"</script>';
            }
        }

        else{
            $item_array = array(
                'appointment' => $_GET["id"],
                'client_name' => $_POST["hidden_name"],
                'client_schedule' => $_POST["hidden_schedule"],
                'client_description' => $_POST["hidden_description"],
            );
            $_SESSION["cart"][0] = $item_array;
        }

        // //SQL query for inserting data to DB
        // $sql2 ="INSERT INTO tbl_accepted_appointments (client_id, client_username, client_schedule) VALUES (?, ?, ?)";
        // $stmt = mysqli_stmt_init($conn);
        // if(!mysqli_stmt_prepare($stmt, $sql2)){
        // header("Location: ../doctors.admin.php?error=sqlerror");
        //     exit();
        // }

        // else{
        //     //inserts data to DB
        //         if(!empty($_SESSION["cart"])){
        //             $total = 0;
        //             foreach ($_SESSION["cart"] as $key => $values){
        //         mysqli_stmt_bind_param($stmt, "sss", $values["client_id"], $values["client_name"], $values["client_schedule"]);
        //         mysqli_stmt_execute($stmt);//execute the sql statement
        //         header("Location: ../doctors.admin.php?schedule=success");
        //         exit(); 

        //             }
        //         }
        //     }
        // mysqli_stmt_close($stmt);
        // mysqli_close($conn);
    }
 
    if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION["cart"] as $keys => $values){
                if($values["appointment_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("PRODUCT HAS BEEN REMOVED!")</script>';
                    echo '<script>window.location="doctorsAccepted.admin.php"</script>';
                }
            }
        }
    }