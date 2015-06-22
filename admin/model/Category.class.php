<?php

date_default_timezone_set("Asia/Ho_Chi_Minh");

class Category extends Model {

    protected static $tableName = 'category';
    protected static $primaryKey = 'ct_id';


    //Lấy toàn bộ record cảu bảng
    public static function get_list_category($limit) {
        return Model::getAllRecord(self::$tableName, $limit);
    }
    
    //Tính tổng số record
    public static function count() {
        return Model::countRecord(self::$tableName, self::$primaryKey);
    }
    

    //Lấy category theo id
    public static function getCategory($ct_id) {
        return Model::getItemById(self::$tableName, 'ct_id',$ct_id);
    }
    
    public static function getIdCategory($ct_id) {
        return Model::getIdItem(self::$tableName, $ct_id, self::$primaryKey);
    }


    //Them moi 1 category
    public static function add_category($ct_name, $ct_status) {
        $db = Database::getInstance();
        $data = array(
            'ct_name' => $ct_name,
            'ct_status' => $ct_status,
            'ct_time_created' => date("Y-m-d h:i:s"),
            'ct_time_update' => date("Y-m-d h:i:s")
        );

        $count = self::count_colum('ct_name', $ct_name);
        if ($count == 0) {
            Model::insertDataToTable(self::$tableName, $data);
            return true;
        } else {
            return false;
        }
    }


    //Sua category
    public static function edit_category($ct_id, $ct_name, $ct_status) {
        $db = Database::getInstance();
        $data = array(
            'ct_name' => $ct_name,
            'ct_status' => $ct_status,
            'ct_time_update' => date("Y-m-d h:i:s")
        );
        
        $data3 = array(
            'name' => Category::getCategory($ct_id)
        );
        
        $name = ($data3['name']['ct_name']);
        $count = Category::count_colum('ct_name', $ct_name);
        if (($count == 0) || (($count == 1) && ($ct_name == $name))) {
             Model::updateDataInTable(self::$tableName, $ct_id, self::$primaryKey, $data);
            return true;
        } else {
            return false;
        }
    }

    //Dem tong so row theo ten category
    public static function count_colum($column, $value) {
        return Model::countRowByColumn(self::$tableName, $column, $value);
    }
    
    
    //Update active
    public static function update_active($ct_id, $value) {
        $data = array(
            'ct_status' => $value,
            'ct_time_update' => date("Y-m-d h:i:s")
                
        );

        $result = Model::activeRecord(self::$tableName, $ct_id, 'ct_id', $data, $value);
        if($result) {
            return true;
        } else {
            return false;
        }
    }
    

    //Sap xep cac phan tu
    public static function sort_item($item, $typesort, $limit) {
        return Model::sort(self::$tableName, $item, $typesort, $limit);
    }


    public static function seaching_process($string, $limit=null) {
        $column = array(
            'ct_name' => 'ct_name',
            'ct_id' => 'ct_id'
        );
        return Model::searchingElement(self::$tableName, $string, $column, $limit);
    }
    
}
