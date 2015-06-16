<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Model {
    
//    protected static $tableName='users';
//    protected static $primary='user_id';
//    
//    public function __construct() {
//        parent::__construct();
//    }
    
    public static function login_process($username, $password) {
        $condition = array(
            ':username' => $username,
            ':pass' => md5($password),
            ':privilege' => '1'
        );
        
        $query = "select count(user_id) from users where username = :username and pass = :pass and privilege = :privilege";
        $db = Database::getInstance();
        $s = $db->prepare($query);
        $s->execute($condition);
        $result = $s->fetchColumn();
        if($result > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function getAll($privilege, $limit) {
        $db = Database::getInstance();
        $query = "select * from users where privilege = " . $privilege . " " . $limit;
        $s = $db->query($query);
        $result = $s->fetchAll();
        return $result;
    }
    
    public static function count($privilege) {
        $db = Database::getInstance();
        $query = "select count(user_id) from users where privilege = " . $privilege;
        $s = $db->query($query);
        $result = $s->fetchColumn();
        return $result;
    }
    
    public static function addUser($username, $email, $pass, $img, $status) {
        $db = Database::getInstance();
        $data = array(
            ':username' => $username,
            ':user_email' => $email,
            ':pass' => $pass,
            ':user_img' => $img,
            ':status' => $status,
            ':time' => date("Y-m-d h:i:s")
        );
        
        
        $data2 = array(
            ':username' => $username
        );
        
        $count = self::count_colum('username', $data2);
        if ($count == 0) {
            $query = "INSERT INTO users(username, user_email, pass, user_img, status, user_time_created)"
                    . " VALUES(:username, :user_email, :pass, :user_img ,:status, :time)";
            $stmp = $db->prepare($query);
            $stmp->execute($data);
            return true;
        } else {
            return false;
        }
        
    }
    
    
    public static function editUser($user_id, $username, $email, $pass, $user_img, $status) {
        $db = Database::getInstance();
        $data = array(
            ':user_id' => $user_id,
            ':username' => $username,
            ':user_email' => $email,
            ':pass' => $pass,
            ':user_img' => $user_img,
            ':status' => $status,
            ':time' => date("Y-m-d h:i:s")
        );
        $data2 = array(
            ':username' => $username
        );
        
        $data3 = array(
            'name' => User::get_name_user($user_id)
        );
        
        $name = implode('', array_values($data3['name']));
        $count = User::count_colum('username', $data2);
        if (($count == 0) || (($count == 1) && ($username == $name))) {
            $query = "UPDATE users SET username = :username, user_email = :user_email, pass = :pass, user_img = :user_img, "
                    . "status = :status, user_time_updated = :time WHERE user_id = :user_id";

            $stmp = $db->prepare($query);
            $stmp->execute($data);
            return true;
        } else {
            return false;
        }
    }
    
    public static function get_name_user($user_id) {
        $db = Database::getInstance();
        $query = "select username from users where user_id = " . $user_id;
        $result = $db->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    
    
    
    public static function count_colum($colum, $data = array()) {
        $db = Database::getInstance();
        $check = "select count($colum) from users where $colum = :$colum";
        $s = $db->prepare($check);
        $s->execute($data);
        return $s->fetchColumn();
    }
    
    public static function getUser($user_id) {
        $db = Database::getInstance();
        $query = "select * from users where user_id = " . $user_id;
        $s = $db->query($query);
        $result = $s->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public static function update_active($user_id, $value) {
        $db = Database::getInstance();
        $data = array(
            ':status' => $value,
            ':user_id' => $user_id,
            ':user_time_updated' => date("Y-m-d h:i:s")
                
        );
        
        $query = "update users SET status = :status, user_time_updated = :user_time_updated where user_id = :user_id";
        $s = $db->prepare($query);
        $result = $s->execute($data);
        if($result) {
            return true;
        } else {
            return false;
        }
    }
    
     public static function sort_item($item, $typesort, $limit) {
        $db = Database::getInstance();
        $query = "select * from users order by ". $item ." ".$typesort . " " . $limit;
        $result = $db->query($query);
        return $result->fetchAll();
    }
    
}

