//Get list hikers DOM elements
const hikersList = document.getElementById("hikers-list");
const selectHiker = document.getElementById("select-hiker");

//update list guides section and select options
function updateHikersList(){
    fetch("formHandler/list_hikers.php").then(res=>res.json()).then(data=>{
        hikersList.innerHTML = data.list;
        selectHiker.innerHTML = data.select;
    });
}
updateHikersList();

//delete hiker function
function deleteHiker(id){
    if(window.confirm("Confirmer la suppression?")){
        const formData = new FormData();
    formData.append("id",id);
    fetch("formHandler/delete_hiker.php",{method: "POST", body: formData}).then(()=>updateHikersList());
    }
}

//get create_hiker DOM elements
const createForm = document.getElementById("create-form");
const lastNameError = document.getElementById("lastNameError");
const firstNameError = document.getElementById("firstNameError");
const createSuccess = document.getElementById("createSuccess");

//create_hiker form handler
createForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    const formData = new FormData(createForm);
    fetch("formHandler/create_hiker.php",{method:"POST", body: formData}).then(res=>res.json()).then(data=>{
        //reset error fields
        lastNameError.innerHTML = "";
        firstNameError.innerHTML = "";
        createSuccess.innerHTML = "";
        //print errors
        if(data.lastNameError){
            lastNameError.innerHTML = data.lastNameError;
        }
        if(data.firstNameError){
            firstNameError.innerHTML = data.firstNameError;
        }
        //on success, print message, reset form fields, update list
        if(data.createSuccess){
            createForm.reset();
            createSuccess.innerHTML = data.createSuccess;
            updateHikersList();
        }
    });
});

//get registration DOM elements
const registrationForm = document.getElementById("registration-form");
const registrationSuccess = document.getElementById("registrationSuccess");

//registration form handler
registrationForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    const formData = new FormData(registrationForm);
    fetch("formHandler/registration.php",{method:"POST", body: formData}).then(res=>res.json()).then(data=>{
        //reset error and success fields
        hikerError.innerHTML = "";
        excursionError.innerHTML = "";
        registrationSuccess.innerHTML = "";
        //print errors
        if(data.hikerError){
            hikerError.innerHTML = data.hikerError;
        }
        if(data.excursionError){
            excursionError.innerHTML = data.excursionError;
        }
        //print success field
        if(data.registrationSuccess){
            registrationSuccess.innerHTML = data.registrationSuccess;
            updateHikersList();
        }
    });
});