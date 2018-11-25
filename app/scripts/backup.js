/*
 * This file is to aid the backup.html file in communicating to the API
*/

const apiDir = "../api";

// let brFunc = ((apiEndPoint) => {
let brFunc = ((apiEndPoint) => {
    // Post data to API with Axios
    console.log("backup..");
    // axios.post(apiDir+apiEndPoint, 
        // formData)
    axios.get(apiDir+apiEndPoint)
    .then(res => {
        // console.log("ddggg");
        console.log(res);
    }).catch(err => {
        // console.log("hahah");
        console.log(err.response);
        // console.log(err);
    });
});

let backupSql = (backupFunc => {
    // Get data from HTML Form
    console.log("backupSql");
    // let formData = formDataToJSON(document.getElementById("newOwnerForm"));
    // console.log(formData);
    // POST the data to the server to register a new user in the database
    backupFunc("/backup/backup.php");
});

let restoreSql = (backupFunc => {
    // Get data from HTML Form
    console.log("restoreSql");
    // let formData = formDataToJSON(document.getElementById("newAdminForm"));
    // POST the data to the server to register a new user in the database
    backupFunc("/backup/restore.php", formData);
});

// When the script is done being loaded onto the client's machine
window.addEventListener("load",function(){
    // Set what happens when user clicks the register button
    // document.getElementById("backupSql").onclick = () => {console.log("click owner"); backupSql(register);}
    document.getElementById("backupButton").onclick = () => backupSql(brFunc);
    document.getElementById("restoreButton").onclick = () => restoreSql(brFunc);
});

