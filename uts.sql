SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `kelamin` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `user_info` (`user_id`, `nama_depan`, `nama_belakang`, `username`, `kelamin`, `tgl_lahir`, `password`) VALUES
(1, 'admin', 'admin', 'admin', '', '','$2y$10$efDvenHYJ5Fu/xxt1ANbXuRx5/TuzNs/s4k6keUiiFvr2ueE0GmrG');

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `category_id` int(30) NOT NULL,
  `category` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `img_path` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `product_list` (`id`, `category_id`, `category`, `name`, `description`, `price`, `img_path`) VALUES
(1, 1, 'Sushi', 'Salmon Nigiri', 'Fresh raw salmon on a soft cold rice', 15000, 'Images/nigiri.png'),
(2, 3, 'Noodles', 'Beef Ramen', 'Succulent slices of premium beef are immersed in a rich, steaming broth, accompanied by slurp-worthy noodles', 50000, 'Images/beef-ramen.png'),
(3, 2, 'Rice', 'Tonkotsu Rice', 'Creamy tonkotsu pork with slices of chashu pork', 60000, 'Images/tonkotsu.png'),
(4, 4, 'Drinks', 'Sake Cocktail', 'Japanese alcoholic beverage made from rice', 45000, 'Images/sake-cocktail.png');