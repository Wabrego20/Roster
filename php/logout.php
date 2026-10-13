<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: ../index.php?success=" . urlencode("Sesión cerrada correctamente."));
exit;