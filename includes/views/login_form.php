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
    include __DIR__ . "/user_info.php";
    ?>
 </div>