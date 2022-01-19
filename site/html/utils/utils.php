<?php

    // Source: https://www.phptutorial.net/php-tutorial/php-csrf/
    function generate_csrf(){
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    }

    function verify_csrf(){
        $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
        if (!$token || $token !== $_SESSION['token']) {
            // return 405 http status code
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            echo "Wrong CSRF token" . $_SESSION['token'];
            exit;
        }
    }

