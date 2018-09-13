<?php

class Controller
{
    protected $view;
    protected $model;

    protected function __construct()
    {
        $this->view = new View();
        Session::sessionStart();
    }

    public function loadModel($name)
    {
        $name = $name . 'Model';
        $path = MODELS . $name . '.php';

        if (file_exists($path)) {
            require $path;
            $this->model = new $name();
        }
    }
}