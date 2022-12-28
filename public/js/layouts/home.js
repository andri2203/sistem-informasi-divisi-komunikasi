const navbar = document.getElementById("navbar");
const btnLOgin = document.getElementById("btn-login");
const btnRegister = document.getElementById("btn-register");
const links = document.getElementsByClassName("scroll");
const sections = document.getElementsByClassName("scroll-targets");

function handleNavbar(scroll) {
    if (scroll >= 60) {
        navbar.classList.remove(
            "bg-transparent",
            "px-5",
            "py-3",
            "navbar-own-dark"
        );
        navbar.classList.add("bg-own", "px-4", "shadow-sm", "navbar-own");

        btnLOgin.classList.remove("btn-outline-own-2");
        btnLOgin.classList.add("btn-outline-own");
        btnRegister.classList.remove("btn-outline-own-2");
        btnRegister.classList.add("btn-outline-own");
    } else {
        navbar.classList.remove("bg-own", "px-4", "shadow-sm", "navbar-own");
        navbar.classList.add(
            "bg-transparent",
            "px-5",
            "py-3",
            "navbar-own-dark"
        );

        btnLOgin.classList.remove("btn-outline-own");
        btnLOgin.classList.add("btn-outline-own-2");
        btnRegister.classList.remove("btn-outline-own");
        btnRegister.classList.add("btn-outline-own-2");
    }
}

document.addEventListener("scroll", function (event) {
    let scroll = window.scrollY;

    handleNavbar(scroll);
});

window.onload = function (event) {
    let scroll = window.scrollY;

    handleNavbar(scroll);
};
