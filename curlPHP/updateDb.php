<?php

header('Content-Type: application/json');
require_once "classes/helper/Database.php";


//TODO here i download lectures links from GitHub
//$page = curl_init("https://github.com/xyefimenko/webTe");
$page = curl_init("https://github.com/apps4webte/curldata2021");
//curl_setopt($page, CURLOPT_UPLOAD, true);
//curl_setopt($page, CURLOPT_HEADER, true);
curl_setopt($page, CURLOPT_RETURNTRANSFER   , true);
//curl_setopt($page, CURLOPT_RETURNTRANSFER, true);
    $outPage = curl_exec($page);
//$outPage = mb_convert_encoding($outPage, 'UTF-8', "UTF-16LE");
curl_close($page);
//var_dump($outPage);

$l = explode(PHP_EOL, $outPage);
//echo $l;
$linkArray ='';
foreach ($l as $index => $line) {

    //inset row
    if ($index > 0 && $index < (sizeof($l) - 1)) {
        $lineArray = str_getcsv($line, "\t");
//        if(str_contains($lineArray[0], "/xyefimenko/webTe/blob/master/20")){
        if(str_contains($lineArray[0], "/apps4webte/curldata2021/blob/main/20")){
            $linkArray = $linkArray.$lineArray[0];
        }
//        var_dump($lineArray);
    }
}
//var_dump($linkArray);
$expl = explode("/apps4webte/curldata2021/blob/main/", $linkArray);
$links = array();
$count = 0;
//var_dump($expl);
foreach ($expl as $e){
    if (!($count == 0)){
        $expl2 = explode(".csv", $e);
//        var_dump($expl2[0]);
//    echo "=================================";
//    $gl = "https://raw.githubusercontent.com/xyefimenko/webTe/master/".$expl2[0].".csv";
    $gl = "https://raw.githubusercontent.com/apps4webte/curldata2021/main/".$expl2[0].".csv";
    $links []= $gl;
    }
    $count++;
}

var_dump($links);
$lectureDates = array();
$conn = (new Database())->getConnection();

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $count2 = 0;
    $count3 = 0;
    foreach ($links as $l){
        $timestampForLecture = $l;
        $first = explode("main/", $timestampForLecture);
//        var_dump($first);
        foreach ($first as $f){
            if(!($count2 == 0)){
                $second = explode("_Att", $f);
                if(strlen($second[0]) == 8){
                    $time = $second[0]."095500";
                    $lectureDates[] = $time;
                    $stmtInsertLecture = $conn->prepare("INSERT IGNORE INTO lectures (timestamp) VALUES (:timestamp);");
                    $stmtInsertLecture->bindParam(":timestamp", $time);
                    $stmtInsertLecture->execute();
                }
            }
            $count2++;
        }
    }
$stmtDel = $conn->prepare("TRUNCATE TABLE `user_actions`;   ");
$stmtDel->execute();
$timeIndex = 0;
foreach ($links as $singleCsv) {
    //TODO parsing every single csv file
    $ch = curl_init($singleCsv);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //output contains the output string
    $output = curl_exec($ch);
    //close curl resource to free system res
    curl_close($ch);

    $output = mb_convert_encoding($output, 'UTF-8', "UTF-16LE");

    $lines = explode(PHP_EOL, $output);

    $sql = "SELECT id from lectures where timestamp = '$lectureDates[$timeIndex]'";
    $result2 = $conn->query($sql);
    $lectureId = $result2->fetchColumn();
    echo $lectureId."====";


    $stmt = $conn->prepare("INSERT INTO user_actions (lecture_id, user_id, action, timestamp)
     VALUES (:lectureId, :user_id, :action, :timestamp);");

    $stmt2 = $conn->prepare("INSERT IGNORE INTO users (name) VALUES (:name);");

    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":lectureId", $lectureId);
    $stmt->bindParam(":action", $action);
    $stmt->bindParam(":timestamp", $timestamp);
    $stmt2->bindParam(":name", $name);
    $timeIndex++;

    foreach ($lines as $index => $line) {

        //inset row
        if ($index > 0 && $index < (sizeof($lines) - 1)) {
            $lineArray = str_getcsv($line, "\t");

            $name = $lineArray[0];
            $stmt2->execute();


            $sql = "SELECT * from users where name = '$lineArray[0]'";
            $result = $conn->query($sql);

            $userId = $result->fetchColumn();
//            echo "$userId";
            $action = $lineArray[1];
//            if(str_contains($lineArray[2], "AM")){
//                $deleteAm = explode($linkArray[2], " A");
//                var_dump($deleteAm);
//                exit();
//            }
            if(str_contains($lineArray[2], "AM")){
//                echo $linkArray[1]->getTimestamp();
                continue;
            }
//             echo date_create_from_format('d/m/Y, H:i:s', $lineArray[2])->getTimestamp()." ";
            $timestamp = date("Y-m-d H:i:s", date_create_from_format('d/m/Y, H:i:s', $lineArray[2])->getTimestamp());
            $stmt->execute();

        }

    }

    echo json_encode(["status" => "success", "msg" => "Added" . sizeof($lines) . "lines"]);

}

?>

