<?php

session_start();

require_once "../config/conexion.php";

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
    <link rel="stylesheet" href="../css/supervisor.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.1/css/all.min.css">
</head>

<body>
    <?php require_once "../includes/header.php";?>
    <main>
        <?php require_once "../includes/roster.php";?>
    </main>
    <?php require_once "../includes/footer.php";?>
    <script src="../js/supervisor.js"></script>
</body>

</html>