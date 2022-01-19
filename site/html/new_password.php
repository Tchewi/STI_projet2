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
    header("Location: change_password.php");
    exit;
}
require_once "utils/utils.php";
verify_csrf();
$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];
$username = $_SESSION['username'];


$stmt = $db->prepare('SELECT * from ACCOUNT WHERE USERNAME = :usr');
$stmt->bindValue(":usr", $username);

$ret = $stmt->execute();
$row = $ret->fetchArray(SQLITE3_ASSOC);

$pwdHash = $row['PASSWORD'];

if (!$oldpass) {
    echo 'Failed: Empty field';

} else if (!password_verify($oldpass, $pwdHash)) {
    echo 'wrong password';

} else if (!$newpass) {
    echo 'Empty new password';

} else {

    $newPassHash = password_hash($newpass, PASSWORD_DEFAULT);

    $stmt = $db->prepare('UPDATE ACCOUNT SET PASSWORD=:pwdHash WHERE USERNAME = :usr');
    $stmt->bindValue(":pwdHash", $newPassHash);
    $stmt->bindValue(":usr", $username);

    $ret2 = $stmt->execute();

    if (!$ret2) {
        echo 'Failed';
    } else {
        echo 'Password changed';
    }
}

$db->close();

?>

<html>
<head>
    <title>psdaadw</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="change_password.php" cmethod="post">
    <input class="button" type="submit" value="Go back">
</form>

<form action="welcome.php" cmethod="post">
    <input class="button" type="submit" value="Home">
</form>


</body>
</html>