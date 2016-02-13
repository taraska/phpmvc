<?php

class Index_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function loadFile($files)
    {
        if (isset($files)) {
            print_r($files);
            for ($count = 0; $count <= 2; $count++) {
                if (is_uploaded_file($files['tmp_name'][$count])) {
                    move_uploaded_file($files['tmp_name'][$count], $_SERVER['DOCUMENT_ROOT'] . '/my_mvc/files/' . $files['name'][$count]);
                }
            }
        }
    }

    function viewFile()
    {
        $files_array = array();
        $entry = opendir($_SERVER['DOCUMENT_ROOT'] . '/my_mvc/files/');
        if ($entry == true) {
            while (false !== ($files = readdir($entry))) {
                if ($files != "." && $files != "..") {
                    $files_array[] = $files;
                }

            }
            closedir($entry);
            return $files_array;
        }
    }

    function download()
    {
        if (isset($_GET['action']) and ($_GET['action'] == 'view' or $_GET['action'] == 'download') and isset($_GET['id'])) {
            $value = $_GET['id'];
            if ($_GET['action'] == 'download') {
                $path = $_SERVER['DOCUMENT_ROOT'] . '/my_mvc/files/';
                if (file_exists($path . $value)) {
                    if (ob_get_level()) {
                        ob_end_clean();
                    }
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename=' . basename($path . $value));
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($path . $value));
                    readfile($path . $value);
                    exit();
                }
            }

            if ($_GET['action'] = 'view') {
                $path = $_SERVER['DOCUMENT_ROOT'] . '/my_mvc/files/';
                if (file_exists($path . $value)) {
                    if (ob_get_level()) {
                        ob_end_clean();
                    }
                    header('Content-Type: image/jpeg');
                    readfile($path . $value);
                }
            }
        }
    }
}
