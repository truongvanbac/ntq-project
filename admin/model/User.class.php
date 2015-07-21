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
            ':pass' => $password
        );
        
        $query = "select count(user_id) from user where username = :username and pass = :pass and privilege = 1";
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
        return self::getAllRecord($limit);
    }
    
    /**
     * Count all record
     */
    public static function count() {
        return self::countRecord();
    }


    /**
     * Check id user 
     */
    public static function checkIdUser($user_id) {
        return self::getIdItem($user_id);
    }

    /**
     * Get id admin
     */
    public static function getIdAdmin() {
        $db = Database::getInstance();
        $query = "SELECT user_id FROM " . self::$tableName . " WHERE username = '" . $_SESSION['username'] . "'";
        $s = $db->query($query);
        return $s->fetchColumn();
    }
 

    /**
     * Update user contain add and edit
     */
    public static function updateUserProcess($data = array(), $user_id = null) {
        return self::updateItem($data, $user_id);
    }
    
    
    /**
     * Count record by condition
     */
    public static function count_colum($column, $value) {
        return self::countRowByColumn($column, $value);
    }
    

    /**
     * Get user by id
     */
    public static function getUser($user_id) {
        return self::getItemById($user_id);
    }
    

    /**
     * Update active record
     */
    public static function update_active($user_id, $value) {
        $data = array(
            'status' => $value,
            'user_time_updated' => date("Y-m-d h:i:s")
                
        );
        $result = self::activeRecord($user_id, 'user_id', $data, $value);
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
        return self::sort($item, $typesort, $limit);
    }

    /**
     * Search and search
     */
    public static function sort_search($string, $item = null, $typesort = null, $limit = null) {
        $column = array(
            'username' => 'username',
            'user_id' => 'user_id'
        );
        return self::search_sort($item, $typesort, $limit, $string, $column);
    }

    
}

