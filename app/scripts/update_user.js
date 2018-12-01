/*
 * This file is to View/query/update user accounts
*/
console.log("entering update_user.js");
$(function(){
  $("#listOneUserButton").click(function(){
    console.log("detecting listOneUserButton click event");
    //empty the div first
    // $("#paginationData").html(""); 
    $("#paginationData").empty(); 
    // loadData();

    //listening pagination button
  //   $(document).on('click', '.page-item', function(){  
  //       let pageNumb = $(this).attr("id");  
  //       loadData(pageNumb);  
  //  });  
  }); //#listAllUserButton" click event.
  console.log("leave update_user.js");
});

//split in server-side
// let loadData = (pageNum) =>{
//     console.log(pageNum);
//     $.ajax({
//       method: "GET",
//       data: {pageNum:pageNum},
//       url: window.location.pathname + '../../../api/Owner/list_all.php',
//       dataType: 'json',
//       success: function(dataFromServer){
//         console.log("success");
//         // displayResult(dataFromServer);
//         $("#paginationData").html(dataFromServer);
//       }, //.ajax success module
//       error: function(XMLHttpRequest, textStatus, errorThrown) { 
//         alert("Status: " + textStatus); alert("Error: " + errorThrown); 
//       }       
//     }); //.ajax module
// } //loadData function end


