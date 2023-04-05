<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__.'/services/NewsService.class.php';
require_once __DIR__.'/services/ReportsService.class.php';
require_once __DIR__.'/services/WantedService.class.php';
require_once __DIR__.'/dao/AdminDao.class.php';
require_once __DIR__.'/services/NewsletterService.class.php';

Flight::register('newsletterService', 'NewsletterService');
Flight::register('newsService', 'NewsService');
Flight::register('reportsService', 'ReportsService');
Flight::register('wantedService', 'WantedService');
Flight::register('adminDao', 'AdminDao');


Flight::map('error', function(Exception $ex){
    Flight::json(['message' => $ex->getMessage()], 500);
});

Flight::route('/*', function(){
  $path = Flight::request()->url;

  $headers = getallheaders();
  if (@!$headers['Authorization']){
    Flight::json(["message" => "Authorization is missing"], 403);
    return FALSE;
  }else{
    try {
      $decoded = (array) JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
      Flight::set('admin', $decoded);
      return TRUE;
    } catch (\Exception $e) {
      Flight::json(["message" => "Authorization token is not valid"], 403);
      return FALSE;
    }
  }
});


require_once __DIR__.'/routes/NewsRoutes.php';
require_once __DIR__.'/routes/ReportsRoutes.php';
require_once __DIR__.'/routes/WantedRoutes.php';
require_once __DIR__.'/routes/AdminRoutes.php';
require_once __DIR__.'/routes/NewsletterRoutes.php';


Flight::start();

?>