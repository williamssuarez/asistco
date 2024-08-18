<?php

require_once "../modelos/Guardia.php";
$guardia = new Guardia();

$guardia_id = isset($_POST["guardia_id"]) ? limpiarCadena($_POST["guardia_id"]) : "";

$observaciones = isset($_POST["observaciones"]) ? limpiarCadena($_POST["observaciones"]) : "";
$user_id = isset($_POST["user_id"]) ? limpiarCadena($_POST["user_id"]) : "";
$fecha_inicio = isset($_POST["fecha_inicio"]) ? limpiarCadena($_POST["fecha_inicio"]) : "";
$fecha_fin = isset($_POST["fecha_fin"]) ? limpiarCadena($_POST["fecha_fin"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($guardia_id)) {
            $formErrors = [];
            /*$fechaInicio = \DateTime::createFromFormat('d/m/Y H:i', $fecha_inicio);
            $fechaFin = \DateTime::createFromFormat('d/m/Y H:i', $fecha_fin);

            if (!$fechaInicio) {
                $formErrors[] = 'Fecha de inicio invalida';
            }
            if (!$fechaFin) {
                $formErrors[] = 'Fecha de finalización invalida';
            }
            if ($fechaInicio && $fechaFin && $fechaInicio > $fechaFin) {
                $formErrors[] = 'La fecha del final de la guardia no puede ser anterior a la fecha de inicio, verifique.';
            }*/

            if (!empty($formErrors)){
                $jsonResponse = [
                    'error' => 'Resource not found',
                    'formErrors' => $formErrors
                ];

                echo json_encode($jsonResponse);
            } else {

                $rspta = $guardia->insertar($user_id, $fecha_inicio, $fecha_fin, $observaciones);
                /*echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";*/

                $jsonResponse = [
                    'success' => true,
                    'semaforo' => 'verde'
                ];

                echo json_encode($jsonResponse);
            }
        } else {
            $rspta = $guardia->editar($guardia_id, $user_id, $fecha_inicio, $fecha_fin, $observaciones);
            echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
        }
        break;
    case 'getguardiaform':

        $formFile = '../vistas/newGuardiaForm.html';
        $formHtml = file_get_contents($formFile);

        echo $formHtml;
        break;
    case 'guardiasCalendario':
        $rspta = $guardia->listar();
        $data = array();
        $formattedEvents = [];

        /*foreach ($rspta->fetch_object() as $respuesta){
            $formattedEvents[] = [
                //'id' => $respuesta['id'],
                'title' => $respuesta['nombre'] . " " . $respuesta['apellido'],
                'start' => $respuesta['fecha_inicio'],
                'end' => $respuesta['fecha_fin'],
                /*'extendedProps' => [
                    'description' => $event->getObservaciones()
                ],
                'backgroundColor' => $backgroundColor,
                'textColor' => $textColor,
            ];
        }*/

        while ($reg = $rspta->fetch_object()) {
            $formattedEvents[] = [
                "id" => $reg->id,
                "title" => $reg->usuarios,
                "start" => $reg->fecha_inicio,
                "end" => $reg->fecha_fin,
                //"4" => $reg->observaciones,
            ];
        }

        echo json_encode($formattedEvents);
        break;
    case 'listar':
        $rspta = $guardia->listar();
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                //"0" => '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>',
                "0" => $reg->id,
                "1" => $reg->usuarios,
                "2" => $reg->fecha_inicio,
                "3" => $reg->fecha_fin,
                "4" => $reg->observaciones,
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
}
?>
