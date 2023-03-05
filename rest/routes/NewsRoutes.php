<?php

Flight::route('/news', function(){
    Flight::json(Flight::newsDao()->get_all());
});

Flight::route('GET /news/@id', function($id){
    Flight::json(Flight::newsDao()->get_by_id($id));
});

Flight::route('POST /news', function(){
    Flight::json(Flight::newsDao()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /news/@id', function($id){
    $data = Flight::request()->data->getData();
    $data['id'] = $id;
    Flight::json(Flight::newsDao()->update($data));
});

Flight::route('DELETE /news/@id', function($id){
    Flight::projectDao()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>