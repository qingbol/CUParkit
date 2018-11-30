/*
 * This file is to View/query/update user accounts
*/
console.log("entering admin.js");
$(function(){
  $("#listAllUserButton").click(function(){
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
    $.ajax({
      method: "GET",
      data: {pageNum:pageNum},
      url: window.location.pathname + '../../../api/Owner/list_all.php',
      dataType: 'json',
      success: function(dataFromServer){
        console.log("success");
        // displayResult(dataFromServer);
        $("#paginationData").html(dataFromServer);
      }, //.ajax success module
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }       
    }); //.ajax module
} //loadData function end


