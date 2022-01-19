<?php
/***
 * @author  Rébecca Tevaearai
 * @date    11.10.2021
 */
require_once("utils/session.php");
require_once "utils/csrf.php";

$path = "../databases/database.sqlite";


class DB extends SQLite3 {
    function __construct()  {
        $this->open("../databases/database.sqlite");
    }
 }

$db = new DB();

if($db->lastErrorCode()) {
    $error = $db->lastErrorMsg();
    $db->close();
    header("Location: login.php?error={$error}");
    exit;
}

startSession();
verify_csrf();

session_unset(); // in order to create new one and invalidate csrf
session_destroy();

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $db->prepare('SELECT * from ACCOUNT WHERE USERNAME = :usr');
$stmt->bindValue(":usr", $username);

$ret = $stmt->execute();

$row = $ret->fetchArray(SQLITE3_ASSOC);

$usr = $row['USERNAME'];
$pwd = $row['PASSWORD'];
$admin = $row['STATUS'];
$valid = $row['VALIDITY'];

// username doesn't exist or wrong password
if (!$usr || !password_verify($password, $pwd)) {
    $error = 'Invalid login';
    header("Location: login.php?error={$error}");
// validity = 0
} else if (!$valid) {
    $error = 'Account is disabled';
    header("Location: login.php?error={$error}");

// give a valid session and an admin session in case of an admin account
} else {
    session_start();
    $_SESSION["valid"] = 1;
    $_SESSION["username"] = $usr;

    if($admin == 1) {
        $_SESSION["admin"] = 1;
    } 
        header("Location: welcome.php");
    }


$db->close();

?>