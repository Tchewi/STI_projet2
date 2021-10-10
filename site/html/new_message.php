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
  <title>hohui</title>
</head>
 
<body>
  <h1>New message</h1>
<!--
<form action="send_message.php" method="post">
<div>Destinataire</div>
<input type="text" name="dest"></br>
<div>Sujet</div>
<input type="text" name="subject"></br>
<div>Contenu</div>
<input type="text" name="content"></br>
<input type="submit" value="Send">
</form>

<form action="send_message.php" method="post">
<div>Destinataire</div> 
<input type="text" name="dest"><br>
<div>Sujet</div>
<input type="text" name="subject"><br>
<div>Contenu</div>
<input type="text" name="content"><br>
<input type="submit" value="login">
</form>


<form action="welcome.php" method="post">
<input class="button" type="submit" value="home">
</form>

-->

<form action="test.php" method="post">
<div>Destinataire</div>
<input type="text" name="dest" require></br>
<div>Sujet</div>
<input type="text" name="subject"></br>
<div>Contenu</div>
<input type="text" name="content"></br>
<input type="submit" value="Send">
</form>

<form action="welcome.php" method="post">
<input class="button" type="submit" value="Home">
</form>

</body>
</html>

