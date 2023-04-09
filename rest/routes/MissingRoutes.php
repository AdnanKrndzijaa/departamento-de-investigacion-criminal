<?php

Flight::route('GET /missing', function(){
    Flight::json(Flight::missingService()->get_all());
});

Flight::route('GET /missing/@id', function($id){
    Flight::json(Flight::missingService()->get_by_id($id));
});

Flight::route('POST /missing', function(){
    Flight::json(Flight::missingService()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /missing/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::missingService()->update($id, $data));
});

Flight::route('DELETE /missing/@id', function($id){
    Flight::missingService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>