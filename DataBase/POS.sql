-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2022 at 06:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `POS`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` int(11) NOT NULL,
  `BrandName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`) VALUES
(4, 'Apple'),
(6, 'Huawei'),
(7, 'Samsung'),
(8, 'Nothing'),
(11, 'LG'),
(12, 'Mi'),
(15, 'Sony');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(14, 'Mac'),
(15, 'Phone'),
(18, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(30) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `CustomerName`, `Address`, `Phone`, `Email`, `Password`, `Status`) VALUES
(11, 'Hein Zin', 'Yangon', '09780097833', 'Hein@gmail.com', '1234', 'Hello'),
(18, 'Su Mon', 'Yangon', '09780097833', 'su@gmail.com', '1234', 'hi'),
(19, 'lwin', 'hlhohdvoan', '0912234', 'lwin123@gmail.com', '$2y$10$lxwyDNP0rFD0R49g0kYbsO/CBsHtcy1J.AsPL27Aq3IzGxaOcNnSa', '1'),
(20, 'Hein', 'Thamine', '09388229', 'hein90@gmail.com', '$2y$10$DHp.LBHzm4.gXGiKdUsC/eCHmS5NNo2dp7fz/2VyppQYki/k44HYy', '1'),
(22, 'Thu Thu', 'OOOOO', '09339943', 'hein46333@gmail.com', '$2y$10$UqKL98fki282ZlgvbEsLkerlEDNQhtuFI.hJq.G8EgUy25EjwOCF6', '1'),
(23, 'Hein', 'Yangon', '09453453', 'zin360360@gmail.com', '$2y$10$5uRxmlw1H0Pplm9ogVbv4u56Rnl58bs6b9ut7IsH5Gi1gtpz/7qqu', '1'),
(24, 'Hein Zin', 'Yangon', '09889988', 'heinzin112@gmail.com', '$2y$10$w4hE9U8vXigRftJgyVEAEuPkRKrsdmi6Fvo4fXaxVguVckQ26Ve7O', '1'),
(25, 'Hein Zin', 'Yangon', '9787843', 'hein90641@gmail.com', '$2y$10$kOdnD1ZJOlVXDi0ZUgvz/Oa9imgFaEhvWemIfpNWqXHvrcZb.oIMC', '1'),
(26, 'hein', 'Yangon', '98945353', 'tygord259@gmail.com', '$2y$10$yp1L66eEYV3IyuJTudVkYuHG4ZEBFdbQd2mC7zCrJBr3cy4XgBeKi', '1'),
(30, 'Kilo', 'Yangon', '988899', 'zinhein686@gmail.com', '$2y$10$xdrBpxTgaWOcXKBiDw.QFukTjrpES9I2IjD8pkz/l5QKos30Fdl6S', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE `orderproduct` (
  `OrderID` varchar(15) NOT NULL,
  `ProductID` int(15) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderproduct`
--

INSERT INTO `orderproduct` (`OrderID`, `ProductID`, `Quantity`, `Price`) VALUES
('OR-000002', 23, 1, 1500000),
('OR-000004', 23, 1, 1500000),
('OR-000002', 25, 1, 180000),
('OR-000004', 25, 1, 180000),
('OR-000001', 26, 1, 1500000),
('OR-000003', 26, 1, 1500000),
('OR-000005', 26, 1, 1500000),
('OR-000006', 26, 1, 1500000),
('OR-000009', 26, 2, 3000000),
('OR-000008', 27, 2, 3000000),
('OR-000010', 27, 2, 4200000),
('OR-000007', 28, 2, 3150000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(20) NOT NULL,
  `OrderDate` date NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `TotalAmount` varchar(20) NOT NULL,
  `TotalQuantity` varchar(20) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `PaymentOption` varchar(10) NOT NULL,
  `DeliveryPhone` varchar(20) NOT NULL,
  `DeliveryAddress` varchar(255) NOT NULL,
  `CardNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderDate`, `CustomerID`, `TotalAmount`, `TotalQuantity`, `Status`, `PaymentOption`, `DeliveryPhone`, `DeliveryAddress`, `CardNo`) VALUES
('OR-000001', '2022-10-28', 24, '1,500,000', '1', 'Canceled', 'Mastercard', '943534535', 'yg', 'Pay with Mastercard'),
('OR-000002', '2022-10-28', 24, '1,680,000', '2', 'Approved', 'VISA', '8498458', 'gjagkl', 'Pay with VISA'),
('OR-000003', '2022-10-28', 20, '1,500,000', '1', 'Approved', 'VISA', '435345', 'rter', 'Pay with VISA'),
('OR-000004', '2022-10-29', 25, '1,680,000', '2', 'Pending', 'VISA', '92423324', 'Yangon', 'Pay with VISA'),
('OR-000005', '2022-10-29', 25, '1,500,000', '1', 'Canceled', 'COD', '9795', 'hkdfh', 'Pay with COD'),
('OR-000006', '2022-10-30', 24, '1,500,000', '1', 'Pending', 'COD', '9799', 'trhh', 'Pay with COD'),
('OR-000007', '2022-11-23', 24, '3,150,000', '2', 'Canceled', 'COD', '0939323', 'yangon', 'Pay with COD'),
('OR-000008', '2022-11-24', 27, '3,000,000', '2', 'Canceled', 'COD', '9889988', 'Yangon', 'Pay with COD'),
('OR-000009', '2022-11-24', 28, '3,000,000', '2', 'Canceled', 'COD', '9334455', 'Yangon', 'Pay with COD'),
('OR-000010', '2022-11-24', 30, '4,200,000', '2', 'Canceled', 'COD', '98877', 'yangon', 'Pay with COD');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` varchar(20) NOT NULL,
  `TotalAmount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `OrderID`, `TotalAmount`) VALUES
(31, 'OR-000009', '1,888,888'),
(32, 'OR-000010', '1,888,888'),
(33, 'OR-000011', '2,132,132'),
(34, 'OR-000011', '2,132,132'),
(35, 'OR-000012', '2,375,376'),
(36, 'OR-000013', '4,000,000'),
(37, 'OR-000014', '15,000,000'),
(38, 'OR-000015', '7,000,000'),
(39, 'OR-000015', '7,150,000'),
(40, 'OR-000015', '3,500,000'),
(41, 'OR-000015', '3,500,000'),
(42, 'OR-000015', '3,500,000'),
(43, 'OR-000015', '3,500,000'),
(44, 'OR-000015', '3,500,000'),
(45, 'OR-000016', '7,000,000'),
(46, 'OR-000016', '5,500,000'),
(47, 'OR-000016', '3,500,000'),
(48, 'OR-000017', '3,500,000'),
(49, 'OR-000017', '3,500,000'),
(50, 'OR-000017', '3,500,000'),
(51, 'OR-000016', '3,500,000'),
(52, 'OR-000017', '3,500,000'),
(53, 'OR-000017', '3,500,000'),
(54, 'OR-000017', '3,500,000'),
(55, 'OR-000017', '3,500,000'),
(56, 'OR-000017', '3,075,000'),
(57, 'OR-000016', '3,500,000'),
(58, 'OR-000017', '3,500,000'),
(59, 'OR-000018', '8,500,000'),
(60, 'OR-000019', '5,075,000'),
(61, 'OR-000019', '3,500,000'),
(62, 'OR-000019', '2,700,000'),
(63, 'OR-000020', '2,000,000'),
(64, 'OR-000020', '4,700,000'),
(65, 'OR-000021', '6,025,000'),
(66, 'OR-000022', '6,200,000'),
(67, 'OR-000023', '6,200,000'),
(68, 'OR-000024', '2,500,000'),
(69, 'OR-000025', '1,500,000'),
(70, 'OR-000026', '1,500,000'),
(71, 'OR-000026', '700,000'),
(72, 'OR-000027', '700,000'),
(73, 'OR-000027', '1,500,000'),
(74, 'OR-000027', '180,000'),
(75, 'OR-000028', '180,000'),
(76, 'OR-000028', '180,000'),
(77, 'OR-000001', '1,500,000'),
(78, 'OR-000002', '1,680,000'),
(79, 'OR-000003', '1,500,000'),
(80, 'OR-000004', '1,680,000'),
(81, 'OR-000005', '1,500,000'),
(82, 'OR-000006', '1,500,000'),
(83, 'OR-000007', '3,150,000'),
(84, 'OR-000008', '3,000,000'),
(85, 'OR-000009', '3,000,000'),
(86, 'OR-000010', '3,000,000'),
(87, 'OR-000010', '4,200,000');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `Price` decimal(16,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Color` varchar(30) NOT NULL,
  `FrontImage` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `CategoryID`, `BrandID`, `Price`, `Quantity`, `Color`, `FrontImage`, `Description`) VALUES
(9, 'Apple 13 pro max', 15, 4, '1500000.00', 14, 'Aplie green', './ProductImage/_h.png', 'good'),
(10, '8 Plus', 15, 4, '2000000.00', 5, 'Red', './ProductImage/_iphone8plus.png', 'Redddd'),
(11, '13 Pro ', 15, 4, '1575000.00', 15, 'Black', './ProductImage/_iphone13.png', 'GOOD'),
(12, 'Mi 10T', 15, 12, '700000.00', 17, 'AuroraBlue', './ProductImage/_J3SBlue-800-png-pro.png', '\r\nProcessor: Snapdragon 865 Plus\r\nRAM: 8GB\r\nStorage: 128GB\r\nDisplay: 6.67 inches\r\nCamera: Rear: 108MP Quad-camera, Front: 20MP\r\nBattery: 5000mAh battery, 33W wireless'),
(19, 'Iphone 12', 15, 4, '2000000.00', 9, 'Black', './ProductImage/_r1433_product_red_pdp_image_position-1a_avail__en-in-2-removebg-preview-2.png', 'detail'),
(20, 'Iphone 13', 15, 4, '2500000.00', 9, 'Red', './ProductImage/_aa.png', 'Detail'),
(21, 'Apple 13 Pro Max', 15, 4, '2000000.00', 10, 'Aplie Green', './ProductImage/_13.png', 'Very Good'),
(22, 'HUAWEI TV Vision', 18, 6, '2100000.00', 10, 'Black', './ProductImage/_huawei-vision-s-stunning-colour.png', 'The 4K UHD infinity screen provides an immersive experience, with a high-class stainless metal frame and base.'),
(23, 'Mi Tv P1', 18, 12, '1500000.00', 17, 'Black', './ProductImage/_55-inch.png', 'Screen type: 4K UHD\r\nResolution: 3840 x 2160\r\nColor Gamut: NTSC 88% (typ.), DCI-P3 94% (typ.), BT.709 99.5% (typ.)\r\nColor Depth: 1.07 billion (8bit + FRC)\r\nRefresh rate: 60Hz\r\nMEMC: UHD 60Hz\r\nViewing Angle: 178°(H)/178°(V)\r\nDolby Vision®\r\nHDR10+\r\nHLG'),
(24, 'Sony Xperia 1 III', 15, 15, '1500000.00', 20, 'Black', './ProductImage/_12460258-12460258.png', 'Sony officially charges 1299 Euros (~$1530) for its smartphone. That is a lot of money, even though 12 GB of RAM and 256 GB of mass storage are on board.'),
(25, 'Sony BRAVIA Tv', 18, 15, '180000.00', 15, 'Black', './ProductImage/_4dfd9ca48ba82b26b620b9049c099665.webp', 'Led by the Picture Processor X1 Ultimate, content is analyzed in real time to bring out OLED.'),
(26, 'Sony Android TV', 18, 15, '1500000.00', 11, 'Black', './ProductImage/_388-3880325_sony-32-android-tv.png', 'This Sony 32 Android Tv is high quality PNG picture material, '),
(27, 'Mi Tv 4C', 18, 12, '2100000.00', 25, 'Black', './ProductImage/_1927F00B-489F-E318-E3B1-AF53E5265F9C!800x800!85.png', 'Ultra-bright LED display\r\nPowerful 20W stereo speakers\r\n700,000+ hours of content on PatchWall\r\n64-bit quad-core processor, 1 GB RAM + 8GB Storage\r\nOne remote: Control TV, set-up box and more'),
(28, 'Iphone8', 15, 4, '15750000.00', 48, 'Black', './ProductImage/_DEL.png', 'GOOD'),
(29, 'Iphone', 15, 4, '1575000.00', 20, 'Red', './ProductImage/_Iphone13.png', 'Good'),
(30, 'Iphone12', 15, 4, '2000000.00', 22, 'Black', './ProductImage/_Iphone13.png', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `PurchaseID` varchar(30) NOT NULL,
  `PurchaseDate` datetime NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `TotalAmount` decimal(16,2) NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `GovTax` decimal(16,2) NOT NULL,
  `NetAmount` decimal(16,2) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`PurchaseID`, `PurchaseDate`, `SupplierID`, `StaffID`, `TotalAmount`, `TotalQuantity`, `GovTax`, `NetAmount`, `Status`) VALUES
('PUR-000001', '2022-10-29 00:00:00', 3, 32, '15000000.00', 10, '750000.00', '15750000.00', 'Pending'),
('PUR-000002', '2022-11-24 00:00:00', 3, 34, '300000000.00', 20, '15000000.00', '315000000.00', 'Pending'),
('PUR-000003', '2022-11-24 00:00:00', 3, 35, '20000000.00', 10, '1000000.00', '21000000.00', 'Pending'),
('PUR-000004', '2022-11-24 00:00:00', 3, 36, '15000000.00', 10, '750000.00', '15750000.00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE `purchasedetail` (
  `PurchaseID` varchar(15) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `PurchasePrice` decimal(16,2) NOT NULL,
  `PurchaseQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasedetail`
--

INSERT INTO `purchasedetail` (`PurchaseID`, `ProductID`, `PurchasePrice`, `PurchaseQuantity`) VALUES
('PUR-000001', 28, '1500000.00', 10),
('PUR-000002', 28, '15000000.00', 20),
('PUR-000003', 27, '2000000.00', 10),
('PUR-000004', 29, '1500000.00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `StaffName` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL,
  `Role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffName`, `Email`, `Password`, `PhoneNumber`, `Role`) VALUES
(3, 'Su Su', 'susu@gmail.com', '', '989998999', 'Select Staff Role'),
(4, 'gg', 'gg@gmail.com', '', '132342424', 'Sale Staff'),
(5, 'Myo', 'Myo@gmail.com', '', '912121121', 'Sale Staff'),
(8, 'mon', 'mon@gmail.com', '', '989998999', 'Manager'),
(11, 'Ki KI', 'kiki@gmail.com', '', '98838838', 'Manager'),
(12, 'Ko', 'kokoko@gmail.com', '', '35535', 'Sale Staff'),
(13, 'hi', 'koooo@gmail.com', '', '923232', 'Sale Staff'),
(18, 'fdgd', 'gddg@gmail.com', '', '978787', 'Order Accpeting Staff'),
(19, 'hi', 'hr@gmail.com', '', '342', 'Manager'),
(22, 'jsd', 'kdfj@gmail.com', '', '09878339', 'Sale Staff'),
(23, 'lplp', 'lplp@gmail.com', '', '1234', 'Manager'),
(24, 'gege', 'hidhf@gmail.com', '', '1212', 'Manager'),
(25, 'lolo', 'lolo@gmail.com', '', '0978892', 'Manager'),
(26, 'dfg', 'dfg@gmail.com', '', '224242', 'Select Staff Role'),
(27, 'jo', 'zinzin223332@gmail.com', '$2y$10$B5ys20xEoizDwzIHEXjudO2fjp2mPzDvahFNg7B9lviUwuzqkvIma', '234234', 'Select Staff Role'),
(28, 'Thu Rein', 'dawthin499@gmail.com', '', '09898989', 'Manager'),
(29, 'OL', 'hein90641@gmail.com', '$2y$10$lHvlWfAsJxT2GkzJ1FDBSu350IalKA16MfXNRIWKLf32GTdvokcE6', '099434323', 'Sale Staff'),
(30, 'Mg Thu', 'mgthu112@gmail.com', '$2y$10$lGr6g8HdJTVu6w6zvdyUyOYtnJLO9N/4JptnlXUacx2DZJplEy4jm', '09787878112', 'Sale Staff'),
(31, 'Hein', 'zinhein686@gmail.com', '$2y$10$oIqYbCTXET7R.kH7z6rGG.KJYqPOZqn5MuY3swTYGOm0QK4nmsXv.', '094242224', 'Manager'),
(32, 'Lin', 'linhtet@gmail.com', '$2y$10$DOT5ifae/dM31Y63/IEfZ.L2PeY78r0tTz3J9Sh2w8KWQT3qVd.pS', '9899425', 'Manager'),
(36, 'Helo', 'tygord259@gmail.com', '$2y$10$IbSTWR0Oj/fUjJ/15tPJYeiS.oAy6VsvjctACWqcI/A63Cs3CZBT.', '998882', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` int(11) NOT NULL,
  `SupplierName` varchar(20) NOT NULL,
  `NRC` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `NRC`, `Email`, `Phone`, `Address`) VALUES
(3, 'Apple', '14/ZALANA(NA)123232', 'apple@gmail.com', '', ''),
(6, 'Nay Htut', '14/Zalas176492', 'nayhtut@gmail.com', '9838838', ''),
(7, 'Mg Lin', '12/Zjakd(L)13242', 'mglin123@gmail.com', '09434343', 'No 227, Hledan, Yangon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`ProductID`,`OrderID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`PurchaseID`);

--
-- Indexes for table `purchasedetail`
--
ALTER TABLE `purchasedetail`
  ADD PRIMARY KEY (`PurchaseID`,`ProductID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SupplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
