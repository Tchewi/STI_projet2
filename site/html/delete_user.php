<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
require_once("utils/db.php");
startSession();
checkAdmin();

$db = new DB();
$error = "";

if ($db->LastErrorCode()) {
    $error = "Database is unavailable";
}
else {
    verify_csrf_token();
    $username = $_POST['username'];

    $stmt = $db->prepare('DELETE from ACCOUNT WHERE USERNAME = :usr');
    $stmt->bindValue(":usr", $username);

    $ret = $stmt->execute();

    $db->close();

    $usr = $_SESSION['username'];

    if ($username = $usr) {
        header("Location: login.php");
        exit;
    }
}

header("Location: user.php?error=" . $error);

