<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
require __DIR__ . '/../classes/user.php';
use RestCord\DiscordClient;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
            $_SESSION["user"] = new User($user->id, $user->username, $user->discriminator);
            display();
            exit();
        } catch (Exception $e) {
            $error = "Unable to process your request.";
            $auth_url = $provider->getAuthorizationUrl(array('scope' => ['identify', 'guilds']));
            display($auth_url, $error);
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