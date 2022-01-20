<?php
/***
 * @author  Rébecca Tevaearai
 * @date    11.10.2021
 */
require_once("utils/session.php");
require_once "utils/csrf.php";

$path = "../databases/database.sqlite";


class DB extends SQLite3 {
    function __construct()  {
        $this->open("../databases/database.sqlite");
    }
 }

$db = new DB();

if($db->lastErrorCode()) {
    $error = "Database is unavailable";
    $db->close();
    header("Location: login.php?error={$error}");
    exit;
}

startSession();
verify_csrf_token();

$username = $_POST['username'];
$password = $_POST['password'];

//Gestion nom d'utilisateur vide
if (!$username){
    $error = 'Empty username';
    header("Location: login.php?error={$error}");
    die();
}

$stmt = $db->prepare('SELECT * from ACCOUNT WHERE USERNAME = :usr');
$stmt->bindValue(":usr", $username);

$ret = $stmt->execute();

//Gestion nom d'utilisateur inexistant
if (!$ret) {
    $error = 'Invalid login';
    header("Location: login.php?error={$error}");
    die();
}

$row = $ret->fetchArray(SQLITE3_ASSOC);

$usr = $row['USERNAME'];
$pwd = $row['PASSWORD'];
$admin = $row['STATUS'];
$valid = $row['VALIDITY'];
$nbAttemptCon = $row['NB_ATTEMPT_CON'];

// validity = 0
if (!$valid) {
    $error = 'Account is disabled';
    header("Location: login.php?error={$error}");

// Wrong password
} else if (!password_verify($password, $pwd)) {

    // Update the number of connexions attempted for the account
    if ($nbAttemptCon < 5) {
        $stmt = $db->prepare('UPDATE ACCOUNT SET NB_ATTEMPT_CON = :nbAttemptCon WHERE USERNAME = :usr');
        $stmt->bindValue(":nbAttemptCon", ++$nbAttemptCon);

    } else { // Disable account if nb connexions attempted exceed 5
        $stmt = $db->prepare('UPDATE ACCOUNT SET VALIDITY = :validity WHERE USERNAME = :usr');
        $stmt->bindValue(":validity", 0);
    }

    $stmt->bindValue(":usr", $usr);

    $stmt->execute();

    $error = 'Invalid login';
    header("Location: login.php?error={$error}");

// give a valid session and an admin session in case of an admin account
} else {
    // Reset of connexion attempt
    if ($nbAttemptCon != 0) {
        $stmt = $db->prepare('UPDATE ACCOUNT SET NB_ATTEMPT_CON = :nbAttemptCon WHERE USERNAME = :usr');
        $stmt->bindValue(":nbAttemptCon", 0);
        $stmt->bindValue(":usr", $usr);
    }

    $stmt->execute();

    session_unset(); // in order to create new one and invalidate csrf
    session_destroy();
    startSession();
    $_SESSION["valid"] = 1;
    $_SESSION["username"] = $usr;

    if($admin == 1) {
        $_SESSION["admin"] = 1;
    } 
        header("Location: welcome.php");
    }


$db->close();
