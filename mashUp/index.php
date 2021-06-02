<?php
ini_set('memory_limit', '1024M');
session_start();
require_once "controller/MashupController.php";
session_start();
$controller = new MashupController();



if($controller->getApageStatstic()){
    $controller->inserPages(1, 0, 0);
} else {
    $controller->updateApage();
}

$json = file_get_contents('city.list.json');

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


//Decode JSON
$json_data = json_decode($json,true);
$cityId = "";
//Traverse array and get the data for students aged less than 20
foreach ($json_data as $key1 => $value1) {
    if($json_data[$key1]["name"] == $countryData->city){
        $cityId = $json_data[$key1]["id"];
    } else {
        similar_text($json_data[$key1]["name"], $countryData->regionName, $per);
        if($per > 85){
            $cityId = $json_data[$key1]["id"];
        }
    }
}


$apiKey = "44cf217b3cdf2a5f49feab155b86bb62";

$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;
//$googleApiUrl = "api.openweathermap.org/data/2.5/forecast?q=709929&appid=" . $apiKey;
//$googleApiUrl = "https://pro.openweathermap.org/data/2.5/forecast/climate?q=London&appid=".$apiKey;


$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
//var_dump($data);
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

    <div class="report-container">
        <h2><?php echo $data->name; ?> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img
                    src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                    class="weather-icon" /> <?php echo $data->main->temp_max; ?>°C<span
                    class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
            <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
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
