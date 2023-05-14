<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/station.php";

$station = new Station();

if(isset($_POST['point_pick']) && isset($_POST['point_drop']) && isset($_POST['departure_time']) && isset($_POST['location_id']) && isset($_POST['status'])){
    $point_pick = $_POST['point_pick'];
    $point_drop = $_POST['point_drop'];
    $departure_time = $_POST['departure_time'];
    $location_id = $_POST['location_id'];
    $status = $_POST['status'];
    try{
        $insert = $station->insert($point_pick, $point_drop, $departure_time, $location_id, $status);
        header('location: ../../list_station.php');
    } catch(Throwable $err){
        echo $err;
    }
}