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


//UPDATE GUIDE___________________________________________________________
//get DOM elements
const updateForm = document.getElementById("update-form");
const lastNameInput = document.getElementById("last-name-update");
const updateLastNameError = document.getElementById("update-lastNameError");
const firstNameInput = document.getElementById("first-name-update");
const updateFirstNameError = document.getElementById("update-firstNameError");
const phoneInput = document.getElementById("phone-update");
const updatePhoneError = document.getElementById("update-phoneError");
const updateIdError = document.getElementById("update-idError");
const updateModal = document.getElementById("update-modal");
//show update-modal
function showUpdateModal(guide){
    //add id of element to update
    updateForm.setAttribute("data-id",guide.id);
    //fill form fields
    lastNameInput.value = guide.last_name;
    firstNameInput.value = guide.first_name;
    phoneInput.value = guide.phone;
    //show modal
    updateModal.classList.remove("hidden");
}
//update-form submission
updateForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    //get guide id
    let id = updateForm.getAttribute("data-id");
    //send AJAX request
    const formData = new FormData(updateForm);
    formData.append("id",id);
    fetch("formHandler/update_guide.php",{method:"POST", body: formData}).then(res=>res.json())
    .then(data=>{
        //reset error fields
        updateLastNameError.innerHTML = "";
        if(data.lastNameError){
            updateLastNameError.innerHTML = data.lastNameError;
        }
        updateFirstNameError.innerHTML = "";
        if(data.firstNameError){
            updateFirstNameError.innerHTML = data.firstNameError;
        }
        updatePhoneError.innerHTML = "";
        if(data.phoneError){
            updatePhoneError.innerHTML = data.phoneError;
        }
        updateIdError.innerHTML = "";
        if(data.idError){
            updateIdError.innerHTML = data.idError;
        }
        //on success: update list, hide modal
        if(data.updateSuccess){
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