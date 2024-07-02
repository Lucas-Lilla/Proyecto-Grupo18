<?php

namespace model;

class PerfilModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function buscarUsuario($usuario)
    {
        $result = $this->database->query("SELECT * FROM usuario WHERE usuario = '$usuario'");
        return $result ? $result[0] : null;
    }

    public function obtenerMayorPuntajeUsuario($usuario)
    {
        $result = $this->database->query("SELECT MAX(puntaje) AS puntaje FROM partida WHERE usuario = '$usuario'");
        return $result ? $result[0] : null;
    }

    public function obtenerRankingIndividual($usuario)
    {
        return $this->database->query("SELECT puntaje, fecha FROM partida WHERE usuario = '$usuario' ORDER BY puntaje DESC");
    }

    public function traerUsuarioModificado($usuario)
    {
        return $this->database->query("SELECT * FROM usuario WHERE usuario = '$usuario'")[0];
    }

    public function actualizarDatosDeUsuario($usuarioAModificar, $nombre, $fecha, $sexo)
    {
        $this->database->execute("UPDATE usuario SET nombre = '$nombre', fecha = '$fecha', sexo = '$sexo' WHERE usuario = '$usuarioAModificar'");
    }

}

