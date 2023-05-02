<?php

/**
 * @OA\Get(path="/locked/newsletter", tags={"newsletter"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all newsletter from the API. ",
 *         @OA\Response( response=200, description="List of newsletters.")
 * )
 */
Flight::route('GET /locked/newsletter', function(){
    Flight::json(Flight::newsletterService()->get_all());
});

/**
 * @OA\Get(path="/locked/newsletter/{id}", tags={"newsletter"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return newsletter by id from the API. ",
 *         @OA\Parameter(in="path", name="id", example=1, description="newsletter_id"),
 *         @OA\Response( response=200, description="Individual newsletter.")
 * )
 */
Flight::route('GET /locked/newsletter/@id', function($id){
    Flight::json(Flight::newsletterService()->get_by_id($id));
});

/**
* @OA\Post(
*     path="/newsletter",
*     description="Add newsletter",
*     tags={"newsletter"},
*     @OA\RequestBody(description="Newsletter info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="email", type="string", example="example@gmail.com",	description="Title of the note"),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Newsletter has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('POST /newsletter', function(){
    Flight::json(Flight::newsletterService()->add(Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/locked/newsletter/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update newsletter",
*     tags={"newsletter"},
*     @OA\Parameter(in="path", name="id", example=1, description="newsletter_id"),
*     @OA\RequestBody(description="Newsletter info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="email", type="string", example="example@gmail.com",	description="Title of the note"),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Newsletter has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('PUT /locked/newsletter/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::newsletterService()->update($id, $data));
});

/**
* @OA\Delete(
*     path="/locked/newsletter/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete newsletter",
*     tags={"newsletter"},
*     @OA\Parameter(in="path", name="id", example=1, description="newsletter_id"),
*     @OA\Response(
*         response=200,
*         description="Newsletter deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('DELETE /locked/newsletter/@id', function($id){
    Flight::newsletterService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>