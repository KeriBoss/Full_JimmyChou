<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/mission_vehicle.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$mission_vehicle = new MissionVehicle();
try {
    $delete = $mission_vehicle->delete($id);
    header('location: ../../list_mission.php');
} catch (Throwable $err) {
    echo $err;
}