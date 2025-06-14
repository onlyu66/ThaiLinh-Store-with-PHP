-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 04:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbshopabc`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Xiaomi'),
(4, 'OPPO'),
(5, 'TLC'),
(6, 'Masstel'),
(7, 'Nokia'),
(8, 'realme'),
(9, 'HTC'),
(10, 'Nubia'),
(11, 'TECNO'),
(12, 'Vivo'),
(13, 'Infinix'),
(14, 'XOR'),
(15, 'Itel'),
(16, 'ROG'),
(17, 'ZTE'),
(18, 'Sony'),
(19, 'JBL\r\n'),
(20, 'HONOR');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'phone'),
(2, 'headphone'),
(3, 'speaker'),
(4, 'pin'),
(5, 'monitor'),
(6, 'fan'),
(7, 'charger-cable'),
(8, 'storage-usb'),
(9, 'phoneCase'),
(10, 'backupCharger'),
(11, 'screenProtector'),
(12, 'balo'),
(13, 'handBag'),
(14, 'shockproofBag');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `colorCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `colorCode`) VALUES
(1, 'Đen', ''),
(2, 'Trắng', 'text-white'),
(3, 'Xám', 'text-gray-600'),
(4, 'Đỏ', 'text-red-600'),
(5, 'Hồng', 'text-pink-400'),
(6, 'Vàng', 'text-yellow-400'),
(7, 'Xanh dương', 'text-blue-500'),
(8, 'Xanh lá', 'text-green-500'),
(9, 'Xanh ngọc', 'text-teal-500'),
(10, 'Tím', 'text-fuchsia-300'),
(11, 'Cam', 'text-orange-600');

-- --------------------------------------------------------

--
-- Table structure for table `deliverymethod`
--

CREATE TABLE `deliverymethod` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliverymethod`
--

INSERT INTO `deliverymethod` (`id`, `name`) VALUES
(1, 'Nhận tại cửa hàng!'),
(2, 'Giao tận giường!');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `subjectName` varchar(200) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `thumbnail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `productId`, `thumbnail`) VALUES
(196, 100, './assets/images/uploads/iphone-15-pro-black-titanium-pure-back-iphone-15-pro-black-titanium-pure-front-2up-screen-usen.webp'),
(197, 100, './assets/images/uploads/iphone-15-pro-blue-titanium-pure-back-iphone-15-pro-blue-titanium-pure-front-2up-screen-usen.webp'),
(198, 100, './assets/images/uploads/iphone-15-pro-natural-titanium-pure-back-iphone-15-pro-natural-titanium-pure-front-2up-screen-usen.webp'),
(199, 100, './assets/images/uploads/iphone-15-pro-white-titanium-pure-back-iphone-15-pro-white-titanium-pure-front-2up-screen-usen.webp'),
(200, 101, './assets/images/uploads/iphone-15-pro-black-titanium-pure-back-iphone-15-pro-black-titanium-pure-front-2up-screen-usen.webp'),
(201, 101, './assets/images/uploads/iphone-15-pro-blue-titanium-pure-back-iphone-15-pro-blue-titanium-pure-front-2up-screen-usen.webp'),
(202, 101, './assets/images/uploads/iphone-15-pro-natural-titanium-pure-back-iphone-15-pro-natural-titanium-pure-front-2up-screen-usen.webp'),
(203, 101, './assets/images/uploads/iphone-15-pro-white-titanium-pure-back-iphone-15-pro-white-titanium-pure-front-2up-screen-usen.webp'),
(204, 102, './assets/images/uploads/iphone-15-pro-black-titanium-pure-back-iphone-15-pro-black-titanium-pure-front-2up-screen-usen.webp'),
(205, 102, './assets/images/uploads/iphone-15-pro-blue-titanium-pure-back-iphone-15-pro-blue-titanium-pure-front-2up-screen-usen.webp'),
(206, 102, './assets/images/uploads/iphone-15-pro-natural-titanium-pure-back-iphone-15-pro-natural-titanium-pure-front-2up-screen-usen.webp'),
(207, 102, './assets/images/uploads/iphone-15-pro-white-titanium-pure-back-iphone-15-pro-white-titanium-pure-front-2up-screen-usen.webp'),
(212, 98, './assets/images/uploads/iphone-15-pro-max-black-titanium-pure-back-iphone-15-pro-max-black-titanium-pure-front-2up-screen-usen.webp'),
(213, 98, './assets/images/uploads/iphone-15-pro-max-blue-titanium-pure-back-iphone-15-pro-max-blue-titanium-pure-front-2up-screen-usen.webp'),
(214, 98, './assets/images/uploads/iphone-15-pro-max-natural-titanium-pure-back-iphone-15-pro-max-natural-titanium-pure-front-2up-screen-usen.webp'),
(215, 98, './assets/images/uploads/iphone-15-pro-max-white-titanium-pure-back-iphone-15-pro-max-white-titanium-pure-front-2up-screen-usen.webp'),
(216, 97, './assets/images/uploads/iphone-15-pro-max-black-titanium-pure-back-iphone-15-pro-max-black-titanium-pure-front-2up-screen-usen.webp'),
(217, 97, './assets/images/uploads/iphone-15-pro-max-natural-titanium-pure-back-iphone-15-pro-max-natural-titanium-pure-front-2up-screen-usen.webp'),
(218, 97, './assets/images/uploads/iphone-15-pro-max-white-titanium-pure-back-iphone-15-pro-max-white-titanium-pure-front-2up-screen-usen.webp'),
(219, 97, './assets/images/uploads/iphone-15-pro-max-blue-titanium-pure-back-iphone-15-pro-max-blue-titanium-pure-front-2up-screen-usen.webp'),
(224, 99, './assets/images/uploads/iphone-15-pro-max-black-titanium-pure-back-iphone-15-pro-max-black-titanium-pure-front-2up-screen-usen.webp'),
(225, 99, './assets/images/uploads/iphone-15-pro-max-blue-titanium-pure-back-iphone-15-pro-max-blue-titanium-pure-front-2up-screen-usen.webp'),
(226, 99, './assets/images/uploads/iphone-15-pro-max-natural-titanium-pure-back-iphone-15-pro-max-natural-titanium-pure-front-2up-screen-usen.webp'),
(227, 99, './assets/images/uploads/iphone-15-pro-max-white-titanium-pure-back-iphone-15-pro-max-white-titanium-pure-front-2up-screen-usen.webp'),
(236, 103, './assets/images/uploads/iphone-15-pro-black-titanium-pure-back-iphone-15-pro-black-titanium-pure-front-2up-screen-usen.webp'),
(237, 103, './assets/images/uploads/iphone-15-pro-blue-titanium-pure-back-iphone-15-pro-blue-titanium-pure-front-2up-screen-usen.webp'),
(238, 103, './assets/images/uploads/iphone-15-pro-natural-titanium-pure-back-iphone-15-pro-natural-titanium-pure-front-2up-screen-usen.webp'),
(239, 103, './assets/images/uploads/iphone-15-pro-white-titanium-pure-back-iphone-15-pro-white-titanium-pure-front-2up-screen-usen.webp'),
(310, 106, './assets/images/uploads/iphone-15-black-pure-back-iphone-15-black-pure-front-2up-screen-usen.webp'),
(311, 106, './assets/images/uploads/iphone-15-blue-pure-back-iphone-15-blue-pure-front-2up-screen-usen.webp'),
(312, 106, './assets/images/uploads/iphone-15-green-pure-back-iphone-15-green-pure-front-2up-screen-usen.webp'),
(313, 106, './assets/images/uploads/iphone-15-pink-pure-back-iphone-15-pink-pure-front-2up-screen-usen_638301948854041434.webp'),
(314, 106, './assets/images/uploads/iphone-15-yellow-pure-back-iphone-15-yellow-pure-front-2up-screen-usen.webp'),
(315, 105, './assets/images/uploads/iphone-15-black-pure-back-iphone-15-black-pure-front-2up-screen-usen.webp'),
(316, 105, './assets/images/uploads/iphone-15-blue-pure-back-iphone-15-blue-pure-front-2up-screen-usen.webp'),
(317, 105, './assets/images/uploads/iphone-15-green-pure-back-iphone-15-green-pure-front-2up-screen-usen.webp'),
(318, 105, './assets/images/uploads/iphone-15-pink-pure-back-iphone-15-pink-pure-front-2up-screen-usen_638301948854041434.webp'),
(319, 105, './assets/images/uploads/iphone-15-yellow-pure-back-iphone-15-yellow-pure-front-2up-screen-usen.webp'),
(320, 104, './assets/images/uploads/iphone-15-black-pure-back-iphone-15-black-pure-front-2up-screen-usen.webp'),
(321, 104, './assets/images/uploads/iphone-15-blue-pure-back-iphone-15-blue-pure-front-2up-screen-usen.webp'),
(322, 104, './assets/images/uploads/iphone-15-pink-pure-back-iphone-15-pink-pure-front-2up-screen-usen_638301948854041434.webp'),
(323, 104, './assets/images/uploads/iphone-15-yellow-pure-back-iphone-15-yellow-pure-front-2up-screen-usen.webp'),
(324, 104, './assets/images/uploads/iphone-15-green-pure-back-iphone-15-green-pure-front-2up-screen-usen.webp'),
(367, 109, './assets/images/uploads/iphone-15-plus-black-pure-back-iphone-15-plus-black-pure-front-2up-screen-usen.webp'),
(368, 109, './assets/images/uploads/iphone-15-plus-blue-pure-back-iphone-15-plus-blue-pure-front-2up-screen-usen.webp'),
(369, 109, './assets/images/uploads/iphone-15-plus-green-pure-back-iphone-15-plus-green-pure-front-2up-screen-usen.webp'),
(370, 109, './assets/images/uploads/iphone-15-plus-pink-pure-back-iphone-15-plus-pink-pure-front-2up-screen-usen_638301951318113946.webp'),
(371, 109, './assets/images/uploads/iphone-15-plus-yellow-pure-back-iphone-15-plus-yellow-pure-front-2up-screen-usen.webp'),
(372, 108, './assets/images/uploads/iphone-15-plus-black-pure-back-iphone-15-plus-black-pure-front-2up-screen-usen.webp'),
(373, 108, './assets/images/uploads/iphone-15-plus-blue-pure-back-iphone-15-plus-blue-pure-front-2up-screen-usen.webp'),
(374, 108, './assets/images/uploads/iphone-15-plus-green-pure-back-iphone-15-plus-green-pure-front-2up-screen-usen.webp'),
(375, 108, './assets/images/uploads/iphone-15-plus-pink-pure-back-iphone-15-plus-pink-pure-front-2up-screen-usen_638301951318113946.webp'),
(376, 108, './assets/images/uploads/iphone-15-plus-yellow-pure-back-iphone-15-plus-yellow-pure-front-2up-screen-usen.webp'),
(377, 107, './assets/images/uploads/iphone-15-plus-blue-pure-back-iphone-15-plus-blue-pure-front-2up-screen-usen.webp'),
(378, 107, './assets/images/uploads/iphone-15-plus-green-pure-back-iphone-15-plus-green-pure-front-2up-screen-usen.webp'),
(379, 107, './assets/images/uploads/iphone-15-plus-pink-pure-back-iphone-15-plus-pink-pure-front-2up-screen-usen_638301951318113946.webp'),
(380, 107, './assets/images/uploads/iphone-15-plus-yellow-pure-back-iphone-15-plus-yellow-pure-front-2up-screen-usen.webp'),
(381, 107, './assets/images/uploads/iphone-15-plus-black-pure-back-iphone-15-plus-black-pure-front-2up-screen-usen.webp'),
(382, 115, './assets/images/uploads/ip14prmd.webp'),
(383, 115, './assets/images/uploads/ip14prmt.webp'),
(384, 115, './assets/images/uploads/ip14prmv.webp'),
(385, 115, './assets/images/uploads/iphone14promax.webp'),
(386, 116, './assets/images/uploads/ip14prmd.webp'),
(387, 116, './assets/images/uploads/ip14prmt.webp'),
(388, 116, './assets/images/uploads/ip14prmv.webp'),
(389, 116, './assets/images/uploads/iphone14promax.webp'),
(443, 111, './assets/images/uploads/airpods-pro-2nd-gen-usb-c-1.webp'),
(444, 111, './assets/images/uploads/airpods-pro-2nd-gen-usb-c-2.webp'),
(445, 111, './assets/images/uploads/airpods-pro-2nd-gen-usb-c-3.webp'),
(446, 111, './assets/images/uploads/airpods-pro-2nd-gen-usb-c-4.webp'),
(447, 111, './assets/images/uploads/airpods-pro-2nd-gen-usb-c-6.webp'),
(448, 110, './assets/images/uploads/AirPods Pro 2 với Hộp Sạc MagSafe (Lightning).webp'),
(449, 110, './assets/images/uploads/AirPods Pro 2 với Hộp Sạc MagSafe (Lightning)1.webp'),
(450, 110, './assets/images/uploads/AirPods Pro 2 với Hộp Sạc MagSafe (Lightning)2.webp'),
(451, 113, './assets/images/uploads/iphone 11 (1).webp'),
(452, 113, './assets/images/uploads/iphone 11 (2).webp'),
(453, 113, './assets/images/uploads/iphone 11 (4).webp'),
(454, 113, './assets/images/uploads/iphone 11 (5).webp'),
(455, 113, './assets/images/uploads/iphone 11 (6).webp'),
(456, 113, './assets/images/uploads/iphone 11 (7).webp'),
(457, 113, './assets/images/uploads/iphone 11 (9).webp'),
(458, 113, './assets/images/uploads/iphone 11 (10).webp'),
(459, 113, './assets/images/uploads/iphone 11 (11).webp'),
(460, 114, './assets/images/uploads/iphone 11 (2).webp'),
(461, 114, './assets/images/uploads/iphone 11 (4).webp'),
(462, 114, './assets/images/uploads/iphone 11 (7).webp'),
(463, 114, './assets/images/uploads/iphone 11 (9).webp'),
(464, 117, './assets/images/uploads/Tai nghe chụp tai Sony WH-1000XM5.webp'),
(465, 117, './assets/images/uploads/Tai nghe chụp tai Sony WH-1000XM51.webp'),
(466, 117, './assets/images/uploads/Tai nghe chụp tai Sony WH-1000XM52.webp'),
(467, 117, './assets/images/uploads/Tai nghe chụp tai Sony WH-1000XM53.webp'),
(468, 117, './assets/images/uploads/Tai nghe chụp tai Sony WH-1000XM54.webp'),
(469, 117, './assets/images/uploads/Tai nghe chụp tai Sony WH-1000XM55.webp'),
(470, 117, './assets/images/uploads/Tai nghe chụp tai Sony WH-1000XM56.webp'),
(471, 117, './assets/images/uploads/Tai nghe chụp tai Sony WH-1000XM57.webp'),
(472, 117, './assets/images/uploads/Tai nghe chụp tai Sony WH-1000XM58.webp'),
(473, 118, './assets/images/uploads/ai nghe không dây Xiaomi Redmi Buds 4 1.webp'),
(474, 118, './assets/images/uploads/ai nghe không dây Xiaomi Redmi Buds 4.webp'),
(475, 119, './assets/images/uploads/Tai nghe không dây Redmi Buds 4 Lite.webp'),
(476, 119, './assets/images/uploads/Tai nghe không dây Redmi Buds 4 Lite1.webp'),
(477, 119, './assets/images/uploads/Tai nghe không dây Redmi Buds 4 Lite2.webp'),
(478, 119, './assets/images/uploads/Tai nghe không dây Redmi Buds 4 Lite3.webp'),
(479, 119, './assets/images/uploads/Tai nghe không dây Redmi Buds 4 Lite4.webp'),
(480, 119, './assets/images/uploads/Tai nghe không dây Redmi Buds 4 Lite5.webp'),
(481, 120, './assets/images/uploads/Samsung Galaxy Buds 2 Pro 1.webp'),
(482, 120, './assets/images/uploads/Samsung Galaxy Buds 2 Pro.webp'),
(487, 122, './assets/images/uploads/Tai Nghe Không Dây JBL Live Pro 2 TWS.webp'),
(488, 122, './assets/images/uploads/Tai Nghe Không Dây JBL Live Pro 2 TWS2.webp'),
(489, 122, './assets/images/uploads/Tai Nghe Không Dây JBL Live Pro 2 TWS3.webp'),
(490, 122, './assets/images/uploads/Tai Nghe Không Dây JBL Live Pro 2 TWS4.webp'),
(507, 124, './assets/images/uploads/Tai nghe Bluetooth TWS OPPO ENCO Air 2.webp'),
(508, 124, './assets/images/uploads/Tai nghe Bluetooth TWS OPPO ENCO Air 22.webp'),
(509, 124, './assets/images/uploads/Tai nghe Bluetooth TWS OPPO ENCO Air 23.webp'),
(510, 124, './assets/images/uploads/Tai nghe Bluetooth TWS OPPO ENCO Air 24.webp'),
(511, 124, './assets/images/uploads/Tai nghe Bluetooth TWS OPPO ENCO Air 25.webp'),
(512, 124, './assets/images/uploads/Tai nghe Bluetooth TWS OPPO ENCO Air 26.webp'),
(513, 124, './assets/images/uploads/Tai nghe Bluetooth TWS OPPO ENCO Air 27.webp'),
(514, 124, './assets/images/uploads/Tai nghe Bluetooth TWS OPPO ENCO Air 28.webp'),
(515, 125, './assets/images/uploads/i11pro-5960.webp'),
(516, 126, './assets/images/uploads/Thay màn hình Daison (Soft Oled) cho iPhone 11 Pro Max 1.webp'),
(517, 126, './assets/images/uploads/Thay màn hình Daison (Soft Oled) cho iPhone 11 Pro Max 2.webp'),
(518, 126, './assets/images/uploads/Thay màn hình Daison (Soft Oled) cho iPhone 11 Pro Max.webp'),
(522, 128, './assets/images/uploads/Phụ kiện Thay màn hình Daison (Soft Oled) cho iPhone Xs Max.webp'),
(523, 128, './assets/images/uploads/Phụ kiện Thay màn hình Daison (Soft Oled) cho iPhone Xs Max1.webp'),
(524, 128, './assets/images/uploads/Phụ kiện Thay màn hình Daison (Soft Oled) cho iPhone Xs Max2.webp'),
(525, 129, './assets/images/uploads/Pin Daison iPhone 11.webp'),
(529, 131, './assets/images/uploads/ip-5c-2x-100.webp'),
(530, 133, './assets/images/uploads/OPPO Reno8 T 5G.webp'),
(531, 133, './assets/images/uploads/OPPO Reno8 T 5G1.webp'),
(532, 133, './assets/images/uploads/OPPO Reno8 T 5G2.webp'),
(533, 133, './assets/images/uploads/OPPO Reno8 T 5G3.webp'),
(534, 133, './assets/images/uploads/OPPO Reno8 T 5G4.webp'),
(535, 133, './assets/images/uploads/OPPO Reno8 T 5G5.webp'),
(536, 133, './assets/images/uploads/OPPO Reno8 T 5G6.webp'),
(537, 133, './assets/images/uploads/OPPO Reno8 T 5G7.webp'),
(538, 133, './assets/images/uploads/OPPO Reno8 T 5G8.webp'),
(539, 134, './assets/images/uploads/htc-wildfire-e3-lite-blue.webp'),
(540, 134, './assets/images/uploads/htc-wildfire-e3-lite-blue-back.webp'),
(541, 134, './assets/images/uploads/htc-wildfire-e3-lite-blue-back-130ip.webp'),
(542, 134, './assets/images/uploads/htc-wildfire-e3-lite-blue-front.webp'),
(543, 134, './assets/images/uploads/htc-wildfire-e3-lite-blue-front-130ip.webp'),
(544, 134, './assets/images/uploads/htc-wildfire-e3-lite-blue-side.webp'),
(545, 134, './assets/images/uploads/htc-wildfire-e3-lite-grey.webp'),
(546, 134, './assets/images/uploads/htc-wildfire-e3-lite-grey-back.webp'),
(547, 134, './assets/images/uploads/htc-wildfire-e3-lite-grey-back-130ip.webp'),
(548, 134, './assets/images/uploads/htc-wildfire-e3-lite-grey-front.webp'),
(549, 134, './assets/images/uploads/htc-wildfire-e3-lite-grey-front-130ip.webp'),
(550, 134, './assets/images/uploads/htc-wildfire-e3-lite-grey-side.webp'),
(551, 135, './assets/images/uploads/oppo-find-n3.webp'),
(552, 135, './assets/images/uploads/oppo-find-n3-ad.webp'),
(553, 135, './assets/images/uploads/xueying-product-images-45-back45left-black-8-rgb-20230703-removebg-preview.webp'),
(554, 135, './assets/images/uploads/xueying-product-images-45-back45left-gold-12-rgb-20230703-removebg-preview.webp'),
(555, 135, './assets/images/uploads/xueying-product-images-45front-45-left-black-6-rgb-20230810-removebg-preview.webp'),
(556, 135, './assets/images/uploads/xueying-product-images-closedback-black-6-rgb-20230809-removebg-preview.webp'),
(557, 135, './assets/images/uploads/xueying-product-images-closedback-gold-4-rgb-20230809-removebg-preview.webp'),
(558, 135, './assets/images/uploads/xueying-product-images-closedfront-black-5-rgb-20230809-removebg-preview.webp'),
(559, 135, './assets/images/uploads/xueying-product-images-halfopenback-black-5-rgb-20230811-removebg-preview.webp'),
(560, 135, './assets/images/uploads/xueying-product-images-halfopenback-gold-7-rgb-20230810-removebg-preview.webp'),
(561, 135, './assets/images/uploads/xueying-product-images-halfopenfront-blk-6-rgb-20230810-removebg-preview.webp'),
(562, 135, './assets/images/uploads/xueying-product-images-halfopenfront-gold-2-rgb-20230810-removebg-preview.webp'),
(563, 135, './assets/images/uploads/xueying-product-images-open-back-black-9-rgb-20230718-removebg-preview.webp'),
(564, 135, './assets/images/uploads/xueying-product-images-openback-gold-9-rgb-20230725-removebg-preview.webp'),
(565, 135, './assets/images/uploads/xueying-product-images-openfront-blk-8-rgb-20230718-removebg-preview.webp'),
(566, 135, './assets/images/uploads/xueying-product-images-openfront-gold-4-rgb-20230809-removebg-preview.webp'),
(567, 136, './assets/images/uploads/fold-5-chinh-thuc-1.webp'),
(568, 136, './assets/images/uploads/fold-5-chinh-thuc-2.webp'),
(569, 136, './assets/images/uploads/fold-5-chinh-thuc-3.webp'),
(570, 137, './assets/images/uploads/fold-5-chinh-thuc-1.webp'),
(571, 137, './assets/images/uploads/fold-5-chinh-thuc-2.webp'),
(572, 137, './assets/images/uploads/fold-5-chinh-thuc-3.webp'),
(573, 138, './assets/images/uploads/galaxy-z-flip5-1.webp'),
(574, 138, './assets/images/uploads/galaxy-z-flip5-2.webp'),
(575, 138, './assets/images/uploads/galaxy-z-flip5-3.webp'),
(576, 138, './assets/images/uploads/image-removebg-preview.webp'),
(577, 139, './assets/images/uploads/galaxy-z-flip5-1.webp'),
(578, 139, './assets/images/uploads/galaxy-z-flip5-2.webp'),
(579, 139, './assets/images/uploads/galaxy-z-flip5-3.webp'),
(580, 139, './assets/images/uploads/image-removebg-preview.webp'),
(589, 130, './assets/images/uploads/Pin Daison iPhone 11.webp'),
(590, 142, './assets/images/uploads/image-removebg-preview-10.webp'),
(591, 142, './assets/images/uploads/image-removebg-preview-11.webp'),
(592, 142, './assets/images/uploads/image-removebg-preview-12.webp'),
(593, 142, './assets/images/uploads/image-removebg-preview-13.webp'),
(594, 142, './assets/images/uploads/image-removebg-preview-14.webp'),
(595, 142, './assets/images/uploads/ip13.webp'),
(596, 143, './assets/images/uploads/thay-man-hinh-jk-1.webp'),
(597, 143, './assets/images/uploads/thay-man-hinh-jk-2.webp'),
(598, 143, './assets/images/uploads/thay-man-hinh-jk-iphone-xr-1.webp'),
(599, 143, './assets/images/uploads/thay-man-hinh-jk-iphone-xr-2.webp');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `orderCode` int(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `totalMoney` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `orderCode`, `status`, `productId`, `price`, `num`, `totalMoney`) VALUES
(26, 938377, 1, 115, 26190000, 1, 26190000),
(27, 100650, 1, 134, 1674400, 1, 1674400),
(28, 100650, 1, 138, 19492500, 1, 19492500),
(29, 100650, 1, 136, 32792000, 1, 32792000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderCode` int(255) NOT NULL,
  `deliveryMethod` varchar(255) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `fullName` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `addressdetail` varchar(255) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `orderDate` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `totalMoney` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderCode`, `deliveryMethod`, `idUser`, `fullName`, `email`, `phoneNumber`, `city`, `district`, `addressdetail`, `address`, `note`, `orderDate`, `status`, `totalMoney`) VALUES
(28, 938377, '1', 14, 'Thái Ngọc Linh', 'linh@gmail.com', '0974149825', '', '', '', 'Số 89 Đường Tam Trinh, Phường Mai Động, Quận Hoàng Mai, Thành Phố Hà Nội.', '', '2024-01-03 10:42:59', 1, 26190000),
(29, 100650, '1', 0, 'Trần Thái Linh', 'trantl@gmail.com', '0935235345', '', '', '', 'Số 89 Đường Tam Trinh, Phường Mai Động, Quận Hoàng Mai, Thành Phố Hà Nội.', '', '2024-01-03 19:30:35', 1, 53958900);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `categoryId` int(30) DEFAULT NULL,
  `brandId` int(30) NOT NULL,
  `model` varchar(350) DEFAULT NULL,
  `versionId` int(11) NOT NULL,
  `colors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`colors`)),
  `price` int(11) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  `updateAt` datetime DEFAULT NULL,
  `stockQuantity` int(255) NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categoryId`, `brandId`, `model`, `versionId`, `colors`, `price`, `discount`, `thumbnail`, `description`, `createAt`, `updateAt`, `stockQuantity`, `deleted`) VALUES
(97, 1, 1, 'iPhone 15 Pro Max (256GB) - Chính hãng VN/A', 7, '[\"1\",\"2\",\"3\",\"7\"]', 32490000, 0, './assets/images/uploads/iphone-15-pro-max-black-titanium-pure-back-iphone-15-pro-max-black-titanium-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Công nghệ ProMotion với tốc độ làm mới thích ứng lên đến 120Hz, Màn hình Luôn Bật, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình True Tone, Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1290 x 2796, Chính: 48MP, khẩu độ ƒ/1.78, Ultra Wide: 12MP, khẩu độ ƒ/2.2, Telephoto: 12MP, khẩu độ ƒ/2.8, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.7\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A17 Pro\r\nBộ nhớ trong: 256GB\r\nRAM: 8GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 19:25:47', '2023-12-30 19:37:18', 14, 0),
(98, 1, 1, 'iPhone 15 Pro Max (512GB) - Chính hãng VN/A', 8, '[\"1\",\"2\",\"3\",\"7\"]', 38990000, 0, './assets/images/uploads/iphone-15-pro-max-black-titanium-pure-back-iphone-15-pro-max-black-titanium-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Công nghệ ProMotion với tốc độ làm mới thích ứng lên đến 120Hz, Màn hình Luôn Bật, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình True Tone, Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1290 x 2796, Chính: 48MP, khẩu độ ƒ/1.78, Ultra Wide: 12MP, khẩu độ ƒ/2.2, Telephoto: 12MP, khẩu độ ƒ/2.8, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.7\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A17 Pro\r\nBộ nhớ trong: 512GB\r\nRAM: 8GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 19:27:39', '2023-12-30 19:37:06', 12, 0),
(99, 1, 1, 'iPhone 15 Pro Max (1TB) - Chính hãng VN/A', 14, '[\"1\",\"2\",\"3\",\"7\"]', 44490000, 0, './assets/images/uploads/iphone-15-pro-max-blue-titanium-pure-back-iphone-15-pro-max-blue-titanium-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Công nghệ ProMotion với tốc độ làm mới thích ứng lên đến 120Hz, Màn hình Luôn Bật, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình True Tone, Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1290 x 2796, Chính: 48MP, khẩu độ ƒ/1.78, Ultra Wide: 12MP, khẩu độ ƒ/2.2, Telephoto: 12MP, khẩu độ ƒ/2.8, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.7\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A17 Pro\r\nBộ nhớ trong: 1TB\r\nRAM: 8GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 19:29:41', '2023-12-30 19:40:22', 11, 0),
(100, 1, 1, 'iPhone 15 Pro (128GB) - Chính hãng VN/A', 6, '[\"1\",\"2\",\"3\",\"7\"]', 27450000, 0, './assets/images/uploads/iphone-15-pro-black-titanium-pure-back-iphone-15-pro-black-titanium-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Công nghệ ProMotion với tốc độ làm mới thích ứng lên đến 120Hz, Màn hình Luôn Bật, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình True Tone, Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1179 x 2556, Chính: 48MP, khẩu độ ƒ/1.78, Ultra Wide: 12MP, khẩu độ ƒ/2.2, Telephoto: 12MP, khẩu độ ƒ/2.8, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.1\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A17 Pro\r\nBộ nhớ trong: 128GB\r\nRAM: 8GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 19:33:42', NULL, 18, 0),
(101, 1, 1, 'iPhone 15 Pro (256GB) - Chính hãng VN/A', 7, '[\"1\",\"2\",\"3\",\"7\"]', 29990000, 0, './assets/images/uploads/iphone-15-pro-black-titanium-pure-back-iphone-15-pro-black-titanium-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Công nghệ ProMotion với tốc độ làm mới thích ứng lên đến 120Hz, Màn hình Luôn Bật, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình True Tone, Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1179 x 2556, Chính: 48MP, khẩu độ ƒ/1.78, Ultra Wide: 12MP, khẩu độ ƒ/2.2, Telephoto: 12MP, khẩu độ ƒ/2.8, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.1\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A17 Pro\r\nBộ nhớ trong: 256GB\r\nRAM: 8GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 19:35:07', NULL, 18, 0),
(102, 1, 1, 'iPhone 15 Pro (512GB) - Chính hãng VN/A', 1, '[\"1\",\"2\",\"3\",\"7\"]', 36490000, 0, './assets/images/uploads/iphone-15-pro-black-titanium-pure-back-iphone-15-pro-black-titanium-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Công nghệ ProMotion với tốc độ làm mới thích ứng lên đến 120Hz, Màn hình Luôn Bật, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình True Tone, Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1179 x 2556, Chính: 48MP, khẩu độ ƒ/1.78, Ultra Wide: 12MP, khẩu độ ƒ/2.2, Telephoto: 12MP, khẩu độ ƒ/2.8, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.1\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A17 Pro\r\nBộ nhớ trong: 512GB\r\nRAM: 8GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 19:36:40', NULL, 17, 0),
(103, 1, 1, 'iPhone 15 Pro (1TB) - Chính hãng VN/A', 14, '[\"1\",\"2\",\"3\",\"7\"]', 41500000, 0, './assets/images/uploads/iphone-15-pro-black-titanium-pure-back-iphone-15-pro-black-titanium-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Công nghệ ProMotion với tốc độ làm mới thích ứng lên đến 120Hz, Màn hình Luôn Bật, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình True Tone, Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1179 x 2556, Chính: 48MP, khẩu độ ƒ/1.78, Ultra Wide: 12MP, khẩu độ ƒ/2.2, Telephoto: 12MP, khẩu độ ƒ/2.8, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.1\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A17 Pro\r\nBộ nhớ trong: 1TB\r\nRAM: 8GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 19:38:37', '2023-12-30 20:00:35', 13, 0),
(104, 1, 1, 'iPhone 15 (128GB) - Chính hãng VN/A', 5, '[\"1\",\"3\",\"4\",\"5\",\"6\",\"9\"]', 21590000, 0, './assets/images/uploads/iphone-15-black-pure-back-iphone-15-black-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1179 x 2556, Chính: 48MP, khẩu độ ƒ/1.6, Ultra Wide: 12MP, khẩu độ ƒ/2.4, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.1\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A16 Bionic\r\nBộ nhớ trong: 128GB\r\nRAM: 6GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano-SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 20:11:14', '2023-12-30 21:05:23', 11, 0),
(105, 1, 1, 'iPhone 15 (256GB) - Chính hãng VN/A', 15, '[\"1\",\"3\",\"4\",\"5\",\"6\",\"9\"]', 24390000, 0, './assets/images/uploads/iphone-15-black-pure-back-iphone-15-black-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1179 x 2556, Chính: 48MP, khẩu độ ƒ/1.6, Ultra Wide: 12MP, khẩu độ ƒ/2.4, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.1\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A16 Bionic\r\nBộ nhớ trong: 256GB\r\nRAM: 6GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano-SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 20:14:11', '2023-12-30 21:04:58', 12, 0),
(106, 1, 1, 'iPhone 15 (512GB) - Chính hãng VN/A', 16, '[\"1\",\"3\",\"4\",\"5\",\"6\",\"9\"]', 30490000, 0, './assets/images/uploads/iphone-15-black-pure-back-iphone-15-black-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1179 x 2556, Chính: 48MP, khẩu độ ƒ/1.6, Ultra Wide: 12MP, khẩu độ ƒ/2.4, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.1\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A16 Bionic\r\nBộ nhớ trong: 512GB\r\nRAM: 6GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano-SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 20:16:13', '2023-12-30 21:04:40', 16, 0),
(107, 1, 1, 'iPhone 15 Plus (128GB) - Chính hãng VN/A', 5, '[\"1\",\"5\",\"6\",\"7\",\"8\"]', 24990000, 0, './assets/images/uploads/iphone-15-plus-green-pure-back-iphone-15-plus-green-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1290 x 2796, Chính: 48MP, khẩu độ ƒ/1.6, Ultra Wide: 12MP, khẩu độ ƒ/2.4, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.7\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A16 Bionic\r\nBộ nhớ trong: 128GB\r\nRAM: 6GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano-SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 20:19:34', '2023-12-30 21:11:07', 18, 0),
(108, 1, 1, 'iPhone 15 Plus (256GB) - Chính hãng VN/A', 15, '[\"1\",\"5\",\"6\",\"7\",\"8\"]', 27690000, 0, './assets/images/uploads/iphone-15-plus-blue-pure-back-iphone-15-plus-blue-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1290 x 2796, Chính: 48MP, khẩu độ ƒ/1.6, Ultra Wide: 12MP, khẩu độ ƒ/2.4, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.7\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A16 Bionic\r\nBộ nhớ trong: 256GB\r\nRAM: 6GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano-SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 20:22:16', '2023-12-30 21:10:35', 13, 0),
(109, 1, 1, 'iPhone 15 Plus (512GB) - Chính hãng VN/A', 16, '[\"1\",\"5\",\"6\",\"7\",\"8\"]', 33490000, 0, './assets/images/uploads/iphone-15-plus-green-pure-back-iphone-15-plus-green-pure-front-2up-screen-usen.webp', 'Công nghệ màn hình: Màn hình Super Retina XDR, Tấm nền OLED, Dynamic Island, Màn hình HDR, Tỷ lệ tương phản 2.000.000:1 (tiêu chuẩn), Màn hình có dải màu rộng (P3), Haptic Touch\r\nĐộ phân giải: 1290 x 2796, Chính: 48MP, khẩu độ ƒ/1.6, Ultra Wide: 12MP, khẩu độ ƒ/2.4, Camera trước TrueDepth 12MP, khẩu độ ƒ/1.9\r\nKích thước màn hình: 6.7\"\r\nHệ điều hành: iOS 17\r\nVi xử lý: A16 Bionic\r\nBộ nhớ trong: 512GB\r\nRAM: 6GB\r\nMạng di động: 2G, 3G, 4G, 5G\r\nSố khe SIM: SIM kép (nano-SIM và eSIM), Hỗ trợ hai eSIM', '2023-12-30 20:23:40', '2023-12-30 21:10:06', 19, 0),
(110, 2, 1, 'Tai nghe AirPods Pro 2 với Hộp Sạc MagSafe (Lightning) - Chính hãng Apple Việt Nam', 1, '[\"2\"]', 7990000, 0.38, './assets/images/uploads/AirPods Pro 2 với Hộp Sạc MagSafe (Lightning).webp', '', '2023-12-30 20:30:37', '2023-12-30 21:46:40', 13, 0),
(111, 2, 1, 'Tai nghe AirPods Pro 2 với Hộp Sạc MagSafe (USB-C) - Chính hãng Apple Việt Nam', 1, '[\"2\"]', 5990000, 0, './assets/images/uploads/airpods-pro-2nd-gen-usb-c-3.webp', '', '2023-12-30 20:36:46', '2023-12-30 21:45:50', 20, 0),
(113, 1, 1, 'iPhone 11 (128GB) - Chính hãng VN/A', 4, '[\"1\",\"2\",\"4\",\"9\",\"10\"]', 21990000, 0.46, './assets/images/uploads/iphone 11 (11).webp', 'Công nghệ màn hình: IPS LCD\r\nĐộ phân giải: 828 x 1792 Pixels, 2 camera 12 MP, 12 MP\r\nKích thước màn hình: 6.1\"\r\nHệ điều hành: iOS 15\r\nVi xử lý: Apple A13 Bionic 6 nhân\r\nBộ nhớ trong: 128 GB\r\nRAM: 4 GB\r\nMạng di động: Hỗ trợ 4G\r\nSố khe SIM: 1 Nano SIM & 1 eSIM\r\nDung lượng pin: 3110 mAh', '2023-12-30 20:45:09', '2023-12-30 21:47:27', 4, 0),
(114, 1, 1, 'iPhone 11 (64GB) - Chính hãng VN/A', 2, '[\"1\",\"2\"]', 19990000, 0.48, './assets/images/uploads/iphone 11 (9).webp', 'Công nghệ màn hình: IPS LCD\r\nĐộ phân giải: 828 x 1792 Pixels, 2 camera 12 MP, 12 MP\r\nKích thước màn hình: 6.1\"\r\nHệ điều hành: iOS 15\r\nVi xử lý: Apple A13 Bionic 6 nhân\r\nBộ nhớ trong: 64 GB\r\nRAM: 4 GB\r\nMạng di động: Hỗ trợ 4G\r\nSố khe SIM: 1 Nano SIM & 1 eSIM\r\nDung lượng pin: 3110 mAh', '2023-12-30 20:50:40', '2023-12-30 21:47:51', 2, 0),
(115, 1, 1, 'iPhone 14 Pro Max (128GB) - Chính hãng VN/A', 5, '[\"1\",\"2\",\"6\",\"10\"]', 26190000, 0, './assets/images/uploads/iphone14promax.webp', 'Công nghệ màn hình: OLED\r\nĐộ phân giải: 2796 x 1290 Pixels, Chính 48 MP & Phụ 12 MP, 12 MP, 12 MP\r\nKích thước màn hình: 6.7\"\r\nHệ điều hành: iOS 16\r\nVi xử lý: Apple A16 Bionic 6 nhân\r\nBộ nhớ trong: 128 GB\r\nRAM: 6 GB\r\nMạng di động: Hỗ trợ 5G\r\nSố khe SIM: 1 Nano SIM & 1 eSIM\r\nDung lượng pin: 4323 mAh', '2023-12-30 21:19:01', NULL, 14, 0),
(116, 1, 1, 'iPhone 14 Pro Max (256GB) - Chính hãng VN/A', 15, '[\"1\",\"2\",\"6\",\"10\"]', 28990000, 0, './assets/images/uploads/iphone14promax.webp', 'Công nghệ màn hình: OLED\r\nĐộ phân giải: 2796 x 1290 Pixels, Chính 48 MP & Phụ 12 MP, 12 MP, 12 MP\r\nKích thước màn hình: 6.7\"\r\nHệ điều hành: iOS 16\r\nVi xử lý: Apple A16 Bionic 6 nhân\r\nBộ nhớ trong: 256GB\r\nRAM: 6 GB\r\nMạng di động: Hỗ trợ 5G\r\nSố khe SIM: 1 Nano SIM & 1 eSIM\r\nDung lượng pin: 4323 mAh', '2023-12-30 21:20:29', NULL, 12, 0),
(117, 2, 18, 'Tai nghe chụp tai Sony WH-1000XM5 - Chính Hãng', 1, '[\"1\",\"2\",\"7\"]', 9490000, 0.3, './assets/images/uploads/Tai nghe chụp tai Sony WH-1000XM5.webp', 'Tính năng khác: - Bộ xử lý chống ồn HD QN1, Bộ xử lý tích hợp V1 và nhiều micrô để không bị gián đoạn khi nghe, - Bộ Tối ưu hóa chống ồn cá nhân và Tối ưu hóa áp suất khí quyển, - Bộ trình điều khiển được thiết kế đặc biệt 30mm cho âm thanh đặc biệt, - Cuộc gọi khử tiếng ồn vượt trội với micrô lọc không gian 2x2 và hệ thống giảm tiếng ồn (sử dụng AI), - Thiết kế siêu nhẹ siêu thoải mái trong “Da mềm vừa vặn”', '2023-12-30 21:25:27', '2023-12-30 21:48:27', 13, 0),
(118, 2, 3, 'Tai nghe không dây Xiaomi Redmi Buds 4 - Chính hãng', 1, '[\"2\",\"7\"]', 1590000, 0.6, './assets/images/uploads/ai nghe không dây Xiaomi Redmi Buds 4.webp', '', '2023-12-30 21:28:20', '2023-12-30 21:48:55', 14, 0),
(119, 2, 3, 'Tai nghe không dây Redmi Buds 4 Lite - Chính hãng', 1, '[\"3\",\"11\"]', 790000, 0.32, './assets/images/uploads/Tai nghe không dây Redmi Buds 4 Lite.webp', 'Cổng sạc:: Type-C\r\nTính năng khác: Chống nước IP54, mic: Có, Khử tiếng ồn đàm thoại AI, Hỗ trợ Google Fast Pair', '2023-12-30 21:36:38', '2023-12-30 21:49:14', 4, 0),
(120, 2, 2, 'Tai nghe Samsung Galaxy Buds 2 Pro - Chính hãng', 1, '[\"1\",\"10\"]', 4990000, 0.33, './assets/images/uploads/Samsung Galaxy Buds 2 Pro.webp', '', '2023-12-30 21:39:34', '2023-12-30 21:49:40', 12, 0),
(122, 2, 19, 'Tai Nghe Không Dây JBL Live Pro 2 TWS- Chính Hãng', 1, '[]', 3990000, 0.33, './assets/images/uploads/Tai Nghe Không Dây JBL Live Pro 2 TWS4.webp', '', '2023-12-30 21:43:59', '2023-12-30 21:52:44', 23, 0),
(124, 2, 4, 'Tai nghe Bluetooth TWS OPPO ENCO Air 2- chính hãng', 1, '[\"2\"]', 1590000, 0.51, './assets/images/uploads/Tai nghe Bluetooth TWS OPPO ENCO Air 2.webp', 'Cổng sạc:: Type-C\r\nTính năng khác: Kết nối khoảng cách 10 m, IPX4, Bluetooth version 5.2, Tần số 20 Hz - 20 kHz, Độ nhảy micro -38 dBV / Pa', '2023-12-30 21:58:07', '2023-12-30 21:59:19', 12, 0),
(125, 4, 1, 'Pin iPhone 11 Pro Max Chính Hãng PISEN (Dung lượng chuẩn 3969mAh)', 1, '[\"1\"]', 1590000, 0.19, './assets/images/uploads/i11pro-5960.webp', '', '2023-12-30 22:07:10', NULL, 13, 0),
(126, 5, 1, 'Thay màn hình Daison (Soft Oled) cho iPhone 11 Pro Max - Chính hãng', 1, '[\"1\"]', 4315000, 0.15, './assets/images/uploads/Thay màn hình Daison (Soft Oled) cho iPhone 11 Pro Max.webp', '', '2023-12-30 22:09:48', NULL, 14, 0),
(128, 5, 1, 'Thay màn hình Daison (Soft Oled) cho iPhone Xs Max - Chính hãng', 1, '[\"1\"]', 3150000, 0.12, './assets/images/uploads/Phụ kiện Thay màn hình Daison (Soft Oled) cho iPhone Xs Max.webp', '', '2023-12-30 22:12:46', NULL, 11, 0),
(129, 4, 1, 'Pin Daison iPhone 11 Dung lượng chuẩn 3110mAh', 1, '[\"1\"]', 1160000, 0.32, './assets/images/uploads/Pin Daison iPhone 11.webp', '', '2023-12-30 22:15:05', NULL, 14, 0),
(130, 4, 1, 'Pin Daison iPhone Xs max Dung lượng chuẩn 3174mAh', 1, '[\"1\"]', 890000, 0.23, './assets/images/uploads/Pin Daison iPhone 11.webp', '', '2023-12-30 22:16:48', '2024-01-03 19:21:56', 4, 0),
(131, 4, 1, 'Pin iPhone 5 Chính Hãng PISEN (Dung lượng chuẩn IP5:1440mAh', 1, '[\"1\"]', 262000, 0.54, './assets/images/uploads/ip-5c-2x-100.webp', '', '2023-12-30 22:19:09', '2024-01-03 01:01:25', 12, 0),
(133, 1, 4, 'OPPO Reno8 T 5G (8GB/256GB) - Chính hãng', 7, '[\"1\",\"6\"]', 9990000, 0.17, './assets/images/uploads/OPPO Reno8 T 5G.webp', 'Công nghệ màn hình: AMOLED\r\nĐộ phân giải: 1080 x 2412 pixels, 108 MP x 2 MP x 2 MP, 32 MP\r\nKích thước màn hình: 6.7 inches\r\nHệ điều hành: Coloros 13\r\nVi xử lý: Snapdragon 695 5G 8 nhân\r\nBộ nhớ trong: 128 GB\r\nRAM: 8GB + Mở rộng 8GB\r\nMạng di động: Hỗ trợ 5G\r\nSố khe SIM: 2 SIM (Nano-SIM)\r\nDung lượng pin: 4800 mAh', '2024-01-03 14:25:36', NULL, 6, 0),
(134, 1, 9, 'HTC Wildfire E3 lite (4GB/64GB) - Chính hãng', 2, '[\"3\",\"7\"]', 2990000, 0.44, './assets/images/uploads/htc-wildfire-e3-lite-grey.webp', 'Công nghệ màn hình: IPS LCD\r\nĐộ phân giải: HD+ (720 x 1600), Camera chính 13MP f/2.2, Camera phụ 2MP, 5MP f/2.0\r\nKích thước màn hình: 6.517\"\r\nHệ điều hành: Android 12\r\nVi xử lý: Spreadtrum SC9863\r\nBộ nhớ trong: 64GB\r\nRAM: 4GB\r\nMạng di động: 2G, 3G, 4G\r\nSố khe SIM: 2 nano SIM\r\nDung lượng pin: 5000mAh', '2024-01-03 14:29:24', NULL, 6, 0),
(135, 1, 4, 'OPPO Find N3 (16GB/512GB) - Chính hãng', 10, '[\"1\",\"6\"]', 44990000, 0, './assets/images/uploads/xueying-product-images-halfopenback-gold-7-rgb-20230810-removebg-preview.webp', 'Kích thước màn hình: 6.3″ & 7.8″\r\nĐộ phân giải: 48MP Wide (1/1.4’’ Sensor size OIS, F1.6), 64MP Tele (1/2’’ Sensor size 3x optical zoom OIS, F2.2), 48MP Ultra Wide (1/2’’ Sensor size F1.6)\r\nBộ nhớ trong: 512GB\r\nRAM: 16GB\r\nDung lượng pin: 4805 mAh', '2024-01-03 14:33:15', NULL, 6, 0),
(136, 1, 2, 'Samsung Galaxy Z Fold5 12GB/256GB - Chính hãng', 17, '[\"1\",\"6\",\"7\"]', 40990000, 0.2, './assets/images/uploads/fold-5-chinh-thuc-2.webp', 'Công nghệ màn hình: Dynamic AMOLED 2X, Tần số quét 120 Hz, Màn hình chính: Infinity Flex, Màn hình phụ: Infinity-O\r\nĐộ phân giải: Màn hình chính: 2176 x 1812 (QXGA+), Màn hình phụ: 2316 x 904 (HD+), 50 MP + 12 MP + 10 MP, Camera trước ở màn hình phụ: 10 MP, Camera ẩn dưới màn hình: 4 MP\r\nKích thước màn hình: Màn hình chính: 7.6\", Màn hình phụ: 6.2\"\r\nHệ điều hành: OneUI 5.1.1 / Android 13\r\nVi xử lý: Snapdragon® 8 Gen 2 dành cho Galaxy\r\nBộ nhớ trong: 256GB\r\nRAM: 12GB\r\nMạng di động: Hỗ trợ 5G\r\nSố khe SIM: Nano-sim & E-sim\r\nDung lượng pin: 4400 mAh', '2024-01-03 14:39:09', NULL, 3, 0),
(137, 1, 2, 'Samsung Galaxy Z Fold5 12GB/512GB - Chính hãng', 18, '[\"1\",\"6\",\"7\"]', 44990000, 0.18, './assets/images/uploads/fold-5-chinh-thuc-2.webp', 'Công nghệ màn hình: Dynamic AMOLED 2X, Tần số quét 120 Hz, Màn hình chính: Infinity Flex, Màn hình phụ: Infinity-O\r\nĐộ phân giải: Màn hình chính: 2176 x 1812 (QXGA+), Màn hình phụ: 2316 x 904 (HD+), 50 MP + 12 MP + 10 MP, Camera trước ở màn hình phụ: 10 MP, Camera ẩn dưới màn hình: 4 MP\r\nKích thước màn hình: Màn hình chính: 7.6\", Màn hình phụ: 6.2\"\r\nHệ điều hành: OneUI 5.1.1 / Android 13\r\nVi xử lý: Snapdragon® 8 Gen 2 dành cho Galaxy\r\nBộ nhớ trong: 512GB\r\nRAM: 12GB\r\nMạng di động: Hỗ trợ 5G\r\nSố khe SIM: Nano-sim & E-sim\r\nDung lượng pin: 4400 mAh', '2024-01-03 14:40:51', NULL, 6, 0),
(138, 1, 2, 'Samsung Galaxy Z Flip5 8GB/256GB - Chính hãng', 7, '[\"3\",\"6\",\"7\",\"10\"]', 25990000, 0.25, './assets/images/uploads/image-removebg-preview.webp', 'Công nghệ màn hình: Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED, Tần số quét Chính: 120 Hz & Phụ: 60 Hz\r\nĐộ phân giải: MH Chính: FHD+ (2640 x 1080 Pixels), MH Phụ: HD+ (720 x 748 Pixels), 12 MP (2Camera), 10 MP\r\nKích thước màn hình: Chính 6.7\", Phụ 3.4\"\r\nHệ điều hành: Android 13\r\nVi xử lý: Snapdragon 8 Gen 2\r\nBộ nhớ trong: 256GB\r\nRAM: 8GB\r\nMạng di động: Hỗ trợ 5G\r\nSố khe SIM: 1 Nano SIM & 1 eSIM\r\nDung lượng pin: 3700 mAh', '2024-01-03 14:43:12', NULL, 6, 0),
(139, 1, 2, 'Samsung Galaxy Z Flip5 8GB/512GB - Chính hãng', 8, '[\"3\",\"6\",\"7\",\"10\"]', 29990000, 0.24, './assets/images/uploads/image-removebg-preview.webp', 'Công nghệ màn hình: Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED, Tần số quét Chính: 120 Hz & Phụ: 60 Hz\r\nĐộ phân giải: MH Chính: FHD+ (2640 x 1080 Pixels), MH Phụ: HD+ (720 x 748 Pixels), 12 MP (2Camera), 10 MP\r\nKích thước màn hình: Chính 6.7\", Phụ 3.4\"\r\nHệ điều hành: Android 13\r\nVi xử lý: Snapdragon 8 Gen 2\r\nBộ nhớ trong: 512GB\r\nRAM: 8GB\r\nMạng di động: Hỗ trợ 5G\r\nSố khe SIM: 1 Nano SIM & 1 eSIM\r\nDung lượng pin: 3700 mAh', '2024-01-03 14:46:10', NULL, 6, 0),
(142, 1, 1, 'iPhone 13 (256GB) - Chính hãng VN/A', 4, '[\"3\",\"4\",\"5\",\"6\",\"7\",\"8\"]', 15490000, 0, './assets/images/uploads/image-removebg-preview-10.webp', 'Công nghệ màn hình: OLED\r\nĐộ phân giải: 1170 x 2532 Pixels, 2 camera 12 MP, 12 MP\r\nHệ điều hành: iOS 15\r\nVi xử lý: Apple A15 Bionic 6 nhân\r\nBộ nhớ trong: 128 GB\r\nRAM: 4 GB\r\nMạng di động: Hỗ trợ 5G\r\nSố khe SIM: 1 Nano SIM & 1 eSIM', '2024-01-04 04:35:07', NULL, 6, 0),
(143, 5, 1, 'Thay màn hình JK iPhone XR - Chính hãng', 1, '[\"1\"]', 990000, 0, './assets/images/uploads/thay-man-hinh-jk-iphone-xr-1.webp', '', '2024-01-04 04:38:31', NULL, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Đang chờ duyệt đơn hàng!'),
(2, 'Đang đóng gói!'),
(3, 'Đang vận chuyển!'),
(4, 'Đang ở bưu điện!'),
(5, 'Đang giao hàng!'),
(6, 'Giao thành công!'),
(7, 'Huỷ đơn hàng!'),
(8, 'Trả hàng/Hoàn tiền!');

-- --------------------------------------------------------

--
-- Table structure for table `statususer`
--

CREATE TABLE `statususer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statususer`
--

INSERT INTO `statususer` (`id`, `name`) VALUES
(1, 'Online'),
(2, 'Offline'),
(3, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `fullName` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(500) NOT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `address` varchar(32) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `sex` int(11) NOT NULL,
  `roleId` int(11) DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  `updateAt` datetime DEFAULT NULL,
  `logOutAt` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `avatar`, `fullName`, `username`, `email`, `password`, `phoneNumber`, `address`, `age`, `sex`, `roleId`, `createAt`, `updateAt`, `logOutAt`, `status`, `active`) VALUES
(1, '../assets/images/users/z2453759481118_9b6acde7ef6a3f6fcc879ec3da5450e0.jpg', '', 'admin', 'admin@gmail.com', '$2y$10$Q3yx81lMwG6H.BveUzQfWeGM0BKA2MgA906Bo7Wj4aJl/ONS6dWTW', '', NULL, 0, 1, 1, '2023-12-20 11:21:32', '2023-12-30 00:23:18', '2023-12-30 18:39:17', 1, 1),
(13, './assets/images/users/z2453759481118_9b6acde7ef6a3f6fcc879ec3da5450e0.jpg', 'Thái Linh', 'thailinh66', 'ngoclinhthai8@gmail.com', '$2y$10$n.fV5CgZ4qBe9T7aRCEYH.XTzt0YrddoUWhtFqdDCZVnKOKPXKTY.', '0362253173', NULL, 0, 1, 2, '2023-12-20 11:22:41', '2023-12-27 01:14:49', '2024-01-04 02:48:36', 2, 1),
(14, './assets/images/users/z2377456715834_c873f15e711807308fadab36662f9d65.jpg', 'Thái Ngọc Linh', 'linh62', 'linh@gmail.com', '$2y$10$x.BMmYYYIJ2uRVkpRfUli.L3gUF4IOV3pFhcIwUq9k9DidjhfgFC6', '0974149825', NULL, 0, 0, 2, '2023-12-20 11:45:56', '2023-12-27 01:40:08', '2024-01-04 02:48:22', 2, 1),
(15, './assets/images/users/185316288_326363458837524_2348832825016561942_n.jpg', '', 'linh64', 'aremama227@gmail.com', '$2y$10$arlNQpwKC1dxk58VWrUWg.JGDO2wUzgvXYm6vc2q8k0RFTv9MYz7O', '', NULL, 0, 1, 2, '2023-12-21 22:55:13', '2023-12-28 11:46:08', '2023-12-31 00:14:54', 2, 1),
(16, './assets/images/users/1 - Copy - Copy - Copy - Copy.jpg', NULL, 'linhAdmin', 'linhAdmin@gmail.com', '$2y$10$0KH9Se0O23BLTzGtwLWHD.OFbe/JBf3N.lTGezLRFQnJNYZ5Z1to2', NULL, NULL, 0, 0, 1, '2024-01-03 11:24:12', NULL, NULL, NULL, 1),
(17, './assets/images/users/1 - Copy - Copy - Copy - Copy.jpg', NULL, 'linh66', 'linh61@gmail.com', '$2y$10$2NOJRqCu3T.BvC29JoKwwuZdAnrVApIrUfeKw2NUK6fJl0UiMUNCK', NULL, NULL, 0, 0, 2, '2024-01-03 11:35:44', NULL, NULL, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `versions`
--

CREATE TABLE `versions` (
  `id` int(11) NOT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `rom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `versions`
--

INSERT INTO `versions` (`id`, `ram`, `rom`) VALUES
(1, '3GB', '64GB'),
(2, '4GB', '64GB'),
(3, '2GB', '32GB'),
(4, '4GB', '128GB'),
(5, '6GB', '128GB'),
(6, '8GB', '128GB'),
(7, '8GB', '256GB'),
(8, '8GB', '512GB'),
(9, '16GB', '256GB'),
(10, '16GB', '512GB'),
(11, '16GB', '1T'),
(12, '32GB', '512GB'),
(13, '32GB', '1T'),
(14, '8GB', '1T'),
(15, '6GB', '256GB'),
(16, '6GB', '512GB'),
(17, '12GB', '256GGB'),
(18, '12GB', '512GB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverymethod`
--
ALTER TABLE `deliverymethod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `orderId` (`orderCode`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `products_ibfk_2` (`brandId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statususer`
--
ALTER TABLE `statususer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleId` (`roleId`);

--
-- Indexes for table `versions`
--
ALTER TABLE `versions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `deliverymethod`
--
ALTER TABLE `deliverymethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=600;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `statususer`
--
ALTER TABLE `statususer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `versions`
--
ALTER TABLE `versions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
