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
  <title>new message</title>
</head>
 
<body>
  <h1>New message</h1>

<?php
  if (isset($_GET['error'])) {
    echo $_GET['error'];
  }
?>

<form action="send_message.php" method="post">
<div>Destinataire</div>
<input type="text" name="dest" require></br>
<div>Sujet</div>
<input type="text" name="subject"></br>
<div>Contenu</div>
<input type="text" name="content" size="50"></br>
<input type="submit" value="Send">
</form>

<form action="welcome.php" method="post">
<input class="button" type="submit" value="Home">
</form>

</body>
</html>

