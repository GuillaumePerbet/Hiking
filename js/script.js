//BURGER MENU________________________________________
//get DOM elements
const menu = document.getElementById("menu");
const nav = document.querySelector("nav");
//menu click event
menu.addEventListener("click", ()=>{
    //toggle left property of navigation
    let left = window.getComputedStyle(nav).left;
    let width = window.getComputedStyle(nav).width;
    nav.style.left=(left=="0px")?"-"+width:"0px";
});


//SIGN OUT____________________________________________
function disconnect(){
    document.location.href="logout.php";
}


//SHOW DELETE MODAL________________________________________
const deleteModal = document.getElementById("delete-modal");
const confirm = document.getElementById("confirm");
function showDeleteModal(id){
    //add id of element to delete
    confirm.setAttribute("data-id",id);
    deleteModal.classList.remove("hidden");
}


//SHOW CREATE MODAL_____________________________________
const createModal = document.getElementById("create-modal");
function showCreateModal(){
    createModal.classList.remove("hidden");
}


//HIDE MODALS__________________________________________
const modals = document.getElementsByClassName("modal");
function hideModal(){
    for(let modal of modals){
        modal.classList.add("hidden");
    }
}

//HODE ON CLIK AROUND
for(let modal of modals){
    modal.addEventListener('click',()=>hideModal());
    const content = modal.getElementsByTagName('div')[0];
    content.addEventListener('click', (e)=>e.stopPropagation());
}