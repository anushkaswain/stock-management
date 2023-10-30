<?php
session_start();

if (isset($_SESSION["EMPLOYE"])) {

  header("Location: http://localhost/stock/dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JAGANNATH AREA SYSTEM</title>

  <style>
    img {

      display: block;
      margin-left: auto;
      margin-right: auto;
      border-style: solid;
      border-width: medium;
      border-radius: 20px;
      margin-top: 20px;

    }

    #myheader {

      color: blue;
      font-family: Arial, Helvetica, sans-serif;
      margin-top: 60px;
      margin-bottom: 60PX;
      text-align: center;

    }

    form {

      /* display: block; */
      border-style: solid;
      border-width: 2px;
      font-family: Arial, Helvetica, sans-serif;
      margin-left: 30%;
      margin-right: 30%;
      padding: 20px;

      border-radius: 25px;

    }


    form p {


      /* background-color: yellow; */
      margin: 20px;
      padding: 15px;
      color: green;
      font-weight: bold;
      font-size: large;


    }


    input[type=number],
    input[type=text],
    input[type=password] {

      border: none;
      font-size: large;
      border-bottom: 2px solid black;
      width: 100%;
      padding-top: 10px;

    }

    input[type=number]:focus,
    input[type=text]:focus,
    input[type=password]:focus {

      outline: none;
    }

    hr {


      width: 70%;

      margin-top: 40px;
      margin-bottom: 120px;
      border: 3px solid red;
      border-radius: 4px;


    }

    form div {

      margin: auto;
    }

    #login {
      background-color: green;
      color: white;
      font-size: 16px;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      border-radius: 4px;
      transition: all 0.5s ease;
    }

    #login:hover {
      background-color: darkgreen;
    }
  </style>
</head>



<body>

  <img src="MCL_logo.png" alt="MCL" width="250" />


  <h1 id="myheader">WELCOME TO SYSTEM DEPARTMENT JA</h1>

  <hr>

  <form action="<?php $_SERVER['PHP_SELF'];  ?>" method="POST">

    <p>Employe ID : <input type="number" name="employeid" /></p>

    <p>Password : <input type="password" name="password" /></p>


    <p><input id="login" name="login" type="submit" value="Login" /></p>

  </form>


  <?php
  if (isset($_POST['login'])) {

    $servername = "localhost";

    // In my case, user name will be root
    $username = "root";

    // Password is empty
    $password = "";

    //database name 
    $DatabaseName = "stock";

    // Creating a connection
    $conn = new mysqli(
      $servername,
      $username,
      $password,
      $DatabaseName
    );

    // Check connection
    if ($conn->connect_error) {
      die("Connection failure: "
        . $conn->connect_error);
    }


    $username = mysqli_real_escape_string($conn, $_POST['employeid']);
    $password = $_POST['password'];

    $sql = "SELECT Employe_id , Employe_Name FROM login where Employe_id = '$username' AND Password = '$password' ";

    $result = mysqli_query($conn, $sql) or die("Query Failed.");

    if (mysqli_num_rows($result) > 0) {

      while ($row = mysqli_fetch_assoc($result)) {

        // session_start();
        $_SESSION["EMPLOYE"] = $row['Employe_id'];
        $_SESSION["EMPLOYE_NAME"] = $row['Employe_Name'];

        header("Location: http://localhost/stock/dashboard.php");
      }
    } else {
      echo 'NO user with this ID';
    }
  }
  ?>
  <br>
  <br>
  <br>
  <hr>

</body>

</html>