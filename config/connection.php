<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$dbName = "sgu";

$conn = mysqli_connect($host, $user, $password, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}