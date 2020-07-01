//UPDATE EXCURSION LIST_____________________________________________________
//get DOM elements
const excursionsList = document.getElementById("excursions-list");
//update list function
function updateExcursionsList(){
    fetch("formHandler/list_excursions.php").then(res=>res.json()).then(data=>{
        //update section
        excursionsList.innerHTML = data.list;
    });
}
//update once
updateExcursionsList();


//CREATE EXCURSION___________________________________________________________
//get DOM elements
const createForm = document.getElementById("create-form");
const nameError = document.getElementById("nameError");
const priceError = document.getElementById("priceError");
const maxHikersError = document.getElementById("maxHikersError");
const dateError = document.getElementById("dateError");
const placeError = document.getElementById("placeError");
const guidesError = document.getElementById("guidesError");
//create-form submission
createForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    //send AJAX request
    const formData = new FormData(createForm);
    fetch("formHandler/create_excursion.php",{method:"POST", body: formData}).then(res=>res.json())
    .then(data=>{
        //reset error fields
        nameError.innerHTML = "";
        if(data.nameError){
            nameError.innerHTML = data.nameError;
        }
        priceError.innerHTML = "";
        if(data.priceError){
            priceError.innerHTML = data.priceError;
        }
        maxHikersError.innerHTML = "";
        if(data.maxHikersError){
            maxHikersError.innerHTML = data.maxHikersError;
        }
        dateError.innerHTML = "";
        if(data.dateError){
            dateError.innerHTML = data.dateError;
        }
        placeError.innerHTML = "";
        if(data.placeError){
            placeError.innerHTML = data.placeError;
        }
        guidesError.innerHTML = "";
        if(data.guidesError){
            guidesError.innerHTML = data.guidesError;
        }
        //on success: reset form, update list, hide modal
        if(data.createSuccess){
            createForm.reset();
            updateExcursionsList();
            hideModal();
        }
    });
});


//DELETE EXCURSION_____________________________________________________
//on delete button confirmation
confirm.addEventListener('click',()=>{
    //get excursion id
    let id = confirm.getAttribute("data-id");
    //send AJAX request
    const formData = new FormData();
    formData.append("id",id);
    fetch("formHandler/delete_excursion.php",{method: "POST", body: formData})
    .then(()=>{
        //on success: update list, hide modal
        updateExcursionsList();
        hideModal();
    });
});