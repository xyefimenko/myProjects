<?php


class Umiestnenia
{
    private int $id;
    private string $person_id;
    private int $oh_id;
    private string $placing;
    private string $discipline;

    public function getRow(){
        return "<tr>
                    <td>$this->id</td>
                    <td>$this->person_id</td>
                    <td>$this->oh_id</td>
                    <td>$this->placing</td>
                    <td>$this->discipline</td>
                </tr>";
    }
}
