<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/transport.php";

if(isset($_POST['name']) && isset($_POST['subtitle']) && isset($_POST['icon_transport']) && isset($_POST['trip_type']) && isset($_POST['status'])){
    $transport_id = $_POST['transport_id'];
    $name = $_POST['name'];
    $subtitle = $_POST['subtitle'];
    $icon_transport = $_POST['icon_transport'];
    $trip_type = $_POST['trip_type'];
    $status = $_POST['status'];
}
    // var_dump($name, $subtitle, $icon_transport, $trip_type, $status);die();
$transport = new Transport();
try{
    $update = $transport->update($transport_id,$name, $icon_transport, $subtitle, $status, $trip_type);
    header('location: ../../list_transport.php');
} catch(Throwable $err){
    echo $err;
}