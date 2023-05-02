<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\Key;

require_once __DIR__.'/../vendor/autoload.php';
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
  // Handle exception
  Flight::json(['message' => $ex->getMessage()], 500);  
});

/* utility function for reading query parameters from URL */
Flight::map('query', function($name, $default_value = NULL){
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $default_value;
  return urldecode($query_param);
});

Flight::map('header', function($name){
  $headers = getallheaders();
  return @$headers[$name];
});



  Flight::route('/locked/*', function(){
      
    /*
  $path = Flight::request()->url;
  if (preg_match('/^\/(login|login.html|news(?:\/\d+)?|missing(?:\/\d+)?|wanted(?:\/\d+)?|newsletter|reports)$/', $path)) {
    return TRUE; // exclude certain routes from middleware
  }
  */

    $headers = getallheaders();
    if (@!$headers['Authorization']){
        Flight::json(["message" => "Unauthorized access"], 403);
        return FALSE;
    } else {
        try {
            $decoded = JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
            // Token is valid
            Flight::set('admin', $decoded);
            return TRUE;
        } catch (\Exception $e) {
            // Other errors
            Flight::json(["message" => "Token authorization invalid"], 403);
            return FALSE;
        }

      
    }
});

Flight::route('GET /docs.json', function() {
  $openapi = \OpenApi\scan('routes');
  header('Content-Type: application/json');
  echo $openapi->toJson();
});


require_once __DIR__.'/routes/NewsRoutes.php';
require_once __DIR__.'/routes/NewsletterRoutes.php';
require_once __DIR__.'/routes/ReportsRoutes.php';
require_once __DIR__.'/routes/WantedRoutes.php';
require_once __DIR__.'/routes/AdminRoutes.php';
require_once __DIR__.'/routes/MissingRoutes.php';


Flight::start();

?>