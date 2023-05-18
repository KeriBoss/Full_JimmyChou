<?php
include "./header.php";
require_once "../model/location.php";
require_once "../model/vehicle.php";
require_once "../model/mission_vehicle.php";

if (isset($_GET['id'])) {
    $id = $_GET['id']; //Get id of location
}
$mission_vehicle = new MissionVehicle();
$getMissionById = $mission_vehicle->getMissionById($id);

$vehicle = new Vehicle();
$getAllVehicle = $vehicle->getAllVehicle();

$location = new Location();
$getAllLocation = $location->getAllLocation();

//get all location in database

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa vé chuyến đi</h1>
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="p-4 d-flex justify-content-start align-items-center">
            <form action="action/mission/edit_mission.php" method="post" enctype="multipart/form-data">
                <input type="number" name="mission_id" class="form-control" value="<?= $id ?>" hidden>
                <div class="form-group">
                    <div class="row mb-3">
                        <div class="col-lg-6 col-md-12 col-12">
                            <label for="id_vehicle"><b>Chọn phương tiện*</b></label>
                            <select name="id_vehicle" id="mission_vehicle" class="form-control">
                                <?php foreach($getAllVehicle as $item){
                                    if($getMissionById[0]['vehicle_id'] == $item['id']){
                                    ?>
                                    <option value="<?=$item['id']?>" selected><?=$item['name']?></option>
                                <?php }else{ ?>
                                    <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                <?php } }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div id="content_vehicle"></div>
                </div>
                <div class="form-group">
                    <label><b>Chọn lộ trình*</b></label>
                    <select name="id_location" class="form-control">
                        <?php foreach($getAllLocation as $item){ 
                            if($getMissionById[0]['location_id'] == $item['id']){
                            ?>
                            <option value="<?=$item['id']?>" selected><b>Từ:</b> <?=$item['location_pick']?>, <b>đến:</b>  <?=$item['location_drop']?></option>
                        <?php }else{ ?>
                            <option value="<?=$item['id']?>"><b>Từ:</b> <?=$item['location_pick']?>, <b>đến:</b>  <?=$item['location_drop']?></option>
                        <?php } }?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Chỉnh Sửa</button>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    for (var i = 0; i < document.querySelectorAll('.optionDiv').length; i++) {
        if (document.querySelectorAll('.optionDiv')[i].value == '<?= $getAllStation[0]['status']; ?>') {
            document.querySelectorAll('.optionDiv')[i].selected = true;
            break;
        }
    }
</script>
<?php
include "./footer.php";
?>