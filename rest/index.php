<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

require_once __DIR__.'/services/NewsService.class.php';
require_once __DIR__.'/services/ReportsService.class.php';
require_once __DIR__.'/services/WantedService.class.php';
require_once __DIR__.'/dao/AdminDao.class.php';

Flight::register('newsService', 'NewsService');
Flight::register('reportsService', 'ReportsService');
Flight::register('wantedService', 'WantedService');
Flight::register('adminDao', 'AdminDao');

require_once __DIR__.'/routes/NewsRoutes.php';
require_once __DIR__.'/routes/ReportsRoutes.php';
require_once __DIR__.'/routes/WantedRoutes.php';
require_once __DIR__.'/routes/AdminRoutes.php';


Flight::start();

?>