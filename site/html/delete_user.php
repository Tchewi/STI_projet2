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

if ($db->LastErrorCode()) {
    echo $db->lastErrorMsg();
}
else {
    require_once "utils/utils.php";
    verify_csrf();
    $username = $_POST['username'];

    $stmt = $db->prepare('DELETE from ACCOUNT WHERE USERNAME = :usr');
    $stmt->bindValue(":usr", $username);

    $ret = $stmt->execute();

    $db->close();

    $usr = $_SESSION['username'];

    if ($username = $usr) {
        header("Location: login.php");
    }
}

header("Location: user.php");

