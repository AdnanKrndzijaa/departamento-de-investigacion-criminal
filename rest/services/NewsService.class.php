<?php

require_once __DIR__.'/DICService.class.php';
require_once __DIR__.'/../dao/NewsDao.class.php';


class NewsService extends DICService{

    public function __construct() {
        parent::__construct(new NewsDao());
    }

}

?>