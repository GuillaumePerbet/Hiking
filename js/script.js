//BURGER MENU________________________________________
//get DOM elements
const menu = document.getElementById("menu");
const nav = document.querySelector("nav");
//menu click event
menu.addEventListener("click", ()=>{
    //toggle left property of navigation
    let left = window.getComputedStyle(nav).left;
    nav.style.left=(left=="0px")?"-100%":"0px";
});

//SIGN OUT____________________________________________
function disconnect(){
    document.location.href="logout.php";
}

//show delete modal
const deleteModal = document.getElementById("delete-modal");
const confirm = document.getElementById("confirm");
function showDeleteModal(id){
    deleteModal.classList.remove("hidden");
    //add id of element to delete
    confirm.setAttribute("data-id",id);
}

//show create modal
const createModal = document.getElementById("create-modal");
function showCreateModal(){
    createModal.classList.remove("hidden");
}

//hide all modals
const modals = document.getElementsByClassName("modal");
function hideModal(){
    for(let modal of modals){
        modal.classList.add("hidden");
    }
}