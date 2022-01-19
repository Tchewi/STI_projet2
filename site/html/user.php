<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
startSession();
checkAdmin();
generate_csrf();
?>

<html>
<head>
    <title>User</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>Add a user</h1>

<br>
<form action="add_user.php" method="post">
    <div>Username</div>
    <input type="text" name="username">
    <div>Password</div>
    <input type="text" name="password"><br>
    <input type="radio" name="status" value="0">
    <label>Collaborateur</label><br>
    <input type="radio" name="status" value="1">
    <label>Admin</label><br>
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    <input class="button" type="submit" value="Add user">
</form>
<hr/>
<hr/><hr/>
<h1>Modify existing users</h1>
<form action="modify_user.php" method="post">
    <div>Username</div>
    <input type="text" name="username">
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    <input class="button" type="submit" value="Modify User">
</form>

<form action="delete_user.php" method="post">
    <div>Username</div>
    <input type="text" name="username">
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    <input class="button" type="submit" value="Delete User">
</form>

<form action="welcome_admin.php" cmethod="post">
    <input class="button" type="submit" value="Home">
</form>

</body>
</html>