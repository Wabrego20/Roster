
<?php
$servidor = getenv("MYSQLHOST");
$usuario = getenv("MYSQLUSER");
$password = getenv("MYSQLPASSWORD");
$base_datos = getenv("MYSQLDATABASE");
$puerto = (int) getenv("MYSQLPORT");

$conexion = new mysqli(
    $servidor,
    $usuario,
    $password,
    $base_datos,
    $puerto
);

if ($conexion->connect_error) {
    error_log("Error de conexión MySQL: " . $conexion->connect_error);
    die("Error de conexión con la base de datos.");
}

$conexion->set_charset("utf8mb4");

