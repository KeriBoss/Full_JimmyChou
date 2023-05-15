<?php
include "./header.php";
require_once "../model/transport.php";

$transport = new Transport();

$getAllTransport = $transport->getAllTransport();//Get all data station
//
?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Quản lý các hình thức vận chuyển</h1></h1>
                    <a id="myBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Thêm loại hình mới</a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách loại hình vận chuyển</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5%">STT</th>
                                        <th>Tên</th>
                                        <th>Icon</th>
                                        <th>Mô tả</th>
                                        <th>Loại hình vé</th>
                                        <th>Trạng thái</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    foreach($getAllTransport as $item){ ?>
                                        <tr>
                                            <td><?=$count++?></td>
                                            <td><?=$item['name']?></td>
                                            <td><i class='<?=$item['icon']?>' style="font-size: 30px;"></i></td>
                                            <td><?=$item['subtitle']?></td>
                                            <td>
                                                <?php if($item['trip_type'] === 1){echo "1 chiều";}
                                                else{echo "1 chiều, Khứ hồi";}
                                                ?>
                                            </td>
                                            <td>
                                                <?php if($item['status'] === 1){echo "Hiện";}
                                                else{echo "Ẩn";}
                                                ?>
                                            </td>
                                            <td><a href="./edit_transport.php?id=<?=$item['id']?>" class="btn btn-primary btnEdit">Edit</a></td>
                                            <td><a onclick="if(CheckForm() == false) return false" href="action/transport/delete_transport.php?id=<?=$item['id']?>" class="btn btn-danger">Delete</a></td>
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
                    <form action="./action/transport/add_transport.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm loại hình mới</h5>
                            <button type="button" data-modal="close" class="close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name"><b>Tên*</b></label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên..." required>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Mô tả</label>
                                <input type="text" name="subtitle" class="form-control" placeholder="Nhập địa điểm ...">
                            </div>
                            <div class="form-group">
                                <label for="status">Chọn icon</label><br>
                                <select id="mySelect" name="icon_transport" data-show-content="true" class="form-control w-50">
                                    <option selected disabled>Select..</option>
                                    <option value="bx bx-bus" data-content="<i class='bx bx-bus' ></i> Bus"></option>
                                    <option value="bx bx-car" data-content="<i class='bx bx-car' ></i> Car"></option>
                                    <option value="fa-solid fa-ship" data-content="<i class='fa-solid fa-ship'></i> Ship"></option>
                                    <option value="bx bxs-rocket" data-content="<i class='bx bxs-rocket' ></i> Rocket"></option>
                                    <option value="bx bx-train" data-content="<i class='bx bx-train'></i> Train"></option>
                                </select>
                            </div>
                            <div class="form-group w-25">
                                <label for="trip_type">Loại hình vé: </label>
                                <select name="trip_type" class="form-control">
                                    <option value="1" selected>1 chiều </option>
                                    <option value="0">1 chiều, Khứ hồi</option>
                                </select>
                            </div>
                            <div class="form-group w-25">
                                <label for="">Trạng thái: </label>
                                <select name="status" class="form-control">
                                    <option value="1" selected>Hiện </option>
                                    <option value="0">Ẩn </option>
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