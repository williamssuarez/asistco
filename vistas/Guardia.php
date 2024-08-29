<?php
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit;
} else {
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
                        <div class="box-header with-border step1">
                            <h1 class="box-title">Lista de Guardias
                                <div class="box-tools pull-right">

                                </div>
                        </div>
                        <!--box-header-->

                        <!--centro-->

                        <!--tabla para listar datos-->
                        <!-- Tabla para listar datos -->
                        <div class="panel-body table-responsive step2" id="listadoregistros">
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
                        <div class="box-header with-border step3">
                            <h1 class="box-title">Programación de Guardias</h1>
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

    <!-- Incluye jQuery -->

    <!-- Incluye Intro.js -->

    <script src="https://unpkg.com/intro.js/intro.js"></script>
    <!-- <script>
        introJs().setOptions({
            steps: [{
                    intro: "Bienvenido al modulo de guardias"
                }, {
                    element: document.querySelector('.step1'),
                    intro: "Aquí puedes ver la lista de guardias. Esta tabla muestra todos los guardias registrados.",
                    position: 'bottom'
                },
                {
                    element: document.querySelector('.step2'),
                    intro: 'En esta sección, puedes ver todas las guardias programadas',
                    position: 'top'
                },
                {
                    element: document.querySelector('.step3'),
                    intro: 'En esta sección, puedes ver y programar todas las guardias',
                    position: 'top'

                }
            ]
        }).start();
    </script> -->
    <?php
    require 'footer.php';
    ?>
    <script src="./scripts/Guardia.js"></script>
    <!--<script src="./scripts/calendar4Guardia2.js"></script>-->
<?php
}
ob_end_flush();
?>