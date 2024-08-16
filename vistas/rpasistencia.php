<?php
// ob_start();
// session_start();
// if (!isset($_SESSION['nombre'])) {
//     header("Location: login.html");
//     exit;
// } else {
require 'header.php';

// require_once "../config/Global.php";
// date_default_timezone_set(ZONA_HORARIA);
// require 'header.php';
?>
<!--CONTENIDO -->
<div class="home-section">

    <!-- Main content -->
    <section class="home-content">

        <!-- Default box -->
        <div class="row">

            <!-- /.col-md12 -->
            <div class="col-md-12">

                <!--fin box-->
                <div class="box">

                    <!--box-header-->
                    <div class="box-header with-border">
                        <h1 class="box-title">Reporte de asistencia por fechas</h1>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <!--box-header-->

                    <!--centro-->

                    <!--tabla para listar datos-->
                    <!-- Tabla para listar datos -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <div class="form-group col-lg-3 col-sm-6 col-xs-12">
                            <label>Fecha Inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="form-group col-lg-3 col-sm-6 col-xs-12">
                            <label>Fecha Fin</label>
                            <input type="date" class="form-control" name="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="form-inline col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Empleados</label>
                            <select name="empleado_id" id="empleado_id" class="form-control selectpicker" data-live-search="true" required>
                            </select>
                            <br>
                            <button class="btn btn-success" onclick="listar();">
                                Mostrar
                            </button>
                        </div>

                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Códigos</th>
                                        <th>Empleados</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Tipo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Códigos</th>
                                        <th>Empleados</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Tipo</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <!-- Fin tabla para listar datos -->

                    <!-- Formulario para datos -->
                    <!-- Fin formulario para datos -->

                    <!--fin formulatio para datos-->

                    <!--fin centro-->

                </div>
                <!--fin box-->

            </div>
            <!-- /.col-md12 -->

        </div>
        <!-- fin Default-box -->

    </section>
    <!-- /.content -->

</div>
<!--FIN CONTENIDO -->

<?php
require 'footer.php';
?>
<script src="./scripts/rpasistencia.js"></script>
<?php
// }
// ob_end_flush();
?>