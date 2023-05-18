<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/station.php";

<<<<<<< HEAD
if(isset($_POST['location_id']) && isset($_POST['point_pick']) && isset($_POST['point_drop']) && isset($_POST['status'])){
=======
if(isset($_POST['location_id']) && isset($_POST['point_pick']) && isset($_POST['point_drop']) && isset($_POST['departure_time']) && isset($_POST['status'])){
>>>>>>> cac92693fe3f5b19c5e4e05e30f9473371b1cb2c
    $station_id = $_POST['station_id'];
    $location_id = $_POST['location_id'];
    $point_pick = $_POST['point_pick'];
    $point_drop = $_POST['point_drop'];
<<<<<<< HEAD
=======
    $departure_time = $_POST['departure_time'];
>>>>>>> cac92693fe3f5b19c5e4e05e30f9473371b1cb2c
    $status = $_POST['status'];
}

$station = new Station();
try{
<<<<<<< HEAD
    $update = $station->update($station_id,$point_pick,$point_drop,$status,$location_id);
=======
    $update = $station->update($station_id,$point_pick,$point_drop,$departure_time ,$status,$location_id);
>>>>>>> cac92693fe3f5b19c5e4e05e30f9473371b1cb2c
    header('location: ../../list_station.php');
} catch(Throwable $err){
    echo $err;
}