<!DOCTYPE html>
<html>
<head>
    <title>Account</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Account creation</h2>

<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
startSession();
checkValid();
generate_csrf();
?>

<!-- Account creation -->
<form action="create_account.php" method="post">
    <br>
    <div>Username</div>
    <input type="text" name="username"><br>
    <div>Password</div>
    <input type="password" name="password"><br>
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    <input class="button" type="submit" value="Create">
</form>

<form action="login.php" method="post">
    <input class="button" type="submit" value="Return to login page">
</form>

</body>
</html>