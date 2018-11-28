/*
 * This file is to aid the register.html file in communicating to the API
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

let handleError = (err) => {
    // console.log(err.response);
    // document.getElementById("messageBox").innerHTML = JSON.stringify(err.response);
    document.getElementById("messageBox").innerHTML = err.response.data.message;
    if (res.data.code)
        document.getElementById("messageBox").innerHTML = err.response.data.code;
};

/* Check if username already exists in database */
let usernameCheck = (username) => {
    // console.log("Checking: " + username);
    axios.get(apiDir+"/Owner/read_single.php", {
        params: {
            oid: username,
        }
    }).then(res => {
        // If the username does exist
        if (res.data) {
            console.log("User exists -- Choose another username");
            document.getElementById("oidStatus").innerHTML = "error";
        } else { // If the username does not exist
            document.getElementById('oidStatus').innerHTML = "done";
        }
    }).catch((err) => handleError);
};

let confirmPassword = (pass, pass_confirm) => {
    if (pass.value !== pass_confirm.value) {
        pass_confirm.setCustomValidity("Passwords Must Match");
        return false;
    } else {
        pass_confirm.setCustomValidity("");
        return true;
    }
};

let register = (apiEndPoint, formData) => {
    // Check if user's passwords match
    let pass_node = document.getElementById("ownerPassword");
    let pass_confirm_node = document.getElementById("ownerPasswordConfirm");
    // If the passwords don't match
    if ( confirmPassword(pass_node, pass_confirm_node) === false ) {
        document.getElementById("messageBox").innerHTML = "Registration failed: Your passwords don't match!";
        return;
    }

    // Post data to API with Axios
    console.log("register..");
    axios.post(apiDir+apiEndPoint, formData)
    .then(res => {
        //console.log(res);
        // document.getElementById("messageBox").innerHTML = JSON.stringify(res);
        document.getElementById("messageBox").innerHTML = res.data.message;
        if (res.data.passwordMsg)
            document.getElementById("messageBox").innerHTML += "<br>" + res.data.passwordMsg;
    }).catch((err) => handleError);
};

let registerOwner = (registerFunc) => {
    // Get data from HTML Form
    console.log("registerowner");
    let formData = formDataToJSON(document.getElementById("newOwnerForm"));
    // console.log(formData);
    // POST the data to the server to register a new user in the database
    registerFunc("/Owner/create.php", formData);
};

let registerAdmin = (registerFunc) => {
    // Get data from HTML Form
    let formData = formDataToJSON(document.getElementById("newAdminForm"));
    // POST the data to the server to register a new user in the database
    registerFunc("/Manager/create.php", formData);
};

// When the script is done being loaded onto the client's machine
window.addEventListener("load",function(){
    // Set what happens when user clicks the register button
    document.getElementById("registerOwnerButton").onclick = () => registerOwner(register);
    document.getElementById("registerAdminButton").onclick = () => registerAdmin(register);

    // listen for all types of changes to username field
	// so we can update the icon to help the user know if the id is already taken
	let usernameNode = document.getElementById('ownerId');
	usernameNode.addEventListener('keydown', () => usernameCheck(usernameNode.value));
	usernameNode.addEventListener('keyup', () => usernameCheck(usernameNode.value));
	usernameNode.addEventListener('cut', () => usernameCheck(usernameNode.value));
	usernameNode.addEventListener('paste', () => usernameCheck(usernameNode.value));
    usernameNode.addEventListener('blur', () => usernameCheck(usernameNode.value));
    
    // Test for matching passwords
    let pass_node = document.getElementById("ownerPassword");
    let pass_confirm_node = document.getElementById("ownerPasswordConfirm");
    pass_confirm_node.addEventListener('keydown', () => confirmPassword(pass_node, pass_confirm_node));
    pass_confirm_node.addEventListener('keyup', () => confirmPassword(pass_node, pass_confirm_node));
	pass_confirm_node.addEventListener('cut', () => confirmPassword(pass_node, pass_confirm_node));
	pass_confirm_node.addEventListener('paste', () => confirmPassword(pass_node, pass_confirm_node));
    pass_confirm_node.addEventListener('blur', () => confirmPassword(pass_node, pass_confirm_node));

});
