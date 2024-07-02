<?php

namespace model;

class EditorModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerCategorias()
    {
        return $this->database->query("SELECT * FROM categoria");
    }

    public function obtenerDificultades()
    {
        return $this->database->query("SELECT * FROM dificultad");
    }

    public function obtenerPreguntas()
    {
        return $this->database->query("SELECT * FROM pregunta");
    }

    public function guardarPregunta($descripcion, $categoria, $dificultad)
    {
        return $this->database->insertAndReturnId("INSERT INTO pregunta (descripcion, categoria, dificultad) VALUES ('$descripcion', '$categoria', '$dificultad')");
    }

    public function guardarRespuestas($respuesta_A, $respuesta_B, $respuesta_C, $respuesta_D, $correcta, $id_pregunta)
    {
        $respuestas = [
            'A' => $respuesta_A,
            'B' => $respuesta_B,
            'C' => $respuesta_C,
            'D' => $respuesta_D
        ];

        foreach ($respuestas as $opcion => $respuesta) {
            $es_correcta = ($correcta === $opcion) ? 1 : 0;
            $this->database->execute("INSERT INTO respuesta (descripcion, es_correcta, id_pregunta) VALUES ('$respuesta', '$es_correcta',  '$id_pregunta')");
        }

    }

    public function eliminarPregunta($id_pregunta)
    {
        $this->database->execute("DELETE FROM pregunta WHERE id = '$id_pregunta'");
    }

    public function eliminarPreguntaSugerida($id_pregunta)
    {
        $this->database->execute("DELETE FROM preguntas_de_usuario WHERE id = '$id_pregunta'");
    }

    public function buscarPregunta($id_pregunta)
    {
        return $this->database->query("SELECT * FROM pregunta WHERE id = '$id_pregunta'")[0];
    }

    public function buscarRespuestas($id_pregunta)
    {
        return $this->database->query("SELECT * FROM respuesta WHERE id_pregunta = '$id_pregunta'");
    }

    public function actualizarPregunta($descripcion, $categoria, $dificultad, $id_pregunta)
    {
        $this->database->execute("UPDATE pregunta SET descripcion = '$descripcion', categoria = '$categoria', dificultad = '$dificultad' WHERE id = '$id_pregunta'");
    }

    public function actualizarRespuestas($respuesta_A, $respuesta_B, $respuesta_C, $respuesta_D, $correcta, $id_respuesta_A, $id_respuesta_B, $id_respuesta_C, $id_respuesta_D)
    {
        $respuestas = [
            'A' => ['respuesta' => $respuesta_A, 'id_respuesta' => $id_respuesta_A],
            'B' => ['respuesta' => $respuesta_B, 'id_respuesta' => $id_respuesta_B],
            'C' => ['respuesta' => $respuesta_C, 'id_respuesta' => $id_respuesta_C],
            'D' => ['respuesta' => $respuesta_D, 'id_respuesta' => $id_respuesta_D]
        ];

        foreach ($respuestas as $opcion => $data) {
            $respuesta = $data['respuesta'];
            $id_respuesta = $data['id_respuesta'];
            $es_correcta = ($correcta === $opcion) ? 1 : 0;

            $this->database->execute("UPDATE respuesta SET descripcion = '$respuesta', es_correcta = '$es_correcta' WHERE id = '$id_respuesta'");
        }
    }

    public function obtenerPreguntasReportadas()
    {
        $resultados = $this->database->query("
        SELECT 
            pr.id as pregunta_reportada_id, 
            pr.id_pregunta, 
            pr.reporte, 
            pr.fecha_creacion as reporte_fecha_creacion,
            p.descripcion as pregunta_descripcion, 
            p.categoria, 
            p.dificultad, 
            p.cant_aciertos, 
            p.cant_entregadas,
            r.id as respuesta_id, 
            r.descripcion as respuesta_descripcion, 
            r.es_correcta
        FROM pregunta_reportada pr
        JOIN pregunta p ON pr.id_pregunta = p.id
        JOIN respuesta r ON p.id = r.id_pregunta
        WHERE pr.resuelto = 0
        ORDER BY pr.id, pr.id_pregunta ASC
    ");

        $preguntasReportadas = [];
        foreach ($resultados as $resultado) {
            $id_pregunta = $resultado['id_pregunta'];

            if (!isset($preguntasReportadas[$id_pregunta])) {
                $preguntasReportadas[$id_pregunta] = [
                    'id_pregunta' => $resultado['id_pregunta'],
                    'pregunta_descripcion' => $resultado['pregunta_descripcion'],
                    'categoria' => $this->encontrarCategoria($resultado['categoria']),
                    'dificultad' => $this->encontrarDificultad($resultado['dificultad']),
                    'cant_aciertos' => $resultado['cant_aciertos'],
                    'cant_entregadas' => $resultado['cant_entregadas'],
                    'respuestas' => [],
                    'reportes' => []
                ];
            }

            $respuestaExiste = false;
            foreach ($preguntasReportadas[$id_pregunta]['respuestas'] as $respuesta) {
                if ($respuesta['respuesta_id'] == $resultado['respuesta_id']) {
                    $respuestaExiste = true;
                    break;
                }
            }
            if (!$respuestaExiste) {
                $preguntasReportadas[$id_pregunta]['respuestas'][] = [
                    'respuesta_id' => $resultado['respuesta_id'],
                    'respuesta_descripcion' => $resultado['respuesta_descripcion'],
                    'es_correcta' => $resultado['es_correcta']
                ];
            }

            $reporteExiste = false;
            foreach ($preguntasReportadas[$id_pregunta]['reportes'] as $reporte) {
                if ($reporte['pregunta_reportada_id'] == $resultado['pregunta_reportada_id']) {
                    $reporteExiste = true;
                    break;
                }
            }
            if (!$reporteExiste) {
                $preguntasReportadas[$id_pregunta]['reportes'][] = [
                    'pregunta_reportada_id' => $resultado['pregunta_reportada_id'],
                    'reporte' => $resultado['reporte'],
                    'reporte_fecha_creacion' => $resultado['reporte_fecha_creacion']
                ];
            }
        }
        return array_values($preguntasReportadas);
    }

    public function encontrarCategoria($id)
    {
        return $this->database->query("SELECT descripcion FROM categoria WHERE id = '$id'")[0]["descripcion"];
    }

    public function encontrarDificultad($id)
    {
        return $this->database->query("SELECT descripcion FROM dificultad WHERE id = '$id'")[0]["descripcion"];
    }

    public function aprobarReporte($id_reporte)
    {
        $this->database->execute("UPDATE pregunta_reportada SET resuelto = 1 WHERE id = '$id_reporte'");
    }

    public function rechazarReporte($id_reporte)
    {
        $this->database->execute("DELETE FROM pregunta_reportada WHERE id = '$id_reporte'");
    }
    public function obtenerPreguntasSugeridas()
    {
        return $this->database->query("SELECT * FROM preguntas_de_usuario");
    }
}
