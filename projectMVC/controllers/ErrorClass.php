<?php
class ErrorClass extends Controller
{
    public function __construct()
    {
        parent::__construct();
        BreadCrumbs::$arrayReplace = ['error' => 'Ошибка'];
        $this->view->breadCrumbs = BreadCrumbs::breadCrumbs($_SERVER["REQUEST_URI"]);
        $this->view->metaAuthor = "Автор";
        $this->view->title = "Ошибка";
        $this->view->metaKeywords = "Ключевые слова";
        $this->view->metaDescription = "Описание";
    }

    public function index($message = null)
    {
        $message = ($message != null) ? $this->messagePregMatch($message) : "Неизвестная ошибка";
        $this->view->message = $message;
        $this->view->render('error/error', true);
    }

    public function messagePregMatch($message)
    {
        $pattern = '/^StartError:.*\/EndError/';
        if (preg_match($pattern, $message, $found)) {
            $message = preg_split($pattern, $message, -1, PREG_SPLIT_NO_EMPTY);
            $this->view->errorMessage = $found[0];
            return $message[0];
        }
        return $message;
    }
}