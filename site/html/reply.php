<?php
require_once("utils/session.php");
require_once("utils/csrf.php");
startSession();
generate_csrf();
$dest = $_POST['dest'];
?>

<html>
<head>
    <title>Read message</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>Reply to <?php echo htmlspecialchars($dest) ?></h1>

<form action="send_message.php" method="post">
    <input type="hidden" name="dest" value="<?php echo htmlspecialchars($dest) ?>"></br>
    <div>Sujet</div>
    <input type="text" name="subject"></br>
    <div>Contenu</div>
    <input type="text" name="content" size="50"></br>
    <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">
    <input type="submit" value="Reply">
</form>

<form action="reception.php" method="post">
    <input type="submit" value="Go back">
</form>

<form action="welcome.php" method="post">
    <input type="submit" value="Home">
</form>

</body>