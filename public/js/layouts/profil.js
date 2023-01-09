const buttonAktifForm = document.getElementById("aktif-btn");
const inputForms = document.getElementsByClassName("ctrl");

buttonAktifForm.addEventListener("click", (ev) => {
    ev.preventDefault();

    for (let i = 0; i < inputForms.length; i++) {
        var input = inputForms[i];

        if (input.hasAttribute("disabled")) {
            input.attributes.removeNamedItem("disabled");
            buttonAktifForm.innerText = "Non Aktifkan Form";
        } else {
            input.setAttribute("disabled", true);
            buttonAktifForm.innerText = "Aktifkan Form";
        }
    }
});
