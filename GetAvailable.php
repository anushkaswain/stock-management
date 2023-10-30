<?php


$conn = mysqli_connect("localhost","root","","stock") or die("connection failed");
$Product_Id = $_POST["Product_Id"];
$sql = "SELECT * FROM  products WHERE ProductId = '$Product_Id' ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
         $output =  $row["Available"];
    }
} else {
    echo "0 results";
}


mysqli_close($conn);

echo $output;

?>