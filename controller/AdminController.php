<?php

namespace controller;

class AdminController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter, $pdfCreator)
    {
        $this->model = $model;
        $this->presenter = $presenter;
        $this->pdfCreator = $pdfCreator;
    }

    public function mostrarPantallaAdmin()
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date('Y-m-d');

        $fechaLimiteInferior = $_POST["fechaLimiteInferior"] ?? "2024-06-10";
        $fechaLimiteSuperior = $_POST["fechaLimiteSuperior"] ?? "$hoy";

        $jugadoresTotales = $this->model->consultarCantidadDeJugadoresTotales($fechaLimiteSuperior);
        $partidasTotales = $this->model->consultarCantidadDePartidasTotales($fechaLimiteInferior, $fechaLimiteSuperior);
        $preguntasTotales = $this->model->consultarCantidadDePreguntasTotales($fechaLimiteSuperior);
        $preguntasDeUsuarios = $this->model->consultarCantidadDePreguntasDeUsuarios($fechaLimiteSuperior);
        $jugadoresNuevos = $this->model->consultarCantidadDeJugadoresNuevos($fechaLimiteInferior, $fechaLimiteSuperior);
        $preguntasRespondidasCorrectamente = $this->model->consultarCantidadDePreguntasRespondidasCorrectamente($fechaLimiteInferior, $fechaLimiteSuperior);
        $usuariosPorPais = $this->model->consultarCantidadDeUsuariosPorPais($fechaLimiteInferior, $fechaLimiteSuperior);
        $usuariosPorSexo = $this->model->consultarCantidadDeUsuariosPorSexo($fechaLimiteInferior, $fechaLimiteSuperior);
        $usuariosPorEdad = $this->model->consultarCantidadDeUsuariosPorEdad($fechaLimiteInferior, $fechaLimiteSuperior);

        $colores = ['#84e164', '#277ab6', '#da97a0', '#FFDB58', '#ba58fd'];
        $filasEdad = $this->prepararDatosYColores($usuariosPorEdad, $colores);
        $filasSexo = $this->prepararDatosYColores($usuariosPorSexo, $colores);
        $filasPais = $this->prepararDatosYColores($usuariosPorPais, $colores);

        $imageSrc = "";
        if (isset($_GET["generarPdf"])) {
            $imagePath = './public/imagenes/grafico_' . $_SESSION["usuario"]["usuario"] . '.png';
            $imageData = base64_encode(file_get_contents($imagePath));
            $imageSrc = 'data:image/png;base64,' . $imageData;
        }

        $data = [
            "fechaLimiteInferior" => $fechaLimiteInferior,
            "fechaLimiteSuperior" => $fechaLimiteSuperior,
            "jugadoresTotales" => $jugadoresTotales["cantidad"],
            "partidasTotales" => $partidasTotales["cantidad"],
            "preguntasTotales" => $preguntasTotales["cantidad"],
            "preguntasDeUsuarios" => $preguntasDeUsuarios["cantidad"],
            "jugadoresNuevos" => $jugadoresNuevos["cantidad"],
            "preguntasRespondidasCorrectamente" => $preguntasRespondidasCorrectamente,
            "filasEdad" => json_encode($filasEdad),
            "filasSexo" => json_encode($filasSexo),
            "filasPais" => json_encode($filasPais),
            "imagenBase64" => $imageSrc,

        ];

        if (isset($_GET["generarPdf"])) {
            $this->generarPdf($data);
        }

        $this->presenter->render("view/adminView.mustache", $data);
    }

    private function prepararDatosYColores($datos, $colores)
    {
        $filas = [];
        $index = 0;
        foreach ($datos as $dato) {
            $filas[] = [
                "categoria" => $dato["categoria"],
                "cantidad_usuarios" => (int)$dato["cantidad_usuarios"],
                "color" => $colores[$index % count($colores)]
            ];
            $index++;
        }
        return $filas;
    }

    public function generarPdf($data)
    {
        $html = $this->presenter->generateHTML("view/pdfView.mustache", $data);
        $this->pdfCreator->create($html);
    }

    public function guardarImagenTemporal()
    {
        $this->model->guardarImagenTemporal();
    }

    public function mensajeDeExitoMail()
    {
        $this->presenter->render("public/estilos/mail.html");

    }
}

