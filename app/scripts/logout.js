/*
 * This file is to View/query/update user accounts
*/
console.log("entering logout.js");
$(function(){
  $("#logoutButton").click(function(){
    console.log("detecting logout click event");
    logoutNow();

  }); //#listAllUserButton" click event.

  console.log("leave logout.js");
});

//split in server-side
let logoutNow = (pageNum) =>{
    console.log("entering logoutNOw");
    //empty the div first
    $.ajax({
      method: "POST",
      data: {pageNum:pageNum},
      url: window.location.pathname + '../../../api/Authentication/logout.php',
      dataType: 'json',
      beforeSend: function(){
        console.log("befor sending....");
      },
      success: function(dataFromServer){
        // console.log("success");
        // displayResult(dataFromServer);
        // If the server returned a message instead of resulting data
        if (dataFromServer.message) {
          document.getElementById("messageBox").innerHTML = dataFromServer.message + "<br>";
        }
        $("#paginationData").html(dataFromServer);
      }, //.ajax success module
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }       
    }); //.ajax module
} //loadData function end


