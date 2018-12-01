/*
 * This file is to View/query/update user accounts
*/
console.log("entering update_user.js");
$(function(){
  $("#listOneUserButton").click(function(){
    let userId = $("#oneUserId").val();
    console.log(userId);
    if (null == userId || ""== userId){
      alert("Pls input a user ID first!");
      return;
    }
    console.log("detecting listOneUserButton click event");
    //empty the div first
    $("#paginationData").empty(); 

    listOneUser(userId);
  }); //#listAllUserButton" click event.
  console.log("leave update_user.js");
});

//list user info
let listOneUser = (usrId) =>{
    console.log(usrId);
    $.ajax({
      method: "GET",
      data: {usrid: usrId},
      url: window.location.pathname + '../../../api/Owner/list_one.php',
      dataType: 'json',
      success: function(dataFromServer){
        console.log("success");
        console.log(dataFromServer);
        // displayResult(dataFromServer);
        $("#paginationData").html(dataFromServer);
      }, //.ajax success module
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }       
    }); //.ajax module
} //loadData function end


