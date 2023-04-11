<?php

require_once __DIR__.'/DICDao.class.php';

class NewsDao extends DICDao {

    public function __construct() {
        parent::__construct("news");
    }

    public function get_by_date($date) {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE date=:date");
        $stmt->execute(['date'=>$date]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result); 
    }

}


?>