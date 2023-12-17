<?php

namespace App\Http\Controllers\Api\V1\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\Controller;
use App\Events\MessageSent; // Import the event class

class ChatController extends Controller
{
   /**
     * @OA\Post(
     *     path="/api/v1/subscribe-to-channel",
     *     tags={"chat"},
     *     summary="Subscribe to Channel",
     *     description="Endpoint to subscribe a user to a chat channel.",
     *     operationId="subscribeToChannel",
     *     @OA\Response(
     *         response=200,
     *         description="Subscribed to channel successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Subscribed to channel successfully"),
     *         ),
     *     ),
     * )
     */
    public function subscribeToChannel(Request $request)
    {
        // Your existing method logic
    }

    /**
     * @OA\Post(
     *     path="/api/v1/send-message",
     *     tags={"chat"},
     *     summary="Send Message",
     *     description="Endpoint to send a message in a chat channel.",
     *     operationId="sendMessage",
     *     @OA\RequestBody(
     *         description="Message data",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="message", type="string", description="Text of the message"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Message sent successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Message sent successfully"),
     *         ),
     *     ),
     * )
     */

    public function sendMessage(Request $request)
    {
        $channelName = 'chat.' . $request->user()->id;

        // You can customize the event name and data structure
        $eventName = 'message.sent';

        // Broadcasting the message to the channel
        broadcast(new MessageSent(['text' => $request->message]));

        return response()->json(['message' => 'Message sent successfully']);
    }
}
