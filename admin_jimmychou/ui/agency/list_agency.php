<?php
include "../../header.php";
require_once "../../../model/agency.php";

$agency = new Agency();


//get all location in database
$getAllAgency = $agency->getAllAgency();
?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Quản lý các hãng phương tiện</h1></h1>
                    <a id="myBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Thêm hãng mới</a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách các hãng</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên hãng</th>
                                        <th>Ảnh Logo</th>
                                        <th>Mô tả</th>
                                        <th>Ngày tạo</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach($getAllAgency as $item){
                                    ?>
                                        <tr>
                                            <td><?=$count++?></td>
                                            <td><?=$item['agency_name']?></td>
                                            <td>
                                                <img height="150px" width="150px" src="<?=$urlImg?>/images/agency/<?=$item['img_logo']?>" alt="Img Product">
                                            </td>
                                            <td><?=$item['description']?></td>
                                            <td><?=$item['create_at']?></td>
                                            <td><a href="./edit_agency.php?id=<?=$item['id']?>" class="btn btn-primary btnEdit">Edit</a></td>
                                            <td><a onclick="if(CheckForm() == false) return false" href="<?=$url?>/action/agency/delete_agency.php?id=<?=$item['id']?>" class="btn btn-danger">Delete</a></td>
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
                    <form action="<?=$url?>/action/agency/add_agency.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm hãng</h5>
                            <button type="button" data-modal="close" class="close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for=""><b>Tên hãng*</b></label>
                                <input type="text" class="form-control" name="agency_name" placeholder="Nhập tên hãng ..." required>
                            </div>
                            <div class="form-group">
                                <label for="image">Chọn hình ảnh</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for=""><b>Mô tả</b></label>
                                <textarea type="text" class="form-control" name="description" placeholder="Mô tả ..." ></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>

<?php
include "../../footer.php";
?>