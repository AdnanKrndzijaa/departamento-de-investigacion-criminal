<?php

/**
 * @OA\Get(path="/news", tags={"news"},
 *         summary="Return all news from the API. ",
 *         @OA\Response( response=200, description="List of news.")
 * )
 */
Flight::route('GET /news', function(){
    Flight::json(Flight::newsService()->get_all());
});

/**
 * @OA\Get(path="/news/{id}", tags={"news"},
 *         summary="Return news by id from the API. ",
 *         @OA\Parameter(in="path", name="id", example=1, description="news_id"),
 *         @OA\Response( response=200, description="Individual news person.")
 * )
 */
Flight::route('GET /news/@id', function($id){
    Flight::json(Flight::newsService()->get_by_id($id));
});

/**
 * @OA\Get(path="/search_title", tags={"news"},
 *         summary="Return search result.",
 *         @OA\Parameter(in="query", name="title", description="Search critieria"),
 *         @OA\Response( response=200, description="Individual searched record.")
 * )
 */
Flight::route('GET /search_title', function(){
  $title = Flight::query('title');
  Flight::json(Flight::newsService()->get_by_title($title));
});

/**
* @OA\Post(
*     path="/locked/news", security={{"ApiKeyAuth": {}}},
*     description="Add news",
*     tags={"news"},
*     @OA\RequestBody(description="news info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="title", type="string", example="News title",	description="Title of the note"),
*    				@OA\Property(property="description", type="string", example="News desc",	description="Title of the note"),
*    				@OA\Property(property="date", type="datetime", example="2020-10-10",	description="Title of the note"),
*    				@OA\Property(property="image", type="string", example="image.png",	description="Title of the note")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="News has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('POST /locked/news', function(){
    Flight::json(Flight::newsService()->add(Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/locked/news/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update news",
*     tags={"news"},
*     @OA\Parameter(in="path", name="id", example=1, description="news_id"),
*     @OA\RequestBody(description="News info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="title", type="string", example="News title",	description="Title of the note"),
*    				@OA\Property(property="description", type="string", example="News desc",	description="Title of the note"),
*    				@OA\Property(property="date", type="datetime", example="2020-10-10",	description="Title of the note"),
*    				@OA\Property(property="image", type="string", example="image.png",	description="Title of the note")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="News has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('PUT /locked/news/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::newsService()->update($id, $data));
});

/**
* @OA\Delete(
*     path="/locked/news/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete news",
*     tags={"news"},
*     @OA\Parameter(in="path", name="id", example=1, description="news_id"),
*     @OA\Response(
*         response=200,
*         description="News deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('DELETE /locked/news/@id', function($id){
    Flight::newsService()->delete($id);
    Flight::json(["message"=>"deleted"]);
});

?>