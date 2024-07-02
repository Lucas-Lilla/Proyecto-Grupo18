<?php

namespace model;

class RegistrarModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function usuarioDisponible($usuario)
    {
        $resultado = $this->database->query("SELECT * FROM usuario WHERE usuario = '$usuario'");
        return empty($resultado);
    }

    public function contraseñaValida($password, $r_password)
    {
        return $password === $r_password;
    }

    public function registrarUsuario($usuario, $password, $nombre, $fecha, $sexo, $ubicacion, $email, $imagen = '')
    {
        $hash = md5(date('YmdHis', time()));

        if (!empty($imagen)) {
            $this->database->execute("INSERT INTO usuario (usuario, password, nombre, fecha, sexo, ubicacion, email, imagen, hash) VALUES ('$usuario', '$password', '$nombre', '$fecha', '$sexo','$ubicacion', '$email', '$imagen', '$hash')");
        } else {
            $this->database->execute("INSERT INTO usuario (usuario, password, nombre, fecha, sexo, ubicacion, email, hash) VALUES ('$usuario', '$password', '$nombre', '$fecha', '$sexo', '$ubicacion','$email', '$hash')");
        }
        return $hash;
    }

}
