<?php
    require_once 'PHPGangsta/GoogleAuthenticator.php';
    $secret = 'EE3KSW3S7DDKWHRP';
 
    if (isset($_POST['code'])) {
        $code = $_POST['code'];
 
        $ga = new PHPGangsta_GoogleAuthenticator();
        $result = $ga->verifyCode($secret, $code);
 
        if ($result == 1) {
            echo $result;
        } else {
            echo 'Login failed';
        }
    }
?>