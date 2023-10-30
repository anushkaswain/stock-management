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
  .Table{
    width:90%;
    border-radius:0;
    margin:auto;
  }
th{
  padding-top:40px;
  padding-bottom:10px;
  background-color:white;
  color:darkblue;
  border-top:2px solid black;
  border-radius:0;
}
td
{
  padding-top:5px;
  padding-bottom:5px;
  background-color:white;
  
  border-top:1px solid green;
  border-bottom:1px solid green;
  border-radius:0;
}
th:nth-child(1){
  width:15%
  /* border-top:none; */
  /* padding-top:0; */
}
.footer th{
  color:red;
}
.total td{
  border-top:2px solid black;
  color:green;
  font-size:1.0em;
  
}

 td:nth-child(1) { font-size:1.0em;
                  text-align:left;
                  font-weight:bold;
                  
                  }

                  th{ font-size:1.3em;
                  text-align:left;
                  font-weight:bold }
                  th:nth-child(3){ font-size:1.0em;
                  text-align:center;
                  font-weight:bold }
                  td:nth-child(2) { font-size:1.0em;
                  text-align:left;
                  font-weight:bold }
                  td:nth-child(3) { font-size:1.0em;
                  text-align:center;
                  font-weight:bold }

                  table {
            /* border-collapse: collapse; */
            border:none;
            border-radius:5px;
            width: 100%;
        }
.reprthead{
    display:block;
}
.reporthead img{
    float:left;
}
.reporthead h3{
    float:right;
    
}

</style>

<?php
$value = $_GET['prefix'];
$pname = "";
switch ($value) {
    case "HC":
      $pname =  "Hardware and Capital";
      break;
    case "NW":
        $pname =  "Network Items";
      break;
    case "SY":
        $pname =  "Stationary and Consumable Items";
      break;
      case "PR":
        $pname =  "Printer Consumable";
      break;
    default:
    $pname =  "";
  }
?>

<div class="Table">
  <div class="reporthead">
  <img src="MCL_logo.png" alt="MCL" width="150" />
  <h3 style="color:darkred ; margin-top:65px;" ><?php echo $pname ?></h3>
  </div>

  <table id="table_data">

  <tr>
    <th>1</th>
    <th>2</th>
    <th>3</th>

  </tr>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://docraptor.com/docraptor-1.0.0.js"></script> -->

<script type="text/javascript">
  $(document).ready(function() {
    var Prefix = <?php echo json_encode($value); ?>;
    function loadtable() {
        
        $.ajax({
            url: "GetDataTable.php",
            type: "POST",
            data : {Prefix : Prefix},
            success: function(data) {
                $("#table_data").html(data);
            }
        });
    }
  loadtable();
   

  });
</script>
</body>

</html>