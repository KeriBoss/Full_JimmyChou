<?php
include "./header.php";
require_once "../model/transport.php";

if (isset($_GET['id'])) {
    $id = $_GET['id']; //Get id of location
}

$transport = new Transport();
$getTransportById = $transport->getTransportById($id);

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa loại hình vận chuyển</h1>
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="p-4 d-flex justify-content-start align-items-center">
            <form action="action/transport/edit_transport.php" method="post" class="w-50" enctype="multipart/form-data">
                <input type="number" name="transport_id" class="form-control" value="<?= $id ?>" hidden>
                <div class="form-group">
                    <label for=""><b>Tên: </b></label>
                    <div class="g-location">
                        <input value="<?= $getTransportById[0]['name'] ?>" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for=""><b>Mô tả</b></label>
                    <div class="g-location">
                        <input value="<?= $getTransportById[0]['subtitle'] ?>" class="form-control" name="subtitle">
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Chọn icon</label><br>
                    <select id="mySelect" name="icon_transport" data-show-content="true" class="form-control w-50">
                        <option selected disabled>Select..</option>
                        <option class="iconDiv" value="bx bx-bus" data-content="<i class='bx bx-bus' ></i> Bus"></option>
                        <option class="iconDiv" value="bx bx-car" data-content="<i class='bx bx-car' ></i> Car"></option>
                        <option class="iconDiv" value="fa-solid fa-ship" data-content="<i class='fa-solid fa-ship'></i> Ship"></option>
                        <option class="iconDiv" value="bx bxs-rocket" data-content="<i class='bx bxs-rocket' ></i> Rocket"></option>
                        <option class="iconDiv" value="bx bx-train" data-content="<i class='bx bx-train'></i> Train"></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Loại hình vé: </label><br>
                    <select name="status" id="status" class="form-control w-25">
                        <option class="statusDiv" value="0">Ẩn</option>
                        <option class="statusDiv" value="1">Hiện</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="trip_type">Trạng thái</label><br>
                    <select name="trip_type" id="trip_type" class="form-control w-25">
                        <option class="optionDiv" value="1">1 chiều</option>
                        <option class="optionDiv" value="0">1 chiều, Khứ hồi</option>
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
    for (var i = 0; i < document.querySelectorAll('.statusDiv').length; i++) {
        if (document.querySelectorAll('.statusDiv')[i].value == '<?= $getTransportById[0]['status']; ?>') {
            document.querySelectorAll('.statusDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.optionDiv').length; i++) {
        if (document.querySelectorAll('.optionDiv')[i].value == '<?= $getTransportById[0]['trip_type']; ?>') {
            document.querySelectorAll('.optionDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.iconDiv').length; i++) {
        if ( document.querySelectorAll('.iconDiv')[i].value == '<?=$getTransportById[0]['icon'];?>') {
            document.querySelectorAll('.iconDiv')[i].selected = true;
            break;
        }
    }
</script>
<?php
include "./footer.php";
?>