<?php
include "./header.php";
require_once "../model/location.php";

$location = new Location();

//Check parameter for func: insert new location
// if(isset($_POST['location_pick']) && isset($_POST['location_drop']) && isset($_POST['status'])){
//     $location_pick = $_POST['location_pick'];
//     $location_drop = $_POST['location_drop'];
//     $status = $_POST['status'];
//     $insert = $location->insert($location_pick, $location_drop, $status);
// }

//get all location in database
$getAllLocation = $location->getAllLocation();
?>
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Quản lý địa điểm chuyến đi</h1></h1>
                    <a id="myBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Thêm địa điểm mới</a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách các địa điểm</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Địa điểm xuất phát</th>
                                        <th>Điểm đến</th>
                                        <th>Trạng thái</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach($getAllLocation as $item){
                                    ?>
                                        <tr>
                                            <td><?=$count++?></td>
                                            <td><?=$item['location_pick']?></td>
                                            <td><?=$item['location_drop']?></td>
                                            <td>
                                                <?php if($item['status'] == 0){
                                                    echo "Ẩn";
                                                } else{ echo "Hiện"; }?>
                                            </td>
                                            <td><a href="./edit_location.php?id=<?=$item['id']?>" class="btn btn-primary btnEdit">Edit</a></td>
                                            <td><a onclick="if(CheckForm() == false) return false" href="" class="btn btn-danger">Delete</a></td>
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
                    <form action="<?=$url?>/action/location/add_location.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm địa điểm</h5>
                            <button type="button" data-modal="close" class="close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for=""><b><i class='bx bxs-location-plus'></i> Chọn điểm xuất phát</b></label>
                                <div class="g-location">
                                <input class="form-control" list="GFGOptions" id="GFGDataList" name="location_pick"
                                    placeholder="Chọn địa điểm ..." required>
                                </div>
                                <datalist id="GFGOptions">
                                    <option value="Ho Chi Minh, Ho Chi Minh">
                                    <option value="Cho Noi Cai Rang, Can Tho">
                                    <option value="Binh Chanh District, Ho Chi Minh">
                                    <option value="Da Lat Terminal, Da Lat">
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for=""><b><i class='bx bxs-location-plus'></i> Chọn điểm đến</b></label>
                                <div class="g-location">
                                <input class="form-control" list="option_drop" id="GFGDataList" name="location_drop"
                                    placeholder="Chọn địa điểm ..." required>
                                </div>
                                <datalist id="option_drop">
                                    <option value="Ho Chi Minh, Ho Chi Minh">
                                    <option value="Cho Noi Cai Rang, Can Tho">
                                    <option value="Binh Chanh District, Ho Chi Minh">
                                    <option value="Da Lat Terminal, Da Lat">
                                </datalist>
                            </div>
                            <div class="form-group w-25">
                                <label for=""><b>Trạng thái</b></label>
                                <select name="status" class="form-control">
                                    <option value="1" selected>Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>

<?php
include "./footer.php";
?>