<?php
require_once "../conexion.php";
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
</head>

<body>
    <div class="roster-container">
        <!-- ENCABEZADO -->
        <!-- <div class="roster-header">
            <div>
                <h1></h1>
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
        </div> -->
        <!-- PESTAÑAS DE FECHAS -->

        <!--  <div class="pestanas">
            <button class="pestana activa">01 OCT</button>
            <button class="pestana">02 OCT</button>
            <button class="pestana">03 OCT</button>
            <button class="pestana">04 OCT</button>
            <button class="pestana">05 OCT</button>
        </div> -->


        <!-- BOTONES DE ACCIONES -->
       <!--  <div class="acciones">
            <button class="btn new" id="nuevaFecha">+ Nueva fecha</button>
            <button class="btn edit" id="btnEditar"><i class="fa-solid fa-marker"></i>
                <p>Editar</p>
            </button>
            <button class="btn save" id="btnGuardar"><i class="fa-regular fa-floppy-disk"></i>
                <p>Guardar</p>
            </button>
            <button class="btn send"><i class="fa-regular fa-paper-plane"></i>
                <p>Enviar</p>
            </button>
            <button class="btn download"><i class="fa-solid fa-download"></i>
                <p>Descargar</p>
            </button>
            <button class="btn print" onclick="window.print()"><i class="fa-solid fa-print"></i>
                <p>Imprimir</p>
            </button>
        </div> -->

        <!-- TABLA -->
        <div class="tabla-container">
            <table id="tablaRoster">
                <thead>
                    <tr>
                        <th>Protección y Vigilancia</th>
                        <th>Jueves 24 de septiembre</th>
                        <th colspan="6"><p>TODA ASIGNACIÓN ESTÁ SUJETA A CAMBIOS</p><p>OPPV-SU. Creado por: (Supervisor)</p></th>
                        <th colspan="2"><p>inicia: 20 de septiembre del 2026.</p><p>Finaliza: 03 de octubre del 2026</p></th>
                    </tr>
                    <tr>
                        <th>PUESTO</th>
                        <th>N.º PUESTO</th>
                        <th>00:00 - 08:00<span>2° PELOTÓN</span></th>
                        <th>00:00 - 08:00<span>SOBRETIEMPO</span></th>
                        <th>08:00 - 16:00<span>4° PELOTÓN</span></th>
                        <th>08:00 - 16:00<span>SOBRETIEMPO</span></th>
                        <th>16:00 - 00:00<span>1° PELOTÓN</span></th>
                        <th>16:00 - 00:00<span>SOBRETIEMPO</span></th>
                        <th>DÍA LIBRE<span>3° PELOTÓN</span></th>
                        <th>VACACIONES</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($puesto = $resultado->fetch_assoc()): ?>
                        <?php
                        // Verificamos si el numero_puesto es 200, 300 o 400
                        $esEspecial = in_array($puesto['numero_puesto'], [200, 201, 300, 400]);
                        $claseFila = $esEspecial ? 'fila-gris' : '';
                        ?>
                        <tr class="<?= $claseFila ?>">
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
                            <!-- 2.º PELOTÓN SOBRETIEMPO-->
                            <td contenteditable="false"></td>

                            <!-- 4.º PELOTÓN -->
                            <td contenteditable="false"></td>
                            <!-- 4.º PELOTÓN SOBRETIEMPO-->
                            <td contenteditable="false"></td>

                            <!-- 1.er PELOTÓN -->
                            <td contenteditable="false"></td>
                            <!-- 1.er PELOTÓN SOBRETIEMPO-->
                            <td contenteditable="false"></td>

                            <!-- 3.er PELOTÓN / DÍA LIBRE -->
                            <td contenteditable="false"></td>

                            <!-- VACACIONES -->
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