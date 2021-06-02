<?php

session_start();


if (isset($_POST['logout'])){
    session_destroy();
    setcookie("token", "", time() - 3600, "/");
    header("Location: login.php");
} elseif (isset($_COOKIE['token'])){
    //TODO: get user info from db by token
    //$user =  (object) ["username" => "denys"]; - toto je vytiahnute s databazy
    //$_SESSION['username'] = $user->username;


    $_SESSION['username'] = $_COOKIE['token'];
    //ulozim do databazy (prepaja sa v "access" podla account_id)
} elseif (!isset($_SESSION['username'])){
    header("Location: login.php");
}

?>


<header>
    <nav>


    </nav>

    <span>
        Welcome: <?php echo $_SESSION['username'] ?>
    </span>
</header>
