<?php

class Login_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $user = $this->db->prepare("SELECT userid, role FROM users WHERE login=:login AND password=:password");
        $user->execute(array(
            ':login' => $_POST['login'],
            ':password' => Hash::create('md5', $_POST['password'], HASH_PASSWORD_KEY)
        ));

        $data = $user->fetch();

        $count = $user->rowCount();
        if ($count > 0) {
            //login
            //вход
            Session::init();
            Session::set('role', $data['role']);
            Session::set('loggedIn', $data['userid']);
            Session::set('userid', $data['userid']);
            header('location: ../blog');
        } else {
            return false;
        }
    }
}