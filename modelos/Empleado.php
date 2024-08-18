<?php

//Cambio de require a require_once
require_once "../Config/conexion.php";
class Empleado
{
    public function __construct()
    {

    }

    public function insertar($nombre, $apellido, $documento_numero, $telefono, $codigo)
    {
        $sql = "INSERT INTO empleados (nombre, apellido, documento_numero, telefono, codigo) VALUES ('$nombre', '$apellido', '$documento_numero', '$telefono', '$codigo')";
        return ejecutarConsulta($sql);
    }

    public function editar($empleado_id, $nombre, $apellido, $documento_numero, $telefono, $codigo)
    {
        $sql = "UPDATE empleados SET nombre='$nombre', apellido='$apellido', documento_numero='$documento_numero', telefono='$telefono', codigo='$codigo' WHERE id='$empleado_id'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($empleado_id)
    {
        $sql = "SELECT * FROM empleados WHERE id='$empleado_id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM empleados";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT * FROM empleados";
        return ejecutarConsulta($sql);
    }
}

?>
