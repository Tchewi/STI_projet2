<?php

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

if(!$db) {
    echo $db->lastErrorMsg();
    header("Location: message.php");
}


$dest = $_POST['dest'];
$subject = $_POST['subject'];
$content = $_POST['content'];
$username = $_SESSION['username'];

if (!$dest) {
    echo 'Failed: Empty Dest';

} else {

$sql =<<<EOF
INSERT INTO MESSAGE (EXP, DEST, SUBJECT, CONTENT)
VALUES ("$username", "$dest", "$subject", "$content");
EOF;


    $ret = $db->exec($sql);

    if($ret) {
        echo 'Message send';
    } else {
        echo 'Something went wrong';
    }
}

$db->close();

?>

<html>
<head>
  <title>test</title>
</head>
<body>

<form action="new_message.php" cmethod="post">
<input class="button" type="submit" value="Go back">
</form>

<form action="welcome.php" cmethod="post">
<input class="button" type="submit" value="Home">
</form>


</body>
</html>