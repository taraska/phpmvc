<?php

class Login extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view->title = 'Логин';
        $this->view->message = 'Вход';
        $this->view_login();
    }

    function run()
    {
        $run = $this->model->run();
        if ($run == false) {
            $this->view->message = 'Ошибка в авторизации';
            $this->view_login();
        }
    }

    protected function view_login()
    {
        $this->view->render('login/index', 1);
    }
}