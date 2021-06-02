<?php
require_once "classes/helper/Database.php";
require_once "classes/controllers/UserController.php";
require_once "classes/User.php";
$type = "PAGE";
$userController = new UserController();
 session_start();

 if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
     //TODO: chcek db is user exist
     if($userController->getUser($_POST['email'])) {
         $checkId = $userController->getUser($_POST['email']);
         $hash_password_from_db = $userController->getHasPassword(end($checkId)); //hash from db

         $hashed_password = sha1($_POST['password']);
         $hash = crypt($_POST['password'], $hashed_password);//check hash from password input

         if(!hash_equals($hash_password_from_db, $hash)){
             echo "Bad password";
             echo "<a href='login.php'><button type='button'>Come back to login page</button></a>";
             exit();
         }

         $id = end($checkId)->getId();
         $token = sha1(mt_rand());
         $userController->insertAccess($id, $_POST['username'], $type, $token, date("d.m.Y h:i:s"));
     } else {
         echo "<h1>user doesnt exist</h1><a href='../index.php'><button type='button'>Come Back</button></a>";
         exit();
     }

     $_SESSION['username'] = $_POST['username'];
     if(isset($_POST['remember'])){
        // $token = sha1(mt_rand());
         setcookie("token", $_POST['username'], time() + 3600, "/");
     }


     header("Location: index.php");
 } elseif (isset($_SESSION['username'])){
     header("Location: index.php");
 } elseif (isset($_COOKIE['username'])){
     $_SESSION['username'] = $_COOKIE['username'];
     header("Location: index.php");
 }
 
?>


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
<br><br>
<h2>Sign In</h2>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter youe email" name="email" id="email" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
        <label for="username">Name and surname</label>
        <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Enter youe name" id="username" required>
        <small id="nameHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control"  name="password" id="password" required>
    </div>

    <div class="form-group">
        <label for="remember">Remember me</label>
        <input type="checkbox" name="remember">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="login" value="login">Submit</button>
    </div>

    <div class="form-group">
        <a href="../index.php"><button type="button" class="btn btn-danger">Come Back</button></a>
    </div>

</form>


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
