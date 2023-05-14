<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/location.php";

if(isset($_POST['location_id']) && isset($_POST['location_pick']) && isset($_POST['location_drop']) && isset($_POST['status'])){
    $id = $_POST['location_id'];
    $location_pick = $_POST['location_pick'];
    $location_drop = $_POST['location_drop'];
    $status = $_POST['status'];
}

$location = new Location();
try{
    $update = $location->update($id,$location_pick,$location_drop,$status);
    header('location: ../../list_location.php');
} catch(Throwable $err){
    echo $err;
}