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


    //Lấy toàn bộ record của bảng
    public static function get_list_product($limit) {
        return Model::getAllRecord(self::$tableName, $limit);
    }
    
    //Đếm số record của báng
    public static function count() {
        return Model::countRecord(self::$tableName, self::$primaryKey);
    }
    
    
    //Lấy product theo id
    public static function getProduct($pd_id) {
        // $db = Database::getInstance();
        // $query = "select * from product where pd_id = " . $pd_id;
        // $s = $db->query($query);
        // $result = $s->fetch(PDO::FETCH_ASSOC);
        // return $result;
        return Model::getItemById(self::$tableName, self::$primaryKey, $pd_id);
    }

    public static function getIdProduct($pd_id) {
        return Model::getIdItem(self::$tableName, $pd_id, self::$primaryKey);
    }
    
    
    
    //Thêm mới product
    public static function addProduct($name, $price, $des, $file, $status) {
        $db = Database::getInstance();
        $data = array(
            'pd_name' => $name,
            'pd_price' => $price,
            'pd_des' => $des,
            'pd_img' => $file,
            'pd_status' => $status,
            'pd_time_created' => date("Y-m-d h:i:s"),
            'pd_time_updated' => date("Y-m-d h:i:s")
        );
        
        
        $count = self::count_colum('pd_name', $name);
        if ($count == 0) {
            Model::insertDataToTable(self::$tableName, $data);
            return true;
        } else {
            return false;
        }
        
    }
    
    //Sửa product
    public static function editProduct($pd_id, $pd_name, $price, $des, $file, $status) {
        $db = Database::getInstance();
        $data = array(
            'pd_name' => $pd_name,
            'pd_price' => $price,
            'pd_des' => $des,
            'pd_img' => $file,
            'pd_status' => $status,
            'pd_time_updated' => date("Y-m-d h:i:s")
        );
        
        $data3 = array(
            'name' => Product::getProduct($pd_id)
        );
        
        $name = ($data3['name']['pd_name']);
        $count = Product::count_colum('pd_name', $pd_name);
        if (($count == 0) || (($count == 1) && ($pd_name == $name))) {
            // $query = "UPDATE product SET pd_name = :pd_name, pd_price = :pd_price, pd_des = :pd_des, pd_img = :pd_img, "
            //         . " pd_status = :pd_status, pd_time_updated = :time WHERE pd_id = :pd_id";

            // $stmp = $db->prepare($query);
            // $stmp->execute($data);
            Model::updateDataInTable(self::$tableName, $pd_id, self::$primaryKey, $data);
            return true;
        } else {
            return false;
        }
    }
    

    //Lấy tên product
    public static function get_name_pd($pd_id) {
        return Model::getNameItem(self::$tableName, $pd_id, 'pd_name');
    }
    
   
   //Đếm số record theo tên
     public static function count_colum($column, $value) {
        return Model::countRowByColumn(self::$tableName, $column, $value);
    }
    

    //Update active record 
    public static function update_active($pd_id, $value) {
        $db = Database::getInstance();
        $data = array(
            'pd_status' => $value,
            'pd_time_updated' => date("Y-m-d h:i:s")
                
        );

        $result = Model::activeRecord(self::$tableName, $pd_id, 'pd_id', $data, $value);
        if($result) {
            return true;
        } else {
            return false;
        }
    }
    

    //Sắp xếp
    public static function sort_item($item, $typesort, $limit) {
        return Model::sort(self::$tableName, $item, $typesort, $limit);
    }

    public static function searching_process($string, $limit=null) {
        $column = array(
            '1' => 'pd_name',
            '2' => 'pd_price',
            '3' => 'pd_id'
        );

        return Model::searchingElement(self::$tableName, $string, $column);
    }
}
