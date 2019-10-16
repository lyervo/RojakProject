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
(2, 'Egg', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `likes`
--

CREATE TABLE `likes` (
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `likes`
--

INSERT INTO `likes` (`user_id`, `recipe_id`) VALUES
(1, 1),
(3, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `recipe`
--

CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL,
  `recipe_name` varchar(40) NOT NULL,
  `description` varchar(200) NOT NULL,
  `serving` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `recipe`
--

INSERT INTO `recipe` (`recipe_id`, `recipe_name`, `description`, `serving`) VALUES
(1, 'Bacon & Egg', 'A simple breakfast that is both delicious and economical.', 1);

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

--
-- 傾印資料表的資料 `recipe_ingredient`
--

INSERT INTO `recipe_ingredient` (`ingredient_id`, `recipe_id`, `amount`, `unit`, `modifier`) VALUES
(1, 1, 1, '', ''),
(2, 1, 2, 's', '');

-- --------------------------------------------------------

--
-- 資料表結構 `recipe_tag`
--

CREATE TABLE `recipe_tag` (
  `recipe_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- 傾印資料表的資料 `review`
--

INSERT INTO `review` (`user_id`, `recipe_id`, `review_id`, `comment`, `review_date`) VALUES
(1, 1, 1, 'This bacon & egg recipe is so simple! I like bacon too!!!', '2019-10-16 20:34:40'),
(3, 1, 2, 'hello thomas', '2019-10-16 21:04:51'),
(3, 1, 3, 'hello world', '2019-10-16 21:05:00'),
(3, 1, 4, 'hello thomas', '2019-10-16 21:05:10');

-- --------------------------------------------------------

--
-- 資料表結構 `step`
--

CREATE TABLE `step` (
  `recipe_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `step`
--

INSERT INTO `step` (`recipe_id`, `step_id`, `description`) VALUES
(1, 1, 'First, put your oil into the pan, make sure it is smoking hot, add your bacon into the pan and remove when it is crispy done.'),
(1, 2, 'Crack both eggs open, and cook them with the grease of the bacon to give them extra flavor.'),
(1, 3, 'Put both the eggs and bacon onto the plate and serve it with a hearty morning coffee!');

-- --------------------------------------------------------

--
-- 資料表結構 `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `gender`) VALUES
(1, 'Thomas McKeown', 'thomasMcKeown@gmail.com', 'guest', 1),
(2, 'Timothy', 'timothynguoi@hotmail.com', '$2y$12$L9OrRo34pBJowWibbj82kOaCVAl1DM/3r', 0),
(3, 'lyervo', 'helloWorld@gmail.com', '$2y$12$ceIATkkQxQty0cbOEqf/D.g0EFumFef4B9vYbPMp0EE4TvYhg6qMS', 0);

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
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `step`
--
ALTER TABLE `step`
  MODIFY `step_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
