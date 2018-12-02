/*
 * This file is to View/query/update user accounts
*/
console.log("entering parkingReport.js");
$(function(){
  $("#query1").click(function(){
    console.log("detecting listAllUserButton click event");
    loadData();

    //listening pagination button
    $(document).on('click', '.page-item', function(){  
        let pageNumb = $(this).attr("id");  
        loadData(pageNumb);  
   });  
  }); //#listAllUserButton" click event.
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
      url: window.location.pathname + '../../../api/ParkingRecord/list_all_record.php',
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


