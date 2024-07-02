<?php

//Controllers
use controller\HomeController;
use controller\IniciarSesionController;
use controller\JugarPartidaController;
use controller\LobbyController;
use controller\RegistrarController;
use controller\PerfilController;
use controller\RankingController;
use controller\AdminController;
use controller\EditorController;

//Models
use model\HomeModel;
use model\IniciarSesionModel;
use model\JugarPartidaModel;
use model\LobbyModel;
use model\RegistrarModel;
use model\PerfilModel;
use model\RankingModel;
use model\AdminModel;
use model\EditorModel;

//Controllers
include_once("controller/HomeController.php");
include_once("controller/IniciarSesionController.php");
include_once("controller/JugarPartidaController.php");
include_once("controller/LobbyController.php");
include_once("controller/RegistrarController.php");
include_once("controller/PerfilController.php");
include_once("controller/RankingController.php");
include_once("controller/AdminController.php");
include_once("controller/EditorController.php");

//Models
include_once("model/HomeModel.php");
include_once("model/IniciarSesionModel.php");
include_once("model/JugarPartidaModel.php");
include_once("model/LobbyModel.php");
include_once("model/RegistrarModel.php");
include_once("model/PerfilModel.php");
include_once("model/RankingModel.php");
include_once("model/AdminModel.php");
include_once("model/EditorModel.php");

//Helpers
include_once("helper/Database.php");
include_once("helper/Router.php");
include_once("helper/MustachePresenter.php");
include_once("helper/PdfCreator.php");

//Vendors
include_once('vendor/mustache/src/Mustache/Autoloader.php');
include_once('vendor/dompdf/autoload.inc.php');

class Configuration
{

    // CONTROLLERS
    public static function getHomeController()
    {
        return new HomeController(self::getHomeModel(), self::getPresenter());
    }
    public static function getIniciarSesionController()
    {
        return new IniciarSesionController(self::getIniciarSesionModel(), self::getPresenter());
    }
    public static function getJugarPartidaController()
    {
        return new JugarPartidaController(self::getJugarPartidaModel(), self::getPresenter());
    }
    public static function getLobbyController()
    {
        return new LobbyController(self::getLobbyModel(), self::getPresenter());
    }
    public static function getRegistrarController()
    {
        return new RegistrarController(self::getRegistrarModel(), self::getPresenter());
    }

    public static function getPerfilController()
    {
        return new PerfilController(self::getPerfilModel(), self::getPresenter());
    }
    public static function getRankingController()
    {
        return new RankingController(self::getRankingModel(), self::getPresenter());
    }
    public static function getAdminController()
    {
        return new AdminController(self::getAdminModel(), self::getPresenter(), self::getPdfCreator());
    }
    public static function getEditorController()
    {
        return new EditorController(self::getEditorModel(), self::getPresenter());
    }


    // MODELS
    private static function getHomeModel()
    {
        return new HomeModel(self::getDatabase());
    }
    private static function getIniciarSesionModel()
    {
        return new IniciarSesionModel(self::getDatabase());
    }
    private static function getJugarPartidaModel()
    {
        return new JugarPartidaModel(self::getDatabase());
    }
    private static function getLobbyModel()
    {
        return new LobbyModel(self::getDatabase());
    }
    private static function getRegistrarModel()
    {
        return new RegistrarModel(self::getDatabase());
    }
    private static function getPerfilModel()
    {
        return new PerfilModel(self::getDatabase());
    }
    private static function getRankingModel()
    {
        return new RankingModel(self::getDatabase());
    }
    private static function getAdminModel()
    {
        return new AdminModel(self::getDatabase());
    }
    private static function getEditorModel()
    {
        return new EditorModel(self::getDatabase());
    }



    // HELPERS
    public static function getDatabase()
    {
        $config = self::getConfig();
        return new Database($config["servername"], $config["username"], $config["password"], $config["dbname"]);
    }
    private static function getConfig()
    {
        return parse_ini_file("config/configuration.ini");
    }

    public static function getRouter()
    {
        return new Router("getHomeController", "mostrarPantallaPrincipal");
    }

    private static function getPresenter()
    {
        return new MustachePresenter("view/template");
    }

    private static function getPdfCreator()
    {
        return new PdfCreator();
    }

}