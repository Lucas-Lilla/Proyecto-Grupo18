<?php

namespace controller;

class PerfilController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function mostrarPantallaPerfil($mensajeExito = false, $mensajeError = false)
    {
        $usuario = $_SESSION['usuario'] ?? null;

        if ($usuario) {
            $puntaje = $this->model->obtenerMayorPuntajeUsuario($usuario["usuario"]);

            $imagenRuta = !empty($usuario["imagen"]) ? $usuario["imagen"] : "/preguntados/public/imagenesPerfil/fotoDefault.png";
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imagenRuta)) {
                $imagenRuta = "/preguntados/public/imagenesPerfil/fotoDefault.png";
            }

            $data = [
                "usuario" => strtoupper($usuario["usuario"]),
                "nivel" => $usuario["nivel"],
                "nombre" => $usuario["nombre"],
                "sexo" => $usuario["sexo"],
                "esMasculino" => ($usuario["sexo"] == "Masculino"),
                "esFemenino" => ($usuario["sexo"] == "Femenino"),
                "esNoDice" => ($usuario["sexo"] == "Prefiero no decirlo"),
                "email" => $usuario["email"],
                "fecha" => $usuario["fecha"],
                "ubicacion" => $usuario["ubicacion"],
                "imagen" => $imagenRuta,
                "mensajeExito" => $mensajeExito,
                "mensajeError" => $mensajeError,
                "puntaje" => $puntaje["puntaje"] ?? 0,
            ];

            $this->presenter->render("view/perfilView.mustache", $data);

        } else {
            $this->presenter->render("view/usuarioNoEncontrado.mustache");
        }
    }

    public function mostrarPantallaPerfilPublico()
    {
        $usuario = $_GET["usuario"] ?? null;

        $datosUsuario = $this->model->buscarUsuario($usuario);
        $puntaje = $this->model->obtenerMayorPuntajeUsuario($usuario);
        $rankingIndividual = $this->model->obtenerRankingIndividual($usuario);

        if ($datosUsuario) {

            $imagenRuta = !empty($datosUsuario["imagen"]) ? $datosUsuario["imagen"] : "/preguntados/public/imagenesPerfil/fotoDefault.png";
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imagenRuta)) {
                $imagenRuta = "/preguntados/public/imagenesPerfil/fotoDefault.png";
            }

            $posicionIndividual = 1;
            foreach ($rankingIndividual as &$fila) {
                $fila['posicionIndividual'] = $posicionIndividual++;
            }

            $data = [
                "usuario" => strtoupper($datosUsuario["usuario"]),
                "nivel" => $datosUsuario["nivel"],
                "nombre" => $datosUsuario["nombre"],
                "sexo" => $datosUsuario["sexo"],
                "email" => $datosUsuario["email"],
                "fecha" => $datosUsuario["fecha"],
                "ubicacion" => $datosUsuario["ubicacion"],
                "imagen" => $imagenRuta,
                "puntaje" => $puntaje["puntaje"] ?? 0,
                "rankingIndividual" => $rankingIndividual ?? [],
            ];

            $this->presenter->render("view/perfilPublicoView.mustache", $data);

        } else {
            $this->presenter->render("view/usuarioNoEncontrado.mustache");
        }
    }

    public function actualizarPerfil()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuarioAModificar = $_SESSION["usuario"]["usuario"];
            $nombre = $_POST["nombre"];
            $fecha = $_POST["fecha"];
            $sexo = isset($_POST["sexo"]) ? $_POST["sexo"] : null;

            if (empty($nombre) || empty($fecha) || empty($sexo)) {
                return $this->mostrarPantallaPerfil(false, true);
            }

            $this->model->actualizarDatosDeUsuario($usuarioAModificar, $nombre, $fecha, $sexo);
            $_SESSION["usuario"] = $this->model->traerUsuarioModificado($usuarioAModificar);
            return $this->mostrarPantallaPerfil(true);

        }
    }


}


