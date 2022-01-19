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
    $newstatus = $_POST['status'];
    $username = $_POST['usr'];

    if ($newstatus == "admin") {
        $status = 1;
    } else {
        $status = 0;
    }

    $stmt = $db->prepare('UPDATE ACCOUNT SET STATUS=:status WHERE USERNAME = :usr');
    $stmt->bindValue(":status", $newstatus);
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

?>
