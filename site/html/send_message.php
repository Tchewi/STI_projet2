<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
require_once("utils/db.php");
startSession();

$db = new DB();

if ($db->lastErrorCode()) {
    $error = $db->lastErrorMsg();
    $db->close();
    header("Location: new_message.php?error={$error}");
    exit;
}
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