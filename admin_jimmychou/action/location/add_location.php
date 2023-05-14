<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/location.php";

$location = new Location();

if(isset($_POST['location_pick']) && isset($_POST['location_drop']) && isset($_POST['status'])){
    $location_pick = $_POST['location_pick'];
    $location_drop = $_POST['location_drop'];
    $status = $_POST['status'];
    try{
        $insert = $location->insert($location_pick, $location_drop, $status);
        header('location: ../../list_location.php');
    } catch(Throwable $err){
        echo $err;
    }
}