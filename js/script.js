//MENU
const menu = document.getElementById("menu");
const nav = document.querySelector("nav");
menu.addEventListener("click", ()=>{
    let left = window.getComputedStyle(nav).left;
    nav.style.left=(left=="0px")?"-100%":"0px";
});

//check if user is loged in and print username accordingly
const userName = document.getElementById("user-name");
function checkLogin(){
    if(sessionStorage.getItem("user")!==null){
        userName.classList.remove("not-connected");
        userName.innerHTML = sessionStorage.getItem("user");
    }
    else{
        userName.classList.add("not-connected");
        userName.innerHTML = "Non connecté";
    }
}
checkLogin();

//CONNECTION PAGE
const loginForm = document.getElementById("login-form");
const logoutForm = document.getElementById("logout-form");
const userConnected = document.getElementById("user-connected");
const userError = document.getElementById("userError");
const password = document.querySelector("input[type=password]")
const passwordError = document.getElementById("passwordError");

function logForm(){
    if(sessionStorage.getItem("user")!==null){
        loginForm.style.display = "none";
        logoutForm.style.display = "flex";
        userConnected.innerHTML = `Vous êtes connecté en tant que ${sessionStorage.getItem("user")}`;
    }
    else{
        loginForm.style.display = "flex";
        logoutForm.style.display = "none";
    }
}
logForm();

loginForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    const formData = new FormData(loginForm);
    fetch("formHandler/login.php",{method:"POST", body: formData}).then(res=>res.json()).then(data=>{
        password.value = "";
        userError.innerHTML = "";
        passwordError.innerHTML = "";
        //handle login success
        if(data.user){
            sessionStorage.setItem("user",data.user);
            checkLogin();
            logForm();
        }else{
            //handle user error
            if(data.userError){
                userError.innerHTML = data.userError;
            }
            //handle password error
            if(data.passwordError){
                passwordError.innerHTML = data.passwordError;
            }
        }
    });
});

logoutForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    sessionStorage.removeItem("user");
    checkLogin();
    logForm();
});