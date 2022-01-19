<?php
session_start();
if ($_SESSION["valid"] != 1) {
    session_unset();
    session_destroy();
    header("Location: login.php");
}
require_once "utils/utils.php";
generate_csrf();
?>

<html>
<head>
    <title>new message</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<h1>New message</h1>

<?php
if (isset($_GET['error'])) {
    echo htmlspecialchars($_GET['error']);
}
?>

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

