<?php
require_once "../classic/classes/controllers/UserController.php";
require_once "../classic/classes/helper/Database.php";
require_once "../classic/classes/User.php";
require_once "../classic/classes/Access.php";
$type = "LDAP";
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['username']."@stuba.sk";
    $userController = new UserController();


    $ldapconfig['host'] = 'ldap.stuba.sk';//CHANGE THIS TO THE CORRECT LDAP SERVER
    $ldapconfig['port'] = '389';
    $ldapconfig['basedn'] = 'ou=People, DC=stuba, DC=sk';//CHANGE THIS TO THE CORRECT BASE DN
    $ldapconfig['usersdn'] = 'cn=users';//CHANGE THIS TO THE CORRECT USER OU/CN
    $ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']);

    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
    ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);

    $dn = "uid=".$username.",".$ldapconfig['basedn'];
    if (isset($_POST['username'])) {
        if ($bind = ldap_bind($ds, $dn, $password)) {
            echo("Login correct");//REPLACE THIS WITH THE CORRECT FUNCTION LIKE A REDIRECT;
            $sr = ldap_search($ds, 'ou=People, DC=stuba, DC=sk', 'uid='.$username, ['givenname', 'surname', 'mail']);
            //var_dump(ldap_get_entries($ds, $sr));
            if(!($userController->getUser($email))) {
                $us = new User();
                $us->setName($_POST['username']);
                $us->setEmail($email);
                $hashed_password = sha1($_POST['password']);
                $hash = crypt($_POST['password'], $hashed_password);
                $id = $userController->insertUser($us);
                $userController->insertAccount($id, $type, $hash);
                $token = sha1(mt_rand());
                $userController->insertAccess($id, $_POST['username'], $type, $token, date("d.m.Y h:i:s"));


            } else {
              //  header("Location: ../classic/index.php");
                $checkId = $userController->getUser($email);
                $id = end($checkId)->getId();
                $token = sha1(mt_rand());
                $userController->insertAccess($id, $_POST['username'], $type, $token, date("d.m.Y h:i:s"));
            }
            if(isset($_POST['username']) && isset($_POST['password'])){
                //TODO: chcek db is user exist

                $_SESSION['username'] = $_POST['username'];
                if(isset($_POST['remember'])){
                    // $token = sha1(mt_rand());
                    setcookie("token", $_POST['username'], time() + 3600, "/");
                }

                setcookie("token", $_POST['username'], time() + 3600, "/");
                header("Location: ../classic/index.php");
            } elseif (isset($_SESSION['username'])){
                header("Location: ../classic/index.php");
            } elseif (isset($_COOKIE['username'])){
                $_SESSION['username'] = $_COOKIE['username'];
                header("Location: ../classic/index.php");
            }

        } else {
            echo "Login Failed: Please check your username or password";
        }
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Zadanie3PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/style.css">

    <script rel="script" src="js/jvaScript.js"></script>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/jquery.min.js"></script>
    <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="js/fileinput.min.js" rel="script"></script>
</head>
<body>

<header>
    <h1>Zadanie 3 PHP</h1>
</header>
<br><br><br><br>
<h2>Sign In</h2>

<div>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

        <div class="form-group">
            <label for="username">Name and surname</label>
            <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" placeholder="Enter youe name" name="username">
            <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>


        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
        </div>

<!--        <input type="submit" value="Submit">-->

        <br>
        <div class="form-group">
            <a href="../index.php"><button type="button" class="btn btn-primary">Come Back</button></a>
        </div>

    </form>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<br><br><br><br>
<footer>
    @Created by Denys Yefimenko
</footer>
</body>
</html>

