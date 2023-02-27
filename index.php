<?php
require 'vendor/autoload.php';

Flight::route('/', function() {
    echo 'Welcome to the Las noticias del pais';
});

Flight::start();


?>