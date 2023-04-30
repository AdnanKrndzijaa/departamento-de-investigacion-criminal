<?php

Flight::route('GET /locked/reports', function(){
    Flight::json(Flight::reportsService()->get_all());
});

Flight::route('GET /locked/reports/@id', function($id){
    Flight::json(Flight::reportsService()->get_by_id($id));
});

Flight::route('GET /locked/search_name', function(){
  $name = Flight::query('name');
  Flight::json(Flight::reportsService()->get_by_name($name));
});

Flight::route('POST /reports', function(){
    Flight::json(Flight::reportsService()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /locked/reports/@id', function($id){
    $data = Flight::request()->data->getData();
    if (isset($data['date'])) {
        $data['date'] = date("Y-m-d H:i:s", strtotime($data['date']));
    }
    Flight::json(Flight::reportsService()->update($id, $data));
});

Flight::route('DELETE /locked/reports/@id', function($id){
    Flight::reportsService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>