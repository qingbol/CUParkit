/*
 * This file is to View/query/update user accounts
*/
console.log("entering parkingReport.js");
$(function(){
  $("#query1").click(function(){
    console.log("detecting listAllUserButton click event");
    loadData1();
  }); //#listAllUserButton" click event.

  //listening pagination button
  $(document).on('click', '.parking-record-pagination', function(){  
    let pageNumb = $(this).attr("id");  
    loadData1(pageNumb);  
  });  

  $("#query2").click(function(){
    console.log("detecting listOccupiedSpot click event");
    loadData2();
  }); //#listAllUserButton" click event.

  // //listening pagination button
  $(document).on('click', '.occupied-pagination', function(){  
    let pageNumb = $(this).attr("id");  
    loadData2(pageNumb);  
  });  

  $("#spotStatusFilterBtn").click(function(){
    let pageNum = "1";
    console.log("detecting spotStatusFilterBtn click event");
    let spotStatus = $("#spotStatusFilterInput").val();
    console.log(spotStatus);
    
    let formDatas = {pageNumber:pageNum, spotStatus:spotStatus};
    // console.log(formDatas);
    let formData = JSON.stringify(formDatas);
    // console.log(formDatas);

    // if(null == spotStatus || "" == spotStatus){
    //   alert("Pls input the spot status first");
    //   return;
    // }
    loadData3(formDatas);
  }); //#listAllUserButton" click event.

  $(document).on('click', '.filter-spot-pagination', function(){  
    let spotStatus = $("#spotStatusFilterInput").val();
    // if(null == spotStatus || "" == spotStatus){
    //   alert("Pls input the spot status first");
    //   return;
    // } 
    let pageNum = $(this).attr("id");  

    let formDatas ={pageNumber:pageNum, spotStatus:spotStatus};
    let formData = JSON.stringify(formDatas);
    // console.log(formDatas);

    loadData3(formDatas);  
  });  

  console.log("leave query.html");
});

//split in server-side
let loadData3 = (filterData) =>{
    console.log(filterData);
    //empty the div first
    // $("#paginationData").html(""); 
    $("#paginationData").empty(); 
    $.ajax({
      method: "GET",
      data: filterData,
      url: window.location.pathname + '../../../api/ParkingSpot/filter_spot_status.php',
      dataType: 'json',
      beforeSend: function(){
        console.log("preSending...");
      },
      success: function(dataFromServer){
        console.log("success");
        console.log(dataFromServer);
        // If the server returned a message instead of resulting data
        $("#paginationData").html("");
        if (dataFromServer.message) {
          // document.getElementById("messageBox").innerHTML = dataFromServer.message + "<br>";
          $("#messageBox").html(dataFromServer.message + "<br>");
        }
        if (dataFromServer){
          $("#paginationData").html(dataFromServer);
        }
      }, //.ajax success module
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }       
    }); //.ajax module
} //loadData function end

//split in server-side
let loadData1 = (pageNum) =>{
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
        $("#paginationData").html("");
        if (dataFromServer.message) {
          // document.getElementById("messageBox").innerHTML = dataFromServer.message + "<br>";
          $("#messageBox").html(dataFromServer.message + "<br>");
        }
        if (dataFromServer){
          $("#paginationData").html(dataFromServer);
        }
      }, //.ajax success module
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }       
    }); //.ajax module
} //loadData function end

//split in server-side
let loadData2 = (pageNum) =>{
    console.log(pageNum);
    //empty the div first
    // $("#paginationData").html(""); 
    $("#paginationData").empty(); 
    $.ajax({
      method: "GET",
      data: {pageNum:pageNum},
      url: window.location.pathname + '../../../api/ParkOn/list_occupied_spot.php',
      dataType: 'json',
      success: function(dataFromServer){
        // console.log("success");
        // displayResult(dataFromServer);
        // If the server returned a message instead of resulting data
        $("#paginationData").html("");
        if (dataFromServer.message) {
          // document.getElementById("messageBox").innerHTML = dataFromServer.message + "<br>";
          $("#messageBox").html(dataFromServer.message + "<br>");
        }
        if (dataFromServer){
          $("#paginationData").html(dataFromServer);
        }
      }, //.ajax success module
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }       
    }); //.ajax module
} //loadData function end


