<?php

class Session
{
    static function init()
    {
        session_start();
    }

    static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else return false;
    }

    static function destroy()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}