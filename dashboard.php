<?php

include "header.php";
?>

<style>
  #H{
    background-color: #04AA6D;
  }
  #pagination {
  display: block;
  margin-top:20px;
}

#pagination a {
  color: black;
  
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
  margin: 0 4px;
}

#pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

#pagination a:hover:not(.active) {background-color: #ddd;}
.edit-button{
  font-size: small;
  background-color:#006622;
  padding: 5px 12px;

}
.edit-button:hover{
  background-color:#001a09;
}

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
  margin-top:160px;
  padding:15px;
  border-radius:10px;
}
#editformdata{
margin:0;
}
#referenceid{
  margin:5px 10%;
  color:darkblue;
}
</style>

<div id="modal">
  <div id="modal-form">
    <h4 id="referenceid">Edit Form</h4>
<form action='#' method='post' id="editformdata">


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
<p><button type='button' class='form-button' id='update-button' style="margin-right:20px;background-color:darkgreen;">Update</button><button type='button' class='form-button' id='cancel-button' style="background-color:crimson;" >Cancel</button></p>

</form>
  </div>
</div>

<div class="Home_Table">

  <table id="table_data">

  <tr>
    <th>1</th>
    <th>2</th>
    <th>3</th>

  </tr>
  </table>
  <div id="pagination">
    <a id="1" href="#">1</a>
    <a id="2" href="#">2</a>
    <a id="3" href="#">3</a>
    <a id="4" href="#">4</a>
    <a id="5" href="#">5</a>
    <a id="6" href="#">6</a>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    function loadtable(page){
      $.ajax({
      url: "GetIssueByPage.php",
      type: "POST",
      data:{page_no:page},
      success: function(data) {
        $(".Home_Table").html(data);
      }
    });
    }
    
    loadtable();

page_id = 1;
$(document).on("click","#pagination a",function(e){
  e.preventDefault();
  page_id = $(this).attr("id");
  
  loadtable(page_id);
});


$(document).on("click",".edit-button",function(){

  var EditId = $(this).data("id");
  window.current_id = EditId;
  $("#referenceid").html("You are changing information against refrence no  <b>"+EditId+"</b>");
  $("#NoOfItems").val("7");
  
  $.ajax({
    async:false,
    url:"LoadUpdateForm.php",
    type:"POST",
    data:{EditId:EditId},
    success:function(data) {
      const myJSON = data;
      const myObj = JSON.parse(myJSON);
     
     var value1 = myObj["N"];
     window.old_value = value1;
     var value2 = myObj["R"];
     var value3 = myObj["Desg"];
     var value4 = myObj["P"];
     var value5 = myObj["RB"];
     var value6 = myObj["U"];
     var value7 = myObj["C"];
     window.pcode = value7;

     $("#NoOfItems").val(value1);
     $("#person_name").val(value2);
     $("#designation").val(value3);
     $("#department").val(value4);
     $("#received_by").val(value5);
     $("#Unit").val(value6);


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
      var OldValue = old_value;
      var code = pcode;
      var NoOfItems = $("#NoOfItems").val();
      var person_name = $("#person_name").val();
      var received_by = $("#received_by").val();
      var designation = $("#designation").val();
      var department = $("#department").val();
      var Unit = $("#Unit").val();
      if (NoOfItems == "" || person_name == "" || designation == "" || Unit == "" || received_by == "") {
        alert("Please fill all the compulsory fields");
      }
      else
      {
        $.ajax({
          type: "POST",
          url: "update.php",
          data: {
            NoOfItems: NoOfItems,
            person_name: person_name,
            designation: designation,
            department: department,
            received_by : received_by,
            Unit: Unit,
            EditId:EditId,
            OldValue:OldValue,
            code:code

          },
          success: function(data) {

            
            if (data == 1) {
          
              loadtable(page_id);
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