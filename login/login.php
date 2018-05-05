<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
require __DIR__ . '/../classes/user.php';
use RestCord\DiscordClient;
session_start();
if(isset($_SESSION["user"])){
    display();
    exit();
}

$provider = new \Discord\OAuth\Discord([
    'clientId' => $config->discord_app_client_id,
    'clientSecret' => $config->discord_app_client_secret,
    'redirectUri' => $config->base_url . 'login/login.php'
]);

if (isset($_GET['code'])) {
    try {
        $token = $provider->getAccessToken('authorization_code', ['code' => $_GET['code']]);
        $user = $provider->getResourceOwner($token);
    } catch (Exception $e){
        $auth_url = $provider->getAuthorizationUrl(array('scope' => ['identify', 'guilds']));
        display($auth_url);
        exit();
    }

	// Get the guilds and connections.
	$guilds = $user->guilds;
    if(in_guild($config->discord_server_id, $guilds)){
        
        try {
            $client = new GuzzleHttp\Client();
            $res = $client->get('https://discordapp.com/api/guilds/' . $config->discord_server_id . '/members/' . $user->id, [
                'headers' =>  ['Authorization' => $config->discord_bot_api_key]
            ]);
            $json_response = json_decode($res->getBody());
        } catch (Exception $e) {
            $error = "Unable to process your request. Try again later.";
            display(null, $error);
            exit();
        }
        if($res->getStatusCode() == 200){
            $_SESSION["user"] = new User($user->id, $json_response->roles, $json_response->nick, $user->username, $user->discriminator);
            display();
            exit();
        } else {
            $error = "Unable to process your request. Try again later.";
            display(null, $error);
            exit();
        }
    } else {
        $error = "You are not in the right server.";
        display(null, $error);
        exit();
    }
} else {
    $auth_url = $provider->getAuthorizationUrl(array('scope' => ['identify', 'guilds']));
    display($auth_url);
    exit();
}


function in_guild($id, $guilds){
    foreach ($guilds as $guild){
        if($id == $guild->id){
            return true;
        }
    }
    return false;
}

function display($auth_url = null, $error = null){
    include __DIR__ . "/../includes/head.php";
    include __DIR__ . "/../includes/views/login_form.php";    
}