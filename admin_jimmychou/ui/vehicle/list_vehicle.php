<?php
include "../../header.php";
require_once "../../../model/vehicle.php";
require_once "../../../model/agency.php";

$vehicle = new Vehicle();
$agency = new Agency();

//
$getAllVehicle = $vehicle->getAllVehicle();
$getAllAgency = $agency->getAllAgency();
?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Quản lý các phương tiện</h1></h1>
                    <a id="myBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Thêm phương tiện mới</a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách các phương tiện</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Ảnh</th>
                                        <th>Biển số</th>
                                        <th>Số ghế</th>
                                        <th>Số tầng</th>
                                        <th>Hãng</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    foreach($getAllVehicle as $item){ ?>
                                        <tr>
                                            <td><?=$count++?></td>
                                            <td><?=$item['name']?></td>
                                            <td>
                                                <img height="150px" width="150px" src="<?=$urlImg?>/images/vehicle/<?=$item['image']?>" alt="Img Product">
                                            </td>
                                            <td><?=$item['license_plate']?></td>
                                            <td><?=$item['seat']?></td>
                                            <td><?=$item['floor']?></td>
                                            <td><?=$item['agency_name']?></td>
                                            <td><a href="./edit_vehicle.php?id=<?=$item['id_vehicle']?>" class="btn btn-primary btnEdit">Edit</a></td>
                                            <td><a onclick="if(CheckForm() == false) return false" href="<?=$url?>/action/vehicle/delete_vehicle.php?id=<?=$item['id_vehicle']?>" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <!-- Modal -->
            <div id="newModal" class="modal1" data-display="false">
                <!-- Modal content -->
                <div class="modal-content">
                <!-- action="<?=$url?>/action/vehicle/add_vehicle.php" method="post" -->
                    <form action="<?=$url?>/action/vehicle/add_vehicle.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm phương tiện mới</h5>
                            <button type="button" data-modal="close" class="close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="json" id="diagram_seat" name="diagram" hidden>
                            <div class="form-group">
                                <label for=""><b>Tên phương tiện*</b></label>
                                <input id="vehicle_name" type="text" class="form-control" name="name" placeholder="Nhập tên ..." required>
                            </div>
                            <div class="form-group">
                                <label for="image">Chọn hình ảnh</label>
                                <input id="image_vehicle" type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for=""><b>Biển số*</b></label>
                                <input id="license_plate" type="text" class="form-control" name="license_plate" placeholder="Nhập biển số ..." required>
                            </div>
                            <div class="form-group w-50">
                                <label for="">Chọn hãng phương tiện: </label>
                                <select id="agency_id" name="agency" class="form-control">
                                    <?php foreach($getAllAgency as $item){ ?>
                                        <option value="<?=$item['id']?>"><?=$item['agency_name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-12">
                                    <div class="form-group">
                                        <label for=""><b>Số ghế: </b></label>
                                        <input id="vehicle_seat" type="number" class="form-control" name="seat" value="0" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="floor"><b>Số tầng: </b></label>
                                        <select name="floor" id="vehicle_floor" class="form-control" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
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

<?php
include "../../footer.php";
?>