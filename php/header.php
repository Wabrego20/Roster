<?php
/* Conexión a la base de datos */
require_once "../conexion.php";
/* Usuario de la sesión */
$user_user = $_SESSION['user_user'];
/* Buscar nombre y apellido */
$sql = "SELECT nombre_user, apellido_user 
        FROM users 
        WHERE user_user = ? 
        LIMIT 1";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $user_user);
$stmt->execute();

$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

/* Verificar que el usuario exista */
if (!$usuario) {
    session_unset();
    session_destroy();

    header("Location: ../index.php?error=" . urlencode("Usuario no encontrado."));
    exit;
}

/* Obtener nombre y apellido */
$nombre = $usuario['nombre_user'];
$apellido = $usuario['apellido_user'];

/* Obtener iniciales */
$inicialNombre = strtoupper(substr($nombre, 0, 1));
$inicialApellido = strtoupper(substr($apellido, 0, 1));

/* Colores */
$colores = [
    'var(--choco)',
    'var(--oscuro)',
    'var(--fuego)',
    'var(--menta)',
    'var(--gris)',
    'var(--sol)',
    'var(--oceano)',
    'var(--mora)',
    'var(--naranja)',
    'var(--rosa)',
    'var(--zafiro)'
];

$colorPerfil = $colores[array_rand($colores)];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/config.css">
</head>

<body>
    <style>
        header {
            width: 100%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            box-shadow: 0 0 5px var(--oscuro);
            z-index: 1;
        }

        .perfil {
            margin: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }

        .iniciales {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            line-height: 40px;
            color: var(--claro);
            text-align: center;
            font-size: 25px;
        }

        .usr_usr {
            font-weight: bold;
        }

        .btn_logout:hover {
            scale: 0.99;
        }
    </style>
    <div class="perfil">
        <div class="iniciales" style="background-color: <?php echo $colorPerfil; ?>;">
            <?php echo $inicialNombre . $inicialApellido; ?>
        </div>
        <div class="user_user">
            <?php echo "Bienvenido: "; ?>
            <span class="usr_usr"><?php echo htmlspecialchars($_SESSION['user_user']); ?></span>
        </div>
    </div>
    <a href="../logout.php" class="btn logout" title="Haga clic para cerrar su sesión"><i class="fa-solid fa-right-from-bracket"></i>
        <p>Sesión</p>
    </a>
</body>

</html>