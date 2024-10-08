<?php

require_once "../Config/conexion.php";

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
                ORDER BY a.fecha_inicio DESC";
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

    public function cancelar($idguardia)
    {
        $sql = "UPDATE guardia SET estado=0 WHERE id='$idguardia'";
        return ejecutarConsulta($sql);
    }

    public function terminar($idguardia)
    {
        $sql = "UPDATE guardia SET isDone=1 WHERE id='$idguardia'";
        return ejecutarConsulta($sql);
    }

    public function obtener_useridby_guardiaid($id)
    {
        $sql = "SELECT user_id AS usuario FROM guardia WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

    public function verificarguardias($idusuario)
    {
        $sql = "SELECT COUNT(*) AS total FROM guardia WHERE user_id='$idusuario' AND estado = 1 AND isDone = 0";
        return ejecutarConsulta($sql);
    }
}
