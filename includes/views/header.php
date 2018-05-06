<?php
    require __DIR__ . '/../../config.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<nav class="lr-header">
    <div class="lr-header-title">
        <a href="index.php">
            <img class="lr-header-logo" src="img/logo.png" alt="FMMO">
        </a>
    </div>
    <input id="lr-header-responsive-checkbox" style="display: none;" type="checkbox">
    <label for="lr-header-responsive-checkbox" class="lr-header-responsive-button">
        
    </label>
    <div class="lr-header-items">
    <?php
        if(isset($_SESSION["user"])){
            $user = $_SESSION["user"];
            echo("<a class=\"lr-header-item button\" href=\"user.php\">About you</a>");
            echo("<a class=\"lr-header-item button logout\" href=\"login/logout.php\">Logout</a>");
        } else {
            echo("<a class=\"lr-header-item button login\" href=\"login/login.php\">Login</a>");
        }
    ?>
    

</nav>