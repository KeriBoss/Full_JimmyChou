<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/station.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$station = new Station();
try {
    $delete = $station->delete($id);
    header('location: ../../list_station.php');
} catch (Throwable $err) {
    echo $err;
}