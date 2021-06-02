<?php


class Access
{
    private int $id;
    private int $user_id;
    private string $token;
    private $date;
    private string $user_login;
    private string $access_type;
    private string $access_time;

    /**
     * @return string
     */
    public function getUserLogin(): string
    {
        return $this->user_login;
    }

    /**
     * @param string $user_login
     */
    public function setUserLogin(string $user_login): void
    {
        $this->user_login = $user_login;
    }

    /**
     * @return string
     */
    public function getAccessType(): string
    {
        return $this->access_type;
    }

    /**
     * @param string $access_type
     */
    public function setAccessType(string $access_type): void
    {
        $this->access_type = $access_type;
    }

    /**
     * @return string
     */
    public function getAccessTime(): string
    {
        return $this->access_time;
    }

    /**
     * @param string $access_time
     */
    public function setAccessTime(string $access_time): void
    {
        $this->access_time = $access_time;
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
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }


}
