<?php
session_start();
if ($_SESSION["valid"] != 1) {
    if ($_SESSION["admin"] != 1) {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
}

class DB extends SQLite3
{
    function __construct()
    {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

if (!$db->lastErrorCode()) {
    $error = $db->lastErrorMsg();
} else {
    require_once "utils/utils.php";
    verify_csrf();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    if (!$username) {
        $error = 'Failed: Empty username';
    } else if (!$password) {
        $error = 'Failed: Empty password';
    } else if (!isset($_POST['status'])) {
        $error = 'Failed: No status given';
    } else {

        $stmt = $db->prepare('INSERT INTO ACCOUNT (USERNAME, PASSWORD, VALIDITY, STATUS) VALUES (:usr, :pwd, 1, :stat)');
        $stmt->bindValue(":usr", $username);
        $stmt->bindValue(":pwd", $password);
        $stmt->bindValue(":stat", $status);

        $ret = $stmt->execute();

        if (!$ret) {
            $error = 'Failed: Username is already taken';

        } else {
            $error = 'Account creation success';
        }
    }
}
$db->close();
header("Location: user.php?error={$error}");

?>
