<?php
session_start();
require_once "../../jPath.php";
require_once "../../../model/config.php";
require_once "../../../model/database.php";
require_once "../../../model/vehicle.php";


$target_dir =  "../../../jimmy_chou/images/vehicle/";
$target_name_file = basename($_FILES["thumbnail"]["name"]);

if($target_name_file == ''){
    $target_name_file = $_POST['name_img_product'];
}
$target_file = $target_dir . $target_name_file;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["thumbnail"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
        $image = $target_name_file;
    } 
    // else {
    //     echo "Sorry, there was an error uploading your file.";
    // }
    $image = $target_name_file;
}

$vehicle = new Vehicle();

if(isset($_POST['diagram'])){
    $diagram = json_decode($_POST['diagram']);
}
if(isset($_POST['vehicle_id']) && isset($_POST['name']) && isset($_POST['license_plate']) && isset($_POST['seat']) && isset($_POST['floor']) && isset($_POST['agency'])){
    $vehicle_id = $_POST['vehicle_id'];
    $name = $_POST['name'];
    $license_plate = $_POST['license_plate'];
    $seat = $_POST['seat'];
    $floor = $_POST['floor'];
    $agency = $_POST['agency'];
    $diagram = json_decode($_POST['diagram']);

    try{
        $update = $vehicle->update($vehicle_id, $name, $image, $license_plate, $seat, $floor, $agency);
        if($update){
            $getDiagramByid = $vehicle->getDiagramByid($vehicle_id);
            foreach($getDiagramByid as $item){
                if(check($item, $diagram) === true){
                    
                }else if(check($item, $diagram) === false){
                    $deleteDiagramById = $vehicle->deleteDiagramById($vehicle_id,$item['floor'],$item['row'],$item['col']);
                }
            }
            foreach($diagram as $item){
                if(checkInsert($item, $getDiagramByid) === false){
                    $insertDiagram = $vehicle->insertDiagram($vehicle_id,$item[0],$item[1],$item[2]);
                }
            }
        }
        header('location: ../../list_vehicle.php');
    } catch(Throwable $err){
        echo $err;
    }
}
function check($arr = [], $value = []){
    $check = false;
    foreach($value as $item){
        //Check value: floor, row, col of user equal with database ? null : delete
        if($item[0] == $arr['floor'] && $item[1] == $arr['row'] && $item[2] == $arr['col']){
            return $check = true;
        }
    }
    return $check;
}
function checkInsert($arr = [], $value = []){
    $check = false;
    foreach($value as $item){
        //Check value: floor, row, col of user equal with database ? null : insert
        if($arr[0] == $item['floor'] && $arr[1] == $item['row'] && $arr[2] == $item['col']){
            return $check = true;
        }
    }
    return $check;
}