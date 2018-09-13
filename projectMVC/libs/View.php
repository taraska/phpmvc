<?php

class View
{
    public $title;
    public $metaDescription;
    public $metaAuthor;
    public $metaKeywords;

    public function __construct()
    {

    }

    public function render($name, $otherView = false)
    {
        if ($otherView != false) {
            require VIEWS . $name . '.php';
        } else {
            require VIEWS . 'header.php';
            require VIEWS . $name . '.php';
            require VIEWS . 'footer.php';
        }
    }

    public function adminRender($name)
    {
        require ADMIN_VIEWS . 'header.php';
        require ADMIN_VIEWS . $name . '.php';
        require ADMIN_VIEWS . 'footer.php';
    }
}