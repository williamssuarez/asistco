<?php

require_once "../Config/Conexion.php";

class Usuario
{

    public function __construct() {}

    public function insertar($nombre, $apellido, $login, $email, $clavehash, $imagen)
    {
        $sql = "INSERT INTO usuarios (nombre, apellido, login, email, password, imagen, estado) VALUES ('$nombre', '$apellido', '$login', '$email', '$clavehash', '$imagen','1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idusuario, $nombre, $apellido, $login, $email, $clavehash, $imagen)
    {
        if (!empty($clavehash)) {
            $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', login='$login', email='$email', password='$clavehash', imagen='$imagen' WHERE id='$idusuario'";
        } else {
            $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', email='$email', imagen='$imagen' WHERE id='$idusuario'";
        }
        return ejecutarConsulta($sql);
    }

    public function desactivar($idusuario)
    {
        $sql = "UPDATE usuarios SET estado=0 WHERE id='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function activar($idusuario)
    {
        $sql = "UPDATE usuarios SET estado='1' WHERE id='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idusuario)
    {
        $sql = "SELECT * FROM usuarios WHERE id='$idusuario'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Buscar usuario por email
    public function obtener_userid_byemail($email)
    {
        $sql = "SELECT id FROM usuarios WHERE email='$email'";
        return ejecutarConsulta($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM usuarios";
        return ejecutarConsulta($sql);
    }

    public function cantidad_usuario()
    {
        $sql = "SELECT count(*) nombre FROM usuarios";
        return ejecutarConsulta($sql);
    }

    public function verificar($login, $clavehash)
    {
        $sql = "SELECT * FROM usuarios WHERE login='$login' AND password='$clavehash' AND estado='1'";
        return ejecutarConsulta($sql);
    }
}
