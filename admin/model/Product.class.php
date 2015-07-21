<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Product extends Model {
    
    /**
     * Table name and primary table
     */
    protected static $tableName = 'product';
    protected static $primaryKey = 'pd_id';
    protected static $columnName = 'pd_name';


    /**
     * Get all record of product table
     */
    public static function get_list($limit) {
        return Product::getAllRecord($limit);
    }
    
    /**
     * Count all record of product table
     */
    public static function count() {
        return Product::countRecord();
    }
    
    
    /**
     * Get Product by id
     */
    public static function getProduct($pd_id) {
        return Product::getItemById($pd_id);
    }

    public static function getIdProduct($pd_id) {
        return Product::getIdItem($pd_id);
    }
    
    /**
     * Update product contain add and edit
     */
    public static function updateProductProcess($data = array(), $pd_id = null) {
        return Product::updateItem($data, $pd_id);
    }

    
    /**
     * Count record by condition
     */
    public static function count_colum($column, $value) {
        return Product::countRowByColumn($column, $value);
    }

    /**
     * Active record
     */
    public static function update_active($pd_id, $value) {
        $db = Database::getInstance();
        $data = array(
            'pd_status' => $value,
            'pd_time_updated' => date("Y-m-d h:i:s")
                
        );

        $result = Product::activeRecord($pd_id, 'pd_id', $data, $value);
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sord record
     */
    public static function sort_item($item, $typesort, $limit) {
        return Product::sort($item, $typesort, $limit);
    }

    /**
     * delete image
     */
    public static function remove_image($pd_id, $data = array()) {
        foreach ($data as $value) {
            $dataImg['pd_img' . $value] = NULL;
            deleteFile(Product::getProduct($pd_id)['pd_img' . $value]);
        }
        return Product::deteleItem($pd_id, $dataImg);
    }

    /**
     * Search and sort data
     */
    public static function sort_search($string, $item = null, $typesort = null, $limit = null) {
        $column = array(
            'pd_name' => 'pd_name',
            'pd_price' => 'pd_price',
            'pd_id' => 'pd_id'
        );
        return Product::search_sort($item, $typesort, $limit, $string, $column);
    }
}