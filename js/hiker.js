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