<?php
/***
 * @author  Rébecca Tevaearai
 * @date    11.10.2021
 */

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

if(!$db) {
    $error = $db->lastErrorMsg();
    $db->close();
    header("Location: account.php?error={$error}");
}

$username = $_POST['username'];
$password = $_POST['password'];

if (!$username) {
    $db->close();
    $error = 'Failed: Empty username';
    header("Location: account.php?error={$error}");

} else if (!$password){
    $db->close();
    $error = 'Failed: Empty password';
    header("Location: account.php?error={$error}");

} else {

$sql =<<<EOF
INSERT INTO ACCOUNT (USERNAME,PASSWORD,VALIDITY,STATUS)
VALUES ("$username", "$password", 1, 0);
EOF;

    $ret = $db->exec($sql);

    if (!$ret) {
        $db->close();
        $error = 'Failed: Username is already taken';
        header("Location: account.php?error={$error}");

    } else {
        $db->close();
        $error = 'Account creation success';
        header("Location: account.php?error={$error}");
    }
}

$db->close();

?>

