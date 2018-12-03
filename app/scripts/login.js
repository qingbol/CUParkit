/*
 * This file is to aid the login.html file in communicating to the API
*/

const apiDir = "../api";


/* Get HTML FormData object from HTML form element. 
   Then, convert the FormData object to JSON.
   Note: Each element in the HTML form needs to have a "name"
*/
let formDataToJSON = (formElement) => {    
    let formData = new FormData(formElement);
    let convertedJSON = {};
    formData.forEach((value, key) => { 
        convertedJSON[key] = value;
    });
    return convertedJSON;
};


/*
 * POST the data to the server to log the user into the database
*/
let login = () => {
    // Get data from HTML Form
    console.log("login...");
    let formData = formDataToJSON(document.getElementById("loginForm"));
    console.log(formData);
    let apiEndPoint = "/Authentication/login.php";

    // Post data to API with Axios
    axios.post(apiDir+apiEndPoint, 
        formData)
    .then(res => {
        document.getElementById("messageBox").innerHTML = res.data.message + "<br>";
        // If the user successfully logged in, then redirect them to the home page
        if (res.data.message === "Password is valid") {
            window.location.replace("index.html");
        }
    }).catch(err => {
        document.getElementById("messageBox").innerHTML = err.response.data.message + "<br>";
    });
};

// When the script is done being loaded onto the client's machine
window.addEventListener("load",function(){
    // Set what happens when user clicks the login button
    document.getElementById("loginButton").onclick = login;
});

