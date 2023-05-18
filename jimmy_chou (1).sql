-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 18, 2023 lúc 08:46 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `jimmy_chou`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `create_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345', '2023-05-18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `agency`
--

CREATE TABLE `agency` (
  `id` int(11) NOT NULL,
  `agency_name` text NOT NULL,
  `img_logo` text NOT NULL,
  `description` text NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `agency`
--

INSERT INTO `agency` (`id`, `agency_name`, `img_logo`, `description`, `create_at`) VALUES
(1, 'Toyota', 'car2.jpg', 'null', '2023-05-18'),
(2, 'Huyhdai', 'Business_Cadillac-Halo-001 (1).png', '', '2023-05-18'),
(3, 'BMW', 'car_content.jpg', '', '2023-05-18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diagram_seat`
--

CREATE TABLE `diagram_seat` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `col` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `diagram_seat`
--

INSERT INTO `diagram_seat` (`id`, `vehicle_id`, `floor`, `row`, `col`) VALUES
(1, 1, 1, 2, 2),
(2, 1, 1, 1, 2),
(3, 1, 1, 0, 2),
(4, 2, 1, 0, 0),
(5, 2, 1, 0, 1),
(6, 2, 1, 1, 0),
(7, 2, 1, 1, 1),
(8, 2, 1, 2, 1),
(9, 2, 1, 2, 0),
(10, 2, 1, 2, 2),
(11, 3, 1, 0, 0),
(12, 3, 1, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location_pick` text NOT NULL,
  `location_drop` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `location`
--

INSERT INTO `location` (`id`, `location_pick`, `location_drop`, `status`) VALUES
(1, 'Ho Chi Minh, Ho Chi Minh', 'Binh Chanh District, Ho Chi Minh', 0),
(2, 'Chợ Nổi Cái Răng, Cần Thơ', 'Bà Rịa - Vũng Tàu', 1),
(3, 'Da Lat Terminal, Da Lat', 'Phường Lộc Thọ, Nha Trang, Khánh Hòa', 1),
(4, 'Bến xe Đà Lạt, Đà Lạt', 'Khánh Hòa', 1),
(5, 'Khánh Hòa', 'Xuân Lộc, Đồng Nai', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `misstion_vehicle`
--

CREATE TABLE `misstion_vehicle` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `misstion_vehicle`
--

INSERT INTO `misstion_vehicle` (`id`, `vehicle_id`, `location_id`) VALUES
(1, 2, 3),
(3, 1, 3),
(4, 3, 2),
(5, 3, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `point_pick` text NOT NULL,
  `point_drop` text NOT NULL,
  `location_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `station`
--

INSERT INTO `station` (`id`, `point_pick`, `point_drop`, `location_id`, `status`) VALUES
(1, 'Ngã tư An Xuân', '302 đường Song Hành, quận 2, tp.Hồ Chí Minh', 1, 1),
(2, 'Bến xe miền đông', 'Bình Chánh', 1, 1),
(3, 'Ngã 3 Đà Lạt', 'Lộc Thọ', 3, 1),
(4, 'Ngã tư An Xuân 2', 'bến xe Test 2', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `transport_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `date_duration` date NOT NULL,
  `time_duration` text NOT NULL,
  `price` int(11) NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ticket`
--

INSERT INTO `ticket` (`id`, `transport_id`, `vehicle_id`, `location_id`, `date_duration`, `time_duration`, `price`, `create_at`) VALUES
(1, 1, 1, 1, '2023-05-20', '10:00am', 240000, '2023-05-18'),
(3, 1, 1, 3, '2023-05-25', '12:30pm', 190000, '2023-05-18'),
(6, 2, 2, 1, '0000-00-00', '', 0, '2023-05-18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transport`
--

CREATE TABLE `transport` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `icon` text NOT NULL,
  `subtitle` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `trip_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `transport`
--

INSERT INTO `transport` (`id`, `name`, `icon`, `subtitle`, `status`, `trip_type`) VALUES
(1, 'Vé thuê Ôto', 'bx bx-car', 'Cho thuê oto', 1, 1),
(2, 'Vé xe buýt', 'bx bx-bus', 'Mô tả xe buýt', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `license_plate` text NOT NULL,
  `seat` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vehicle`
--

INSERT INTO `vehicle` (`id`, `name`, `image`, `license_plate`, `seat`, `floor`, `agency_id`) VALUES
(1, 'Xe 1', 'car_content.jpg', '85-411996', 3, 1, 1),
(2, 'HuynhDai 1080cc', 'car_content.jpg', '85-411996', 7, 1, 2),
(3, 'Lambogini', 'Business_Cadillac-Halo-001 (1).png', '85-411996', 2, 1, 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `diagram_seat`
--
ALTER TABLE `diagram_seat`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `misstion_vehicle`
--
ALTER TABLE `misstion_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `agency`
--
ALTER TABLE `agency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `diagram_seat`
--
ALTER TABLE `diagram_seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `misstion_vehicle`
--
ALTER TABLE `misstion_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
