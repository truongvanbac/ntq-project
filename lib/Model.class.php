<?php
/**
 * Model base class
 */
class Model {

    //Sắp xếp các theo các phần tử
    protected static function sort($tableName, $item, $typesort, $limit) {
    	$db = Database::getInstance();
        $query = "select * from " . $tableName . " order by ". $item ." ".$typesort . " " . $limit;
        $result = $db->query($query);
        return $result->fetchAll();
    }

    //Đếm tổng số phần tử
    protected static function countRecord($tableName, $column) {
        $db = Database::getInstance();
        $query = "select count($column) from " . $tableName;
        $s = $db->query($query);
        $result = $s->fetchColumn();
        return $result;
    }

    //Lấy toàn bộ dữ liệu cảu bảng
    protected static function getAllRecord($tableName, $limit) {
        $db = Database::getInstance();
        $query = "select * from " . $tableName ." ". $limit;
        $s = $db->query($query);
        $result = $s->fetchAll();
        return $result;
    }

    //Update active record
    protected static function activeRecord($tableName, $item_id, $column, $data = array(), $value) {
        $db = Database::getInstance();
        $query = "UPDATE $tableName SET ";
        foreach ($data as $key => $value) {
            $query .= $key . " = '" . $value . "', ";
        }
        $query = rtrim($query, ' ,');
        $query .= " WHERE $column = " . $item_id;
        //var_dump($query);
        $s = $db->prepare($query);
        $s->execute();
        return $s->rowCount();
    }

    //Đếm số record
    protected static function countRowByColumn($tableName, $column, $value) {
        $db = Database::getInstance();
        $query = "select count($column) from " . $tableName ." where $column = '" . $value . "'";
        $s = $db->query($query);
        $result = $s->fetchColumn();
        return $result;
    }

    //Lấy category theo id
    protected static function getItemById($tableName, $column, $item_id) {
        $db = Database::getInstance();
        $query = "select * from $tableName where $column = '" . $item_id . "'";
        $s = $db->query($query);
        $result = $s->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //Tìm kiếm phần tử
    protected static function searchingElement($tableName, $string, $column = array(), $limit = null) {
        $data = array();
        $data = explode(' ', $string);
        $db = Database::getInstance();
        $query = "select * from $tableName where ";
        foreach ($data as $key => $value) {
            foreach ($column as $k => $v) {
                $query .= $v . " like '%" . $value . "' or " . $v . " like '" . $value . "%' or "; 
            }
        }
        $query = rtrim($query, ' or');
        $query .= " " . $limit;
        $s = $db->prepare($query);
        $s->execute();
        $dataResult = array();
        $dataResult['result'] = $s->fetchAll();
        $dataResult['count'] = $s->rowCount();
        return $dataResult;
    }

    //Function insert dữ liệu vào bảng
    protected static function insertDataToTable($tableName, $data = array()) {
        $db = Database::getInstance();
        $query = "INSERT INTO " . $tableName . "(";
        foreach ($data as $key => $value) {
            $query .= $key . ", ";
        }

        $query = rtrim($query, ' ,');
        $query .= ") VALUES(";
        foreach ($data as $key => $value) {
            $query .= ":" . $key . ", ";
        }

        $query = rtrim($query, ' ,');
        $query .= ")";
        
        $s = $db->prepare($query);
        $s->execute($data);
    }

    //Function update dữ liệu của bảng
    protected static function updateDataInTable($tableName, $id, $column, $data = array()) {
        $db = Database::getInstance();
        $query = "UPDATE " . $tableName . " SET ";
        foreach ($data as $key => $value) {
            $query .= $key . " = :" . $key . ", "; 
        }
        $query = rtrim($query, ' ,');
        $query .= " WHERE " . $column . " = " . $id;
        $s = $db->prepare($query);
        $s->execute($data);
    }

    //Kiem tra id cua item
    protected static function getIdItem($tableName, $id, $column) {
        $db = Database::getInstance();
        $query = "SELECT count($column) FROM $tableName WHERE $column = '$id'";
        $s = $db->query($query);
        return $s->fetchColumn();
    }

}