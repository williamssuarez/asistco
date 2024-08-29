<?php

require_once "../modelos/Guardia.php";
require_once "../modelos/CompensatoriosUsuarios.php";
$guardia = new Guardia();
$compensatorioUsuario = new CompensatoriosUsuarios();

$id = isset($_POST["idguardia"]) ? limpiarCadena($_POST["idguardia"]) : "";

$observaciones = isset($_POST["observaciones"]) ? limpiarCadena($_POST["observaciones"]) : "";
$user_id = isset($_POST["user_id"]) ? limpiarCadena($_POST["user_id"]) : "";
$fecha_inicio = isset($_POST["fecha_inicio"]) ? limpiarCadena($_POST["fecha_inicio"]) : "";
$fecha_fin = isset($_POST["fecha_fin"]) ? limpiarCadena($_POST["fecha_fin"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        $formErrors = [];

        //Validar que fechas no esten vacias
        if (!$fecha_inicio) {
            $formErrors[] = 'Fecha de inicio invalida';
        }
        if (!$fecha_fin) {
            $formErrors[] = 'Fecha de finalizacion invalida';
        }

        //Validaciones de fechas
        $timezone = new DateTimeZone('America/Caracas');
        $fechaInicio = new DateTime($fecha_inicio, $timezone); //Convirtiendo los string de fechas del form, en objetos de fecha para validarlos como fechas
        $fechaFin = new DateTime($fecha_fin, $timezone);

        // Obteniendo la fecha de hoy en Venezuela
        $hoy = new DateTime('now', $timezone);

        //Dejando las fechas en media noche porque solo nos interesa validar fechas y no las horas
        $hoy->setTime(0, 0, 0);
        $fechaInicio->setTime(0, 0, 0);
        $fechaFin->setTime(0, 0, 0);


        // Validar que la fecha de inicio no puede ser anterior a la fecha de hoy
        if ($fechaInicio < $hoy) {
            $formErrors[] = 'La fecha de inicio debe ser desde la fecha actual en adelante';
        }

        //Validar que la fecha de finalizacion no sea anterior a la de inicio
        if ($fechaInicio && $fechaFin && $fechaInicio > $fechaFin) {
            $formErrors[] = 'La fecha del final de la guardia no puede ser anterior a la fecha de inicio, vuelva a intentarlo';
        }

        // Validar que las fechas sean exactamente 5 dias
        // $intervalo = $fechaInicio->diff($fechaFin);

        // if ($intervalo->days + 1 != 5) {
        //     $formErrors[] = 'Las fechas de la guardia deben abarcar exactamente 5 días (una semana laboral completa)';
        // }

        // Validar que ni la fecha de inicio ni la fecha fin abarquen fines de semana (Si necesita que las guardias abarquen fines de semana comente estas validaciones)
        //Lunes=1, Martes=2, Miercoles=3, Jueves=4, Viernes=5, Sabado=6, Domingo=7
        // if ($fechaInicio->format('N') >= 6) {
        //     $formErrors[] = 'La fecha de inicio no puede ser un fin de semana (sábado o domingo)';
        // }
        // if ($fechaFin->format('N') >= 6) {
        //     $formErrors[] = 'La fecha de finalización no puede ser un fin de semana (sábado o domingo)';
        // }

        //Si el usuario seleccionado ya tiene 4 guardias pendientes no permitir la insercion
        $rspta = $guardia->verificarguardias($user_id);
        $result = $rspta->fetch_object();

        if ($result->total == 4) {
            $formErrors[] = 'Este usuario ya tiene 4 guardias programadas, elimine las actuales o marquelas como terminadas para continuar agregando mas guardias';
        }


        if (!empty($formErrors)) {
            http_response_code(404); // Disparar error en el ajax

            $jsonResponse = [
                'success' => false,
                'errors' => $formErrors // mandar array con los errores
            ];

            echo json_encode($jsonResponse);
        } else {

            $rspta = $guardia->insertar($user_id, $fecha_inicio, $fecha_fin, $observaciones);

            $jsonResponse = [
                'success' => true,
                'semaforo' => 'verde'
            ];

            echo json_encode($jsonResponse);
        }
        break;
    case 'getguardiaform':

        $formFile = '../vistas/newGuardiaForm.html';
        $formHtml = file_get_contents($formFile);

        echo $formHtml;
        break;
    case 'guardiasCalendario':
        //Obtener guardias para el calendario
        $rspta = $guardia->listar();
        $data = array();
        $formattedEvents = [];

        while ($reg = $rspta->fetch_object()) {

            $status = $reg->isDone;
            $backgroundColor = '';
            $textColor = '';

            if ($status == 0) {
                $backgroundColor = '#FFC107'; //Pendiente = amarillo
                $textColor = '#1F2D3D';
            } elseif ($status == 1) {
                $backgroundColor = '#008000'; //Terminada = exito
                $textColor = '';
            } else {
                $backgroundColor = 'blue'; // Default color
                $textColor = '';
            }
            $formattedEvents[] = [
                "id" => $reg->id,
                "title" => $reg->usuarios,
                "start" => $reg->fecha_inicio,
                "end" => $reg->fecha_fin,
                "backgroundColor" => $backgroundColor,
                "textColor" => $textColor
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
                "0" => ($reg->isDone == 0)
                    ? '<button title="Terminar Guardia" class="btn btn-success btn-xs" onclick="terminar(' . $reg->id . ')"><i class="fa fa-check"></i></button>'
                    . ' '
                    . '<button title="Cancelar Guardia" class="btn btn-danger btn-xs" onclick="cancelar(' . $reg->id . ')"><i class="fa fa-trash"></i></button>'
                    : '<span class="label bg-green"> Terminada </span>',
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

        //Obtener id de usuario por id de guardia
        $consulta1 = $guardia->obtener_useridby_guardiaid($id)->fetch_object();
        $user_id = $consulta1->usuario;

        //Obtener compensatorios totales del usuario y sumarle 2
        $consulta2 = $compensatorioUsuario->obtener_compensatorios_usuario($user_id)->fetch_object();
        $compensatorios_actuales = $consulta2->totales + 2;

        //insertar en los compensatorios
        $consulta3 = $compensatorioUsuario->editarcompensatorios($user_id, $compensatorios_actuales);

        echo $rspta ? "Guardia terminada correctamente" : "No se pudieron actualizar los datos";
        break;
}
