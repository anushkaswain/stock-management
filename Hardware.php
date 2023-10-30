<?php

include "header.php";
?>
<style>
  /* CHANGE HERE */
  #C{
    background-color: #04AA6D;
  }
</style>
<aside>

  <ul id="sidebar">
  </ul>

</aside>

<div class="content">

  <?php

  $value = $_GET['product_name'];
  $value2 = $_GET['product_code'];




  ?>
  <h1 id="available" style="color: green;font-size: 4.0em;">0</h1>
  <div>
    <h1><?php echo $value?></h1>
  </div>

  <form action='#' method='post' id="formdata">


    <p>
      No of Items :
      <input type="number" name="NoOfItems" id="NoOfItems">
    </p>


    <p>Requisitioner : <input type="text" name="person_name" id="person_name" /></p>

    <p>Designation & Department : <input type="text" name="designation" id="designation"></p>

    <p>Product Information : <input type="text" name="department" id="department" placeholder="(optional)"></p>

    <p>Received By: <input type="text" name="received_by" id="received_by" /></p>




    <p>
      Unit :
      <select name="Unit" id="Unit">
        <option value="">--Select a Unit--</option>
        <option value="4732">4732 :: JOCP </option>
        <option value="4733">4733 :: AOCP </option>
        <option value="4734">4734 :: BBSRI</option>
        <option value="4740">4740 :: GM Office JA</option>
        <option value="4741">4741 :: R.Store JA</option>
        <option value="4745">4745 :: R.H</option>
        <option value="4749">4749 :: NSCH</option>
        <option value="0000">0000 :: Other Area</option>

      </select>
    </p>
    <p><input type="submit" name="submit" value="Issue" id="save-button" /></p>

  </form>




</div>
<script>
  $(document).ready(function() {
    var Product_Name = <?php echo json_encode($value); ?>;
    var Product_Code = <?php echo json_encode($value2); ?>;
    
    
    function loadavailable() {
      $.ajax({
        url: "GetAvailable.php",
        type: "POST",
        data: {
          Product_Id: Product_Code
        },
        success: function(data) {
          $("#available").html(data);
        }
      });
    }
    loadavailable();
    function loadsidebar() {
     var Prefix = "HC";
     var link = "Hardware.php";
      $.ajax({
        url: "LoadSidebar.php",
        type: "POST",
        data: {
          Prefix: Prefix,
          link:link

        },
        success: function(data) {
          $("#sidebar").html(data);
        }
      });
    }
    loadsidebar();
    $("#formdata").submit(function(e) {
      e.preventDefault()
      var NoOfItems = $("#NoOfItems").val();
      var person_name = $("#person_name").val();
      var received_by = $("#received_by").val();
      var designation = $("#designation").val();
      var department = $("#department").val();
      var Unit = $("#Unit").val();
      var Issued_By = <?php echo json_encode($_SESSION["EMPLOYE"]); ?>;
      
      
      if (NoOfItems == "" || person_name == "" || designation == "" || Unit == "" || received_by == "") {
        alert("Please fill all the compulsory fields");
      
      } else {
        var b = confirm(NoOfItems+" "+Product_Name + " will be issued to "+person_name);
        if(b){
          $.ajax({
          type: "POST",
          url: "insert.php",
          data: {
            NoOfItems: NoOfItems,
            person_name: person_name,
            designation: designation,
            department: department,
            received_by : received_by,
            Unit: Unit,

            Issued_By: Issued_By,
            ItemName : Product_Name,

           Product_Code: Product_Code

          },
          success: function(data) {

            
            if (data == 1) {
              
              loadavailable();
              $("#formdata").trigger("reset");
              
            } else {

              alert("Can't Issue Product");
            }
          }
        });
        }
      
      }



    });


  });

</script>

</body>

</html>