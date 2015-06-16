<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Product extends Model {
    
    protected static $tableName = 'product';
    protected static $primaryKey = 'pd_id';

    public static function get_list_product($limit) {
        $db = Database::getInstance();
        $query = "select * from product " . $limit;
        $s = $db->query($query);
        $result = $s->fetchAll();
        return $result;
    }
    
    public static function count() {
        $db = Database::getInstance();
        $query = "select count(pd_id) from product";
        $s = $db->query($query);
        $result = $s->fetchColumn();
        return $result;
    }
    
    
    public static function getProduct($pd_id) {
        $db = Database::getInstance();
        $query = "select * from product where pd_id = " . $pd_id;
        $s = $db->query($query);
        $result = $s->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    
    
    
    public static function addProduct($name, $price, $des, $file, $status) {
        $db = Database::getInstance();
        $data = array(
            ':pd_name' => $name,
            ':pd_price' => $price,
            ':pd_des' => $des,
            ':pd_img' => $file,
            ':pd_status' => $status,
            ':time' => date("Y-m-d h:i:s")
        );
        
        
        $data2 = array(
            ':pd_name' => $name
        );
        
        $count = self::count_colum('pd_name', $data2);
        if ($count == 0) {
            $query = "INSERT INTO product(pd_name, pd_price, pd_des, pd_img, pd_status, pd_time_created)"
                    . " VALUES(:pd_name, :pd_price, :pd_des, :pd_img ,:pd_status, :time)";
            $stmp = $db->prepare($query);
            $stmp->execute($data);
            return true;
        } else {
            return false;
        }
        
    }
    
    
    public static function editProduct($pd_id, $pd_name, $price, $des, $file, $status) {
        $db = Database::getInstance();
        $data = array(
            ':pd_id' => $pd_id,
            ':pd_name' => $pd_name,
            ':pd_price' => $price,
            ':pd_des' => $des,
            ':pd_img' => $file,
            ':pd_status' => $status,
            ':time' => date("Y-m-d h:i:s")
        );
        $data2 = array(
            ':pd_name' => $pd_name
        );
        
        $data3 = array(
            'name' => Product::get_name_pd($pd_id)
        );
        
        $name = implode('', array_values($data3['name']));
        $count = Product::count_colum('pd_name', $data2);
        if (($count == 0) || (($count == 1) && ($pd_name == $name))) {
            $query = "UPDATE product SET pd_name = :pd_name, pd_price = :pd_price, pd_des = :pd_des, pd_img = :pd_img, "
                    . " pd_status = :pd_status, pd_time_updated = :time WHERE pd_id = :pd_id";

            $stmp = $db->prepare($query);
            $stmp->execute($data);
            return true;
        } else {
            return false;
        }
    }
    
    public static function get_name_pd($pd_id) {
        $db = Database::getInstance();
        $query = "select pd_name from product where pd_id = " . $pd_id;
        $result = $db->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    
   
     public static function count_colum($colum, $data = array()) {
        $db = Database::getInstance();
        $check = "select count($colum) from product where $colum = :$colum";
        $s = $db->prepare($check);
        $s->execute($data);
        return $s->fetchColumn();
    }
    
    public static function update_active($pd_id, $value) {
        $db = Database::getInstance();
        $data = array(
            ':pd_status' => $value,
            ':pd_id' => $pd_id,
            ':pd_time_updated' => date("Y-m-d h:i:s")
                
        );
        
        $query = "update product SET pd_status = :pd_status, pd_time_updated = :pd_time_updated where pd_id = :pd_id";
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
        $query = "select * from product order by ". $item ." ".$typesort . " " . $limit;
        $result = $db->query($query);
        return $result->fetchAll();
    }
}
