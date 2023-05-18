<?php
include "./header.php";
require_once "../model/transport.php";
require_once "../model/vehicle.php";
require_once "../model/location.php";
require_once "../model/ticket.php";

$ticket = new Ticket();
$getAllTicket = $ticket->getAllTicket();//Get all data station
//
$transport = new Transport();
$getAllTransport = $transport->getAllTransport();

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
                    <a id="myBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Thêm vé mới</a>
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
                                        <th>Loại vận chuyển</th>
                                        <th>Tên phương tiện</th>
                                        <th>Lộ trình</th>
                                        <th>Ngày khởi hành</th>
                                        <th>Giờ khởi hành</th>
                                        <th>Giá vé(VND)</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    foreach($getAllTicket as $item){ ?>
                                        <tr>
                                            <td><?=$count++?></td>
                                            <td><?=$item['transport_name']?></td>
                                            <td><?=$item['vehicle_name']?></td>
                                            <td><b>Từ:</b> <?=$item['location_pick']?>, <b>đến:</b>  <?=$item['location_drop']?></td>
                                            <td><?=$item['date_duration']?></td>
                                            <td><?=$item['time_duration']?></td>
                                            <td><?=$item['price']?></td>
                                            <td><a href="./edit_ticket.php?id=<?=$item['ticket_id']?>" class="btn btn-primary btnEdit">Edit</a></td>
                                            <td><a onclick="if(CheckForm() == false) return false" href="action/ticket/delete_ticket.php?id=<?=$item['ticket_id']?>" class="btn btn-danger">Delete</a></td>
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
                    <form action="./action/ticket/add_ticket.php" method="post" onsubmit="return kiemtraDate();">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm vé mới</h5>
                            <button type="button" data-modal="close" class="close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <label for="id_transport"><b>Chọn loại vận chuyển*</b></label>
                                        <select name="id_transport" class="form-control">
                                            <?php foreach($getAllTransport as $item){ ?>
                                                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <label for="id_vehicle"><b>Chọn phương tiện*</b></label>
                                        <select name="id_vehicle" class="form-control">
                                            <?php foreach($getAllVehicle as $item){ ?>
                                                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><b>Chọn lộ trình*</b></label>
                                <select name="id_location" class="form-control">
                                    <?php foreach($getAllLocation as $item){ ?>
                                        <option value="<?=$item['id']?>"><b>Từ:</b> <?=$item['location_pick']?>, <b>đến:</b>  <?=$item['location_drop']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-md-12 col-12">
                                        <label><b>Ngày khởi hành:</b></label>
                                        <input type="date" name="date_duration" class="form-control">
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-12">
                                        <label><b>Giờ khởi hành:</b></label>
                                        <input type="text" class="form-control" name="time_duration" id="time_pick" placeholder="Chọn giờ khởi hành" pattern="[0-9.0-9]+:[0-9.0-9]+[a-z]{2}">
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-12">
                                        <label><b>Nhập giá vé(VND):</b></label>
                                        <input type="number" name="price" class="form-control">
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
include "./footer.php";
?>