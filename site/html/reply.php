<?php
session_start();
if ($_SESSION["valid"] != 1) {
    session_unset();
    session_destroy();
    header("Location: login.php");
}

$dest = $_POST['dest'];
require_once "utils/utils.php";
generate_csrf();
?>

<html>
<head>
    <title>Read message</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<h1>Reply to <?php echo htmlspecialchars($dest) ?></h1>

<?php
if (isset($_GET['error'])) {
    echo htmlspecialchars($_GET['error']);
}
?>

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