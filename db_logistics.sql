-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2026 at 10:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_logistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactform`
--

CREATE TABLE `tbl_contactform` (
  `Id` int(11) NOT NULL,
  `Full_name` varchar(30) DEFAULT NULL,
  `Email_id` varchar(50) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) DEFAULT NULL,
  `inquiry_status` enum('New','Negotiating','Settled','Exported') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contactform`
--

INSERT INTO `tbl_contactform` (`Id`, `Full_name`, `Email_id`, `Subject`, `Message`, `Created_at`, `product_id`, `inquiry_status`) VALUES
(1, 'Ashfiya', 'ashfiya123@gmail.com', 'Inquiry for Sea Freight', 'I would like to know the shipping rates from Chennai to Malaysia for a 20ft container.', '2026-04-12 03:50:11', NULL, 'New');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` varchar(100) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `source_type` enum('Produced','Bought') DEFAULT 'Produced',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `product_name`, `product_category`, `product_description`, `product_image`, `source_type`, `created_at`) VALUES
(1, 'Premium Red Onions (Nashik Grade)', 'Fruits & Vegetables', 'Export-quality red onions, size 55mm+, well-dried skin. Suitable for long-distance sea freight in ventilated containers.', 'prod_1777308113.jpg', 'Bought', '2026-04-24 14:45:21'),
(2, 'Hand-Carved Teakwood Elephant', 'Handicrafts', 'Traditional Indian handicrafts made from sustainably sourced teakwood. Polished finish, 12-inch height.', 'prod_1777042097.jpg', 'Produced', '2026-04-24 14:48:17'),
(3, 'Brass Dancing Shiva (Nataraja) Statue', 'Handicrafts', 'Premium quality handcrafted brass alloy statue with antique finish. Traditional Indian Chola style design, 18 inches in height, suitable for luxury home decor and global art galleries.', 'prod_1777308375.jpg', 'Bought', '2026-04-27 16:46:15'),
(4, 'Sheesham Wood Carved Dining Table', 'Furniture', 'Robust 6-seater dining table made from seasoned Sheesham (Indian Rosewood). Features intricate hand-carved floral borders and a natural honey finish. Export-ready with moisture-controlled wood treatment.', 'prod_1777308449.jpg', 'Produced', '2026-04-27 16:47:29'),
(6, 'Hand-Woven Pashmina Shawl', 'Handicrafts', 'Authentic 100% pure Pashmina wool from the Himalayas. Features delicate hand-embroidered \"Sozni\" work. Soft, lightweight, and meeting international textile quality standards.', 'prod_1777308601.jpg', 'Bought', '2026-04-27 16:50:01'),
(7, 'Industrial Loft Style Bookshelf', 'Furniture', 'Modern fusion of reclaimed wood and matte black powder-coated iron. Modular 5-tier design, flat-packed for efficient shipping and easy customer assembly.', 'prod_1777387528.jpg', 'Produced', '2026-04-27 16:51:14'),
(8, 'Organic Alphonso Mangoes (Ratnagiri Grade)', 'Fruits & Vegetables', 'Naturally ripened, GI-tagged Alphonso mangoes. Uniform size (250g-300g), pesticide-free, and packed in ventilated corrugated boxes for international air freight.', 'prod_1777308788.jpg', 'Produced', '2026-04-27 16:53:08'),
(10, 'Cavendish Bananas (Class A Export)', 'Fruits & Vegetables', 'Premium Class A Cavendish bananas, minimum finger length 20cm. Sourced from GAP-certified farms, treated for long-distance shipping in refrigerated containers (Reefers).', 'prod_1777389276.jpg', 'Bought', '2026-04-28 15:14:36'),
(11, 'Elegant Centre Coffee Table', 'Furniture', 'A premium minimalist centrepiece featuring a tempered glass top and a sustainably sourced solid teak wood base. This coffee table combines contemporary geometric design with traditional craftsmanship, making it an ideal addition to modern living spaces or executive lounges. Finished with a moisture-resistant matte coating for long-lasting durability during international transit.', 'prod_1777401524.jpg', 'Bought', '2026-04-28 15:18:11'),
(13, 'Kanchipuram Silk Saree (Gold Brocade)', 'Handicrafts', 'Authentic hand-woven silk saree with traditional temple borders and Zari work.', 'prod_1777389867.jpg', 'Produced', '2026-04-28 15:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quoteform`
--

CREATE TABLE `tbl_quoteform` (
  `Id` int(11) NOT NULL,
  `Origin` varchar(100) DEFAULT NULL,
  `Destination` varchar(100) DEFAULT NULL,
  `Weight` int(11) DEFAULT NULL,
  `Dimension` int(11) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Status` varchar(20) DEFAULT 'pending',
  `Quoted_price` decimal(15,2) DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_quoteform`
--

INSERT INTO `tbl_quoteform` (`Id`, `Origin`, `Destination`, `Weight`, `Dimension`, `Name`, `Email`, `Phone`, `Message`, `Status`, `Quoted_price`, `Created_at`) VALUES
(1, 'Los Angels', 'San Francisco', 45, 120, 'John Doe', 'john.doe@gmail.com', '9080316352', 'Need express delivery for electronic goods.', 'pending', NULL, '2026-04-09 02:48:34'),
(2, 'New York', 'California', 78, 139, 'Mathilika G%', 'mathivijaya04@gmail.com', '9080316352', '', 'pending', NULL, '2026-04-09 02:54:18'),
(3, 'New York', 'California', 78, 139, 'Mathilika G%', 'mathivijaya04@gmail.com', '9080316352', '', 'quoted', 500.00, '2026-04-09 02:55:57'),
(4, 'Los Angels', 'Coimbatore', 45, 120, 'Vinaya G', 'Vinya04@gmail.com', '9089316352', 'Good To Contact With you.', 'quoted', 5000.00, '2026-04-12 03:14:39'),
(5, 'Chennai', 'Mumbai', 25, 100, 'Alice', 'mathivijaya04@gmail.com', '9876543210', 'Express shipping for electronics.', 'accepted', 1200.00, '2026-04-13 15:19:16'),
(6, 'Goa', 'Pune', 150, 450, 'Arun', 'mathigvm643@gmail.com', '9090909090', 'Fragile glass items. Need wooden crate packing.', 'accepted', 8500.00, '2026-04-13 15:33:17'),
(7, 'Chennai', 'Bangalore', 12, 45, 'Rahul Sharma', 'mathivijaya04@gmail.com', '9876543210', 'Handle with care. Contains fragile glassware for a house warming ceremony.', 'accepted', 2500.00, '2026-04-13 15:57:36'),
(8, 'London', 'Coimbatore', 1500, 350, 'Alexander GreatmanS', 'mathigvm643@gmail.com', '8887776665', 'Industrial machinery parts. Requires heavy-duty forklift for unloading at the destination warehouse.', 'accepted', 12500.00, '2026-04-13 16:00:03'),
(9, 'Kochi', 'London', 5, 20, 'Li', 'mathilika@student.tce.edu', '7878787878', 'Trial samples for the \"New Years\" Expo. ', 'accepted', 850.00, '2026-04-13 16:11:34'),
(10, 'Kochi', 'London', 15, 120, 'Rajesh Kumar', 'mathilika@student.tce.edu', '9001391839', 'Handcrafted Furniture', 'accepted', 18500.00, '2026-04-13 20:01:14'),
(11, 'Madurai', 'Dubai', 450, 2000, 'Sarah Jenkins', 'mathivijaya04@gmail.com', '9080316388', 'Electronics ', 'accepted', 65000.00, '2026-04-13 20:02:35'),
(12, 'Munnar', 'Chennai', 5, 120, 'Amit Sharma', 'rajashreeponnusamy2312@gmail.com', '7767676787', 'Organic Tea Samples ', 'quoted', 6700.00, '2026-04-13 20:04:51'),
(13, 'Kochi ', 'Singapore', 85, 200, 'Global Auto Parts', '24pma010@avinuty.ac.in', '9565656565', 'Engine Components ', 'quoted', 32000.00, '2026-04-13 20:06:29'),
(14, 'Chennai', 'New Delhi', 65, 130, 'Chandru S', 'mathivijaya04@gmail.com', '8090316352', 'Cosmatics Needs to Export .', 'accepted', 56700.00, '2026-04-15 15:11:37'),
(15, 'Canada', 'Switzerland', 76, 250, 'Chandler', 'mathigvm643@gmail.com', '7878909067', 'Glass Bottles Need to be transport. Give me the invoice', 'accepted', 78900.00, '2026-04-15 15:13:15'),
(16, 'New York', 'South korea', 67, 140, 'Kim SeokJin', 'mathilika@student.tce.edu', '6667617671', 'Invoice', 'accepted', 65000.00, '2026-04-15 15:13:58'),
(17, 'Los Angels', 'Paramakudi', 56, 130, 'Syam Sundar', 'mathigvm643@gmail.com', '8980316352', 'Oil Products needs to deliver within 1 week so give me the invoice .', 'accepted', 78000.00, '2026-04-27 16:06:49'),
(18, 'Germany', 'California', 23, 89, 'Sundar ', 'mathigvm643@gmail.com', '8978675645', 'Need to Deliver Wooden things using Truck so give me the invoice if it is okay , then we discuss further.', 'accepted', 67000.00, '2026-04-27 16:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipments`
--

CREATE TABLE `tbl_shipments` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) DEFAULT NULL,
  `tracking_id` varchar(50) DEFAULT NULL,
  `current_status` enum('Ordered','In Transit','Out for Delivery','Delivered') DEFAULT 'Ordered',
  `location` varchar(100) DEFAULT NULL,
  `expected_delivery` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_shipments`
--

INSERT INTO `tbl_shipments` (`id`, `quote_id`, `tracking_id`, `current_status`, `location`, `expected_delivery`, `updated_at`, `payment_status`) VALUES
(1, 7, 'SHD-69DD17154EE55', 'Delivered', 'Bangalore', '2026-04-20', '2026-04-15 14:47:20', 'Paid'),
(2, 8, 'SHD-69DD173A9AE9B', 'Delivered', 'Coimbatore', '2026-04-20', '2026-04-15 15:32:03', 'Paid'),
(3, 9, 'SHD-69DD179EE7852', 'Delivered', 'London', '2026-04-20', '2026-04-15 14:47:40', 'Paid'),
(4, 11, 'SHD-69DD4D37F19A3', 'Delivered', 'Bangalore', '2026-04-20', '2026-04-15 14:46:14', 'Paid'),
(5, 14, 'SHD-69DFAB7B14057', 'Delivered', 'New Delhi', '2026-04-22', '2026-04-15 15:31:01', 'Paid'),
(6, 10, 'SHD-69DFABB5DFD39', 'Out for Delivery', 'London Airport', '2026-04-22', '2026-04-15 16:22:20', 'Paid'),
(7, 15, 'SHD-69DFAC25163E4', 'In Transit', 'Toronto airport', '2026-04-22', '2026-04-15 16:49:13', 'Paid'),
(8, 16, 'SHD-69DFAC4DB345A', 'In Transit', 'JFK Airport', '2026-04-22', '2026-04-15 15:25:04', 'Paid'),
(9, 10, 'SHD-69DFAC6BBE6DF', 'Out for Delivery', 'London Hub', '2026-04-22', '2026-04-15 15:27:39', 'Paid'),
(10, 17, 'SHD-69EF8AA1532B8', 'Delivered', 'Paramakudi', '2026-05-04', '2026-04-28 14:24:22', 'Paid'),
(11, 18, 'SHD-69EF8AB81A2BD', 'Delivered', 'California', '2026-05-04', '2026-04-28 14:24:44', 'Paid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_contactform`
--
ALTER TABLE `tbl_contactform`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quoteform`
--
ALTER TABLE `tbl_quoteform`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_shipments`
--
ALTER TABLE `tbl_shipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_id` (`tracking_id`),
  ADD KEY `quote_id` (`quote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_contactform`
--
ALTER TABLE `tbl_contactform`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_quoteform`
--
ALTER TABLE `tbl_quoteform`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_shipments`
--
ALTER TABLE `tbl_shipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_shipments`
--
ALTER TABLE `tbl_shipments`
  ADD CONSTRAINT `tbl_shipments_ibfk_1` FOREIGN KEY (`quote_id`) REFERENCES `tbl_quoteform` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
