<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["user"])){
    header("Location: login/login.php");
    exit("You are not logged in!");
} else {
    $user = $_SESSION["user"];
}
?>
<div class='container'>
    <img src='https://factorio.com/static/img/factorio-logo.png' alt='Factorio Logo'>
    <?php 
    echo("<form action=\"login/ign.php\" method=\"post\">");
    if(isset($error)) {
        echo("<p>$error</p>");
    }
    echo("<label for=\"fign\">Factorio In-game name</label>");
    if(isset($user->factorioIGN)) {
        echo("<input type=\"text\" name=\"fign\" placeholder=\"Nickname\" value=\"" . $user->factorioIGN . "\"/>");

    } else {
        echo("<input type=\"text\" name=\"fign\" placeholder=\"Nickname\" />");
    }
    echo("<input type=\"submit\" value=\"Save\" />");
    echo("</form>");
    ?>
 </div>