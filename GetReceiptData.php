<?php

$conn = mysqli_connect("localhost","root","","stock") or die("connection failed");

$sql = "SELECT * FROM receipt ORDER BY Sl DESC ";

$result = mysqli_query($conn , $sql ) or die("SQL Query Failed");
$output = "";

if(mysqli_num_rows($result)>0)
{
    $output = '<table>
    <tr>
    <th>Product</th>
    <th>Amount</th>
    <th>Description</th>
    <th>Date</th>  
    </tr>';

while($row = mysqli_fetch_assoc($result)){

    $output .= "<tr>
    
    <td>{$row["Code"]}<br>{$row["ProductName"]}</td>
    <td>{$row["Amount"]}</td>
    
    <td>{$row["Description"]}</td>
   
    <td>{$row["Date"]}</td>
    
    </tr>";
}

$output .= "</table>";

mysqli_close($conn);

echo ($output);


}
?>