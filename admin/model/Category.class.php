<?php

date_default_timezone_set("Asia/Ho_Chi_Minh");

class Category extends Model {

    protected static $tableName = 'category';
    protected static $primaryKey = 'ct_id';

    public static function get_list_category() {
        $db = Database::getInstance();
        $query = "select * from category";
        $s = $db->query($query);
        $result = $s->fetchAll();
        return $result;
    }

    public static function add_category($ct_name, $ct_status) {
        $db = Database::getInstance();
        $data = array(
            ':ct_name' => $ct_name,
            ':ct_status' => $ct_status,
            ':time' => date("Y-m-d h:i:s")
        );

        $data2 = array(
            ':ct_name' => $ct_name
        );

//        $check = "select count(ct_name) from category where ct_name = :ct_name";
//        $s = $db->prepare($check);
//        $s->execute($data2);
//        $count = $s->fetchColumn();
        $count = self::count_colum('ct_name', $data2);
        if ($count == 0) {
            $query = "INSERT INTO category(ct_name, ct_status, ct_time_created) VALUES(:ct_name, :ct_status, :time)";
            //var_dump($query);
            $stmp = $db->prepare($query);
            $stmp->execute($data);
            return true;
        } else {
            return false;
        }
    }

    public static function edit_category($ct_id, $ct_name, $ct_status) {
        $db = Database::getInstance();
        $data = array(
            ':ct_id' => $ct_id,
            ':ct_name' => $ct_name,
            ':ct_status' => $ct_status,
            ':time' => date("Y-m-d h:i:s")
        );
        $data2 = array(
            ':ct_name' => $ct_name
        );
        
        $data3 = array(
            'name' => Category::get_name_ct($ct_id)
        );
        
        $name = implode('', array_values($data3['name']));
        
//        $check = "select count(ct_name) from category where ct_name = :ct_name";
//        $s = $db->prepare($check);
//        $s->execute($data2);
//        $count = $s->fetchColumn();
        $count = Category::count_colum('ct_name', $data2);
        if (($count == 0) || (($count == 1) && ($ct_name == $name))) {
            $query = "UPDATE category SET ct_name = :ct_name, ct_status = :ct_status,"
                    . " ct_time_update = :time WHERE ct_id = :ct_id";

            $stmp = $db->prepare($query);
            $stmp->execute($data);
            return true;
        } else {
            return false;
        }
    }

    public static function get_name_ct($ct_id) {
        $db = Database::getInstance();
        $query = "select ct_name from category where ct_id = " . $ct_id;
        $result = $db->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function count_colum($colum, $data = array()) {
        $db = Database::getInstance();
        $check = "select count($colum) from category where $colum = :$colum";
        $s = $db->prepare($check);
        $s->execute($data);
        return $s->fetchColumn();
    }

}
