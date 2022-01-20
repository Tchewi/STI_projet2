<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
require_once("utils/db.php");
startSession();
checkAdmin();

$db = new DB();

if ($db->lastErrorCode()) {
    $error = "Database is unavailable";

} else {
    verify_csrf_token();
    $newstatus = $_POST['status'];
    $username = $_POST['usr'];

    if ($newstatus == "admin") {
        $status = 1;
    } else {
        $status = 0;
    }

    $stmt = $db->prepare('UPDATE ACCOUNT SET STATUS=:status WHERE USERNAME = :usr');
    $stmt->bindValue(":status", $status);
    $stmt->bindValue(":usr", $username);

    $ret = $stmt->execute();

    if (!$ret) {
        $error = "Operation failed";
    } else {
        $error = "Status successfully changed";
    }
}
header("Location: user.php?error={$error}");

$db->close();
unset($db);

