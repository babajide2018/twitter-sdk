<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;





 /**
 * @OA\Post(
 *     path="/api/home",
 *     tags={"home"},
 *     summary="Get home data",
 *     description="Endpoint to retrieve home data.",
 *     operationId="getHomeData",
 *     @OA\RequestBody(
 *         description="Home data input",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(property="name", type="string"),
 *                 @OA\Property(property="password", type="string"),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="message", type="string"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid username/password supplied",
 *     ),
 * )
 */

  

class HomeController extends Controller
{
    //

    public function home(Request $request){

        return response()->json([
            'name' => $request->input('name'),
            'message' => $request->input('Hello World'),
        ]);
    }
}
