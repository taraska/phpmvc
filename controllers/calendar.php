<?php

class Calendar extends Controller
{
    function __construct()
    {
        parent::__construct();
        Auth::calendarLogin();
    }

    function index()
    {
        $this->view->title = 'Календарь жизни';
        $this->view->allList = $this->model->allList();
        $this->view->render('calendar/index', 1);
    }

    /**
     * Create note to table note
     *
     * Создаём заметку
     */

    function input()
    {
        $data = array('task' => $_POST['task'], 'date' => $_POST['date']);
        $this->model->create($data);
        header('Location: ..');
    }

    /**
     * @param $id note id for edit
     *
     * Получаем id для редактирования на сранице edit.php
     */

    function edit($id)
    {
        $this->view->note = $this->model->noteSingleList($id);
        if (empty($this->view->note)) {
            die('Нет такой задачи');
        }

        $this->view->title = 'Редактирование';
        $this->view->render('calendar/edit', 1);
    }

    /**
     * @param $id note for edit and save this
     *
     * редактируем и сохраняем запись по id
     */

    function editSave($id)
    {
        $data = array('task' => $_POST['task'], 'date' => $_POST['date'], 'noteid' => $id);

        $this->model->editSave($data);
        header('Location:' . MAIN_URL . 'calendar');
    }

    /**
     * @param $id note for delete from table note
     *
     * удаляем по id запись из таблицы note
     */
    function delete($id)
    {
        $this->model->delete($id);
        header('Location:' . MAIN_URL . 'calendar');
    }
}