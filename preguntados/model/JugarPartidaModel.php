<?php

namespace model;

use PDO;

class JugarPartidaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerPreguntas($categoria, $nivel)
    {
        return $this->database->query("SELECT * FROM pregunta WHERE categoria = '$categoria' AND dificultad = '$nivel'");
    }

    public function seleccionarPregunta($preguntas)
    {
        $usuarioId = $_SESSION["usuario"]["usuario"];
        $resultado = $this->database->query("SELECT id_pregunta FROM usuario_pregunta WHERE id_usuario = '$usuarioId'");

        $preguntasRespondidas = !empty($resultado) ? array_column($resultado, 'id_pregunta') : [];

        //Recorre todas las preguntas y en caso de que la pregunta no haya sido respondida por el usuario, la asigna a el array de preguntasDisponibles.
        $preguntasDisponibles = array_filter($preguntas, function ($pregunta) use ($preguntasRespondidas) {
            //Comprueba si el ID de la pregunta actual no está en el array de preguntas respondidas.
            return !in_array($pregunta["id"], $preguntasRespondidas);
        });

        if (!empty($preguntasDisponibles)) {
            $preguntaSeleccionada = $preguntasDisponibles[array_rand($preguntasDisponibles)];
            $this->database->execute("INSERT INTO usuario_pregunta (id_usuario, id_pregunta) VALUES ('$usuarioId', " . $preguntaSeleccionada["id"] . ")");
            return $preguntaSeleccionada;
        } else {
            return null;
        }
    }

    public function obtenerRespuestas($pregunta)
    {
        $id = $pregunta["id"];
        return $this->database->query("SELECT * FROM respuesta WHERE id_pregunta = '$id'");
    }

    public function verificarRespuesta($id)
    {
        $resultado = $this->database->query("SELECT * FROM respuesta WHERE id = '$id' AND es_correcta = 1");
        if (!empty($resultado)) {
            return "Correcta";
        } else {
            return "Incorrecta";
        }
    }

    public function buscarPregunta($pregunta_id)
    {
        return $this->database->query("SELECT * FROM pregunta WHERE id = '$pregunta_id'")[0];
    }


    public function actualizarNivelDelUsuario($usuario)
    {
        return $this->database->query("SELECT nivel FROM usuario WHERE usuario = '$usuario'");
    }

    public function incrementarPreguntasRespondidas($id)
    {
        $this->database->execute("UPDATE pregunta SET cant_entregadas = cant_entregadas + 1 WHERE id = '$id'");
    }

    public function incrementarRespuestasCorrectas($id)
    {
        $this->database->execute("UPDATE pregunta SET cant_aciertos = cant_aciertos + 1 WHERE id = '$id'");
    }

    public function incrementarPreguntasRespondidasUsuario($usuario)
    {
        $this->database->execute("UPDATE usuario SET cant_respondidas = cant_respondidas + 1 WHERE usuario = '$usuario'");
    }

    public function incrementarRespuestasCorrectasUsuario($usuario)
    {
        $this->database->execute("UPDATE usuario SET cant_correctas = cant_correctas + 1 WHERE usuario = '$usuario'");
    }

    public function revisarDificultad($pregunta_id)
    {
        $pregunta = $this->database->query("SELECT * FROM pregunta WHERE id = '$pregunta_id'")[0];
        $promedio = $pregunta["cant_aciertos"] / $pregunta["cant_entregadas"];

        $dificultad = 3;
        if ($promedio >= 0.33 && $promedio < 0.66) {
            $dificultad = 2;
        } elseif ($promedio >= 0.66) {
            $dificultad = 1;
        }
        $this->database->execute("UPDATE pregunta SET dificultad = $dificultad  WHERE id = '$pregunta_id'");

    }

    public function revisarDificultadUsuario($usuario)
    {
        $usuario = $this->database->query("SELECT * FROM usuario WHERE usuario = '$usuario'")[0];

        if ($usuario["cant_respondidas"] > 10) {
            $promedio = $usuario["cant_correctas"] / $usuario["cant_respondidas"];

            $nivel = 1;
            if ($promedio >= 0.33 && $promedio < 0.66) {
                $nivel = 2;
            } elseif ($promedio >= 0.66) {
                $nivel = 3;
            }
            $usuario = $usuario["usuario"];
            $this->database->execute("UPDATE usuario SET nivel = $nivel  WHERE usuario = '$usuario'");
            $_SESSION["usuario"]["nivel"] = $nivel;
        }

    }

    public function obtenerCategoria($id)
    {
        return $this->database->query("SELECT id, descripcion FROM categoria WHERE id = '$id'")[0];
    }

    public function obtenerIdRespuestaCorrecta($pregunta)
    {
        $id = $pregunta["id"];
        return $this->database->query("SELECT id FROM respuesta WHERE es_correcta = 1 AND id_pregunta = '$id'")[0];
    }


    public function reiniciarPreguntasRespondidasPorElUsuario($usuario)
    {
        $this->database->execute("DELETE FROM usuario_pregunta WHERE id_usuario = '$usuario'");
    }


    public function actualizarPuntaje($usuario)
    {

        $result = $this->database->query("SELECT puntaje FROM partida WHERE usuario = '$usuario' AND finalizada = 0");

        if ($result != null) {
            $this->database->execute("UPDATE partida SET puntaje = puntaje + 5 WHERE usuario = '$usuario' AND finalizada = 0");
        } else {
            $this->database->execute("INSERT INTO partida (usuario, puntaje, finalizada) VALUES ('$usuario', 0, 0)");
        }

    }

    public function mostrarPuntajeEnPantalla($usuario)
    {
        return $this->database->query("SELECT puntaje FROM partida WHERE usuario = '$usuario' AND finalizada = 0")[0];
    }

    public function finalizarPartida($usuario)
    {
        $this->database->execute("UPDATE partida SET finalizada = 1 WHERE usuario = '$usuario' AND finalizada = 0");
    }

    public function verificarSiLaRespuestaCoincideConLaPregunta($respuesta_id, $pregunta_id)
    {
        $result = $this->database->query("SELECT COUNT(*) AS count FROM respuesta WHERE id = '$respuesta_id' AND id_pregunta = '$pregunta_id'");
        if ($result[0]['count'] > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function reportarPregunta($id_pregunta, $reporte)
    {
        $this->database->execute("INSERT INTO pregunta_reportada (id_pregunta, reporte) VALUES ('$id_pregunta', '$reporte')");
    }

    public function obtenerIdRespuestaIncorrecta($id_pregunta)
    {
        $respuestas = $this->database->query("SELECT * FROM respuesta WHERE id_pregunta = '$id_pregunta'");
        foreach ($respuestas as $respuesta) {
            if ($respuesta['es_correcta'] == 0) {
                return $respuesta['id'];
            }
        }
    }

}