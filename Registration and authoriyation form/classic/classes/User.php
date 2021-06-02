<?php


class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private $accesses;

    public function getAccessInfo(){
        foreach ($this->accesses as $access){
           echo "<tr><td>". $access->getUserLogin()."</td><td> ".$access->getAccessType()."</td><td> ".$access->getAccessTime()."</td></tr>";
        }
    }

    /**
     * @return mixed
     */
    public function getAccesses()
    {
        return $this->accesses;
    }

    /**
     * @param mixed $accesses
     */
    public function setAccesses($accesses): void
    {
        $this->accesses = $accesses;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


}
