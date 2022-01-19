<?php
session_start();
if ($_SESSION["valid"] != 1) {
    if ($_SESSION["admin"] != 1) {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
}
require_once "utils/utils.php";
generate_csrf();
?>

<html>
<head>
    <title>User</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<h1>Add a user</h1>

<?php
if (isset($_GET['error'])) {
    echo htmlspecialchars($_GET['error']);
}
generate_csrf();
?>

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