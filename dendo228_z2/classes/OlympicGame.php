<?php


class OlympicGame
{
    private int $id;
    private string $type;
    private int $year;
    private string $city;
    private string $country;

    public function getRow(){
        return "<tr>
                    <td>$this->id</td>
                    <td>$this->type</td>
                    <td>$this->year</td>
                    <td>$this->city</td>
                    <td>$this->country</td>
                </tr>";
    }

}
