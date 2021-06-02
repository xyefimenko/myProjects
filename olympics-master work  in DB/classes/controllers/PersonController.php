<?php

require_once "classes/Person.php";
require_once "classes/Placement.php";
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
        $stmt = $this->conn->prepare("select osoba.*, sum(umiestnenia.placing=1) as gold_count from osoba left outer join umiestnenia on osoba.id = umiestnenia.person_id  group by osoba.id;");
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_CLASS, "Person");

        foreach ($people as $person) {
            $stmt = $this->conn->prepare("select umiestnenia.*, oh.city, oh.year, oh.country, oh.type from umiestnenia join oh on umiestnenia.oh_id = oh.id where umiestnenia.person_id=:personId");
            $stmt->bindParam(":personId", $person->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $placements = $stmt->fetchAll(PDO::FETCH_CLASS, "Placement");
            $person->setPlacements($placements);
        }

        return $people;
    }

    public function getOnePeopleInfo()
    {
        $stmt = $this->conn->prepare("select birth_day, birth_place, birth_country, death_day, death_place, death_country from osoba;");
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_CLASS, "Person");
        return $people;
    }

    public function getPerson($id)
    {
        $stmt = $this->conn->prepare("select osoba.*, sum(umiestnenia.placing=1) as gold_count from osoba left outer join umiestnenia on osoba.id = umiestnenia.person_id where osoba.id=:personId;");
        $stmt->bindParam(":personId", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Person");
        $person = $stmt->fetch();

        $stmt = $this->conn->prepare("select umiestnenia.*, oh.city, oh.year, oh.country, oh.type from umiestnenia join oh on umiestnenia.oh_id = oh.id where umiestnenia.person_id=:personId");
        $stmt->bindParam(":personId", $person->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $placements = $stmt->fetchAll(PDO::FETCH_CLASS, "Placement");
        $person->setPlacements($placements);

        return $person;
    }

    public function insertPerson(Person $person)
    {
        $stmt = $this->conn->prepare("insert into osoba (name, surname, birth_day, birth_place, birth_country) values (:name, :surname, '2.3.1994', 'Poprad', 'Slovensko')");
        $name = $person->getName();
        $surname = $person->getSurname();
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function insertPlacements(Placement $placement)
    {
        $personId = $placement->getPersonId();
        $ohId = $placement->getOhId();
        $placing = $placement->getPlacing();
        $discipline = $placement->getDiscipline();
        $stmt = $this->conn->prepare("insert into umiestnenia (person_id, oh_id, placing, discipline) values (:personId, :ohId, :placing, :discipline)");
        $stmt->bindParam(":personId", $personId, PDO::PARAM_INT);
        $stmt->bindParam(":ohId", $ohId, PDO::PARAM_INT);
        $stmt->bindParam(":placing", $placing, PDO::PARAM_INT);
        $stmt->bindParam(":discipline", $discipline, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function updatePerson(Person $person)
    {
        $stmt = $this->conn->prepare("update osoba set name=:name, surname=:surname where id = :id;");
        $id = $person->getId();
        $name = $person->getName();
        $surname = $person->getSurname();
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteRow(Person $person){
        $stmt = $this->conn->prepare("DELETE from umiestnenia where umiestnenia.person_id= :id;");
        $id = $person->getId();
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deletePerson(Person $person){
        $stmt = $this->conn->prepare("DELETE from osoba where osoba.id= :id;");
        $id = $person->getId();
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}
