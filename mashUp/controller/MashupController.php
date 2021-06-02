<?php

require_once "/home/xyefimenko/public_html/mashForMashGuys/helper/Database.php";

class MashupController
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function insertUser($session_id, $ip, $flag, $country, $city, $time, $lat, $lon){
        $stmt = $this->conn->prepare("insert into user (session_id, ip, flag, country, city, time, lat, lon)
        values (:sessionId, :ip, :flag, :country, :city, :time, :lat, :lon);");
        $stmt->bindParam(":sessionId", $session_id, PDO::PARAM_STR);
        $stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
        $stmt->bindParam(":flag", $flag, PDO::PARAM_STR);
        $stmt->bindParam(":country", $country, PDO::PARAM_STR);
        $stmt->bindParam(":city", $city, PDO::PARAM_STR);
        $stmt->bindParam(":time", $time, PDO::PARAM_STR);
        $stmt->bindParam(":lat", $lat, PDO::PARAM_STR);
        $stmt->bindParam(":lon", $lon, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function findSession($session_id){
        $stmt = $this->conn->prepare("select * from user where session_id = :sessionId;");
        $stmt->bindParam(":sessionId", $session_id, PDO::PARAM_STR);
        $stmt->execute();
        $session = $stmt->fetch();
        if(empty($session)){
            return false;
        } else {
            return true;
        }
    }

    public function findTime($ip){
        $stmt = $this->conn->prepare("select time from user where ip = :ip;");
        $stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
        $stmt->execute();
        $time = $stmt->fetchAll();
        if (empty($time)){
            return true;
        }
        $lastTime = end($time);
        $lastTime = new DateTime($lastTime[0]);

        $currentDate = new DateTime();
        $diff = date_diff($lastTime, $currentDate);
        if($diff->d >= 1 || $diff->m >= 1 || $diff->y >= 1){
//            echo $diff->d;
            return true;
        } else {
//            var_dump($diff);
            return false;
        }
    }

    public function getAllUsers()
    {
        $stmt = $this->conn->prepare("select * from user order by flag;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCountryInfo($country){
        $stmt = $this->conn->prepare("select * from user where country = :country order by city;");
        $stmt->bindParam(":country", $country, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllGPS(){
        $stmt = $this->conn->prepare("select lat, lon from user order by city;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getApageStatstic(){
        $stmt = $this->conn->prepare("select page_a from mashup.page_sttistic;");
        $stmt->execute();
        $stat = $stmt->fetchAll();
        if(empty($stat)){
            return true;
        } else {
            return false;
        }
    }

    public function inserPages($page_a, $page_b, $page_c){
        $stmt = $this->conn->prepare("insert into page_sttistic (page_a, page_b, page_c) values (:pageA, :pageB, :pageC);");
        $stmt->bindParam(":pageA", $page_a, PDO::PARAM_INT);
        $stmt->bindParam(":pageB", $page_b, PDO::PARAM_INT);
        $stmt->bindParam(":pageC", $page_c, PDO::PARAM_INT);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function updateApage(){
        $stmt = $this->conn->prepare("update page_sttistic set page_a = `page_a` + 1;");
        $stmt->execute();
        return $this->conn->lastInsertId();
    }


    public function getBpageStatstic(){
        $stmt = $this->conn->prepare("select page_b from mashup.page_sttistic;");
        $stmt->execute();
        $stat = $stmt->fetchAll();
        if(empty($stat)){
            return true;
        } else {
            return false;
        }
    }

    public function updateBpage(){
        $stmt = $this->conn->prepare("update page_sttistic set page_b = `page_b` + 1;");
        $stmt->execute();
        return $this->conn->lastInsertId();
    }


    public function getCpageStatstic(){
        $stmt = $this->conn->prepare("select page_c from mashup.page_sttistic;");
        $stmt->execute();
        $stat = $stmt->fetchAll();
        if(empty($stat)){
            return true;
        } else {
            return false;
        }
    }


    public function updateCpage(){
        $stmt = $this->conn->prepare("update page_sttistic set page_c = `page_c` + 1;");
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function getAllPagesStatistic()
    {
        $stmt = $this->conn->prepare("select * from page_sttistic;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
