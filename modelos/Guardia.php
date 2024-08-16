<?php

require "../Config/conexion.php";

class Guardia
{
    public function __construct() {}

    // Listar todas las guardias con el nombre completo del usuario
    public function listar()
    {
        $sql = "SELECT a.*, CONCAT(e.nombre, ' ', e.apellido) AS usuarios 
                FROM guardia a 
                INNER JOIN usuarios e ON a.user_id = e.id 
                ORDER BY a.id DESC";
        return ejecutarConsulta($sql);
    }

    // Listar el reporte de guardias entre fechas especificas por usuario
    public function listar_guardias($fecha_inicio, $fecha_fin, $usuario_id)
    {
        $sql = "SELECT a.*, CONCAT(e.nombre, ' ', e.apellido) AS usuarios 
                FROM guardia a 
                INNER JOIN usuarios e ON a.user_id = e.id 
                WHERE DATE(a.fecha_inicio) >= '$fecha_inicio' AND DATE(a.fecha_fin) <= '$fecha_fin' AND a.user_id = '$usuario_id'";
        return ejecutarConsulta($sql);
    }
}
