const togglePassword = document.getElementById("togglePassword");
const password = document.getElementById("password_user");
togglePassword.addEventListener("click", function () {
    if (password.type === "password") {
        password.type = "text";
        togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");
    } else {
        password.type = "password";
        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa-eye");
    }
});

/**Cargar foto de perfil*/
const fotoPerfil = document.getElementById("fotoPerfil");
const imagenPerfil = document.getElementById("imagenPerfil");
const iconoUser = document.getElementById("iconoUser");

fotoPerfil.addEventListener("change", function () {
    const archivo = this.files[0];

    if (archivo) {
        const lector = new FileReader();

        lector.onload = function (e) {
            imagenPerfil.src = e.target.result;
            imagenPerfil.style.display = "block";
            iconoUser.style.display = "none";
        };

        lector.readAsDataURL(archivo);
    }
});