//get excursions list DOM elements
const excursionsList = document.getElementById("excursions-list");

//update excursions list section
function updateExcursionsList(){
    fetch("formHandler/list_excursions.php").then(res=>res.json()).then(data=>{
        excursionsList.innerHTML = data.list;
    });
}
updateExcursionsList();

//modal confirm
confirm.addEventListener('click',()=>{
    let id = confirm.getAttribute("data-id");
    deleteExcursion(id);
    modal.classList.add('hidden');
});

//delete excursion function
function deleteExcursion(id){
    const formData = new FormData();
    formData.append("id",id);
    fetch("formHandler/delete_excursion.php",{method: "POST", body: formData}).then(()=>updateExcursionsList());
}

//get create_excursion DOM elements
const createForm = document.getElementById("create-form");
const nameError = document.getElementById("nameError");
const priceError = document.getElementById("priceError");
const maxHikersError = document.getElementById("maxHikersError");
const dateError = document.getElementById("dateError");
const placeError = document.getElementById("placeError");
const guidesError = document.getElementById("guidesError");
const createSuccess = document.getElementById("createSuccess");

//create_hiker form handler
createForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    const formData = new FormData(createForm);
    fetch("formHandler/create_excursion.php",{method:"POST", body: formData}).then(res=>res.json()).then(data=>{
        //reset error fields
        nameError.innerHTML = "";
        priceError.innerHTML = "";
        maxHikersError.innerHTML = "";
        dateError.innerHTML = "";
        placeError.innerHTML = "";
        guidesError.innerHTML = "";
        createSuccess.innerHTML = "";
        //print errors
        if(data.nameError){
            nameError.innerHTML = data.nameError;
        }
        if(data.priceError){
            priceError.innerHTML = data.priceError;
        }
        if(data.maxHikersError){
            maxHikersError.innerHTML = data.maxHikersError;
        }
        if(data.dateError){
            dateError.innerHTML = data.dateError;
        }
        if(data.placeError){
            placeError.innerHTML = data.placeError;
        }
        if(data.guidesError){
            guidesError.innerHTML = data.guidesError;
        }
        //print success and reset form fields
        if(data.createSuccess){
            createForm.reset();
            createSuccess.innerHTML = data.createSuccess;
        }
    });
});