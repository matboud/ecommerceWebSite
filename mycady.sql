-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2019 at 02:10 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycady`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `cart_shadow`
--

CREATE TABLE `cart_shadow` (
  `id_shadow` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cart_shadow`
--

INSERT INTO `cart_shadow` (`id_shadow`, `id_user`, `id_product`, `quantity`) VALUES
(18, 1, 8, 1),
(19, 1, 8, 1),
(20, 1, 9, 1),
(21, 1, 4, 7),
(22, 1, 4, 1),
(23, 1, 7, 1),
(24, 1, 8, 1),
(25, 1, 2, 1),
(26, 1, 2, 2),
(27, 1, 8, 1),
(28, 1, 8, 1),
(29, 1, 8, 1),
(30, 1, 8, 1),
(31, 1, 7, 1),
(32, 1, 1, 1),
(33, 1, 1, 1),
(34, 1, 8, 1),
(35, 1, 8, 1),
(36, 1, 3, 1),
(37, 1, 7, 1),
(38, 19, 11, 2),
(39, 19, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `name_categorie` varchar(25) COLLATE utf8_bin NOT NULL,
  `description_categorie` varchar(300) COLLATE utf8_bin NOT NULL,
  `img` varchar(25) COLLATE utf8_bin NOT NULL,
  `id_supermarket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `name_categorie`, `description_categorie`, `img`, `id_supermarket`) VALUES
(8, 'Computers & laptops', 'testo lorem ipsum dolor test categorie testo lorem ipsum dolor test categorie testo lorem ipsum dolor test categorie testo lorem ipsum dolor test categorie testo lorem ipsum dolor test categorie ', '', 1),
(9, 'Tv & Audio', 'test ljhdf kzehfz zjef ef;jef zlndz im qepvje, efvjenv vefjvef lkjvns evl:kskd;  mseds dc!sdkc ', '009-two.png', 1),
(10, 'Camera & photos', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, ipsum cum porro, tempora debitis cupiditate suscipit similique id illo repellendus quidem dicta labore deleniti ipsam optio, ut voluptatum libero ullam.', '008-three.png', 1),
(11, 'Hardware', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, ipsum cum porro, tempora debitis cupiditate suscipit similique id illo repellendus quidem dicta labore deleniti ipsam optio, ut voluptatum libero ullam.', '009-two.png', 1),
(12, 'Smartphones', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, ipsum cum porro, tempora debitis cupiditate suscipit similique id illo repellendus quidem dicta labore deleniti ipsam optio, ut voluptatum libero ullam.', '004-seven.png', 1),
(13, 'Dress', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, ipsum cum porro, tempora debitis cupiditate suscipit similique id illo repellendus quidem dicta labore deleniti ipsam optio, ut voluptatum libero ullam.', '001-ten.png', 1),
(14, 'Food', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, ipsum cum porro, tempora debitis cupiditate suscipit similique id illo repellendus quidem dicta labore deleniti ipsam optio, ut voluptatum libero ullam.', '001-ten.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id_city` int(11) NOT NULL,
  `name_city` varchar(25) COLLATE utf8_bin NOT NULL,
  `id_country` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id_city`, `name_city`, `id_country`) VALUES
(1, 'Rabat', 1),
(2, 'Kenitra', 1),
(3, 'Casablanca', 1),
(4, 'Tanger', 1),
(5, 'Fes', 1),
(6, 'Lyon', 2),
(7, 'Paris', 2),
(8, 'Marseille', 2),
(9, 'Cannes', 2),
(10, 'Rouen', 2),
(11, 'New york', 3),
(12, 'Los angeles', 3),
(13, 'Chicago', 3),
(14, 'Boston', 3),
(15, 'Washington', 3),
(16, 'Milan', 4),
(17, 'Florence', 4),
(18, 'Turin', 4),
(19, 'Pise', 4),
(20, 'Bari', 4);

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE `command` (
  `id_command` int(11) NOT NULL,
  `date` varchar(10) COLLATE utf8_bin NOT NULL,
  `statut` varchar(10) COLLATE utf8_bin NOT NULL,
  `id_shadow` int(11) NOT NULL,
  `done` int(11) NOT NULL,
  `monthly` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `command`
--

INSERT INTO `command` (`id_command`, `date`, `statut`, `id_shadow`, `done`, `monthly`) VALUES
(82, '03-06-2018', 'completed', 18, 1, 0),
(83, '03-06-2018', 'completed', 19, 1, 0),
(84, '03-06-2018', 'pending', 20, 1, 0),
(85, '03-06-2018', 'pending', 21, 1, 0),
(86, '03-06-2018', 'pending', 22, 1, 1),
(87, '03-06-2018', 'pending', 23, 1, 1),
(88, '03-06-2018', 'pending', 24, 1, 1),
(89, '03-06-2018', 'completed', 25, 1, 0),
(90, '03-06-2018', 'pending', 26, 1, 0),
(91, '03-06-2018', 'pending', 27, 1, 0),
(92, '03-06-2018', 'pending', 28, 1, 0),
(93, '03-06-2018', 'pending', 29, 1, 0),
(94, '04-06-2018', 'pending', 30, 1, 0),
(95, '04-06-2018', 'pending', 31, 1, 0),
(96, '04-06-2018', 'pending', 32, 1, 0),
(97, '04-06-2018', 'pending', 33, 1, 0),
(98, '04-06-2018', 'pending', 34, 1, 0),
(99, '04-06-2018', 'pending', 35, 1, 0),
(100, '04-06-2018', 'pending', 36, 1, 0),
(101, '04-06-2018', 'pending', 37, 1, 0),
(102, '31-03-2019', 'pending', 38, 0, 0),
(103, '31-03-2019', 'pending', 39, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `comment` varchar(300) COLLATE utf8_bin NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id_comment`, `comment`, `id_product`, `id_user`) VALUES
(1, 'this is reaaally aawsome ', 8, 1),
(2, 'this is reaaally aawsome 2 don\'t u think so man ', 8, 1),
(4, 'i think its cheep', 8, 2),
(5, '..babla lorem ipsum', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id_country` int(11) NOT NULL,
  `name_country` varchar(25) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id_country`, `name_country`) VALUES
(1, 'Morocco'),
(2, 'Frensh'),
(3, 'America'),
(4, 'Italia');

-- --------------------------------------------------------

--
-- Table structure for table `deal`
--

CREATE TABLE `deal` (
  `id_deal` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `end_hours` int(11) NOT NULL,
  `end_min` int(11) NOT NULL,
  `end_sec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `deal`
--

INSERT INTO `deal` (`id_deal`, `id_product`, `end_hours`, `end_min`, `end_sec`) VALUES
(1, 2, 99, 99, 99),
(2, 8, 99, 99, 99);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `nom_product` varchar(25) COLLATE utf8_bin NOT NULL,
  `description` varchar(300) COLLATE utf8_bin NOT NULL,
  `prix_fix` int(25) NOT NULL,
  `prix_promo` int(25) NOT NULL,
  `image1` varchar(25) COLLATE utf8_bin NOT NULL,
  `image2` varchar(25) COLLATE utf8_bin NOT NULL,
  `image3` varchar(25) COLLATE utf8_bin NOT NULL,
  `image` varchar(25) COLLATE utf8_bin NOT NULL,
  `date_ex` varchar(10) COLLATE utf8_bin NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `product_left` int(11) NOT NULL,
  `product_sell` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `nom_product`, `description`, `prix_fix`, `prix_promo`, `image1`, `image2`, `image3`, `image`, `date_ex`, `id_categorie`, `product_left`, `product_sell`) VALUES
(1, 'oppo', 'lorem ipsum dolor testooo coool yeah', 250, 125, '', '', '', 'featured_4.png', '2018-05-24', 12, -1, 1),
(2, 'nia', 'sdfvsfdvsefvsf srfvsf  sefvsd ', 400, 350, '003-eight.png', '004-seven.png', '005-six.png', 'featured_3.png', '2018-05-26', 9, 115, 77),
(3, 'tstoo2', 'lorem ljdf lzdf efzlhzefzjhd zldnf ', 157, 120, '003-eight.png', '004-seven.png', '006-five.png', 'adv_2.png', '2018-05-31', 12, -1, 1),
(4, 'mixeur', 'sefvsef szrfvzsefv sf sefvsv sfvb fvbrgb ', 800, 0, '008-three.png', '003-eight.png', 'featured_5.png', 'featured_5.png', '2018-05-26', 13, 24, 14),
(6, 'phone', 'testoo test description', 130, 100, '004-seven.png', '006-five.png', '008-three.png', 'featured_3.png', '2018-05-24', 12, 19, 28),
(7, 'lg', 'stressless limitless lorem ipsum dolor description stressless limitless lorem ipsum dolor description stressless limitless lorem ipsum dolor description stressless limitless lorem ipsum dolor description stressless limitless lorem ipsum dolor description stressless limitless lorem ipsum dolor descri', 56, 0, 'new_6.jpg', 'featured_4.png', 'featured_6.png', 'new_single.png', '2018-05-31', 12, -1, 1),
(8, 'mac', 'Lorem ipsum dolor sit amet consectetur adipisicing...Lorem ipsum dolor sit amet consectetur adipisicing...Lorem ipsum dolor sit amet consectetur adipisicing...Lorem ipsum dolor sit amet consectetur adipisicing...Lorem ipsum dolor sit amet consectetur adipisicing...', 850, 700, 'single_1.jpg', 'single_2.jpg', 'single_3.jpg', 'banner_2_product.png', '2018-08-31', 8, -1, 1),
(9, 'acer aspire v2300', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, ipsum cum porro, tempora debitis cupiditate suscipit similique id illo repellendus quidem dicta labore deleniti ipsam optio, ut voluptatum libero ullam.', 165, 140, 'single_2.jpg', 'single_3.jpg', 'shopping_cart.jpg', 'featured_7.png', '', 8, 100, 0),
(10, 'camera', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, ipsum cum porro, tempora debitis cupiditate suscipit similique id illo repellendus quidem dicta labore deleniti ipsam optio, ut voluptatum libero ullam.', 200, 0, 'new_10.jpg', 'new_8.jpg', 'shop_1.jpg', 'featured_5.png', '', 10, 20, 0),
(11, 'chemise', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, ipsum cum porro, tempora debitis cupiditate suscipit similique id illo repellendus quidem dicta labore deleniti ipsam optio, ut voluptatum libero ullam.', 30, 25, 'product_7.png', 'product_9.png', 'product_3.png', 'product_3.png', '', 13, 70, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reject`
--

CREATE TABLE `reject` (
  `id_reject` int(11) NOT NULL,
  `cause` varchar(300) COLLATE utf8_bin NOT NULL,
  `id_command` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id_subscriber` int(11) NOT NULL,
  `mail_subscriber` varchar(70) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id_subscriber`, `mail_subscriber`) VALUES
(1, 'testoss@gmail.com'),
(2, 'brahimi@gmail.com'),
(3, 'root@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `supermarket`
--

CREATE TABLE `supermarket` (
  `id_supermarket` int(11) NOT NULL,
  `name_supermarket` varchar(25) COLLATE utf8_bin NOT NULL,
  `adresse` varchar(110) COLLATE utf8_bin NOT NULL,
  `tele` varchar(15) COLLATE utf8_bin NOT NULL,
  `id_city` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `supermarket`
--

INSERT INTO `supermarket` (`id_supermarket`, `name_supermarket`, `adresse`, `tele`, `id_city`) VALUES
(1, 'Marjan', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis illo placeat odio impedit, ', '+21260025020', 1),
(2, 'Aswak salam', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis illo placeat odio impedit, ', '+212603022222', 1),
(3, 'Coolshop', 'lorem testoo test adresse ipsum dolorlorem testoo test adresse ipsum dolor', '+21687856565432', 2),
(4, 'shopy', 'lorem testoo test adresse ipsum dolorlorem testoo test adresse ipsum dolor', '+12548788999', 3),
(5, 'shoptoo', 'lorem testoo test adresse ipsum dolorlorem testoo test adresse ipsum dolor', '+2154885651', 7),
(6, 'shopifooy', 'testoo test test testoo test test testoo test test testoo test test', '0666666666666', 7),
(7, 'monia', 'testoo test test testoo test test testoo test test testoo test test', '0666666666666', 2),
(8, 'mikowagent', 'testoo test test testoo test test testoo test test testoo test test', '0666666666666', 5),
(9, 'loolypop', 'testoo test test testoo test test testoo test test testoo test test', '0666666666666', 3),
(10, 'sympho', 'testoo test test testoo test test testoo test test testoo test test', '0666666666666', 4),
(11, 'boo', 'testoo test test testoo test test testoo test test testoo test test', '0666666666666', 2),
(12, 'shopifooy', 'testoo test test testoo test test testoo test test testoo test test', '0666666666666', 1),
(20, '', '', '', 0),
(21, '', '', '', 0),
(22, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `role_u` int(1) NOT NULL,
  `name_u` varchar(25) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(25) COLLATE utf8_bin NOT NULL,
  `mail` varchar(35) COLLATE utf8_bin NOT NULL,
  `password_u` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `image_u` varchar(25) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `role_u`, `name_u`, `last_name`, `mail`, `password_u`, `phone`, `image_u`) VALUES
(1, 0, 'amine', 'testo', 'testo@gmail.com', 'testo123', '060000000000', 'one.png'),
(2, 0, 'anas', 'saidi', 'anas@gmail.com', 'cGFzc3dvcmQ', '+212 6487899', '001-ten.png'),
(3, 0, 'john', 'doe', 'john@yahoo.com', 'cGFzc3dvcmQ', '+1 668 745 999', '004-seven.png'),
(4, 0, 'rabii', 'salhi', 'rabii@gmail.com', 'cGFzc3dvcmQ', '12345678955', 'Untitled-1.png'),
(5, 0, 'hassan', 'hafidi', 'iyoow@gmail.com', 'cGFzc3dvcmQ', '12345678955', 'zQw4D9Tw.jpg'),
(6, 0, 'hassan', 'hafidi', 'iyoow@gmail.com', 'cGFzc3dvcmQ', '12345678955', 'zQw4D9Tw.jpg'),
(7, 0, 'hassan', 'hafidi', 'iyoow@gmail.com', 'cGFzc3dvcmQ', '12345678955', 'HTML5_Logo_512.png'),
(8, 0, 'imane', 'anis', 'imo38@gmail.com', 'cGFzc3dvcmQ', '12345678955', 'e245c690-59fc-4bd8-992f-8'),
(9, 0, 'test', 'testow', 'testow@gmail.com', 'cGFzc3dvcmQ', '123456789', 'me.png'),
(11, 1, 'admin', 'admin', 'admin@gmail.com', 'cGFzc3dvcmQ', '02254880000', 'estante-020.jpg'),
(12, 0, 'rami', 'anwar', 'rami@gmail.com', 'cGFzc3dvcmQ', '12345677', '17554191_745779275582166_'),
(13, 0, 'testad', 'testad', 'testad@gmail.com', 'cGFzc3dvcmQ', '06662211445', 'heart.png'),
(14, 0, 'zef', 'qrfqef', 'nona@gmail.com', 'cGFzc3dvcmQ', '456789451', 'brands_5.jpg'),
(15, 0, 'test2', 'sefgsefg', 'test2@gmail.com', 'cGFzc3dvcmQ', '063322114455', 'char_1.png'),
(16, 0, 'cool', 'ahmado', 'coool@gmail.com', 'cGFzc3dvcmQ', '123456444', 'cart.png'),
(17, 0, 'testow', 'test', 'testow@gmail.com', 'dGVzdG93MDE4', '123456789', 'contact_3.png'),
(18, 0, 'ooussama', 'test', 'kenitra@gmail.com', 'b3Vzc2FtYSBrZW5pdHJh', '0633554477', 'contact_2.png'),
(19, 0, 'roro', 'roro', 'roro12@gmail.com', 'cm9yb3ppa28', '12345678', 'contact_3.png');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `color` varchar(25) COLLATE utf8_bin NOT NULL,
  `code_color` varchar(10) COLLATE utf8_bin NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id_wishlist`, `id_user`, `id_product`, `color`, `code_color`, `quantity`) VALUES
(1, 1, 1, 'Silver', '#999999', 3),
(2, 1, 2, 'Blue', '#18b0e0', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `cart_shadow`
--
ALTER TABLE `cart_shadow`
  ADD PRIMARY KEY (`id_shadow`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id_city`);

--
-- Indexes for table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`id_command`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id_country`);

--
-- Indexes for table `deal`
--
ALTER TABLE `deal`
  ADD PRIMARY KEY (`id_deal`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `reject`
--
ALTER TABLE `reject`
  ADD PRIMARY KEY (`id_reject`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id_subscriber`);

--
-- Indexes for table `supermarket`
--
ALTER TABLE `supermarket`
  ADD PRIMARY KEY (`id_supermarket`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_shadow`
--
ALTER TABLE `cart_shadow`
  MODIFY `id_shadow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `command`
--
ALTER TABLE `command`
  MODIFY `id_command` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deal`
--
ALTER TABLE `deal`
  MODIFY `id_deal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reject`
--
ALTER TABLE `reject`
  MODIFY `id_reject` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id_subscriber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supermarket`
--
ALTER TABLE `supermarket`
  MODIFY `id_supermarket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
