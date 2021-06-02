<?php

require_once "classes/helper/Database.php";
require_once "classes/UserAction.php";
require_once "classes/Lectures.php";
require_once "classes/User.php";


class ActionsController
{
    private PDO $conn;



    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getUser($id){
        $stmt = $this->conn->prepare("select * from users where id = :id;");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
        $user = $stmt->fetch();
        $name = $user->getName();
//        var_dump($user);


        $stmt2 = $this->conn->prepare("select user_actions.id, action, timestamp from user_actions 
            left outer join users on user_actions.user_id = users.id where name = :name;");
        $stmt2->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt2->execute();
        $actions = $stmt2->fetchAll(PDO::FETCH_CLASS, "UserAction");
        $user->setActions($actions);
//        var_dump($user);
        return $user;
    }


    public function getAllUsers(){
        $stmt = $this->conn->prepare("select * from users;");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, "User");

        foreach ($users as $user) {
            $stmt = $this->conn->prepare("select lecture_id, user_actions.id, action, timestamp from user_actions 
            left outer join users on user_actions.user_id = users.id where name = :name;");
            $stmt->bindParam(":name", $user->getName(), PDO::PARAM_STR);
            $stmt->execute();
            $actions = $stmt->fetchAll(PDO::FETCH_CLASS, "UserAction");
            $user->setActions($actions);
        }
        return $users;
    }



    public function getLectureMinutes($user){
        $actions = $user->getActions();
        $lectures = $this->getAllLectures();

        if(empty($actions)){
            return ;
        }
        $returnArray = '';
//        var_dump($actions);
        $minutes = 0;
        $leftTime = '';
        $joinedTime ='';

        $allLectureMinutes = 0;

        $firstAction = $actions[0];
        $firstActionId = $firstAction->getId();
        $firstLectureId = $this->getLectureIdFromUsersAction($user, $firstActionId);


        $prevActionType = $firstAction->getAction();
        $prevActionId = $firstAction->getId();
        $prevActionTimestamp = $firstAction->getTimestamp();
        foreach ($actions as $action){
            $currentActionId = $action->getId();
            $currentLectureId = $this->getLectureIdFromUsersAction($user, $currentActionId);

            if($firstLectureId != $currentLectureId){
                if($prevActionType == "Joined"){
//                    $leftTime = $this->findLastLeftTime();
//                    $userId = $user->getId();
//                    $lectureId = $this->getLectureIdFromUsersAction($user, $prevActionId);
//                    $stmt = $this->conn->prepare("insert into user_actions (lecture_id, user_id, action, timestamp)
//                    VALUES (:lectureId, :userId, 'Left', :timestamp);");
//                    $stmt->bindParam(":lectureId", $lectureId, PDO::PARAM_INT);
//                    $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
//                    $stmt->bindParam(":timestamp", $leftTime, PDO::PARAM_STR);
//                    $stmt->execute();
//
//
                    $leftTime = $this->findLastLeftTime();
                    $leftTime = new DateTime($leftTime);

                    $interval = $leftTime->diff($joinedTime);
                    $minutes = $minutes + ($interval->h)*60 + $interval->i; // кол-во минут
                    $allLectureMinutes = $allLectureMinutes + $minutes;
//                    $returnArray =$returnArray."<td></td>";
                }
                $returnArray =$returnArray."<td><a href='PersonInfo.php?id=".$user->getId()."'>".$minutes."</a></td>";
                $firstLectureId = $currentLectureId;
                $minutes = 0;
            }
            if ($action->getAction() == "Joined"){
                $joinedTime = $action->getTimestamp();
                $joinedTime = new DateTime($joinedTime);
            }
            elseif ($action->getAction() == "Left"){
                $leftTime = $action->getTimestamp();
                $leftTime = new DateTime($leftTime);

                $interval = $leftTime->diff($joinedTime);
                $minutes = $minutes + ($interval->h)*60 + $interval->i; // кол-во минут
                $allLectureMinutes = $allLectureMinutes + $minutes;
            }
            if(empty(next($actions))){
                $returnArray =$returnArray."<td><a href='PersonInfo.php?id=".$user->getId()."'>".$minutes."</a></td><td><a href='PersonInfo.php?id=".$user->getId()."'>".$allLectureMinutes."</a></td>";
            }
            $prevActionType = $action->getAction();
            $prevActionId = $action->getId();
            $prevActionTimestamp = $action->getTimestamp();
        }
            return $returnArray;
    }

    public function getLectureIdFromUsersAction($user, $actionId){
        $userId = $user->getId();
        $stmt = $this->conn->prepare("select lecture_id from user_actions where user_id = :userId and id = :actionId;");
        $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":actionId", $actionId, PDO::PARAM_INT);
        $stmt->execute();
        $lectureId = $stmt->fetchColumn();
//        var_dump($lectureId);
        return $lectureId;
    }

    public function getAllLectures(){
        $stmt = $this->conn->prepare("select * from lectures;");
        $stmt->execute();
        $lectures = $stmt->fetchAll(PDO::FETCH_CLASS, "Lectures");
        return $lectures;
    }

    public function findLastLeftTime(){
        $stmt = $this->conn->prepare("select MAX(timestamp) from user_actions where action = 'Left';");
//        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserAction");
        $timestamp = $stmt->fetch();
        $lastTime = end($timestamp);
        return $lastTime;
    }

    public function getAllUserActions($user){
        $actions = $user->getActions();
        foreach ($actions as $action){
            echo "<tr><td>".$action->getAction()."</td><td>".$action->getTimestamp()."</td></tr>";
        }
    }

    public function howManyStudentOnLecture($lectureId){
        $stmt = $this->conn->prepare("select count(distinct user_id)  from user_actions where lecture_id = :lectureId;");
        $stmt->bindParam(":lectureId", $lectureId, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }

    public function getUserNameById($id){
        $stmt = $this->conn->prepare("select name from users where id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $name = $stmt->fetchColumn();
        echo "<h1>".$name."</h1>";
        return $name;
    }


}
