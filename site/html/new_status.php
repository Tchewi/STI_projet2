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

if (!$db) {
    $error = $db->lastErrorMsg();
    header("Location: user.php?error={$error}");

} else {

    $newstatus = $_POST['status'];
    $username = $_POST['usr'];

    if ($newstatus == "admin") {
        $status = 1;
    } else {
        $status = 0;
    }

    $sql = <<<EOF
UPDATE ACCOUNT 
SET STATUS="$status"
WHERE USERNAME="$username";
EOF;

    $ret = $db->exec($sql);

    if (!$ret) {
        $error = "Operation failed";
        header("Location: user.php?error={$error}");
    } else {
        $error = "Status successfully changed";
        header("Location: user.php?error={$error}");
    }

}

$db->close();
unset($db);

?>
