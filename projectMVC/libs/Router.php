<?php

class Router
{
    private $url;
    private $controller;

    public function index($mode)
    {
        switch ($mode) {
            case 'Development':
                //display_errors - стоит ли выводить ошибки на экран
                ini_set('display_errors', 1);
                //какие ошибки попадут в отчет (логи)
                //добавлять в отчет список всех изменений
                error_reporting(E_ALL);
                break;
            case 'Test':
                ini_set('display_errors', 1);
                /*
                * Для отладки: NOTICE сообщения могут предупреждать о возможных ошибках в коде.
                * Например, использование непроинициализированных переменных вызовет подобное сообщение.
                * Это очень полезно при поиске опечаток и экономит время при отладке. NOTICE сообщения также предупреждают о плохом стиле.
                *
                * */
                //E_ALL + E_NOTICE и т.д.
                error_reporting(-1);
                break;
            case 'Production':
                ini_set('display_errors', 0);
                // Включать в отчет простые описания ошибок
                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                break;
            default:
                ini_set('display_errors', 1);
                error_reporting(E_ALL);
                break;
        }
        $this->toUrl();
    }

    private function toUrl()
    {
        $this->url = (!isset($_GET['url']) ? null : $_GET['url']);
        if (empty($this->url)) {
            $this->defaultController();
            exit();
        }
        $this->otherController();
    }

    private function defaultController()
    {
        $file = CONTROLLERS . 'Index.php';
        require $file;
        $controller = new Index();
        $controller->loadModel('index');
        $controller->index();
    }

    private function otherController()
    {
        $url = rtrim($this->url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $explodeUrl = explode('/', $url);
        $file = CONTROLLERS . $explodeUrl[0] . '.php';
        if (file_exists($file)) {
            require $file;
            $this->controller = new $explodeUrl[0];
            $this->controller->loadModel($explodeUrl[0]);
            $this->controllerMethod($explodeUrl);
        } else self::error("StartError:$explodeUrl[0];otherController/EndError Ошибка 404: URL введен некорректно");
    }

    private function controllerMethod($explodeUrl)
    {
        $length = count($explodeUrl);
        if (($length > 1 && !method_exists($this->controller, $explodeUrl[1])) || $length > 5) {
            static::error("StartError:$explodeUrl[0]/EndError Ошибка 404: URL введен некорректно");
            exit();
        }

        switch ($length) {
            case 5:
                $this->controller->{$explodeUrl[1]}($explodeUrl[2], $explodeUrl[3], $explodeUrl[4]);
                break;
            case 4:
                $this->controller->{$explodeUrl[1]}($explodeUrl[2], $explodeUrl[3]);
                break;
            case 3:
                $this->controller->{$explodeUrl[1]}($explodeUrl[2]);
                break;
            case 2:
                $this->controller->{$explodeUrl[1]}();
                break;
            default:
                $this->controller->index();
                break;
        }
        //!!!проверить потом на скорость если поставить здесь exit()!!!

    }

    static function error($message = null)
    {
        $file = CONTROLLERS . 'ErrorClass.php';
        require $file;
        $controller = new ErrorClass();
        $controller->index($message);
    }
}