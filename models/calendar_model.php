<?php

class Calendar_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function create($data)
    {
        $this->db->insert('note', array('task' => $data['task'],
            'userid' => $_SESSION['userid'], 'date' => $data['date']));
    }

    function allList()
    {
        return $this->db->select('SELECT * FROM note WHERE userid =:userid',
            array('userid' => $_SESSION['userid']));
    }

    function noteSingleList($noteid)
    {
        return $this->db->select('SELECT * FROM note WHERE userid=:userid AND noteid=:noteid',
            array('userid' => $_SESSION['userid'], 'noteid' => $noteid));
    }

    function editSave($data)
    {
        $postData = array('task' => $data['task'], 'date' => $data['date']);

        $this->db->update('note', $postData,
            "userid = {$_SESSION['userid']} AND `noteid` = {$data['noteid']}");
    }

    function delete($id)
    {
        $this->db->delete('note', "noteid={$id['noteid']} AND userid='{$_SESSION['userid']}'");
    }
}