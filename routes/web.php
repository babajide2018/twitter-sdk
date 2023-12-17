<?php

use App\Http\Controllers\Api\V1\Controllers\WebhookController;
use App\Http\Controllers\TwitterController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

 // Webhook route
 Route::get('twitter', [TwitterController::class, 'connectTwitter'])->name('media.twitter');
 Route::get('/twitter-verify', [TwitterController::class, 'twitterVerify'])->name('twitter-verify');

 Route::post('/create-bot', [TwitterController::class, 'createBot']);

 Route::get('/twitter-callback', [TwitterController::class, 'handleCallback'])->name('twitter-callback');