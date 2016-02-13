<?php

class Index extends Controller
{
    function __construct()
    {
        parent::__construct();
        session::init();
    }

    function index()
    {
        // 1 include header.php and footer.php
        // 1 подключает шапку и подвал сайта

        if (!empty($_GET['url'])) {
            $this->viewFile();
        }
        $this->view->render('index/index', 1);
    }

    /**
     * load files on server
     *
     * загрузка файлов на сервер
     */

    function loadFile()
    {
        $files = $_FILES['files'];
        $this->model->loadFile($files);
        header('Location:' . MAIN_URL . 'index');
    }

    /**
     * files list
     *
     * просмотр файлов
     */

    function viewFile()
    {
        $result = $this->model->viewFile();
        $this->view->result_view = $result;
    }

    /**
     * download and view
     *
     * скачивания и просмотр
     */

    function download()
    {
        $this->model->download();
    }
}