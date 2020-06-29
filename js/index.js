//Get DOM elements
const loginForm = document.getElementById("login-form");
const password = document.querySelector("input[type=password]")
const userError = document.getElementById("userError");
const passwordError = document.getElementById("passwordError");

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