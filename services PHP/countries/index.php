<?php
require_once "../helper/Database.php";
//header("Content-Type: application/json");
$conn = (new Database())->getConnection();

$xml = simplexml_load_file('../meniny.xml');


if(isset($_GET["id"]) || isset($_GET["_rest"])){
    $id = isset($_GET["id"]) ? $_GET["id"] : $_GET["_rest"];

    $sth = $conn->prepare("SELECT * FROM countries WHERE id = :id");
    $sth->bindParam("id", $id);
    $sth->execute();
    $result = $sth->fetch();
    print_r($result);
} else {
    $sth = $conn->prepare("SELECT * FROM countries");
    $sth->execute();
    $result = $sth->fetchAll();


}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Zadanie6PHP</title>
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
    <h1>Zadanie 6 PHP</h1>
</header>

<div class="container">

<form action="index.php" method="post">
    <div>
    <div class="form-group">
        <label for="day">Day</label>
        <input type="number" name="day" id="day">
    </div>
    <div class="form-group">
        <label for="month">Month</label>
        <input type="number" name="month" id="month">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>


    <?php
    if(isset($_POST["day"]) && isset($_POST["month"])){
        $setedDay = $_POST["day"];
        $month = $_POST["month"];
        if(!isset($setedDay[1])){
            $setedDay = "0".$setedDay;
        }
        if(!isset($month[1])){
            $month = "0".$month;
        }

        foreach ($xml->zaznam as $day) {
            if($day->den == $month.$setedDay){
                if($day->SK){
                    echo "<h3>SK: ".$day->SK."</h3>";
                } else {
                    if($day->HU){
                        echo "<h3>HU: ".$day->HU."</h3>";
                    }
                    if($day->PL){
                        echo "<h3>PL: ".$day->PL."</h3>";
                    }
                    if($day->AT){
                        echo "<h3>AT: ".$day->AT."</h3>";
                    }
                    if($day->CZ){
                        echo "<h3>CZ: ".$day->CZ."</h3>";
                    }
                }
            }

        }
//        $stmDay = $conn->prepare("select id from meniny.days where day = $day and month = $month");
//        $stmDay->execute();
//        $dayId = $stmDay->fetchColumn();
//
//        $stmSK = $conn->prepare("select id from meniny.countries where title = 'Slovensko'");
//        $stmSK->execute();
//        $SkId = $stmSK->fetchColumn();
//
//        $stmNames = $conn->prepare("select distinct value from meniny.records where day_id = $dayId and country_id = $SkId");
//        $stmNames->execute();
//        $names = $stmNames->fetchAll();
//        if(!empty($names)){
//            echo "<h1>SK names: </h1>";
//            foreach ($names as $name){
//                echo "<h3>".$name["value"]."</h3>";
//            }
//        } else {
//            $stmN = $conn->prepare("select distinct value from meniny.records where day_id = $dayId");
//            $stmN->execute();
//            $names = $stmN->fetchAll();
//            echo "<h1>Another names: </h1>";
//            foreach ($names as $name){
//                echo "<h3>".$name["value"]."</h3>";
//            }
//        }

    }
    if (isset($_GET["day"]) && isset($_GET["month"])){
        $setedDay = $_GET["day"];
        $month = $_GET["month"];
        if(!isset($setedDay[1])){
            $setedDay = "0".$setedDay;
        }
        if(!isset($month[1])){
            $month = "0".$month;
        }

        foreach ($xml->zaznam as $day) {
            if($day->den == $month.$setedDay){
                if($day->SK){
                    echo "<h3>SK: ".$day->SK."</h3>";
                } else {
                    if($day->HU){
                        echo "<h3>HU: ".$day->HU."</h3>";
                    }
                    if($day->PL){
                        echo "<h3>PL: ".$day->PL."</h3>";
                    }
                    if($day->AT){
                        echo "<h3>AT: ".$day->AT."</h3>";
                    }
                    if($day->CZ){
                        echo "<h3>CZ: ".$day->CZ."</h3>";
                    }
                }
            }

        }
//        $day = $_GET["day"];
//        $month = $_GET["month"];
//        $stmDay = $conn->prepare("select id from meniny.days where day = $day and month = $month");
//        $stmDay->execute();
//        $dayId = $stmDay->fetchColumn();
//
//        $stmSK = $conn->prepare("select id from meniny.countries where title = 'Slovensko'");
//        $stmSK->execute();
//        $SkId = $stmSK->fetchColumn();
//
//        $stmNames = $conn->prepare("select distinct value from meniny.records where day_id = $dayId and country_id = $SkId");
//        $stmNames->execute();
//        $names = $stmNames->fetchAll();
//        if(!empty($names)){
//            echo "<h1>SK names: </h1>";
//            foreach ($names as $name){
//                echo "<h3>".$name["value"]."</h3>";
//            }
//        } else {
//            $stmN = $conn->prepare("select distinct value from meniny.records where day_id = $dayId");
//            $stmN->execute();
//            $names = $stmN->fetchAll();
//            echo "<h1>Another names: </h1>";
//            foreach ($names as $name){
//                echo "<h3>".$name["value"]."</h3>";
//            }
//        }

    }
    ?>
    </div>
</form>
    <hr>
<form action="index.php" method="post">
    <div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
    </div>
    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" name="country" placeholder="Enter type is CZ,SK,HU,AT" id="country">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

    <?php
    if(isset($_POST["name"]) && isset($_POST["country"])){
        $name = $_POST["name"];
        $country = $_POST["country"];

        if (empty($name)){
            echo "<h3>Name or country is not correct</h3>";
        } else {
            foreach ($xml->zaznam as $day) {
                if($day->$country == $name || str_contains($day->$country, $name)){
                    echo "<h3>".$day->den."</h3>";
                }

            }
        }

//        $name = $_POST["name"];
//        $country = $_POST["country"];
//        $stmCountry = $conn->prepare("select id from meniny.countries where title = '$country'");
//        $stmCountry->execute();
//        $CountryId = $stmCountry->fetchColumn();
//
//        $stmDay = $conn->prepare("select day_id from meniny.records where value = '$name' and country_id = $CountryId");
//        $stmDay->execute();
//        $dayId = $stmDay->fetchColumn();
//
//        $stmNames = $conn->prepare("select distinct day, month from meniny.days where id = $dayId");
//        $stmNames->execute();в
//        $names = $stmNames->fetchAll();
//        if(!empty($names)){
//            echo "<h1>SK names: </h1>";
//            foreach ($names as $n){
//                echo "<h3>".$name."'s Birth Day: ".$n["day"]." Month: ".$n["month"]."</h3>";
//            }
//        } else {
//            echo "<h1>Not Found: </h1>";
//            echo "<h6>Enter correct data </h6>";
//        }
    }

    if(isset($_GET["name"]) && isset($_GET["country"])){

        $name = $_GET["name"];
        $country = $_GET["country"];

        if (empty($name)){
            echo "<h3>Name or country is not correct</h3>";
        } else {
            foreach ($xml->zaznam as $day) {
                if($day->$country == $name || str_contains($day->$country, $name)){
                    echo "<h3>".$day->den."</h3>";
                }

            }
        }
//        $name = $_GET["name"];
//        $country = $_GET["country"];
//        $stmCountry = $conn->prepare("select id from meniny.countries where title = '$country'");
//        $stmCountry->execute();
//        $CountryId = $stmCountry->fetchColumn();
//
//        $stmDay = $conn->prepare("select day_id from meniny.records where value = '$name' and country_id = $CountryId");
//        $stmDay->execute();
//        $dayId = $stmDay->fetchColumn();
//
//        $stmNames = $conn->prepare("select distinct day, month from meniny.days where id = $dayId");
//        $stmNames->execute();
//        $names = $stmNames->fetchAll();
//        if(!empty($names)){
//            echo "<h1>SK names: </h1>";
//            foreach ($names as $n){
//                echo "<h3>".$name."'s Birth Day: ".$n["day"]." Month: ".$n["month"]."</h3>";
//            }
//        } else {
//            echo "<h1>Not Found: </h1>";
//            echo "<h6>Enter correct data </h6>";
//        }
    }
    ?>
    </div>

</form>
    <hr>

<form action="sk.php" method="post">
    <div>
    <?php
        if(isset($_GET["SKsviatky"])){
            foreach ($xml->zaznam as $z){
                if(isset($z->SKsviatky)){
                    echo "<h3>Date and celebrations SK: ".$z->den." ".$z->SKsviatky."</h3>";
                }
            }
        }
    ?>
    <button type="submit" class="btn btn-primary">Get All Slovak Celebration</button>
    </div>
</form>
    <hr>

<form action="cz.php" method="post">
    <div>
    <?php
    if(isset($_GET["CZsviatky"])){
        foreach ($xml->zaznam as $z){
            if(isset($z->CZsviatky)){
                echo "<h3>Date and celebrations CZ: ".$z->den." ".$z->CZsviatky."</h3>";
            }
        }
    }
    ?>
    <button type="submit" class="btn btn-primary">Get All Cech Celebration</button>
    </div>
</form>
    <hr>
<form action="dni.php" method="post">

    <div>
    <?php
    if(isset($_GET["SKdni"])){
        foreach ($xml->zaznam as $z){
            if(isset($z->SKdni)){
                echo "<h3>Date and days SK: ".$z->den." ".$z->SKdni."</h3>";
            }
        }
    }
    ?>
    <button type="submit" class="btn btn-primary">Get All SK Days</button>
    </div>
</form>

    <hr>

<form action="index.php" method="post">
    <div>
        <div class="form-group">
            <label for="day2">Day</label>
            <input type="number" name="day2" id="day2">
        </div>
        <div class="form-group">
            <label for="month2">Month</label>
            <input type="number" name="month2" id="month2">
        </div>
        <div class="form-group">
            <label for="name2">Name</label>
            <input type="text" name="name2" id="name2">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    <?php
    if(isset($_POST["day2"]) && isset($_POST["month2"]) && isset($_POST["name2"])){
        $setedDay = $_POST["day2"];
        $month = $_POST["month2"];
        $name = $_POST["name2"];
        if(!isset($setedDay[1])){
            $setedDay = "0".$setedDay;
        }
        if(!isset($month[1])){
            $month = "0".$month;
        }

        foreach ($xml->zaznam as $day) {
            if($day->den == $month.$setedDay){
                if($day->SKd){
                    $day->SKd = $day->SKd.", ".$name;
                    $xml->asXML('../meniny.xml');
                } else {
                    $day->SKd = $name;
                    $xml->asXML('../meniny.xml');
                }
            }
        }
        file_put_contents("../meniny.xml", $xml->saveXML());
//        $stmDay = $conn->prepare("select id from meniny.days where day = $day and month = $month");
//        $stmDay->execute();
//        $dayId = $stmDay->fetchColumn();
//
//        $stmSK = $conn->prepare("select id from meniny.countries where title = 'Slovensko'");
//        $stmSK->execute();
//        $SkId = $stmSK->fetchColumn();
//
//        $stmNames = $conn->prepare("select distinct value from meniny.records where day_id = $dayId and country_id = $SkId");
//        $stmNames->execute();
//        $names = $stmNames->fetchAll();
//        if(!empty($names)){
//            echo "<h1>SK names: </h1>";
//            foreach ($names as $name){
//                echo "<h3>".$name["value"]."</h3>";
//            }
//        } else {
//            $stmN = $conn->prepare("select distinct value from meniny.records where day_id = $dayId");
//            $stmN->execute();
//            $names = $stmN->fetchAll();
//            echo "<h1>Another names: </h1>";
//            foreach ($names as $name){
//                echo "<h3>".$name["value"]."</h3>";
//            }
//        }
    }
    if (isset($_GET["day2"]) && isset($_GET["month2"]) && isset($_GET["name2"])){
        $setedDay = $_GET["day2"];
        $month = $_GET["month2"];
        $name = $_GET["name2"];
        if(!isset($setedDay[1])){
            $setedDay = "0".$setedDay;
        }
        if(!isset($month[1])){
            $month = "0".$month;
        }

        foreach ($xml->zaznam as $day) {
            if($day->den == $month.$setedDay){
                if($day->SKd){
                    $day->SKd = $day->SKd.", ".$name;
                    $xml->asXML('../meniny.xml');
                } else {
                    $day->SKd = $name;
                    $xml->asXML('../meniny.xml');
                }
            }
        }
        file_put_contents("../meniny.xml", $xml->saveXML());
//        $day = $_GET["day"];
//        $month = $_GET["month"];
//        $stmDay = $conn->prepare("select id from meniny.days where day = $day and month = $month");
//        $stmDay->execute();
//        $dayId = $stmDay->fetchColumn();
//
//        $stmSK = $conn->prepare("select id from meniny.countries where title = 'Slovensko'");
//        $stmSK->execute();
//        $SkId = $stmSK->fetchColumn();
//
//        $stmNames = $conn->prepare("select distinct value from meniny.records where day_id = $dayId and country_id = $SkId");
//        $stmNames->execute();
//        $names = $stmNames->fetchAll();
//        if(!empty($names)){
//            echo "<h1>SK names: </h1>";
//            foreach ($names as $name){
//                echo "<h3>".$name["value"]."</h3>";
//            }
//        } else {
//            $stmN = $conn->prepare("select distinct value from meniny.records where day_id = $dayId");
//            $stmN->execute();
//            $names = $stmN->fetchAll();
//            echo "<h1>Another names: </h1>";
//            foreach ($names as $name){
//                echo "<h3>".$name["value"]."</h3>";
//            }
//        }

    }
    ?>
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


