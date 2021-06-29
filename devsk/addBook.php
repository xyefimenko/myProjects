<?php
require_once "/home/xyefimenko/public_html/devsk/classes/controllers/Controller.php";

if(isset($_POST["name"]) && isset($_POST["isbn"]) && isset($_POST["price"]) && isset($_POST["category"]) && isset($_POST["author"])){
    $controller = new Controller();
    $controller->insertBook($_POST["name"], $_POST["isbn"], $_POST["price"], $_POST["category"], $_POST["author"]);

    header("Location: index.php");
}
