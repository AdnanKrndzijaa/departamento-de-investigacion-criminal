<?php

require_once __DIR__.'/DICDao.class.php';

class NewsletterDao extends DICDao {

    public function __construct() {
        parent::__construct("newsletter");
    }

}


?>