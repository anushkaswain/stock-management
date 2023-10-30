<?php

$conn = mysqli_connect("localhost","root","","stock") or die("connection failed");

$limit_per_page = 20;
$page = "";
if(isset($_POST["page_no"])){
    $page = $_POST["page_no"];
}
else
{
    $page = 1;
}

$offset = ($page - 1)*$limit_per_page;
$sql = "SELECT * FROM issue ORDER BY ReferenceNo DESC LIMIT {$offset} ,{$limit_per_page}";

$result = mysqli_query($conn , $sql ) or die("SQL Query Failed");
$output = "";

if(mysqli_num_rows($result)>0)
{
    $output = '<table>
    <tr>
    <th>Reference No</th>
    <th>Product</th>
    <th>Issued Amount</th>
    <th>Requisitioner</th>
    <th>Received By</th>
    <th>Issued By</th>
    <th>Date</th>
    <th>Update</th>

    
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
    <td><button type='button' class='edit-button' data-id='{$row["ReferenceNo"]}'>Edit</button></td>
    
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
        <td><button type='button' class='edit-button' data-id='{$row["ReferenceNo"]}'>Edit</button></td>
        
        </tr>";
    }

}

$output .= "</table>";

$sql2 = "SELECT * FROM issue";
$records = mysqli_query($conn,$sql2) or die("query failed");
$total_record = mysqli_num_rows($records);
$total_pages = ceil($total_record/$limit_per_page);

$output .= '<div id="pagination">';

for($i = 1 ; $i <=$total_pages;$i++){
if($i == $page)
{
    $x = "active";
}
else
{
    $x = "";
}
$output .= "<a class='{$x}' id='{$i}'' href='#'>{$i}</a>";
}
$output .= '</div>';

$output .= ' <button type="button" id="csv"><a href="downloadissue.php" target="_blank" style="color:white;text-decoration: none;">Print Table</a></button>';
$output .= '</div>';
mysqli_close($conn);

echo ($output);


}
else{
    echo("no record found");
    mysqli_close($conn);
}
?>


<!-- 9438877850  -->