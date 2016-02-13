<?php

class Controller
{
    function __construct()
    {
        $this->view = new View();
    }

    /**
     * @param $name Name of the model
     * load existing model
     *
     * загружаем нужную модель
     */
    public function loadModel($name)
    {
        $path = MODELS . $name . '_model.php';

        if (file_exists($path)) {
            require $path;
            $modelName = $name . '_Model';
            $this->model = new $modelName;
        }
    }
}