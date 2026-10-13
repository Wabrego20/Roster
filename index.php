<?php require_once "php/conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roster-OPPV</title>
    <link rel="stylesheet" href="css/config.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.1/css/all.min.css">
</head>

<body>
    <style>
        body {
            min-height: 100vh;
            width: 40%;
            background-image: url("img/fondo.png");
            background-repeat: no-repeat;
            background-size: auto 100%;
            background-position: left;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: column;
            min-width: 56%;
            max-width: 100%;
            min-height: 100vh;
            background-color: var(--choco);
            position: absolute;
            right: 0;
            top: 0;
            gap: 10px;
            color: var(--oscuro);
        }

        main h3,
        p {
            max-width: 95%;
        }

        .logo_oppv {
            width: 120px;
            height: 120px;
            box-shadow: 0 0 10px var(--claro);
            border-radius: 50%;
            margin-top: 10px;
        }

        .form_login {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 95%;
            flex-direction: column;
            gap: 10px;
        }

        .form_login input {
            max-width: 100%;
            width: 300px;
            border: 2px solid var(--claro);
            padding: 10px 7px;
            border-radius: 6px;
            outline: none;
            transition: 0.3s;
        }

        .form_login span {
            position: relative;
        }

        .form_login span .fa-eye,
        .fa-eye-slash {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translate(-50%, -50%);
            cursor: pointer;
        }

        .form_login input:focus {
            border: 2px solid var(--oscuro);
        }

        input[type="submit"] {
            background-color: var(--oscuro);
            border: 2px solid var(--oscuro);
            color: var(--claro);
            cursor: pointer;
            transition: 0.3s;
            padding: 10px 7px;
        }

        input[type="submit"]:hover {
            scale: 0.99;
        }

        .aut_pass {
            color: var(--claro);
            transition: 0.3s;
        }

        .aut_pass:hover {
            scale: 0.99;
        }

        footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 95%;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .logo_acp {
            width: 200px;
        }

        .fa-right-from-bracket {
            margin-right: 5px;
        }

        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
    </style>
    <main>
        <img src="img/logo_oppv.png" alt="logo_oppv" class="logo_oppv">
        <h3>Inicie sesión con sus datos de la organización</h3>
        <form action="php/login.php" method="post" class="form_login">
            <input type="text" name="user_user" placeholder="usuario" pattern="[a-z]{2,20}[0-9]{0,3}"
                title="Solo letras minúsculas y máximo 3 números. No se permiten caracteres especiales."
                required autofocus>
            <span>
                <input type="password" name="password_user" id="password_user" placeholder="contraseña"
                    pattern="^[A-Z]{1}[a-z]{1,15}[0-9]{1,4}[!@#$%^&*]{1}$"
                    title="Debe contener 1 mayúscula, de 1 a 15 minúsculas, de 1 a 4 números y 1 carácter especial."
                    required>
                <i class="fa-regular fa-eye" id="togglePassword"></i>
            </span>
            <input type="submit" value="Iniciar Sesión">
            <div class="error_user">
                <?php if (isset($_GET['error'])) {
                    echo htmlspecialchars($_GET['error']);
                } ?>
            </div>
            <div class="success_user">
                <?php if (isset($_GET['success'])) {
                    echo htmlspecialchars($_GET['success']);
                } ?>
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
    <script src="js/script.js"></script>
</body>

</html>