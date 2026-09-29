<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "roster";

$conexion = new mysqli(
    $servidor,
    $usuario,
    $password,
    $base_datos
);

/* Verificar conexión */
if ($conexion->connect_error) {
    $conexion_mensaje = "Error de conexión con la base de datos.";
    header("Location: ../index.php?error=" . urlencode($conexion_mensaje));
    exit;
}

/* Recibir datos del formulario */
$user_user = $_POST['user_user'] ?? '';
$password_user = $_POST['password_user'] ?? '';

/* Buscar usuario */
$sql = "SELECT * FROM users WHERE user_user = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $user_user);
$stmt->execute();

$resultado = $stmt->get_result();

/* Verificar usuario */
if ($resultado->num_rows === 1) {
    $usuario_bd = $resultado->fetch_assoc();

    /* Verificar contraseña */
    if (password_verify($password_user, $usuario_bd['password_user'])) {
        /* Verificar rol */
        $rol_id = $usuario_bd['id_rol'];

        if ($rol_id == 1 || $rol_id == 2 || $rol_id == 4) {
            session_start();
            $_SESSION['user_user'] = $usuario_bd['user_user'];
            $_SESSION['id_rol'] = $rol_id;

            /* Redirigir según el rol */
            if ($rol_id == 1) {
                header("Location: ../admin.php");
            } elseif ($rol_id == 2) {
                header("Location: ../roles/supervisor.php");
            } elseif ($rol_id == 4) {
                header("Location: ../lider.php");
            }
            exit;
        } else {
            $conexion_mensaje = "Este usuario no tiene permisos para acceder.";
            header(
                "Location: ../index.php?error=" .
                    urlencode($conexion_mensaje)
            );

            exit;
        }
    } else {
        $conexion_mensaje = "Usuario o contraseña incorrecta.";
        header(
            "Location: ../index.php?error=" .
                urlencode($conexion_mensaje)
        );
        exit;
    }
} else {
    $conexion_mensaje = "Usuario o contraseña incorrecta.";
    header(
        "Location: ../index.php?error=" .
            urlencode($conexion_mensaje)
    );
    exit;
}
