<?php

$servername = "localhost";

// In my case, user name will be root
$username = "root";

// Password is empty
$password = "";

//database name 
$DatabaseName = "stock";

// Creating a connection
$conn = new mysqli(
  $servername,
  $username,
  $password,
  $DatabaseName
);

// Check connection
if ($conn->connect_error) {
  die("Connection failure: "
    . $conn->connect_error);
}

session_start();

session_unset();

session_destroy();

header("Location: http://localhost/stock/");
?>