<?php

require_once __DIR__.'/DICService.class.php';
require_once __DIR__.'/../dao/ReportsDao.class.php';


class ReportsService extends DICService{

    public function __construct() {
        parent::__construct(new ReportsDao());
    }

    public function get_by_name($name) {
        return $this->dao->get_by_name($name);
    }

}

?>