<?php

$conn = mysqli_connect("localhost","root","","stock") or die("connection failed");
$Prefix = $_POST["Prefix"];

$sql = "SELECT * FROM products where ProductId LIKE '$Prefix%' ORDER BY ProductId ";

$result = mysqli_query($conn , $sql ) or die("SQL Query Failed");
$output = "";

if(mysqli_num_rows($result)>0)
{
    $output = '<table>
    <tr>
    <th>Code</th>
    <th>Name</th>
    <th>Available</th>
    <th>Last Rate/Unit</th>
    <th>LM Date</th>
    
    </tr>';

while($row = mysqli_fetch_assoc($result)){

    $output .= "<tr><td>{$row["ProductId"]}</td><td>{$row["ProductName"]}</td><td>{$row["Available"]}</td><td>{$row["LastPrice"]} / {$row["UnitName"]} <img src='edit_logo2.jpg' alt='MCL' data-id='{$row["ProductId"]}' class='edit-button' width='23' /></td><td>{$row["LastPriceDate"]}</td></tr>";
}
$output .= "</table>";

mysqli_close($conn);

echo ($output);


}
