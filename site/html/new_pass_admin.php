<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
require_once("utils/db.php");
require_once("utils/password_policy.php");
startSession();
checkAdmin();

$db = new DB();

if ($db->lastErrorCode()) {
    $error = $db->lastErrorMsg();
    header("Location: user.php?error={$error}");
    exit;
} else {
    verify_csrf_token();
    $newpass = $_POST['new_pass'];
    $username = $_POST['usr'];

    if (!checkPasswordPolicy($newpass)) {
        $error = "Password does not match password policy";
        header("Location: user.php?error={$error}");

    } else {
        $newPassHash = password_hash($newpass, PASSWORD_DEFAULT);

        $stmt = $db->prepare('UPDATE ACCOUNT SET PASSWORD=:pwdHash WHERE USERNAME=:usr');
        $stmt->bindValue(":usr", $username);
        $stmt->bindValue(":pwdHash", $newPassHash);

        $ret = $stmt->execute();

        if (!$ret) {
            $error = "Operation failed";
            header("Location: user.php?error={$error}");
        } else {
            $success = "Password successfully changed";
            header("Location: user.php?error={$success}");
        }
    }
}

$db->close();

?>

<html>
<head>
    <title>modify user</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<form action="modify_user.php" cmethod="post">
    <input class="button" type="submit" value="Go back">
</form>

<form action="welcome.php" cmethod="post">
    <input class="button" type="submit" value="Home">
</form>

</body>
</html>