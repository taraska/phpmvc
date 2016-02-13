<?php

class Auth
{
    static function handleLogin()
    {
        session_start();
    }

    static function calendarLogin()
    {
        session_start();
        $logged = $_SESSION['loggedIn'];
        if (Session::get('role') != 'admin') {
            $logged = false;
        }
        if ($logged == false) {
            session_destroy();
            header('location:' . MAIN_URL . 'login');
            exit();
        }
    }
}