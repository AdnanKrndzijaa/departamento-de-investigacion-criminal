<?php

require_once __DIR__.'/DICDao.class.php';

class NewsDao extends DICDao {

    public function __construct() {
        parent::__construct("news");
    }

}


?>