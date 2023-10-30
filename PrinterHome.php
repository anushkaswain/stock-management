<?php

include "header.php";
?>
<style>
  #P{
    background-color: #04AA6D;
  }
  #newproductdata{
    margin-left:2%;
    margin-right:2%;
    padding-top:2px;
    padding-bottom:2px;
    margin-bottom:100px;
  }
  #newproductdata p{
            margin: 10px;
            padding: 5px;
            color: red;
            font-weight: bold;
  }
  .Table{
    width:70%;
    margin-top:30px;
    margin-left:15%;
    margin-right:15%;
    font-size:small;

  }

  td:nth-child(4) { text-align: center }
  td:nth-child(5) { text-align: center }

  #modal{
  background: rgba(0,0,0,0.7);
  position:fixed;
  left:0;
  top:0;
  width:100%;
  height:100%;
  z-index:100;
  display:none;
  
}
#modal-form{
  background:#fff;
  width:30%;
  margin:auto;
  margin-top:150px;
  padding:15px;
  border-radius:10px;
}
#editformdata{
margin:0;
}
#referenceid{
  margin:5px 23%;
  color:darkblue;
}
</style>
<aside>

    <ul id="sidebar">

    </ul>

<form action='#' method='post' id="newproductdata">

<p style="color:blue;">Add a New Printer Product</p>

    <p>
      ProductCode :
      <input type="number" name="ProductCode" id="ProductCode" placeholder="Give a three digit code">
    </p>


    <p>Name : <input type="text" name="Name" id="Name" /></p>

    <p>
      Available :
      <input type="number" name="Available" id="Available">
    </p>
    <p>
      Last Purchase Rate :
      <input type="text" name="LPR" id="LPR" placeholder="(optional)">
    </p>
    <p>
      Unit :
      <select name="UnitType" id="UnitType">
        <option value="">--Unit type--</option>
        <option value="EA">EA</option>
        <option value="KG">KG</option>
        <option value="METER">METER</option>
        <option value="1000 sheet">1000 sheet</option>
      </select>
    </p>
    <p><input type="submit" name="submit" value="Add" id="save-button" /></p>

  </form>
</aside>

<div id="modal">
  <div id="modal-form">
    <h4 id="referenceid">Edit Form</h4>
<form action='#' method='post' id="editformdata">


    <p>
      Last Purchase Rate :
      <input type="text" name="LPRx" id="LPRx" placeholder="(optional)">
    </p>

<p><button type='button' class='form-button' id='update-button' style="margin-right:20px;background-color:darkgreen;">Update</button><button type='button' class='form-button' id='cancel-button' style="background-color:crimson;" >Cancel</button></p>

</form>
  </div>
</div>
<div class=content>
  <div class="Table">

<table id="table_data">

    <tr>
        <th>1

        </th>
        <th>2</th>
        <th>3</th>

    </tr>
</table>
<button type="button" id="csv"><a href="downloadavailable.php?prefix=PR" target="_blank" style="color:white;text-decoration: none;">Download Table</a></button>

</div>   

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type=text/javascript>
    $(document).ready(function() {
    function loadsidebar() {
     var Prefix = "PR";
     var link = "Printer.php";
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
    function loadtable() {
      var Prefix = "PR";
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
    $("#newproductdata").submit(function(e) {
      e.preventDefault()
      var ProductCode = $("#ProductCode").val();
      var Name = $("#Name").val();
      var Available = $("#Available").val();
      var Prefix = "PR";
      var UnitType = $("#UnitType").val();
      var LPR = $("#LPR").val();
      if (ProductCode == "" || Name == "" || Available == "" || UnitType=="") {
        alert("Please fill all the fields");
        
      } else {
        var a = confirm("New Product "+Prefix+ProductCode+" with Name "+Name+" will be created ");
        if(a){

          $.ajax({
          type: "POST",
          url: "InsertProduct.php",
          data: {
            ProductCode : ProductCode,
            Name : Name,
            Available: Available,
            Prefix: Prefix,
            UnitType:UnitType,
            LPR:LPR
          },
          success: function(data) {

            if(data==1)
            {
            // alert("New product created with code "+Prefix+ProductCode);
            $("#newproductdata").trigger("reset");
            loadsidebar();
            loadtable();
            }
            else{
              
                alert("Product not created try again");
            }

          }
        });

        }
      }



    });

$(document).on("click",".edit-button",function(){

var EditId = $(this).data("id");
window.current_id = EditId;
$("#referenceid").html("You are changing LPR for  <b>"+EditId+"</b>");


$.ajax({
  async:false,
  url:"loadLPR.php",
  type:"POST",
  data:{EditId:EditId},
  success:function(data) {
    
    var value1 = data;
   $("#LPRx").val(value1);
  }

});
$("#modal").show();

});


$(document).on("click","#cancel-button",function(){

$("#modal").hide();

//   alert(EditId);
});
$(document).on("click","#update-button",function(){
      var EditId = current_id;     
      var LPRx = $("#LPRx").val();
      if (LPRx == "" ) {
        alert("Please fill all the compulsory fields");
      }
      else
      {
        $.ajax({
          type: "POST",
          url: "updateLPR.php",
          data: {  
            LPRx: LPRx,
            EditId:EditId
          },
          success: function(data) {

            
            if (data == 1) {
          
              loadtable();
              $("#modal").hide();
              alert("update successful")
              
            } else {

              alert("could not update try again");
            }

          }
        });
      }
     


//   alert(EditId);
});


});
</script>

</body>

</html>

