<?php

class Blog_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function Insert()
    {
        if (isset($_POST['text']) || isset($_POST['title'])) {
            $text = htmlspecialchars(trim($_POST['text']));
            $title = htmlspecialchars(trim($_POST['title']));
            if ($text == "" || $title == "") {
                return false;
            } else
                $text = $_POST['text'];
            $title = $_POST['title'];
            $this->db->insert('data', array('text' => $text, 'title' => $title));
            return true;
        }
    }

    function GetListings()
    {
        $result = $this->db->select("SELECT * FROM data");
        return $result;
    }

    function DeleteListings()
    {
        if (isset($_POST['dataid'])) {
            $post = $_POST['dataid'];
            $this->db->delete('data', "`dataid` = $post");
        }
    }
}