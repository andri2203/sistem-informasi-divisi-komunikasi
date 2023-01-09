/* Sidebar */
const closeSub = document.querySelectorAll(".btn-x");

for (let i = 0; i < closeSub.length; i++) {
    var btn = closeSub[i];

    btn.addEventListener("click", function (e) {
        e.preventDefault();
        e.target.parentElement.classList.toggle("open");

        var icon = e.target.children[1].children[0];
        icon.classList.toggle("fa-rotate-90");
    });
}

const navmains = document.querySelectorAll(".main");

for (let i = 0; i < navmains.length; i++) {
    var navMain = navmains[i];

    if (navMain.classList.contains("open")) {
        navMain.children[0].children[1].children[0].classList.add(
            "fa-rotate-90"
        );
    }
}
