<?php
session_start();

var_dump($_FILES);
//echo "============================";

$address_site = "http://147.175.98.168/dendo228_z1/";



    // Добавляем в сессию сообщение об ошибке.
   // $_SESSION["server_messages"] = "<p class='text-danger font-weight-bold'> Ошибка с сервера </p>";

    $namePole = explode(".", $_FILES["fileToUpload"]["name"]);
    var_dump($namePole);
    $ext = end($namePole);


    if(empty($_POST["name"])){
        $_POST["name"] = $namePole[0];
//        echo $_POST["name"];
    }

    $fileName = $_POST["name"].".".$ext;

    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../files/$fileName");


    // Возвращаем пользователя обратно на страницу загрузки изображения
    header("Location: ".$address_site);

    // Останавливаем скрипт
    exit();




