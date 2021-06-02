<!doctype html>
<html lang="en">
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

<div class="container">

<?php
session_start();
require_once "../classic/classes/controllers/UserController.php";
require_once "../classic/classes/helper/Database.php";
require_once "../classic/classes/User.php";
$type = "GOOGLE";
$userController = new UserController();
$username = "";
$email = "";
$password = "";
define('MYDIR','../');
require_once(MYDIR."vendor/autoload.php");

$redirect_uri = 'https://wt168.fei.stuba.sk/zadanie3gangsta/oauth2/';

$client = new Google_Client();
$client->setAuthConfig('../configs/credentials.json');
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
      
$service = new Google_Service_Oauth2($client);

if(isset($_GET['code'])){
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token);
  $_SESSION['upload_token'] = $token;

  // redirect back to the example
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));

}

//foreach ($_SESSION as $s){
//    //$s['id_token'];
//    var_dump($s);
//
//}


// set the access token as part of the client
if (!empty($_SESSION['upload_token'])) {
  $client->setAccessToken($_SESSION['upload_token']);
  if ($client->isAccessTokenExpired()) {
    unset($_SESSION['upload_token']);
  }
} else {
  $authUrl = $client->createAuthUrl();
}

if ($client->getAccessToken()) {
    //Get user profile data from google
    $UserProfile = $service->userinfo->get();
    $username = $UserProfile['given_name'].' '.$UserProfile['family_name'];
   // var_dump($client->getAccessToken());
    if(!empty($UserProfile)){
        $output = '<h1>Profile Details </h1>';
        $output .= '<img src="'.$UserProfile['picture'].'">';
        $output .= '<br/>Google ID : ' . $UserProfile['id'];
        $output .= '<br/>Name : ' . $UserProfile['given_name'].' '.$UserProfile['family_name'];
        $output .= '<br/>Email : ' . $UserProfile['email'];
        $output .= '<br/>Locale : ' . $UserProfile['locale'];
        $output .= '<br/><br/>Logout from <a href="logout.php">Google</a>';
        $username = $UserProfile['given_name'].' '.$UserProfile['family_name'];
        $email = $UserProfile['email'];
        $google_id = $UserProfile['id'];

        if(!($userController->getUser($email))){
            $us = new User();
            $us->setName($username);
            $us->setEmail($email);
            $id =  $userController->insertUser($us);
            $userController->insertAccount($id, $type, "");
            $userController->insertGoogleId($google_id, $id);
        } else{
            $checkId = $userController->getUser($email);
            $id = end($checkId)->getId();
            $token = sha1(mt_rand());
            $userController->insertAccess($id, $username, $type, $token, date("d.m.Y h:i:s"));
        }
        $username = $UserProfile['given_name'].' '.$UserProfile['family_name'];



    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }   
  } else {
      $authUrl = $client->createAuthUrl();
      $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
  }
// echo "<a href='dopInfo.php'><button type='button' class='btn btn-primary'>Last Accesses</button></a>";
?>

<div><?php echo $output;?></div>
    <br><br><br>


    <h2>User Access History</h2>
    <table class="table" id="table2">
        <thead>
        <tr>
            <th scope="col">User Login</th>
            <th scope="col">Access type</th>
            <th scope="col">Access time</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //var_dump($_SESSION);
        $userController = new UserController();
        $user = $userController->showHistory($username);
        foreach ($user as $u){
            echo "<tr>".$u->getAccessInfo()."</tr>";
        }
        ?>
        </tbody>
    </table>
    <br><br><br>
    <h2>Statistic</h2>

    <table class="table" id="table2">
        <thead>
        <tr>
            <th scope="col">Logged in By Registration</th>
            <th scope="col">Logged in By Google</th>
            <th scope="col">Logged in By LDAP</th>
        </tr>
        </thead>
        <tbody>
        <?php
            echo "<tr><td>".$userController->countRegistrationVisitors()."</td><td>".$userController->countGoogleVisitors()."</td><td>".$userController->countLDAPVisitors()."</td></tr>";
        ?>
        </tbody>
    </table>
    <br><br><br><br><br><br>



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
