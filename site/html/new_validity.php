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

if ($db->lastErrorCode()) {
    $error = $db->lastErrorMsg();

} else {
    require_once "utils/utils.php";
    verify_csrf();
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

?>
