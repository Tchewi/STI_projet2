<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
checkValid();
startSession();

class DB extends SQLite3
{
    function __construct()
    {
        $this->open('../databases/database.sqlite');
    }
}

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
