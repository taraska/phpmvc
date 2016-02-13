<?php

class Reg_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function save($login, $pass)
    {
        trim($login);
        trim($pass);
        $data = array('login' => $login, 'password' => Hash::create('md5', $pass, HASH_PASSWORD_KEY));
        $this->db->insert('users', $data);
    }
}