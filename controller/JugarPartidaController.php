<?php

namespace controller;

class JugarPartidaController
{
    private $model;
    private $presenter;


    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function empezarPartida()
    {
        $_SESSION["usuario"]["siguientePregunta"] = 1;
        $_SESSION["usuario"]["vidas"] = [1, 2, 3];
        $this->model->actualizarPuntaje($_SESSION["usuario"]["usuario"]);
        unset($_SESSION["usuario"]["preguntaActual"]);
        unset($_SESSION["usuario"]["respuestaSeleccionada"]);
        header('Location: /preguntados/jugarPartida/mostrarPantallaDePartida');
        exit();
    }

    public function volverAlLobby()
    {
        $this->model->finalizarPartida($_SESSION["usuario"]["usuario"]);
        unset($_SESSION["usuario"]["preguntaActual"]);
        unset($_SESSION["usuario"]["respuestaSeleccionada"]);
        header('Location: /preguntados/lobby/mostrarPantallaLobby');
        exit();
    }

    public function siguientePregunta()
    {
        unset($_SESSION["usuario"]["preguntaActual"]);
        unset($_SESSION["usuario"]["respuestaSeleccionada"]);
        $_SESSION["usuario"]["siguientePregunta"] = 1;
        header('Location: /preguntados/jugarPartida/mostrarPantallaDePartida');
        exit();
    }

    public function mostrarPantallaDePartida()
    {
        $iniciarTimer = false;
        $puntaje = $this->model->mostrarPuntajeEnPantalla($_SESSION["usuario"]["usuario"]);
        $finDelJuego = false;
        $resultado = null;
        $respuesta_id = $_GET["respuesta_id"] ?? "";
        $usuario = $_SESSION["usuario"]["usuario"];

        if (isset($_SESSION["usuario"]["siguientePregunta"]) && $_SESSION["usuario"]["siguientePregunta"] == 1) {
            $_SESSION["usuario"]["siguientePregunta"] = 0;
            $_SESSION["usuario"]["hora"] = date('YmdHis', time());
        }

        if ($respuesta_id == "") {
            if ($_SESSION["usuario"]["hora"] != date('YmdHis', time())) {
                $this->model->finalizarPartida($_SESSION["usuario"]["usuario"]);
                unset($_SESSION["usuario"]["preguntaActual"]);
                header('Location: /preguntados/lobby/mostrarPantallaTrampa');
                exit();
            } else {
                $pregunta = $this->elegirPregunta();
                if ($pregunta == null) {
                    $this->model->finalizarPartida($_SESSION["usuario"]["usuario"]);
                    header('Location: /preguntados/lobby/mostrarPantallaError');
                    exit();
                }

                $iniciarTimer = true;
                $_SESSION["usuario"]["tiempoInicio"] = time();
                $_SESSION["usuario"]["preguntaActual"] = $pregunta;
                $_SESSION["usuario"]["hora"] = date('YmdHis', time());
            }
            $_SESSION["usuario"]["respuestas"] = $this->model->obtenerRespuestas($pregunta);
        } else {

            if ((!isset($_SESSION["usuario"]["respuestaSeleccionada"]) && $this->model->verificarSiLaRespuestaCoincideConLaPregunta($respuesta_id, $_SESSION["usuario"]["preguntaActual"]["id"]))) {
                $_SESSION["usuario"]["respuestaSeleccionada"] = $respuesta_id;
                $_SESSION["usuario"]["horaRespuesta"] = date('YmdHis', time());
                $horaPregunta = strtotime($_SESSION["usuario"]["hora"]);
                $_SESSION["usuario"]["horaCon30Segundos"] = date('YmdHis', $horaPregunta + 30);
            }

            if ((isset($_SESSION["usuario"]["respuestaSeleccionada"]) && $this->model->verificarSiLaRespuestaCoincideConLaPregunta($respuesta_id, $_SESSION["usuario"]["preguntaActual"]["id"])
                    && $_SESSION["usuario"]["horaRespuesta"] == date('YmdHis', time())) && strtotime($_SESSION["usuario"]["horaRespuesta"]) <= strtotime($_SESSION["usuario"]["horaCon30Segundos"])) {
                $_SESSION["usuario"]["bandera"] = 1;
            }

            if ($_SESSION["usuario"]["respuestaSeleccionada"] == $respuesta_id && $_SESSION["usuario"]["bandera"] == 1) {
                $_SESSION["usuario"]["bandera"] = 0;
                $resultado = $this->model->verificarRespuesta($respuesta_id);
                $_SESSION["usuario"]["resultado"] = $resultado;

                if ($resultado == "Correcta") {
                    $this->actualizarRespuestasCorrectas($_SESSION["usuario"]["preguntaActual"]["id"], $usuario);
                    $this->actualizarPreguntasRespondidas($_SESSION["usuario"]["preguntaActual"]["id"], $usuario);
                    $this->model->actualizarPuntaje($_SESSION["usuario"]["usuario"]);
                    $puntaje = $this->model->mostrarPuntajeEnPantalla($_SESSION["usuario"]["usuario"]);

                } else {
                    if (sizeof($_SESSION["usuario"]["vidas"]) > 1) {
                        array_pop($_SESSION["usuario"]["vidas"]);
                        $this->actualizarPreguntasRespondidas($_SESSION["usuario"]["preguntaActual"]["id"], $usuario);
                        $puntaje = $this->model->mostrarPuntajeEnPantalla($_SESSION["usuario"]["usuario"]);
                    } else {
                        array_pop($_SESSION["usuario"]["vidas"]);
                        $this->actualizarPreguntasRespondidas($_SESSION["usuario"]["preguntaActual"]["id"], $usuario);
                        $puntaje = $this->model->mostrarPuntajeEnPantalla($_SESSION["usuario"]["usuario"]);
                        $this->model->finalizarPartida($usuario);
                        $finDelJuego = true;
                    }
                }
                $this->actualizarDificultad($_SESSION["usuario"]["preguntaActual"]["id"], $usuario);

            } else {
                $this->model->finalizarPartida($_SESSION["usuario"]["usuario"]);
                unset($_SESSION["usuario"]["respuestaSeleccionada"]);
                unset($_SESSION["usuario"]["preguntaActual"]);
                header('Location: /preguntados/lobby/mostrarPantallaTrampa');
                exit();
            }

            $pregunta = $_SESSION["usuario"]["preguntaActual"];
            $respuestas = $this->model->obtenerRespuestas($pregunta);
            $_SESSION["usuario"]["respuestas"] = $this->aplicarEstilosRespuestas($respuestas, $_SESSION["usuario"]["respuestaSeleccionada"], $resultado, $pregunta);
        }

        $categoria = $this->model->obtenerCategoria($_SESSION["usuario"]["preguntaActual"]["categoria"]);
        $descripcion_categoria = $categoria["descripcion"];

        $duracion = 30;
        $tiempoInicio = $_SESSION["usuario"]["tiempoInicio"];
        $tiempoRestante = max(0, $duracion - (time() - $tiempoInicio));

        $data = [
            "pregunta" => $_SESSION["usuario"]["preguntaActual"],
            "respuestas" => $_SESSION["usuario"]["respuestas"],
            "resultado" => $resultado,

            "categoria" => [
                "descripcion" => $descripcion_categoria,
                "color" => $this->obtenerColorCategoria($categoria["id"])
            ],
            "vidas" => $_SESSION["usuario"]["vidas"],
            "finDelJuego" => $finDelJuego,
            "puntaje" => $puntaje["puntaje"],
            "tiempoRestante" => $tiempoRestante,
            "iniciarTimer" => $iniciarTimer,

        ];

        $this->presenter->render("view/jugarPartidaView.mustache", $data);
    }

    public function elegirPregunta()
    {
        $nivel = $_SESSION["usuario"]["nivel"];
        $categoriasIntentadas = [];
        $preguntaSeleccionada = null;
        $intentos = 0;

        while ($intentos < 2) {
            while (count($categoriasIntentadas) < 10) {
                $categoria = rand(1, 10);
                if (!in_array($categoria, $categoriasIntentadas)) {
                    $categoriasIntentadas[] = $categoria;
                    $preguntas = $this->model->obtenerPreguntas($categoria, $nivel);

                    if (!empty($preguntas)) {
                        $preguntaSeleccionada = $this->model->seleccionarPregunta($preguntas);
                        if ($preguntaSeleccionada !== null) {
                            $_SESSION["usuario"]["preguntaActual"] = $preguntaSeleccionada;
                            return $preguntaSeleccionada;
                        }
                    }
                }
            }
            if ($preguntaSeleccionada === null) {
                $this->model->reiniciarPreguntasRespondidasPorElUsuario($_SESSION["usuario"]["usuario"]);
                $categoriasIntentadas = [];
                $intentos++;
            }
        }
        return null;
    }

    public function actualizarPreguntasRespondidas($pregunta_id, $usuario)
    {
        $this->model->incrementarPreguntasRespondidas($pregunta_id);
        $this->model->incrementarPreguntasRespondidasUsuario($usuario);
    }

    public function actualizarRespuestasCorrectas($pregunta_id, $usuario)
    {
        $this->model->incrementarRespuestasCorrectas($pregunta_id);
        $this->model->incrementarRespuestasCorrectasUsuario($usuario);
    }

    public function actualizarDificultad($pregunta_id, $usuario)
    {
        $this->model->revisarDificultad($pregunta_id);
        $this->model->revisarDificultadUsuario($usuario);
    }

    public function aplicarEstilosRespuestas($respuestas, $respuesta_id, $resultado, $pregunta)
    {
        foreach ($respuestas as &$respuesta) {
            if ($respuesta["id"] == $respuesta_id) {
                $respuesta["esSeleccionada"] = true; // Marca la respuesta que selecciona el usuario.
                if ($resultado == "Incorrecta") {
                    $respuesta["color"] = "respuestaIncorrecta"; // Pinta la respuesta seleccionada de rojo si es incorrecta.
                }
            } else {
                $respuesta["esSeleccionada"] = false;
                $id_respuesta_correcta = $this->model->obtenerIdRespuestaCorrecta($pregunta);
                $id_respuesta_correcta = $id_respuesta_correcta["id"];
                if ($resultado == "Incorrecta" && $respuesta["id"] == $id_respuesta_correcta) {
                    $respuesta["color"] = "respuestaCorrecta"; // Pinta la respuesta correcta de verde si la seleccionada es incorrecta.
                } else {
                    $respuesta["color"] = "respuestaSinSeleccionar";
                }
            }
            if ($resultado == "Correcta" && $respuesta["id"] == $respuesta_id) {
                $respuesta["color"] = "respuestaCorrecta";
            }

            // Agregar un campo 'icono' basado en si la respuesta es correcta o incorrecta
            if ($resultado == "Correcta" && $respuesta["id"] == $respuesta_id) {
                $respuesta["icono"] = "fa-check-circle"; // Icono de marca de verificación para respuesta correcta
            } else {
                $respuesta["icono"] = "fa-times-circle"; // Icono de cruz para respuesta incorrecta
            }
        }
        return $respuestas;
    }


    private function actualizarPuntajes($usuario)
    {
        $this->model->actualizarPuntaje($usuario);
    }

    public function finalizarPartida()
    {
        $this->model->finalizarPartida($_SESSION["usuario"]["usuario"]);
        header('Location: /preguntados/lobby/mostrarPantallaTrampa');
        exit();
    }


    private function obtenerColorCategoria($categoriaId)
    {
        // Array asociativo que mapea los IDs de las categorías a los colores correspondientes
        $colores = [
            1 => "#A9272D",  // Rojo
            2 => "#058447",  // Verde
            3 => "#5297FF",  // Celeste
            4 => "#ffa500",  // Naranja
            5 => "#ff7f50",  // Coral
            6 => "#6D466B",  // Violeta
            7 => "#D852A5",  // Rosa
            8 => "#008000",  // Verde oscuro
            9 => "#B49FCC",  // Lila
            10 => "#FFC403", // Amarillo
        ];
        return $colores[$categoriaId] ?? "#000000";
    }

    public function reportarPregunta()
    {
        $id_pregunta = $_POST["id_pregunta"] ?? "";
        $reporte = $_POST["reporte"] ?? "";

        if (!empty($id_pregunta) && !empty($reporte)) {
            $this->model->reportarPregunta($id_pregunta, $reporte);
            $response = ['status' => 'success'];
        } else {
            $response = ['status' => 'error'];
        }
        header('Content-Type: application/json');
        echo json_encode($response);

    }

    public function obtenerTiempoRestante()
    {
        $tiempoInicio = $_SESSION["usuario"]["tiempoInicio"];
        $duracion = 30;
        $tiempoRestante = max(0, $duracion - (time() - $tiempoInicio));
        $response = ['tiempoRestante' => $tiempoRestante];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function obtenerIdRespuestaIncorrecta()
    {
        $id_pregunta = $_POST['id_pregunta'] ?? null;

        if ($id_pregunta !== null) {
            $respuesta_id = $this->model->obtenerIdRespuestaIncorrecta($id_pregunta);
            $response = ['respuesta_id' => $respuesta_id];
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'No se proporcionó un ID de pregunta válido']);
        }
    }


}