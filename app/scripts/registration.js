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
    document.getElementById("messageBox").innerHTML = err.response.data.message + "<br>";
    if (res.data.code)
        document.getElementById("messageBox").innerHTML = err.response.data.code + "<br>";
};

/* Check if username already exists in database */
let usernameCheck = (username, userType) => {
    let id;
    if (userType === "Owner") {
        id = "oid";
    } else {
        id = "mid";
    }
    axios.get(apiDir+"/"+userType+"/read_single.php", {
        params: {
            id: username,
        }
    }).then(res => {
        // If the username does exist
        if (res.data[id] || res.data[id.toUpperCase()]) {
            document.getElementById(id+"Status").innerHTML = "error";
        } else { // If the username does not exist
            document.getElementById(id+'Status').innerHTML = "done";
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

let register = (apiEndPoint, formData, pass_node_name, pass_confirm_node_name) => {
    // Reset any previous messages each time the register button is clicked
    document.getElementById("messageBox").innerHTML = "";

    pass_node = document.getElementById(pass_node_name);
    pass_confirm_node = document.getElementById(pass_confirm_node_name);
    // If the passwords don't match
    if ( confirmPassword(pass_node, pass_confirm_node) === false || pass_node.value === "") {
        document.getElementById("messageBox").innerHTML = "Registration failed: Your passwords don't match! <br>";
        return;
    }

    // Post data to API with Axios
    axios.post(apiDir+apiEndPoint, formData)
    .then(res => {
        document.getElementById("messageBox").innerHTML += res.data.message + "<br>";
        if (res.data.passwordMsg) {
            document.getElementById("messageBox").innerHTML += res.data.passwordMsg + "<br>";
        }
        // Redirect user to login page after successful registration
        if (res.data.message === "Success") {
            window.location.replace("login.html");
        }
    }).catch((err) => handleError);
};

let registerOwner = (registerFunc) => {
    // Get data from HTML Form
    let formData = formDataToJSON(document.getElementById("newOwnerForm"));
    // POST the data to the server to register a new user in the database
    registerFunc("/Owner/create.php", formData, "ownerPassword", "ownerPasswordConfirm");
};

let registerAdmin = (registerFunc) => {
    // Get data from HTML Form
    let formData = formDataToJSON(document.getElementById("newManagerForm"));
    // POST the data to the server to register a new user in the database
    registerFunc("/Manager/create.php", formData, "adminPassword", "adminPasswordConfirm");
};

// When the script is done being loaded onto the client's machine
window.addEventListener("load",function(){
    // Set what happens when user clicks the register button
    document.getElementById("registerOwnerButton").onclick = () => registerOwner(register);
    document.getElementById("registerAdminButton").onclick = () => registerAdmin(register);

    let eventsToListenFor = ['keydown', 'keyup', 'cut', 'paste','blur'];

    // listen for all types of changes to username field
	// so we can update the icon to help the user know if the id is already taken
	let usernameNode = document.getElementById('ownerId');
    eventsToListenFor.forEach((event) => {
        usernameNode.addEventListener(event, () => usernameCheck(usernameNode.value, "Owner"));
    });
    
    // Test for matching passwords
    let pass_node = document.getElementById("ownerPassword");
    let pass_confirm_node = document.getElementById("ownerPasswordConfirm");
    eventsToListenFor.forEach((event) => {
        pass_confirm_node.addEventListener(event, () => confirmPassword(pass_node, pass_confirm_node));
    });

    // listen for all types of changes to username field
	// so we can update the icon to help the user know if the id is already taken
	let usernameNode2 = document.getElementById('managerID');
    eventsToListenFor.forEach((event) => {
        usernameNode2.addEventListener(event, () => usernameCheck(usernameNode2.value, "Manager"));
    });
    
    // Test for matching passwords
    let pass_node2 = document.getElementById("adminPassword");
    let pass_confirm_node2 = document.getElementById("adminPasswordConfirm");
    eventsToListenFor.forEach((event) => {
        pass_confirm_node2.addEventListener(event, () => confirmPassword(pass_node2, pass_confirm_node2));
    });
});
