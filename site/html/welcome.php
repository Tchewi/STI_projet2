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
  <title>Welcome</title>
</head>
 
<body>
  <h1>Home page</h1>

<form action="reception.php" method="post">
<input type="submit" value="Message reception">
</form>

<form action="new_message.php" method="post">
<input type="submit" value="New message">
</form>

<form action="change_password.php" method="post">
<input type="submit" value="Change password">
</form>

<form action="user.php" method="post">
<input type="submit" value="Manage user">
</form>

<form action="login.php" cmethod="post">
<input class="button" type="submit" value="Log out">
</form>

</body>
</html>