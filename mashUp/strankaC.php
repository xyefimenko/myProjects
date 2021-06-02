<?php
require_once "controller/MashupController.php";
session_start();
$controller = new MashupController();
//header('Content-Type: application/json');

if($controller->getCpageStatstic()){
    $controller->inserPages(0, 0, 1);
} else {
    $controller->updateCpage();
}

function getIp() {
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $array = explode(',', $_SERVER[$key]);
            $ip = trim(end($array));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
}

$user_ip = getIp();
//echo 'ip = ' . $ip;
$ipApi = "http://ip-api.com/json/$user_ip";

$ch = curl_init($ipApi);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);

$countryData = json_decode($html);
//var_dump($countryData);

$ch2 = curl_init("https://restcountries.eu/rest/v2/name/$countryData->countryCode?fullText=true");
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch2, CURLOPT_HEADER, false);
$html2 = curl_exec($ch2);
curl_close($ch2);

$capitalData = json_decode($html2);
//var_dump($capitalData);
$capital = $capitalData[0]->capital;
$flag = $capitalData[0]->flag;



if($controller->findTime($user_ip)){
    if($_SESSION["submit"] == "ok") {
        $controller->insertUser(session_id(), $user_ip, $flag, $countryData->country, $countryData->city, date("Y-m-d H:i:s"), $countryData->lat, $countryData->lon);
    } else {
        header("Location: disclaimer.php");
    }
}


$allGps = $controller->getAllGPS();
$tempLat = $allGps[0]["lat"];
$tempLon = $allGps[0]["lon"];
$counterGPS = 0;
$zero = 0;
$newUluru = "uluru$zero";
$newMarker = "marker$zero";
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
    <script src="js/script.js"></script>
</head>
<body>

<header>
    <h1>Mashup</h1>
    <a href="index.php"><button type="submit" class="btn btn-dark">Weather</button></a>
    <a href="strankaB.php"><button type="submit" class="btn btn-dark">User Info</button></a>
    <a href="strankaC.php"><button type="submit" class="btn btn-dark">Map</button></a>
</header>

<br><br><br><br><br><br><br>

<div id="map"></div>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrdEEEhPiAOIeBUmUgxfanEVr5dotbkDk&callback=initMap&libraries=&v=weekly"
        async
></script>
<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 48.54025994565294, lng: 35.08939915698681 },
            zoom: 1,
        });

       //     const <?php //echo $newUluru?>// = {lat: <?php //echo $tempLat?>//, lng: <?php //echo $tempLon?>// };
       //     const <?php //echo $newMarker?>// = new google.maps.Marker({
       //     position: <?php //echo $newUluru?>//,
       //     map: map,
       //     title: "<?php //echo $counterGPS?>//",
       //});

                <?php
            foreach ($allGps as $gps){
                if($tempLat == $gps["lat"] && $tempLon == $gps["lon"]){
                    $counterGPS++;
                } else {
                    ?>
            const <?php echo $newUluru?> = {lat: <?php echo $tempLat?>, lng: <?php echo $tempLon?> };
            const <?php echo $newMarker?> = new google.maps.Marker({
            position: <?php echo $newUluru?>,
            map: map,
            title: "<?php echo $counterGPS?>",
        });
        <?php
                $tempLat = $gps["lat"];
                $tempLon = $gps["lon"];
                $counterGPS = 1;
                $zero = $zero+1;
                $newUluru = "uluru$zero";
                $newMarker = "marker$zero";
                }
                if($gps == end($allGps)){
                    ?>
        const <?php echo $newUluru?> = {lat: <?php echo $tempLat?>, lng: <?php echo $tempLon?> };
        const <?php echo $newMarker?> = new google.maps.Marker({
            position: <?php echo $newUluru?>,
            map: map,
            title: "<?php echo $counterGPS?>",
       });
        <?php
        $tempLat = $gps["lat"];
        $tempLon = $gps["lon"];
//        $counterGPS = 1;
        $zero = $zero+1;
        $newUluru = "uluru$zero";
        $newMarker = "marker$zero";
                }
            }
        ?>



    }
</script>

<table class="table" id="table2">
    <thead>
    <tr>
        <th scope="col">Country</th>
        <th scope="col">Flag</th>
        <th scope="col">Count</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $users = $controller->getAllUsers();
        $temp = $users[0]["country"];
        $tempFlag = $users[0]["flag"];
        $count = 0;
        foreach ($users as $user){
            if($temp == $user["country"]){
                $count++;
            } else{
                echo "<tr><td>".$temp."</td>"."<td><a href='countryInfo.php?country=".$temp."'><img src='$tempFlag' height='40px'></a>    </td>"."<td>".$count."</td></tr>";
                $count  = 1;
                $temp = $user["country"];
                $tempFlag = $user["flag"];
            }
            if($user == end($users)){
                echo "<tr><td>".$temp."</td>"."<td><a href='countryInfo.php?country=".$temp."'><img src='$tempFlag' height='40px'></a></td>"."<td>".$count."</td></tr>";
            }
        }
    ?>
    </tbody>
</table>

<br><br><br><br>


<h2>Page Statistic</h2>
<table class="table" id="table2">
    <thead>
    <tr>
        <th scope="col">Weather Page</th>
        <th scope="col">User Info Page</th>
        <th scope="col">Map page</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $statistics = $controller->getAllPagesStatistic();
    foreach ($statistics as $statistic){
        echo "<tr><td>".$statistic["page_a"]."</td><td>".$statistic["page_b"]."</td><td>".$statistic["page_c"]."</td></tr>";
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
</body>
</html>
