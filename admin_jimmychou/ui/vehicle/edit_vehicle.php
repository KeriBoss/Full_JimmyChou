<?php
include "../../header.php";
require_once "../../../model/vehicle.php";
require_once "../../../model/agency.php";

if (isset($_GET['id'])) {
    $id = $_GET['id']; //Get id of location
}

$vehicle = new Vehicle();
$getVehicleById = $vehicle->getVehicleById($id);
$getDiagramByid = $vehicle->getDiagramByid($id);

$agency = new Agency();
$getAllAgency = $agency->getAllAgency();

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thông tin phương tiện</h1>
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="p-4 d-flex justify-content-start align-items-center"><!-- Modal content -->
                <div class="modal-content">
                    <form action="<?=$url?>/action/vehicle/edit_vehicle.php" method="post" class="w-75" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="json" id="diagram_seat" name="diagram" value="0" hidden>
                            <input type="number" id="vehicle_id" name="vehicle_id" value="<?=$id?>" hidden>
                            <div class="form-group">
                                <label for=""><b>Tên phương tiện*</b></label>
                                <input id="vehicle_name" type="text" class="form-control" name="name" placeholder="Nhập tên ..." value="<?=$getVehicleById[0]['name']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Chọn hình ảnh</label>
                                <img height="400px" width="auto" src="<?=$urlImg?>/images/vehicle/<?=$getVehicleById[0]['image']?>" id="img_thumbnail" alt="<?=$getVehicleById[0]['image']?>">
                                <input id="change_img" type="file" name="thumbnail" class="form-control" value="<?=$getVehicleById[0]['image']?>">
                                <input type="text" value="<?=$getVehicleById[0]['image']?>" name="name_img_product" hidden>
                            </div>
                            <div class="form-group">
                                <label for=""><b>Biển số*</b></label>
                                <input id="license_plate" type="text" class="form-control" name="license_plate" placeholder="Nhập biển số ..." value="<?=$getVehicleById[0]['license_plate']?>" required>
                            </div>
                            <div class="form-group w-50">
                                <label for="">Chọn hãng phương tiện: </label>
                                <select id="agency_id" name="agency" class="form-control">
                                    <?php foreach($getAllAgency as $item){
                                        if($item['id'] == $getVehicleById[0]['agency_id']){
                                        ?>
                                        <option value="<?=$item['id']?>" selected><?=$item['agency_name']?></option>
                                    <?php }else{?>
                                        <option value="<?=$item['id']?>"><?=$item['agency_name']?></option>
                                    <?php } }?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-12">
                                    <div class="form-group">
                                        <label for=""><b>Số ghế: </b></label>
                                        <input id="vehicle_seat" type="number" class="form-control" name="seat" value="<?=$getVehicleById[0]['seat']?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="floor"><b>Số tầng: </b></label>
                                        <select name="floor" id="vehicle_floor" class="form-control" required>
                                                <option value="1" <?php if($getVehicleById[0]['floor'] == 1){echo "selected";} ?>>1</option>
                                                <option value="2"  <?php if($getVehicleById[0]['floor'] == 2){echo "selected";} ?>>2</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-8 col-md-12 col-12">
                                    <label><b>Thiết lập sơ đồ ghế:</b></label>
                                    <div>
                                        <div id="floor_one" class="row d-flex justify-content-evenly">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="map-car">
                                                            <p>Tầng dưới</p>
                                                            <div class="driver">
                                                                <img src="../../public/img/icon-steering.jpg" alt="Driver">
                                                            </div>
                                                            <p>Phía trước</p>
                                                            <div class="map-content">
                                                                <div class="seat_row no-gutters">
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="0" data-col="0">A1</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="0" data-col="1">A2</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="0" data-col="2">A3</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="0" data-col="3">A4</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="0" data-col="4">A5</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="1" data-col="0">A6</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="1" data-col="1">A7</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="1" data-col="2">A8</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="1" data-col="3">A9</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="1" data-col="4">A10</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="2" data-col="0">A11</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="2" data-col="1">A12</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="2" data-col="2">A12</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="2" data-col="3">A14</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="2" data-col="4">A15</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="3" data-col="0">A16</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="3" data-col="1">A17</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="3" data-col="2">A18</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="3" data-col="3">A19</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="3" data-col="4">A20</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="4" data-col="0">A21</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="4" data-col="1">A22</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="4" data-col="2">A23</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="4" data-col="3">A24</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="1" data-row="4" data-col="4">A25</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p>Phía sau</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="floor_two" class="col-lg-6 col-md-6 col-12">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="map-car">
                                                            <p>Tầng trên</p>
                                                            <div class="driver">
                                                                <img src="../../public/img/icon-steering.jpg" alt="Driver">
                                                            </div>
                                                            <p>Phía trước</p>
                                                            <div class="map-content">
                                                                <div class="seat_row no-gutters">
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="0" data-col="0">B1</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="0" data-col="1">B2</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="0" data-col="2">B3</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="0" data-col="3">B4</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="0" data-col="4">B5</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="1" data-col="0">B6</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="1" data-col="1">B7</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="1" data-col="2">B8</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="1" data-col="3">B9</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="1" data-col="4">B10</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="2" data-col="0">B11</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="2" data-col="1">B12</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="2" data-col="2">B13</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="2" data-col="3">B14</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="2" data-col="4">B15</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="3" data-col="0">B16</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="3" data-col="1">B17</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="3" data-col="2">B18</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="3" data-col="3">B19</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="3" data-col="4">B20</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="4" data-col="0">B21</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="4" data-col="1">B22</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="4" data-col="2">B23</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="4" data-col="3">B24</div>
                                                                    </div>
                                                                    <div class="seat_col">
                                                                        <div class="desk" data-floor="2" data-row="4" data-col="4">B25</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p>Phía sau</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btnAddVehicle" type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
        var reader;
        let change_img = document.querySelector("#change_img");
        let img_thumbnail = document.querySelector("#img_thumbnail");
        change_img.onchange = e => {
            files = e.target.files;
                reader = new FileReader();
                reader.onload = function() {
                    document.querySelector("#img_thumbnail").src = reader.result;
                    document.querySelector('#img_thumbnail').style = 'height: 400px;';
                }
                reader.readAsDataURL(files[0]);
        }
</script>
<script>
    let arr_diagram = new Array();
    let index = 0;
    let arrTemp2;
    <?php foreach($getDiagramByid as $item){?>
        arrTemp2 = new Array(<?=$item['floor']?>,<?=$item['row']?>,<?=$item['col']?>);
        arr_diagram[index] = arrTemp2;
        index++;
    <?php }?>


    
</script>
<?php
include "../../footer.php";
?>