<?php

$path = "../databases/database.sqlite";

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
 }

$db = new DB();

if(!$db) {
    echo $db->lastErrorMsg();
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql =<<<EOF
SELECT * from ACCOUNT
WHERE USERNAME = "$username";
EOF;

$ret = $db->query($sql);

$row = $ret->fetchArray(SQLITE3_ASSOC);

$usr = $row['USERNAME'];
$pwd = $row['PASSWORD'];

if (!$usr) {
    echo 'Invalid login';
} else if ($password != $pwd) {
    echo 'Invalid login';
} else {
    //donne une session valide
    $db->close();
    session_start();
    $_SESSION["valid"] = 1;
    $_SESSION["username"] = $username;
    header("Location: welcome.php");
}

$db->close();

?>

<html>
<head>
  <title>Verify login</title>
</head>

<form action="login.php" cmethod="post">
<input class="button" type="submit" value="Return to login page">
</form>

</body>
</html>