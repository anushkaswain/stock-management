<?php

include "header2.php";
?>
<style>
    #acq-aside{
        background-color:bisque;
        width:30%;
    }
    .form-content{
        margin-top:2%;
        margin-left:5%;
        margin-right:5%;
        /* height:200px; */
        background-color:white;
        border:2px solid black;
        border-radius:10px;
    }
    #acquireproduct{
        margin-left:0;
        margin-right:0;
        border-radius:0px;
        border:none;
    }
textarea {
  margin-top:10px;
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
  white-space: pre-wrap;
}
.content{
    margin-left:30%
}
h4{
            color: green;
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 20px;
            margin-bottom: 10px;
            text-align: center;
}
.Tablereceipt{
  width:97%;
  margin:auto;
  margin-top:5%;
  
}
td:nth-child(2) { font-weight:bold;text-align:center;font-size:1.0em}
        
        
        td:nth-child(3) { text-align:left;font-weight:normal;font-size:1.0em;width:45%}
        td:nth-child(1) { font-size:1.0em;
        font-weight:bold;text-align:left }
        td:nth-child(4) { font-size:1.0em;
        font-weight:bold;text-align:left }
</style>
<aside id="acq-aside">
    
    <div class="form-content">

    <form action='#' method='post' id="acquireproduct">

        <p style="color:blue;">BREAKDOWN DETAILS</DETAILS></p>

    <p>
      Model :
      <input type="text" name="Model" id="Model">
    </p>


    <p>
        Serial Number : 
        <input type="text" name="Serial_Number" id="Serial_Number" placeholder="Enter correct Serial Number"/>
    </p>

    <p>
      Issue:
      <textarea type="text" name="Issue" id="Issue"></textarea>
    </p>
    <p>
      Name :
      <input type="text" name="Name" id="Name">
    </p> <p>
      Phone Number :
      <input type="number" name="Phone" id="Phone">
    </p> <p>
      Unit and Department :
      <input type="text" name="UAD" id="UAD">
    </p>
    <p><input type="submit" name="submit" value="Confirm" id="save-button" />
    </p>

    
  </form>


    </div>
</aside>

<div class="content">
  <h4 id="success"></h4>
<div class="Tablereceipt">

<table id="table_data">

    <tr>
        <th>Reference No.</th>
        <th>Model</th>
        <th>Serial No.</th>
        <th>Issue</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Unit and Department</th>
        <th>Case Open</th>
        <th>Case Closed</th>
        <th>Days</th>
        <th>Replies</th>
        

    </tr>
</table>
<button type="button" id="csv"><a href="downloadreceipt.php" target="_blank" style="color:white;text-decoration: none;">Download Receipt</a></button>
</div>

<script>
  $(document).ready(function() {

    function loadtable() {
        
        $.ajax({
            url: "GetReceiptData.php",
            type: "POST",
            
            success: function(data) {
                $("#table_data").html(data);
            }
        });
    }
    loadtable();
    
    $("#acquireproduct").submit(function(e) {
      e.preventDefault()
      var Amount = $("#AcquireAmount").val();
      var Code = $("#AcquireCode").val();
      var Description = $("#Description").val();
      
      if (Amount == "" || Code == "" || Description == "" ) {
        alert("Please fill all the fields");
      
      } else {
        $.ajax({
          type: "POST",
          url: "acquireinsert.php",
          data: {
            Reference_No = Reference_No,
            Model = Model,
            Serial_No = Serial_No,
            Issue = Issue,
            Name = Name,
            Phone = Phone,
            Unit_and_Department = Unit_and_Department,
            CaseOpen = CaseOpen,
            CaseClosed = CaseClosed,
            Days = Days,
            Replies = Replies
            
          },
          success: function(data) {

            if(data == 1 ) 
            {
              $("#success").html(Amount + " Product added to stock having code " + Code);
              loadtable();
              $("#acquireproduct").trigger("reset");
            }
            else if(data == 0)
            {
              $("#success").html("Failed to add Product");
            }
            else{
              alert(data);
            }
            // if (data == 1) {
            //   loadavailable();
            //   $("#formdata").trigger("reset");
            //   alert(NoOfItems + " " + ItemName + " issued to " + person_name);
            // } else {

            //   alert("Can't Issue Product");
            // }
          }
        });
      }



    });
  
    

  });
  
</script>

</body>


</html> 
