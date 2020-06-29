//Get DOM elements
const loginForm = document.getElementById("login-form");
// const logoutForm = document.getElementById("logout-form");
// const userConnected = document.getElementById("user-connected");
const password = document.querySelector("input[type=password]")
const userError = document.getElementById("userError");
const passwordError = document.getElementById("passwordError");

// //Select form to print
// function selectLogForm(){
//     //if user connected, print logout form
//     if(sessionStorage.getItem("user")!==null){
//         loginForm.style.display = "none";
//         logoutForm.style.display = "flex";
//         userConnected.innerHTML = `Vous êtes connecté en tant que ${sessionStorage.getItem("user")}`;
//     }
//     //if user disconnected, print login form
//     else{
//         loginForm.style.display = "flex";
//         logoutForm.style.display = "none";
//     }
// }
// selectLogForm();

//Login form handler
loginForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    const formData = new FormData(loginForm);
    fetch("formHandler/login.php",{method:"POST", body: formData}).then(res=>res.json()).then(data=>{
        //erase errors and password field
        password.value = "";
        userError.innerHTML = "";
        passwordError.innerHTML = "";
        if(data.user){
            document.location.href="excursion.php";
        }
        //print errors
        if(data.userError){
            userError.innerHTML = data.userError;
        }
        if(data.passwordError){
            passwordError.innerHTML = data.passwordError;
        }
    });
});

// //Logout form handler
// logoutForm.addEventListener("submit",(e)=>{
//     e.preventDefault();
//     //remove stocked user and update page
//     sessionStorage.removeItem("user");
//     checkLogin();
//     selectLogForm();
// });