// navigation bar related
let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('fa-times');//close sign on fas fa-bars
    navbar.classList.toggle('active');
}

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}
// <!-- admin login start -->

// document.addEventListener('DOMContentLoaded', function () {
//     const loginForm = document.getElementById('login-form'); 
//     const closeBtn = document.querySelector('.close-btn'); 
//     const adminLink = document.getElementById('admin-link');
//     const pageContent = document.querySelector('.page-content'); 


//     adminLink.addEventListener('click', function (e) {
//         e.preventDefault(); 
//         loginForm.style.display = 'flex'; 
//         pageContent.classList.add('modal-open'); 
//     });

    
//     closeBtn.addEventListener('click', function () {
//         loginForm.style.display = 'none'; 
//         pageContent.classList.remove('modal-open'); 
//     });


//     window.addEventListener('click', function (e) {
//         if (e.target === loginForm) {
//             loginForm.style.display = 'none'; 
//             pageContent.classList.remove('modal-open'); 
//         }
//     });
// });

// <!-- admin login sampla -->