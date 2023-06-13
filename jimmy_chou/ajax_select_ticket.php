<?php
session_start();
require_once  "../model/config.php";
require_once "../model/database.php";
require_once  "../model/ticket.php";
require_once  "../model/vehicle.php";

if(isset($_GET['ticket_id'])){
    $ticket_id = $_GET['ticket_id'];

    $ticket = new Ticket();
    $getTicketById = $ticket->getTicketById($ticket_id);

    $vehicle = new Vehicle();
    $getDiagramByid = $vehicle->getDiagramByid($getTicketById[0]['ID_vehicle']);

    $arr = [];
}
echo json_encode($getTicketById[0]);