//Get DOM elements
const logoutMessage = document.getElementById("logout-message");
const createForm = document.getElementById("create-form");
const lastNameError = document.getElementById("lastNameError");
const firstNameError = document.getElementById("firstNameError");
const phoneError = document.getElementById("phoneError");

//Check login
if(sessionStorage.getItem("user")!==null){
    //if user connected, hide logout message
    logoutMessage.style.display = "none";
}
else{
    //if user disconnected, erase create-guide form
    createForm.innerHTML = "";
}