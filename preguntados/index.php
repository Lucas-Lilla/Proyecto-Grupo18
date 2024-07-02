<?php
include_once("Configuration.php");
$router = Configuration::getRouter();
session_start();
$controller = isset($_GET["controller"]) ? $_GET["controller"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "";

$_SESSION['showUsuario'] = isset($_SESSION['usuario']) ?? false;
$_SESSION['usuario'] = $_SESSION['usuario'] ?? "";


$router->route($controller, $action);

?>





