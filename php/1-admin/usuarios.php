<?php
session_start();
require_once "../conexion.php";
require_once "../sesion.php";

/* Verificar sesión */
if (!isset($_SESSION['user_user'])) {
    header("Location: ../index.php?error=" . urlencode("Debe iniciar sesión."));
    exit;
}
/* Consultar usuarios, roles y pelotones */
$usuarios = [];
$error_consulta = '';

$sql = "SELECT u.id_user, u.nombre_user, u.apellido_user, u.user_user, u.correo_user, r.nombre_rol, p.numero_peloton, u.activo_user
        FROM users AS u LEFT JOIN roles AS r ON u.id_rol = r.id_rol LEFT JOIN pelotones AS p ON u.id_peloton = p.id_peloton ORDER BY u.id_user DESC";

$resultado = $conexion->query($sql);
if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }
    $resultado->free();
} else {
    error_log("Error al consultar usuarios: " . $conexion->error);
    $error_consulta = "No se pudieron cargar los usuarios.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icon2.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/config.css">
    <link rel="stylesheet" href="../../css/1-admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons@3.3.1/css/solid/rounded.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.1/css/all.min.css">
    <title>Panel del Administrador</title>
</head>

<body>
    <header>
        <?php require_once "../header.php"; ?>
    </header>
    <main>
        <ul>
            <li><a href="inicio.php"><i class="fa-solid fa-landmark-dome"></i>Inicio</a></li>
            <li><a href="" class="active"><i class="fa-solid fa-person-military-pointing"></i>Usuarios</a></li>
            <li><a href=""><i class="fa-solid fa-map-location-dot"></i>Sectores</a></li>
            <li><a href=""><i class="fa-solid fa-taxi"></i>Puestos</a></li>
            <li><a href=""><i class="fa-solid fa-calendar-days"></i>Periodos de Pago</a></li>
            <li><a href=""><i class="fa-solid fa-gear"></i>Configuración</a></li>
        </ul>
        <div class="seccion_estados_personal">
            <div class="admin">
                <h2>Administrador</h2>
                <?php
                date_default_timezone_set('America/Panama');
                $fecha_hoy = date('j') . ' de ' .
                    [
                        1 => 'enero',
                        2 => 'febrero',
                        3 => 'marzo',
                        4 => 'abril',
                        5 => 'mayo',
                        6 => 'junio',
                        7 => 'julio',
                        8 => 'agosto',
                        9 => 'septiembre',
                        10 => 'octubre',
                        11 => 'noviembre',
                        12 => 'diciembre'
                    ][(int) date('n')] . ' del ' . date('Y');
                ?>
                <div class="fecha-hoy">
                    <i class="fa-regular fa-calendar-days"></i>
                    <span>Hoy, <?php echo $fecha_hoy; ?></span>
                </div>
            </div>
            <div class="tabla-contenedor">
                <table class="tabla-usuarios">
                    <thead>
                        <div class="tabla-acciones">

                            <form class="buscador-usuarios" action="" method="GET">
                                <input
                                    type="search"
                                    name="buscar"
                                    placeholder="Buscar usuario..."
                                    aria-label="Buscar usuario">

                                <button type="submit" class="btn-buscar">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    Buscar
                                </button>
                            </form>

                            <a href="crear_usuario.php" class="btn-crear">
                                <i class="fa-solid fa-user-plus"></i>
                                Crear usuario
                            </a>

                        </div>
                        <tr>
                            <th>N°</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Pelotón</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): $numero = 1; ?>
                            <tr>
                                <td><?= $numero++ ?></td>
                                <td>
                                    <strong>
                                        <?= htmlspecialchars(
                                            $usuario['nombre_user'] . ' ' .
                                                $usuario['apellido_user']
                                        ) ?>
                                    </strong>
                                    <small>
                                        @<?= htmlspecialchars($usuario['user_user']) ?>
                                    </small>
                                </td>

                                <td>
                                    <?= htmlspecialchars($usuario['correo_user']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($usuario['nombre_rol']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        (string) $usuario['numero_peloton']
                                    ) ?>
                                </td>

                                <td>
                                    <?php if ((int) $usuario['activo_user'] === 1): ?>
                                        <span class="estado activo">
                                            <i class="fa-solid fa-circle-check"></i>
                                            Activo
                                        </span>
                                    <?php else: ?>
                                        <span class="estado inactivo">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            Inactivo
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a
                                        href="editar_usuario.php?id=<?= (int) $usuario['id_user'] ?>"
                                        class="btn-editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer>
        <?php require_once "../footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../js/1-admin.js"></script>
</body>

</body>

</html>