<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
require_once("utils/db.php");
startSession();
checkAdmin();

$db = new DB();

if ($db->lastErrorCode()) {
    $error = "Database is unavailable";

} else {
    verify_csrf_token();
    $new_validity = $_POST['validity'];
    $username = $_POST['usr'];

    $stmt = $db->prepare('UPDATE ACCOUNT SET VALIDITY=:val WHERE USERNAME = :usr');
    $stmt->bindValue(":status", $new_validity);
    $stmt->bindValue(":usr", $username);

    $ret = $stmt->execute();


    if (!$ret) {
        $error = "Operation failed";
    } else {

        $error = "Validity successfully changed";
    }

}
$db->close();
header("Location: user.php?error={$error}");

unset($db);

