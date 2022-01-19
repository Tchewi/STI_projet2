<?php
session_start();
if ($_SESSION["valid"] != 1) {
    if ($_SESSION["admin"] != 1) {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
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
    header("Location: user.php?error={$error}");
    exit;
} else {
    require_once "utils/utils.php";
    verify_csrf();
    $newpass = $_POST['new_pass'];
    $username = $_POST['usr'];

    if (!$newpass) {
        $error = "Empty password";
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
    <link rel="stylesheet" href="style.css">
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