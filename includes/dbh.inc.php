<?php
//database conncetion
$database_name = "appointments_db";
$conn = mysqli_connect("localhost", "root", "", $database_name);
session_start();
if (mysqli_connect_errno())
  {
  die("Connection Failed: ".mysqli_connect_error());
  }