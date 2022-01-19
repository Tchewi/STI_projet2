<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
startSession();
checkAdmin();

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

