<?php

namespace model;

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerFechaLimiteSuperior($filtro)
    {
        $fechaActual = new \DateTime();
        switch ($filtro) {
            case 'dia':
                $fechaLimiteSuperior = $fechaActual;
                break;
            case 'semana':
                $fechaLimiteSuperior = $fechaActual->sub(new \DateInterval('P1W'));
                break;
            case 'mes':
                $fechaLimiteSuperior = $fechaActual->sub(new \DateInterval('P1M'));
                break;
            case 'anio':
                $fechaLimiteSuperior = $fechaActual->sub(new \DateInterval('P1Y'));
                break;
            default:
                return null;
        }
        return $fechaLimiteSuperior->format('Y-m-d');
    }

    public function consultarCantidadDeJugadoresTotales($fechaLimiteSuperior)
    {
        return $this->database->query("SELECT COUNT(rol) as cantidad FROM usuario WHERE rol = 'J' AND fecha_creacion  AND fecha_creacion <= '$fechaLimiteSuperior'")[0];
    }

    public function consultarCantidadDePartidasTotales($fechaLimiteInferior, $fechaLimiteSuperior)
    {
        return $this->database->query("SELECT COUNT(finalizada) as cantidad FROM partida WHERE finalizada = 1 AND fecha BETWEEN '$fechaLimiteInferior' AND '$fechaLimiteSuperior'")[0];
    }

    public function consultarCantidadDePreguntasTotales($fechaLimiteSuperior)
    {
        return $this->database->query("SELECT COUNT(id) as cantidad FROM pregunta WHERE fecha_creacion <= '$fechaLimiteSuperior'")[0];
    }

    public function consultarCantidadDePreguntasDeUsuarios($fechaLimiteSuperior)
    {
        return $this->database->query("SELECT COUNT(id) as cantidad FROM preguntas_de_usuario WHERE fecha <= '$fechaLimiteSuperior'")[0];
    }

    public function consultarCantidadDeJugadoresNuevos($fechaLimiteInferior, $fechaLimiteSuperior)
    {
        $fechaActual = date('Y-m-d');
        return $this->database->query("SELECT COUNT(fecha_creacion) as cantidad FROM usuario WHERE rol = 'J' AND fecha_creacion BETWEEN '$fechaLimiteInferior' AND '$fechaLimiteSuperior'")[0];
    }

    public function consultarCantidadDePreguntasRespondidasCorrectamente($fechaLimiteInferior, $fechaLimiteSuperior)
    {
        $entregadas = $this->database->query("SELECT SUM(cant_respondidas) AS cant_respondidas FROM usuario WHERE rol = 'J' AND fecha_creacion BETWEEN '$fechaLimiteInferior' AND '$fechaLimiteSuperior'")[0];
        $correctas = $this->database->query("SELECT SUM(cant_correctas) AS cant_correctas FROM usuario WHERE rol = 'J' AND fecha_creacion BETWEEN '$fechaLimiteInferior' AND '$fechaLimiteSuperior'")[0];
        if($entregadas["cant_respondidas"] == 0){
            return 0;
        }
        return number_format(($correctas["cant_correctas"] / $entregadas["cant_respondidas"]) * 100, 2, '.', '');
    }

    public function consultarCantidadDeUsuariosPorPais($fechaLimiteInferior, $fechaLimiteSuperior)
    {
        return $this->database->query("SELECT TRIM(SUBSTRING_INDEX(ubicacion, ',', -1)) AS categoria, COUNT(*) AS cantidad_usuarios FROM usuario WHERE rol = 'J' AND fecha_creacion BETWEEN '$fechaLimiteInferior' AND '$fechaLimiteSuperior' GROUP BY categoria ORDER BY cantidad_usuarios DESC");
    }

    public function consultarCantidadDeUsuariosPorSexo($fechaLimiteInferior, $fechaLimiteSuperior)
    {
        return $this->database->query("SELECT sexo as categoria, COUNT(*) AS cantidad_usuarios FROM usuario WHERE rol = 'J' AND fecha_creacion BETWEEN '$fechaLimiteInferior' AND '$fechaLimiteSuperior' GROUP BY categoria ORDER BY cantidad_usuarios DESC");
    }

    public function consultarCantidadDeUsuariosPorEdad($fechaLimiteInferior, $fechaLimiteSuperior)
    {
        return $this->database->query("SELECT CASE WHEN TIMESTAMPDIFF(YEAR, fecha, CURDATE()) < 18 THEN 'Menores' WHEN TIMESTAMPDIFF(YEAR, fecha, CURDATE()) BETWEEN 18 AND 64 THEN 'Medio' ELSE 'Jubilados' END AS categoria, COUNT(*) AS cantidad_usuarios FROM usuario WHERE rol = 'J' AND fecha_creacion BETWEEN '$fechaLimiteInferior' AND '$fechaLimiteSuperior' GROUP BY categoria ORDER BY categoria DESC");
    }

    public function guardarImagenTemporal()
    {
        $directorio_destino = './public/imagenes/';

        if (isset($_POST['imagen'])) {
            $imagen_base64 = $_POST['imagen'];

            $imagen_decodificada = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagen_base64));

            $nombre_archivo = 'grafico_' . $_SESSION["usuario"]["usuario"] . '.png';

            $ruta_destino = $directorio_destino . $nombre_archivo;

            if (file_put_contents($ruta_destino, $imagen_decodificada)) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Archivo subido correctamente a: ' . $ruta_destino
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error al guardar la imagen.'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se recibió ninguna imagen.'
            ]);
        }
    }


}
