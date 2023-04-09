<?php

require_once __DIR__.'/DICService.class.php';
require_once __DIR__.'/../dao/MissingDao.class.php';


class MissingService extends DICService{

    public function __construct() {
        parent::__construct(new MissingDao());
    }

}

?>