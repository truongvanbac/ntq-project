<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
class Category extends Model {
    
    protected static $tableName = 'category';
    protected static $primaryKey = 'ct_id';
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function get_list_category() {
        $db = Database::getInstance();
        $query = "select * from category";
        $s = $db->query($query);
        $result = $s->fetchAll();
        return $result;
    }
    
    public static function add_category($ct_name, $ct_status) {
        
        $data = array(
            ':ct_name' => $ct_name,
            ':ct_status' => $ct_status,
            ':time' => date("Y-m-d h:i:s")
        );
        
        $db = Database::getInstance();
        $query = "INSERT INTO category(ct_name, ct_status, ct_time_created) VALUES(:ct_name, :ct_status, :time)";
        
        //var_dump($query);
        $stmp = $db->prepare($query);
        $result = $stmp->execute($data);
        if($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function edit_category($ct_id, $ct_name, $ct_status) {
        $data = array(
            ':ct_id' => $ct_id,
            ':ct_name' => $ct_name,
            ':ct_status' => $ct_status,
            ':time' => date("Y-m-d h:i:s")
        );
        
        $db = Database::getInstance();
        $query = "UPDATE category SET ct_name = :ct_name, ct_status = :ct_status,"
                . " ct_time_update = :time WHERE ct_id = :ct_id";
        
        $stmp = $db->prepare($query);
        $result = $stmp->execute($data);
        if($result) {
            return true;
        } else {
            return false;
        }
        
    }
    
    
    public static function get_name_ct($ct_id) {
        $db = Database::getInstance();
        $query = "select * from category where ct_id = ".$ct_id;
        $result = $db->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
        
    }
}

