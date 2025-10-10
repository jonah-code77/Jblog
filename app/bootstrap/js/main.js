
//const toggler = document.querySelector(".navbar-toggler");
const toggleIcon = document.getElementById("toggle-icon");
const navbarNav = document.getElementById("navbarNav");

navbarNav.addEventListener("show.bs.collapse",()=>{
   toggleIcon.innerHTML = "&times;";
});


navbarNav.addEventListener("hide.bs.collapse",()=>{
   toggleIcon.innerHTML = "&#9776;";
});

