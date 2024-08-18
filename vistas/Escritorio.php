<?php
/*ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit;
} else {*/
require 'header.php';

require_once "../modelos/Usuario.php";
$usuario = new Usuario();
$rsptan = $usuario->cantidad_usuario();
$reg = $rsptan->fetch_object();
$reg->nombre;
?>

<div class="home-section">
    <div class="home-content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="panel-body">
                        <div class="row">
                            <!-- Caja 1: Lista de Asistencia -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="small-box bg-green text-black">
                                    <div class="inner text-center">
                                        <h5 class="font-weight-bold">Lista de Asistencia</h5>
                                        <p>Módulo</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                    </div>
                                    <a href="Asistencia.php" class="small-box-footer bg-light text-dark py-2">
                                        Ir al módulo <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Caja 2: Empleados -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="small-box bg-orange text-black">
                                    <div class="inner text-center">
                                        <h5 class="font-weight-bold">Empleados</h5>
                                        <p>Total: <?php echo $reg->nombre; ?></p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                    <a href="Empleado.php" class="small-box-footer bg-light text-dark py-2">
                                        Agregar <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Caja 3: Reporte de Asistencias -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="small-box bg-aqua text-black">
                                    <div class="inner text-center">
                                        <h5 class="font-weight-bold">Reporte de Asistencias</h5>
                                        <p>Módulo</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                    </div>
                                    <a href="rpasistencia.php" class="small-box-footer bg-light text-dark py-2">
                                        Ver reportes <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- Fin de la fila -->
                    </div> <!-- Fin de panel-body -->
                </div> <!-- Fin de box -->
            </div> <!-- Fin de col-md-12 -->
        </div> <!-- Fin de row -->
    </div> <!-- Fin de content -->
</div> <!-- Fin de content-wrapper -->
<?php
/*}
ob_end_flush();*/
    ?>