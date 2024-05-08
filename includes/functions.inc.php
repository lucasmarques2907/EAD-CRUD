<?php

//checar por erros nas funções
ini_set('display_errors', 1);
error_reporting(E_ALL);

function emptyInput($username, $pwd, $pwdRepeat)
{
    $result = null;
    if (empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username)
{
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9]{2,30}$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function differentPassword($pwd, $pwdRepeat)
{
    $result = null;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function userExists($conn, $username)
{
    $sql = "SELECT * FROM users WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}

function createUser($conn, $username, $pwd)
{
    $sql = "INSERT INTO users (username, pwd) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    loginUser($conn, $username, $pwd);
}

function emptyInputLogin($username, $pwd)
{
    $result = null;
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd)
{
    $userExists = userExists($conn, $username);

    if ($userExists === false) {
        header("location: ../login.php?error=wronguser");
        exit();
    }

    $pwdHashed = $userExists["pwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wrongpwd");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userId"] = $userExists["usersId"];
        $_SESSION["username"] = $userExists["username"];
        header("location: ../index.php");
        exit();
    }
}

function updateUser($conn, $id, $username, $pwd)
{

    $sql = "UPDATE users SET username = ?, pwd = ?, edited_at = NOW() WHERE usersId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../settings.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssi", $username, $hashedPwd, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $_SESSION["username"] = $username;

    header("location: ../settings.php?error=none");
    exit();
}

function deleteUser($conn, $id)
{
    $sql = "DELETE FROM users WHERE usersId = $id;";
    if (!$conn->query($sql)) {
        echo "Erro ao deletar usuário. " . $conn->error;
    } else {
        header("location: logout.inc.php");
        exit();
    }
}