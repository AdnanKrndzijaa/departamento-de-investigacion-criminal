<?php

require_once __DIR__.'/DICDao.class.php';

class AdminDao extends DICDao {

    public function __construct() {
        parent::__construct("admin");
    }

    public function get_user_by_email($email) {
        return $this->query_unique("SELECT * FROM admin WHERE email = :email", ['email' => $email]);
    }

}


?>