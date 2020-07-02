//UPDATE HIKERS LIST_____________________________________________________
//get DOM elements
const hikersList = document.getElementById("hikers-list");
const selectHiker = document.getElementById("select-hiker");
//update list function
function updateHikersList(){
    fetch("formHandler/list_hikers.php").then(res=>res.json()).then(data=>{
        //update table
        hikersList.innerHTML = data.list;
        //update select options
        selectHiker.innerHTML = data.select;
    });
}
//update once
updateHikersList();


//CREATE HIKER___________________________________________________________
//get DOM elements
const createForm = document.getElementById("create-form");
const lastNameError = document.getElementById("lastNameError");
const firstNameError = document.getElementById("firstNameError");
//create-form submission
createForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    //send AJAX request
    const formData = new FormData(createForm);
    fetch("formHandler/create_hiker.php",{method:"POST", body: formData}).then(res=>res.json())
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
        //on success: reset form, update list, hide modal
        if(data.createSuccess){
            createForm.reset();
            updateHikersList();
            hideModal();
        }
    });
});


//UPDATE HIKER___________________________________________________________
//get DOM elements
const updateForm = document.getElementById("update-form");
const lastNameInput = document.getElementById("last-name-update");
const updateLastNameError = document.getElementById("update-lastNameError");
const firstNameInput = document.getElementById("first-name-update");
const updateFirstNameError = document.getElementById("update-firstNameError");
const updateIdError = document.getElementById("update-idError");
const updateModal = document.getElementById("update-modal");
//show update-modal
function showUpdateModal(hiker){
    //add id of element to update
    updateForm.setAttribute("data-id",hiker.id);
    //fill form fields
    lastNameInput.value = hiker.last_name;
    firstNameInput.value = hiker.first_name;
    //show modal
    updateModal.classList.remove("hidden");
}
//update-form submission
updateForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    //get hiker id
    let id = updateForm.getAttribute("data-id");
    //send AJAX request
    const formData = new FormData(updateForm);
    formData.append("id",id);
    fetch("formHandler/update_hiker.php",{method:"POST", body: formData}).then(res=>res.json())
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
        updateIdError.innerHTML = "";
        if(data.idError){
            updateIdError.innerHTML = data.idError;
        }
        //on success: update list, hide modal
        if(data.updateSuccess){
            updateHikersList();
            hideModal();
        }
    });
});


//DELETE HIKER_____________________________________________________
//on delete button confirmation
confirm.addEventListener('click',()=>{
    //get hiker id
    let id = confirm.getAttribute("data-id");
    //send AJAX request
    const formData = new FormData();
    formData.append("id",id);
    fetch("formHandler/delete_hiker.php",{method: "POST", body: formData})
    .then(()=>{
        //on success: update list, hide modal
        updateHikersList();
        hideModal();
    });
});



//HIKER REGISTRATION TO EXCURSION______________________________________
//ge DOM elements
const registrationForm = document.getElementById("registration-form");
//form submission
registrationForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    //send AJAX request
    const formData = new FormData(registrationForm);
    fetch("formHandler/registration.php",{method:"POST", body: formData}).then(res=>res.json())
    .then(data=>{
        //reset error fields
        hikerError.innerHTML = "";
        excursionError.innerHTML = "";
        if(data.hikerError){
            hikerError.innerHTML = data.hikerError;
        }
        if(data.excursionError){
            excursionError.innerHTML = data.excursionError;
        }
        //on success: update hikers list, hide modal
        if(data.registrationSuccess){
            updateHikersList();
            hideModal();
        }
    });
});