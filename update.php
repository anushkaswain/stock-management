<?php

$conn = mysqli_connect("localhost", "root", "", "stock") or die("connection failed");

$C = $_POST["NoOfItems"];
$D = $_POST["person_name"];
$E = $_POST["designation"];
$F = $_POST["department"];
$G = $_POST["Unit"];



$H = $_POST["received_by"];
$I = $_POST["EditId"];
$J = $_POST["OldValue"];
$K = $_POST["code"];

$offset = $C - $J;

$sql = "UPDATE issue SET NoOfItems = '{$C}',Requisitioner = '{$D}',Designation = '{$E}',Department = '{$F}',Unit = '{$G}',ReceivedBy = '{$H}' WHERE ReferenceNo = '{$I}' ;";

$sql .= "UPDATE products
SET Available = Available - $offset
WHERE ProductId= '$K' "; 

if($conn->multi_query($sql))
{
    echo 1;
    mysqli_close($conn);
}
else
{
    echo 0;
    mysqli_close($conn);
}

// echo $NoOfItems."\n". $person_name."\n".$designation."\n".$department."\n".$Unit."\n".$Issued_By."\n".$received_by."\n".$ItemName."\n".$Date."\n".$Product_Code;
// ALTER TABLE Persons AUTO_INCREMENT=100;

?>
