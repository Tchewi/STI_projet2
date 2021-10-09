<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Account</title>
</head>
<body>

<h2>Account creation</h2>

<!-- Account creation -->
<form action="create_account.php" method="post">
<div>Username</div>
<input type="text" name="username"><br>
<div>Password</div>
<input type="password" name="password"><br>
<input class="button" type="submit" value="Create">
</form>

<form action="login.php" method="post">
<input class="button" type="submit" value="Return to login page">
</form>

</body>
</html>