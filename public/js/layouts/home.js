const navbar = document.getElementById("navbar");
const btnOwnJs = document.querySelector(".btn-own-js");
const btnLOgin = document.getElementById("btn-login");
const btnRegister = document.getElementById("btn-register");
const links = document.getElementsByClassName("scroll");
const sections = document.getElementsByClassName("scroll-targets");

function handleNavbar(scroll) {
    if (scroll >= 60) {
        navbar.classList.remove("bg-transparent", "px-5", "py-3");
        navbar.classList.add("bg-own", "px-4", "shadow-sm");
    } else {
        navbar.classList.remove("bg-own", "px-4", "shadow-sm");
        navbar.classList.add("bg-transparent", "px-5", "py-3");
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

for (let i = 0; i < links.length; i++) {
    const link = links[i];

    link.addEventListener("click", function (e) {
        e.preventDefault();
        var section = document.getElementById(
            link.getAttribute("href").replace("#", "")
        );

        window.scrollTo({
            top: section.offsetTop,
            behavior: "smooth",
        });
    });
}
