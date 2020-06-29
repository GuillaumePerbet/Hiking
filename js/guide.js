//Get DOM elements
const createForm = document.getElementById("create-form");
const lastNameError = document.getElementById("lastNameError");
const firstNameError = document.getElementById("firstNameError");
const phoneError = document.getElementById("phoneError");
const createSuccess = document.getElementById("createSuccess");

//create guide form handler
//Login form handler
createForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    const formData = new FormData(createForm);
    fetch("formHandler/create_guide.php",{method:"POST", body: formData}).then(res=>res.json()).then(data=>{
        //erase error fields
        lastNameError.innerHTML = "";
        firstNameError.innerHTML = "";
        phoneError.innerHTML = "";
        createSuccess.innerHTML = "";
        //print errors
        if(data.lastNameError){
            lastNameError.innerHTML = data.lastNameError;
        }
        if(data.firstNameError){
            firstNameError.innerHTML = data.firstNameError;
        }
        if(data.phoneError){
            phoneError.innerHTML = data.phoneError;
        }
        //print success and erase form fields
        if(data.createSuccess){
            createForm.reset();
            createSuccess.innerHTML = data.createSuccess;
        }
    });
});