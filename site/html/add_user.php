<?php
session_start();
if ($_SESSION["valid"] != 1) {
    if ($_SESSION["admin"] != 1) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    }
}

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

if(!$db) {
    $error = $db->lastErrorMsg();
    header("Location: user.php?error={$error}");
} else {

$username = $_POST['username'];
$password = $_POST['password'];
$status = $_POST['status'];

if (!$username) {
    $error = 'Failed: Empty username';
    header("Location: user.php?error={$error}");

} else if (!$password){
    $error = 'Failed: Empty password';
    header("Location: user.php?error={$error}");

} else {

$sql =<<<EOF
INSERT INTO ACCOUNT (USERNAME,PASSWORD,VALIDITY,STATUS)
VALUES ("$username", "$password", 1, "$status");
EOF;

    $ret = $db->exec($sql);

    if (!$ret) {
        $error = 'Failed: Username is already taken';
        header("Location: user.php?error={$error}");

    } else {
        $error = 'Account creation success';
        header("Location: user.php?error={$error}");
    }
}

}

$db->close();

?>
