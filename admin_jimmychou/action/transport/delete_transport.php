<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/transport.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$transport = new Transport();
try {
    $delete = $transport->delete($id);
    header('location: ../../list_transport.php');
} catch (Throwable $err) {
    echo $err;
}