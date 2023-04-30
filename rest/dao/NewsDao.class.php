<?php

require_once __DIR__.'/DICDao.class.php';

class NewsDao extends DICDao {

    public function __construct() {
        parent::__construct("news");
    }

    public function get_by_title($title){
        $title=strtolower($title);
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE LOWER(title) LIKE '%".$title."%'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_by_date($date) {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE date=:date");
        $stmt->execute(['date'=>$date]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result); 
    }

}


?>