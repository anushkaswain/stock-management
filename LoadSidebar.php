<?php

$conn = mysqli_connect("localhost","root","","stock") or die("connection failed");
$Prefix = $_POST["Prefix"];
$link = $_POST["link"];
$sql = "SELECT ProductName , ProductId FROM products where ProductId LIKE '$Prefix%' ORDER BY ProductName ";

$result = mysqli_query($conn , $sql ) or die("SQL Query Failed");


if(mysqli_num_rows($result)>0)
{
    echo "<ul>";

while($row = mysqli_fetch_assoc($result)){

    echo "<li><a href=\"$link?product_name={$row["ProductName"]}&product_code={$row["ProductId"]}\">{$row["ProductName"]}</a></li>";
}



mysqli_close($conn);

echo "</ul>";


}
?>
