<?php
    require_once "index.php";
    require_once "classes/controllers/UserController.php";
    require_once "classes/helper/Database.php";
    require_once "classes/User.php";


    $username = $_SESSION['username'];

    $userController = new UserController();
    $user = $userController->showHistory($username);


?>
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

<br><br><br><br><br><br><br><br><br>
