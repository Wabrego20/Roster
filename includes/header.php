<?php
/* Conexión a la base de datos */
require_once "../config/conexion.php";
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
    "#FF4500",
    "#2196F3",
    "#4CAF50",
    "#9C27B0",
    "#FF9800",
    "#009688",
    "#E91E63",
    "#795548"
];

$colorPerfil = $colores[array_rand($colores)];
?>
<header>
    <div class="perfil">
        <div class="iniciales" style="background-color: <?php echo $colorPerfil; ?>;">
            <?php echo $inicialNombre . $inicialApellido; ?>
        </div>
        <div class="user_user">
            <?php echo "Bienvenido: "; ?>
            <span class="usr_usr"><?php echo htmlspecialchars($_SESSION['user_user']); ?></span>
        </div>
    </div>
    <a href="../config/logout.php" class="btn_logout" title="Haga clic para cerrar su sesión"><i class="fa-solid fa-right-from-bracket" style="margin-right: 5px;"></i>Cerrar Sesión</a>
</header>