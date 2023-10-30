<?php

$conn = mysqli_connect("localhost","root","","stock") or die("connection failed");

$sql = "SELECT * FROM issue ORDER BY ReferenceNo DESC ";

$result = mysqli_query($conn , $sql ) or die("SQL Query Failed");
$output = "";

if(mysqli_num_rows($result)>0)
{
    $output = '<table>
    <tr>
    <th>Ref.No</th>
    <th>Product</th>
    <th>Amount</th>
    <th>Requisitioner</th>
    <th>Received By</th>
    <th>Issued By</th>
    <th>Date</th>

    
    </tr>';

while($row = mysqli_fetch_assoc($result)){

    if($row["Department"]=="")
    {
    $output .= "<tr>
    <td>{$row["ReferenceNo"]}</td>
    <td>{$row["Code"]}<br>{$row["ProductName"]}</td>
    <td>{$row["NoOfItems"]}</td>
    <td>{$row["Requisitioner"]}<br>{$row["Designation"]}<br>Unit: {$row["Unit"]}</td>
    <td>{$row["ReceivedBy"]}</td>
    <td>{$row["IssuedBy"]}</td>
    <td>{$row["Date"]}</td>
    
    </tr>";
    }else
    {
        $output .= "<tr>
        <td>{$row["ReferenceNo"]}</td>
        <td>{$row["Code"]}<br>{$row["ProductName"]}</td>
        <td>{$row["NoOfItems"]}</td>
        <td>{$row["Requisitioner"]}<br>{$row["Designation"]}<br>{$row["Department"]}<br>Unit: {$row["Unit"]}</td>
        <td>{$row["ReceivedBy"]}</td>
        <td>{$row["IssuedBy"]}</td>
        <td>{$row["Date"]}</td>
        
        </tr>";
    }
}

$output .= "</table>";

mysqli_close($conn);

echo ($output);


}
?>