<?php


namespace App\Http\Controllers\Api\V1\Controllers;


use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Thujohn\Twitter\Twitter;



 /**
     * @OA\Post(
     *     path="/api/v1/subscribe-to-bot",
     *     tags={"subscription"},
     *     summary="Subscribe to Bot",
     *     description="Endpoint to subscribe a user to a bot.",
     *     operationId="subscribeToBot",
     *     @OA\RequestBody(
     *         description="Subscription data",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="bot_id", type="string", description="ID of the bot to subscribe to"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Subscription successful",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Subscription successful"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="User is already subscribed to this bot",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="User is already subscribed to this bot"),
     *         ),
     *     ),
     * )
     */
class SubscriptionController extends Controller
{
   
    public function subscribeToBot(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'bot_id' => 'required|string',
        ]);

        // Get user ID from headers
        $userId = $request->header('user_id');

        // Check if the user is already subscribed
        $existingSubscription = Subscription::where('user_id', $userId)
            ->where('bot_id', $request->input('bot_id'))
            ->first();

        if ($existingSubscription) {
            return response()->json(['message' => 'User is already subscribed to this bot'], 422);
        }

        // Create a new subscription
        $subscription = new Subscription([
            'user_id' => $userId,
            'bot_id' => $request->input('bot_id'),
            // Add other subscription attributes as needed
        ]);

        $subscription->save();

        // Send a notification via Twitter (assuming you have Twitter credentials configured)
        $this->sendTwitterNotification($userId, 'You have subscribed to the bot.');

        return response()->json(['message' => 'Subscription successful']);
    }

    // Add other SubscriptionController methods for CRUD operations and additional logic

    /**
     * Send a notification via Twitter.
     *
     * @param string $userId
     * @param string $message
     */
    private function sendTwitterNotification($userId, $message)
    {
        // Assuming you have Twitter credentials configured in your .env file
        $twitter = new Twitter(config('services.twitter'));
        
        // Send a tweet or direct message to the user
        // You need to customize this based on your Twitter SDK usage
        $twitter->postTweet(['status' => "@$userId $message"]);
    }
}
