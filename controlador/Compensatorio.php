<?php

require_once "../modelos/Compensatorio.php";
require_once "../modelos/CompensatoriosUsuarios.php";

$compensatorio = new Compensatorio();
$compensatorioUsuario = new CompensatoriosUsuarios();

$id = isset($_POST["idcompensatorio"]) ? limpiarCadena($_POST["idcompensatorio"]) : "";

$observaciones = isset($_POST["observaciones"]) ? limpiarCadena($_POST["observaciones"]) : "";
$user_id = isset($_POST["user_id"]) ? limpiarCadena($_POST["user_id"]) : "";
$fecha = isset($_POST["fecha"]) ? limpiarCadena($_POST["fecha"]) : "";
$fecha_fin = isset($_POST["fecha_fin"]) ? limpiarCadena($_POST["fecha_fin"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        $formErrors = [];

            //Validar que fechas no esten vacias
            if (!$fecha) {
                $formErrors[] = 'Fecha de inicio invalida';
            }

            //Si el usuario seleccionado tiene 0 compensatorios pendientes no permitir la insercion
            $rspta = $compensatorioUsuario->obtener_compensatorios_usuario($user_id);
            $result = $rspta->fetch_object();

            if($result->totales == 0){
                $formErrors[] = 'Este usuario ya tiene todos sus compensatorios programados, cancele los actuales o marquelos como terminados para continuar agregando mas compensatorios.';
            }


            if (!empty($formErrors)){
                http_response_code(404); // disparar el error del ajax

                $jsonResponse = [
                    'success' => false,
                    'errors' => $formErrors // mandar array con los errores
                ];

                echo json_encode($jsonResponse);
                exit;
            } else {

                $rspta = $compensatorio->insertar($user_id, $fecha, $observaciones);

                //Restarle 1 a los compensatorios pendientes del usuario
                $consulta2 = $compensatorioUsuario->obtener_compensatorios_usuario($user_id)->fetch_object();
                $compensatorios_actuales = $consulta2->totales - 1;

                //insertar en los compensatorios
                $consulta3 = $compensatorioUsuario->editarcompensatorios($user_id, $compensatorios_actuales);

                $jsonResponse = [
                    'success' => true,
                    'semaforo' => 'verde'
                ];

                echo json_encode($jsonResponse);
            }
        break;
    case 'getcompensatorioform':

        $formFile = '../vistas/newCompensatorioForm.html';
        $formHtml = file_get_contents($formFile);

        echo $formHtml;
        break;
    case 'compensatoriosCalendario':
        //Obtener compensatorios para el calendario
        $rspta = $compensatorio->listar();
        $data = array();
        $formattedEvents = [];

        while ($reg = $rspta->fetch_object()) {

            $status = $reg->estado;
            $backgroundColor = '';
            $textColor = '';

            if ($status == 0) {
                $backgroundColor = '#FFC107';//Pendiente = amarillo
                $textColor = '#1F2D3D';
            } elseif ($status == 1) {
                $backgroundColor = '#008000'; //Terminada = exito
                $textColor = '';
            } elseif ($status == 2) {
                $backgroundColor = 'red'; // Default color
                $textColor = '';
            }
            $formattedEvents[] = [
                "id" => $reg->id,
                "title" => $reg->usuarios,
                "start" => $reg->fecha,
                "end" => $reg->fecha,
                "backgroundColor" => $backgroundColor,
                "textColor" => $textColor
            ];
        }

        echo json_encode($formattedEvents);
        break;
    case 'listar':
        $rspta = $compensatorio->listar();
        $data = array();

        while ($reg = $rspta->fetch_object()) {

            $fecha = DateTime::createFromFormat('Y-m-d', $reg->fecha)->format('d/m/Y');
            $label1 = '';
            $label2 = '';

            if($reg->estado == 0){
                $label1 = '<button title="Terminar compensatorio" class="btn btn-success btn-xs" onclick="terminar(' . $reg->id . ')"><i class="fa fa-check"></i></button>'
                    . ' '
                    . '<button title="Cancelar compensatorio" class="btn btn-danger btn-xs" onclick="cancelar(' . $reg->id . ')"><i class="fa fa-trash"></i></button>';
                $label2 = '<span class="label bg-yellow"> Pendiente </span>';
            } elseif($reg->estado == 1){
                $label1 = '<span class="label bg-green"> Terminada </span>';
                $label2 = '<span class="label bg-green"> Terminada </span>';
            } else {
                $label1 = '<span class="label bg-red"> Cancelada </span>';
                $label2 = '<span class="label bg-red"> Cancelada </span>';
            }

            $data[] = array(
                "0" => $label1,
                "1" => $reg->usuarios,
                "2" => $fecha,
                "3" => $reg->observaciones,
                "4" => $label2
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
    case 'listarCompensatorioUsuarios':
        $rspta = $compensatorioUsuario->listar();
        $data = array();

        while ($reg = $rspta->fetch_object()) {

            $total = $reg->compensatorios_totales;
            $label1 = '';
            $label2= '';
            if($total == 0){
                $label1 = '<span class="label bg-red"> Sin compensatorios </span>';
                $label2 = '<span class="label bg-red"> Sin compensatorios </span>';
            } else {
                $label1 = '<span class="label bg-green"> Compensatorios disponibles </span>';
                $label2 = '<span class="label bg-green"> Compensatorios disponibles </span>';
            }

            $data[] = array(
                "0" => $label1,
                "1" => $reg->usuarios,
                "2" => $reg->compensatorios_totales,
                "3" => $label2
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
    case 'cancelar':
        $rspta = $compensatorio->cancelar($id);

        //Obtener id de usuario por id de compensatorio
        $consulta1 = $compensatorio->obtener_useridby_compensatorioid($id)->fetch_object();
        $user_id = $consulta1->usuario;

        //Obtener compensatorios totales del usuario y sumarle 1
        $consulta2 = $compensatorioUsuario->obtener_compensatorios_usuario($user_id)->fetch_object();
        $compensatorios_actuales = $consulta2->totales + 1;

        //insertar en los compensatorios
        $consulta3 = $compensatorioUsuario->editarcompensatorios($user_id, $compensatorios_actuales);
        echo $rspta ? "Datos cancelados correctamente" : "No se pudieron cancelar los datos";
    break;
    case 'terminar':
        $rspta = $compensatorio->terminar($id);
        echo $rspta ? "compensatorio terminado correctamente" : "No se pudieron actualizar los datos";
    break;
}
?>
