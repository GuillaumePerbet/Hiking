//MENU
const menu = document.getElementById("menu");
const nav = document.querySelector("nav");
menu.addEventListener("click", ()=>{
    let left = window.getComputedStyle(nav).left;
    nav.style.left=(left=="0px")?"-100%":"0px";
});

//AJAX CONNECTION
const loginForm = document.getElementById("login-form");
const userError = document.getElementById("userError");
const password = document.querySelector("input[type=password]")
const passwordError = document.getElementById("passwordError");

loginForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    const formData = new FormData(loginForm);
    fetch("formHandler/login.php",{method:"POST", body: formData}).then(res=>res.json()).then(data=>{
        //handle user error
        if(data.userError){
            userError.innerHTML = data.userError;
        }else{
            userError.innerHTML = "";
        }
        //handle password error
        if(data.passwordError){
            passwordError.innerHTML = data.passwordError;
        }else{
            passwordError.innerHTML = "";
        }
        //handle login success
        if(data.length === 0){
            
        }else{
            password.innerHTML = "";
        }
    });
});