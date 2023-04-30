<?php

require_once __DIR__.'/DICDao.class.php';

class ReportsDao extends DICDao {

public function __construct() {
    parent::__construct("reports");
}

public function get_by_name($name){
    $name=strtolower($name);
    $stmt = $this->conn->prepare("SELECT * FROM reports WHERE LOWER(first_name) LIKE '%".$name."%' OR LOWER(last_name) LIKE '%".$name."%'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}


?>