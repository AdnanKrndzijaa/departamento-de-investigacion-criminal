<?php

Flight::route('/wanted', function(){
    Flight::json(Flight::wantedDao()->get_all());
});

Flight::route('GET /wanted/@id', function($id){
    Flight::json(Flight::wantedDao()->get_by_id($id));
});

Flight::route('POST /wanted', function(){
    Flight::json(Flight::wantedDao()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /wanted/@id', function($id){
    $data = Flight::request()->data->getData();
    $data['id'] = $id;
    Flight::json(Flight::wantedDao()->update($data));
});

Flight::route('DELETE /wanted/@id', function($id){
    Flight::wantedDao()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>