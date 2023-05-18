<?php
require_once "database.php";
class Location extends Database{
    /**
     * Get all location
     */
    function getAllLocation(){
        $sql = parent::$connection->prepare("Select * from location");
        return parent::select($sql);
    }
    /**
     * insert new location
     */
    function insert($location_pick, $location_drop, $status){
        $sql = parent::$connection->prepare("INSERT INTO `location`(`location_pick`, `location_drop`, `status`) VALUES (?,?,?)");
        $sql->bind_param('ssi', $location_pick, $location_drop, $status);
        return $sql->execute();
    }
    /**
     * Update location by id
     */
    function update($id, $location_pick, $location_drop, $status){
        $sql = parent::$connection->prepare("UPDATE `location` SET `location_pick`= ? ,`location_drop`= ? ,`status`= ?  WHERE `id` = ?");
        $sql->bind_param('ssii', $location_pick, $location_drop, $status, $id);
        return $sql->execute();
    }
    /**
     * get location by id
     */
    function getLocationById($id){
        $sql = parent::$connection->prepare("Select * from location where id = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    /**
     * Delete location by Id
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `location` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
}