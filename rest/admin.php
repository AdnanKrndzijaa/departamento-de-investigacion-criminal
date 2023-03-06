<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/NewsDao.class.php';
require_once 'dao/WantedDao.class.php';
require_once 'dao/ReportsDao.class.php';

require_once '../vendor/autoload.php';

require_once __DIR__.'/routes/NewsRoutes.php';
require_once __DIR__.'/routes/WantedRoutes.php';
require_once __DIR__.'/routes/ReportsRoutes.php';

Flight::register('newsDao', 'NewsDao');
Flight::register('wantedDao', 'WantedDao');
Flight::register('reportsDao', 'ReportsDao');




?>