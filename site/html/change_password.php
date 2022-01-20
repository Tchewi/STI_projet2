<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
startSession();
checkValid();
generate_csrf_token();
?>

<html>
<head>
    <title>password</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>Change password</h1>

<form action="new_password.php" method="post">
    <div>Old password</div>
    <input type="password" name="oldpass">
    <div>New password</div>
    <input type="password" name="newpass"></br>
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    <input class="button" type="submit" value="Send">
</form>

<form action="welcome.php" cmethod="post">
    <input class="button" type="submit" value="Home">
</form>

</body>
</html>