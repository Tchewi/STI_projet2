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
  <link rel="stylesheet" href="style.css">
</head>
 
<body>
  <h1>Change password</h1>

<form action="new_password.php" method="post">
<div>Old password</div>
<input type="text" name="oldpass">
<div>New password</div>
<input type="text" name="newpass"></br>
<input class="button" type="submit" value="Send">
</form>

<form action="welcome.php" cmethod="post">
<input class="button" type="submit" value="Home">
</form>

</body>
</html>