<?php
session_start();
session_unset();
session_destroy();
session_start();
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
if (isset($_GET['error'])) {
    echo htmlspecialchars($_GET['error']);
}
require_once "utils/utils.php";
generate_csrf();
?>


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
