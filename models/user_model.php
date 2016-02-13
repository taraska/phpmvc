<?php

class User_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function userSingleList($userid)
    {
        return $this->db->select("SELECT userid, login, role FROM users
                                  WHERE userid=:userid", array(':userid' => $userid));
    }

    function userList()
    {
        return $this->db->select("SELECT userid, login, role FROM users");
    }

    function create($data)
    {
        $this->db->insert('users', array(
            'login' => $data['login'],
            'password' => Hash::create('md5', $data['password'], HASH_PASSWORD_KEY),
            'role' => $data['role']));
    }

    function editSave($data)
    {
        $postData = array(
            'login' => $data['login'],
            'password' => Hash::create('md5', $data['password'], HASH_PASSWORD_KEY),
            'role' => $data['role']
        );

        $this->db->update('users', $postData, "userid={$data['userid']}");
    }

    function delete($userid)
    {
        $result = $this->db->select('SELECT role FROM users WHERE userid=:userid',
            array(':userid' => $userid));

        if ($result[0]['role'] == 'admin') return false;

        $this->db->delete('users', "userid = '$userid'");
    }
}