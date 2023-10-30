<?php

$conn = mysqli_connect("localhost", "root", "", "stock") or die("connection failed");

$ProductCode = $_POST["ProductCode"];
$Name = $_POST["Name"];
$Available = $_POST["Available"];
$Prefix = $_POST["Prefix"];
$UnitType = $_POST["UnitType"];
$LPR = $_POST["LPR"];
$lpr = floatval($LPR);
$J = date('Y-m-d');

$ProductId = $Prefix.$ProductCode;


$sql = "INSERT INTO products(ProductId,ProductName,Available,LastPrice,UnitName,LastPriceDate) values ('{$ProductId}','{$Name}','{$Available}','{$lpr}','{$UnitType}','{$J}')";

if(mysqli_query($conn,$sql)){
    echo 1;
    mysqli_close($conn);
}
else{
    echo 0;
    mysqli_close($conn);
}



?>