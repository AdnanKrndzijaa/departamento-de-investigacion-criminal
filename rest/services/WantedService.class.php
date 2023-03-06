<?php

require_once __DIR__.'/DICService.class.php';
require_once __DIR__.'/../dao/WantedDao.class.php';


class WantedService extends DICService{

    public function __construct() {
        parent::__construct(new WantedDao());
    }

}

?>