//Get create_excursion DOM elements
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