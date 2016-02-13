<?php

class Error extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view->title='Ошибка 404';
        $this->view->message='Нет такой страницы';
        $this->view->render('error/header');
        $this->view->render('error/index');
        $this->view->render('error/footer');
    }
}