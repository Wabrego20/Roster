<?php
session_start();
require_once "conexion.php";

$user_user = trim($_POST['user_user'] ?? '');
$password_user = $_POST['password_user'] ?? '';

/* Verificar campos vacíos */
if ($user_user === '' || $password_user === '') {
    header("Location: ../index.php?error=" . urlencode("Debe completar todos los campos."));
    exit;
}

/* Validar usuario */
if (!preg_match('/^[a-z]{2,20}[0-9]{0,3}$/', $user_user)) {
    header("Location: ../index.php?error=" . urlencode("El usuario no tiene un formato válido."));
    exit;
}

/* Validar contraseña */
if (!preg_match('/^[A-Z][a-z]{1,15}[0-9]{1,4}[!@#$%^&*]$/', $password_user)) {
    header("Location: ../index.php?error=" . urlencode("La contraseña no tiene un formato válido."));
    exit;
}

/* Buscar usuario */
$sql = "SELECT * FROM users WHERE user_user = ? LIMIT 1";
$stmt = $conexion->prepare($sql);

/* Verificar preparación */
if (!$stmt) {
    header("Location: ../index.php?error=" . urlencode("Error al preparar la consulta."));
    exit;
}

/* Vincular usuario */
$stmt->bind_param("s", $user_user);

/* Ejecutar consulta */
$stmt->execute();

/* Obtener resultado */
$resultado = $stmt->get_result();

/* Verificar usuario */
if ($resultado->num_rows === 1) {
    $usuario_bd = $resultado->fetch_assoc();

    /* Verificar contraseña */
    if (password_verify(
        $password_user,
        $usuario_bd['password_user']
    )) {

        /* Obtener rol */
        $rol_id = $usuario_bd['id_rol'];

        /* Verificar permisos */
        if ($rol_id == 1 || $rol_id == 2 || $rol_id == 3 || $rol_id == 4 || $rol_id == 5) {

            /* Crear sesión */
            $_SESSION['user_user'] = $usuario_bd['user_user'];
            $_SESSION['id_rol'] = $rol_id;

            /* Redirigir según el rol */
            if ($rol_id == 1) {
                header("Location: roles/1-admin.php");
            } elseif ($rol_id == 2) {
                header("Location: roles/2-superv.php");
            } elseif ($rol_id == 3) {
                header("Location: roles/3-asist.php");
            } elseif ($rol_id == 4) {
                header("Location: roles/4-lider.php");
            } elseif ($rol_id == 5) {
                header("Location: roles/5-guradia.php");
            }
            exit;
        } else {
            header("Location: ../index.php?error=" . urlencode("Este usuario no tiene permisos para acceder."));
            exit;
        }
    } else {
        header("Location: ../index.php?error=" . urlencode("Usuario o contraseña incorrecta."));
        exit;
    }
} else {
    header("Location: ../index.php?error=" . urlencode("Usuario o contraseña incorrecta."));
    exit;
}

/* Cerrar recursos */
$stmt->close();
$conexion->close();
