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
    echo $db->lastErrorMsg();
}

$username = $_POST['username'];

$sql = <<<EOF
DELETE from ACCOUNT
WHERE USERNAME = "$username";
EOF;

$ret = $db->exec($sql);

$db->close();

$usr = $_SESSION['username'];

if ($username = $usr) {
    header("Location: login.php");
}

header("Location: user.php");

?>