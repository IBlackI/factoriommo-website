<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    echo("<div class='container'>");
    echo("<h1>Welcome " . $user->nickname . "!</h1>");
    echo("<p>Your discord info: @" . $user->discordName . "#" . $user->discordDiscriminator . "</p>");
    echo("<p>Your discord id: " . $user->id . "</p>");
    if(isset($user->factorioIGN)){
        echo("<p>Your factorio name: " . $user->factorioIGN . "</p>");
    } else {
        echo("<a href=\"login/ign.php\">Add Factorio In-Game Name</a>");
    }
    echo("<p>You got the following discord roles: ");
    $roles = "";
    foreach($user->roles as $role) {
        $roles .= $role->getName() . ", ";
    }
    $roles = rtrim($roles, ", ");
    echo ("$roles</p>");
    if(isset($user->factorioIGN)){
        echo ("<a class='button' href='login/ign.php'>Change Factorio In-Game Name</a>");
    }
    echo ("<a class='button logout' href='login/logout.php'>Logout</a>");
    echo ("</div>");
}