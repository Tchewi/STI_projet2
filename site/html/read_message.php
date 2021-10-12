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
  <h1>Message</h1>

<?php

class DB extends SQLite3 {
    function __construct()  {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

if(!$db) {
    $error = $db->lastErrorMsg();
    $db->close();
    header("Location: reception.php?error={$error}");
}

$id = $_POST['id'];

$sql =<<<EOF
SELECT * from MESSAGE
WHERE ID = "$id";
EOF;

$ret = $db->query($sql);

if($ret) {

$row = $ret->fetchArray(SQLITE3_ASSOC);

echo "Expeditor: ". $row['EXP']. "<br>";
echo "Subject: ". $row['SUBJECT']. "<br>";
echo "Date: ". $row['DATE']. " - ". $row['TIME']."<br>";
echo "Text:<br><br>". $row['CONTENT']. "<br>";
echo "<br>";

} else {
    $db->close();
    $error = 'No message found';
    header("Location: reception.php?error={$error}");
}

$db->close();

?>

<form action="reply.php" method="post">
<input type="hidden" name="dest" value="<?php echo $row['EXP']?>">
<input type="submit" value="Reply">
</form>

<form action="delete.php" method="post">
<input type="hidden" name="id" value=<?php echo $id; ?>>
<input type="submit" value="Delete">
</form>

<form action="reception.php" method="post">
<input type="submit" value="Go back">
</form>

<form action="welcome.php" method="post">
<input type="submit" value="Home">
</form>

</body>
</html>

