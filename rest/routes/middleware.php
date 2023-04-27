<?php
require '../vendor/autoload.php';
require_once __DIR__.'/../Config.class.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Middleware login method
Flight::route('/*', function(){
    
    $path = Flight::request()->url;
    if($path == '/login' || $path == '/login.html' || $path == '/' || $path == '/index.html' ){
        return TRUE;
    } else {  
        $headers = getallheaders();
        if(@!$headers['Authorization']){
            Flight::json(["message" => "Unauthorized access"], 403);
            return FALSE;
        }else{
            try {
                $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
                Flight::set('validUser', $decoded);
                return TRUE;
            } catch (\Exception $e) {
                Flight::json(["message" => "Token authorization invalid"], 403);
                return FALSE;
            }
        }
    }
});

?>
