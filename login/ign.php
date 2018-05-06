<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
require __DIR__ . '/../classes/user.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["user"])){
    header("Location: login/login.php");
    exit("You are not logged in!");
}
if(isset($_POST) && isset($_POST["fign"]) && !empty($_POST["fign"])){
    if(preg_match("/^[A-Za-z\.\_0-9]+$/", $_POST["fign"])){
        $_SESSION["user"]->factorioIGN = $_POST["fign"];
        $error = "Changed your IGN to: " . $_SESSION["user"]->factorioIGN . " <br /> Note saving across sessions is not implemented yet";
    } else {
        $error = "Invalid FactorioIGN. :-(";
    }
    
}

include __DIR__ . "/../includes/head.php";
include __DIR__ . "/../includes/views/ign.php";