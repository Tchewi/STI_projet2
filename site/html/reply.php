<?php
session_start();
if ($_SESSION["valid"] != 1) {
    session_unset();
    session_destroy();
    header("Location: login.php");
}

class DB extends SQLite3
{
    function __construct()
    {
        $this->open('../databases/database.sqlite');
    }
}

$db = new DB();

if (!$db) {
    $error = $db->lastErrorMsg();
    $db->close();
    header("Location: reception.php?error={$error}");
}

$dest = $_POST['dest'];

$db->close();

?>

<html>
<head>
    <title>Read message</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<h1>Reply to <?php echo htmlspecialchars($dest) ?></h1>

<?php
if (isset($_GET['error'])) {
    echo htmlspecialchars($_GET['error']);
}
?>

<form action="send_reply.php" method="post">
    <input type="hidden" name="dest" value="<?php echo htmlspecialchars($dest) ?>"></br>
    <div>Sujet</div>
    <input type="text" name="subject"></br>
    <div>Contenu</div>
    <input type="text" name="content" size="50"></br>
    <input type="submit" value="Reply">
</form>

<form action="reception.php" method="post">
    <input type="submit" value="Go back">
</form>

<form action="welcome.php" method="post">
    <input type="submit" value="Home">
</form>

</body>