<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
require_once("rest/dao/ProjectDao.class.php");

$dao = new ProjectDao();
$op = $_REQUEST['op'];

switch ($op) {
    case 'insert':
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $date = $_REQUEST['date'];
        $dao->add($title, $date, $description);
        break;
    
    case 'delete':
        $id = $_REQUEST['id'];
        $dao->delete($id);
        echo "deleted $id";
        break;

    case 'update':
        $id = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $date = $_REQUEST['date'];
        $dao->update($id, $title, $date, $description);
        echo "updated $id";
        break;
    
    case 'get':
    default:
        $results = $dao->get_all();
        print_r($results);
        break;
}

?>