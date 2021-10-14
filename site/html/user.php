<?php
session_start();
if ($_SESSION["valid"] != 1) {
    if ($_SESSION["admin"] != 1) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    }
}
?>

<html>
<head>
  <title>User</title>
</head>
 
<body>
  <h1>Manage user</h1>

<?php 
    if( isset($_GET['error'])) {
        echo $_GET['error'];
    }
?>

<br></br>

<form action="add_user.php" method="post">
<div>Username</div>
<input type="text" name="username">
<div>password</div>
<input type="text" name="password"></br>
<form action="new_status.php" method="post">
<input type="hidden" name="usr" value="<?php echo $username ?>">
<input type="radio" name="status" value="0">
<label>Collaborateur</label><br>
<input type="radio" name="status" value="1">
<label>Admin</label><br>
<input class="button" type="submit" value="Add user">
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