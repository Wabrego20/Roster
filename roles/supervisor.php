<?php
session_start();
if (!isset($_SESSION['user_user']) || !isset($_SESSION['id_rol'])) {
    header("Location: ../index.php?error=" . urlencode("Debe iniciar sesión."));
    exit;
}
if ($_SESSION['id_rol'] != 2) {
    session_unset();
    session_destroy();
    header("Location: ../index.php?error=" . urlencode("No tiene permisos para acceder."));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    hollaaaaaaa word
    <a href="../config/logout.php">Cerrar sesión</a>
</body>

</html>