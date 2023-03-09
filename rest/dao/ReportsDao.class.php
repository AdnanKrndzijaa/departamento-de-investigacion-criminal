<?php

require_once __DIR__.'/DICDao.class.php';

class ReportsDao extends DICDao {

public function __construct() {
    parent::__construct("reports");
}

}


?>