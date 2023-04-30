<?php

Flight::route('GET /news', function(){
    Flight::json(Flight::newsService()->get_all());
});

Flight::route('GET /news/@id', function($id){
    Flight::json(Flight::newsService()->get_by_id($id));
});

Flight::route('GET /news/@date', function($date){
    Flight::json(Flight::newsService()->get_by_date($date));
});

Flight::route('GET /search_title', function(){
  $title = Flight::query('title');
  Flight::json(Flight::newsService()->get_by_title($title));
});

Flight::route('POST /locked/news', function(){
    Flight::json(Flight::newsService()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /locked/news/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::newsService()->update($id, $data));
});

Flight::route('DELETE /locked/news/@id', function($id){
    Flight::newsService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>