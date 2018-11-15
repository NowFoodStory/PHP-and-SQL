-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018 年 11 月 15 日 10:44
-- 伺服器版本: 10.1.36-MariaDB
-- PHP 版本： 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `foodstory`
--

-- --------------------------------------------------------

--
-- 資料表結構 `food_ shop_list`
--

CREATE TABLE `food_ shop_list` (
  `food_sid` int(11) NOT NULL COMMENT '食物流水號',
  `seller_sid` int(11) NOT NULL COMMENT '上傳者',
  `food_name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '食物名字',
  `food_class` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '食物種類',
  `food_quantity` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '數量',
  `food_price` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '原價',
  `food_discount` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '折扣後的價錢',
  `food_photo` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '食物照片路徑'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `food_ shop_list`
--

INSERT INTO `food_ shop_list` (`food_sid`, `seller_sid`, `food_name`, `food_class`, `food_quantity`, `food_price`, `food_discount`, `food_photo`) VALUES
(1, 1, '黑心饅頭', '麵包', '5', '100', '20', 'img/156165848484.pjg');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `order_sid` int(11) NOT NULL COMMENT '訂單流水號',
  `user_id` int(11) NOT NULL COMMENT '購買者',
  `food_id` int(11) NOT NULL COMMENT '食物編號',
  `quantity` int(11) NOT NULL COMMENT '數量',
  `price_discount` int(11) NOT NULL COMMENT '價錢',
  `orfer_time` int(11) NOT NULL COMMENT '訂單成立時間'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='訂單';

-- --------------------------------------------------------

--
-- 資料表結構 `seller_data`
--

CREATE TABLE `seller_data` (
  `seller_sid` int(11) NOT NULL COMMENT '對應到initial廠商流水號',
  `seller_leder` text CHARACTER SET utf8 NOT NULL COMMENT '負責人',
  `seller_opening` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '營業時間',
  `seller_fb` text CHARACTER SET utf8 NOT NULL COMMENT '臉書',
  `seller_ig` text CHARACTER SET utf8 NOT NULL COMMENT '社群IG',
  `seller_web` text CHARACTER SET utf8 NOT NULL COMMENT '官方網站',
  `seller_introduce` text CHARACTER SET utf8 NOT NULL COMMENT '店家介紹',
  `seller_cover_photo` text CHARACTER SET utf8 NOT NULL COMMENT '封面照片路徑',
  `logo_photo` int(11) NOT NULL COMMENT 'LOGO照片路徑',
  `seller_checkout` bit(1) NOT NULL COMMENT '結帳方式'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `seller_data`
--

INSERT INTO `seller_data` (`seller_sid`, `seller_leder`, `seller_opening`, `seller_fb`, `seller_ig`, `seller_web`, `seller_introduce`, `seller_cover_photo`, `logo_photo`, `seller_checkout`) VALUES
(0, '大大貓', '9am - 9pm', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://tw.yahoo.com/', '愛與恨淚水交織的饅頭,每一口的口感你都會感受的到師父的血與汗,如果你問我這段故事有沒有意義的話....我一定回答你說『沒有』,我在2001年的時候就學會打嘴砲寫廢文了,跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話\0\r\n', '', 0, b'0');

-- --------------------------------------------------------

--
-- 資料表結構 `seller_initial`
--

CREATE TABLE `seller_initial` (
  `seller_sid` int(11) NOT NULL COMMENT '店家流水號',
  `seller_name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '店家名字',
  `seller_phone` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '店家電話',
  `seller_EIN` varchar(8) CHARACTER SET utf8 NOT NULL COMMENT '統一編號',
  `seller_address` text CHARACTER SET utf8 NOT NULL COMMENT '店家住址',
  `seller_email` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '店家電子信箱',
  `seller_password` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '店家密碼',
  `seller_status` bit(1) NOT NULL COMMENT '權限0關1開'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `seller_initial`
--

INSERT INTO `seller_initial` (`seller_sid`, `seller_name`, `seller_phone`, `seller_EIN`, `seller_address`, `seller_email`, `seller_password`, `seller_status`) VALUES
(1, '哭哭饅頭店', '091234567', '12345678', '106台北市大安區辛亥路三段55號', 'wow@gmail.com', 'a1234567', b'1');

-- --------------------------------------------------------

--
-- 資料表結構 `user_credit_card`
--

CREATE TABLE `user_credit_card` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_card_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `credit_card_number` varchar(255) CHARACTER SET utf8 NOT NULL,
  `credit_card_expired` varchar(255) CHARACTER SET utf8 NOT NULL,
  `credit_card_cvv` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user_credit_card`
--

INSERT INTO `user_credit_card` (`id`, `user_id`, `credit_card_name`, `credit_card_number`, `credit_card_expired`, `credit_card_cvv`) VALUES
(1, 0, 'chunyaozhun', '123456789123', '18/12', '222');

-- --------------------------------------------------------

--
-- 資料表結構 `user_data`
--

CREATE TABLE `user_data` (
  `user_id` int(11) NOT NULL COMMENT '會員流水號',
  `user_name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '會員姓名',
  `user_phone` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '會員電話',
  `user_email` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '會員信箱',
  `user_password` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '會員密碼',
  `user_photo` text CHARACTER SET utf8 NOT NULL COMMENT '會員照片',
  `user_status` int(1) NOT NULL COMMENT '會員權限',
  `user_create_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user_data`
--

INSERT INTO `user_data` (`user_id`, `user_name`, `user_phone`, `user_email`, `user_password`, `user_photo`, `user_status`, `user_create_time`) VALUES
(0, '蔡耀諄', '0912345678', 'mopackp47557@gmail.com', 'a123456', '/img/user/photo.1', 1, '2018-11-15'),
(1, '蔡耀諄', '0258963145', 'mopackp@gmail.com', 'a123456', '/img/user/photo.1', 1, '2018-11-15');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `food_ shop_list`
--
ALTER TABLE `food_ shop_list`
  ADD PRIMARY KEY (`food_sid`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_sid`);

--
-- 資料表索引 `seller_initial`
--
ALTER TABLE `seller_initial`
  ADD PRIMARY KEY (`seller_sid`),
  ADD UNIQUE KEY `order_name` (`seller_name`),
  ADD UNIQUE KEY `order_phone` (`seller_phone`);

--
-- 資料表索引 `user_credit_card`
--
ALTER TABLE `user_credit_card`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_phone` (`user_phone`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
