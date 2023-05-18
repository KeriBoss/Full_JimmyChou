<?php
include "./header.php";
require_once "../model/location.php";
require_once "../model/vehicle.php";
require_once "../model/transport.php";
require_once "../model/ticket.php";

if (isset($_GET['id'])) {
    $id = $_GET['id']; //Get id of location
}
$ticket = new Ticket();
$getTicketById = $ticket->getTicketById($id);
//
$transport = new Transport();
$getAllTransport = $transport->getAllTransport();

$vehicle = new Vehicle();
$getAllVehicle = $vehicle->getAllVehicle();

$location = new Location();
$getAllLocation = $location->getAllLocation();

//get all location in database

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa vé chuyến đi</h1>
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="p-4 d-flex justify-content-start align-items-center">
            <form action="action/ticket/edit_ticket.php" method="post" onsubmit="return kiemtraDate();" enctype="multipart/form-data">
                <input type="number" name="ticket_id" class="form-control" value="<?= $id ?>" hidden>
                <div class="form-group">
                    <label for=""><b>Chọn loại vận chuyển:</b></label>
                    <select name="id_transport" class="form-control">
                        <?php
                        foreach ($getAllTransport as $item) {
                            if ($item['id'] == $getTicketById[0]['transport_id']) { ?>
                                <option value="<?= $getTicketById[0]['transport_id'] ?>" selected><?= $item['name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for=""><b>Tên phương tiện:</b></label>
                    <select name="id_vehicle" class="form-control">
                        <?php
                        foreach ($getAllVehicle as $item) {
                            if ($item['id'] == $getTicketById[0]['vehicle_id']) { ?>
                                <option value="<?= $getTicketById[0]['vehicle_id'] ?>" selected><?= $item['name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for=""><b>Chọn hành trình:</b></label>
                    <select name="id_location" class="form-control">
                        <?php
                        foreach ($getAllLocation as $item) {
                            if ($item['id'] == $getTicketById[0]['location_id']) { ?>
                                <option value="<?= $getTicketById[0]['location_id'] ?>" selected><b>Từ:</b> <?=$item['location_pick']?>, <b>đến:</b>  <?=$item['location_drop']?></option>
                            <?php } else { ?>
                                <option value="<?= $item['id'] ?>"><b>Từ:</b> <?=$item['location_pick']?>, <b>đến:</b>  <?=$item['location_drop']?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-12 col-12">
                            <label><b>Ngày khởi hành:</b></label>
                            <input type="date" value="<?=$getTicketById[0]['date_duration']?>" name="date_duration" class="form-control">
                        </div>
                        <div class="col-lg-4 col-md-12 col-12">
                            <label><b>Giờ khởi hành:</b></label>
                            <input value="<?=$getTicketById[0]['time_duration']?>" type="text" class="form-control" name="time_duration" id="time_pick" placeholder="Chọn giờ khởi hành" pattern="[0-9.0-9]+:[0-9.0-9]+[a-z]{2}">
                        </div>
                        <div class="col-lg-4 col-md-12 col-12">
                            <label><b>Nhập giá vé(VND):</b></label>
                            <input value="<?=$getTicketById[0]['price']?>" type="number" name="price" class="form-control">
                        </div>
                    </div>
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