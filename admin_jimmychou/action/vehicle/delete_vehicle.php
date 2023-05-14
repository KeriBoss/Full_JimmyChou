<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/vehicle.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$vehicle = new Vehicle();
try {
    $delete = $vehicle->delete($id);
    if($delete){
        $deleteDiagramOfVehicle = $vehicle->deleteDiagramOfVehicle($id);
    }
    header('location: ../../list_vehicle.php');
} catch (Throwable $err) {
    echo $err;
}