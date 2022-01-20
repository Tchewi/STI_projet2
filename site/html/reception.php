<?php
require_once("utils/session.php");
require_once("utils/db.php");
require_once("utils/csrf.php");
startSession();
checkValid();
generate_csrf_token();
?>

<html>
<head>
    <title>Reception</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>Reception</h1>
<br>
<?php
// fetch all message destined to user
$db = new DB();

if ($db->lastErrorCode()) {
    $error = "Database is unavailable";
    $db->close();
    header("Location: welcome.php");
    exit;
}

// no need for csrf verify

$username = $_SESSION['username'];

$stmt = $db->prepare('SELECT * from MESSAGE WHERE DEST = :usr ORDER BY ID DESC');
$stmt->bindValue(":usr", $username);

$ret = $stmt->execute();

if ($ret) {

    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        echo "Expeditor: " . htmlspecialchars($row['EXP']) . "<br>";
        echo "Subject: " . htmlspecialchars($row['SUBJECT']) . "<br>";
        echo "Date: " . htmlspecialchars($row['DATE'] . " - " . $row['TIME']) . "<br>";

        echo '<form action="read_message.php" method="post">';
        echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['ID']) . '">';
        if(isset($_SESSION['token'])){
            echo '<input type="hidden" name="token" value="' .  $_SESSION['token'] . '">';
        }

        echo '<input class="button" type="submit" value="Read"></form>';
    }
}

$db->close();

?>

<form action="welcome.php" method="post">
    <input class="button" type="submit" value="Home">
</form>
