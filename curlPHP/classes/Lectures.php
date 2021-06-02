<?php


class Lectures
{
    private int $id;
    private $timestamp;

    private $studentsCount;

    /**
     * @return mixed
     */
    public function getStudentsCount()
    {
        return $this->studentsCount;
    }

    /**
     * @param mixed $studentsCount
     */
    public function setStudentsCount($studentsCount): void
    {
        $this->studentsCount = $studentsCount;
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
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }


}
