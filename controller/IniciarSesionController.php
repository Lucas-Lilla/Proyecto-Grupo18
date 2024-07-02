<?php

namespace controller;

class IniciarSesionController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function mostrarPantallaIniciarSesion()
    {
        $this->presenter->render("view/iniciarSesionView.mustache", ["showErrorUsuario" => false]);
    }

    public function validar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
            $contraseña = isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";
            $resultado = $this->model->validarUsuario($usuario, $contraseña);

            if (!empty($resultado)){
                $_SESSION["usuario"] = $resultado;
                switch ($resultado["rol"]){
                    case "A":
                        header('Location: /preguntados/admin/mostrarPantallaAdmin');
                        exit();
                    case "E":
                        header('Location: /preguntados/editor/mostrarPantallaEditor');
                        exit();
                    case "J":
                        header('Location: /preguntados/lobby/mostrarPantallaLobby');
                        exit();
                }
            }else{
                $this->presenter->render("view/iniciarSesionView.mustache", ["showErrorUsuario" => true]);
            }
        }
    }

    public function validarHash()
    {
        $hash = $_GET["hash"] ?? "";
        $validacion = $this->model->validarHash($hash);
        $this->presenter->render("view/iniciarSesionView.mustache", ["validacion" => $validacion]);
    }


}