<?php
session_start();
/* Conexión a la base de datos */
require_once "conexion.php";
/* Recibir datos del formulario */

$user_user = trim($_POST['user_user'] ?? '');
$password_user = $_POST['password_user'] ?? '';

/* Verificar campos vacíos */

if ($user_user === '' || $password_user === '') {

    $conexion_mensaje = "Debe completar todos los campos.";

    header(
        "Location: ../index.php?error=" .
        urlencode($conexion_mensaje)
    );

    exit;
}


/* Validar usuario */

if (!preg_match('/^[a-z]{2,20}[0-9]{0,3}$/', $user_user)) {

    $conexion_mensaje = "El usuario no tiene un formato válido.";

    header(
        "Location: ../index.php?error=" .
        urlencode($conexion_mensaje)
    );

    exit;
}


/* Validar contraseña */

if (!preg_match(
    '/^[A-Z][a-z]{1,15}[0-9]{1,4}[!@#$%^&*]$/',
    $password_user
)) {

    $conexion_mensaje = "La contraseña no tiene un formato válido.";

    header(
        "Location: ../index.php?error=" .
        urlencode($conexion_mensaje)
    );

    exit;
}


/* Buscar usuario */

$sql = "SELECT * FROM users WHERE user_user = ? LIMIT 1";

$stmt = $conexion->prepare($sql);


/* Verificar preparación */

if (!$stmt) {

    $conexion_mensaje = "Error al preparar la consulta.";

    header(
        "Location: ../index.php?error=" .
        urlencode($conexion_mensaje)
    );

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

        if ($rol_id == 1 || $rol_id == 2 || $rol_id == 4) {

            /* Crear sesión */

            $_SESSION['user_user'] = $usuario_bd['user_user'];
            $_SESSION['id_rol'] = $rol_id;


            /* Redirigir según el rol */

            if ($rol_id == 1) {

                header("Location: ../roles/admin.php");

            } elseif ($rol_id == 2) {

                header("Location: ../roles/supervisor.php");

            } elseif ($rol_id == 4) {

                header("Location: ../roles/lider.php");
            }

            exit;

        } else {

            $conexion_mensaje =
                "Este usuario no tiene permisos para acceder.";

            header(
                "Location: ../index.php?error=" .
                urlencode($conexion_mensaje)
            );

            exit;
        }

    } else {

        $conexion_mensaje =
            "Usuario o contraseña incorrecta.";

        header(
            "Location: ../index.php?error=" .
            urlencode($conexion_mensaje)
        );

        exit;
    }

} else {

    $conexion_mensaje =
        "Usuario o contraseña incorrecta.";

    header(
        "Location: ../index.php?error=" .
        urlencode($conexion_mensaje)
    );

    exit;
}


/* Cerrar recursos */

$stmt->close();
$conexion->close();