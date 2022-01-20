<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
require_once("utils/db.php");
startSession();
checkAdmin();

$db = new DB();

if ($db->lastErrorCode()) {
    echo $db->lastErrorMsg();
    header("Location: change_password.php");
    exit;
}
verify_csrf_token();
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
    <link rel="stylesheet" href="css/style.css">
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