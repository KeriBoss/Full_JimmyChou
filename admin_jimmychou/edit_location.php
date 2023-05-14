<?php
include "./header.php";
require_once "../model/location.php";

if (isset($_GET['id'])) {
    $id = $_GET['id']; //Get id of location
}

$location = new Location();
$getLocationById = $location->getLocationById($id);

//get all location in database
$getAllLocation = $location->getAllLocation();
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
            <form action="<?= $url ?>/action/location/edit_location.php" method="post" class="w-50" enctype="multipart/form-data">
                <input type="number" name="location_id" class="form-control" value="<?= $id ?>" hidden>
                <div class="form-group">
                                <label for=""><b><i class='bx bxs-location-plus'></i> Chọn điểm xuất phát</b></label>
                                <div class="g-location">
                                <input value="<?=$getLocationById[0]['location_pick']?>" class="form-control" list="GFGOptions" id="GFGDataList" name="location_pick"
                                    placeholder="Chọn địa điểm ..." required>
                                </div>
                                <datalist id="GFGOptions">
                                    <?php foreach($getAllLocation as $item){?>
                                        <option value="<?=$item['location_pick']?>">
                                    <?php } ?>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for=""><b><i class='bx bxs-location-plus'></i> Chọn điểm đến</b></label>
                                <div class="g-location">
                                <input value="<?=$getLocationById[0]['location_drop']?>" class="form-control" list="option_drop" id="GFGDataList" name="location_drop"
                                    placeholder="Chọn địa điểm ..." required>
                                </div>
                                <datalist id="option_drop">
                                    <?php foreach($getAllLocation as $item){?>
                                        <option value="<?=$item['location_drop']?>">
                                    <?php } ?>
                                </datalist>
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
    if ( document.querySelectorAll('.optionDiv')[i].value == '<?=$getLocationById[0]['status'];?>') {
        document.querySelectorAll('.optionDiv')[i].selected = true;
        break;
    }
}
</script>
<?php
include "./footer.php";
?>