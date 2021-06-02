<?php
require_once "helper/Database.php";

$xml = simplexml_load_file("meniny.xml");

$countries = [
    "SK" => ["title" => "Slovensko"],
    "CZ" => ["title" => "Ceska republika"],
    "AT" => ["title" => "Rakusko"],
    "HU" => ["title" => "Madarsko"],
    "PL" => ["title" => "Polsko"]
];


$conn = (new Database())->getConnection();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zadanie6PHP</title>
</head>
<body>

    <pre>
        <?php
        $day = "";
        $month = "";
        $stmtDays = $conn->prepare("INSERT IGNORE INTO days (day, month) VALUES (:day, :month)");
        $stmtDays->bindParam(':day', $day);
        $stmtDays->bindParam(':month', $month);

        $code = "";
        $title = "";
        $stmtCountries = $conn->prepare("INSERT IGNORE INTO countries (code, title) VALUES (:code, :title)");
        $stmtCountries->bindParam(':code', $code);
        $stmtCountries->bindParam(':title', $title);

        $day_id = "";
        $country_id = "";
        $value = "";
        $type = "";
        $stmtRecords = $conn->prepare("INSERT IGNORE INTO records (day_id, country_id, value, type) VALUES (:day_id, :country_id, :value, :type)");
        $stmtRecords->bindParam(':day_id', $day_id);
        $stmtRecords->bindParam(':country_id', $country_id);
        $stmtRecords->bindParam(':value', $value);
        $stmtRecords->bindParam(':type', $type);

        foreach ($xml->children() as $row){
            $day = substr($row->den, 2, 2);
            $month = substr($row->den, 0, 2);
            $stmtDays->execute();

            $d = $conn->prepare("SELECT id FROM days WHERE day=$day and month=$month");
            $d->execute();
            $day_id = $d->fetchColumn();

            foreach (array_keys( ((array) $row)) as $item){
                if(array_key_exists($item, $countries)){
                    if(!isset($countries[$item]["id"])){
                        $code = $item;
                        $title = $countries[$item]["title"];
                        $stmtCountries->execute();

                        $c = $conn->prepare("SELECT id FROM countries WHERE code='$code' ");
                        $c->execute();
                        $country_id = $c->fetchColumn();
                        $countries[$item]["id"] = $country_id;
                    }

                    $type = "name";
                    $country_id = $countries[$item]["id"];
                    foreach (explode(",", $row->$item) as $name){
                        $value = trim($name);
                        $stmtRecords->execute();
                    }
                }
            }

//            $country_id = $countries["SK"]["id"];
            if($row->SKd){
                foreach (explode(",", $row->SKd) as $name){
                    $value = trim($name);
                    $stmtRecords->execute();
                }
            }

        }

        ?>
    </pre>


</body>
</html>
