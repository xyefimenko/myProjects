<?php
require_once "classes/Players.php";
require_once "classes/Umiestnenia.php";
require_once "classes/helper/Database.php";

class PersonController
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getAllPeople()
    {
        $stmt = $this->conn->prepare("select * from osoba;");
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_CLASS, "Players");
        return $people;
    }
}
