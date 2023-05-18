<?php
session_start();
require_once  "../model/config.php";
require_once "../model/database.php";
require_once  "../model/vehicle.php";

$vehicle = new Vehicle();

// var_dump($_POST['id_transport']);die();
if(isset($_GET['vehicle_id']) ){
    $vehicle_id = $_GET['vehicle_id'];
    $getVehicleById = $vehicle->getVehicleById($vehicle_id);
}

echo json_encode($getVehicleById);