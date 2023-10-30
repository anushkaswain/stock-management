<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    
    <title>Consumable Report</title>

<style>
  .Table{
    width:90%;
    border-radius:0;
    margin:auto;
  }
th{
  padding-top:70px;
  padding-bottom:10px;
  background-color:white;
  color:darkblue;
  border-top:2px solid black;
  border-radius:0;
}
th:nth-child(1){
  width:80%
  /* border-top:none; */
  /* padding-top:0; */
}
.footer th{
  color:red;
}
.total td{
  color:green;
border-top:2px solid ;
padding-top:4px;
}
 td:nth-child(1) { font-size:1.3em;
                  text-align:left;
                  font-weight:bold }

                  th:nth-child(1) { font-size:1.3em;
                  text-align:left;
                  font-weight:bold }
                  td:nth-child(2) { font-size:1.3em;
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



<div class="Table">
  <div class="reporthead">
  <img src="MCL_logo.png" alt="MCL" width="150" />
  <h3 style="color:darkred ; margin-top:65px;" >CONSUMABLE REPORT OF YEAR 2023</h3>
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
    $.ajax({
      
      url: "getreport.php",
      async: false, 
      type: "POST",
      success: function(data) {
        $("#table_data").html(data);
      }
    });

function downloadPDFWithDocRaptor() {
  DocRaptor.createAndDownloadDoc('DPcHB5kPr-TDLPLollA3', {
    test: true,
    type: 'pdf',
    name: 'consumption report',
    document_content: document.querySelector('html').innerHTML,
  })
}
downloadPDFWithDocRaptor();

  });
</script>
</body>

</html>