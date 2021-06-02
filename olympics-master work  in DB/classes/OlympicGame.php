<?php


class OlympicGame
{
    private int $id;
    private string $type;
    private int $year;
    private int $order;
    private string $city;
    private string $country;

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
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder(int $order): void
    {
        $this->order = $order;
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


    private function getTypeString()
    {
        switch ($this->type){
            case "LOH":
                return "Letné olypijske hry";
            case "ZOH":
                return "Zimné olypijske hry";
        }
    }

    public function getRow()
    {
        return "<tr>
                    <td>$this->id</td>
                    <td>".$this->getTypeString()."</td>
                    <td>$this->year</td>
                    <td>$this->city</td>
                    <td>$this->country</td>
                </tr>";
    }
}
