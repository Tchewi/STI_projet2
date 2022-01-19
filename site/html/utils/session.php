

<?php
if (isset($_GET['error'])) {?>
    <div class="notification">
        <?php echo $_GET['error']; ?>
    </div>
<?php
}

function startSession(){
    session_set_cookie_params(10000, null, null, false, true); // we do not have HTTPS server so we don't set Secure option
    session_start();
}

function checkValid(){
    if ($_SESSION["valid"] != 1) {
        session_unset();
        session_destroy();
        http_redirect("login.php");
        exit;
    }
}

function checkAdmin(){
    checkValid();
    if ($_SESSION["admin"] != 1) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}

?>
