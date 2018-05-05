<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class='container'>
    <img src='img/logo.png' alt='FMMO Logo'>
    <?php 
    if(isset($auth_url)) {
        echo("<a class=\"button\" href=\"$auth_url\">Login with discord</a>");
    }
    if(isset($error)) {
        echo("<p>$error</p>");
    }
    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
        echo("<h1>Welcome " . $user->nickname . "!</h1>");
        echo("TODO REMOVE DEBUG INFO");
        echo("<p>Your discord info: @" . $user->discordName . "#" . $user->discordDiscriminator . "</p>");
        echo("<p>Your discord id: " . $user->id . "</p>");
        echo("<p>Your factorio name: " . $user->factorioIGN . "</p>");
    }
    ?>
 </div>