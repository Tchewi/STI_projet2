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
  <h1>Reply</h1>

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