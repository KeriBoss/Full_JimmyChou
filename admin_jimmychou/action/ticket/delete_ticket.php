<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/ticket.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$ticket = new Ticket();
try {
    $delete = $ticket->delete($id);
    header('location: ../../list_ticket.php');
} catch (Throwable $err) {
    echo $err;
}