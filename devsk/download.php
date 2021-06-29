<?php
require_once "/home/xyefimenko/public_html/devsk/classes/controllers/Controller.php";
header("Content-Type: application/json");


$controller = new Controller();
$allBooks = $controller->getAllBooks();

//$filename = 'data.json';
//if (file_exists($filename)) {
//    $file = file_get_contents('data.json');
//} else {
//    $file = fopen("data.json", "a+");
//}
//
//file_put_contents('data.json', json_encode($allBooks));
//$file = file_get_contents('data.json');
//echo $file;

$jsonData = json_encode($allBooks);
file_put_contents('data.json', $jsonData);

if (file_exists("data.json")) {
    // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
    // если этого не сделать файл будет читаться в память полностью!
    if (ob_get_level()) {
        ob_end_clean();
    }
    // заставляем браузер показать окно сохранения файла
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename("data.json"));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize("data.json"));
    // читаем файл и отправляем его пользователю
    readfile("data.json");
    exit;
}
