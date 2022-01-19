<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
startSession();
checkValid();
generate_csrf();
?>

<html>
<head>
    <title>new message</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>New message</h1>



<form action="send_message.php" method="post">
    <div>Destinataire</div>
    <input type="text" name="dest" require></br>
    <div>Sujet</div>
    <input type="text" name="subject"></br>
    <div>Contenu</div>
    <textarea name="content" rows="10" cols="50"></textarea>
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    </br><input class="button" type="submit" value="Send">
</form>

<form action="welcome.php" method="post">
    <input class="button" type="submit" value="Home">
</form>

</body>
</html>

