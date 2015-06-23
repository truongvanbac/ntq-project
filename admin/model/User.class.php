<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Model {
    
    protected static $tableName='users';
    protected static $primaryKey='user_id';


    //Xử lý Login
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
    
    //Láy toàn bộ record của bảng
    public static function getAll($limit) {
        return Model::getAllRecord(self::$tableName, $limit);
    }
    
    //Tính tổng số record
    public static function count() {
        return Model::countRecord(self::$tableName, self::$primaryKey);
    }

    //Kiem tra xem id co ton tai hay khong
    public static function checkIdUser($user_id) {
        return Model::getIdItem(self::$tableName, $user_id, self::$primaryKey);
    }

    public static function getIdAdmin() {
        $db = Database::getInstance();
        $query = "SELECT user_id FROM " . self::$tableName . " WHERE  username = '" . $_SESSION['username'] . "'";
        $s = $db->query($query);
        return $s->fetchColumn();
    }
 

    //Thêm 1 user mới
    public static function addUser($username, $email, $pass, $img, $status) {
        $db = Database::getInstance();
        $data = array(
            'username' => $username,
            'user_email' => $email,
            'pass' => $pass,
            'user_img' => $img,
            'status' => $status,
            'user_time_created' => date("Y-m-d h:i:s"),
            'user_time_updated' => date("Y-m-d h:i:s")
        );
        
        $count = self::count_colum('username', $username);
        if ($count == 0) {
            Model::insertDataToTable(self::$tableName, $data);
            return true;
        } else {
            return false;
        }
        
    }
    

    //Sửa user
    public static function editUser($user_id, $username, $email, $pass, $user_img, $status) {
        $db = Database::getInstance();
        $data = array(
            'username' => $username,
            'user_email' => $email,
            'pass' => $pass,
            'user_img' => $user_img,
            'status' => $status,
            'user_time_updated' => date("Y-m-d h:i:s")
        );

        $data3 = array(
            'name' => User::getUser($user_id)
        );
        
        $name = $data3['name']['username'];
        $count = User::count_colum('username', $username);
        if (($count == 0) || (($count == 1) && ($username == $name))) {
            Model::updateDataInTable(self::$tableName, $user_id, self::$primaryKey, $data);
            return true;
        } else {
            return false;
        }
    }
    

    //Lấy tên user theo id
    public static function get_name_user($user_id) {
        return Model::getNameItem(self::$tableName, $user_id, 'username');
    }
    
    
    //Đếm số record theo tên
    public static function count_colum($column, $value) {
        return Model::countRowByColumn(self::$tableName, $column, $value);
    }
    
    //Lấy user theo id
    public static function getUser($user_id) {
        // $db = Database::getInstance();
        // $query = "select * from users where user_id = " . $user_id;
        // $s = $db->query($query);
        // $result = $s->fetch(PDO::FETCH_ASSOC);
        // return $result;
        return Model::getItemById(self::$tableName, self::$primaryKey, $user_id);
    }
    

    //Update active
    public static function update_active($user_id, $value) {
        //$db = Database::getInstance();
        $data = array(
            'status' => $value,
            'user_time_updated' => date("Y-m-d h:i:s")
                
        );
        $result = Model::activeRecord(self::$tableName, $user_id, 'user_id', $data, $value);
        if($result) {
            return true;
        } else {
            return false;
        }
    }
    
    //Sắp xêp
     public static function sort_item($item, $typesort, $limit) {
        return Model::sort(self::$tableName, $item, $typesort, $limit);
    }

    public static function seaching_process($string, $limit=null) {
        $column = array(
            'username' => 'username',
            'user_id' => 'user_id'
        );
        return Model::searchingElement(self::$tableName, $string, $column, $limit);
    }
    
}

