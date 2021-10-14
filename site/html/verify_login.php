<?php
/***
 * @author  Rébecca Tevaearai
 * @date    11.10.2021
 */

$path = "../databases/database.sqlite";

class DB extends SQLite3 {
    function __construct()  {
        $this->open("../databases/database.sqlite");
    }
 }

$db = new DB();

if(!$db) {
    $error = $db->lastErrorMsg();
    $db->close();
    header("Location: login.php?error={$error}");
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql =<<<EOF
SELECT * from ACCOUNT
WHERE USERNAME = "$username";
EOF;

$ret = $db->query($sql);

$row = $ret->fetchArray(SQLITE3_ASSOC);

$usr = $row['USERNAME'];
$pwd = $row['PASSWORD'];
$admin = $row['STATUS'];
$valid = $row['VALIDITY'];

// username doesn't exist
if (!$usr) {
    $db->close();
    $error = 'Invalid login';
    header("Location: login.php?error={$error}");

// wrong password
} else if ($password != $pwd) {
    $db->close();
    $error = 'Invalid login';
    header("Location: login.php?error={$error}");

// validity = 0
} else if (!$valid) {
    $db->close();
    $error = 'account is desactivate';
    header("Location: login.php?error={$error}");

// give a valid session and an admin session in case of an admin account
} else {
    $db->close();
    session_start();
    $_SESSION["valid"] = 1;
    $_SESSION["username"] = $usr;

    if($admin == 1) {
        $_SESSION["admin"] = 1;
        //header("Location: welcome_admin.php");

    } 
        header("Location: welcome.php");
    }


$db->close();

?>