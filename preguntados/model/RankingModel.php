<?php

namespace model;

use PDO;

class RankingModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerRanking()
    {
        return $this->database->query("SELECT usuario,MAX(puntaje) AS puntaje FROM partida GROUP BY usuario ORDER BY puntaje DESC ");

    }

    public function obtenerRankingIndividual($usuario)
    {
        return $this->database->query("SELECT puntaje,fecha  FROM partida WHERE usuario = '$usuario' ORDER BY fecha DESC ");

    }

    public function buscarUsuario($usuario)
    {
        return $this->database->query("SELECT * FROM usuario  WHERE usuario = '$usuario'")[0];
    }

}





