<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/location.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$location = new Location();
try {
    $delete = $location->delete($id);
    header('location: ../../list_vehicle.php');
} catch (Throwable $err) {
    echo $err;
}