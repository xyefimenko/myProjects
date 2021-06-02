<?php


class UserAction
{
    private int $id;
    private string $action;
    private string $timestamp;
    private int $lectureId;


    private string $lectureMinutes;

    /**
     * @return int
     */
    public function getLectureId(): int
    {
        return $this->lectureId;
    }

    /**
     * @param int $lectureId
     */
    public function setLectureId(int $lectureId): void
    {
        $this->lectureId = $lectureId;
    }

    /**
     * @return string
     */
    public function getLectureMinutes(): string
    {
        return $this->lectureMinutes;
    }

    /**
     * @param string $lectureMinutes
     */
    public function setLectureMinutes(string $lectureMinutes): void
    {
        $this->lectureMinutes = $lectureMinutes;
    }

//    private string $name;
//    private $action;
//    private int $lecture_id;
//    private $joined_time;
//    private $left_time;



    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
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
     * @return mixed
     */

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
