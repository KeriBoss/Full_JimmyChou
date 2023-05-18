<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/ticket.php";

$ticket = new Ticket();

if(isset($_POST['id_transport']) && isset($_POST['id_vehicle']) && isset($_POST['id_location']) && isset($_POST['date_duration']) && isset($_POST['time_duration']) && isset($_POST['price'])){
    $id_transport = $_POST['id_transport'];
    $id_vehicle = $_POST['id_vehicle'];
    $id_location = $_POST['id_location'];
    $date_duration = $_POST['date_duration'];
    $time_duration = $_POST['time_duration'];
    $price = $_POST['price'];

    try{
        $insert = $ticket->insert($id_transport,$id_vehicle,$id_location,$date_duration,$time_duration,$price);
        header('location: ../../list_ticket.php');
    } catch(Throwable $err){
        echo $err;
    }
}