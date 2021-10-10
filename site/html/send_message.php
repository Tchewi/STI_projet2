<?php
session_start();
if ($_SESSION["valid"] != 1) {
  session_unset();
  session_destroy();
  header("Location: login.php");
}
?>

<html>
<head>
  <title>disaodjsidos</title>
</head>
<body>

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

$sql =<<<EOF
INSERT INTO MESSAGE (EXP, DEST, SUBJECT, CONTENT)
VALUES ("$username", "$dest", "$subject", "$content");
EOF;

$ret = $db->exec($sql);

$db->close();

header("Location: message.php");

?>

</body>
</html>


