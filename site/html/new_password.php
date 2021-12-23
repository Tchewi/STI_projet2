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

if (!$db) {
    echo $db->lastErrorMsg();
    header("Location: change_password.php");
}

$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];
$username = $_SESSION['username'];

$sql = <<<EOF
SELECT * from ACCOUNT
WHERE USERNAME="$username";
EOF;

$ret = $db->query($sql);

$row = $ret->fetchArray(SQLITE3_ASSOC);

$pwd = $row['PASSWORD'];

if (!$oldpass) {
    echo 'Failed: Empty field';

} else if ($pwd != $oldpass) {
    echo 'wrong password';

} else if (!$newpass) {
    echo 'Empty new password';

} else {

    $sql2 = <<<EOF
UPDATE ACCOUNT 
SET PASSWORD="$newpass"
WHERE USERNAME="$username";
EOF;

    $ret2 = $db->exec($sql2);

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