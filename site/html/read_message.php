<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
require_once("utils/db.php");
startSession();
checkValid();
?>

<html>
<head>
    <title>Read message</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>Message</h1>

<?php

$db = new DB();

if ($db->lastErrorCode()) {
    $error = $db->lastErrorMsg();
    $db->close();
    header("Location: reception.php?error={$error}");
    exit;
}
verify_csrf_token();

$id = $_POST['id'];

$stmt = $db->prepare('SELECT * from MESSAGE WHERE ID = :id');
$stmt->bindValue(":id", $id, SQLITE3_INTEGER);

$ret = $stmt->execute();

if ($ret) {

    $row = $ret->fetchArray(SQLITE3_ASSOC);

    echo "Expeditor: " . $row['EXP'] . "<br>";
    echo "Subject: " . $row['SUBJECT'] . "<br>";
    echo "Date: " . $row['DATE'] . " - " . $row['TIME'] . "<br>";
//echo "Text:<br><br>". $row['CONTENT']. "<br>";
    echo "<br>";
    echo '<textarea rows="10" cols="50">' . $row['CONTENT'] . '</textarea>';

} else {
    $db->close();
    $error = 'No message found';
    header("Location: reception.php?error={$error}");
}

$db->close();

?>

<form action="reply.php" method="post">
    <input type="hidden" name="dest" value="<?php echo $row['EXP'] ?>">
    <input class="button" type="submit" value="Reply">
</form>

<form action="delete_message.php" method="post">
    <input type="hidden" name="id" value=<?php echo $id; ?>>
    <input class="button" type="submit" value="Delete">
</form>

<form action="reception.php" method="post">
    <input class="button" type="submit" value="Go back">
</form>

<form action="welcome.php" method="post">
    <input class="button" type="submit" value="Home">
</form>

</body>
</html>

