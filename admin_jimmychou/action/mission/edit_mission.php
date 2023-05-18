<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/mission_vehicle.php";

$mission = new MissionVehicle();
$getAll = $mission->getAllMission();

if(isset($_POST['id_vehicle']) && isset($_POST['id_location']) && isset($_POST['mission_id'])){
    $id_vehicle = $_POST['id_vehicle'];
    $id_location = $_POST['id_location'];
    $mission_id = $_POST['mission_id'];

    try{
        $check = true;
        foreach($getAll as $item){
            if($item['vehicle_id'] == $id_vehicle && $item['location_id'] == $id_location){
                $check = false;
                break;
            }
            else{
                $check = true;
            }
        }
        if($check == true){
            $update = $mission->update($mission_id,$id_vehicle,$id_location);
        }
        header('location: ../../list_mission.php');
    } catch(Throwable $err){
        echo $err;
    }
}