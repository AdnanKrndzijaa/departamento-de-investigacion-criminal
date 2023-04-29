<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

//eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MSwiZW1haWwiOiJhZG1pbkBnbWFpbC5jb20ifQ.QlilK8nWk8q4MP1TG5Eof-5s-jGyA1AbTHEZtSjWSlE

Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();

    $admin = Flight::adminDao()->get_user_by_email($login['email']);

    if (isset($admin['id'])){
        if ($admin['password'] == md5($login['password'])){
            unset($admin['password']);
            $jwt = JWT::encode($admin, Config::JWT_SECRET(), 'HS256');
            Flight::json(['token'=> $jwt]);
        } else {
            Flight::json(["message"=>"Password incorrect"], 404);
        }

    } else {
        Flight::json(["message"=>"User doesn't exist"], 404);
    }
});

?>