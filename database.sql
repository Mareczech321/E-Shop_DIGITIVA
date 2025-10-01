-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2025 at 04:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marekmulacwz6820`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(9, 'Accessories'),
(3, 'Monitors'),
(7, 'Networking'),
(1, 'PC Components'),
(2, 'Peripherals'),
(6, 'Smart Home Devices'),
(4, 'Smartwatches'),
(8, 'Storage Devices'),
(5, 'Tablets');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','shipped','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `quantity`, `price`, `category_id`, `subcategory_id`, `img_url`) VALUES
(257, 'Apple iPad Pro 12.9 (2022)', '<b>Apple iPad Pro 12.9 (2022)</b><br>Powerful tablet with Liquid Retina XDR display and M2 chip.', 0, 1130.43, 5, NULL, NULL),
(258, 'Apple Watch Series 9', '<b>Apple Watch Series 9</b><br>Latest smartwatch with advanced fitness features.', 0, 500.00, 4, NULL, NULL),
(259, 'ASUS TUF Gaming VG27AQ1A', '<b>ASUS TUF Gaming VG27AQ1A</b><br>27\" QHD gaming monitor, 170Hz, IPS panel.', 0, 369.57, 3, NULL, NULL),
(260, 'be quiet! Dark Rock Pro 4', '<b>be quiet! Dark Rock Pro 4</b><br>Silent high-performance air CPU cooler.', 0, 100.00, 1, 6, NULL),
(261, 'be quiet! Silent Wings 3 140mm', '<b>be quiet! Silent Wings 3 140mm</b><br>Quiet, high-performance 140mm case fan.', 0, 34.78, 1, 7, NULL),
(262, 'Cooler Master Hyper 212 Black', '<b>Cooler Master Hyper 212 Black</b><br>Affordable air CPU cooler with good performance.', 0, 39.13, 1, 6, NULL),
(263, 'Corsair 4000D Airflow', '<b>Corsair 4000D Airflow</b><br>Mid-tower case optimized for airflow and easy building.', 0, 139.13, 1, 9, NULL),
(264, 'Corsair Dark Core RGB Pro', '<b>Corsair Dark Core RGB Pro</b><br>Wireless gaming mouse with RGB and Qi charging.', 0, 108.70, 2, 11, NULL),
(265, 'Corsair K95 RGB Platinum', '<b>Corsair K95 RGB Platinum</b><br>High-end mechanical keyboard with RGB lighting.', 0, 273.91, 2, 10, NULL),
(266, 'Corsair MWE Gold 750W', '<b>Corsair MWE Gold 750W</b><br>Affordable modular power supply with good efficiency.', 0, 121.74, 1, 8, NULL),
(267, 'Corsair iCUE H150i Elite', '<b>Corsair iCUE H150i Elite</b><br>360mm all-in-one liquid CPU cooler with RGB.', 0, 226.09, 1, 6, NULL),
(268, 'Dell UltraSharp U2723QE', '<b>Dell UltraSharp U2723QE</b><br>27\" 4K IPS monitor with excellent color accuracy.', 0, 478.26, 3, NULL, NULL),
(269, 'EVGA SuperNOVA 850 G5', '<b>EVGA SuperNOVA 850 G5</b><br>High-performance 850W 7 with modular cables.', 0, 147.83, 1, 8, NULL),
(270, 'Fitbit Versa 4', '<b>Fitbit Versa 4</b><br>Lightweight smartwatch focusing on health and sleep.', 0, 239.13, 4, NULL, NULL),
(271, 'Fractal Design Meshify C', '<b>Fractal Design Meshify C</b><br>Mid-tower case with mesh front panel for airflow.', 0, 126.09, 1, 9, NULL),
(272, 'Garmin Fenix 7', '<b>Garmin Fenix 7</b><br>Robust smartwatch for sports and outdoor activities.', 0, 804.35, 4, NULL, NULL),
(273, 'Google Nest Wifi', '<b>Google Nest Wifi</b><br>Mesh WiFi system for whole-home coverage.', 0, 256.52, 7, NULL, NULL),
(274, 'Keychron K8 Wireless', '<b>Keychron K8 Wireless</b><br>Compact wireless mechanical keyboard with hot-swappable keys.', 0, 152.17, 2, 10, NULL),
(275, 'Lenovo Tab P12 Pro', '<b>Lenovo Tab P12 Pro</b><br>Powerful Android tablet with OLED display and stylus.', 0, 695.65, 5, NULL, NULL),
(276, 'Lian Li PC-O11 Dynamic', '<b>Lian Li PC-O11 Dynamic</b><br>High-end mid-tower case with tempered glass and modular design.', 0, 169.57, 1, 9, NULL),
(277, 'Logitech G502 HERO', '<b>Logitech G502 HERO</b><br>Wired gaming mouse with high-precision sensor.', 0, 73.91, 2, 11, NULL),
(278, 'Logitech G Pro X', '<b>Logitech G Pro X</b><br>Mechanical gaming keyboard with swappable switches.', 0, 182.61, 2, 10, NULL),
(279, 'Logitech MX Master 3', '<b>Logitech MX Master 3</b><br>Wireless mouse optimized for productivity.', 0, 121.74, 2, 11, NULL),
(280, 'Microsoft Surface Pro 9', '<b>Microsoft Surface Pro 9</b><br>Versatile tablet with Windows 11 and touch pen.', 0, 1000.00, 5, NULL, NULL),
(281, 'Netgear Nighthawk RAX50', '<b>Netgear Nighthawk RAX50</b><br>WiFi 6 router for home and small office.', 0, 204.35, 7, NULL, NULL),
(282, 'NZXT AER RGB 2 120mm', '<b>NZXT AER RGB 2 120mm</b><br>RGB case fan with good airflow and quiet operation.', 0, 28.26, 1, 7, NULL),
(283, 'NZXT H510', '<b>NZXT H510</b><br>Compact mid-tower case with modern design and good airflow.', 0, 117.39, 1, 9, NULL),
(284, 'NZXT Kraken Z73', '<b>NZXT Kraken Z73</b><br>360mm AIO liquid cooler with customizable LCD display.', 0, 295.65, 1, 6, NULL),
(285, 'Phanteks Eclipse P400A', '<b>Phanteks Eclipse P400A</b><br>Mid-tower case with excellent airflow and RGB lighting.', 0, 121.74, 1, 9, NULL),
(286, 'Razer BlackWidow V4', '<b>Razer BlackWidow V4</b><br>Mechanical gaming keyboard with RGB and prog3mable keys.', 0, 213.04, 2, 10, NULL),
(287, 'Razer DeathAdder V2', '<b>Razer DeathAdder V2</b><br>Wired ergonomic gaming mouse.', 0, 69.57, 2, 11, NULL),
(288, 'Samsung Galaxy Tab S8 Ultra', '<b>Samsung Galaxy Tab S8 Ultra</b><br>Large 14.6\" AMOLED tablet with high performance.', 0, 1043.48, 5, NULL, NULL),
(289, 'Samsung Galaxy Watch 6', '<b>Samsung Galaxy Watch 6</b><br>Powerful smartwatch with AMOLED display and long battery life.', 0, 391.30, 4, NULL, NULL),
(290, 'Seagate BarraCuda 2TB', '<b>Seagate BarraCuda 2TB</b><br>Reliable 7200 RPM internal hard drive.', 0, 82.61, 1, 14, NULL),
(291, 'Seagate IronWolf 4TB', '<b>Seagate IronWolf 4TB</b><br>NAS-optimized hard drive with high durability.', 0, 147.83, 1, 14, NULL),
(292, 'Seagate Barracuda Pro 4TB', '<b>Seagate Barracuda Pro 4TB</b><br>High-speed desktop HDD with 7200 RPM.', 0, 182.61, 1, 14, NULL),
(293, 'Seagate Exos X16 16TB', '<b>Seagate Exos X16 16TB</b><br>Enterprise-grade 7200 RPM hard drive with high capacity.', 0, 508.70, 1, 14, NULL),
(294, 'SteelSeries Apex Pro', '<b>SteelSeries Apex Pro</b><br>Mechanical keyboard with adjustable actuation switches.', 0, 291.30, 2, 10, NULL),
(295, 'SteelSeries Rival 3', '<b>SteelSeries Rival 3</b><br>Affordable wired gaming mouse with RGB lighting.', 0, 39.13, 2, 11, NULL),
(296, 'TP-Link Archer AX6000', '<b>TP-Link Archer AX6000</b><br>WiFi 6 router with 8 LAN ports and high speeds.', 0, 230.43, 7, NULL, NULL),
(297, 'Toshiba N300 10TB', '<b>Toshiba N300 10TB</b><br>High-performance NAS HDD for data storage.', 0, 369.57, 1, 14, NULL),
(298, 'Toshiba P300 3TB', '<b>Toshiba P300 3TB</b><br>High-capacity 7200 RPM internal hard drive.', 0, 100.00, 1, 14, NULL),
(299, 'Ubiquiti UniFi Dream Machine', '<b>Ubiquiti UniFi Dream Machine</b><br>All-in-one enterprise-grade WiFi router and controller.', 0, 369.57, 7, NULL, NULL),
(300, 'Western Digital Black 2TB', '<b>Western Digital Black 2TB</b><br>Performance-focused 7200 RPM hard drive.', 0, 117.39, 1, 14, NULL),
(301, 'Western Digital Black 4TB', '<b>Western Digital Black 4TB</b><br>High-performance HDD for gaming and professional use.', 0, 195.65, 1, 14, NULL),
(302, 'Western Digital Blue 1TB', '<b>Western Digital Blue 1TB</b><br>Reliable 5400 RPM internal hard drive.', 0, 52.17, 1, 14, NULL),
(303, 'AMD Ryzen 9 7950X', '<b>AMD Ryzen 9 7950X</b><br>High-end 16-core desktop CPU for gaming and productivity.', 0, 699.99, 1, 1, NULL),
(304, 'Intel Core i9-13900K', '<b>Intel Core i9-13900K</b><br>Powerful 24-core CPU with hybrid architecture.', 0, 589.99, 1, 1, NULL),
(305, 'NVIDIA GeForce RTX 4090', '<b>NVIDIA GeForce RTX 4090</b><br>Top-tier graphics card with 24GB GDDR6X memory.', 0, 1599.99, 1, 2, NULL),
(306, 'AMD Radeon RX 7900 XTX', '<b>AMD Radeon RX 7900 XTX</b><br>High-performance GPU for 4K gaming and content creation.', 0, 999.99, 1, 2, NULL),
(307, 'Samsung 980 Pro 2TB', '<b>Samsung 980 Pro 2TB</b><br>Fast NVMe M.2 SSD for gaming and workstations.', 0, 279.99, 1, 5, NULL),
(308, 'Western Digital Black SN850 1TB', '<b>Western Digital Black SN850 1TB</b><br>High-speed NVMe SSD with heatsink.', 0, 149.99, 1, 5, NULL),
(309, 'Crucial Ballistix 32GB DDR4 3600MHz', '<b>Crucial Ballistix 32GB DDR4 3600MHz</b><br>High-performance 3 kit for gaming and multitasking.', 0, 129.99, 1, 4, NULL),
(310, 'Corsair Vengeance RGB Pro 16GB DDR4', '<b>Corsair Vengeance RGB Pro 16GB DDR4</b><br>Stylish RGB memory kit with high speed.', 0, 89.99, 1, 4, NULL),
(311, 'Noctua NH-D15', '<b>Noctua NH-D15</b><br>Premium air CPU cooler with excellent cooling performance.', 0, 99.99, 1, 6, NULL),
(312, 'Arctic F12 PWM PST', '<b>Arctic F12 PWM PST</b><br>Affordable 120mm case fan with PWM control.', 0, 9.99, 1, 7, NULL),
(313, 'Logitech G Pro Wireless', '<b>Logitech G Pro Wireless</b><br>Lightweight wireless gaming mouse.', 0, 129.99, 2, 11, NULL),
(314, 'SteelSeries Sensei Ten', '<b>SteelSeries Sensei Ten</b><br>Ergonomic wired gaming mouse with TrueMove Pro sensor.', 0, 69.99, 2, 11, NULL),
(315, 'Razer Huntsman V2 Analog', '<b>Razer Huntsman V2 Analog</b><br>Optical analog mechanical keyboard.', 0, 199.99, 2, 10, NULL),
(316, 'ASUS ROG Swift PG32UQX', '<b>ASUS ROG Swift PG32UQX</b><br>32\" 4K gaming monitor with 144Hz refresh rate.', 0, 2999.99, 3, NULL, NULL),
(317, 'Samsung Odyssey G9', '<b>Samsung Odyssey G9</b><br>49\" ultra-wide curved gaming monitor.', 0, 1399.99, 3, NULL, NULL),
(318, 'Apple Watch Ultra', '<b>Apple Watch Ultra</b><br>Rugged smartwatch with advanced health and fitness tracking.', 0, 799.99, 4, NULL, NULL),
(319, 'Fitbit Charge 5', '<b>Fitbit Charge 5</b><br>Advanced fitness tracker with built-in GPS.', 0, 129.95, 4, NULL, NULL),
(320, 'Amazon Echo Dot (5th Gen)', '<b>Amazon Echo Dot (5th Gen)</b><br>Compact smart speaker with Alexa.', 0, 49.99, 6, NULL, NULL),
(321, 'Google Nest Hub (2nd Gen)', '<b>Google Nest Hub (2nd Gen)</b><br>Smart display with Google Assistant.', 0, 99.99, 6, NULL, NULL),
(322, 'TP-Link Deco X60', '<b>TP-Link Deco X60</b><br>Mesh WiFi 6 system for whole-home coverage.', 0, 249.99, 7, NULL, NULL),
(323, 'Netgear Orbi RBK852', '<b>Netgear Orbi RBK852</b><br>High-performance WiFi 6 mesh system.', 0, 399.99, 7, NULL, NULL),
(324, 'Seagate FireCuda 530 2TB', '<b>Seagate FireCuda 530 2TB</b><br>High-speed NVMe SSD designed for gaming.', 0, 399.99, 1, 5, NULL),
(325, 'Samsung 870 EVO 1TB', '<b>Samsung 870 EVO 1TB</b><br>Reliable SATA SSD for everyday use.', 0, 109.99, 1, 5, NULL),
(326, 'WD My Passport 5TB', '<b>WD My Passport 5TB</b><br>Portable external hard drive.', 0, 119.99, 8, NULL, NULL),
(327, 'SanDisk Extreme Portable SSD 1TB', '<b>SanDisk Extreme Portable SSD 1TB</b><br>Durable and fast external SSD.', 0, 159.99, 8, NULL, NULL),
(328, 'Lenovo Yoga Tab 13', '<b>Lenovo Yoga Tab 13</b><br>Tablet with large display and built-in kickstand.', 0, 579.99, 5, NULL, NULL),
(329, 'Microsoft Band 3', '<b>Microsoft Band 3</b><br>Fitness tracker with heart rate monitor.', 0, 149.99, 4, NULL, NULL),
(330, 'DJI Osmo Mobile 6', '<b>DJI Osmo Mobile 6</b><br>3-axis smartphone gimbal stabilizer.', 0, 159.99, 9, NULL, NULL),
(331, 'Logitech MX Keys', '<b>Logitech MX Keys</b><br>Advanced wireless keyboard for productivity.', 0, 99.99, 2, 10, NULL),
(332, 'Corsair HS70 Pro Wireless', '<b>Corsair HS70 Pro Wireless</b><br>Wireless gaming headset with surround sound.', 0, 99.99, 2, 12, NULL),
(333, 'HyperX Cloud II', '<b>HyperX Cloud II</b><br>Comfortable wired gaming headset.', 0, 99.99, 2, 12, NULL),
(334, 'AMD Radeon RX 6800 XT', '<b>AMD Radeon RX 6800 XT</b><br>High-end graphics card for 4K gaming.', 0, 649.99, 1, 2, NULL),
(335, 'Intel Core i7-13700K', '<b>Intel Core i7-13700K</b><br>Powerful 16-core CPU for gaming and content creation.', 0, 409.99, 1, 1, NULL),
(336, 'Seasonic Focus GX-850', '<b>Seasonic Focus GX-850</b><br>850W fully modular power supply.', 0, 159.99, 1, 8, NULL),
(337, 'Cooler Master MasterLiquid ML240L', '<b>Cooler Master MasterLiquid ML240L</b><br>240mm AIO liquid CPU cooler.', 0, 89.99, 1, 6, NULL),
(338, 'Samsung Galaxy Tab A8', '<b>Samsung Galaxy Tab A8</b><br>Budget-friendly Android tablet.', 0, 229.99, 5, NULL, NULL),
(339, 'Apple AirPods Pro (2nd Gen)', '<b>Apple AirPods Pro (2nd Gen)</b><br>Wireless noise-cancelling earbuds.', 0, 249.00, 9, NULL, NULL),
(340, 'JBL Flip 6', '<b>JBL Flip 6</b><br>Portable Bluetooth speaker with powerful sound.', 0, 129.95, 9, NULL, NULL),
(341, 'ASUS ROG Strix Z790-E', '<b>ASUS ROG Strix Z790-E</b><br>High-end gaming motherboard for Intel 13th Gen 0.', 0, 399.99, 1, 3, NULL),
(342, 'MSI MAG B550 Tomahawk', '<b>MSI MAG B550 Tomahawk</b><br>Reliable motherboard for AMD Ryzen 0.', 0, 179.99, 1, 3, NULL),
(343, 'Gigabyte X670 AORUS Elite', '<b>Gigabyte X670 AORUS Elite</b><br>Feature-rich motherboard for AMD Ryzen 7000 series.', 0, 299.99, 1, 3, NULL),
(344, 'Corsair Vengeance LPX 32GB DDR4 3200MHz', '<b>Corsair Vengeance LPX 32GB DDR4 3200MHz</b><br>High-performance 3 kit.', 0, 124.99, 1, 4, NULL),
(345, 'G.Skill Trident Z RGB 16GB DDR4 3600MHz', '<b>G.Skill Trident Z RGB 16GB DDR4 3600MHz</b><br>RGB illuminated high-speed memory.', 0, 99.99, 1, 4, NULL),
(346, 'Intel Optane Memory H20', '<b>Intel Optane Memory H20</b><br>Hybrid SSD for faster storage and responsiveness.', 0, 149.99, 1, 5, NULL),
(347, 'Western Digital Blue SN570 1TB', '<b>Western Digital Blue SN570 1TB</b><br>NVMe SSD for mainstream users.', 0, 89.99, 1, 5, NULL),
(348, 'ASRock B650M Pro RS', '<b>ASRock B650M Pro RS</b><br>Affordable motherboard for AMD Ryzen 7000 0.', 0, 139.99, 1, 3, NULL),
(349, 'NZXT Kraken X53', '<b>NZXT Kraken X53</b><br>240mm AIO liquid CPU cooler with RGB lighting.', 0, 129.99, 1, 6, NULL),
(350, 'DeepCool AK620', '<b>DeepCool AK620</b><br>High-performance dual-tower air cooler.', 0, 89.99, 1, 6, NULL),
(351, 'Thermaltake Riing Plus 12 RGB', '<b>Thermaltake Riing Plus 12 RGB</b><br>12cm RGB case fan with software control.', 0, 29.99, 1, 7, NULL),
(352, 'Fractal Design Aspect 12 RGB', '<b>Fractal Design Aspect 12 RGB</b><br>Silent 120mm RGB fan with good airflow.', 0, 19.99, 1, 7, NULL),
(353, 'Samsung Galaxy Watch 5', '<b>Samsung Galaxy Watch 5</b><br>Smartwatch with health monitoring and GPS.', 0, 299.99, 4, NULL, NULL),
(354, 'Garmin Venu 2', '<b>Garmin Venu 2</b><br>Smartwatch with AMOLED display and fitness tracking.', 0, 399.99, 4, NULL, NULL),
(355, 'Fitbit Inspire 3', '<b>Fitbit Inspire 3</b><br>Simple fitness tracker with heart rate monitoring.', 0, 79.99, 4, NULL, NULL),
(356, 'Acer Predator XB273K', '<b>Acer Predator XB273K</b><br>27\" 4K gaming monitor with G-SYNC.', 0, 799.99, 3, NULL, NULL),
(357, 'BenQ EX3501R', '<b>BenQ EX3501R</b><br>35\" ultra-wide curved monitor with HDR support.', 0, 699.99, 3, NULL, NULL),
(358, 'Logitech G915 TKL', '<b>Logitech G915 TKL</b><br>Wireless mechanical gaming keyboard.', 0, 229.99, 2, 10, NULL),
(359, 'Razer Basilisk V3 Pro', '<b>Razer Basilisk V3 Pro</b><br>Wireless gaming mouse with customizable buttons.', 0, 149.99, 2, 11, NULL),
(360, 'HyperX Alloy FPS Pro', '<b>HyperX Alloy FPS Pro</b><br>Compact mechanical keyboard for FPS gaming.', 0, 99.99, 2, 10, NULL),
(361, 'Corsair Katar Pro Wireless', '<b>Corsair Katar Pro Wireless</b><br>Lightweight wireless gaming mouse.', 0, 49.99, 2, 11, NULL),
(362, 'Sony WH-1000XM5', '<b>Sony WH-1000XM5</b><br>Industry-leading noise cancelling 12.', 0, 349.99, 9, NULL, NULL),
(363, 'Bose QuietComfort 45', '<b>Bose QuietComfort 45</b><br>Comfortable wireless noise cancelling 12.', 0, 329.99, 9, NULL, NULL),
(364, 'Jabra Elite 85t', '<b>Jabra Elite 85t</b><br>True wireless earbuds with advanced ANC.', 0, 229.99, 9, NULL, NULL),
(365, 'Anker Soundcore Liberty Air 2 Pro', '<b>Anker Soundcore Liberty Air 2 Pro</b><br>Wireless earbuds with custom EQ and ANC.', 0, 129.99, 9, NULL, NULL),
(366, 'Amazon Echo Show 8 (2nd Gen)', '<b>Amazon Echo Show 8 (2nd Gen)</b><br>Smart display with Alexa and 8\" screen.', 0, 129.99, 6, NULL, NULL),
(367, 'Philips Hue Starter Kit', '<b>Philips Hue Starter Kit</b><br>Smart lighting system with color control.', 0, 199.99, 6, NULL, NULL),
(368, 'Ring Video Doorbell 4', '<b>Ring Video Doorbell 4</b><br>Wireless video doorbell with motion detection.', 0, 199.99, 6, NULL, NULL),
(369, 'Google Nest Cam (Battery)', '<b>Google Nest Cam (Battery)</b><br>Wireless smart security camera.', 0, 179.99, 6, NULL, NULL),
(370, 'TP-Link TL-SG108', '<b>TP-Link TL-SG108</b><br>8-port gigabit Ethernet switch.', 0, 29.99, 7, NULL, NULL),
(371, 'Netgear Nighthawk AX8', '<b>Netgear Nighthawk AX8</b><br>WiFi 6 router with 8 streams.', 0, 299.99, 7, NULL, NULL),
(372, 'Linksys Velop MX10', '<b>Linksys Velop MX10</b><br>Tri-band WiFi 6 mesh system.', 0, 499.99, 7, NULL, NULL),
(373, 'Seagate Backup Plus Slim 2TB', '<b>Seagate Backup Plus Slim 2TB</b><br>Portable external HDD.', 0, 79.99, 8, NULL, NULL),
(374, 'Western Digital Elements 4TB', '<b>Western Digital Elements 4TB</b><br>Affordable external hard drive.', 0, 99.99, 8, NULL, NULL),
(375, 'SanDisk Ultra 3D 1TB', '<b>SanDisk Ultra 3D 1TB</b><br>3D NAND SATA SSD.', 0, 119.99, 1, 5, NULL),
(376, 'ADATA XPG SX8200 Pro 1TB', '<b>ADATA XPG SX8200 Pro 1TB</b><br>High-speed NVMe SSD.', 0, 109.99, 1, 5, NULL),
(377, 'Corsair RM850x', '<b>Corsair RM850x</b><br>850W fully modular power supply with quiet operation.', 0, 149.99, 1, 8, NULL),
(378, 'EVGA RTX 4070 Ti', '<b>EVGA RTX 4070 Ti</b><br>Powerful mid-range graphics card.', 0, 799.99, 1, 2, NULL),
(379, 'AMD Ryzen 7 7700X', '<b>AMD Ryzen 7 7700X</b><br>8-core desktop CPU with high clock speeds.', 0, 399.99, 1, 1, NULL),
(380, 'Intel Core i5-13600K', '<b>Intel Core i5-13600K</b><br>Popular 14-core CPU for gaming and productivity.', 0, 319.99, 1, 1, NULL),
(381, 'Noctua NF-A12x25', '<b>Noctua NF-A12x25</b><br>Premium 120mm case fan with quiet operation.', 0, 29.99, 1, 7, NULL),
(382, 'NZXT H710', '<b>NZXT H710</b><br>Spacious mid-tower case with tempered glass.', 0, 169.99, 1, 9, NULL),
(383, 'Corsair iCUE 4000X RGB', '<b>Corsair iCUE 4000X RGB</b><br>Mid-tower case with RGB lighting.', 0, 149.99, 1, 9, NULL),
(384, 'Thermaltake Toughpower GF1 850W', '<b>Thermaltake Toughpower GF1 850W</b><br>High-efficiency modular power supply.', 0, 159.99, 1, 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`) VALUES
(7, 1, 'Case Fans'),
(9, 1, 'Cases'),
(6, 1, 'CPU Coolers'),
(1, 1, 'CPUs'),
(2, 1, 'GPUs'),
(14, 1, 'HDD'),
(3, 1, 'Motherboards'),
(8, 1, 'PSU'),
(4, 1, 'RAM'),
(5, 1, 'SSDs'),
(13, 2, 'Headphones'),
(12, 2, 'Headsets'),
(10, 2, 'Keyboards'),
(11, 2, 'Mice');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `has_pfp` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `admin`, `has_pfp`) VALUES
(0, 'admin', '$2y$10$knVSDFTQanDydKCAfMTJq.3R6azzoX7eDgqeGJXqiLmpX8hmi88fa', 'rUvgv4Dyz9Lzwloe1XYYD52oj6B554', 1, NULL),
(1, 'owner', '$2y$10$IUeCEg6s6ytp.gErk95DHuMFw9iTyjuinFJL..K6/eaHi4bCCqn6W', 'marekmulac@gmail.com', 1, 1),
(10, 'Testing', '$2y$10$Xd4fNu55UwiM6dCqPvcxtuVLEtZ3.Jpv6GUi3ZicGWy4v0z8aoZ7y', 'marekmulac14@gmail.com', 0, NULL),
(11, 'Mareczech', '$2y$10$eXpNOK/2MW7ujtnK9bqwhenanhnwvNGFIwBOEYW7xa.59Y39ka/4e', 'afdasf@fhasof.com', 0, NULL),
(12, 'sasik', '$2y$10$0t1Jcrg0fCozs4Pn7UAQIeMEP9T9BmdK4Dq1cb18wz/J4EZVHllm2', 'sasik@gmail.com', 0, 1),
(13, 'marek', '$2y$10$BEBFylnJ4BolstXTgCuCxu5vhxIFknn2PPUg6dpjw.d2MNgLS.HCC', 'a@a.cz', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name_unique` (`category_id`,`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
