<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    //

    public function connectTwitter(Request $request){

    
        /** @var Callback URL $callback */
        $callback = route('twitter-verify');


       
        /** @var establishing twitter connection $_twitter_connect */
        $_twitter_connect = new TwitterOAuth('R3Jw8Eb0kCSj172Kq4dMhKaZH', 'Sic5U3jq56iZTg2xMCNo9AuK62RnlPgCD1iIyHNkm5BPigBSq7');

        /** $_access_token get access token */
        $_access_token = $_twitter_connect->oauth('oauth/request_token', ['oauth_callback'=>$callback]);

        //dd($_access_token );
         /**  generate a new url for client $_route */
        $_route =  $_twitter_connect->url('oauth/authorize', ['oauth_token'=>$_access_token['oauth_token']]);

        return redirect($_route);
    }

    public function twitterVerify(Request $request){

        dd($request->all());
    }



    public function createBot(Request $request)
{

    $name = $request->name;

    $bio = $request->bio;
    // Connect to Twitter API
    $twitter = new TwitterOAuth('R3Jw8Eb0kCSj172Kq4dMhKaZH', 'Sic5U3jq56iZTg2xMCNo9AuK62RnlPgCD1iIyHNkm5BPigBSq7');

    // Get request token
    $requestToken = $twitter->oauth('oauth/request_token', ['oauth_callback' => route('twitter-callback')]);

    // Store request token in session
    session()->put('oauth_token', $requestToken['oauth_token']);
    session()->put('oauth_token_secret', $requestToken['oauth_token_secret']);

    // Build authorization URL
    $authorizeUrl = $twitter->url('oauth/authorize', ['oauth_token' => $requestToken['oauth_token']]);

    // Redirect user to Twitter for authorization
    return redirect($authorizeUrl);
}


public function handleCallback(Request $request)
{
    // Extract verifier code from request
    $verifier = $request->get('oauth_verifier');

    // Access stored tokens from session
    $oauthToken = session()->pull('oauth_token');
    $oauthTokenSecret = session()->pull('oauth_token_secret');

    // Exchange verifier for access token and secret
    $twitter = new TwitterOAuth('R3Jw8Eb0kCSj172Kq4dMhKaZH', 'Sic5U3jq56iZTg2xMCNo9AuK4dMhKaZH', $oauthToken, $oauthTokenSecret);
    $accessToken = $twitter->oauth('oauth/access_token', ['oauth_verifier' => $verifier]);

    // Store access token and secret in database or session
    // ... (Implement your storage logic here)

    // Create Twitter account with provided name and bio
    $api = new TwitterOAuth('R3Jw8Eb0kCSj172Kq4dMhKaZH', 'Sic5U3jq56iZTg2xMCNo9AuK62RnlPgCD1iIyHNkm5BPigBSq7', $accessToken['oauth_token'], $accessToken['oauth_token_secret']);
    $twitter->post('users/create', ['name' => $name, 'description' => $bio]);

    // ... perform additional bot initialization or actions ...

    // Redirect to success page or dashboard
    return redirect('/'); // Replace with your desired landing page
}

    //1735594427932884992-4qv9mVBtws5TzHHrnKQ3gy0pUjFpJb
    

    //EMRpc3un21LAgqvvAouDVPHdGH8jygFlsk3XorHLhSO8C
    
}
