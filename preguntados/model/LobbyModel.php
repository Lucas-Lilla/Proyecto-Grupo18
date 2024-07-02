<?php

namespace model;

class LobbyModel
{
    private $database;
    private $pregunta;
    private $respuestas;
    private $respuesta_correcta;

    public function __construct($database)
    {
        $this->database = $database;

    }


    public function obtenerPromedioDeUsuario($usuario)
    {
        $usuario = $this->database->query("SELECT * FROM usuario WHERE usuario = '$usuario'")[0];
        if ($usuario["cant_respondidas"] > 10) {
            return $usuario["cant_correctas"] / $usuario["cant_respondidas"];
        } else return 0;
    }

    public function guardarPregunta($pregunta, $respuestas, $respuesta_correcta, $usuario, $categoria)
    {
        $resp = json_encode($respuestas);
        $cate = json_encode($categoria);
        $this->database->execute("INSERT INTO preguntas_de_usuario (pregunta, respuestas, respuesta_correcta,usuario,categoria) VALUES ('$pregunta','$resp','$respuesta_correcta','$usuario','$categoria')");

    }

    public function cargarCategoria()
    {
        $result = $this->database->query("SELECT id,descripcion FROM categoria");
        return $result;
    }


    public function sessionClose()
    {
        session_unset();
        session_destroy();
    }

}