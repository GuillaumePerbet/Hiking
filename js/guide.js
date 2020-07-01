//Get list guides DOM elements
const guidesList = document.getElementById("guides-list");

//update list guides section
function updateGuidesList(){
    fetch("formHandler/list_guides.php").then(res=>res.json()).then(data=>{
        guidesList.innerHTML = data.content;
    });
}
updateGuidesList();

//modal confirm
confirm.addEventListener('click',()=>{
    let id = confirm.getAttribute("data-id");
    deleteGuide(id);
    modal.classList.add('hidden');
});

//delete guide function
function deleteGuide(id){
    const formData = new FormData();
    formData.append("id",id);
    fetch("formHandler/delete_guide.php",{method: "POST", body: formData}).then(()=>updateGuidesList());
}

//get create from DOM elements
const createForm = document.getElementById("create-form");
const lastNameError = document.getElementById("lastNameError");
const firstNameError = document.getElementById("firstNameError");
const phoneError = document.getElementById("phoneError");
const createSuccess = document.getElementById("createSuccess");

//create guide form handler
createForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    const formData = new FormData(createForm);
    fetch("formHandler/create_guide.php",{method:"POST", body: formData}).then(res=>res.json()).then(data=>{
        //reset error fields
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
        //on success: print message, reset form fields, update guides list
        if(data.createSuccess){
            createForm.reset();
            createSuccess.innerHTML = data.createSuccess;
            updateGuidesList();
        }
    });
});