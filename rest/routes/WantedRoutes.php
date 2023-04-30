<?php


Flight::route('GET /wanted', function(){
    Flight::json(Flight::wantedService()->get_all());
});

Flight::route('GET /wanted/@id', function($id){
    Flight::json(Flight::wantedService()->get_by_id($id));
});

Flight::route('POST /locked/wanted', function(){
    Flight::json(Flight::wantedService()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /locked/wanted/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::wantedService()->update($id, $data));

});

Flight::route('DELETE /locked/wanted/@id', function($id){
    Flight::wantedService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>