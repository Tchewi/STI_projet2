<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="login.css" />
</head>
<body>

     <h2>Login</h2>

<!-- Authentication -->
<form action="verify_login.php" method="post">
<div>Username</div> 
<input type="text" name="username"><br>
<div>Password</div>
<input type="password" name="password"><br>
<input type="submit" value="login">
</form>

<!-- Lost password -->
<form action="dommage.php" method="post">
<input class="button" type="submit" value="Password lost?">
</form>

<h2>Create account</h2>

<!-- Account creation -->
<form action="create_account.php" cmethod="post">
<div>Username</div>
<input type="text" name="username"><br>
<div>Password</div>
<input type="password" name="pwd"><br>
<input class="button" type="submit" value="Create account">
</form>

</body>
</html>
