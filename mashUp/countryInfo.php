<?php
require_once "controller/MashupController.php";
$controller = new MashupController();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zadanie7PHP</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<header>
    <h1>Mashup</h1>
    <a href="index.php"><button type="submit" class="btn btn-dark">Weather</button></a>
    <a href="strankaB.php"><button type="submit" class="btn btn-dark">User Info</button></a>
    <a href="strankaC.php"><button type="submit" class="btn btn-dark">Map</button></a>
</header>

<br><br><br><br><br><br><br>

<table class="table" id="table2">
    <thead>
    <tr>
        <th scope="col">City</th>
        <th scope="col">Count</th>
        <th scope="col">Not Found Places</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $countries = $controller->getCountryInfo($_GET["country"]);
        $temp = $countries[0]["city"];
        $count = 0;
        $notFoundPlaces = 0;
        foreach ($countries as $country){
            if($temp == $country["city"]){
                $count++;
            } else{
                echo "<tr><td>".$temp."</td><td>".$count."</td><td>".$notFoundPlaces."</td></tr>";
                $temp = $country["city"];
                $count = 1;
            }
            if($country == end($countries)){
                echo "<tr><td>".$temp."</td><td>".$count."</td><td>".$notFoundPlaces."</td></tr>";
            }
        }
    ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<br><br><br><br>
<footer>
    @Created by Denys Yefimenko
</footer>
