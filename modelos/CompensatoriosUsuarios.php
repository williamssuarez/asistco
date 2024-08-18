<?php

require_once "../Config/conexion.php";

class CompensatoriosUsuarios
{
    public function __construct() {}

    public function listar()
    {
        $sql = "SELECT a.*, CONCAT(e.nombre, ' ', e.apellido) AS usuarios 
                FROM compensatorios_usuarios a 
                INNER JOIN usuarios e ON a.user_id = e.id 
                ORDER BY a.id DESC";
        return ejecutarConsulta($sql);
    }

    public function obtener_compensatorios_usuario($user_id)
    {
        $sql = "SELECT compensatorios_totales AS totales FROM compensatorios_usuarios WHERE user_id='$user_id'";
        return ejecutarConsulta($sql);
    }

    public function insertar($user_id)
    {
        $sql = "INSERT INTO compensatorios_usuarios (user_id) VALUES ('$user_id')";
        return ejecutarConsulta($sql);
    }

    public function editarcompensatorios($user_id, $compensatorios_totales)
    {
        $sql = "UPDATE compensatorios_usuarios SET compensatorios_totales='$compensatorios_totales' WHERE user_id='$user_id'";
        return ejecutarConsulta($sql);
    }

    public function verificarcompensatorios($idusuario)
    {
        $sql = "SELECT COUNT(*) AS total FROM compensatorios_usuarios WHERE user_id='$idusuario'";
        return ejecutarConsulta($sql);
    }
}
