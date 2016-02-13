<?php

class Logout extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        Session::destroy();
        header('Location:' . MAIN_URL . 'blog');
        exit();
    }
}