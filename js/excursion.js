//UPDATE EXCURSION LIST_____________________________________________________
//get DOM elements
const excursionsList = document.getElementById("excursions");
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
        }
    });
});


//UPDATE EXCURSION___________________________________________________________
//get DOM elements
const updateModal = document.getElementById("update-modal");
const updateForm = document.getElementById("update-form");
const nameInput = document.getElementById("name-update");
const updateNameError = document.getElementById("update-nameError");
const priceInput = document.getElementById("price-update");
const updatePriceError = document.getElementById("update-priceError");
const maxHikersInput = document.getElementById("maxHikers-update");
const updateMaxHikersError = document.getElementById("update-maxHikersError");
const departureDateInput = document.getElementById("departureDate-update");
const arrivalDateInput = document.getElementById("arrivalDate-update");
const updateDateError = document.getElementById("update-dateError");
const departureOptions = document.querySelectorAll("#departurePlace-update>option");
const arrivalOptions = document.querySelectorAll("#arrivalPlace-update>option");
const updatePlaceError = document.getElementById("update-placeError");
const guideCheckboxes = document.querySelectorAll("#update-form input[type='checkbox']");
const updateGuidesError = document.getElementById("update-guidesError");
const updateIdError = document.getElementById("update-idError");
//show update-modal
function showUpdateModal(excursion){
    //reset error fields
    updateNameError.innerHTML = "";
    updatePriceError.innerHTML = "";
    updateMaxHikersError.innerHTML = "";
    updateDateError.innerHTML = "";
    updatePlaceError.innerHTML = "";
    updateGuidesError.innerHTML = "";
    updateIdError.innerHTML = "";
    //add id of element to update
    updateForm.setAttribute("data-id",excursion.id);
    //fill form fields
    nameInput.value = excursion.name;
    priceInput.value = excursion.price;
    maxHikersInput.value = excursion.max_hikers;
    departureDateInput.value = excursion.departure_date;
    arrivalDateInput.value = excursion.arrival_date;
    //choose selected places
    for (let departureOption of departureOptions){
        if(departureOption.value == excursion.departure_place_id){
            departureOption.setAttribute("selected","selected");
        }else{
            departureOption.removeAttribute("selected");
        }
    }
    for (let arrivalOption of arrivalOptions){
        if(arrivalOption.value == excursion.arrival_place_id){
            arrivalOption.setAttribute("selected","selected");
        }else{
            arrivalOption.removeAttribute("selected");
        }
    }
    //choose checked guides
    for (let guideCheckbox of guideCheckboxes){
        if (excursion.guides.includes(guideCheckbox.value)){
            guideCheckbox.checked = true;
        }else{
            guideCheckbox.checked = false;
        }
    }
    //show modal
    updateModal.classList.remove("hidden");
}
//update-form submission
updateForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    //get excursion id
    let id = updateForm.getAttribute("data-id");
    //send AJAX request
    const formData = new FormData(updateForm);
    formData.append("id",id);
    fetch("formHandler/update_excursion.php",{method:"POST", body: formData}).then(res=>res.json())
    .then(data=>{
        //reset error fields
        updateNameError.innerHTML = "";
        if(data.nameError){
            updateNameError.innerHTML = data.nameError;
        }
        updatePriceError.innerHTML = "";
        if(data.priceError){
            updatePriceError.innerHTML = data.priceError;
        }
        updateMaxHikersError.innerHTML = "";
        if(data.maxHikersError){
            updateMaxHikersError.innerHTML = data.maxHikersError;
        }
        updateDateError.innerHTML = "";
        if(data.dateError){
            updateDateError.innerHTML = data.dateError;
        }
        updatePlaceError.innerHTML = "";
        if(data.placeError){
            updatePlaceError.innerHTML = data.placeError;
        }
        updateGuidesError.innerHTML = "";
        if(data.guidesError){
            updateGuidesError.innerHTML = data.guidesError;
        }
        updateIdError.innerHTML = "";
        if(data.idError){
            updateIdError.innerHTML = data.idError;
        }
        //on success: update list, hide modal
        if(data.updateSuccess){
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