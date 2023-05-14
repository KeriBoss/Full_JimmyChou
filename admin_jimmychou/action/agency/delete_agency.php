<?php
session_start();
require_once  "../../../model/config.php";
require_once "../../../model/database.php";
require_once  "../../../model/agency.php";

if(isset($_GET['id'])){
    $agency_id = $_GET['id'];
}

$agency = new Agency();
try {
    $delete = $agency->delete($agency_id);
    header('location: ../../list_agency.php');
} catch (Throwable $err) {
    echo $err;
}