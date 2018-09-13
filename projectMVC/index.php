<?php
require 'configs/configuration.php';
function __autoload($className)
{
    require LIBS . $className . '.php';
}

//режим разработки Test, Production, Development
/**
 *  Test - режим тестирования
 *  Development - режим разработки
 *  Production - режим реализации
 */
$mode = 'Development';
$start = new Router();
$start->index($mode);