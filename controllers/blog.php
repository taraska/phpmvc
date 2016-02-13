<?php

class Blog extends Controller
{
    function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    function index()
    {
        $this->view->title = 'Блог';
        $this->View();
    }

    /**
     * try insert date in table 'data'
     *
     * попытка вставить данные в таблицу 'data'
     */
    function insert()
    {
        $result = $this->model->Insert();
        if ($result == false) {
            $this->view->message = 'Вы совершили ошибку';
            $this->View();
        } else header('Location:..');

    }

    function DeleteListings()
    {
        $this->model->DeleteListings();
        header('location:..');

    }

    /** All data in table 'data' and view
     *
     * выводим все данные из таблицы data
     */
    protected function View()
    {
        $result = $this->model->GetListings();
        $this->view->result = $result;
        $this->view->render('blog/index', 1);
    }
}