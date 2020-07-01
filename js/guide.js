//UPDATE GUIDES LISTS_____________________________________________________
//get DOM elements
const guidesList = document.getElementById("guides-list");
//update list function
function updateGuidesList(){
    fetch("formHandler/list_guides.php").then(res=>res.json()).then(data=>{
        //update table
        guidesList.innerHTML = data.content;
    });
}
//update once
updateGuidesList();


//CREATE GUIDE___________________________________________________________
//get DOM elements
const createForm = document.getElementById("create-form");
const lastNameError = document.getElementById("lastNameError");
const firstNameError = document.getElementById("firstNameError");
const phoneError = document.getElementById("phoneError");
//create-form submission
createForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    //send AJAX request
    const formData = new FormData(createForm);
    fetch("formHandler/create_guide.php",{method:"POST", body: formData}).then(res=>res.json())
    .then(data=>{
        //reset error fields
        lastNameError.innerHTML = "";
        if(data.lastNameError){
            lastNameError.innerHTML = data.lastNameError;
        }
        firstNameError.innerHTML = "";
        if(data.firstNameError){
            firstNameError.innerHTML = data.firstNameError;
        }
        phoneError.innerHTML = "";
        if(data.phoneError){
            phoneError.innerHTML = data.phoneError;
        }
        //on success: reset form, update list, hide modal
        if(data.createSuccess){
            createForm.reset();
            updateGuidesList();
            hideModal();
        }
    });
});


//DELETE GUIDE_____________________________________________________
//on delete button confirmation
confirm.addEventListener('click',()=>{
    //get guide id
    let id = confirm.getAttribute("data-id");
    //send AJAX request
    const formData = new FormData();
    formData.append("id",id);
    fetch("formHandler/delete_guide.php",{method: "POST", body: formData})
    .then(()=>{
        //on success: update list, hide modal
        updateGuidesList();
        hideModal();
    });
});