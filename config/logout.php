<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: ../index.php?error=" . urlencode("Sesión cerrada correctamente."));
exit;