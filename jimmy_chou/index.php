<?php
include "./header.php";
require_once "../model/transport.php";
require_once "../model/location.php";

$transport = new Transport();
$getAllTransport = $transport->getAllTransportHome();
$count = 1;
$count_content = 1;

$limit = 8;
$location = new Location();
$getAllLocation = $location->getAllLocationLimit($limit);
?>


<div class="hero-wrap ftco-degree-bg" style="background-image: url('images/bg-keribook.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
</div>

<!--Booking start-->
<section class="booking_keri ftco-no-pt bg-light">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-12 featured-top-booking">
                <div class="heading">
                    <h3>Trang Web Bán Vé Đường Bộ & Đường Biển Lớn Nhất Đ.N.A</h3>
                    <span>(Singapore, Malaysia, Indonesia, Thái Lan, Brunei, Việt Nam, Myanmar, Campuchia, Laos)</span>
                </div>
                <div id="pick_option_rental" class="row m-0">
                    <div class="col-md-12 pills">
                        <div class="bd-example bd-example-tabs p-3">
                            <!--Tab Pills-->
                            <div class="d-flex justify-content-start">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <?php 
                                    
                                    foreach ($getAllTransport as $item) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($count == 1){echo "active";}?>" id="pills-tab-<?=$count?>" data-toggle="pill" href="#pills-<?=$count?>" role="tab" aria-controls="pills-<?=$count?>" aria-expanded="true">
                                                <div class="icon-vehicle">
                                                    <i class='<?= $item['icon'] ?>'></i>
                                                </div>
                                                <div class="name"><?= $item['name'] ?></div>
                                                <input type="number" class="value_transport" value="<?=$item['id']?>" hidden>
                                                <?php if($item['trip_type'] == 1){ ?>
                                                    <input type="number" class="value_trip_type" value="1" hidden>
                                                <?php  }else{ ?>
                                                    <input type="number" class="value_trip_type" value="0" hidden>
                                                <?php  } ?>
                                            </a>
                                        </li>
                                    <?php $count++; } ?>
                                </ul>
                            </div>
                            <!--Tab Content-->
                            <div class="tab-content" id="pills-tabContent">
                                <?php foreach($getAllTransport as $item){ ?>
                                    <div class="tab-pane fade show <?php if($count_content == 1){echo "active";}?>" id="pills-<?=$count_content?>" role="tabpanel" aria-labelledby="pills-<?=$count_content?>">
                                        <div class="title">
                                            <h4><span><?= $item['name'] ?></span></h4>
                                            <div class="suggest">
                                                <span>[ <?= $item['subtitle'] ?> ]</span>
                                            </div>
                                        </div>
                                        <?php if($item['trip_type'] == 0){?>
                                            <input type="radio" name="way" id="oneway" checked>
                                            <label data-type="radio" for="oneway">Một chiều</label>
                                            <input type="radio" name="way" id="roundway">
                                            <label data-type="radio" for="roundway">Khứ hồi</label>
                                        <?php } ?>

                                        <form autocomplete="off" action="./booking.php" method="post" class="request-form ftco-animate">
                                            <input type="number" name="trip_type" class="trip_type"  hidden><!--1 way or roundway-->
                                            <input type="number" name="transport_id" class="transport_id" hidden>

                                            <?php if($item['trip_type'] == 0){?>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="" class="label">Từ</label>
                                                            <!-- <input class="form-control" onclick="popupOpen()" type="text" id="keyword" value="" name="address" readonly> -->
                                                            <div class="g-location">
                                                                <span>
                                                                    <i class='bx bxs-location-plus'></i>
                                                                </span>
                                                                <input class="form-control" list="GFGOptions" id="GFGDataList" name="first-location" placeholder="Select option" required>
                                                            </div>
                                                            <datalist id="GFGOptions">
                                                                <?php foreach($getAllLocation as $location){ ?>
                                                                    <option value="<?=$location['location_pick']?>">
                                                                <?php } ?>
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="" class="label">Đến</label>
                                                            <div class="g-location">
                                                                <span>
                                                                    <i class='bx bxs-location-plus'></i>
                                                                </span>
                                                                <input class="form-control" list="option_drop" id="GFGDataList" name="last-location" placeholder="Select option" required>
                                                            </div>
                                                            <datalist id="option_drop">
                                                                <?php foreach($getAllLocation as $location){ ?>
                                                                    <option value="<?=$location['location_drop']?>">
                                                                <?php } ?>
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="" class="label">Ngày khởi hành</label>
                                                            <input type="date" id="" class="form-control" name="start_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-12">
                                                        <div class="form-group" id="round-way">
                                                            <label for="" class="label">Ngày về</label>
                                                            <input id="end_date" class="form-control" name="end_date" placeholder="dd/mm/yyyy">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="" class="label">Số khách</label>
                                                            <select name="pax" id="" class="form-control">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else{?>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="" class="label">Điểm đón</label>
                                                            <div class="g-location">
                                                                <span>
                                                                    <i class='bx bxs-location-plus'></i>
                                                                </span>
                                                                <input class="form-control" list="GFGOptions" id="GFGDataList" name="first-location" placeholder="Select option">
                                                            </div>
                                                            <datalist id="GFGOptions">
                                                                <?php foreach($getAllLocation as $location){ ?>
                                                                    <option value="<?=$location['location_pick']?>">
                                                                <?php } ?>
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="" class="label">Ngày đón</label>
                                                            <input class="form-control" type="date" name="start_date" placeholder="Date">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="" class="label">Giờ đón</label>
                                                            <input class="form-control" type="text" name="time_start" placeholder="Thời gian" id="time_pick">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="" class="label">Ngày về</label>
                                                            <input class="form-control" type="date" name="end_date" placeholder="Date">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="" class="label">Giờ về</label>
                                                            <input class="form-control" type="text" name="time_end" placeholder="Thời gian" id="time_drop">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <button id="search_submit" type="submit" class="btn-submit rounded px-3 py-2">Tìm Kiếm</button>
                                            </div>
                                        </form>
                                    </div>
                                <?php $count_content++;} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Booking end-->

<!-- Header menu Start -->
<section class="ftco-header-menu">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar p-0" id="header-nav-menu">
            <a href="#">Khuyến mãi/Tin mới</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-menu" aria-controls="ftco-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span>
            </button>

            <div class="collapse navbar-collapse" id="ftco-menu">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="index.html" class="nav-link">Thẻ Quà Tặng</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">Đăng ký</a></li>
                    <li class="nav-item"><a href="services.html" class="nav-link">
                            Trở Thành Nhà Cung Cấp</a></li>
                    <li class="nav-item"><a href="car.html" class="nav-link">
                            Chương Trình Hợp Tác
                        </a></li>
                </ul>
                <ul class="social-menu ml-auto">
                    <li><a href="#"> <i class='bx bxl-facebook'></i></a></li>
                    <li><a href="#"> <i class='bx bxl-twitter'></i></a></li>
                    <li><a href="#"><i class='bx bxl-pinterest'></i> </a></i></li>
                    <li><a href="#"><i class='bx bxl-instagram'></i> </a></li>
                </ul>
            </div>
        </nav>
    </div>
</section>
<!-- Header menu End -->

<!-- Feature Start -->
<section class="promo-section bg-light py-4">
    <div class="container">
        <div class="row ftco-animate gap-3 justify-content-center align-items-center mb-3">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="promo-col">
                    <div class="promo-title">Giới thiệu & Nhận ngay VND66.000</div>
                    <div class="promo-desc">Hơn VND143 million triệu đồng hoa hồng giới thiệu!</div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="promo-col">
                    <div class="promo-title">Nhận 5% tiền thưởng mỗi năm qua Ví JimmyChou</div>
                    <div class="promo-desc">Tính gộp hằng ngày, rút tiền bất kỳ lúc nào</div>
                </div>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4">
                            <div class="text pt-4" style="background: url(./images/features-2.b132c16e.jpg) no-repeat center;height: 204px;border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4">
                            <div class="text pt-4" style="background: url(./images/features-3.df3f531c.jpg) no-repeat center;height: 204px;border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4">
                            <div class="text pt-4" style="background: url(./images/features-5.6d62e376.jpg) no-repeat center;height: 204px;border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4">
                            <div class="text pt-4" style="background: url(./images/features-6.683ce1e0.jpg) no-repeat center;height: 204px;border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="item">
            <div class="testimony-wrap rounded text-center py-4 pb-5">
              <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
              </div>
              <div class="text pt-4">
                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                <p class="name">Roger Scott</p>
                <span class="position">System Analyst</span>
              </div>
            </div>
          </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Feature End -->

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

<!-- Reasoon start -->
<section class="ftco-reasoon ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <h3 class="mb-3"><b>Tại sao nên đặt vé tại JimmyChou?</b></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 mb-4">
                <div class="reasoon-item">
                    <span class="reasoon-icon"><i class='bx bx-data'></i></span>
                    <div>
                        <div class="reasoon-title">1. Nhận Easipoints</div>
                        <p>Nhận thưởng cho mỗi lần mua vé. Thu thập điểm Easipoint cho mỗi lần bạn mua hàng, tích điểm và nhận được khoản giảm giá cho lần mua hàng tiếp theo!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 mb-4">
                <div class="reasoon-item">
                    <span class="reasoon-icon"><i class='bx bx-bar-chart-alt-2'></i></span>
                    <div>
                        <div class="reasoon-title">2. Đáng tin cậy</div>
                        <p>Với hơn 13 năm kinh nghiệm trong lĩnh vực vận tải, chúng tôi có được nền tảng vững chắc thông qua những thành công nhất định và luôn hướng đến dịch vụ chất lượng cho khách hàng.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 mb-4">
                <div class="reasoon-item">
                    <span class="reasoon-icon"><i class='bx bxs-plane-alt'></i></span>
                    <div>
                        <div class="reasoon-title">3. Đa dạng hình thức thanh toán</div>
                        <p>Lựa chọn đa dạng các hình thức thanh toán cũng như đơn vị tệ, chúng tôi giúp cho quá trình mua hàng của bạn trở nên tiện lợi hơn.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 mb-4">
                <div class="reasoon-item">
                    <span class="reasoon-icon"><i class='bx bx-archive-out'></i></span>
                    <div>
                        <div class="reasoon-title">4. Giá vé trung thực</div>
                        <p>Những gì bạn thấy là những gì bạn sẽ trả. Không tăng giá. Không có phí ẩn. Chúng tôi mang đến dịch vụ chất lượng và giao dịch tuyệt vời với giá phải chăng.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 mb-4">
                <div class="reasoon-item">
                    <span class="reasoon-icon"><i class='bx bxs-plane-alt'></i></span>
                    <div>
                        <div class="reasoon-title">5. Nền Tảng Đặt Vé Trực Tuyến danh cho Đường Bộ và Đường Thủy lớn nhất Đông Nam Á</div>
                        <p>Chúng tôi là nền tảng đặt vé trực tuyến dành cho dịch vụ giao thông đường bộ và đường thủy tại Đông Nam Á, cung cấp đa dạng vé di chuyển giúp kết nối bạn với những điểm đến mới lạ nhất.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 mb-4">
                <div class="reasoon-item">
                    <span class="reasoon-icon"><i class='bx bx-time'></i></span>
                    <div>
                        <div class="reasoon-title">6. Giảm giá & Khuyến mãi</div>
                        <p>Chương trình khuyến mãi thường xuyên dành cho khách hàng! Cập nhập với chúng tôi để có được giá thấp nhất.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>
<!-- Reasoon end -->

<!--Testiminal start-->
<section class="ftco-section testimony-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Testimonial</span>
                <h2 class="mb-3">Happy Clients</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <p class="name">Roger Scott</p>
                                <span class="position">Marketing Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url(images/person_2.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <p class="name">Roger Scott</p>
                                <span class="position">Interface Designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url(images/person_3.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <p class="name">Roger Scott</p>
                                <span class="position">UI Designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <p class="name">Roger Scott</p>
                                <span class="position">Web Developer</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <p class="name">Roger Scott</p>
                                <span class="position">System Analyst</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Testiminal end-->

<!-- Our last services Start-->
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Services</span>
                <h2 class="mb-3">Our Latest Services</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Wedding Ceremony</h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">City Transfer</h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Airport Transfer</h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Whole City Tour</h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our last services End-->






<?php include "./footer.php"; ?>