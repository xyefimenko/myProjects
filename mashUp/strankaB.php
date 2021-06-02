<?php
require_once "controller/MashupController.php";
session_start();
$controller = new MashupController();

if($controller->getBpageStatstic()){
    $controller->inserPages(0, 1, 0);
} else {
    $controller->updateBpage();
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

<?php
echo "<h2>User IP: ".$user_ip."</h2>";
if(isset($countryData->city)){
    echo "<h2>City: ".$countryData->city."</h2>";
} else {
    echo "<h2>City is not found</h2>";
}
echo "<h2>User lat: ".$countryData->lat.", long: ".$countryData->lon."</h2>";
echo "<h2>Country: ".$countryData->country."</h2>";
echo "<h2>Country Capital: ".$capital."</h2>";
?>

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
