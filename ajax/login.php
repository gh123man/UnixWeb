<?php
chdir('..');
include_once 'DBConnect.php';
include_once 'components/accountUtils.php';

if (isset($_GET['login']) && $_GET['login']) {

    if ($_POST['username'] == "" || $_POST['password'] == "") {
        $out = array("result" => false, "msg" => "username or password not set");
    } else {
        try {
            $username = strtolower($_POST['username']);
            loginAccount($username, $_POST['password']);
            $out = array("result" => true);
        } catch (Exception $e) {
            $out = array("result" => false, "msg" => $e->getMessage());
        }
    }


} else if (isset($_GET['register']) && $_GET['register']) {

    if (!isset($_POST['email']) || $_POST['email'] == ""){
        $out = array("result" => false, "msg" => 'email must be set');
    } else if ($_POST['password1'] != $_POST['password']) {
        $out = array("result" => false, "msg" => 'passwords must match');

    } else {
        if (Account::accountExistsEmail($_POST['email'])) {
            $out = array("result" => false, "msg" => 'Account with that email address already exists');
        } else {
            $email = strtolower($_POST['email']);
            $account = Account::createNew($email, $_POST['password'], $_POST['fname'], $_POST['lname']);
            if (isset($account) && $account != null && !is_string($account)) {
                $out = array("result" => true);
            } else {
                $out = array("result" => false, "msg" => $account);
            }

        }
    }
} else {
}

echo json_encode($out);


?>
