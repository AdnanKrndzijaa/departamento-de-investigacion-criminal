<?php


/**
 * @OA\Get(path="/wanted", tags={"wanted"},
 *         summary="Return all wanted people from the API. ",
 *         @OA\Response( response=200, description="List of wanted people.")
 * )
 */
Flight::route('GET /wanted', function(){
    Flight::json(Flight::wantedService()->get_all());
});

/**
 * @OA\Get(path="/wanted/{id}", tags={"wanted"},
 *         summary="Return wanted person by id from the API. ",
 *         @OA\Parameter(in="path", name="id", example=1, description="wanted_ID"),
 *         @OA\Response( response=200, description="Individual wanted person.")
 * )
 */
Flight::route('GET /wanted/@id', function($id){
    Flight::json(Flight::wantedService()->get_by_id($id));
});

/**
 * @OA\Get(path="/search_name_desc", tags={"wanted"},
 *         summary="Return search result.",
 *         @OA\Parameter(in="query", name="name_desc", description="Search critieria"),
 *         @OA\Response( response=200, description="Individual searched record.")
 * )
 */
Flight::route('GET /search_name_desc', function(){
  $name_desc = Flight::query('name_desc');
  Flight::json(Flight::wantedService()->get_by_name_desc($name_desc));
});

/**
* @OA\Post(
*     path="/locked/wanted", security={{"ApiKeyAuth": {}}},
*     description="Add wanted person",
*     tags={"wanted"},
*     @OA\RequestBody(description="Wanted info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="first_name", type="string", example="John",	description="Title of the note"),
*    				@OA\Property(property="last_name", type="string", example="Smith",	description="Title of the note"),
*    				@OA\Property(property="description", type="string", example="wanted person desc",	description="Title of the note"),
*    				@OA\Property(property="image", type="string", example="image.png",	description="Title of the note")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Wanted person has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('POST /locked/wanted', function(){
    Flight::json(Flight::wantedService()->add(Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/locked/wanted/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update wanted person",
*     tags={"wanted"},
*     @OA\Parameter(in="path", name="id", example=1, description="wanted_id"),
*     @OA\RequestBody(description="Wanted person info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="first_name", type="string", example="John",	description="Title of the note"),
*    				@OA\Property(property="last_name", type="string", example="Smith",	description="Title of the note"),
*    				@OA\Property(property="description", type="string", example="wanted person desc",	description="Title of the note"),
*    				@OA\Property(property="image", type="string", example="image.png",	description="Title of the note")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Wanted has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('PUT /locked/wanted/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::wantedService()->update($id, $data));

});

/**
* @OA\Delete(
*     path="/locked/wanted/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete wanted person",
*     tags={"wanted"},
*     @OA\Parameter(in="path", name="id", example=1, description="wanted_id"),
*     @OA\Response(
*         response=200,
*         description="Wanted person deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('DELETE /locked/wanted/@id', function($id){
    Flight::wantedService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>