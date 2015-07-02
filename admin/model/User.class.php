<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Model {
    
    /**
     * Table name and primary table
     */
    protected static $tableName='user';
    protected static $primaryKey='user_id';
    protected static $columnName = 'username';


    /**
     * Login process
     */
    public static function login_process($username, $password) {
        $condition = array(
            ':username' => $username,
            ':pass' => md5($password),
            ':privilege' => '1'
        );
        
        $query = "select count(user_id) from user where username = :username and pass = :pass and privilege = :privilege";
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
    

    /**
     * Get all record user
     */
    public static function get_list($limit) {
        return User::getAllRecord($limit);
    }
    
    /**
     * Count all record
     */
    public static function count() {
        return User::countRecord();
    }


    /**
     * Check id user 
     */
    public static function checkIdUser($user_id) {
        return User::getIdItem($user_id);
    }

    /**
     * Get id admin
     */
    public static function getIdAdmin() {
        $db = Database::getInstance();
        $query = "SELECT user_id FROM " . self::$tableName . " WHERE  privilege = 1";
        $s = $db->query($query);
        return $s->fetchColumn();
    }
 

    /**
     * Update user contain add and edit
     */
    public static function updateUserProcess($data = array(), $user_id = null) {
        return User::updateItem($data, $user_id);
    }
    
    
    /**
     * Count record by condition
     */
    public static function count_colum($column, $value) {
        return User::countRowByColumn($column, $value);
    }
    

    /**
     * Get user by id
     */
    public static function getUser($user_id) {
        return User::getItemById($user_id);
    }
    

    /**
     * Update active record
     */
    public static function update_active($user_id, $value) {
        //$db = Database::getInstance();
        $data = array(
            'status' => $value,
            'user_time_updated' => date("Y-m-d h:i:s")
                
        );
        $result = User::activeRecord($user_id, 'user_id', $data, $value);
        if($result) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Sort record
     */
    public static function sort_item($item, $typesort, $limit) {
        return User::sort($item, $typesort, $limit);
    }


    /**
     * Search data
     */
    public static function seaching_process($string, $limit=null) {
        $column = array(
            'username' => 'username',
            'user_id' => 'user_id'
        );
        return User::searchingElement($string, $column, $limit);
    }
    
}

