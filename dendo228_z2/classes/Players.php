<?php


class Players
{

    private int $id;
    private string $name;
    private string $surname;
    private string $birth_day;
    private string $death_day;
    private string $birth_place;
    private ?string $death_place;
    private ?string $birth_country;
    private ?string $death_country;

    public function getRow(){
        return "<tr>
                    <td>$this->id</td>
                    <td>$this->name</td>
                    <td>$this->surname</td>
                    <td>$this->birth_day</td>
                    <td>$this->death_day</td>
                    <td>$this->birth_place</td>
                    <td>$this->death_place</td>
                    <td>$this->birth_country</td>
                    <td>$this->death_country</td>
                </tr>";
    }


}
