<?php

use App\Http\Controllers\api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\V1\Controllers\WebhookController;
use App\Http\Controllers\api\V1\Controllers\ChatController;
use App\Http\Controllers\Api\V1\Controllers\MessengerWebhookController;
use App\Http\Controllers\Api\V1\Controllers\SubscriptionController;

use App\Http\Controllers\TwitterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/home', [HomeController::class, 'home']);

Route::prefix('v1')->group(function () {


    // Add other Message routes as needed

    // Webhook route
    Route::get('twitter', [TwitterController::class, 'connectTwitter'])->name('media.twitter');
    Route::get('/twitter/cbk', [TwitterController::class, 'twitterVerify'])->name('media.cbk');

    Route::get('/subscribe-to-channel', [ChatController::class, 'subscribeToChannel']);

    Route::post('/send-message', [ChatController::class, 'sendMessage']);

    Route::post('/messenger-webhook', [MessengerWebhookController::class, 'handleWebhook']);

});
 
