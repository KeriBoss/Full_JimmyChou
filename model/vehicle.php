<?php
require_once "database.php";
class Vehicle extends Database{
    /**
     * Get all vehicle
     */
    function getAllVehicle(){
        $sql = parent::$connection->prepare("Select *,vehicle.id as id_vehicle from vehicle, agency where vehicle.agency_id = agency.id order by vehicle.id DESC");
        return parent::select($sql);
    }
    /**
     * insert new vehicle
     */
    function insert($name, $image, $license_plate, $seat, $floor, $agency_id){
        $sql = parent::$connection->prepare("INSERT INTO `vehicle`(`name`, `image`, `license_plate`, `seat`, `floor`, `agency_id`) VALUES (?,?,?,?,?,?)");
        $sql->bind_param('sssiii', $name, $image, $license_plate, $seat, $floor, $agency_id);
        if($sql->execute() === true){
            return self::$connection->insert_id;
        }
    }
    /**
     * Update vehicle by id
     */
    function update($id, $name, $image, $license_plate, $seat, $floor, $agency_id){
        $sql = parent::$connection->prepare("UPDATE `vehicle` SET `name`= ? ,`image`= ? ,`license_plate`= ? ,`seat`= ? ,`floor`= ? ,`agency_id`= ?   WHERE `id` = ?");
        $sql->bind_param('sssiiii', $name, $image, $license_plate, $seat, $floor, $agency_id, $id);
        return $sql->execute();
    }
    /**
     * Delete vehicle
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `vehicle` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    /**
     * Update diagram seat vehicle by id
     */
    function updateDiagram($id, $floor, $row, $col){
        $sql = parent::$connection->prepare("UPDATE `vehicle` SET  `floor`= ? ,`row`= ? , `col`= ?  WHERE `vehicle_id` = ?");
        $sql->bind_param('iiii', $floor, $row, $col, $id);
        return $sql->execute();
    }
    /**
     * get vehicle by id
     */
    function getVehicleById($id){
        $sql = parent::$connection->prepare("Select * from vehicle where id = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    /**
     * Insert diagram seat
     */
    function insertDiagram($vehicle_id, $floor, $row, $col){
        $sql = parent::$connection->prepare("INSERT INTO `diagram_seat`(`vehicle_id`, `floor`, `row`, `col`) VALUES (?,?,?,?)");
        $sql->bind_param('iiii', $vehicle_id, $floor, $row, $col);
        return $sql->execute();
    }
    /**
     * Get diagram by id vehicle
     */
    function getDiagramByid($vehicle_id){
        $sql = parent::$connection->prepare("Select * from diagram_seat where vehicle_id = ?");
        $sql->bind_param('i', $vehicle_id);
        return parent::select($sql);
    }
    /**
     * Delete all diagram seat of vehicle
     */
    function deleteDiagramById($id,$floor,$row,$col){
        $sql = parent::$connection->prepare("DELETE FROM `diagram_seat` WHERE `vehicle_id` = ? AND `floor` = ? AND `row` = ? AND `col` = ?");
        $sql->bind_param('iiii', $id,$floor,$row,$col);
        return $sql->execute();
    }
    /**
     * Delete all diagram seat of 1 vehicle when it is delete 
     */
    function deleteDiagramOfVehicle($vehicle_id){
        $sql = parent::$connection->prepare("DELETE FROM `diagram_seat` WHERE `vehicle_id` = ?");
        $sql->bind_param('i', $vehicle_id);
        return $sql->execute();
    }
}