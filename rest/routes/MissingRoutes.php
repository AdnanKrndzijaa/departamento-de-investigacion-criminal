<?php

Flight::route('GET /missing', function(){
    Flight::json(Flight::missingService()->get_all());
});

Flight::route('GET /missing/@id', function($id){
    Flight::json(Flight::missingService()->get_by_id($id));
});

Flight::route('GET /search_name_descm', function(){
  $name_desc = Flight::query('name_desc');
  Flight::json(Flight::missingService()->get_by_name_descm($name_desc));
});

Flight::route('POST /locked/missing', function(){
    Flight::json(Flight::missingService()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /locked/missing/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::missingService()->update($id, $data));
});

Flight::route('DELETE /locked/missing/@id', function($id){
    Flight::missingService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>