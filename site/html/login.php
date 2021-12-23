<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

     <h1>Login</h1>

<?php 
if( isset($_GET['error'])) {
    echo $_GET['error'];
}
?>


<!-- Authentication -->
<form action="verify_login.php" method="post">
<br><div>Username</div> 
<input type="text" name="username"><br>
<div>Password</div>
<input type="password" name="password"><br>
<input class="button" type="submit" value="login">
</form>

<!-- Lost password -->
<form action="dommage.php" method="post">
<input class="button" type="submit" value="Password lost?">
</form>

<!-- Account creation -->
<form action="account.php" cmethod="post">
<input class="button" type="submit" value="Create account">
</form>

</body>
</html>
