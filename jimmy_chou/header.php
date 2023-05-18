<?php
include_once "../model/config.php";
include_once "../model/database.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Carbook - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <!-- or the reference on CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- themify icon -->
    <link rel="stylesheet" href="css/css/themify-icons.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="./css/ani-car.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php"><span>JimmyChou</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="recentsearch.html" class="nav-link">Tìm kiếm gần đây</a></li>
                    <li class="nav-item"><a href="news.html" class="nav-link">Bài Viết</a></li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Liên hệ</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">Về chúng tôi</a></li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" href="#" role="button" id="language"> Việt Nam</a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <a class="dropdown-item" onclick="doGTranslate('vi|en');document.querySelector('#language').textContent='English'" href="#">
                                <span class="flag-icon flag-icon-us"></span> English</a>
                            <a class="dropdown-item" onclick="doGTranslate('vi|ja');document.querySelector('#language').textContent='Japan'" href="#"><span class="flag-icon flag-icon-jp"></span> Japanese</a>
                            <a class="dropdown-item" onclick="doGTranslate('vi|vi');document.querySelector('#language').textContent='Việt Nam'" href="#"><span class="flag-icon flag-icon-vn"></span> Vietnamese</a>
                            <a class="dropdown-item" onclick="doGTranslate('vi|zh-CN');document.querySelector('#language').textContent='Chinese'" href="#"><span class="flag-icon flag-icon-cn"></span> Chinese</a>
                        </div>
                        <div id="google_translate_element2"></div>
                    </li>
                    <li class="nav-item">
                        <a href="car-single.html" class="nav-link btn btn-outline-white ">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->