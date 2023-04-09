<?php

require_once __DIR__.'/DICDao.class.php';

class MissingDao extends DICDao {

    public function __construct() {
        parent::__construct("missing");
    }

}


?>