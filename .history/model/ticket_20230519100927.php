<?php
require_once "database.php";
class Ticket extends Database{
    /**
     * Funtion get All station
     */
    function getAllTicket(){
        $sql = parent::$connection->prepare("SELECT *,ticket.id as ticket_id, transport.id as ID_transport, vehicle.id as ID_vehicle, location.id as ID_location, transport.name as transport_name, vehicle.name as vehicle_name  FROM ticket INNER JOIN transport on ticket.transport_id = transport.id INNER JOIN location ON ticket.location_id = location.id INNER JOIN vehicle ON ticket.vehicle_id = vehicle.id order by ticket.id desc");
        return parent::select($sql);
    }
    /**
     * Insert new station in database
     */
    function insert($transport_id, $vehicle_id, $location_id, $date_duration, $time_duration, $price){
        $sql = parent::$connection->prepare("INSERT INTO `ticket`(`transport_id`, `vehicle_id`, `location_id`, `date_duration`, `time_duration`, `price`) VALUES (?,?,?,?,?,?)");
        $sql->bind_param('iiissi', $transport_id, $vehicle_id, $location_id, $date_duration, $time_duration, $price);
        return $sql->execute();
    }
    /**
     * function update station by id
     */
    function update($id, $transport_id, $vehicle_id, $location_id, $date_duration, $time_duration, $price){
        $sql = parent::$connection->prepare("UPDATE `ticket` SET `transport_id`= ? ,`vehicle_id`= ? ,`location_id`= ?, `date_duration` = ?, `time_duration` = ?, `price` = ? WHERE `id` = ?");
        $sql->bind_param('iiissii', $transport_id, $vehicle_id, $location_id, $date_duration, $time_duration, $price, $id);
        return $sql->execute();
    }
    /**
     * Delete station by id
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `ticket` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    /**
     * get station by id
     */
    function getTicketById($id){
        $sql = parent::$connection->prepare("SELECT *,ticket.id as ticket_id, transport.id as ID_transport, vehicle.id as ID_vehicle, location.id as ID_location, transport.name as transport_name, vehicle.name as vehicle_name  FROM ticket INNER JOIN transport on ticket.transport_id = transport.id INNER JOIN location ON ticket.location_id = location.id INNER JOIN vehicle ON ticket.vehicle_id = vehicle.id WHERE ticket.id = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    /**
     * Funtion get All ticket for user
     */
    function getAllTicketForUser(){
        $sql = parent::$connection->prepare("SELECT *,ticket.id as ticket_id, transport.id as ID_transport, vehicle.id as ID_vehicle, location.id as ID_location, transport.name as transport_name, vehicle.name as vehicle_name  FROM ticket INNER JOIN transport on ticket.transport_id = transport.id INNER JOIN location ON ticket.location_id = location.id INNER JOIN vehicle ON ticket.vehicle_id = vehicle.id INNER JOIN agency ON vehicle.agency_id = agency.id order by ticket.id desc");
        return parent::select($sql);
    }
    /**
     * Search ticket in date
     */
    function searchTicker($f_location, $l_location, $start_date, $end_date){
        $sql = parent::$connection->prepare("SELECT * FROM ticket WHERE product_name LIKE ?");
        $search = "%{$keyword}%";
        $sql->bind_param('s', $search);
        return parent::select($sql);
    }
}