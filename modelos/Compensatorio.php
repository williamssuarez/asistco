<?php

require_once "../Config/conexion.php";

class Compensatorio
{
    public function __construct() {}

    // Listar todas las guardias con el nombre completo del usuario
    public function listar()
    {
        $sql = "SELECT a.*, CONCAT(e.nombre, ' ', e.apellido) AS usuarios 
                FROM compensatorios a 
                INNER JOIN usuarios e ON a.user_id = e.id 
                ORDER BY a.fecha DESC";
        return ejecutarConsulta($sql);
    }

    public function insertar($user_id, $fecha, $observaciones)
    {
        $sql = "INSERT INTO compensatorios (user_id, fecha, observaciones) VALUES ('$user_id', '$fecha', '$observaciones')";
        return ejecutarConsulta($sql);
    }

    public function editar($compensatorio_id, $user_id, $fecha, $observaciones)
    {
        $sql = "UPDATE compensatorios SET user_id='$user_id', fecha='$fecha', observaciones='$observaciones' WHERE id='$compensatorio_id'";
        return ejecutarConsulta($sql);
    }

    public function cancelar($compensatorio_id)
    {
        $sql = "UPDATE compensatorios SET estado=2 WHERE id='$compensatorio_id'";
        return ejecutarConsulta($sql);
    }

    public function terminar($compensatorio_id)
    {
        $sql = "UPDATE compensatorios SET estado=1 WHERE id='$compensatorio_id'";
        return ejecutarConsulta($sql);
    }

    public function obtener_useridby_compensatorioid($id)
    {
        $sql = "SELECT user_id AS usuario FROM compensatorios WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

    public function verificarcompensatprios($idusuario)
    {
        $sql = "SELECT COUNT(*) AS total FROM compensatorios WHERE user_id='$idusuario'";
        return ejecutarConsulta($sql);
    }
}
