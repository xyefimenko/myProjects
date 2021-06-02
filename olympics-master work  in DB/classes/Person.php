<?php

class Person
{
    private int $id;
    private string $name;
    private string $surname;
    private string $birth_day;
    private string $birth_place;
    private string $birth_country;
    private ?string $death_day;
    private ?string $death_place;
    private ?string $death_country;

    /**
     * @return string
     */
    public function getBirthDay(): string
    {
        return $this->birth_day;
    }

    /**
     * @param string $birth_day
     */
    public function setBirthDay(string $birth_day): void
    {
        $this->birth_day = $birth_day;
    }

    /**
     * @return string
     */
    public function getBirthPlace(): string
    {
        return $this->birth_place;
    }

    /**
     * @param string $birth_place
     */
    public function setBirthPlace(string $birth_place): void
    {
        $this->birth_place = $birth_place;
    }

    /**
     * @return string
     */
    public function getBirthCountry(): string
    {
        return $this->birth_country;
    }

    /**
     * @param string $birth_country
     */
    public function setBirthCountry(string $birth_country): void
    {
        $this->birth_country = $birth_country;
    }

    /**
     * @return string|null
     */
    public function getDeathDay(): ?string
    {
        return $this->death_day;
    }

    /**
     * @param string|null $death_day
     */
    public function setDeathDay(?string $death_day): void
    {
        $this->death_day = $death_day;
    }

    /**
     * @return string|null
     */
    public function getDeathPlace(): ?string
    {
        return $this->death_place;
    }

    /**
     * @param string|null $death_place
     */
    public function setDeathPlace(?string $death_place): void
    {
        $this->death_place = $death_place;
    }

    /**
     * @return string|null
     */
    public function getDeathCountry(): ?string
    {
        return $this->death_country;
    }

    /**
     * @param string|null $death_country
     */
    public function setDeathCountry(?string $death_country): void
    {
        $this->death_country = $death_country;
    }

    private ?int $gold_count;
    private $placements;

    /**
     * @return int|null
     */
    public function getGoldCount(): ?int
    {
        return $this->gold_count;
    }

//    public function theBestPlayers(){
//        $personController = new PersonController();
//        $people = $personController->getAllPeople();
//
//    }

    public function getOnlyPlacements(){
        return $this->placements;
    }

    /**
     * @param int|null $gold_count
     */
    public function setGoldCount(?int $gold_count): void
    {
        $this->gold_count = $gold_count;
    }

    public function getFullname() :string
    {
        return "$this->name $this->surname";
    }

    public function getCountOfPlacements() : int{
        return count($this->placements);
    }

    public function getPlacementsForOnePerson(){
        $personController = new PersonController();
        $peopleInf = $personController->getOnePeopleInfo();
        foreach($this->placements as $placement){
            echo "<tr><td><a href='PersonInfo.php?id=".$this->getId()."'>".$this->getFullName()."</a></td><td>".$placement->getOhYear()."</td><td>".$placement->getCity()."</td><td>".$placement->getCountry()."</td><td>".$placement->getType()."</td>
            <td>".$placement->getDiscipline()."</td><td>".$placement->getPlacing()."</td><td>".$this->getBirthDay()."</td>
            <td>".$this->getBirthPlace()."</td><td>".$this->getBirthCountry()."</td><td>".$this->getDeathDay()."</td><td>".$this->getDeathPlace()."</td><td>".$this->getDeathCountry()."</td>";
        }


    }

    public function getPlacements(){
        foreach($this->placements as $placement){
            echo "<tr><td><a href='PersonInfo.php?id=".$this->getId()."'>".$this->getFullName()."</a></td><td>".$placement->getOhYear()."</td><td>".$placement->getCity()."</td><td>".$placement->getCountry()."</td><td>".$placement->getType()."</td>
            <td>".$placement->getDiscipline()."<td><a href='editPerson.php?id=".$this->getId()."'>EDIT</a></td><td><a href='deletePerson.php?id=".$this->getId()."'>DELETE</a></td></tr>";
        }
       // return $this->placements;
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $placements
     */
    public function setPlacements($placements): void
    {
        $this->placements = $placements;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }


}
