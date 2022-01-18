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
    header("Location: reply.php?error={$error}");
} else {
    $dest = $_POST['dest'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $username = $_SESSION['username'];


    $stmt = $db->prepare('INSERT INTO MESSAGE (EXP, DEST, SUBJECT, CONTENT) VALUES (:usr, :dest, :subj, :content)');
    $stmt->bindValue(":usr", $username);
    $stmt->bindValue(":dest", $dest);
    $stmt->bindValue(":subj", $subject);
    $stmt->bindValue(":content", $content);

    $ret = $stmt->execute();

    if ($ret) {
        $error = 'Message send';
        header("Location: reply.php?error={$error}");
        if ($ret) {
            $db->close();
            $error = 'Message send';

        } else {
            $error = 'Something went wrong';
            header("Location: reply.php?error={$error}");
        }
    } else {
        $db->close();
        $error = 'Something went wrong';
    }
}

header("Location: reply.php?error={$error}");

$db->close();

?>