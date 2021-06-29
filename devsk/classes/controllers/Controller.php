<?php
require_once "/home/xyefimenko/public_html/devsk/classes/helper/Database.php";
//require_once "/home/xyefimenko/public_html/budget/classes/Income.php";

class Controller
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function insertBook($name, $isbn, $price, $category, $author){
        $stmt = $this->conn->prepare("insert into knihy (name, isbn, price, category, author) values (:name, :isbn, :price, :category, :author)");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":isbn", $isbn, PDO::PARAM_STR);
        $stmt->bindParam(":price", $price, PDO::PARAM_STR);
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $stmt->bindParam(":author", $author, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function getAllBooks(){
        $stmt = $this->conn->prepare("select name, isbn, price, category, author from knihy");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllAuthors(){
        $stmt = $this->conn->prepare("select author from knihy");
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
