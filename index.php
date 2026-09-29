<?php
// require_once "config/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roster-OPPV</title>
    <link rel="stylesheet" href="config/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.1/css/all.min.css">
</head>

<body>
    <main>
        <img src="img/logo_oppv.png" alt="logo_oppv" class="logo_oppv">
        <h3>Inicie sesión con sus datos de la organización</h3>
        <form action="config/conexion.php" method="post" class="form_login">
            <input type="text" name="user_user" id="" placeholder="usuario" pattern="[a-z]{2,20}[0-9]{0,3}"
                title="Solo letras minúsculas y máximo 3 números. No se permiten caracteres especiales."
                title="introduzca su usuario por favor" required autofocus>
            <span>
                <input type="password" name="password_user" id="password_user" placeholder="contraseña"
                    pattern="^[A-Z]{1}[a-z]{1,15}[0-9]{1,4}[!@#$%^&*]{1}$"
                    title="Debe contener 1 mayúscula, de 1 a 8 minúsculas, de 1 a 4 números y 1 carácter especial."
                    required>
                <i class="fa-regular fa-eye" id="togglePassword"></i>
            </span>
            <input type="submit" value="Iniciar Sesión">
            <div class="error_user">
                <?php if (isset($_GET['error'])) { echo htmlspecialchars($_GET['error']); } ?>
            </div>
        </form>
        <a href="https://selfservice.pancanal.com:9251/authorization.do" target="_blank" rel="noopener noreferrer"
            class="aut_pass">Autogestión de Contraseña</a>
        <p>Gestión de personal. <b>"La seguridad somos todos"</b></p>
        <footer>
            <img src="img/white-logo.png" alt="logo_acp" class="logo_acp">
            <h6>&copy 2026. División de Protección y vigilancia</h6>
        </footer>
    </main>
    <script src="config/script.js"></script>
</body>

</html>