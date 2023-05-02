<?php

/**
 * @OA\Get(path="/locked/reports", tags={"reports"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all reports from the API. ",
 *         @OA\Response( response=200, description="List of reports.")
 * )
 */
Flight::route('GET /locked/reports', function(){
    Flight::json(Flight::reportsService()->get_all());
});

/**
 * @OA\Get(path="/locked/reports/{id}", tags={"reports"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return report by id from the API. ",
 *         @OA\Parameter(in="path", name="id", example=1, description="report_id"),
 *         @OA\Response( response=200, description="Individual report.")
 * )
 */
Flight::route('GET /locked/reports/@id', function($id){
    Flight::json(Flight::reportsService()->get_by_id($id));
});

/**
 * @OA\Get(path="/locked/search_name", tags={"reports"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return search result.",
 *         @OA\Parameter(in="query", name="name", description="Search critieria"),
 *         @OA\Response( response=200, description="Individual searched record.")
 * )
 */
Flight::route('GET /locked/search_name', function(){
  $name = Flight::query('name');
  Flight::json(Flight::reportsService()->get_by_name($name));
});

/**
* @OA\Post(
*     path="/reports",
*     description="Add report",
*     tags={"reports"},
*     @OA\RequestBody(description="Report info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="first_name", type="string", example="John",	description="Title of the note"),
*    				@OA\Property(property="last_name", type="string", example="Smith",	description="Title of the note"),
*    				@OA\Property(property="phone", type="string", example="340935748",	description="Title of the note"),
*    				@OA\Property(property="date_of_birth", type="datetime", example="1980-10-10",	description="Title of the note"),
*    				@OA\Property(property="email", type="string", example="example@gmail.com",	description="Title of the note"),
*    				@OA\Property(property="city", type="string", example="Sarajevo",	description="Title of the note"),
*    				@OA\Property(property="country", type="string", example="BiH",	description="Title of the note"),
*    				@OA\Property(property="zip", type="string", example="71000",	description="Title of the note"),
*    				@OA\Property(property="category", type="string", example="terrorism",	description="Title of the note"),
*    				@OA\Property(property="description", type="string", example="report desc",	description="Title of the note")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Report has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('POST /reports', function(){
    Flight::json(Flight::reportsService()->add(Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/locked/reports/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update report",
*     tags={"reports"},
*     @OA\Parameter(in="path", name="id", example=1, description="report_id"),
*     @OA\RequestBody(description="Report info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="first_name", type="string", example="John",	description="Title of the note"),
*    				@OA\Property(property="last_name", type="string", example="Smith",	description="Title of the note"),
*    				@OA\Property(property="phone", type="string", example="340935748",	description="Title of the note"),
*    				@OA\Property(property="date_of_birth", type="datetime", example="1980-10-10",	description="Title of the note"),
*    				@OA\Property(property="email", type="string", example="example@gmail.com",	description="Title of the note"),
*    				@OA\Property(property="city", type="string", example="Sarajevo",	description="Title of the note"),
*    				@OA\Property(property="country", type="string", example="BiH",	description="Title of the note"),
*    				@OA\Property(property="zip", type="string", example="71000",	description="Title of the note"),
*    				@OA\Property(property="category", type="string", example="terrorism",	description="Title of the note"),
*    				@OA\Property(property="description", type="string", example="report desc",	description="Title of the note")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Report has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('PUT /locked/reports/@id', function($id){
    $data = Flight::request()->data->getData();
    if (isset($data['date'])) {
        $data['date'] = date("Y-m-d H:i:s", strtotime($data['date']));
    }
    Flight::json(Flight::reportsService()->update($id, $data));
});

/**
* @OA\Delete(
*     path="/locked/reports/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete report",
*     tags={"reports"},
*     @OA\Parameter(in="path", name="id", example=1, description="report_id"),
*     @OA\Response(
*         response=200,
*         description="Report deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('DELETE /locked/reports/@id', function($id){
    Flight::reportsService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>