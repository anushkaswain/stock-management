<?php

include "header.php";
?>

<style>

#acq-aside{
        background-color:bisque;
        width:25%;
    }
    .form-content{
        margin-top:15%;
        margin-left:5%;
        margin-right:5%;
        /* height:200px; */
        background-color:white;
        border:2px solid black;
        border-radius:10px;
    }
    #customsearch{
        margin-left:0;
        margin-right:0;
        border-radius:0px;
        border:none;
    }
textarea {
  margin-top:10px;
  width: 100%;
  height: 250px;
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
    margin-left:25%
}
  .Table{
    width:70%;
    border-radius:0;
  }
th{
  padding-top:70px;
  padding-bottom:15px;
  background-color:white;
  color:darkblue;
  border-top:2px solid black;
  border-radius:0;
}
.footer th{
  color:red;
}
th:nth-child(1){
  width:80%
  /* border-top:none; */
  /* padding-top:0; */
}
.total{
  color:green;
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
select{
  padding-bottom:2px;
  border-left:none;
  border-top:none;
  border-right:none;
  border-width:2px;
  font-size:large;
  text-align: center;
}
</style>

<aside id="acq-aside">
    
    <div class="form-content">

    <form action='#' method='post' id="customsearch">

        <p style="color:blue;">Custom Search</p>

        <p>
      Year :
      <select name="Year" id="Year">
        <option value=""></option>
        <option value="2022">2022 - 2023 </option>
        <option value="2023">2023 - 2024 </option>
        <option value="2024">2024 - 2025 </option>
        <option value="2025">2025 - 2026 </option>
        <option value="2026">2026 - 2027 </option>
      </select>
    </p>
    <p>
      Period :
      <select name="Period" id="Period">
        <option value=""></option>
        <option value="Y">Yearly</option>
        <option value="M">Monthly</option>
      </select>
    </p>
    <p>
      Category :
      <select name="Category" id="Category">
        <option value=""></option>
        <option value="PR">Printer Consumable</option>
        <option value="NW">Network Items</option>
        <option value="SY">Stationary/Consumables</option>
        <option value="HC">Hardware/Capital</option>

      </select>
    </p>
    
    <p>
        Product Code : 
        <input type="text" name="PCode" id="PCode" placeholder="Enter correct code"/>
    </p>

    <p><input type="submit" name="submit" value="Search" id="save-button" />
    </p>

    
  </form>


    </div>
</aside>
<div class="content">
<div class="Table">
 <h1 style="color:darkred">2023 REPORT</h1>
  <table id="table_data">

  <tr>
    <th>1</th>
    <th>2</th>
    <th>3</th>

  </tr>
  </table>
  <button type="button" id="csv"><a href="downloadreport.php" target="_blank" style="color:white;text-decoration: none;">DownloadReport</a></button>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://docraptor.com/docraptor-1.0.0.js"></script> -->

<script type="text/javascript">
  $(document).ready(function() {

    // $.ajax({
      
    //   url: "getreport.php",
    //   type: "POST",
    //   success: function(data) {
    //     $("#table_data").html(data);
    //   }
    // });
    $("#customsearch").submit(function(e) {
      e.preventDefault();
      var Year = $("#Year").val();
      var Period = $("#Period").val();
      var Category = $("#Category").val();
      var PCode = $("#PCode").val();
      if(Year == "" ){
        if(Period=="M")
        {
          alert("period can't be set to monthly when year is not set");
        }
        else{
          $.ajax({
          type: "POST",
          url: "getreport.php",
          data: {
            Year: Year,
            Period: Period,
            Category: Category,
            PCode: PCode,
          },
          success: function(data) {

            
            
              alert(data);
            
          }
        });
        }

      }
      else{
        $.ajax({
          type: "POST",
          url: "getreport.php",
          data: {
            Year: Year,
            Period: Period,
            Category: Category,
            PCode: PCode,
          },
          success: function(data) {

            
            
              alert(data);
            
          }
        });

      }
      // if (NoOfItems == "" || person_name == "" || designation == "" || Unit == "" || received_by == "") {
      //   alert("Please fill all the compulsory fields");
      
      // } else {
        //var b = confirm(NoOfItems+" "+Product_Name + " will be issued to "+person_name);
        //if(b){
        //   $.ajax({
        //   type: "POST",
        //   url: "getreport.php",
        //   data: {
        //     Year: Year,
        //     Period: Period,
        //     Category: Category,
        //     PCode: PCode,
        //   },
        //   success: function(data) {

            
            
        //       alert(data);
            
        //   }
        // });
        //}
      
      //}



    });
    // function DownloadReport(){
    //   $.ajax({
      
    //   url: "downloadreport.php",
    //   type: "POST",
    //   success: function(data) {
    //     alert(data);
    //   }
    // });
    // }


  });
</script>
</body>

</html>

