<?php
include "../../header.php";
require_once "../../../model/station.php";
require_once "../../../model/location.php";

$location = new Location();
$station = new Station();

$getAllStation = $station->getAllStation();//Get all data station
$getAllLocation = $location->getAllLocation();//get all location in data
//
?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Quản lý các trạm</h1></h1>
                    <a id="myBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Thêm trạm mới</a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách các trạm</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Điểm đón</th>
                                        <th>Điểm đến</th>
                                        <th>Giờ khởi hành</th>
                                        <th>Thuộc hành trình</th>
                                        <th>Trạng thái</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    foreach($getAllStation as $item){ ?>
                                        <tr>
                                            <td><?=$count++?></td>
                                            <td><?=$item['point_pick']?></td>
                                            <td><?=$item['point_drop']?></td>
                                            <td><?=$item['departure_time']?></td>
                                            <td>Từ: <?=$item['location_pick']?>, đến:  <?=$item['location_drop']?></td>
                                            <td>
                                                <?php if($item['status'] == 1){echo "Hiện";}
                                                else{echo "Ẩn";}
                                                ?>
                                            </td>
                                            <td><a href="./edit_station.php?id=<?=$item['id']?>" class="btn btn-primary btnEdit">Edit</a></td>
                                            <td><a onclick="if(CheckForm() == false) return false" href="<?=$url?>/action/vehicle/delete_station.php?id=<?=$item['id']?>" class="btn btn-danger">Delete</a></td>
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
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm trạm mới</h5>
                            <button type="button" data-modal="close" class="close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="json" id="diagram_seat" name="diagram" hidden>
                            <div class="form-group">
                                <label for="point_pick"><b>Điểm đón*</b></label>
                                <input type="text" class="form-control" name="point_pick" placeholder="Nhập địa điểm ..." required>
                            </div>
                            <div class="form-group">
                                <label for="point_drop">Điểm đến*</label>
                                <input type="text" name="point_drop" class="form-control" placeholder="Nhập địa điểm ...">
                            </div>
                            <div class="form-group">
                                <label for=""><b>Giờ khởi hành</b></label>
                                <div class="container">
                                    <div class="row">
                                        <div class='col-sm-6'>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker3'>
                                                <input type='text' class="form-control" />
                                                <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $(function () {
                                                $('#datetimepicker3').datetimepicker({
                                                    format: 'LT'
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group w-50">
                                <label for="">Chọn hành trình: </label>
                                <select id="agency_id" name="agency" class="form-control">
                                    <?php foreach($getAllAgency as $item){ ?>
                                        <option value="<?=$item['id']?>"><?=$item['agency_name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group w-50">
                                <label for="">Trạng thái: </label>
                                <select id="agency_id" name="agency" class="form-control">
                                    <?php foreach($getAllAgency as $item){ ?>
                                        <option value="<?=$item['id']?>"><?=$item['agency_name']?></option>
                                    <?php }?>
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
include "../../footer.php";
?>