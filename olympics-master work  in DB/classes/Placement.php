<?php


class Placement
{

    private int $id;
    private int $person_id;
    private int $oh_id;
    private int $placing;
    private string $discipline;

    private string $city;
    private string $year;
    private string $country;
    private string $type;
    private string $birth_day;

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
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
    /**
     * @return string
     */
    public function getOhYear(): string
    {
        return $this->year;
    }


    public function setOhYear(string $year): void
    {
        $this->year = $year;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPersonId(): int
    {
        return $this->person_id;
    }

    /**
     * @param int $person_id
     */
    public function setPersonId(int $person_id): void
    {
        $this->person_id = $person_id;
    }

    /**
     * @return int
     */
    public function getOhId(): int
    {
        return $this->oh_id;
    }

    /**
     * @param int $oh_id
     */
    public function setOhId(int $oh_id): void
    {
        $this->oh_id = $oh_id;
    }

    /**
     * @return int
     */
    public function getPlacing(): int
    {
        return $this->placing;
    }

    /**
     * @param int $placing
     */
    public function setPlacing(int $placing): void
    {
        $this->placing = $placing;
    }

    /**
     * @return string
     */
    public function getDiscipline(): string
    {
        return $this->discipline;
    }

    /**
     * @param string $discipline
     */
    public function setDiscipline(string $discipline): void
    {
        $this->discipline = $discipline;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }



}
