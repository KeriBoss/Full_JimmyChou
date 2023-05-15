<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/station.php";

if(isset($_POST['location_id']) && isset($_POST['point_pick']) && isset($_POST['point_drop']) && isset($_POST['departure_time']) && isset($_POST['status'])){
    $station_id = $_POST['station_id'];
    $location_id = $_POST['location_id'];
    $point_pick = $_POST['point_pick'];
    $point_drop = $_POST['point_drop'];
    $departure_time = $_POST['departure_time'];
    $status = $_POST['status'];
}

$station = new Station();
try{
    $update = $station->update($station_id,$point_pick,$point_drop,$departure_time ,$status,$location_id);
    header('location: ../../list_station.php');
} catch(Throwable $err){
    echo $err;
}