<?php
/***
 * @author  Rébecca Tevaearai
 * @date    11.10.2021
 */

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
}

else {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$username) {
        $error = 'Failed: Empty username';

    } else if (!$password) {
        $error = 'Failed: Empty password';

    } else {

        $passwdHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare('INSERT INTO ACCOUNT (USERNAME, PASSWORD, VALIDITY, STATUS) VALUES (:usr, :pwdHash, 1, 0)');
        $stmt->bindValue(":usr", $username);
        $stmt->bindValue(":pwdHash", $passwdHash);

        $ret = $stmt->execute();

        if (!$ret) {
            $error = 'Failed: Username is already taken';

        } else {
            $error = 'Account creation success';
        }
    }
}

$db->close();
header("Location: account.php?error={$error}");

