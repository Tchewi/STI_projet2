<?php
require_once("utils/session.php");
startSession();
checkAdmin();
?>

<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Admin home page</h1>

<?php
if (isset($_GET['error'])) {
    echo htmlspecialchars($_GET['error']);
}
?>

<form action="reception.php" method="post">
    <input class="button" type="submit" value="Message reception">
</form>

<form action="new_message.php" method="post">
    <input class="button" type="submit" value="New message">
</form>

<form action="change_password.php" method="post">
    <input class="button" type="submit" value="Change password">
</form>

<form action="user.php" method="post">
    <input class="button" type="submit" value="Manage user">
</form>

<form action="login.php" method="post">
    <input class="button" type="submit" value="Log out">
</form>

</body>
</html>