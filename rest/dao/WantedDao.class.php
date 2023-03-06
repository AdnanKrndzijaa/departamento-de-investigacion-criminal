<?php

require_once __DIR__.'/DICDao.class.php';

class WantedDao extends DICDao {

public function __construct() {
    parent::__construct("wanted");
}

}


?>