<?php


$conn = mysqli_connect("localhost","root","","stock") or die("connection failed");
$EditId = $_POST["EditId"];
$sql = "SELECT * FROM  issue WHERE ReferenceNo = '$EditId' ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr = array(
            "N"=>$row["NoOfItems"],
            "C"=>$row["Code"],
            "R"=>$row["Requisitioner"],
            "Desg"=>$row["Designation"],
            "P"=>$row["Department"],
            "RB"=>$row["ReceivedBy"],
            "U"=>$row["Unit"]
            
           );

           echo json_encode($arr);
    }
} else {
    echo "0 results";
}


mysqli_close($conn);



?>

