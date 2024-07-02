<?php
namespace controller;
use helper\QrUtils;

require_once __DIR__ . '/../helper/QrUtils.php';

class RankingController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function mostrarPantallaRanking()
    {
        $usuario = $_SESSION["usuario"]["usuario"];
        $ranking = $this->model->obtenerRanking();
        $posicion = 1;
        $rankingIndividual = $this->model->obtenerRankingIndividual($usuario);
        $posicionIndividual = 1;
        $rankingIndividualPosicion = array();
        $ranking_con_posicion = array();

        foreach ($ranking as $fila) {
            $fila['posicion'] = $posicion;
            $fila['isFirst'] = $posicion === 1;
            $fila['isSecond'] = $posicion === 2;
            $fila['isThird'] = $posicion === 3;

            $datosUsuario = $this->model->buscarUsuario($fila['usuario']);

            if ($datosUsuario) {
                $imagenRuta = !empty($datosUsuario["imagen"]) ? $datosUsuario["imagen"] : "/preguntados/public/imagenesPerfil/fotoDefault.png";
                if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imagenRuta)) {
                    $imagenRuta = "/preguntados/public/imagenesPerfil/fotoDefault.png";
                }
                $fila['imagen'] = $imagenRuta;
            } else {
                $fila['imagen'] = "/preguntados/public/imagenesPerfil/fotoDefault.png";
            }
            $urlPerfil = 'http://localhost/preguntados/perfil/mostrarPantallaPerfilPublico?usuario=' . $fila['usuario'];
            $pathQR = './public/qrcodes/' . $fila['usuario'] . '.png';
            QrUtils::generarQR($urlPerfil, $pathQR);
            $fila['qr_code'] = '/preguntados/public/qrcodes/' . $fila['usuario'] . '.png';

            $ranking_con_posicion[] = $fila;
            $posicion++;
        }

        foreach ($rankingIndividual as $fila) {
            $fila['posicionIndividual'] = $posicionIndividual;
            $rankingIndividualPosicion[] = $fila;
            $posicionIndividual++;
        }

        $data = [
            "usuario" => $usuario,
            "usuarioIndividual" => $usuario,
            "ranking" => $ranking_con_posicion,
            "rankingIndividual" => $rankingIndividualPosicion
        ];

        $this->presenter->render("view/rankingView.mustache", $data);
    }
}