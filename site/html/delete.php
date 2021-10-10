<?php
session_start();
if ($_SESSION["valid"] != 1) {
  session_unset();
  session_destroy();
  header("Location: login.php");
}

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

if(!$db) {
    echo $db->lastErrorMsg();
}

$id = $_POST['id'];

$sql =<<<EOF
DELETE from MESSAGE
WHERE ID = "$id";
EOF;

$ret = $db->exec($sql);

$db->close();

header("Location: reception.php");

?>
