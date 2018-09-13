<?php

class Session
{
    private static $inst;

    private function __construct()
    {
        session_start();
    }

    static public function sessionStart()
    {
        if (empty(self::$inst)) {
            self::$inst = new self();
        } else return self::$inst;
    }

    static public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    static public function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else return false;
    }

    static public function unsetSession($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    static public function destroySession()
    {
        session_destroy();
    }

    static public function setDoubleArraySession($mainKey, $key, $array = array())
    {
        $_SESSION[$mainKey][$key] = $array;
    }

    static public function unsetDoubleArraySession($mainKey, $key)
    {
        if (isset($_SESSION[$mainKey][$key])) {
            unset($_SESSION[$mainKey][$key]);
        }
    }
}