<?php
session_start();
if ($_SESSION["valid"] != 1) {
    if ($_SESSION["admin"] != 1) {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
}

$username = htmlspecialchars($_POST['username']);

if (!$username) {
    $error = "Empty username";
    header("Location: user.php?error={$error}");
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
    header("Location: user.php?error={$error}");
}

$stmt = $db->prepare('SELECT * from ACCOUNT WHERE USERNAME = :usr');
$stmt->bindValue(":usr", $username);

$ret = $stmt->execute();
$row = $ret->fetchArray(SQLITE3_ASSOC);

$usr = $row['USERNAME'];

$db->close();

if (!$usr) {
    $error = "User doesn't exist";
    header("Location: user.php?error={$error}");
}

?>

<html>
<head>
    <title>modify user</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Modify <?php echo $username ?> account</h1>

<?php
if (isset($_GET['error'])) {
    echo htmlspecialchars($_GET['error']);
}
?>

<form action="new_pass_admin.php" method="post">
    <input type="hidden" name="usr" value="<?php echo $username ?>">
    <input type="text" name="new_pass">
    <input class="button" type="submit" value="New password">
</form>

<form action="new_status.php" method="post">
    <input type="hidden" name="usr" value="<?php echo $username ?>">
    <input type="radio" name="status" value="collaborateur">
    <label>Collaborateur</label><br>
    <input type="radio" name="status" value="admin">
    <label>Admin</label><br>
    <input class="button" type="submit" value="New status">
</form>

<form action="new_validity.php" method="post">
    <input type="hidden" name="usr" value="<?php echo $username ?>">
    <input type="radio" name="validity" value="1">
    <label>Activate</label><br>
    <input type="radio" name="validity" value="0">
    <label>Desactivate</label><br>
    <input class="button" type="submit" value="Change">
</form>

<form action="user.php" cmethod="post">
    <input class="button" type="submit" value="Go back">
</form>

<form action="welcome_admin.php" cmethod="post">
    <input class="button" type="submit" value="Home">
</form>

</body>
</html>