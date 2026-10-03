<?php
require_once "../config/conexion.php";
$sql = "SELECT id_puesto, nombre_puesto, numero_puesto, sector_puesto
        FROM puestos
        WHERE activo_puesto = 1
        ORDER BY numero_puesto ASC";
$resultado = $conexion->query($sql);
if (!$resultado) {
    die("Error al consultar los puestos.");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roster</title>
    <link rel="stylesheet" href="roster.css">
</head>

<body>
    <div class="roster-container">
        <!-- ENCABEZADO -->
        <div class="roster-header">
            <div>
                <h1>Protección y Vigilancia</h1>
                <p>Control de personal</p>
            </div>
            <div class="fecha-principal">
                <button class="btn-fecha">‹</button>
                <div>
                    <span>FECHA</span>
                    <strong>01/10/2026</strong>
                </div>
                <button class="btn-fecha">›</button>
            </div>
        </div>
        <!-- PESTAÑAS DE FECHAS -->

        <div class="pestanas">
            <button class="pestana activa">01 OCT</button>
            <button class="pestana">02 OCT</button>
            <button class="pestana">03 OCT</button>
            <button class="pestana">04 OCT</button>
            <button class="pestana">05 OCT</button>
            <button class="btn-nueva-fecha" id="nuevaFecha">+ Nueva fecha</button>
        </div>
        
        <!-- BOTONES DE ACCIONES -->
        <div class="acciones">
            <button class="btn editar" id="btnEditar">✎ Editar</button>
            <button class="btn guardar" id="btnGuardar">✓ Guardar</button>
            <button class="btn enviar">⇧ Enviar</button>
            <button class="btn descargar">↓ Descargar</button>
            <button class="btn imprimir" onclick="window.print()">⎙ Imprimir</button>
        </div>

        <!-- TABLA -->
        <div class="tabla-container">
            <table id="tablaRoster">
                <thead>
                    <tr>
                        <th>PUESTO</th>
                        <th>N.º PUESTO</th>
                        <th>00:00 - 08:00<span>2.º PELOTÓN</span></th>
                        <th>08:00 - 16:00<span>4.º PELOTÓN</span></th>
                        <th>16:00 - 00:00<span>1.er PELOTÓN</span></th>
                        <th>DÍA LIBRE<span>3.er PELOTÓN</span></th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($puesto = $resultado->fetch_assoc()): ?>
                        <tr>
                            <!-- NOMBRE DEL PUESTO -->
                            <td>
                                <?= htmlspecialchars($puesto['nombre_puesto']) ?>
                            </td>
                             <!-- NUMERO DEL PUESTO -->
                            <td>
                                <?= htmlspecialchars($puesto['numero_puesto']) ?>
                            </td>

                            <!-- 2.º PELOTÓN -->
                            <td contenteditable="false"></td>

                            <!-- 4.º PELOTÓN -->
                            <td contenteditable="false"></td>

                            <!-- 1.er PELOTÓN -->
                            <td contenteditable="false"></td>

                            <!-- 3.er PELOTÓN / DÍA LIBRE -->
                            <td contenteditable="false"></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="roster.js"></script>
</body>

</html>