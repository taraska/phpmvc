<?php

class Reg extends Controller
{
    function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    function index()
    {
        $this->view->message = 'Заполните все поля';
        $this->view->title = 'Регистрация';
        $this->view->render('reg/index', 1);
    }

    /**
     * registration user by password and login
     *
     * регистрируем пользователя по логину и паролю
     */

    function save()
    {
        $login = $_POST['login'];
        $pass = $_POST['password'];

        if (isset($login) && isset($pass)) {
            if ($login != "" && $pass != "") {

                $this->model->save($login, $pass);
                header('Location:' . MAIN_URL . 'login');
            } else
                $this->view->message = 'У вас путой Пароль или Логин';
            $this->view->render('reg/index', 1);
        }
    }
}