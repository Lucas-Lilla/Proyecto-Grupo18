<?php

namespace controller;

class HomeController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }
    public function mostrarPantallaPrincipal()
    {
        $data = null;
        $this->presenter->render("view/homeView.mustache", $data);
    }

}

