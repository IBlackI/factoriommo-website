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
    if(isset($user->rpg)){
        echo("<p>Your RPG data:<br />");
        echo("XP Banked: " . $user->rpg->getBank() . "<br />");
        echo("Builder: " . $user->rpg->getBuilder() . "<br />");
        echo("Engineer: " . $user->rpg->getEngineer() . "<br />");
        echo("Miner: " . $user->rpg->getMiner() . "<br />");
        echo("Scientist: " . $user->rpg->getScientist() . "<br />");
        echo("Soldier: " . $user->rpg->getSoldier() . "<br />");
        echo("</p>");
    }
    if(isset($user->notes)){
        $bans = array();
        $warns = array();
        foreach($user->notes as $note){
            if($note->getType() == 'Ban'){
                $bans[] = $note;
            } elseif  ($note->getType() == 'Warn') {
                $warns[] = $note;
            }
        }
        if(!empty($bans)){
            echo("<p>You got " . count($bans) . " bans :-( </p>");
        }
        foreach($bans as $ban){
            echo("<p>Reason: " . $ban->reason . "<br />");
            echo("Issuer: " . $ban->issuer . "<br />");
            echo("Date: " . $ban->date . "</p><hr />");
        }
        if(!empty($warns)){
            echo("<p>You got " . count($warns) . " warnings :-( </p>");
        }
        foreach($warns as $warn){
            echo("<p>Reason: " . $warn->reason . "<br />");
            echo("Issuer: " . $warn->issuer . "<br />");
            echo("Date: " . $warn->date . "</p><hr />");
        }
    }
    if(isset($user->factorioIGN)){
        echo ("<a class='button' href='login/ign.php'>Change Factorio In-Game Name</a>");
    }
    echo ("<a class='button logout' href='login/logout.php'>Logout</a>");
    
    

    echo ("</div>");
}