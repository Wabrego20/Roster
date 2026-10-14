<?php
session_start();
require_once "../conexion.php";
require_once "../sesion.php";

/* Verificar sesión */
if (!isset($_SESSION['user_user'])) {
    header("Location: ../index.php?error=" . urlencode("Debe iniciar sesión."));
    exit;
}
// Sectores que deben aparecer siempre en la gráfica
$sectores = ['A', 'B', 'C', 'G'];
$puestosActivos = array_fill_keys($sectores, 0);

// Consultar los puestos activos agrupados por sector
$sql = "SELECT sector_puesto, COUNT(*) AS total
        FROM puestos
        WHERE activo_puesto = 1
          AND sector_puesto IN ('A', 'B', 'C', 'G')
        GROUP BY sector_puesto";

$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $puestosActivos[$fila['sector_puesto']] =
            (int) $fila['total'];
    }
}

// Preparar datos para Chart.js
$datosGrafica = array_values($puestosActivos);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icon2.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/config.css">
    <link rel="stylesheet" href="../../css/1-admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.1/css/all.min.css">
    <title>Panel del Administrador</title>
</head>

<body>
    <header>
        <?php require_once "../header.php"; ?>
    </header>
    <main>
        <ul>
            <li><a href="" class="active"><i class="fa-solid fa-landmark-dome"></i>Inicio</a></li>
            <li><a href=""><i class="fa-solid fa-person-military-pointing"></i>Usuarios</a></li>
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
            <div class="seccion_estados">
                <h3>Estado del Personal</h3>
                <div class="seccion_cards">
                    <div class="card save">
                        <i class="fa-solid fa-helmet-safety"></i>
                        <div class="card_estado">
                            <h3>0</h3>
                            <h4>Trabajando</h4>
                            <h5>0%</h5>
                        </div>
                    </div>
                    <div class="card send">
                        <i class="fa-solid fa-face-grin-wide"></i>
                        <div class="card_estado">
                            <h3>0</h3>
                            <h4>Libres</h4>
                            <h5>0%</h5>
                        </div>
                    </div>
                    <div class="card wait">
                        <i class="fa-solid fa-suitcase-rolling"></i>
                        <div class="card_estado">
                            <h3>0</h3>
                            <h4>Vacaciones Programadas</h4>
                            <h5>0%</h5>
                        </div>
                    </div>
                    <div class="card delete">
                        <i class="fa-solid fa-person-circle-xmark"></i>
                        <div class="card_estado">
                            <h3>0</h3>
                            <h4>Vacaciones No Programadas</h4>
                            <h5>0%</h5>
                        </div>
                    </div>
                    <div class="card flor">
                        <i class="fa-solid fa-user-clock"></i>
                        <div class="card_estado">
                            <h3>0</h3>
                            <h4>Promoción Temporal</h4>
                            <h5>0%</h5>
                        </div>
                    </div>
                    <div class="card edit">
                        <i class="fa-solid fa-id-badge"></i>
                        <div class="card_estado">
                            <h3>0</h3>
                            <h4>Licencias</h4>
                            <h5>0%</h5>
                        </div>
                    </div>
                    <div class="card download">
                        <i class="fa-solid fa-users"></i>
                        <div class="card_estado">
                            <h3>0</h3>
                            <h4>Total</h4>
                            <h5>0%</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="seccion_eventos">
                <div class="grafica-card">
                    <h3>Puestos Activos vs Sector</h3>
                    <div class="grafica-contenedor">
                        <canvas
                            id="graficaPuestos"
                            data-puestos="<?= htmlspecialchars(json_encode($datosGrafica), ENT_QUOTES, 'UTF-8') ?>">
                        </canvas>
                    </div>
                </div>
                <div class="poligono">
                    <h2>Polígono Hoy</h2>
                    <div class="poligono_cards">
                        <div class="card card1">
                            <div class="titulo">
                                <i class="fa-solid fa-person-military-rifle"></i>
                                <h4>Instructores</h4>
                            </div>
                            <h1>0</h1>
                        </div>
                        <div class="card card2">
                            <div class="titulo">
                                <i class="fa-solid fa-person-rifle"></i>
                                <h4>Tiradores</h4>
                            </div>
                            <h1>0</h1>
                        </div>
                        <div class="card card3">
                            <div class="titulo">
                                <i class="fa-solid fa-person-military-to-person"></i>
                                <h4>Personal Total</h4>
                            </div>
                            <h1>0</h1>
                        </div>
                    </div>
                </div>
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