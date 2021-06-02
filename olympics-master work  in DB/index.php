<?php
require_once "classes/controllers/PersonController.php";

$personController = new PersonController();
$people = $personController->getAllPeople();
//$per = $personController->getPerson();

?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zadanie2PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/style.css">

    <script rel="script" src="js/jvaScript.js"></script>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/jquery.min.js"></script>
    <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="js/fileinput.min.js" rel="script"></script>
</head>
<body>

<header>
    <h1>Zadanie 2 PHP</h1>
</header>

<pre>
    <?php
    foreach ($people as $p){
       //var_dump($p);
//        $goldCount = $p->getGoldCount();
//        echo $goldCount ." ";
    }
    ?>
</pre>
<div class="container">

    <table class="table">
        <thead>
        <tr>

            <th scope="col">Name & Surname</th>
            <th scope="col">Year</th>
            <th scope="col">City</th>
            <th scope="col">Country</th>
            <th scope="col">Type</th>
            <th scope="col">Discipline</th>
            <th scope="col">Edit Mode</th>
            <th scope="col">Delete mod</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($people as $person) {
            //for ($i = 0; $i < count($person))
           // echo "<tr><td>".$person->getFullname()."</td>";//<td><a href='editPerson.php?id=".$person->getId()."'>edit</a></td>
            echo $person->getPlacements();
        }
        ?>
        </tbody>
    </table>
    <br>
    <h2>Top 10 Best Olympic Players</h2>
    <table class="table" id="table2">
        <thead>
        <tr>
            <th scope="col">Name & Surname</th>
            <th scope="col">Num of 1st placing</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $ten = 10;
        foreach ($people as $person) {
            if ($ten == 0){
                break;
            }
            echo "<tr><td><a href='PersonInfo.php?id=".$person->getId()."'>".$person->getFullName()."</a></td><td>".$person->getGoldCount()."</td><td><a href='editPerson.php?id=".$person->getId()."'>EDIT</a></td><td><a href='deletePerson.php?id=".$person->getId()."'>DELETE</a></td></tr>";
            $ten = $ten - 1;
        }
        ?>
        </tbody>
    </table>
    <a href="createPerson.php"><h3>Tap to add Olympic Player</h3></a>
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
