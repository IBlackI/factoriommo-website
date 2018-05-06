<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';
require __DIR__ . '/classes/user.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["user"])){
    header("Location: login/login.php");
    exit("You are not logged in!");
}

include __DIR__ . "/includes/head.php";
include __DIR__ . "/includes/views/user_info.php";   