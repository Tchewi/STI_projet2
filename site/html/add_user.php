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
    echo $db->lastErrorMsg();
}

$username = $_POST['username'];
$password = $_POST['password'];
$status = $_POST['admin'];

if (!$username) {
    echo 'Failed: Empty username';
    //header("Location: account.php");

} else if (!$password){
    echo 'Failed: Empty password';
    //header("Location: account.php");
} else {

$sql2 =<<<EOF
INSERT INTO ACCOUNT (USERNAME,PASSWORD,VALIDITY,STATUS)
VALUES ("$username", "$password", 1, 0);
EOF;

    $ret2 = $db->exec($sql2);

    if (!$ret2) {
        echo 'Failed: Username is already taken';
        //header("Location: account.php");
    } else {
        echo 'Account creation success';
    }
}

$db->close();

?>