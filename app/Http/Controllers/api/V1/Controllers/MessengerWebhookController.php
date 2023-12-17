<?php

namespace App\Http\Controllers\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
 * @OA\Post(
 *     path="/api/v1/messenger-webhook",
 *     tags={"webhook"},
 *     summary="Get token data",
 *     description="Endpoint to retrieve token data.",
 *     operationId="messanger-webhook",
 *     @OA\RequestBody(
 *         description="Home data input",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *            
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="verify_token", type="string"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Enter Verify Token",
 *     ),
 * )
 */

class MessengerWebhookController extends Controller
{



    public function handleWebhook(Request $request)
    
    {

        $verifyToken = $request->verify_token;

        //$verifyToken = 'AAAAAAAAAAAAAAAAAAAAAGP2rQEAAAAAOg3gCaaUEG5KgUWygWd0F%2BR76ms%3Dgojs3O7mQS6aNauqDB6Jp6ZYpY3CwZI3tid5vmJiWyMdvL4TcF'; // Replace with your verification token

        // Handle verification as described in the previous response

        // Process other incoming events as needed

        // Respond with a 200 OK to acknowledge receipt of the webhook
        return response()->json(['status' => 'success'], 200);
    }
}
