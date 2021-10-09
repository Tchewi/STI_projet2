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
  <title>PHP Test</title>
</head>
 
<body>
<?php echo "Yikes"; 

require '/account_class.php';






?>


</body>
</html>