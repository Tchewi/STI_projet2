<?php
require_once("utils/session.php");
startSession();
checkValid();

if ($_SESSION["admin"] == 1) {
    if (isset($_GET['error'])) {
        header("Location: welcome_admin.php?error={$_GET['error']}");

    } else {
        header("Location: welcome_admin.php");
    }
    exit;
}
?>

<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>Home page</h1>

<form action="reception.php" method="post">
    <input class="button" type="submit" value="Message reception">
</form>

<form action="new_message.php" method="post">
    <input class="button" type="submit" value="New message">
</form>

<form action="change_password.php" method="post">
    <input class="button" type="submit" value="Change password">
</form>

<form action="login.php" cmethod="post">
    <input class="button" type="submit" value="Log out">
</form>

</body>
</html>