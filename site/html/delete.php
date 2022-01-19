<?php
session_start();
if ($_SESSION["valid"] != 1) {
    session_unset();
    session_destroy();
    header("Location: login.php");
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
    echo $db->lastErrorMsg();
    header("Location: reception.php");
    exit;
}
else {
    require_once "utils/utils.php";
    verify_csrf();
    $id = $_POST['id'];

    $stmt = $db->prepare('DELETE from MESSAGE WHERE ID = :id');
    $stmt->bindValue(":id", $id, SQLITE3_INTEGER);

    $ret = $stmt->execute();


    $db->close();

    header("Location: reception.php");

}


?>
