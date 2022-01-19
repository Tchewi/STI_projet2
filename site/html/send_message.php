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
    $error = $db->lastErrorMsg();
    $db->close();
    header("Location: new_message.php?error={$error}");
    exit;
}
require_once "utils/utils.php";
verify_csrf();

$dest = $_POST['dest'];
$subject = $_POST['subject'];
$content = $_POST['content'];
$username = $_SESSION['username'];


if (!$dest) {
    $error = 'Failed: Empty Dest';
} else {

    $stmt = $db->prepare('INSERT INTO MESSAGE (EXP, DEST, SUBJECT, CONTENT) VALUES (:exp, :dest, :sub, :con)');
    $stmt->bindValue(":exp", $username);
    $stmt->bindValue(":dest", $dest);
    $stmt->bindValue(":sub", $subject);
    $stmt->bindValue(":con", $content);

    $ret = $stmt->execute();

    if ($ret) {
        $error = 'Message sent';

    } else {
        $error = 'Something went wrong';
    }
}

$db->close();
header("Location: new_message.php?error={$error}");

?>