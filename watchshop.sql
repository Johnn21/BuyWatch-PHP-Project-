-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: aug. 14, 2020 la 10:06 AM
-- Versiune server: 5.7.26
-- Versiune PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `watchshop`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminPassword`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `cardId` int(11) NOT NULL AUTO_INCREMENT,
  `cardName` varchar(255) NOT NULL,
  `cardPassword` varchar(255) NOT NULL,
  PRIMARY KEY (`cardId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `bank`
--

INSERT INTO `bank` (`cardId`, `cardName`, `cardPassword`) VALUES
(1, 'Lorem Ipsum', '12345678'),
(2, 'Visa Bank', 'visabank');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`) VALUES
(1, 'Casual'),
(2, 'Sport'),
(3, 'Military'),
(4, 'Digital');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `deliverymethod`
--

DROP TABLE IF EXISTS `deliverymethod`;
CREATE TABLE IF NOT EXISTS `deliverymethod` (
  `deliveryId` int(11) NOT NULL AUTO_INCREMENT,
  `deliveryMethod` varchar(255) NOT NULL,
  PRIMARY KEY (`deliveryId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `favoriteproduct`
--

DROP TABLE IF EXISTS `favoriteproduct`;
CREATE TABLE IF NOT EXISTS `favoriteproduct` (
  `idFavorite` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  PRIMARY KEY (`idFavorite`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `favoriteproduct`
--

INSERT INTO `favoriteproduct` (`idFavorite`, `idUser`, `idProduct`) VALUES
(46, 1, 3),
(44, 1, 30),
(48, 22, 30),
(47, 22, 29);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `customerAddress` varchar(255) NOT NULL,
  `customerPhone` int(11) NOT NULL,
  `customerNumberWatches` int(11) NOT NULL,
  `deliveryMethod` varchar(255) NOT NULL,
  `totalPayment` int(11) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderId`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `productId`, `customerName`, `customerAddress`, `customerPhone`, `customerNumberWatches`, `deliveryMethod`, `totalPayment`, `orderDate`) VALUES
(77, 1, 2, 'test', '12a', 213123, 1, 'To Your Home', 80, '2019-11-20 21:24:38'),
(101, 1, 2, 'abcd', 'asdasd', 21312, 1, 'To Your Home', 80, '2019-11-30 16:26:28'),
(81, 1, 4, 'asdas', 'asdasd', 123213, 2, 'To Your Home', 415, '2019-11-20 21:44:28'),
(118, 23, 2, 'User3', 'New York', 23232, 1, 'To Your Home', 80, '2019-12-02 10:56:10');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDescription` varchar(255) NOT NULL,
  `productSpecs` varchar(255) NOT NULL,
  `productPrice` int(255) NOT NULL,
  `productCount` int(11) NOT NULL,
  `productStock` varchar(255) NOT NULL,
  `productProvider` varchar(255) NOT NULL,
  `deliveryMethod` varchar(255) NOT NULL,
  `productDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `product`
--

INSERT INTO `product` (`productId`, `categoryId`, `productName`, `productDescription`, `productSpecs`, `productPrice`, `productCount`, `productStock`, `productProvider`, `deliveryMethod`, `productDate`) VALUES
(1, 1, 'Fossil', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 120, 3, 'In Stock', 'Alibaba', 'To Our Showroom', '2019-10-19 11:30:17'),
(2, 2, 'Casio', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. ', '\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.', 65, 8, 'In Stock', 'Emag', 'To Your Home', '2019-10-20 17:03:54'),
(3, 3, 'Q&Q', 'Ut enim ad minima veniam, quis nostrum exercitationem ullam.', 'Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in.', 82, 3, 'In Stock', 'Amazon', 'Both', '2019-10-20 17:07:08'),
(4, 4, 'Cureen', ' Velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ' Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. ', 200, 10, 'In Stock', 'Ebay', 'To Our Showroom', '2019-10-20 17:07:08'),
(29, 1, 'Fossils', 'asdasd', 'sadasdas', 320, 0, 'Not In Stock', 'TopWatch', 'To Your Home', '2019-11-28 17:55:56'),
(30, 1, 'AnotherOne', 'asd', 'asdsad', 231, 0, 'Not In Stock', 'Alibaba', 'To Your Home', '2019-11-28 20:21:06');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `bankId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userAddress` varchar(255) NOT NULL,
  `userCardName` varchar(255) NOT NULL,
  `userCardPassword` varchar(30) NOT NULL,
  `userMoney` int(11) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `user`
--

INSERT INTO `user` (`userId`, `bankId`, `userName`, `userPassword`, `userAddress`, `userCardName`, `userCardPassword`, `userMoney`) VALUES
(1, 1, 'user1', 'pass1', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.', 'Lorem Ipsum', '123456789', 2754),
(22, 2, 'user2', 'pass2', 'California, USA', 'Visa Bank', 'visabank', 300);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
