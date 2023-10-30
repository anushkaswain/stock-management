<?php
session_start();

if (!isset($_SESSION["EMPLOYE"])) {

    header("Location: http://localhost/stock/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    
    <title>JAGANNATH AREA STOCK</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;

        }

        header {
            position: fixed;
            top: 0;
            left: 0;  
            width: 100%;
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: left;
            padding-left: 17px;
            font-size: larger;
            font-family: Arial, Helvetica, sans-serif;
            
        }
        header li {
            float:left;
        }
        nav {
            position: fixed;
            top: 73px;
            height:50px;
            left: 0;
            width: 100%;
            display: block;
            
            background-color: #333;
            font-size: larger;
            font-family: Arial, Helvetica, sans-serif;
        }

        header ul,
        nav ul,
        aside ul {
            list-style: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        nav li {
            float: left;
        }

        header a,
        nav a,
        aside a,
        aside ul li h2 {
            display: block;
            color: white;
            text-align:left;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover,
        aside a:hover {
            background-color: #111;
        }

        #logout:hover {
            background-color: red;

        }
        #acquire:hover{
            background-color:blue;
        }
        #report:hover{
            background-color:orange;
        }

        aside {
            position: fixed;
            top: 123px;
            bottom: 0;
            left: 0;
            display: block;
            width: 25%;
            overflow: auto;
            background-color: #333;
            font-size: larger;
            font-family: Arial, Helvetica, sans-serif;
        }

        .content {

            margin-top: 140px;
            margin-left: 25%;
            font-size: large;
        }

        h1 {

            color: blue;
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;


        }

        div h1 {
            color: blue;
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
        }

        form {

            /* display: block; */
            border-style: solid;
            border-width: 2px;
            border-color: gre;
            font-family: Arial, Helvetica, sans-serif;
            margin-left:25%;
            margin-right:25%;
            padding: 10px;
            background-color:white;
            border-radius: 25px;
            

        }


        form p {


            /* background-color: yellow; */
            margin: 12px;
            padding: 10px;
            color: red;
            font-weight: bold;


        }


        input[type=number],
        input[type=text],
        input[type=password] {

            border: none;
            font-size: large;
            border-bottom: 2px solid black;
            width: 100%;
            padding-top: 8px;

        }

        input[type=number]:focus,
        input[type=text]:focus,
        input[type=password]:focus {

            outline: none;
        }

        .Table {

            width: 50%;

            margin: auto;
            margin-top: 160px;

        }

        .Home_Table {

            width: 90%;

            margin: auto;
            margin-top: 160px;
            font-size:0.95em;

        }

        table {
            /* border-collapse: collapse; */
            border:2px solid;
            border-radius:5px;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
        }
        td:nth-child(2) { text-align: left }
        td:nth-child(4) { text-align: left }
        td:nth-child(5) { text-align: left }
        td:nth-child(3) { font-size:1.3em;
        font-weight:bold }
        td:nth-child(1) { font-size:1.3em;
        font-weight:bold }
        th{
            height:50px;
            border-radius:5px;
            font-size: 1.0em;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #2F4F4F;
            color: white;
        }

        #save-button {
            background-color: green;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.5s ease;
        }

        #save-button:hover {
            background-color: darkgreen;
        }
        hr {


width: 70%;

margin-top: 10px;
margin-bottom: 10px;
border: 3px solid red;
border-radius: 4px;


}
button {
  background-color: #008CBA;
  color: white;
  border:none;
  border-radius:5px;
  padding: 8px 16px;
  font-weight:bold;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 15px 0;
  transition-duration: 0.4s;
  cursor: pointer;
}
button:hover {
  background-color: blue;
  color: white;
}
    </style>
</head>

<body>

    <header>
    <ul>
        <li><h2><?php echo $_SESSION["EMPLOYE"]." :: " .$_SESSION["EMPLOYE_NAME"] ?></h2></li>
        
        <li style="float: right; background-color:crimson; margin-right:10px "><a href="logout.php" id="logout">LOGOUT</a></li>
        <li style="float: right; background-color:darkblue; margin-right:10px "><a href="acquire.php" id="acquire">RECEIPT</a></li>
        <li style="float: right; background-color:darkorange; margin-right:10px "><a href="report.php" id="report">REPORT</a></li>
</ul>
    </header>
    <nav>
        <ul>
            <li><a href="dashboard.php" id="H">Home</a></li>
            <li><a href="PrinterHome.php" id="P">Printer Consumable</a></li>
            <li><a href="NetworkHome.php" id="N">Network Items</a></li>
            <li><a href="StationaryHome.php" id="S">Stationary/Consumables</a></li>
            <li><a href="HardwareHome.php" id="C">Hardware/Capital</a></li>

            <!-- <li style="float: right; background-color:crimson; margin-right:10px "><a href="logout.php" id="logout">LOGOUT</a></li>
            <li style="float: right; background-color:darkblue; margin-right:10px "><a href="acquire.php" id="acquire">RECEIPT</a></li>
            <li style="float: right; background-color:darkorange; margin-right:10px "><a href="report.php" id="report">REPORT</a></li> -->
        </ul>
    </nav>