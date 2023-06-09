<?php
include "./header.php";
require_once "../model/transport.php";
require_once "../model/location.php";
require_once "../model/ticket.php";

$trip_type = 0;
if (isset($_POST['trip_type']) && isset($_POST['transport_id'])) {
    $trip_type = $_POST['trip_type']; //oneway or roundway
    $transport_id = $_POST['transport_id']; //get id of transport
}
$transport = new Transport();
$getTransportById = $transport->getTransportById($transport_id); //get transport when have id

$f_location = null;
$l_location = null;
$start_date = null;
$end_date = null;
if (isset($_POST['first-location'])) {
    $f_location = $_POST['first-location'];
}
if (isset($_POST['last-location'])) {
    $l_location = $_POST['last-location'];
}
if (isset($_POST['start_date'])) {
    $start_date = $_POST['start_date']; //start date
}
if (isset($_POST['end_date'])) {
    $end_date = $_POST['end_date']; //start date
}
if (isset($_POST['pax'])) {
    $pax = $_POST['pax']; //count people
}


$limit = 8;
$location = new Location();
$getAllLocationLimit = $location->getAllLocationLimit($limit);

$ticket = new Ticket(); //Create object ticket of trip
// $getAllTicket = $ticket->getAllTicketForUser();
$getAllTicket = $ticket->searchTicker($transport_id, $f_location, $l_location, $start_date);

?>

<div class="jimmy-wrap"></div>
<!-- Header menu Start -->
<section class="booking-header-menu">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar p-0" id="header-nav-menu">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-menu" aria-controls="ftco-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu">Sửa đổi để tìm kiếm</span>
            </button>

            <div class="collapse navbar-collapse" id="ftco-menu">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex">
                        <a href="index.html" class="nav-link icon-nav">
                            <i class='bx <?= $getTransportById[0]['icon'] ?>'></i>
                        </a>
                        <?php if ($trip_type == 0) { ?>
                            <div class="group-way">
                                <input type="radio" name="way" id="oneway">
                                <label data-type="radio" for="oneway">Một chiều</label>
                                <br>
                                <input type="radio" name="way" id="roundway" checked>
                                <label data-type="radio" for="roundway">Khứ hồi</label>
                            </div>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <form autocomplete="off" action="" method="post" class="request-form ftco-animate">
                            <input type="number" name="trip_type" class="trip_type" value="<?= $trip_type ?>" hidden>
                            <div class="row justify-content-around align-items-center">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="form-group">
                                        <div class="g-location">
                                            <span>
                                                <i class='bx bxs-location-plus'></i>
                                            </span>
                                            <input class="form-control" list="GFGOptions" id="GFGDataList" name="first-location" placeholder="Chọn điểm đi" value="<?= $f_location ?>">
                                        </div>
                                        <datalist id="GFGOptions">
                                            <?php foreach ($getAllLocationLimit as $location) { ?>
                                                <option value="<?= $location['location_pick'] ?>">
                                                <?php } ?>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="form-group">
                                        <div class="g-location">
                                            <span>
                                                <i class='bx bxs-location-plus'></i>
                                            </span>
                                            <input class="form-control" list="option_drop" id="GFGDataList" name="last-location" placeholder="Chọn điểm về" value="<?= $l_location ?>">
                                        </div>
                                        <datalist id="option_drop">
                                            <?php foreach ($getAllLocationLimit as $location) { ?>
                                                <option value="<?= $location['location_drop'] ?>">
                                                <?php } ?>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-12">
                                    <div class="form-group">
                                        <input id="start_date" class="form-control" name="start_date" placeholder="dd/mm/yyyy" value="<?= $start_date ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-12">
                                    <?php if ($trip_type == 0) { ?>
                                        <div class="form-group" id="round-way">
                                            <input id="end_date" class="form-control" name="end_date" placeholder="dd/mm/yyyy">
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-2 col-md-4 col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn-submit rounded px-2 py-2">Tìm kiếm</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</section>
<!-- Header menu End -->

<!--Breadcrumb start-->
<section class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="./index.php" class="breadcrumb-item">Trang chủ</a></li>
            <li><a href="./index.php" class="breadcrumb-item">Vé xe khách</a></li>
            <li><a href="./index.php" class="breadcrumb-item active"><span><?= $f_location ?></span> ->
                    <span><?= $l_location ?></span></a></li>
        </ul>
    </div>
</section>
<!--Breadcrumb end-->

<!--box location start-->
<section class="box-location">
    <div class="container">
        <div class="row no-gutters">
            <div class="<?php if ($trip_type == 1) {
                            echo "col-12";
                        } else {
                            echo "col-lg-6 col-md-6 col-12";
                        } ?>">
                <div class="box box-left">
                    <div>
                        Điểm khởi hành
                    </div>
                    <span class="group-location">
                        <span class="ellipsis"><?= $f_location ?></span>
                        <span class="emote-next"><i class='bx bx-right-arrow-alt'></i></span>
                        <span class="ellipsis"><?= $l_location ?></span>
                        <span class="date">
                            <?= $start_date ?>
                        </span>
                    </span>
                    <a href="./payment.html">Không chọn chuyến về</a>
                </div>
            </div>
            <?php if ($trip_type == 0) { ?>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="box box-right">
                        <div>
                            Điểm đến
                        </div>
                        <span class="group-location">
                            <span class="ellipsis"><?= $l_location ?></span>
                            <span class="emote-next"><i class='bx bx-right-arrow-alt'></i></span>
                            <span class="ellipsis"><?= $f_location ?></span>
                            <span class="date">
                                <?= $end_date ?>
                            </span>
                        </span>
                        <a href="./payment.html">Không chọn chuyến về</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!--box location end-->

<!--Content start-->
<section class="ticket-content my-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <div class="filter-ticket">
                    <button id="btn-show-filter" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#filter-ticket" aria-controls="filter-ticket" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="oi oi-menu"></span> Bộ lọc
                    </button>
                    <div class="collapse show" id="filter-ticket">
                        <div class="collapse-item title">
                            <span>Lọc</span>
                            <span class="ml-auto"><button>Reset</button></span>
                        </div>
                        <div class="collapse-item">
                            <a data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Thời gian khởi hành</a>
                            <span class="float-right"><i class='bx bx-chevron-down'></i></span>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                        <div class="d-flex">
                                            <input type="checkbox" id="time_begin_mooning">
                                            <label for="time_begin_mooning">Sáng (từ 00:00 AM - 11:59 AM)</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="time_begin_afternoon">
                                            <label for="time_begin_afternoon">Chiều (từ 12:00 PM - 06:59 PM)</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="time_begin_night">
                                            <label for="time_begin_night">Tối (từ 07:00 PM - 11:59 PM)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse-item">
                            <a data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Nhà xe</a>
                            <span class="float-right"><i class='bx bx-chevron-down'></i></span>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                                        <div class="d-flex">
                                            <input type="checkbox" id="car_home_1">
                                            <label for="car_home_1">Giant Ibis</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="car_home_2">
                                            <label for="car_home_2">Hoàng Gia</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="car_home_3">
                                            <label for="car_home_3">Khải Nam</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse-item">
                            <a data-toggle="collapse" href="#cozy" role="button" aria-expanded="false" aria-controls="cozy">Tiện nghi</a>
                            <span class="float-right"><i class='bx bx-chevron-down'></i></span>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="cozy">
                                        <div class="d-flex">
                                            <input type="checkbox" id="cozy_1">
                                            <label for="cozy_1">Đồ ăn trên xe</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="cozy_2">
                                            <label for="cozy_2">Ghế Massage</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="cozy_3">
                                            <label for="cozy_3">Ổ cắm</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="cozy_4">
                                            <label for="cozy_4">Tivi</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="cozy_5">
                                            <label for="cozy_5">Wifi</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="cozy_1">
                                            <label for="cozy_1">Đồ ăn trên xe</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="cozy_2">
                                            <label for="cozy_2">Ghế Massage</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="cozy_3">
                                            <label for="cozy_3">Ổ cắm</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="cozy_4">
                                            <label for="cozy_4">Tivi</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="cozy_5">
                                            <label for="cozy_5">Wifi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse-item">
                            <a data-toggle="collapse" href="#point_form" role="button" aria-expanded="false" aria-controls="point_form">Điểm Đón Khách</a>
                            <span class="float-right"><i class='bx bx-chevron-down'></i></span>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="point_form">
                                        <div class="d-flex">
                                            <input type="checkbox" id="point_form_1">
                                            <label for="point_form_1">Quận 1</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="point_form_2">
                                            <label for="point_form_2">Quận 5</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="point_form_3">
                                            <label for="point_form_3">Hồ Chí Minh</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse-item">
                            <a data-toggle="collapse" href="#point_to" role="button" aria-expanded="false" aria-controls="point_to">Điểm Trả Khách</a>
                            <span class="float-right"><i class='bx bx-chevron-down'></i></span>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="point_to">
                                        <div class="d-flex">
                                            <input type="checkbox" id="point_to_1">
                                            <label for="point_to_1">Kyoto</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="point_to_2">
                                            <label for="point_to_2">Tokyo</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="point_to_3">
                                            <label for="point_to_3">Okyo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mb-3">
                <div class="ticket-body">
                    <div class="find-trip">
                        <i>(Tìm được <span> 20 </span> chuyến thích hợp)</i>
                    </div>
                    <?php
                    foreach ($getAllTicket as $item) {
                    ?>
                        <div class="card-body mb-3">
                            <div class="card-top">
                                <div class="row">
                                    <div class="col-lg-2 col-md-12 col-12 margin-mb-1 flex-mb">
                                        <p><b><?= $item['time_duration'] ?></b></p>
                                        <p class="margin-ml-1"><span>00h04m*</span></p>
                                    </div>
                                    <div class="col-lg-2 col-md-5 col-5 margin-mb-1">
                                        <p><?= $item['location_pick'] ?></p>
                                        <!-- <p><span>( <?= $item['location_pick'] ?> )</span></p> -->
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-2 margin-mb-1">
                                        <span class="icon-next"><i class='bx bxs-chevron-right'></i> </span>
                                    </div>
                                    <div class="col-lg-2 col-md-5 col-5 margin-mb-1">
                                        <p><?= $item['location_drop'] ?></p>
                                        <!-- <p><span>( Hồ Chí Minh )</span></p> -->
                                    </div>
                                    <div class="col-lg-1 col-md-12 col-12 margin-mb-1">
                                        <p><?= $item['seat'] ?> chỗ</p>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-6">
                                        <p><span><i class='bx bx-user'></i></span> <b>VND <?= number_format($item['price']) ?></b></p>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-6 text-center">
                                        <button data-ticket="<?= $item['ticket_id'] ?>" type="button" data-toggle="modal" data-target="#modal_booking_ticket" class="btn btn-success booking-car">Chọn</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-bottom">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 col-md-4 col-4">
                                        <img src="./images/agency/<?= $item['img_logo'] ?>" class="img-fluid" alt="<?= $item['img_logo'] ?>">
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-8">
                                        <span><?= $item['agency_name'] ?> • Xe nằm <?= $item['seat'] ?> chỗ</span>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-12">
                                        <a href="#">Photo</a>
                                        <span> | </span>
                                        <button type="button" data-toggle="modal" data-target="#modal_ticket">Chi
                                            tiết</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Content end-->

<!-- Total Start -->
<section class="ftco-counter ftco-section img" id="section-counter" style="background-image: url(https://easycdn.blob.core.windows.net/images/statistic-bg.jpg);background-attachment: fixed;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="60">0</strong>
                        <span>Năm <br>Kinh nghiệm</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="1090">0</strong>
                        <span>Tổng <br>Ô tô</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="2590">0</strong>
                        <span>Khách hàng <br>Hài lòng</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text d-flex align-items-center">
                        <strong class="number" data-number="67">0</strong>
                        <span>Tổng <br>chi nhánh</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Total Start -->

<!-- Modal Chi tiết vé -->
<div class="modal fade" id="modal_ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết vé</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12 mb-3">
                        <table class="table-striped w-100">
                            <thead>
                                <tr class="table-success">
                                    <th colspan="2">Thông tin khởi hành</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="25%">Ngày</td>
                                    <td>29 April 2023</td>
                                </tr>
                                <tr>
                                    <td width="25%">Giờ</td>
                                    <td>05:00</td>
                                <tr>
                                    <td width="25%">Địa điểm</td>
                                    <td>Quận 1</td>
                                </tr>
                                <tr>
                                    <td width="25%">Địa chỉ</td>
                                    <td>Văn phòng Quận 1(131 Nguyễn Thái Bình)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12 mb-3">
                        <table class="table-striped w-100">
                            <thead>
                                <tr class="table-success">
                                    <th colspan="2">Thông tin loại xe và giá vé</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="25%">Bus Name</td>
                                    <td>Limousine 9 chỗ</td>
                                </tr>
                                <tr>
                                    <td width="25%">Giá vé</td>
                                    <td>Người lớn: VND 220000.00 <br>
                                        Trẻ em: VND 220000.00</td>
                                <tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <table class="table-striped w-100">
                            <thead>
                                <tr class="table-success">
                                    <th colspan="2">Thông tin điểm đến</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="25%">Ngày</td>
                                    <td>30 April 2023</td>
                                </tr>
                                <tr>
                                    <td width="25%">Giờ</td>
                                    <td>05:00</td>
                                <tr>
                                    <td width="25%">Địa điểm</td>
                                    <td>Thành phố Vũng Tàu</td>
                                </tr>
                                <tr>
                                    <td width="25%">Địa chỉ</td>
                                    <td>Văn phòng Vũng Tàu(33 Đường 3/2, TP Vũng Tàu)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal đặt vé 1 tang -->
<div class="modal fade" id="modal_booking_ticket" tabindex="-1" role="dialog" aria-labelledby="modal_booking_ticket" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Chọn ghế cho chuyến đi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="flow-y">
                    <div class="guide">
                        <div>
                            <span>Có sẵn</span>
                            <span class="over">Đã hết</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6 col-md-12 col-12 mb-4">
                            <label><b>Thiết lập sơ đồ ghế:</b></label>
                            <div>
                                <div id="floor_one" class="row d-flex justify-content-center">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="map-car">
                                                <p>Tầng dưới</p>
                                                <div class="driver">
                                                    <img src="../../public/img/icon-steering.jpg" alt="Driver">
                                                </div>
                                                <p>Phía trước</p>
                                                <div class="map-content">
                                                    <div class="seat_row no-gutters">
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="0" data-col="0">A1</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="0" data-col="1">A2</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="0" data-col="2">A3</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="0" data-col="3">A4</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="0" data-col="4">A5</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="1" data-col="0">A6</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="1" data-col="1">A7</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="1" data-col="2">A8</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="1" data-col="3">A9</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="1" data-col="4">A10</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="2" data-col="0">A11</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="2" data-col="1">A12</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="2" data-col="2">A12</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="2" data-col="3">A14</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="2" data-col="4">A15</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="3" data-col="0">A16</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="3" data-col="1">A17</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="3" data-col="2">A18</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="3" data-col="3">A19</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="3" data-col="4">A20</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="4" data-col="0">A21</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="4" data-col="1">A22</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="4" data-col="2">A23</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="4" data-col="3">A24</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="1" data-row="4" data-col="4">A25</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>Phía sau</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="floor_two" class="col-lg-6 col-md-6 col-12">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="map-car">
                                                <p>Tầng trên</p>
                                                <div class="driver">
                                                    <img src="../../public/img/icon-steering.jpg" alt="Driver">
                                                </div>
                                                <p>Phía trước</p>
                                                <div class="map-content">
                                                    <div class="seat_row no-gutters">
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="0" data-col="0">B1</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="0" data-col="1">B2</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="0" data-col="2">B3</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="0" data-col="3">B4</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="0" data-col="4">B5</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="1" data-col="0">B6</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="1" data-col="1">B7</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="1" data-col="2">B8</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="1" data-col="3">B9</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="1" data-col="4">B10</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="2" data-col="0">B11</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="2" data-col="1">B12</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="2" data-col="2">B13</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="2" data-col="3">B14</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="2" data-col="4">B15</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="3" data-col="0">B16</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="3" data-col="1">B17</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="3" data-col="2">B18</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="3" data-col="3">B19</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="3" data-col="4">B20</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="4" data-col="0">B21</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="4" data-col="1">B22</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="4" data-col="2">B23</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="4" data-col="3">B24</div>
                                                        </div>
                                                        <div class="seat_col">
                                                            <div class="desk" data-floor="2" data-row="4" data-col="4">B25</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>Phía sau</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-12 mb-4">
                            <div class="form-group mb-4">
                                <label>Điểm đón khách</label>
                                <select name="pick_user" class="form-control" required>
                                    <option value="1">Chọn điểm đón khách</option>
                                    <option value="1">14:00 29-04-2023 | Văn phòng Quận 1(131 Nguyễn Thái Bình)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Điểm trả khách</label>
                                <select name="drop_user" class="form-control" required>
                                    <option value="1">Chọn điểm đón khách</option>
                                    <option value="1">14:00 29-04-2023 | Văn phòng Quận 1(131 Nguyễn Thái Bình)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <table class="table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">Loại vé</th>
                                        <th scope="col">Giá vé(VND)</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng(VND)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>220000</td>
                                        <td>220000</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tổng Giá Vé: </b></td>
                                        <td colspan="3">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card">
                                <p><b>Ghi chú:</b></p>
                                <p><span>Chỉ cho phép chọn tối đa 6 ghế cho 1 lần đặt vé.</span></p>
                                <p><b>Tri ân khách hàng:</b></p>
                                <p><span> - Giảm ngay 10k/vé khi quý khách đặt vé khứ hồi (Chương trình không áp dụng t7, cn và ngày lễ. Vé áp dụng giảm giá khứ hồi bắt buộc thanh toán trước) Quý khách vui lòng liên hệ tổng đài VXR để được tư vấn hỗ trợ - Miễn phí bánh ngọt và nước tại phòng chờ của nhà xe</span></p>
                                <p><span>
                                        - Nhà xe cho phép mang thú cưng lên xe nếu có lồng và chỉ được để ở cốp phía sau xe chứ không được ẳm hoặc để trên ghế ngồi. Nhà xe phụ thu 70k trên một vật nuôi. Xin cảm ơn quý khách.
                                    </span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="./payment.html" type="button" class="btn btn-light">Vé một chiều</a>
                <button id="choose_drop_date" type="button" class="btn btn-secondary" data-dismiss="modal">Chọn chuyến lượt về</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal đặt vé 2 tang -->
<div class="modal fade" id="modal_booking_ticket_2" tabindex="-1" role="dialog" aria-labelledby="modal_booking_ticket_2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Chọn ghế cho chuyến đi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="flow-y">
                    <div class="guide">
                        <div>
                            <span>Có sẵn</span>
                            <span class="over">Đã hết</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="map-car">
                                    <p>Tầng dưới</p>
                                    <div class="driver">
                                        <img src="./images/icon-steering.jpg" alt="Driver">
                                    </div>
                                    <p>Phía trước</p>
                                    <div class="map-content">
                                        <div class="row no-gutters">
                                            <div class="col-4">
                                                <!-- <div class="desk ">B1</div> -->
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">B1</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk over">B2</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk active">A3</div>
                                            </div>
                                            <div class="col-4">
                                                <!-- <div class="desk">B1</div> -->
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A4</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A5</div>
                                            </div>
                                            <div class="col-4">
                                                <!-- <div class="desk">B1</div> -->
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A6</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A7</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A8</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A9</div>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Phía sau</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="map-car">
                                    <p>Tầng trên</p>
                                    <div class="driver">
                                        <img src="./images/icon-steering.jpg" alt="Driver">
                                    </div>
                                    <p>Phía trước</p>
                                    <div class="map-content">
                                        <div class="row no-gutters">
                                            <div class="col-4">
                                                <!-- <div class="desk ">B1</div> -->
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">B1</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk over">B2</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk active">A3</div>
                                            </div>
                                            <div class="col-4">
                                                <!-- <div class="desk">B1</div> -->
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A4</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A5</div>
                                            </div>
                                            <div class="col-4">
                                                <!-- <div class="desk">B1</div> -->
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A6</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A7</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A8</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="desk">A9</div>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Phía sau</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 mb-4">
                            <div class="form-group mb-4">
                                <label>Điểm đón khách</label>
                                <select name="pick_user" class="form-control" required>
                                    <option value="1">Chọn điểm đón khách</option>
                                    <option value="1">14:00 29-04-2023 | Văn phòng Quận 1(131 Nguyễn Thái Bình)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Điểm trả khách</label>
                                <select name="drop_user" class="form-control" required>
                                    <option value="1">Chọn điểm đón khách</option>
                                    <option value="1">14:00 29-04-2023 | Văn phòng Quận 1(131 Nguyễn Thái Bình)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <table class="table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">Loại vé</th>
                                        <th scope="col">Giá vé(VND)</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng(VND)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>220000</td>
                                        <td>220000</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tổng Giá Vé: </b></td>
                                        <td colspan="3">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card">
                                <p><b>Ghi chú:</b></p>
                                <p><span>Chỉ cho phép chọn tối đa 6 ghế cho 1 lần đặt vé.</span></p>
                                <p><b>Tri ân khách hàng:</b></p>
                                <p><span> - Giảm ngay 10k/vé khi quý khách đặt vé khứ hồi (Chương trình không áp dụng t7, cn và ngày lễ. Vé áp dụng giảm giá khứ hồi bắt buộc thanh toán trước) Quý khách vui lòng liên hệ tổng đài VXR để được tư vấn hỗ trợ - Miễn phí bánh ngọt và nước tại phòng chờ của nhà xe</span></p>
                                <p><span>
                                        - Nhà xe cho phép mang thú cưng lên xe nếu có lồng và chỉ được để ở cốp phía sau xe chứ không được ẳm hoặc để trên ghế ngồi. Nhà xe phụ thu 70k trên một vật nuôi. Xin cảm ơn quý khách.
                                    </span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="./payment.html" type="button" class="btn btn-light">Vé một chiều</a>
                <button id="choose_drop_date" type="button" class="btn btn-secondary" data-dismiss="modal">Chọn chuyến lượt về</button>
            </div>
        </div>
    </div>
</div>
<?php include "./footer.php"; ?>