<?php

$conn = mysqli_connect("localhost", "root", "", "stock") or die("connection failed");

$G = $_POST["LPRx"];
$I = $_POST["EditId"];
$J = date('Y-m-d');
$sql = "UPDATE products SET LastPrice = '{$G}',LastPriceDate = '{$J}' WHERE ProductId = '{$I}' ";

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