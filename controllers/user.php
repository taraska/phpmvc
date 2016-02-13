<?php

class User extends Controller
{
    function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    /**
     * users list
     *
     * вывод пользователей
     */

    function index()
    {
        $this->view->title = 'Пользователи';
        $this->view->userList = $this->model->userList();
        $this->view_user();
    }

    /**
     * create user
     *
     * создать пользователя
     */

    function create()
    {
        $data = array();
        $data['login'] = $_POST['login'];
        $data['password'] = $_POST['password'];
        $data['role'] = $_POST['role'];

        $this->model->create($data);
        header('Location:' . MAIN_URL . 'user');
    }

    /**
     * @param $id edit user
     *
     * редактирование пользователя
     */

    function edit($id)
    {
        $this->view->title = 'Редактирование';
        $this->view->user = $this->model->userSingleList($id);
        $this->view->render('user/edit', 1);
    }

    /**
     * @param $id edit and save user
     *
     * сохранение после редактирования
     */

    function editSave($id)
    {
        $data = array();
        $data['userid'] = $id;
        $data['login'] = $_POST['login'];
        $data['password'] = $_POST['password'];
        $data['role'] = $_POST['role'];

        $this->model->editSave($data);
        header('location: ' . MAIN_URL . 'user');
    }

    /**
     * @param $id delete user by id
     *
     * удаление пользователя по id
     */

    public function delete($id)
    {
        $this->model->delete($id);
        header('location: ' . MAIN_URL . 'user');
    }

    /**
     *  view_index
     */

    protected function view_user()
    {
        $this->view->render('user/index', 1);
    }
}