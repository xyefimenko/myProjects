<?php


require_once  "/home/xyefimenko/public_html/zadanie3gangsta/classic/classes/Access.php";
require_once "/home/xyefimenko/public_html/zadanie3gangsta/classic/classes/User.php";
require_once "/home/xyefimenko/public_html/zadanie3gangsta/classic/classes/Account.php";
require_once "/home/xyefimenko/public_html/zadanie3gangsta/classic/classes/Access.php";
require_once "/home/xyefimenko/public_html/zadanie3gangsta/classic/classes/helper/Database.php";
class UserController
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function countGoogleVisitors(){
        $stmt = $this->conn->prepare("select distinct count(user_login) from access where access_type = 'GOOGLE';");
        $stmt->execute();
        $visitor = $stmt->fetch();
        $count = end($visitor);
        return $count;
    }

    public function countRegistrationVisitors(){
        $stmt = $this->conn->prepare("select distinct count(user_login) from access where access_type = 'PAGE';");
        $stmt->execute();
        $visitor = $stmt->fetch();
        $count = end($visitor);
        return $count;
    }

    public function countLDAPVisitors(){
        $stmt = $this->conn->prepare("select distinct count(user_login) from access where access_type = 'LDAP';");
        $stmt->execute();
        $visitor = $stmt->fetch();
        $count = end($visitor);
        return $count;
    }

    public function showHistory($username){
        $stmt = $this->conn->prepare("select distinct name from user where name = :username;");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_CLASS, "User");
        //echo "<pre>".var_dump($user)."</pre>";
        foreach ($user as $u) {
            $stmt = $this->conn->prepare("select user_login, access_type, access_time from access where user_login = :username;");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $accesses = $stmt->fetchAll(PDO::FETCH_CLASS, "Access");
            $u->setAccesses($accesses);
        }

        return $user;
    }

    public function getHasPassword(User $user){
        $stmt = $this->conn->prepare("select password from account where user_id = :id;");
        $id = $user->getId();
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch();
        $password = end($user);
        return $password;
    }

    public function insertAccess($user_id, $user_login, $access_type, $token, $access_time){
        $stmt = $this->conn->prepare("insert into access (user_id, user_login, access_type, token, access_time) values (:user_id, :user_login, :access_type, :token, :access_time)");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":user_login", $user_login, PDO::PARAM_STR);
        $stmt->bindParam(":access_type", $access_type, PDO::PARAM_STR);
        $stmt->bindParam(":access_time", $access_time, PDO::PARAM_STR);
        $stmt->bindParam(":token", $token, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function getUser($email){
        $stmt = $this->conn->prepare("select id, name, email from user where email = :email;");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_CLASS, "User");
        return $user;
    }

        public function insertUser(User $user){
        $stmt = $this->conn->prepare("insert into user (name, email) values (:name, :email)");
        $name = $user->getName();
        $email = $user->getEmail();
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function insertGoogleId($google_id, $user_id){
        $stmt = $this->conn->prepare("update account set google_id = :google_id where user_id = :user_id;");
        $stmt->bindParam(":google_id", $google_id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function insertAccount($user_id, $type, $hashed_password){
        $stmt = $this->conn->prepare("insert into account (user_id, type, password) values (:user_id, :type, :password)");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":type", $type, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }


}
