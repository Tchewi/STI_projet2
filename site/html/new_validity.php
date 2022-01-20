<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
require_once("utils/db.php");
startSession();
checkAdmin();

$db = new DB();

if ($db->lastErrorCode()) {
    $error = $db->lastErrorMsg();

} else {
    verify_csrf_token();
    $new_validity = $_POST['validity'];
    $username = $_POST['usr'];

    $stmt = $db->prepare('UPDATE ACCOUNT SET VALIDITY = :validity, NB_ATTEMPT_CON = :nbAttemptCon WHERE USERNAME = :usr');
    $stmt->bindValue(":validity", $new_validity);
    $stmt->bindValue(":nbAttemptCon", 0);
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

