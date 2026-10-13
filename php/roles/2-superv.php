<?php
session_start();
require_once "../conexion.php";
require_once "../sesion.php";

/* Verificar sesión */
if (!isset($_SESSION['user_user'])) {
    header("Location: ../index.php?error=" . urlencode("Debe iniciar sesión."));
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Supervisor</title>
    <link rel="stylesheet" href="../../css/config.css">
    <link rel="stylesheet" href="../../css/2-superv.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.1/css/all.min.css">
</head>

<body>
    <header>
        <?php require_once "../header.php"; ?>
    </header>
    <main>
        <?php require_once "../roster.php"; ?>
    </main>
    <footer>
        <?php require_once "../footer.php"; ?>
    </footer>
    <script src="../../js/supervisor.js"></script>
</body>

</html>