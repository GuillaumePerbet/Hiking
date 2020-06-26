//menu
const menuElt = document.getElementById("menu");
const navElt = document.querySelector("nav");
menuElt.addEventListener("click", ()=>{
    let left = window.getComputedStyle(navElt).left;
    navElt.style.left=(left=="0px")?"-100%":"0px";
});