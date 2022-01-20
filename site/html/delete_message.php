<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
require_once("utils/db.php");
startSession();
checkValid();

$db = new DB();

if ($db->lastErrorCode()) {
    echo $db->lastErrorMsg();
    header("Location: reception.php");
    exit;
}
else {
    verify_csrf();
    $id = $_POST['id'];

    $stmt = $db->prepare('DELETE from MESSAGE WHERE ID = :id');
    $stmt->bindValue(":id", $id, SQLITE3_INTEGER);

    $ret = $stmt->execute();


    $db->close();

    header("Location: reception.php");

}


?>
