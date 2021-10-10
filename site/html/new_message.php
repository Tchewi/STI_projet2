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
  <title>Write message</title>
</head>
 
<body>
  <h1>New message</h1>

<form action="send_message.php" method="post">
<div>Destinataire</div>
<input type="text" name="dest"></br>
<div>Sujet</div>
<input type="text" name="subject"></br>
<div>Contenu</div>
<input type="text" name="content"></br>
<input type="submit" value="Send"></br>

<form method="post">
<inpupt type="hidden" name="goHome" value="1">
<input type="submit" value="Home">
</form>

<?php

$true = $_POST['goHome'];
if($true) {
    header("Location: welcome.php");
}
?>

</body>