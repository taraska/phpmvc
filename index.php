<?php

require 'configs/config.php';

function __autoload($class)
{
    require LIBS . $class . '.php';
}

$start = new Bootstrap();
$start->start();
