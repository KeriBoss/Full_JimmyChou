<?php
require_once __DIR__."./database.php";
class Transport extends Database{
    /**
     * Funtion get All transport
     */
    function getAllTransport(){
        $sql = parent::$connection->prepare("SELECT * from transport order by id DESC");
        return parent::select($sql);
    }
    /**
     * Insert new station in database
     */
    function insert($name, $icon_transport, $subtitle, $status, $trip_type){
        $sql = parent::$connection->prepare("INSERT INTO `transport`(`name`, `icon`, `subtitle`, `status`, `trip_type`) VALUES (?,?,?,?,?)");
        $sql->bind_param('sssii', $name, $icon_transport, $subtitle, $status, $trip_type);
        return $sql->execute();
    }
    /**
     * function update station by id
     */
    function update($id, $name, $icon_transport, $subtitle, $status, $trip_type){
        $sql = parent::$connection->prepare("UPDATE `transport` SET `name`= ? ,`icon`= ? ,`subtitle`= ? ,`status`= ? ,`trip_type`= ?  WHERE `id` = ?");
        $sql->bind_param('sssiii', $name, $icon_transport, $subtitle, $status, $trip_type, $id);
        return $sql->execute();
    }
    /**
     * Delete station by id
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `transport` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    /**
     * get station by id
     */
    function getTransportById($id){
        $sql = parent::$connection->prepare("SELECT * FROM `transport` WHERE id = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
}