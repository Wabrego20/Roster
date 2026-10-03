const btnEditar = document.getElementById("btnEditar");
const btnGuardar = document.getElementById("btnGuardar");

let editando = false;

btnEditar.addEventListener("click", function () {

    const celdasPelotones = document.querySelectorAll(
        "#tablaRoster tbody td:nth-child(n+3)"
    );

    editando = true;

    celdasPelotones.forEach(function (celda) {
        celda.setAttribute("contenteditable", "true");
    });

});


btnGuardar.addEventListener("click", function () {

    const celdasPelotones = document.querySelectorAll(
        "#tablaRoster tbody td:nth-child(n+3)"
    );

    editando = false;

    celdasPelotones.forEach(function (celda) {
        celda.setAttribute("contenteditable", "false");
    });

    alert("Roster guardado correctamente.");

});