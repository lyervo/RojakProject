-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `udp`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredient_id` int(11) NOT NULL,
  `ingredient_name` varchar(40) NOT NULL,
  `vegan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `ingredient`
--

INSERT INTO `ingredient` (`ingredient_id`, `ingredient_name`, `vegan`) VALUES
(1, 'Bacon', 0),
(2, 'Egg', 0),
(3, 'onion', 0),
(4, 'flour', 0),
(5, 'butter', 0),
(6, 'Rice', 0),
(7, 'wesd', 0),
(8, 'wsedfg', 0),
(9, 'dascv', 0),
(10, 'chicken', 0),
(11, '2dcdq', 0),
(12, 'ergf onion', 0),
(13, 'eqdwefv galic', 0),
(14, 'fvgbbvd ginger', 0),
(15, 'wefrgdtfhyj', 0),
(16, '1qwdsef', 0),
(17, 'ASDFCGB', 0),
(18, 'efrgdf onions', 0),
(19, 'pork loin', 0),
(20, 'lettuce', 0),
(21, 'honey', 0),
(22, 'soy sauce', 0),
(23, 'yugjhhj', 0),
(24, 'big carrot with carrot', 0),
(25, '13d', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `likes`
--

CREATE TABLE `likes` (
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `recipe`
--

CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL,
  `recipe_name` varchar(40) NOT NULL,
  `description` varchar(200) NOT NULL,
  `serving` int(2) NOT NULL,
  `difficulty` varchar(20) NOT NULL,
  `cooking_time` int(11) NOT NULL,
  `rating` float NOT NULL,
  `author` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image_blob` longblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `recipe_ingredient`
--

CREATE TABLE `recipe_ingredient` (
  `ingredient_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `modifier` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `recipe_tag`
--

CREATE TABLE `recipe_tag` (
  `recipe_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `recipe_tag`
--

INSERT INTO `recipe_tag` (`recipe_id`, `tag_id`) VALUES
(5, 13),
(5, 14),
(8, 16),
(8, 16),
(9, 17),
(9, 18),
(9, 19),
(9, 20),
(13, 34),
(15, 34),
(16, 34),
(16, 34),
(16, 34),
(19, 34),
(22, 34),
(23, 23),
(23, 22),
(24, 18),
(24, 21),
(24, 35),
(24, 18),
(24, 21),
(24, 18),
(24, 21),
(4, 18),
(4, 3),
(4, 1),
(4, 2),
(39, 27),
(40, 27),
(39, 28),
(40, 28),
(18, 28),
(22, 28),
(21, 28),
(23, 28),
(24, 28),
(25, 28),
(19, 28),
(20, 28),
(26, 28),
(27, 28),
(28, 28),
(29, 28),
(29, 39),
(29, 40),
(29, 18),
(29, 22),
(29, 21),
(29, 23),
(29, 24),
(29, 25),
(29, 19),
(29, 20),
(29, 26),
(29, 27),
(29, 28),
(29, 29);

-- --------------------------------------------------------

--
-- 資料表結構 `review`
--

CREATE TABLE `review` (
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `step`
--

CREATE TABLE `step` (
  `recipe_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `step_image` longblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES
(1, 'halal'),
(2, 'kosher'),
(3, 'vegan'),
(13, 'migi'),
(14, 'sss'),
(15, 'wds'),
(17, 'wasdxcd'),
(18, 'no_wheat'),
(19, 'no_milk'),
(20, 'no_nuts'),
(21, 'no_crustacean'),
(22, 'no_egg'),
(23, 'no_fish'),
(24, 'no_peanut'),
(25, 'no_soy'),
(26, 'no_celery'),
(27, 'no_mustard'),
(28, 'no_sesame'),
(29, 'no_shellfish'),
(30, 'efdrgbhn'),
(31, 'chicken'),
(32, 'chicken_tag'),
(33, 'erfg'),
(34, ''),
(35, 'onion tag'),
(36, 'onion tag number 2'),
(37, 'carrot'),
(38, 'new carrot'),
(39, '2we'),
(40, '2wedffghjk');

-- --------------------------------------------------------

--
-- 資料表結構 `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ticket_type` varchar(40) NOT NULL,
  `link` varchar(255) NOT NULL,
  `review_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `date_submitted`, `ticket_type`, `link`, `review_id`, `recipe_id`, `user_id`) VALUES
(4, '2019-11-04 12:39:50', 'missing allergen', '?id=23', 0, 23, 0),
(5, '2019-11-06 10:43:58', 'profanity', '?id=23#review_7', 7, 23, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `admin` int(1) NOT NULL,
  `strike` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `gender`, `admin`, `strike`) VALUES
(2, 'Timothy', 'timothynguoi@hotmail.com', '$2y$12$L9OrRo34pBJowWibbj82kOaCVAl1DM/3r', 'M', 0, 0),
(3, 'lyervo', 'helloWorld@gmail.com', '$2y$12$ceIATkkQxQty0cbOEqf/D.g0EFumFef4B9vYbPMp0EE4TvYhg6qMS', 'M', 1, 2),
(5, 'Dolly', 'dolly@hk.com', '$2y$12$/rfXT1fVmnUbKGwEVoYDdeJ1bw/Rg9.5TZwaBZTXP16iz56X6GwjS', 'F', 0, 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredient_id`);

--
-- 資料表索引 `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipe_id`);

--
-- 資料表索引 `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- 資料表索引 `step`
--
ALTER TABLE `step`
  ADD PRIMARY KEY (`step_id`);

--
-- 資料表索引 `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- 資料表索引 `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `step`
--
ALTER TABLE `step`
  MODIFY `step_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;