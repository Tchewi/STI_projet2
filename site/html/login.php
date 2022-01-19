<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
startSession();
generate_csrf();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Login</h1>

<!-- Authentication -->
<form action="verify_login.php" method="post">
    <br>
    <div>Username</div>
    <input type="text" name="username"><br>
    <div>Password</div>
    <input type="password" name="password"><br>
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    <input class="button" type="submit" value="Login">
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
