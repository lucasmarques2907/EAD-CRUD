<?php
session_start();

if (isset($_SESSION["userId"])) {

    require_once '../config/connection.php';
    require_once 'functions.inc.php';

    deleteUser($conn, $_SESSION["userId"]);

} else {
    header("location: ../index.php");
    exit();
}