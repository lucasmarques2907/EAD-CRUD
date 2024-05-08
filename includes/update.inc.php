<?php

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $currentUsername = $_POST["currentUsername"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    require_once '../config/connection.php';
    require_once 'functions.inc.php';

    if (emptyInput($username, $pwd, $pwdRepeat) !== false) {
        header("location: ../settings.php?error=emptyinput");
        exit();
    }

    if (invalidUsername($username) !== false) {
        header("location: ../settings.php?error=invalidusername");
        exit();
    }

    if (differentPassword($pwd, $pwdRepeat) !== false) {
        header("location: ../settings.php?error=differentpassword");
        exit();
    }

    if (strcasecmp($currentUsername, $username) !== 0) {
        if (userExists($conn, $username) !== false) {
            header("location: ../settings.php?error=userexists");
            exit();
        }
    }

    updateUser($conn, $id, $username, $pwd);
} else {
    header("location: ../settings.php");
    exit();
}