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
    //reset error fields
    updateLastNameError.innerHTML = "";
    updateFirstNameError.innerHTML = "";
    updateIdError.innerHTML = "";
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
//get DOM elements
const registrationModal = document.getElementById("registration-modal");
const registrationForm = document.getElementById("registration-form");
const hikerOptions = selectHiker.getElementsByTagName("option");
//show registration-modal
function showRegistrationModal(id){
    //choose selected hiker
    for (let hikerOption of hikerOptions){
        if(hikerOption.value == id){
            hikerOption.setAttribute("selected","selected");
        }else{
            hikerOption.removeAttribute("selected");
        }
    }
    //show modal
    registrationModal.classList.remove("hidden");
}
//form submission
registrationForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    //send AJAX request
    const formData = new FormData(registrationForm);
    fetch("formHandler/registration.php",{method:"POST", body: formData}).then(res=>res.json())
    .then(data=>{
        //reset error fields
        hikerError.innerHTML = "";
        if(data.hikerError){
            hikerError.innerHTML = data.hikerError;
        }
        excursionError.innerHTML = "";
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

//HIKER UNREGISTRATION_______________________________________
function unregister(hikerId,excursionId){
    const formData = new FormData();
    formData.append("hiker_id",hikerId);
    formData.append("excursion_id",excursionId);
    fetch("formHandler/unregistration.php",{method:"POST", body:formData}).then(()=>{
        updateHikersList();
        hideModal();
    });
}