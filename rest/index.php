<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once __DIR__.'/services/NewsService.class.php';
require_once __DIR__.'/services/ReportsService.class.php';
require_once __DIR__.'/services/WantedService.class.php';
require_once __DIR__.'/services/NewsletterService.class.php';
require_once __DIR__.'/services/MissingService.class.php';
require_once __DIR__.'/dao/AdminDao.class.php';

Flight::register('adminDao', 'AdminDao');
Flight::register('newsService', 'NewsService');
Flight::register('newsletterService', 'NewsletterService');
Flight::register('reportsService', 'ReportsService');
Flight::register('wantedService', 'WantedService');
Flight::register('missingService', 'MissingService');


Flight::map('error', function(Exception $ex){
    // Handle error
    Flight::json(['message' => $ex->getMessage()], 500);
});

/* utility function for reading query parameters from URL */
Flight::map('query', function($name, $default_value = NULL){
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $default_value;
  return urldecode($query_param);
});

Flight::route('/*', function(){
  //return TRUE;
  //perform JWT decode
  $path = Flight::request()->url;
  if ($path == '/login' || $path == '/login.html' || $path == '/news' || $path == '/missing' || $path == '/wanted' || $path == '/newsletter') return TRUE; // exclude login route from middleware

  $headers = getallheaders();
  if (@!$headers['Authorization']){
    Flight::json(["message" => "Authorization is missing"], 403);
    return FALSE;
  }else{
    try {
      $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
      Flight::set('user', $decoded);
      return TRUE;
    } catch (\Exception $e) {
      Flight::json(["message" => "Authorization token is not valid"], 403);
      return FALSE;
    }
  }
});


require_once __DIR__.'/routes/NewsRoutes.php';
require_once __DIR__.'/routes/NewsletterRoutes.php';
require_once __DIR__.'/routes/ReportsRoutes.php';
require_once __DIR__.'/routes/WantedRoutes.php';
require_once __DIR__.'/routes/AdminRoutes.php';
require_once __DIR__.'/routes/MissingRoutes.php';


Flight::start();

?>