<?php
require_once __DIR__."./database.php";
class Station extends Database{
    /**
     * Funtion get All station
     */
    function getAllStation(){
        $sql = parent::$connection->prepare("SELECT *, `station`.`location_id` as location_id, `station`.`id` as id, `location`.id as idLo, station.status as status from `station`, `location` WHERE `station`.`location_id` = `location`.`id` order by `station`.id DESC");
        return parent::select($sql);
    }
    /**
     * Insert new station in database
     */
    function insert($point_pick, $point_drop, $departure_time, $location_id, $status){
        $sql = parent::$connection->prepare("INSERT INTO `station`(`point_pick`, `point_drop`, `departure_time`, `location_id`, `status`) VALUES (?,?,?,?,?)");
        $sql->bind_param('sssii', $point_pick, $point_drop, $departure_time, $location_id, $status);
        return $sql->execute();
    }
    /**
     * function update station by id
     */
    function update($id, $point_pick, $point_drop, $departure_time, $status, $location_id){
        $sql = parent::$connection->prepare("UPDATE `station` SET `point_pick`= ? ,`point_drop`= ? ,`departure_time`= ?, `status` = ?, `location_id` = ? WHERE `id` = ?");
        $sql->bind_param('sssiii', $point_pick, $point_drop, $departure_time, $status, $location_id, $id);
        return $sql->execute();
    }
    /**
     * Delete station by id
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `station` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    /**
     * get station by id
     */
    function getStationById($id){
        $sql = parent::$connection->prepare("SELECT * FROM `station`,`location` WHERE `station`.`location_id` = location.id and `station`.`id` = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
}