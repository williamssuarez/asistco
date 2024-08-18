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
                WHERE a.estado = 1
                ORDER BY a.id DESC";
        return ejecutarConsulta($sql);
    }

    public function insertar($user_id, $fecha_inicio, $fecha_fin, $observaciones)
    {
        $sql = "INSERT INTO guardia (user_id, fecha_inicio, fecha_fin, observaciones) VALUES ('$user_id', '$fecha_inicio', '$fecha_fin', '$observaciones')";
        return ejecutarConsulta($sql);
    }

    public function editar($guardia_id, $user_id, $fecha_inicio, $fecha_fin, $observaciones)
    {
        $sql = "UPDATE guardia SET user_id='$user_id', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', observaciones='$observaciones' WHERE id='$guardia_id'";
        return ejecutarConsulta($sql);
    }
}
