<?php
require_once "database.php";
class Agency extends Database{
    /**
     * Get all location
     */
    function getAllAgency(){
        $sql = parent::$connection->prepare("Select * from agency order by id DESC");
        return parent::select($sql);
    }
    /**
     * insert new location
     */
    function insert($name, $image, $description){
        $sql = parent::$connection->prepare("INSERT INTO `agency`(`agency_name`, `img_logo`, `description`) VALUES (?,?,?)");
        $sql->bind_param('sss', $name, $image, $description);
        return $sql->execute();
    }
    /**
     * Update location by id
     */
    function update($id, $name, $image, $description){
        $sql = parent::$connection->prepare("UPDATE `agency` SET `agency_name`= ?, `img_logo` = ?,`description`= ? WHERE id = ?;");
        
        $sql->bind_param('sssi', $name, $image, $description, $id);
        return $sql->execute();
    }
    /**
     * Delete agency by Id
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `agency` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    /**
     * get location by id
     */
    function getAgencyById($id){
        $sql = parent::$connection->prepare("Select * from agency where id = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
}