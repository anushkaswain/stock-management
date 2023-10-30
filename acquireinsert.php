<?php

$conn = mysqli_connect("localhost", "root", "", "stock") or die("connection failed");

$Amount = $_POST["Amount"];
$Code = $_POST["Code"];
$Description = $_POST["Description"];
$Date =  date('Y-m-d');


$sql = "SELECT * FROM products WHERE ProductId='$Code' ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
         $output =  $row["ProductName"];
    }
} else {
    $output = "";
}

if($output == "")
{
    echo "There is no Product With This Code";

}
else{
    $sql2 = "INSERT INTO receipt values(NULL,'$Code','$output','$Amount','$Description','$Date');";
    $sql2 .= "UPDATE products
    SET Available = Available + $Amount
    WHERE ProductId= '$Code' "; 
    
    
    if($conn->multi_query($sql2))
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

}


?>
