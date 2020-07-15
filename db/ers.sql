-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2019 at 07:27 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ers`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `date_reg` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `first_name`, `last_name`, `role`, `date_reg`) VALUES
(1, 'admin', 'admin', 'Juan', 'Dela Cruz', 'admin', '2019-04-03 03:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cat`
--

CREATE TABLE `tbl_cat` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cat`
--

INSERT INTO `tbl_cat` (`cat_id`, `cat_name`) VALUES
(16, 'Vegetables'),
(17, 'Drinks'),
(20, 'Rice'),
(21, 'Pasta'),
(22, 'Dessert'),
(23, 'Pork'),
(24, 'Fish'),
(25, 'Chicken'),
(26, 'Beef');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`event_id`, `event_name`, `event_image`) VALUES
(113, 'Birthday', 'images.jpg'),
(114, 'Wedding', 'images (1).jpg'),
(115, 'Debut', 'images (2).jpg'),
(116, 'Prom', 'images (3).jpg'),
(117, 'Corporate', 'images (9).jpg'),
(119, 'And More!', 'images (4).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `gallery_id` int(11) NOT NULL,
  `gallery_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`gallery_id`, `gallery_image`) VALUES
(28, 'images (5).jpg'),
(29, 'images (6).jpg'),
(30, 'images (7).jpg'),
(31, 'images (8).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `menu_price` decimal(10,2) NOT NULL,
  `menu_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`menu_id`, `menu_name`, `cat_id`, `menu_price`, `menu_image`) VALUES
(137, 'Beef Brocolli', 26, '100.00', 'Beef Brocolli.jpg'),
(138, 'Beef Salpicao', 26, '80.00', 'Beef Salpicao.jpg'),
(139, 'Korean Beef Stew', 26, '70.00', 'Korean Beef Stew.jpg'),
(140, 'Braised Pork and Brocolli', 23, '75.00', 'Braised Pork and Brocolli.jpg'),
(141, 'Cheesy Pork Caldereta', 23, '75.00', 'Cheesy Pork Caldereta.jpg'),
(142, 'Nuts Crusted Pork', 26, '70.00', 'Nuts Crusted Pork.jpg'),
(143, 'Pork Barbeque', 23, '75.00', 'Pork Barbeque.jpg'),
(144, 'Pork Pandan Skewers', 23, '70.00', 'Pork Pandan Skewers.jpg'),
(145, 'Pork Sisig', 23, '100.00', 'Pork Sisig.jpg'),
(146, 'Pork Spring Roll', 23, '65.00', 'Pork Spring Roll.jpg'),
(147, 'Sweet and Sour Pork', 23, '80.00', 'Sweet and Sour pork.jpg'),
(148, 'Crispy Liempo Kare-Kare', 23, '75.00', 'Crispy Liempo Kare-kare.jpg'),
(149, 'Lechon Kawali', 23, '75.00', 'Lechon Kawali.jpg'),
(150, 'Lengua in Mushroom Sauce', 26, '65.00', 'Lengua in Mushroom sauce.jpg'),
(151, 'Lumpiang Shanghai', 26, '65.00', 'Lumpiang Shanghai.jpg'),
(152, 'Roast Pork with Maple Apple Sauce', 23, '80.00', 'Roast Pork with Maple Apple Sauce.jpg'),
(153, 'Sweet and Smokey Hickory Ribs', 26, '85.00', 'Sweet and Smokey Hickory Ribs.jpg'),
(154, 'Chicken Barbeque', 25, '80.00', 'Chicken Barbeque.jpg'),
(155, 'Chicken Cordon Bleu', 25, '75.00', 'Chicken Cordon Bleu.jpg'),
(156, 'Chicken Inasal', 25, '75.00', 'Chicken Inasal.jpg'),
(157, 'Chicken Sisig', 25, '80.00', 'Chicken Sisig.png'),
(158, 'Classic Fried Chicken', 25, '75.00', 'Classic Fried Chicken.jpg'),
(159, 'Filipino Style Chicken Barbeque', 25, '80.00', 'Filipino Style Chicken Barbeque.jpg'),
(160, 'Garlic Parmesan Chicken', 25, '80.00', 'Garlic Parmesan Chicken.jpg'),
(161, 'Orange Chicken', 25, '80.00', 'Orange Chicken.jpg'),
(162, 'Oven Baked Chicken with Lime and Cilantro', 25, '85.00', 'Oven Baked Chicken with Lime and Cilantro.jpg'),
(163, 'Soy Garlic Chicken', 25, '80.00', 'Soy Garlic Chicken.jpg'),
(164, 'Bangus Tinapa Spring Roll', 24, '65.00', 'Bangus Tinapa Spring Roll.jpg'),
(165, 'Crispy Fish fillet in Garlic Mayo Dip', 24, '80.00', 'Crispy Fish fillet in Garlic Mayo Dip.jpg'),
(166, 'Fish Fillet in Tausi Sauce', 24, '75.00', 'Fish Fillet in Tausi Sauce.jpg'),
(167, 'Sweet and Sour Fish Fillet', 24, '80.00', 'Sweet and Sour Fish Fillet.jpeg'),
(168, 'Banana Con Tapioca', 22, '60.00', 'Banana Con Tapioca.jpg'),
(169, 'Buko Pandan', 22, '60.00', 'Buko Pandan.jpg'),
(170, 'Cathedral Almond Jelly', 22, '65.00', 'Cathedral Almond Jelly.jpg'),
(171, 'Coffee Jelly', 22, '70.00', 'Coffee Jelly.jpg'),
(172, 'Corn and Tapioca in Cream', 22, '70.00', 'Corn and tapioca in cream.jpg'),
(173, 'Fruit and Jelly', 22, '65.00', 'fruit and jelly.jpg'),
(174, 'Mango Panna Cotta', 22, '75.00', 'Mango Panna Cotta.jpg'),
(175, 'Bacon and Parmesan Carbonara', 21, '75.00', 'Bacon and Parmesan Carbonara.jpg'),
(176, 'Baked Macaroni', 21, '65.00', 'Baked Macaroni.jpg'),
(177, 'Bolognese', 21, '65.00', 'Bolognese.jpeg'),
(178, 'Chapchae', 21, '70.00', 'Chapchae.jpg'),
(179, 'Padthai Chicken', 21, '75.00', 'Padthai chicken.jpg'),
(180, 'Pancit Bihon', 21, '65.00', 'Pancit Bihon.jpg'),
(181, 'Pancit Guisado', 21, '70.00', 'Pancit Guisado.jpg'),
(182, 'Spaghetti', 21, '70.00', 'Spaghetti.jpg'),
(183, 'Java Rice', 20, '70.00', 'Java Rice.jpg'),
(184, 'Pandan Rice', 20, '65.00', 'Pandan Rice.jpg'),
(185, 'Steamed Rice', 20, '60.00', 'Steamed Rice.jpg'),
(187, 'Buttered Vegetables', 16, '65.00', 'Buttered Vegetables.jpg'),
(188, 'Fresh Lumpia', 16, '65.00', 'Fresh Lumpia.jpg'),
(189, 'Mashed Potatoes', 16, '65.00', 'Mashed potatoes.jpg'),
(190, 'SautÃ©ed Tofu and Veggies in Peanut Sauce', 16, '70.00', 'SautÃ©ed Tofu and veggies in peanut sauce.jpg'),
(191, 'Special Chopseuy', 16, '75.00', 'Special Chopseuy.jpg'),
(192, 'Stir Fry Vegetables', 16, '65.00', 'Stir fry vegetables.jpg'),
(193, 'Vegetables in Cream Sauce', 16, '65.00', 'Vegetables in cream sauce.jpg'),
(204, 'Apple and Nuts Coleslaw', 26, '75.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `msg_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`msg_id`, `name`, `subject`, `message`) VALUES
(35, 'Christopher Lee', 'Cupidatat saepe even', 'Accusantium beatae a'),
(36, 'Leslie Shepard', 'Magna officiis ex to', 'Voluptatem elit et '),
(37, 'Heidi Clarke', 'Laboris voluptate re', 'Cupiditate delectus'),
(38, 'Reece Reynolds', 'Illum non autem dol', 'Saepe assumenda quae'),
(40, 'Francesca Cole', 'Et nisi et in delect', 'Dolor iusto velit r'),
(41, 'Francesca Cole', 'Et nisi et in delect', 'Dolor iusto velit r'),
(42, 'Burke Pacheco', 'Qui dolorem doloribu', 'A ex rerum magni et '),
(43, 'Burke Pacheco', 'Qui dolorem doloribu', 'A ex rerum magni et '),
(44, 'Burke Pacheco', 'Qui dolorem doloribu', 'A ex rerum magni et '),
(45, 'Colton Morrow', 'Aliquid elit pariat', 'Accusamus sapiente a'),
(46, 'asd', 'asd', 'asd'),
(47, 'Sample', 'Sample', 'Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample.'),
(48, 'Sample', 'Sample', 'Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample.'),
(49, 'Sample', 'Sample', 'Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample.'),
(50, 'Sample', 'Sample', 'Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample.'),
(51, 'Sample', 'Sample', 'Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `package_include` varchar(255) NOT NULL,
  `package_price` decimal(10,2) NOT NULL,
  `package_desc` varchar(300) NOT NULL,
  `package_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`package_id`, `package_name`, `package_include`, `package_price`, `package_desc`, `package_image`) VALUES
(13, 'PARTY PACKAGE 1', '1 Pasta, 1 Fish, 1 Chicken, 1 Pork, 1 Dessert amd Red Tea.', '250.00', 'Elegant buffet set-up, Full table set-up for every guest, Round table 10 with floor length white cover and motif top, Chairs with white floor length and ribbon motif, All Silverwares, Dinner plates and goblet, Waiters in uniform.', 'images (7).jpg'),
(14, 'PARTY PACKAGE 2', '1 Pasta, 1 Fish, 1 Chicken, 1 Pork, 1 Dessert,  Pandan Rice, Red Tea and Oriental Soup.', '350.00', 'Elegant buffet set-up, Full table set-up for every guest, Round table 10 with floor length white cover and motif top, Chairs with white floor length and ribbon motif, All Silverwares, Dinner plates and goblet, Waiters in uniform.', ''),
(16, 'PARTY PACKAGE 3', '1 Pasta, 1 Fish, 1 Chicken, 1 Pork, 1 Dessert, Vegetables Salad, Potato Salad, Macaroni Salad, Fresh Fruits, Chocolate Fondue, Stick-O, Gummy Candy, Marshmallow, Mixed Candies, Egg Drop .Soup, Mango Gulaman, Pandan Rice and Red Tea.', '400.00', 'Elegant buffet set-up, Full table set-up for every guest, Round table 10 with floor length white cover and motif top, Chairs with white floor length and ribbon motif, All Silverwares, Dinner plates and goblet, Waiters in uniform.', ''),
(17, 'dsaldsaj', 'iojiodjasij', '123.00', 'dsaijdaso', ''),
(18, 'asdoj', 'oijojasdoij', '123123.00', 'iojoij', 'images (7).jpg'),
(19, 'sadioijioj', 'oijoijasdoij', '897987.00', '9oaidjjioj', 'images (7).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `ref` int(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `name`, `phone`, `bank`, `ref`, `amount`, `image`, `status`, `payment_date`) VALUES
(30, 'Libby Peterson', '+1 (167) 453', 'Neque possimus inci', 10, '69.00', 'images.jpg', 'Received', '2019-10-24 18:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reserve`
--

CREATE TABLE `tbl_reserve` (
  `rid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `venue` varchar(50) NOT NULL,
  `invite` varchar(11) NOT NULL,
  `rdate` date NOT NULL,
  `rstart` time NOT NULL,
  `rend` time NOT NULL,
  `custom` varchar(1000) NOT NULL,
  `package` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `payable` decimal(10,2) NOT NULL,
  `pstatus` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `datecompleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reserve`
--

INSERT INTO `tbl_reserve` (`rid`, `email`, `code`, `fullname`, `phone`, `address`, `event_name`, `event_type`, `venue`, `invite`, `rdate`, `rstart`, `rend`, `custom`, `package`, `price`, `balance`, `payable`, `pstatus`, `status`, `datecreated`, `datecompleted`) VALUES
(88, 'sample@gmail.com', 'CAm3vvM', 'sample sample', '639100952475', '123 sample', 'Warren Foley', 'Totam dolore volupta', 'Accusantium est dolo', '123', '2004-05-24', '01:00:00', '01:00:00', '', 'PARTY PACKAGE 1', '250.00', '30750.00', '30750.00', 'Unpaid', 'Pending', '2019-10-28 09:09:23', NULL),
(90, 'sample@gmail.com', 'FgNKLBR', 'sample sample', '639100952475', '123 sample', '25th B-Day', 'Birthday', 'Side 4', '', '2019-11-05', '01:30:00', '06:00:00', '', '', '0.00', '0.00', '0.00', '', '', '2019-10-29 05:31:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset`
--

CREATE TABLE `tbl_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `vkey` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `firstname`, `lastname`, `phone`, `address`, `email`, `password`, `vkey`, `verified`) VALUES
(131, 'sample', 'sample', '639100952475', '123 sample', 'sample@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', '1c4bea9f5ae50e0834bab660d00eaf31', 1),
(132, 'asd', 'asd', 'asd', 'asd', '', 'efe6398127928f1b2e9ef3207fb82663', '3f112d24721bbdbe18315ac36f82125d', 0),
(133, 'asd', 'asd', 'asd', 'asd', 'gago@gmail.com', '6364d27ecb33ebccbd8ccc41dd5b91ee', 'fb2eba2cb6c62113d3f1ae0b4e6c1802', 0),
(134, 'qwe', 'qwe', 'qwe', 'qwe', 'qwe@gmail.com', 'efe6398127928f1b2e9ef3207fb82663', '4fe622a61a2b598dc494f9f0bc56f5aa', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cat`
--
ALTER TABLE `tbl_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_reserve`
--
ALTER TABLE `tbl_reserve`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `tbl_reset`
--
ALTER TABLE `tbl_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cat`
--
ALTER TABLE `tbl_cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_reserve`
--
ALTER TABLE `tbl_reserve`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tbl_reset`
--
ALTER TABLE `tbl_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
