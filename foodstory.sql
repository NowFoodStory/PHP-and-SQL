-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018 年 12 月 10 日 13:57
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
-- 資料表結構 `blog`
--

CREATE TABLE `blog` (
  `blog_sid` int(255) NOT NULL COMMENT '文章流水號',
  `blog_title` text CHARACTER SET utf8 NOT NULL COMMENT '文章標題',
  `blog_author` text CHARACTER SET utf8 NOT NULL COMMENT '作者',
  `blog_photo` text CHARACTER SET utf8 NOT NULL COMMENT '照片',
  `blog_content` text CHARACTER SET utf8 NOT NULL COMMENT '文章內容',
  `blog_date` date NOT NULL COMMENT 'po文日期'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `blog`
--

INSERT INTO `blog` (`blog_sid`, `blog_title`, `blog_author`, `blog_photo`, `blog_content`, `blog_date`) VALUES
(1, '1', '1', '1', '1', '2018-12-10'),
(3, '測試用', '測試用', '測試用', '測試用', '0000-00-00'),
(4, '測試用', '測試用', '測試用', '測試用', '0000-00-00'),
(5, '測試用', '測試用', '測試用', '測試用', '0000-00-00'),
(6, '測試用', '測試用', '測試用', '測試用', '0000-00-00'),
(7, 'TestPOST', 'TestPOST', 'TestPOST', 'TestPOST', '2018-12-10');

-- --------------------------------------------------------

--
-- 資料表結構 `food_commodity`
--

CREATE TABLE `food_commodity` (
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
-- 資料表的匯出資料 `food_commodity`
--

INSERT INTO `food_commodity` (`food_sid`, `seller_sid`, `food_name`, `food_class`, `food_quantity`, `food_price`, `food_discount`, `food_photo`) VALUES
(2, 3, '黑糖包子', '麵包', '55', '100', '50', '/54454/454'),
(3, 3, '人肉肉包子', '麵包', '20', '100', '50', '/54454/454'),
(22, 2, '鹹濕奶頭', '麵包', '10', '100', '10', '1/111'),
(23, 4, '佛心饅頭', '麵包', '10', '100', '10', '1/111'),
(24, 4, '佛心饅頭', '麵包', '10', '100', '10', '1/111'),
(25, 2, '哭哭哭', '麵包', '6', '100', '10', '1/111');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `Numb_sid` text CHARACTER SET utf8 NOT NULL COMMENT '訂單號碼',
  `order_sid` int(11) NOT NULL COMMENT '訂單流水號',
  `seller_sid` int(11) NOT NULL COMMENT '店家流水號',
  `user_id` int(11) NOT NULL COMMENT '購買者',
  `food_sid` int(11) NOT NULL COMMENT '食物編號',
  `food_name` text CHARACTER SET utf8 NOT NULL COMMENT '食物名字',
  `food_photo` text CHARACTER SET utf8 NOT NULL COMMENT '食物照片',
  `food_quantity` int(11) NOT NULL COMMENT '數量',
  `food_discount` int(11) NOT NULL COMMENT '價錢',
  `order_time` date NOT NULL COMMENT '訂單成立時間',
  `status` text CHARACTER SET utf8 NOT NULL COMMENT '結帳狀態'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='訂單';

--
-- 資料表的匯出資料 `orders`
--

INSERT INTO `orders` (`Numb_sid`, `order_sid`, `seller_sid`, `user_id`, `food_sid`, `food_name`, `food_photo`, `food_quantity`, `food_discount`, `order_time`, `status`) VALUES
('31010533', 96, 3, 3, 4, '測試饅頭', '照片', 2, 100, '2018-12-10', '1'),
('31010533', 97, 3, 3, 3, '測試麵包', '照片', 2, 100, '2018-12-10', '1');

-- --------------------------------------------------------

--
-- 資料表結構 `order_deta`
--

CREATE TABLE `order_deta` (
  `sid` int(11) NOT NULL,
  `Numb_sid` int(255) NOT NULL,
  `seller_sid` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `order_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `order_deta`
--

INSERT INTO `order_deta` (`sid`, `Numb_sid`, `seller_sid`, `user_id`, `order_time`) VALUES
(21, 31010533, 3, 3, '2018-12-10');

-- --------------------------------------------------------

--
-- 資料表結構 `seller_data`
--

CREATE TABLE `seller_data` (
  `data_sid` int(255) NOT NULL COMMENT '廠商詳細資料流水號',
  `seller_sid` int(11) NOT NULL COMMENT '對應到initial廠商流水號',
  `seller_opening` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '營業時間',
  `seller_fb` text CHARACTER SET utf8 NOT NULL COMMENT '臉書',
  `seller_ig` text CHARACTER SET utf8 NOT NULL COMMENT '社群IG',
  `seller_web` text CHARACTER SET utf8 NOT NULL COMMENT '官方網站',
  `seller_introduce` text CHARACTER SET utf8 NOT NULL COMMENT '店家介紹',
  `seller_cover_photo` text CHARACTER SET utf8 NOT NULL COMMENT '封面照片路徑',
  `logo_photo` text CHARACTER SET utf8 NOT NULL COMMENT 'LOGO照片路徑',
  `eggsAreReady` text NOT NULL COMMENT '結帳方式'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `seller_data`
--

INSERT INTO `seller_data` (`data_sid`, `seller_sid`, `seller_opening`, `seller_fb`, `seller_ig`, `seller_web`, `seller_introduce`, `seller_cover_photo`, `logo_photo`, `eggsAreReady`) VALUES
(1, 0, '9am - 9pm', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://tw.yahoo.com/', '愛與恨淚水交織的饅頭,每一口的口感你都會感受的到師父的血與汗,如果你問我這段故事有沒有意義的話....我一定回答你說『沒有』,我在2001年的時候就學會打嘴砲寫廢文了,跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話跟你說個笑話\0\r\n', '', '0', '\0');

-- --------------------------------------------------------

--
-- 資料表結構 `seller_initial`
--

CREATE TABLE `seller_initial` (
  `seller_sid` int(11) NOT NULL COMMENT '店家流水號',
  `seller_name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '店家名字',
  `principal` text CHARACTER SET utf8 NOT NULL COMMENT '負責人',
  `seller_phone` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '店家電話',
  `seller_EIN` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '統一編號',
  `seller_address` text CHARACTER SET utf8 NOT NULL COMMENT '店家住址',
  `seller_email` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '店家電子信箱',
  `seller_password` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '店家密碼',
  `seller_status` bit(1) NOT NULL COMMENT '權限0關1開',
  `type` int(1) NOT NULL DEFAULT '2' COMMENT '廠商判別',
  `seller_create_at` date NOT NULL,
  `opening` text CHARACTER SET utf8 NOT NULL,
  `close_time` text CHARACTER SET utf8 NOT NULL,
  `FB` text CHARACTER SET utf8 NOT NULL,
  `IG` text CHARACTER SET utf8 NOT NULL,
  `Web` text CHARACTER SET utf8 NOT NULL,
  `Introduction` text CHARACTER SET utf8 NOT NULL,
  `logo_photo` text CHARACTER SET utf8 NOT NULL,
  `cover_photo` text CHARACTER SET utf8 NOT NULL,
  `checkout` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `seller_initial`
--

INSERT INTO `seller_initial` (`seller_sid`, `seller_name`, `principal`, `seller_phone`, `seller_EIN`, `seller_address`, `seller_email`, `seller_password`, `seller_status`, `type`, `seller_create_at`, `opening`, `close_time`, `FB`, `IG`, `Web`, `Introduction`, `logo_photo`, `cover_photo`, `checkout`) VALUES
(2, '小鳥紅茶店', '龜頭人', '082688888', '99999999', '台北市信義區', 'mopackp@gmail.com', 'abcd123456', b'0', 2, '2018-11-19', '', '', '', '', '', '', '25000', '', b'0'),
(3, '貓咪咖啡店', '', '1234577890', '77777777', '台北市信義區', 'killlmeplz@gmail.com', 'iiieiroqweioqwe', b'0', 2, '2018-11-23', '', '', '', '', '', '', '', '', b'0'),
(4, '狗狗肉包店', '', '123123123', '123123', '12313213213', '1231231', '123123123', b'0', 2, '2018-11-29', '11', '12', '10', '10', '10', '10', '12', '10', b'1');

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
  `type` int(255) NOT NULL DEFAULT '1' COMMENT '廠商跟一般區別',
  `user_create_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user_data`
--

INSERT INTO `user_data` (`user_id`, `user_name`, `user_phone`, `user_email`, `user_password`, `user_photo`, `user_status`, `type`, `user_create_time`) VALUES
(1, '小屌屌7', '9999999999', 'QQQQQQQQ@QQ', 'a123456', '母湯喔', 0, 1, '2018-11-16'),
(2, '哭哭喔', '0978848888', 'sadasdasdasd@gmail.com', 'abcd1234888', 'sdasdasd', 0, 1, '2018-11-16'),
(3, '蔡耀諄', '0960509861', 'mopackp47557@gmail.com', 'abcd123456', '123456', 0, 1, '2018-11-19'),
(4, '蔡一零', '0960509555', 'mopackp47@gmail.com', 'abcd123456', '0', 0, 1, '2018-11-20'),
(5, '12313', '12313', '1231231231', '12313213213', '0', 0, 1, '2018-11-28');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_sid`);

--
-- 資料表索引 `food_commodity`
--
ALTER TABLE `food_commodity`
  ADD PRIMARY KEY (`food_sid`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_sid`);

--
-- 資料表索引 `order_deta`
--
ALTER TABLE `order_deta`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `seller_data`
--
ALTER TABLE `seller_data`
  ADD PRIMARY KEY (`data_sid`);

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

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_sid` int(255) NOT NULL AUTO_INCREMENT COMMENT '文章流水號', AUTO_INCREMENT=8;

--
-- 使用資料表 AUTO_INCREMENT `food_commodity`
--
ALTER TABLE `food_commodity`
  MODIFY `food_sid` int(11) NOT NULL AUTO_INCREMENT COMMENT '食物流水號', AUTO_INCREMENT=26;

--
-- 使用資料表 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `order_sid` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單流水號', AUTO_INCREMENT=98;

--
-- 使用資料表 AUTO_INCREMENT `order_deta`
--
ALTER TABLE `order_deta`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表 AUTO_INCREMENT `seller_data`
--
ALTER TABLE `seller_data`
  MODIFY `data_sid` int(255) NOT NULL AUTO_INCREMENT COMMENT '廠商詳細資料流水號', AUTO_INCREMENT=2;

--
-- 使用資料表 AUTO_INCREMENT `seller_initial`
--
ALTER TABLE `seller_initial`
  MODIFY `seller_sid` int(11) NOT NULL AUTO_INCREMENT COMMENT '店家流水號', AUTO_INCREMENT=5;

--
-- 使用資料表 AUTO_INCREMENT `user_data`
--
ALTER TABLE `user_data`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '會員流水號', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
