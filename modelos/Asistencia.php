<?php

require "../Config/conexion.php";

class Asistencia
{
    public function __construct() {}

    // Listar todas las asistencias con el nombre completo y código del empleado
    public function listar()
    {
        $sql = "SELECT a.*, CONCAT(e.nombre, ' ', e.apellido) AS empleados, e.codigo 
                FROM asistencia a 
                INNER JOIN empleados e ON a.empleado_id = e.id 
                ORDER BY a.id DESC";
        return ejecutarConsulta($sql);
    }

    // Listar el reporte de asistencias entre fechas específicas para un empleado
    public function listar_reporte($fecha_inicio, $fecha_fin, $empleado_id)
    {
        $sql = "SELECT a.*, CONCAT(e.nombre, ' ', e.apellido) AS empleados, e.codigo 
                FROM asistencia a 
                INNER JOIN empleados e ON a.empleado_id = e.id 
                WHERE DATE(a.fecha) >= '$fecha_inicio' AND DATE(a.fecha) <= '$fecha_fin' AND a.empleado_id = '$empleado_id'";
        return ejecutarConsulta($sql);
    }
}
