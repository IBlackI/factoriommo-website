<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
require __DIR__ . '/../classes/user.php';
use RestCord\DiscordClient;
session_start();
if(isset($_SESSION["user"])){
    var_dump($_SESSION["user"]);
    exit("User found!");
}

$provider = new \Discord\OAuth\Discord([
    'clientId' => $config->discord_app_client_id,
    'clientSecret' => $config->discord_app_client_secret,
    'redirectUri' => $config->base_url . 'login/login.php'
]);

if (! isset($_GET['code'])) {
	echo '<a href="'.$provider->getAuthorizationUrl(array('scope' => ['identify', 'guilds'])).'">Login with Discord</a>';
} else {
	$token = $provider->getAccessToken('authorization_code', ['code' => $_GET['code']]);

	// Get the user object.
	$user = $provider->getResourceOwner($token);
    
	// Get the guilds and connections.
	$guilds = $user->guilds;
    if(in_guild($config->discord_server_id, $guilds)){
        $client = new GuzzleHttp\Client();
        try {
            $res = $client->get('https://discordapp.com/api/guilds/' . $config->discord_server_id . '/members/' . $user->id, [
                'headers' =>  ['Authorization' => $config->discord_bot_api_key]
            ]);
            $json_response = json_decode($res->getBody());
        } catch (Exception $e) {
            exit("Something went wrong, try again later.");
        }
        if($res->getStatusCode() == 200){
            $_SESSION["user"] = new User($user->id, $json_response->roles, $json_response->nick, $user->username, $user->discriminator);
        } else {
            exit("Something went wrong, try again later.");
        }
    } else {
        //Not in the right server.
    }
}

function in_guild($id, $guilds){
    foreach ($guilds as $guild){
        if($id == $guild->id){
            return true;
        }
    }
    return false;
}