document.addEventListener('DOMContentLoaded', function() {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const navbarMenu = document.getElementById('navbar-menu');

    hamburgerMenu.addEventListener('click', function() {
        navbarMenu.classList.toggle('active');
        hamburgerMenu.classList.toggle('active');
    });
});
