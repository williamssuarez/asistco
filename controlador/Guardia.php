<?php

require_once "../modelos/Guardia.php";
$guardia = new Guardia();

$id = isset($_POST["idguardia"]) ? limpiarCadena($_POST["idguardia"]) : "";

$observaciones = isset($_POST["observaciones"]) ? limpiarCadena($_POST["observaciones"]) : "";
$user_id = isset($_POST["user_id"]) ? limpiarCadena($_POST["user_id"]) : "";
$fecha_inicio = isset($_POST["fecha_inicio"]) ? limpiarCadena($_POST["fecha_inicio"]) : "";
$fecha_fin = isset($_POST["fecha_fin"]) ? limpiarCadena($_POST["fecha_fin"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($guardia_id)) {
            $formErrors = [];

            if (!$fecha_inicio) {
                $formErrors[] = 'Fecha de inicio invalida';
            }
            if (!$fecha_fin) {
                $formErrors[] = 'Fecha de finalizacion invalida';
            }
            $fechaInicio = new DateTime($fecha_inicio);
            $fechaFin = new DateTime($fecha_fin);
            if ($fechaInicio && $fechaFin && $fechaInicio > $fechaFin) {
                $formErrors[] = 'La fecha del final de la guardia no puede ser anterior a la fecha de inicio, verifique.';
            }

            if (!empty($formErrors)){
                $errorsString = implode(",", $formErrors);
                http_response_code(404);

                echo json_encode($errorsString);
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

            $fecha_inicio = DateTime::createFromFormat('Y-m-d H:i:s', $reg->fecha_inicio)->format('d/m/Y H:i');
            $fecha_fin = DateTime::createFromFormat('Y-m-d H:i:s', $reg->fecha_fin)->format('d/m/Y H:i');

            $data[] = array(
                "0" => '<button title="Terminar Guardia" class="btn btn-success btn-xs" onclick="terminar(' . $reg->id . ')"><i class="fa fa-check"></i></button>'
                    . ' '
                    .'<button title="Cancelar Guardia" class="btn btn-danger btn-xs" onclick="cancelar(' . $reg->id . ')"><i class="fa fa-trash"></i></button>',
                //"0" => $reg->id,
                "1" => $reg->usuarios,
                "2" => $fecha_inicio,
                "3" => $fecha_fin,
                "4" => $reg->observaciones,
                "5" => ($reg->isDone == 0) ? '<span class="label bg-orange"> Pendiente </span>' : '<span class="label bg-green"> Terminada </span>',
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
        $rspta = $guardia->cancelar($id);
        echo $rspta ? "Datos eliminados correctamente" : "No se pudieron eliminar los datos";
    break;
    case 'terminar':
        $rspta = $guardia->terminar($id);
        echo $rspta ? "Guardia terminada correctamente" : "No se pudieron actualizar los datos";
    break;
}
?>
