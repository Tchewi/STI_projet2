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
    $error = $db->lastErrorMsg();
    $db->close();
    header("Location: reply.php?error={$error}");
}

$dest = $_POST['dest'];
$subject = $_POST['subject'];
$content = $_POST['content'];
$username = $_SESSION['username'];

$sql =<<<EOF
INSERT INTO MESSAGE (EXP, DEST, SUBJECT, CONTENT)
VALUES ("$username", "$dest", "$subject", "$content");
EOF;

$ret = $db->exec($sql);

if($ret) {
    $db->close();
    $error = 'Message send';
    header("Location: reply.php?error={$error}");

} else {
    $db->close();
    $error = 'Something went wrong';
    header("Location: reply.php?error={$error}");
}

$db->close();

?>