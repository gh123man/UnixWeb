<?php
include_once './src/Account.php';

function loginAccount($email, $password) {
    session_start();
    $account = Account::login($email, $password);

    if ($account != false) {
        $_SESSION['userid'] = $account->ID();
    } else {
        session_destroy();
        //fail login
        error_log($e);
    }
}

function logOut() {
    session_start();
    session_destroy();
}

function checkLogin() {
    (session_id() == '' ? session_start() : false);

    error_log(isset($_SESSION['userid']));
    return isset($_SESSION['userid']);
}


?>
