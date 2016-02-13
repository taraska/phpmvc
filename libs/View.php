<?php

class View
{
    public $title = 'Календарь';

    function __construct()
    {

    }

    public function render($name, $header = false)
    {
        if($header == false)
        {
            require 'views/' . $name . '.php';
        }
        if ($header == true) {
            require 'views/header.php';
            require 'views/' . $name . '.php';
            require 'views/footer.php';
        }
    }
}