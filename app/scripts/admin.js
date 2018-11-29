/*
 * This file is to View/query/update user accounts
*/
console.log("entering admin.js");
$(function(){
  $("#listAllUserButton").click(function(){
    console.log("detecting listAllUserButton click event");
    $.ajax({
      type: 'GET',
      url: '/cuparkit/api/Owner/read.php',
      success: function(usrResult){
      console.log("success...");
      console.log(usrResult);
        //   let myObj = JSON.parse(usrResult);

        //Get the array length, and each object columns.
        let rowNum = usrResult.length;
        let colNum = Object.keys(usrResult[0]).length;
        console.log("rowNum = ", rowNum);
        console.log("colNum = ", colNum);
        
        //create table element
        let tableInDiv = document.getElementById("listUserInDiv"); 
        //create the table header element
        let tableHeaderRowInDiv = document.createElement("div");
        tableHeaderRowInDiv.setAttribute("class", "row justify-content-center");
        tableInDiv.appendChild(tableHeaderRowInDiv);
        
        for(let i = 0; i < colNum; i++){
            let tableHeaderColInDiv = document.createElement("div");
            tableHeaderColInDiv.setAttribute("class", "col-2 col-sm-2 col-md-2 col-lg-2 border text-center bg-info"); 
            tableHeaderColInDiv.innerText = Object.keys(usrResult[0])[i];
            tableHeaderRowInDiv.appendChild(tableHeaderColInDiv);
        }
        //create the btn column in header
        let tableHeaderColBtn = document.createElement("div");
        tableHeaderColBtn.setAttribute("class", "col-1 col-sm-1 col-md-1 col-lg-1 border text-center bg-info"); 
        tableHeaderColBtn.innerText = "Modify";
        tableHeaderRowInDiv.appendChild(tableHeaderColBtn);

        //create the table body element
        for(let i = 0; i < rowNum; i++){
            let tableBodyRowInDiv = document.createElement("div");
            tableBodyRowInDiv.setAttribute("class", "row justify-content-center");
            tableInDiv.appendChild(tableBodyRowInDiv);
            for(let j = 0; j < colNum; j++){
                let tableBodyColKey = Object.keys(usrResult[i])[j];
                let tableBodyColInDiv = document.createElement("div");
                tableBodyColInDiv.setAttribute("class", "col-2 col-sm-2 col-md-2 col-lg-2 border text-center bg-light");
                let colId = "col_" + i + "_" + j;
                // console.log(colId);
                tableBodyColInDiv.setAttribute("id", colId);
                if (tableBodyColKey == "Password"){
                    tableBodyColInDiv.innerText = "******";
                }else{
                    tableBodyColInDiv.innerText = usrResult[i][tableBodyColKey];
                }
                tableBodyRowInDiv.appendChild(tableBodyColInDiv);
            }
            // create button in every row
            tableBodyColBtn = document.createElement("div");
            tableBodyColBtn.setAttribute("class", "col-1 col-sm-1 col-md-1 col-lg-1 border text-center bg-light");
            let colBtnId = "colBtn_" + i;
            tableBodyColBtn.setAttribute("id", colBtnId);
            let colBtn = document.createElement("button");
            colBtn.setAttribute("class", "btn btn-outline-danger btn-sm");
            colBtn.innerHTML = "Modify";
            tableBodyColBtn.appendChild(colBtn);
            tableBodyRowInDiv.appendChild(tableBodyColBtn);
        } //nested for loop to create user table

        // jQuery method for loop
        // $.each(usrResult, function(i, usrResultItem){
        // console.log(usrResultItem.OID);
        // console.log(Object.keys(usrResultItem)[0]);
        // $("#listUserResult").append("some tuples");
        // $("#listUserResult").append('<li class="list-group-item">OID: ' + usrResultItem.OID + ',    Name: ' + usrResultItem.Name +',    Tel: ' + usrResultItem.Tel + ',    Type: ' + usrResultItem.Type +'</li>');
        // });
      } //ajax success module
    }); //ajax module
  }); //#listAllUserButton" click event.
});