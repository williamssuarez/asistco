<?php

session_start();
require_once "../modelos/Usuario.php";

// Asegúrate de definir o incluir la función limpiarCadena


$usuario = new Usuario();

$id = isset($_POST["idusuario"]) ? limpiarCadena($_POST["idusuario"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$apellido = isset($_POST["apellido"]) ? limpiarCadena($_POST["apellido"]) : "";
$login = isset($_POST["login"]) ? limpiarCadena($_POST["login"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$password = isset($_POST["clave"]) ? limpiarCadena($_POST["clave"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        // Verifica si se ha subido un archivo
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $imagen = $_POST["imagenactual"];
        } else {
            $ext = explode(".", $_FILES['imagen']['name']);
            $allowed_types = ['image/jpg', 'image/jpeg', 'image/png'];
            if (in_array($_FILES['imagen']['type'], $allowed_types)) {
                $imagen = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
            } else {
                $imagen = $_POST["imagenactual"];
            }
        }

        $clavehash = !empty($password) ? hash("sha256", $password) : "";

        if (empty($id)) {
            $rspta = $usuario->insertar($nombre, $apellido, $login, $email, $clavehash, $imagen);
            echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar todos los datos del usuario";
        } else {
            $rspta = $usuario->editar($id, $nombre, $apellido, $login, $email, $clavehash, $imagen);
            echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
        }
        break;

    case 'desactivar':
        $rspta = $usuario->desactivar($id);
        echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
        break;

    case 'activar':
        $rspta = $usuario->activar($id);
        echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
        break;

    case 'mostrar':
        $rspta = $usuario->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $usuario->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->estado)
                    ? '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>'
                    . ' '
                    . '<button class="btn btn-danger btn-xs" onclick="desactivar(' . $reg->id . ')"><i class="fa fa-close"></i></button>'
                    : '<button class="btn btn-primary btn-xs" onclick="activar(' . $reg->id . ')"><i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->apellido,
                "3" => $reg->login,
                "4" => $reg->email,
                "5" => "<img src='../files/usuarios/" . $reg->imagen . "' height='50px' width='50px'>",
                "6" => ($reg->estado) ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'
            );
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($results);
        break;

    case 'verificar':
        if (isset($_POST['logina']) && isset($_POST['clavea'])) {
            $logina = limpiarCadena($_POST['logina']);
            $clavea = limpiarCadena($_POST['clavea']);

            $clavehash = hash("sha256", $clavea);
            $rspta = $usuario->verificar($logina, $clavehash);
            $fetch = $rspta->fetch_object();

            if ($fetch) {
                $_SESSION['idusuario'] = $fetch->id;
                $_SESSION['nombre'] = $fetch->nombre;
                $_SESSION['imagen'] = $fetch->imagen;
                $_SESSION['login'] = $fetch->login;
            }

            echo json_encode($fetch);
        } else {
            echo json_encode(["error" => "Faltan datos de entrada"]);
        }
        break;

    case 'salir':
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        break;
}
