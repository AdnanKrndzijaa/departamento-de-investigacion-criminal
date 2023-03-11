<?php

Flight::route('/reports', function(){
    Flight::json(Flight::reportsService()->get_all());
});

Flight::route('GET /reports/@id', function($id){
    Flight::json(Flight::reportsService()->get_by_id($id));
});

Flight::route('POST /reports', function(){
    Flight::json(Flight::reportsService()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /reports/@id', function($id){
    $data = Flight::request()->data->getData();
    if (isset($data['date'])) {
        $data['date'] = date("Y-m-d H:i:s", strtotime($data['date']));
    }
    Flight::json(Flight::reportsService()->update($id, $data));
});

Flight::route('DELETE /reports/@id', function($id){
    Flight::reportsService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>