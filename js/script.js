//Small device burger menu
const menu = document.getElementById("menu");
const nav = document.querySelector("nav");
menu.addEventListener("click", ()=>{
    let left = window.getComputedStyle(nav).left;
    nav.style.left=(left=="0px")?"-100%":"0px";
});

//sign out link
function disconnect(){
   fetch("formHandler/logout.php")
    .then(()=>document.location.href="index.php");
}