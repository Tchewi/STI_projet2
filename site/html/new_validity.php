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
    $db->close();
    header("Location: user.php?error={$error}");

} else {

    $new_validity = $_POST['validity'];
    $username = $_POST['usr'];

    /*
    if ($newstatus == "admin") {
        $status = 1;
    } else {
        $status = 0;
    }
    */

    $sql = <<<EOF
UPDATE ACCOUNT 
SET VALIDITY="$new_validity"
WHERE USERNAME="$username";
EOF;

    $ret = $db->exec($sql);

    if (!$ret) {
        $db->close();
        $error = "Operation failed";
        header("Location: user.php?error={$error}");

    } else {
        $db->close();
        $error = "Validity successfully changed";
        header("Location: user.php?error={$error}");
    }

}

$db->close();
unset($db);

?>
