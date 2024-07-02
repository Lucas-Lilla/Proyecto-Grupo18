<?php

namespace controller;

class EditorController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function mostrarPantallaEditor()
    {
        $preguntas = $this->model->obtenerPreguntas();
        $preguntasReportadas = $this->model->obtenerPreguntasReportadas();
        $preguntasSugeridas = $this->model->obtenerPreguntasSugeridas();
        $categoriasDisponibles = $this->model->obtenerCategorias();
        $dificultades = $this->model->obtenerDificultades();

        foreach ($preguntasSugeridas as &$pregunta) {
            if (isset($pregunta['respuestas'])) {
                $respuestas = json_decode($pregunta['respuestas'], true);
                $pregunta['respuestas'] = [
                    ['id' => 'A', 'texto' => (string) $respuestas[0]],
                    ['id' => 'B', 'texto' => (string) $respuestas[1]],
                    ['id' => 'C', 'texto' => (string) $respuestas[2]],
                    ['id' => 'D', 'texto' => (string) $respuestas[3]]
                ];

            }
            $pregunta['esCorrectaA'] = $pregunta['respuesta_correcta'] == 1;
            $pregunta['esCorrectaB'] = $pregunta['respuesta_correcta'] == 2;
            $pregunta['esCorrectaC'] = $pregunta['respuesta_correcta'] == 3;
            $pregunta['esCorrectaD'] = $pregunta['respuesta_correcta'] == 4;

            $pregunta['categorias'] = [];
            foreach ($categoriasDisponibles as $categoria) {
                $categoriaSeleccionada = $categoria["id"] === $pregunta["categoria"];
                $pregunta['categorias'][] = [
                    "id" => $categoria["id"],
                    "descripcion" => $categoria["descripcion"],
                    "selected" => $categoriaSeleccionada
                ];
            }
        }

        $data = [
            "preguntas" => $preguntas,
            "preguntas_reportadas" => $preguntasReportadas,
            "preguntas_sugeridas" => $preguntasSugeridas,
            "dificultades" => $dificultades,
        ];

        $this->presenter->render("view/editorView.mustache", $data);
    }

    public function crearPregunta()
    {
        $categorias = $this->model->obtenerCategorias();
        $dificultades = $this->model->obtenerDificultades();

        $data = [
            "categorias" => $categorias,
            "dificultades" => $dificultades
        ];

        $this->presenter->render("view/preguntaView.mustache", $data);
    }

    public function guardarPregunta()
    {
        $descripcion = $_POST["descripcion"] ?? "";
        $categoria = $_POST["categoria"] ?? "";
        $dificultad = $_POST["dificultad"] ?? "";
        $respuesta_A = $_POST["A"] ?? "";
        $respuesta_B = $_POST["B"] ?? "";
        $respuesta_C = $_POST["C"] ?? "";
        $respuesta_D = $_POST["D"] ?? "";
        $correcta = $_POST["correcta"] ?? "";

        if(isset($_POST["id_pregunta_sugerida"])){
            $this->model->eliminarPreguntaSugerida($_POST["id_pregunta_sugerida"]);
        }

        $id_pregunta = $this->model->guardarPregunta($descripcion, $categoria, $dificultad);

        $this->model->guardarRespuestas($respuesta_A, $respuesta_B, $respuesta_C, $respuesta_D, $correcta, $id_pregunta);

        $this->mostrarPantallaEditor();
    }


    public function eliminarPregunta()
    {
        $id_pregunta = $_GET["id"] ?? "";
        $this->model->eliminarPregunta($id_pregunta);
        $this->mostrarPantallaEditor();
    }

    public function eliminarPreguntaSugerida()
    {
        $id_pregunta = $_GET["id"] ?? "";
        $this->model->eliminarPreguntaSugerida($id_pregunta);
        $this->mostrarPantallaEditor();
    }

    public function editarPregunta()
    {
        $id_pregunta = $_GET["id"] ?? "";
        $pregunta = $this->model->buscarPregunta($id_pregunta);
        $respuestas = $this->model->buscarRespuestas($id_pregunta);

        $categoriasDisponibles = $this->model->obtenerCategorias();
        $categorias = [];
        foreach ($categoriasDisponibles as $categoria) {
            $categoriaSeleccionada = $categoria["id"] === $pregunta["categoria"];
            $categorias[] = [
                "id" => $categoria["id"],
                "descripcion" => $categoria["descripcion"],
                "selected" => $categoriaSeleccionada
            ];
        }

        $dificultadesDisponibles = $this->model->obtenerDificultades();
        $dificultades = [];
        foreach ($dificultadesDisponibles as $dificultad) {
            $dificultadSeleccionada = $dificultad["id"] === $pregunta["dificultad"];
            $dificultades[] = [
                "id" => $dificultad["id"],
                "descripcion" => $dificultad["descripcion"],
                "selected" => $dificultadSeleccionada
            ];
        }

        $data = [
            "id_pregunta" => $id_pregunta,
            "descripcion" => $pregunta["descripcion"],
            "categorias" => $categorias,
            "dificultades" => $dificultades,
            "respuesta_A" => $respuestas[0]["descripcion"],
            "respuesta_B" => $respuestas[1]["descripcion"],
            "respuesta_C" => $respuestas[2]["descripcion"],
            "respuesta_D" => $respuestas[3]["descripcion"],
            "esCorrectaA" => $respuestas[0]["es_correcta"] === "1",
            "esCorrectaB" => $respuestas[1]["es_correcta"] === "1",
            "esCorrectaC" => $respuestas[2]["es_correcta"] === "1",
            "esCorrectaD" => $respuestas[3]["es_correcta"] === "1",
            "id_respuesta_A" => $respuestas[0]["id"] ?? "",
            "id_respuesta_B" => $respuestas[1]["id"] ?? "",
            "id_respuesta_C" => $respuestas[2]["id"] ?? "",
            "id_respuesta_D" => $respuestas[3]["id"] ?? "",
            "esEdicion" => true
        ];

        $this->presenter->render("view/preguntaView.mustache", $data);
    }

    public function actualizarPregunta()
    {
        $id_pregunta = $_POST["id_pregunta"] ?? "";
        $descripcion = $_POST["descripcion"] ?? "";
        $categoria = $_POST["categoria"] ?? "";
        $dificultad = $_POST["dificultad"] ?? "";
        $respuesta_A = $_POST["A"] ?? "";
        $respuesta_B = $_POST["B"] ?? "";
        $respuesta_C = $_POST["C"] ?? "";
        $respuesta_D = $_POST["D"] ?? "";
        $correcta = $_POST["correcta"] ?? "";
        $id_respuesta_A = $_POST["id_respuesta_A"] ?? "";
        $id_respuesta_B = $_POST["id_respuesta_B"] ?? "";
        $id_respuesta_C = $_POST["id_respuesta_C"] ?? "";
        $id_respuesta_D = $_POST["id_respuesta_D"] ?? "";

        $this->model->actualizarPregunta($descripcion, $categoria, $dificultad, $id_pregunta);
        $this->model->actualizarRespuestas($respuesta_A, $respuesta_B, $respuesta_C, $respuesta_D, $correcta, $id_respuesta_A, $id_respuesta_B, $id_respuesta_C, $id_respuesta_D);

        $this->mostrarPantallaEditor();
    }

    public function aprobarReporte()
    {
        $response = [];
        if (isset($_POST["id_reporte"])) {
            $id_reporte = $_POST["id_reporte"];
            $this->model->aprobarReporte($id_reporte);
            $response["status"] = "success";
        } else {
            $response["status"] = "error";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function rechazarReporte()
    {
        $response = [];
        if (isset($_POST["id_reporte"])) {
            $id_reporte = $_POST["id_reporte"];
            $this->model->rechazarReporte($id_reporte);
            $response["status"] = "success";
        } else {
            $response["status"] = "error";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}

