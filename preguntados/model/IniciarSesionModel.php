<?php

namespace model;

class IniciarSesionModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    public function validarUsuario($usuario, $contraseña)
    {
        $resultado = $this->database->query("SELECT * FROM usuario WHERE usuario = '$usuario' AND password = '$contraseña' AND activo = 1");
        if (empty($resultado)){
            return null;
        }else return $resultado[0];
    }

    public function validarHash($hash){
        $resultado = $this->database->query("SELECT * FROM usuario WHERE hash = '$hash'");
        if (!empty($resultado)) {
            $this->database->execute("UPDATE usuario SET activo = 1 WHERE hash = '$hash'");
            return true;
        } else {
            return false;
        }
    }
}