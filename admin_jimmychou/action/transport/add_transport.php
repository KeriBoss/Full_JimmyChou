<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/transport.php";

$transport = new Transport();

if(isset($_POST['name']) && isset($_POST['subtitle']) && isset($_POST['icon_transport']) && isset($_POST['trip_type']) && isset($_POST['status'])){
    $name = $_POST['name'];
    $subtitle = $_POST['subtitle'];
    $icon_transport = $_POST['icon_transport'];
    $trip_type = $_POST['trip_type'];
    $status = $_POST['status'];
    // var_dump($name, $subtitle, $icon_transport, $trip_type, $status);die();
    try{
        $insert = $transport->insert($name, $icon_transport, $subtitle, $status, $trip_type);
        header('location: ../../list_transport.php');
    } catch(Throwable $err){
        echo $err;
    }
}