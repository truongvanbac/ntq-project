<?php

class Category extends Model {

    /**
     * Table name and primary of table
     */
    protected static $tableName = 'category';
    protected static $primaryKey = 'ct_id';
    protected static $columnName = 'ct_name';


    /**
     * Get all record table
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
     * Get category by id
     */
    public static function getCategory($ct_id) {
        return self::getItemById($ct_id);
    }
    
    /**
     * Count id category by id
     */
    public static function getIdCategory($ct_id) {
        return self::getIdItem($ct_id);
    }

    /**
     * Update category contain add and edit
     */
    public static function updateCategoryProcess($data = array(), $ct_id = null) {
        return self::updateItem($data, $ct_id);
    }


    /**
     * Count record by condition
     */
    public static function count_colum($column, $value) {
        return self::countRowByColumn($column, $value);
    }
    
    
    /**
     * Active item category
     */
    public static function update_active($ct_id, $value) {
        $data = array(
            'ct_status' => $value,
            'ct_time_update' => date("Y-m-d h:i:s")
                
        );

        $result = self::activeRecord($ct_id, 'ct_id', $data, $value);
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sort category
     */
    public static function sort_item($item, $typesort, $limit) {
        return self::sort($item, $typesort, $limit);
    }

    /**
     * Search and sort data
     */

    public static function sort_search($string, $item = null, $typesort = null, $limit = null) {
        $column = array(
            'ct_name' => 'ct_name',
            'ct_id' => 'ct_id'
        );
        return self::search_sort($item, $typesort, $limit, $string, $column);
    }
}
