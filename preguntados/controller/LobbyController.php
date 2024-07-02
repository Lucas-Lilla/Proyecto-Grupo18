<?php

namespace controller;

use model\LobbyModel;

class LobbyController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function mostrarPantallaLobby()
    {
        $promedio = $this->model->obtenerPromedioDeUsuario($_SESSION["usuario"]["usuario"]);
        $promedio_truncado = number_format($promedio, 2, '.', '') * 10000;
        $categorias = $this->model->cargarCategoria();

        if (isset($_SESSION["usuario"]["preguntaActual"])) {
            unset($_SESSION["usuario"]["preguntaActual"]);
            header('Location: /preguntados/jugarPartida/finalizarPartida');
            exit();
        }

        $data = [
            "usuario" => strtoupper($_SESSION["usuario"]["nombre"]),
            "nivel" => $promedio_truncado,
            "error" => !empty($_GET["error"]),
            "trampa" => !empty($_GET["trampa"]),
            "categorias" => $categorias,
        ];

        $this->presenter->render("view/lobbyView.mustache", $data);
    }

    public function mostrarPantallaTrampa()
    {
        $this->presenter->render("view/trampaView.mustache");
    }

    public function mostrarPantallaError()
    {
        $this->presenter->render("view/errorView.mustache");
    }

    public function cerrarSesion()
    {
        $this->model->sessionClose();
        header('Location: /preguntados');
        exit();
    }

    public function guardar()
    {
        $usuario = $_SESSION["usuario"]["usuario"];
        $pregunta = $_POST['pregunta'];
        $respuestas = [
            $_POST['respuesta1'],
            $_POST['respuesta2'],
            $_POST['respuesta3'],
            $_POST['respuesta4'],
        ];

        $respuesta_correcta = $_POST['respuesta_correcta'];
        $categoria = $_POST['categorias'];

        $this->model->guardarPregunta($pregunta, $respuestas, $respuesta_correcta, $usuario, $categoria);
        header('Location: /preguntados/lobby/mostrarPantallaLobby');
        exit();


    }

}