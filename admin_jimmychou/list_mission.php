<?php
include "./header.php";
require_once "../model/vehicle.php";
require_once "../model/location.php";
require_once "../model/mission_vehicle.php";

//
$mission = new MissionVehicle();
$getAllMission = $mission->getAllMission();

$vehicle = new Vehicle();
$getAllVehicle = $vehicle->getAllVehicle();

$location = new Location();
$getAllLocation = $location->getAllLocation();

?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Quản lý tất cả vé của các chuyến đi</h1></h1>
                    <a id="myBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Thêm lộ trình cho PT</a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách vé</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5%">STT</th>
                                        <th>Tên phương tiện</th>
                                        <th>Lộ trình</th>
                                        <th>Biển số</th>
                                        <th>Thuộc lộ trình</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    foreach($getAllMission as $item){ ?>
                                        <tr>
                                            <td><?=$count++?></td>
                                            <td><?=$item['name']?></td>
                                            <td>
                                                <img height="150px" width="150px" src="<?=$urlImg?>/images/vehicle/<?=$item['image']?>" alt="Img Product">
                                            </td>
                                            <td><?=$item['license_plate']?></td>
                                            <td><b>Từ:</b> <?=$item['location_pick']?>, <b>đến:</b>  <?=$item['location_drop']?></td>
                                            <td><a href="./edit_mission.php?id=<?=$item['mission_id']?>" class="btn btn-primary btnEdit">Edit</a></td>
                                            <td><a onclick="if(CheckForm() == false) return false" href="action/mission/delete_mission.php?id=<?=$item['mission_id']?>" class="btn btn-danger">Delete</a></td>
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
                    <form action="./action/mission/add_mission.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm lộ trình cho phương tiện</h5>
                            <button type="button" data-modal="close" class="close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <label for="id_vehicle"><b>Chọn phương tiện*</b></label>
                                        <select name="id_vehicle" id="mission_vehicle" class="form-control">
                                            <?php foreach($getAllVehicle as $item){ ?>
                                                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                            <?php } ?>
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
                                    <?php foreach($getAllLocation as $item){ ?>
                                        <option value="<?=$item['id']?>"><b>Từ:</b> <?=$item['location_pick']?>, <b>đến:</b>  <?=$item['location_drop']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btnAddVehicle" type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>

<?php
include "./footer.php";
?>