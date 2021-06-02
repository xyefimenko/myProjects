<?php


class Select
{

    private string $name;
    private string $surname;
    private string $year;
    private string $city;
    private string $country;
    private string $type;
    private string $discipline;

    public function getRow(){
        return "<tr>
                    <td>$this->name</td>
                    <td>$this->surname</td>
                    <td>$this->year</td>
                    <td>$this->city</td>
                    <td>$this->country</td>
                    <td>$this->type</td>
                    <td>$this->discipline</td>
                </tr>";
    }
}
