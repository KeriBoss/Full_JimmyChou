<?php
include "./header.php";
require_once "../model/location.php";
require_once "../model/station.php";

if (isset($_GET['id'])) {
    $id = $_GET['id']; //Get id of location
}

$location = new Location();
$getAllLocation = $location->getAllLocation();

$station = new Station();
$getStationById = $station->getStationById($id);
//get all location in database
$getAllStation = $station->getAllStation();

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa địa điểm chuyến đi</h1>
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="p-4 d-flex justify-content-start align-items-center">
            <form action="action/station/edit_station.php" method="post" class="w-50" enctype="multipart/form-data">
                <input type="number" name="station_id" class="form-control" value="<?= $id ?>" hidden>
                <div class="form-group">
                    <label for=""><b>Chọn điểm xuất phát</b></label>
                    <div class="g-location">
                        <input value="<?= $getStationById[0]['point_pick'] ?>" class="form-control" list="GFGOptions" id="GFGDataList" name="point_pick" placeholder="Chọn địa điểm ..." required>
                    </div>
                    <datalist id="GFGOptions">
                        <?php foreach ($getAllStation as $item) { ?>
                            <option value="<?= $item['point_pick'] ?>">
                            <?php } ?>
                    </datalist>
                </div>
                <div class="form-group">
                    <label for=""><b>Chọn điểm đến</b></label>
                    <div class="g-location">
                        <input value="<?= $getStationById[0]['point_drop'] ?>" class="form-control" list="option_drop" id="GFGDataList" name="point_drop" placeholder="Chọn địa điểm ..." required>
                    </div>
                    <datalist id="option_drop">
                        <?php foreach ($getAllStation as $item) { ?>
                            <option value="<?= $item['point_drop'] ?>">
                            <?php } ?>
                    </datalist>
                </div>
                <div class="form-group">
                    <label for=""><b>Giờ khởi hành</b></label>
                    <input type="text" class="form-control" name="departure_time" id="time_pick" placeholder="Chọn giờ khởi hành" pattern="[0-9.0-9]+:[0-9.0-9]+[a-z]{2}" value="<?= $getStationById[0]['departure_time'] ?>">
                </div>
                <div class="form-group">
                    <select name="location_id" class="form-control">
                        <label for=""><b>Chọn tuyến đường:</b></label>
                        <?php
                        foreach ($getAllLocation as $item) {
                            if ($item['id'] == $getStationById[0]['location_id']) { ?>
                                <option value="<?= $getStationById[0]['location_id'] ?>" selected>Từ: <?= $item['location_pick'] ?>, đến: <?= $item['location_drop'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $item['id'] ?>">Từ: <?= $item['location_pick'] ?>, đến: <?= $item['location_drop'] ?></option>
                        <?php }
                        } ?>
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Trạng thái</label><br>
                    <select name="status" id="status" class="form-control w-25">
                        <option class="optionDiv" value="0">Ẩn</option>
                        <option class="optionDiv" value="1">Hiện</option>
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