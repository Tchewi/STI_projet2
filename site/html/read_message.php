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
  <title>Read message</title>
</head>
 
<body>
  <h1>Read page</h1>

<?php

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

if(!$db) {
    echo $db->lastErrorMsg();
}

$id = $_POST['id'];

echo $id;

$sql =<<<EOF
SELECT * from MESSAGE
WHERE ID = "$id";
EOF;

$ret = $db->query($sql);


if($ret) {

    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        echo "Expeditor: ". $row['EXP']. " ";
        echo "Subject: ". $row['SUBJECT']. " ";
        echo "Date: ". $row['DATE'] ." ";
        echo "Text: ". $row['CONTENT'] ." ";
    }

} else {
    echo 'No message found';
}

$db->close();

?>

<form action="reply.php" method="post">
<input type="submit" value="Reply">
</form>

<form action="delete.php" method="post">
<input type="submit" value="Delete">
</form>

<form action="reception.php" method="post">
<input type="submit" value="Go back">
</form>

<form action="welcome.php" method="post">
<input type="submit" value="Home">
</form>

</body>