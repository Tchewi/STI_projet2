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
  <title>Reception</title>
</head>
 
<body>
  <h1>Reception page</h1>

<?php

// fetch all message destined to user

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

if(!$db) {
    echo $db->lastErrorMsg();
}

$username = $_SESSION['username'];

$sql =<<<EOF
SELECT * from MESSAGE
WHERE DEST = "$username"
ORDER BY ID DESC;
EOF;

$ret = $db->query($sql);

if($ret) {

    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        echo "Expeditor: ". $row['EXP']. " ";
        echo "Subject: ". $row['SUBJECT']. " ";
        echo "Date: ". $row['DATE'] ." ";
        echo "ID: ". $row['ID'] ." ";
    }
} else {
    echo 'No message :(';
}

$db->close();

?>

<br></br>
<form action="read_message.php" method="post">
<div>Message ID</div> 
<input type="text" name="id"><br>
<input type="submit" value="Read message">
</form>

<form action="welcome.php" method="post">
<input type="submit" value="Home">
</form>

</body>