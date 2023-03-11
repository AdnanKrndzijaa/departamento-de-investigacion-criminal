<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/services/NewsService.class.php';


require_once '../vendor/autoload.php';

Flight::register('newsService', 'NewsService');

require_once __DIR__.'/routes/NewsRoutes.php';



Flight::start();

?>