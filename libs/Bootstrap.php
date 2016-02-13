<?php

class Bootstrap
{
    private $url = null;
    private $controller;
    private $_errorFile = 'error.php';
    private $_defaultFile = 'index.php';

    function __construct()
    {

    }

    /**
     * start the Bootstrap
     * @return boolean
     *
     * запускаем код
     */

    public function start()
    {
        $this->getUrl();

        if (empty($this->url[0])) {
            $this->loadDefaultController();
            return false;
        } else $this->loadExistingController();
        $this->callControllerMethod();
    }

    /**
     * Fetches the $_GET['url']
     *
     * формируем $_GET['url']
     *
     */

    private function getUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->url = explode('/', $url);
    }

    /**
     * if no GET parameter - load default index
     * если нету GET - загружаем index
     */

    private function loadDefaultController()
    {
        require CONTROLLERS . $this->_defaultFile;
        $this->controller = new Index();
        $this->controller->index();
    }

    /**
     * load existing Controller
     * @return boolean
     * загружаем нужный Controller
     */

    private function loadExistingController()
    {
        $file = CONTROLLERS . $this->url[0] . '.php';

        if (file_exists($file)) {
            require $file;
            $this->controller = new $this->url[0];
            $this->controller->loadModel($this->url[0]);

        } else $this->error();
        return false;

    }

    /** method GET url parameter
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     *
     * передаём параметры в метод
     */

    private function callControllerMethod()
    {
        $length = count($this->url);

        if ($length > 1 && !method_exists($this->controller, $this->url[1])) {
            $this->error();
        }

        //передаём параметры
        //pass params

        switch ($length) {
            case 5:
                // Controller->Method(Param1,2,3)
                $this->controller->{$this->url[1]}($this->url[2], $this->url[3], $this->url[4]);
                break;
            case 4:
                $this->controller->{$this->url[1]}($this->url[2], $this->url[3]);
                break;
            case 3:
                $this->controller->{$this->url[1]}($this->url[2]);
                break;
            case 2:
                $this->controller->{$this->url[1]}();
                break;
            default:
                $this->controller->index();
                break;
        }
    }


    /**
     * Error 404
     * ошибка 404
     */

    private function error()
    {
        require CONTROLLERS . $this->_errorFile;
        $this->controller = new Error();
        $this->controller->index();
        exit();
    }

}

