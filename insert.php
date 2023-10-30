<?php

$conn = mysqli_connect("localhost", "root", "", "stock") or die("connection failed");

$C = $_POST["NoOfItems"];
$D = $_POST["person_name"];
$E = $_POST["designation"];
$F = $_POST["department"];
$G = $_POST["Unit"];
$I =  $_POST["Issued_By"];
$A = $_POST["Product_Code"];

$H = $_POST["received_by"];
$B = $_POST["ItemName"];
$J = date('Y-m-d');

$sql = "INSERT INTO issue values(NULL,'$A','$B','$C','$D','$E','$F','$G','$H','$I','$J');";
$sql .= "UPDATE products
SET Available = Available - $C
WHERE ProductId= '$A' "; 

if($conn->multi_query($sql))
{
    echo 1;
}
else
{
    echo 0;
}

// echo $NoOfItems."\n". $person_name."\n".$designation."\n".$department."\n".$Unit."\n".$Issued_By."\n".$received_by."\n".$ItemName."\n".$Date."\n".$Product_Code;
// ALTER TABLE Persons AUTO_INCREMENT=100;
?>
