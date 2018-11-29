/*
 * This file is to aid the backup.html file in communicating to the API
*/

const apiDir = "../api";

let brFunc = ((apiEndPoint) => {
    // Get data from API with Axios
    console.log("backup or restore...");
    axios.get(apiDir+apiEndPoint)
    .then(res => {
        //console.log(res);
        document.getElementById("messageBox").innerHTML = res.data.message + "<br>";
    }).catch(err => {
        // console.log(err.response);
        document.getElementById("messageBox").innerHTML = err.response.data.message + "<br>";
    });
});

let backupSql = (backupFunc) => {
    // Get data from HTML Form
    console.log("backupSql");
    // let formData = formDataToJSON(document.getElementById("newOwnerForm"));
    // console.log(formData);
    // POST the data to the server to register a new user in the database
    backupFunc("/backup/backup.php");
};

let restoreSql = (backupFunc) => {
    // Get data from HTML Form
    console.log("restoreSql");
    // let formData = formDataToJSON(document.getElementById("newAdminForm"));
    // POST the data to the server to register a new user in the database
    backupFunc("/backup/restore.php");
};

// When the script is done being loaded onto the client's machine
window.addEventListener("load",function(){
    // Set what happens when user clicks the register button
    // document.getElementById("backupSql").onclick = () => {console.log("click owner"); backupSql(register);}
    document.getElementById("backupButton").onclick = () => backupSql(brFunc);
    document.getElementById("restoreButton").onclick = () => restoreSql(brFunc);
});

