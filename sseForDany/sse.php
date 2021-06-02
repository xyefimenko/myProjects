<?php
require_once "controllers/Controller.php";

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$controller = new Controller();
session_start();
$id = session_id();
//echo session_id();
//$mySession = ;
//var_dump($_SESSION);
//var_dump($_POST);
//var_dump($_GET);
//var_dump($mySession);
session_destroy();

$type = $controller->getSessionType($id);
$index = 0;



while (1) {

    $sin = sin($index);
    $cos = cos($index);

    if(isset($controller->getSession($id)['num'])){
        $param = $controller->getSession($id)['num'];
    } else {
        $param = 1;
    }


    switch ($type){
        case "All":
            sendSse($index, json_encode(["y1" => (sin($index*$param))*(sin($index*$param)), "y2" => (cos($index*$param))*(cos($index*$param)), "y3" => (sin($index*$param))*(cos($index*$param)), "parameter" => $param]));
            break;
        case "Y1":
            sendSse($index, json_encode(["y1" => (sin($index*$param))*(sin($index*$param)), "parameter" => $param]));
            break;
        case "Y2":
            sendSse($index, json_encode(["y2" => (cos($index*$param))*(cos($index*$param)), "parameter" => $param]));
            break;
        case "Y3":
            sendSse($index, json_encode(["y3" => (sin($index*$param))*(cos($index*$param)), "parameter" => $param]));
            break;
    }




//    var_dump($_SESSION);


    $index++;
    ob_flush();
    flush();
    sleep(1);
}
function sendSse($id,$data){
    echo "id: $id\n";
    echo "x: $id\n";
//    echo "data: {\n";
//    echo "data: \"x\": \"{$id}\", \n";
//    echo "data: \"y1\": \"{$sin}\",   \n";
//    echo "data: \"y2\": \"{$cos}\", \n";
//    echo "data: \"y3\": \"{$par}\" \n";
//    echo "data: }\n\n";
////    echo $data;
        echo "event: webteEvent\n";
        echo "data: $data\n\n";
}

