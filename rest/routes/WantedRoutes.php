<?php

Flight::route('/wanted', function(){
    Flight::json(Flight::wantedService()->get_all());
});

Flight::route('GET /wanted/@id', function($id){
    Flight::json(Flight::wantedService()->get_by_id($id));
});

Flight::route('POST /wanted', function(){
    Flight::json(Flight::wantedService()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /wanted/@id', function($id){
    $data = Flight::request()->data->getData();
    $data['id'] = $id;
    Flight::json(Flight::wantedService()->update($data));
});

Flight::route('DELETE /wanted/@id', function($id){
    Flight::wantedService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>