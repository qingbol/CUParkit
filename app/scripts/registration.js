/*
 * This file is to aid the register.html file in communicating to the API
*/

const apiDir = "../api";

/* Get HTML FormData object from HTML form element. 
   Then, convert the FormData object to JSON.
   Note: Each element in the HTML form needs to have a "name"
*/
let formDataToJSON = (formElement => {    
    let formData = new FormData(formElement);
    let convertedJSON = {};
    formData.forEach((value, key) => { 
        convertedJSON[key] = value;
    });
    return convertedJSON;
});

let register = ((apiEndPoint, formData) => {
    // Post data to API with Axios
    console.log("register..");
    axios.post(apiDir+apiEndPoint, 
        formData)
    .then(res => {
        //console.log(res);
        document.getElementById("messageBox").innerHTML = res;
    }).catch(err => {
        // console.log(err.response);
        document.getElementById("messageBox").innerHTML = err.response;
    });
});

let registerOwner = (registerFunc => {
    // Get data from HTML Form
    console.log("registerowner");
    let formData = formDataToJSON(document.getElementById("newOwnerForm"));
    // console.log(formData);
    // POST the data to the server to register a new user in the database
    registerFunc("/Owner/create.php", formData);
});

let registerAdmin = (registerFunc => {
    // Get data from HTML Form
    let formData = formDataToJSON(document.getElementById("newAdminForm"));
    // POST the data to the server to register a new user in the database
    registerFunc("/Manager/create.php", formData);
});

// When the script is done being loaded onto the client's machine
window.addEventListener("load",function(){
    // Set what happens when user clicks the register button
    // document.getElementById("registerOwnerButton").onclick = () => {console.log("click owner"); registerOwner(register);}
    document.getElementById("registerOwnerButton").onclick = () => registerOwner(register);
    document.getElementById("registerAdminButton").onclick = () => registerAdmin(register);
});
