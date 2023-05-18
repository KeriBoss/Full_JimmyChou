<?php
require_once "database.php";
class MissionVehicle extends Database{
    /**
     * Funtion get All station
     */
    function getAllMission(){
        $sql = parent::$connection->prepare("SELECT *,misstion_vehicle.id as mission_id, location.id as ID_location, vehicle.id as ID_vehicle FROM `misstion_vehicle` INNER JOIN vehicle on misstion_vehicle.vehicle_id = vehicle.id INNER JOIN location ON location.id = misstion_vehicle.location_id order by misstion_vehicle.id desc");
        return parent::select($sql);
    }
    /**
     * Insert new station in database
     */
    function insert($vehicle_id, $location_id){
        $sql = parent::$connection->prepare("INSERT INTO `misstion_vehicle`(`vehicle_id`, `location_id`) VALUES (?,?)");
        $sql->bind_param('ii',$vehicle_id, $location_id);
        return $sql->execute();
    }
    /**
     * function update station by id
     */
    function update($id, $vehicle_id, $location_id){
        $sql = parent::$connection->prepare("UPDATE `misstion_vehicle` SET `vehicle_id`= ? ,`location_id`= ? WHERE `id` = ?");
        $sql->bind_param('iii',$vehicle_id, $location_id, $id);
        return $sql->execute();
    }
    /**
     * Delete station by id
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `misstion_vehicle` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    /**
     * get station by id
     */
    function getMissionById($id){
        $sql = parent::$connection->prepare("SELECT *,misstion_vehicle.id as mission_id, location.id as ID_location, vehicle.id as ID_vehicle FROM `misstion_vehicle` INNER JOIN vehicle on misstion_vehicle.vehicle_id = vehicle.id INNER JOIN location ON location.id = misstion_vehicle.location_id WHERE misstion_vehicle.id = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
}