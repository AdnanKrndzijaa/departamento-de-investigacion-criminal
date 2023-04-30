<?php

require_once __DIR__.'/DICService.class.php';
require_once __DIR__.'/../dao/WantedDao.class.php';


class WantedService extends DICService{

    public function __construct() {
        parent::__construct(new WantedDao());
    }

    public function get_by_name_desc($name_desc) {
        return $this->dao->get_by_name_desc($name_desc);
    }

}

?>