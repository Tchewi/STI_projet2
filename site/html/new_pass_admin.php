<?php
session_start();
if ($_SESSION["valid"] != 1) {
    if ($_SESSION["admin"] != 1) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    }
}

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

if(!$db) {
    $error = $db->lastErrorMsg();
    header("Location: user.php?error={$error}");

} else {

$newpass = $_POST['new_pass'];
$username = $_POST['usr'];

if (!$newpass) {
    $error = "Empty password";
    header("Location: user.php?error={$error}");

} else {

$sql =<<<EOF
UPDATE ACCOUNT 
SET PASSWORD="$newpass"
WHERE USERNAME="$username";
EOF;


$ret = $db->exec($sql);

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