<?php

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    require_once '../config/connection.php';
    require_once 'functions.inc.php';


    if (emptyInput($username, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidUsername($username) !== false) {
        header("location: ../signup.php?error=invalidusername");
        exit();
    }

    if (differentPassword($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=differentpassword");
        exit();
    }

    if (userExists($conn, $username) !== false) {
        header("location: ../signup.php?error=userexists");
        exit();
    }

    createUser($conn, $username, $pwd);
} else {
    header("location: ../signup.php");
    exit();
}