<?php

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

$valid = 1;

if(!$db) {
    echo $db->lastErrorMsg();
}

$username = $_POST['username'];
$password = $_POST['password'];

if (!$username) {
    echo 'Failed: Empty username';
    //header("Location: account.php");

} else if (!$password){
    echo 'Failde: Empty password';
    //header("Location: account.php");
} else {

$sql2 =<<<EOF
INSERT INTO ACCOUNT (USERNAME,PASSWORD,VALIDITY,STATUS)
VALUES ("$username", "$password", 1, 0);
EOF;

    $ret2 = $db->exec($sql2);

    if (!$ret2) {
        echo 'Failed: Username is already taken';
        //header("Location: account.php");
    } else {
        echo 'Account creation success';
    }
}

$db->close();

?>

<html>
<head>
  <title>create account</title>
</head>
<body>

<form action="account.php" cmethod="post">
<input class="button" type="submit" value="Return to account creation page">
</form>

<form action="login.php" cmethod="post">
<input class="button" type="submit" value="Return to login page">
</form>

</body>
</html>

