/*
 * This file is to View/query/update user accounts
*/
console.log("entering admin.js");
$(function(){
  $("#listAllUserButton").click(function(){
    console.log("detecting listAllUserButton click event");
    loadData();

  }); //#listAllUserButton" click event.

  //listening pagination button
  $(document).on('click', '.page-item', function(){  
    let pageNumb = $(this).attr("id");  
    loadData(pageNumb);  
  });  

  console.log("leave admin.js");
});

//split in server-side
let loadData = (pageNum) =>{
    console.log(pageNum);
    //empty the div first
    // $("#paginationData").html(""); 
    $("#paginationData").empty(); 
    $.ajax({
      method: "GET",
      data: {pageNum:pageNum},
      url: window.location.pathname + '../../../api/Owner/list_all.php',
      dataType: 'json',
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


