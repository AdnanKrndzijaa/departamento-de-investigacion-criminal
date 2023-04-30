<?php

require_once __DIR__.'/DICService.class.php';
require_once __DIR__.'/../dao/NewsDao.class.php';


class NewsService extends DICService{

    public function __construct() {
        parent::__construct(new NewsDao());
    }
    public function get_by_title($title) {
        return $this->dao->get_by_title($title);
    }
    public function get_by_date($date) {
        return $this->dao->get_by_date($date);
    }

}

?>