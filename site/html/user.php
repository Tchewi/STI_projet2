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
  <title>password</title>
</head>
 
<body>
  <h1>Manage user</h1>

<form action="add_user.php" method="post">
<div>Username</div>
<input type="text" name="username">
<div>password</div>
<input type="text" name="password"></br>
<div>Status (0 = collaborateur, 1 = admin)</div>
<input type="text" name="admin"></br>
<input class="button" type="submit" value="Add User">
</form>

<form action="modify_user.php" method="post">
<div>Username</div>
<input type="text" name="username">
<input class="button" type="submit" value="Modify User">
</form>

<form action="delete_user.php" method="post">
<div>Username</div>
<input type="text" name="username">
<input class="button" type="submit" value="Delete User">
</form>

<form action="welcome_admin.php" cmethod="post">
<input class="button" type="submit" value="Home">
</form>

</body>
</html>