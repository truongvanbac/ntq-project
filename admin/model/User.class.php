<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Model {
    
    protected static $tableName='users';
    protected static $primary='user_id';
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function login_process($username, $password) {
        $condition = array(
            'username' => $username,
            'pass' => md5($password),
            'status' => '1'
        );
        $result = static::getAll($condition);
        if($result == true) {
            return true;
        } else {
            return false;
        }
    }
}

