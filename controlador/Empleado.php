<?php

require_once "../modelos/Empleado.php";

$empleado = new Empleado();

$empleado_id = isset($_POST["empleado_id"]) ? limpiarCadena($_POST["empleado_id"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$apellido = isset($_POST["apellido"]) ? limpiarCadena($_POST["apellido"]) : "";
$documento_numero = isset($_POST["documento_numero"]) ? limpiarCadena($_POST["documento_numero"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$codigo = isset($_POST["codigo"]) ? limpiarCadena($_POST["codigo"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($empleado_id)) {
            $rspta = $empleado->insertar($nombre, $apellido, $documento_numero, $telefono, $codigo);
            echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
        } else {
            $rspta = $empleado->editar($empleado_id, $nombre, $apellido, $documento_numero, $telefono, $codigo);
            echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
        }
        break;

    case 'mostrar':
        $rspta = $empleado->mostrar($empleado_id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $empleado->listar();
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->apellido,
                "3" => $reg->documento_numero,
                "4" => $reg->telefono,
                "5" => $reg->codigo
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

    case 'select_empleado':
        $rspta = $empleado->listar();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value="' . $reg->id . '">' . $reg->nombre . ' ' . $reg->apellido . '</option>';
        }
        break;
}
?>

