<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
require_once("utils/db.php");
startSession();
checkAdmin();
generate_csrf_token();

$username = htmlspecialchars($_POST['username']);

if (!$username) {
    $error = "Empty username";
    header("Location: user.php?error={$error}");
}

$db = new DB();

if ($db->LastErrorCode()) {
    $error = "Database is unavailable";
    $db->close();
    header("Location: user.php?error={$error}");
}
else {
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

}

?>

<html>
<head>
    <title>modify user</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Modify <?php echo htmlspecialchars($username) ?> account</h1>

<form action="new_pass_admin.php" method="post">
    <input type="hidden" name="usr" value="<?php echo htmlspecialchars($username) ?>">
    <input type="password" name="new_pass">
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    <input class="button" type="submit" value="New password">
</form>

<form action="new_status.php" method="post">
    <input type="hidden" name="usr" value="<?php echo htmlspecialchars($username) ?>">
    <input type="radio" name="status" value="collaborateur">
    <label>Collaborateur</label><br>
    <input type="radio" name="status" value="admin">
    <label>Admin</label><br>
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    <input class="button" type="submit" value="New status">
</form>

<form action="new_validity.php" method="post">
    <input type="hidden" name="usr" value="<?php echo htmlspecialchars($username) ?>">
    <input type="radio" name="validity" value="1">
    <label>Activate</label><br>
    <input type="radio" name="validity" value="0">
    <label>Disable</label><br>
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    <input class="button" type="submit" value="Change">
</form>

<form action="user.php" method="post">
    <input class="button" type="submit" value="Go back">
</form>

<form action="welcome_admin.php" method="post">
    <input class="button" type="submit" value="Home">
</form>

</body>
</html>