<?php
// Descomentar estas líneas si necesitas controlar el acceso de sesión
/*ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
 header("Location: login.html");
 exit;
} else {*/
require 'header.php';
?>

<!-- CONTENIDO -->
<div class="home-section">

    <!-- Main content -->
    <section class="home-content">

        <!-- Default box -->
        <div class="row">

            <!-- /.col-md-12 -->
            <div class="col-md-12">

                <!-- fin box -->
                <div class="box">

                    <!-- box-header -->
                    <div class="box-header with-border">
                        <h1 class="box-title">
                            Lista de Empleados
                            <button class="btn btn-success" onclick="mostrarform(true)" id="btnAgregar">
                                <i class="fa fa-plus-circle"></i> Agregar
                            </button>
                        </h1>
                        <div class="box-tools pull-right">
                            <!-- Herramientas adicionales -->
                        </div>
                    </div>
                    <!-- /box-header -->

                    <!-- centro -->

                    <!-- tabla para listar datos -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Documento</th>
                                    <th>Telefono</th>
                                    <th>Codigo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Contenido dinámico aquí -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Documento</th>
                                    <th>Telefono</th>
                                    <th>Codigo</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Fin tabla para listar datos -->

                    <!-- Formulario para datos -->
                    <div class="panel-body" id="formularioregistro">
                        <form action="" name="formulario" id="formulario" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="nombre">Nombre ( * ):</label>
                                <input type="hidden" class="form-control" name="empleado_id" id="empleado_id">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="apellido">Apellido ( * ):</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" maxlength="100" placeholder="Apellido" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="documento_numero">N° Documento ( * ):</label>
                                <input type="text" class="form-control" name="documento_numero" id="documento_numero" maxlength="100" placeholder="N° Documento" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="telefono">Telefono ( * ):</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" maxlength="100" placeholder="Telefono" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="codigo">Código de asistencia ( * ):</label>
                                <input type="password" class="form-control" name="codigo" id="codigo" maxlength="100" placeholder="Código de Asistencia" required>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar">
                                    <i class="fa fa-save"></i> Guardar
                                </button>
                                <button class="btn btn-danger" onclick="cancelarform()" type="button">
                                    <i class="fa fa-arrow-circle-left"></i> Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Fin formulario para datos -->

                    <!-- fin centro -->

                </div>
                <!-- fin box -->

            </div>
            <!-- /.col-md-12 -->

        </div>
        <!-- fin Default-box -->

    </section>
    <!-- /.content -->

</div>
<!-- FIN CONTENIDO -->

<?php
require 'footer.php';
?>
<script src="./scripts/Empleado.js"></script>
<?php
/*}
 ob_end_flush();*/
?>