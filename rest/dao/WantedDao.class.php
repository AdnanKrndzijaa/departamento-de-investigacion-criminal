<?php

require_once __DIR__.'/DICDao.class.php';

class WantedDao extends DICDao {

public function __construct() {
    parent::__construct("wanted");
}

public function get_by_name_desc($name_desc){
    $name_desc=strtolower($name_desc);
    $stmt = $this->conn->prepare("SELECT * FROM wanted WHERE LOWER(first_name) LIKE '%".$name_desc."%' OR LOWER(last_name) LIKE '%".$name_desc."%' OR LOWER(description) LIKE '%".$name_desc."%'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}


?>