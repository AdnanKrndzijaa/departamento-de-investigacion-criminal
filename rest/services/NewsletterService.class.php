<?php

require_once __DIR__.'/DICService.class.php';
require_once __DIR__.'/../dao/NewsletterDao.class.php';


class NewsletterService extends DICService{

    public function __construct() {
        parent::__construct(new NewsletterDao());
    }

}

?>