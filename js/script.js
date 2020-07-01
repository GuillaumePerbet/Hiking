//burger menu
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

//modal
const modal = document.getElementById("modal");
const confirm = document.getElementById("confirm");
//show modal and add item id to confirm button attribute
function showModal(id){
    modal.classList.remove("hidden");
    confirm.setAttribute("data-id",id);
}
//decline delete button: hide modal
function decline(){
    modal.classList.add('hidden');
}
