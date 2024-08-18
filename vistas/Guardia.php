<?php
/*ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
exit;
} else {*/
    require 'header.php';
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
                            <h1 class="box-title">Lista de Guardias
                                <div class="box-tools pull-right">

                                </div>
                        </div>
                        <!--box-header-->

                        <!--centro-->

                        <!--tabla para listar datos-->
                        <!-- Tabla para listar datos -->
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- Fin tabla para listar datos -->
                        <!--fin centro-->

                    </div>
                    <!--fin box-->

                </div>
                <!-- /.col-md12 -->

                <!-- CALENDARIO INICIA AQUI -->

                <!-- /.col-md12 -->
                <div class="col-md-12">

                    <!--fin box-->
                    <div class="box">

                        <!--box-header-->
                        <div class="box-header with-border">
                            <h1 class="box-title">Lista de Guardias</h1>
                        </div>
                        <!--box-header-->

                        <!--centro-->

                        <!--tabla para listar datos-->
                        <!-- Tabla para listar datos -->
                        <div class="panel-body">
                            <div id="calendar">

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
    <script src="./scripts/Guardia.js"></script>
    <!--<script src="./scripts/calendar4Guardia2.js"></script>-->
<?php
/*}
ob_end_flush();*/
?>