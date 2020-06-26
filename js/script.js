//Small device burger menu
const menu = document.getElementById("menu");
const nav = document.querySelector("nav");
menu.addEventListener("click", ()=>{
    let left = window.getComputedStyle(nav).left;
    nav.style.left=(left=="0px")?"-100%":"0px";
});

//Header username 
const userName = document.getElementById("user-name");
function checkLogin(){
    //if user connected, print user name
    if(sessionStorage.getItem("user")!==null){
        userName.classList.remove("not-connected");
        userName.innerHTML = sessionStorage.getItem("user");
    }
    //if user disconected, print "non connecté"
    else{
        userName.classList.add("not-connected");
        userName.innerHTML = "Non connecté";
    }
}
checkLogin();