<?php


$conn = mysqli_connect("localhost","root","","stock") or die("connection failed");
$EditId = $_POST["EditId"];
$sql = "SELECT * FROM products WHERE ProductId = '$EditId' ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output =  $row["LastPrice"];
    }
} else {
    $output =  "0 results";
}


mysqli_close($conn);

echo $output

?>