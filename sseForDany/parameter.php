<?php
require_once "controllers/Controller.php";
//require_once "sse.php";
header('Content-Type: application/json');

$controller = new Controller();


if(isset($_POST)){

    session_start();
    echo session_id();
//    $y2k = mktime(0,0,0,1,1,2022);
//    setcookie("newParameter", $_POST["newParameter"],  time()+3600, "/","", 0);
//    $myfile= fopen("parameter.txt", "w") or die("U file");
    $p = json_decode(file_get_contents('php://input'), true);
//    fwrite($myfile, $p['parameter']);
    if(isset($p['parameter'])){
        $_SESSION["parameter"] = $p['parameter'];

        if($controller->findSession(session_id())){
            $controller->updateSessionNum(session_id(), $p['parameter']);
        } else {
            $controller->insertSessionData(session_id(), $p['parameter']);
        }
    }


//    fclose($myfile);
//
//
//    $_SESSION["parameter"] = $_POST["newParameter"];
//    var_dump($_SESSION);
//    echo session_id(). " ";
//    echo $_SESSION["parameter"];
//    $id = session_id();
//    $controller->insertSessionData($id, $_SESSION["parameter"]);
//
//    var_dump($_POST);
    echo json_encode(['msg' => json_encode($p)]);
//    header("Location: index.php");
}
