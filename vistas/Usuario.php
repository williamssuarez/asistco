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
<div class="home-section ">
    <!-- Main content -->
    <section class="home-content">
        <!-- Default box -->
        <div class="row">
            <!-- /.col-md-12 -->
            <div class="col-md-12">
                <!-- Box -->
                <div class="box">
                    <!-- Box header -->
                    <div class="box-header with-border">
                        <h1 class="box-title">Lista de Usuarios
                            <button class="btn btn-success" onclick="mostrarform(true)" id="btnAgregar">
                                <i class="fa fa-plus-circle"></i> Agregar
                            </button>
                        </h1>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <!-- Centro -->
                    <div class="panel-body table-responsive " id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Formulario para datos -->
                    <div class="panel-body" id="formularioregistro">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="nombre">Nombre ( * ):</label>
                                <input type="hidden" class="form-control" name="idusuario" id="idusuario">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="apellido">Apellido ( * ):</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" maxlength="100" placeholder="Apellido" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="email">Email ( * ):</label>
                                <input type="email" class="form-control" name="email" id="email" maxlength="100" placeholder="Email" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="login">Login ( * ):</label>
                                <input type="text" class="form-control" name="login" id="login" maxlength="100" placeholder="Login" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="clave">Clave de ingreso ( * ):</label>
                                <input type="password" class="form-control" name="clave" id="clave" maxlength="100" placeholder="Clave">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="imagen">Imagen ( * ):</label>
                                <input class="form-control filestyle" data-buttonText="Seleccionar Foto" type="file" name="imagen" id="imagen">
                                <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                                <img src="" alt="" width="150px" height="120px" id="imagenmuestra">
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
                </div>
                <!-- Fin Box -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- Fin Default-box -->
    </section>
    <!-- /.content -->
</div>
<!-- FIN CONTENIDO -->

<?php
require 'footer.php';
?>
<script src="./scripts/Usuario.js"></script>
<?php
 /*}
ob_end_flush();*/
?>