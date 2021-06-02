<?php


require_once "/home/xyefimenko/public_html/sseForDany/helper/Database.php";


class Controller
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function insertSessionData($session, $num){
        $stmt = $this->conn->prepare("insert ignore into session (session_name, num) values (:sessionName, :num);");
        $stmt->bindParam(":num", $num, PDO::PARAM_INT);
        $stmt->bindParam(":sessionName", $session, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function insertSessionDataWithType($session, $num, $type){
        $stmt = $this->conn->prepare("insert ignore into session (session_name, num, type ) values (:sessionName, :num, :type);");
        $stmt->bindParam(":num", $num, PDO::PARAM_INT);
        $stmt->bindParam(":sessionName", $session, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function updateSessionType($sessionName, $type){
        $stmt = $this->conn->prepare("update session set type = :type where session_name = :sessionName;");
        $stmt->bindParam(":sessionName", $sessionName, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function getSessionType($sessionName){
        $stmt = $this->conn->prepare("select type from session where session_name = :sessionName;");
        $stmt->bindParam(":sessionName", $sessionName, PDO::PARAM_STR);
        $stmt->execute();
        $session = $stmt->fetch();

        return end($session);
    }

    public function getSession($sessionName){
        $stmt = $this->conn->prepare("select num from session where session_name = :sessionName;");
        $stmt->bindParam(":sessionName", $sessionName, PDO::PARAM_STR);
        $stmt->execute();
        $session = $stmt->fetch();

        return $session;
    }

    public function updateSessionNum($sessionName, $param){
        $stmt = $this->conn->prepare("update session set num = :param where session_name = :sessionName;");
        $stmt->bindParam(":sessionName", $sessionName, PDO::PARAM_STR);
        $stmt->bindParam(":param", $param, PDO::PARAM_INT);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function findSession($sessionName){
        $stmt = $this->conn->prepare("select * from session where session_name = :sessionName;");
        $stmt->bindParam(":sessionName", $sessionName, PDO::PARAM_STR);
        $stmt->execute();
        $session = $stmt->fetch();
        if(empty($session)){
            return false;
        } else {
            return true;
        }
    }

}
