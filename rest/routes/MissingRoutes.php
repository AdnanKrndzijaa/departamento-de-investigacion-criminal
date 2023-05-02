<?php

/**
 * @OA\Get(path="/missing", tags={"missing"},
 *         summary="Return all missing people from the API. ",
 *         @OA\Response( response=200, description="List of missing people.")
 * )
 */
Flight::route('GET /missing', function(){
    Flight::json(Flight::missingService()->get_all());
});


/**
 * @OA\Get(path="/missing/{id}", tags={"missing"},
 *         summary="Return missing person by id from the API. ",
 *         @OA\Parameter(in="path", name="id", example=1, description="ID of missing"),
 *         @OA\Response( response=200, description="Individual missing person.")
 * )
 */
Flight::route('GET /missing/@id', function($id){
    Flight::json(Flight::missingService()->get_by_id($id));
});

/**
 * @OA\Get(path="/search_name_descm", tags={"missing"},
 *         summary="Return search result.",
 *         @OA\Parameter(in="query", name="name_desc", description="Search critieria"),
 *         @OA\Response( response=200, description="Individual searched record.")
 * )
 */
Flight::route('GET /search_name_descm', function(){
  $name_desc = Flight::query('name_desc');
  Flight::json(Flight::missingService()->get_by_name_descm($name_desc));
});

/**
* @OA\Post(
*     path="/locked/missing", security={{"ApiKeyAuth": {}}},
*     description="Add missing person",
*     tags={"missing"},
*     @OA\RequestBody(description="Missing info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="first_name", type="string", example="John",	description="Title of the note"),
*    				@OA\Property(property="last_name", type="string", example="Smith",	description="Title of the note"),
*    				@OA\Property(property="place_of_birth", type="string", example="Madrid",	description="Title of the note"),
*    				@OA\Property(property="date_of_birth", type="datetime", example="29.05.1987",	description="Title of the note"),
*    				@OA\Property(property="last_place_seen", type="string", example="Paris",	description="Title of the note"),
*    				@OA\Property(property="last_time_seen", type="datetime", example="20.02.2015",	description="Title of the note"),
*    				@OA\Property(property="contact", type="string", example="+20457283",	description="Title of the note"),
*    				@OA\Property(property="description", type="string", example="missing person desc",	description="Title of the note"),
*    				@OA\Property(property="physical_chars", type="string", example="missing person chars",	description="Title of the note"),
*    				@OA\Property(property="image", type="string", example="image.png",	description="Title of the note")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Missing person has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('POST /locked/missing', function(){
    Flight::json(Flight::missingService()->add(Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/locked/missing/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update missing person",
*     tags={"missing"},
*     @OA\Parameter(in="path", name="id", example=1, description="missing_id"),
*     @OA\RequestBody(description="Missing person info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="first_name", type="string", example="John",	description="Title of the note"),
*    				@OA\Property(property="last_name", type="string", example="Smith",	description="Title of the note"),
*    				@OA\Property(property="place_of_birth", type="string", example="Madrid",	description="Title of the note"),
*    				@OA\Property(property="date_of_birth", type="datetime", example="1987-05-05",	description="Title of the note"),
*    				@OA\Property(property="last_place_seen", type="string", example="Paris",	description="Title of the note"),
*    				@OA\Property(property="last_time_seen", type="datetime", example="2020-10-10",	description="Title of the note"),
*    				@OA\Property(property="contact", type="string", example="+20457283",	description="Title of the note"),
*    				@OA\Property(property="description", type="string", example="missing person desc",	description="Title of the note"),
*    				@OA\Property(property="physical_chars", type="string", example="missing person chars",	description="Title of the note"),
*    				@OA\Property(property="image", type="string", example="image.png",	description="Title of the note")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Missing has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('PUT /locked/missing/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::missingService()->update($id, $data));
});

/**
* @OA\Delete(
*     path="/locked/missing/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete missing person",
*     tags={"missing"},
*     @OA\Parameter(in="path", name="id", example=1, description="missing_id"),
*     @OA\Response(
*         response=200,
*         description="Missing person deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('DELETE /locked/missing/@id', function($id){
    Flight::missingService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>