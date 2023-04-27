<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

Flight::map('query_param', function($name, $default_value = 0){
    $request = Flight::request();
    $query_param = @$request->query->getData()[$name];
    $query_param = $query_param ? $query_param : $default_value; 
    return $query_param;  
  });

  /* utility function for getting header parameters */
Flight::map('header', function($name){
  $headers = getallheaders();
  return @$headers[$name];
});

Flight::map('jwt', function($user){
  $jwt = \Firebase\JWT\JWT::encode(["exp" => (time() + Config::JWT_TOKEN_TIME()), "id" => $user["id"], "username" =>$user["username"],"aid" => $user["id"], "r" => $user["type"]], Config::JWT_SECRET());
  
  return ["token" => $jwt];
});

require_once __DIR__.'/services/NewsService.class.php';
require_once __DIR__.'/services/ReportsService.class.php';
require_once __DIR__.'/services/WantedService.class.php';
require_once __DIR__.'/services/NewsletterService.class.php';
require_once __DIR__.'/services/MissingService.class.php';
require_once __DIR__.'/dao/AdminDao.class.php';

Flight::register('newsService', 'NewsService');
Flight::register('newsletterService', 'NewsletterService');
Flight::register('reportsService', 'ReportsService');
Flight::register('wantedService', 'WantedService');
Flight::register('missingService', 'MissingService');
Flight::register('adminDao', 'AdminDao');

require_once __DIR__.'/routes/middleware.php';
require_once __DIR__.'/routes/NewsRoutes.php';
require_once __DIR__.'/routes/NewsletterRoutes.php';
require_once __DIR__.'/routes/ReportsRoutes.php';
require_once __DIR__.'/routes/WantedRoutes.php';
require_once __DIR__.'/routes/AdminRoutes.php';
require_once __DIR__.'/routes/MissingRoutes.php';


Flight::start();

?>