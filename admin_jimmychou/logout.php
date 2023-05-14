<?php
session_start();
require_once "../model/config.php";
require_once "../model/database.php";

if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
}
header("location: ./login.php");