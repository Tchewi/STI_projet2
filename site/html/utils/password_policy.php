<?php

/**
 * Password policy is: 8 chars, including at least 1 uppercase, 1 lowercase, 1 digit and 1 special char
 * @param $password
 * @return false|true
 */
function checkPasswordPolicy($password){
    $policy = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#$^+=!*()@%&]).{8,}$/"; // source: old WEB lab
    return boolval(preg_match($policy, $password));
}
