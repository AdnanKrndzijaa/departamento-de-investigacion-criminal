<?php

Flight::route('GET /newsletter', function(){
    Flight::json(Flight::newsletterService()->get_all());
});

Flight::route('GET /newsletter/@id', function($id){
    Flight::json(Flight::newsletterService()->get_by_id($id));
});

Flight::route('POST /newsletter', function(){
    Flight::json(Flight::newsletterService()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /newsletter/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::newsletterService()->update($id, $data));
});

Flight::route('DELETE /newsletter/@id', function($id){
    Flight::newsletterService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>