-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2016 at 02:11 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `juice_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `user_name` varchar(50) NOT NULL COMMENT 'User''s Name',
  `user_email` varchar(100) NOT NULL COMMENT 'Email',
  `user_pwd` varchar(100) NOT NULL COMMENT 'Password',
  `reg_ymd` datetime NOT NULL COMMENT 'Registered Date and Time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_pwd`, `reg_ymd`) VALUES
(1, 'root', 'root@email.com', '123', '2016-11-09 10:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(200) NOT NULL COMMENT 'Video''s Name',
  `description` text NOT NULL COMMENT 'Description',
  `video_url` varchar(2084) NOT NULL COMMENT 'URL',
  `thumbnail` varchar(1000) NOT NULL COMMENT 'Thumbnail',
  `reg_ymd` datetime NOT NULL COMMENT 'Registered Date and Time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `video_url`, `thumbnail`, `reg_ymd`) VALUES
(1, 'German is a beautiful language', 'Description', 'http://youtube.com/embed/zLvL7a8Y0pI', 'http://garak.wimp.com/images/pthumbs/2016/11/6a7f689aac953c4d1fe6d76ed1e3c018_german_edit_198_154.jpg', '2016-11-08 20:57:03'),
(2, 'The "mannequin challenge" is awesome (and a little creepy)', 'Description', 'http://youtube.com/embed/NbJZP0xCIq4', 'http://garak.wimp.com/images/pthumbs/2016/11/1b62ff22e70a7197fa1f3f34fa2b7f65_chal_edit_198_154.jpg', '2016-11-08 20:57:06'),
(3, 'Watch how the human race spread across the globe', 'Description', 'http://youtube.com/embed/PUwmA3Q0_OE', 'http://garak.wimp.com/images/pthumbs/2016/11/015e31933548461020e2ba448e85995e_po_edit_198_154.jpg', '2016-11-08 20:57:08'),
(4, 'A simple gift can change the world', 'Description', 'http://youtube.com/embed/6Q9CbtZAfoI', 'http://garak.wimp.com/images/pthumbs/2016/11/de4b763471b905676a7a4c8023ce184e_gift_edit_198_154.jpg', '2016-11-08 20:57:09'),
(5, 'Baby iguana runs for its life', 'Description', 'ERROR!', 'http://garak.wimp.com/images/pthumbs/2016/11/9812886076e5749e00292cc3c9777ab3_baby_edit_198_154.jpg', '2016-11-08 20:57:11'),
(6, 'Welcome to the future', 'Description', 'http://youtube.com/embed/vn4YlAlHn-Y', 'http://garak.wimp.com/images/pthumbs/2016/11/d2c1f1b68f6e19a0eabbce44ab7738dd_future_edit_198_154.jpg', '2016-11-08 20:57:13'),
(7, 'Two scientists solve the "walking water mystery"', 'Description', 'http://youtube.com/embed/KJDEsAy9RyM', 'http://garak.wimp.com/images/pthumbs/2016/11/87049013bcaaaf0687f907a4063fd12c_water_edit_198_154.jpg', '2016-11-08 20:57:19'),
(8, '11-year-old girl gives a funny interview about her dad on live TV', 'Description', 'http://youtube.com/embed/wlHuX4k2xk4', 'http://garak.wimp.com/images/pthumbs/2016/11/fb5e64d14198251935f7cc7d3ad58590_interview_edit_198_154.jpg', '2016-11-08 20:57:26'),
(9, 'The "grappler" can slow down cars during police chases', 'Description', 'http://youtube.com/embed/850ZgmDO61U', 'http://garak.wimp.com/images/pthumbs/2016/11/4731930038e535c8a92a63282a1bdf7f_grappler_edit_198_154.jpg', '2016-11-08 20:57:30'),
(10, 'The most satisfying 5 minutes of your life', 'Description', 'http://youtube.com/embed/IjeKw0B8PG8', 'http://garak.wimp.com/images/pthumbs/2016/11/1b43914f3e2e1f22b1090eb86d69fe11_satisfying_edit_198_154.jpg', '2016-11-08 20:57:33'),
(11, 'How to delete a wheel', 'Description', 'http://youtube.com/embed/juQyy00x-Mw', 'http://garak.wimp.com/images/pthumbs/2016/11/e6dc5789517d0ecd1b071903c4810eaa_wheel_edit_198_154.jpg', '2016-11-08 20:58:25'),
(12, 'Cleaning out the panda enclosure is harder than it sounds', 'Description', 'http://youtube.com/embed/K3tNgwQwKK4', 'http://garak.wimp.com/images/pthumbs/2016/11/44915f29c4a1a0ba6181722d8aa347ed_panda_edit_198_154.jpg', '2016-11-08 20:58:29'),
(13, 'Car goes so fast that it literally flies', 'Description', 'http://youtube.com/embed/CUud0lGU0x0', 'http://garak.wimp.com/images/pthumbs/2016/11/9c8661befae6dbcd08304dbf4dcaf0db_car_edit_198_154.jpg', '2016-11-08 20:58:33'),
(14, 'The cheapest car in Mexico vs. the cheapest car in the U.S.', 'Description', 'http://youtube.com/embed/85OysZ_4lp0', 'http://garak.wimp.com/images/pthumbs/2016/11/2d3dbdaf63992d81da1f36b3ee240c0d_crash_edit_198_154.jpg', '2016-11-08 20:58:39'),
(15, 'Who needs physics?', 'Description', 'http://youtube.com/embed/_DbAeeKkXv0', 'http://garak.wimp.com/images/pthumbs/2016/10/9938f15a71d8b984a62d8c8c926c1b5c_physics_edit_198_154.jpg', '2016-11-08 21:01:10'),
(16, 'A wild west cover of "The Final Countdown"', 'Description', 'http://youtube.com/embed/6GRHANmafp0', 'http://garak.wimp.com/images/pthumbs/2016/10/d2d074aa213d3873052e8bc22bf5b291_west_edit_198_154.jpg', '2016-11-08 21:01:19'),
(17, 'Up-close footage of burning incense', 'Description', 'http://youtube.com/embed/C0s0LSah6R0', 'http://garak.wimp.com/images/pthumbs/2016/10/5fc63386c7532093323dc21a5a5df0fd_incense_edit_198_154.jpg', '2016-11-08 21:01:22'),
(18, 'This device cracks eggs perfectly every time', 'Description', 'http://youtube.com/embed/EQL-9yYR3AM', 'http://garak.wimp.com/images/pthumbs/2016/10/b1baa403406e9bc353bc829e3ffd6cee_egg_edit_198_154.jpg', '2016-11-08 21:03:19'),
(19, 'This house has the coolest Halloween decorations on the block', 'Description', 'http://youtube.com/embed/1XMdJ6WqjvE', 'http://garak.wimp.com/images/pthumbs/2016/10/4100a0586c1f755aa468aeb5f28df335_house_edit_198_154.jpg', '2016-11-08 21:03:27'),
(20, 'Trains in France go really, really fast', 'Description', 'http://youtube.com/embed/sE4A0nPjyqQ', 'http://garak.wimp.com/images/pthumbs/2016/10/ccfc2d538ddff519d893a6b966a1c4f1_train_edit_198_154.jpg', '2016-11-08 21:03:30'),
(21, 'Guy sums up his trip to Crete in 25 seconds', 'Description', 'http://youtube.com/embed/LLn5MWWguoA', 'http://garak.wimp.com/images/pthumbs/2016/10/b16a9e8de58c95b427b29472b1eca130_crete_edit_198_154.jpg', '2016-11-08 21:03:34'),
(22, 'Meet Henri, the existential cat', 'Description', 'http://youtube.com/embed/Q34z5dCmC4M', 'http://garak.wimp.com/images/pthumbs/2016/10/7fa66f426416d30c0c885937fed3c9d1_cat_edit_198_154.jpg', '2016-11-08 21:04:09'),
(23, 'This baby mech costume wins Halloween', 'Description', 'http://youtube.com/embed/QIln1LTtvzc', 'http://garak.wimp.com/images/pthumbs/2016/10/908d139fadc56a731135f96e130c652a_mech_edit_198_154.jpg', '2016-11-08 21:04:12'),
(24, 'What is it like to be colorblind?', 'Description', 'http://youtube.com/embed/tU1krrUM26Q', 'http://garak.wimp.com/images/pthumbs/2016/10/a5d16104be85fc85838ce2259c88f2cb_color_edit_198_154.jpg', '2016-11-08 21:04:16'),
(25, 'What would you do if you saw this thing in the sky?', 'Description', 'http://youtube.com/embed/Qr9FhpLUgD8', 'http://garak.wimp.com/images/pthumbs/2016/10/bdf4880433deb05d33cd59e756e3ae6c_octo_edit_198_154.jpg', '2016-11-08 21:04:21'),
(26, 'The reason why shoes have that extra shoelace hole', 'Description', 'http://youtube.com/embed/IijQyX_YCKA', 'http://garak.wimp.com/images/pthumbs/2016/10/93c6cea607715faa19391e37c48fac33_hole_edit_198_154.jpg', '2016-11-08 21:10:20'),
(27, 'Speed testing 2 types of race cars', 'Description', 'http://youtube.com/embed/K2cNqaPSHv0', 'http://garak.wimp.com/images/pthumbs/2016/10/c45ff238efdaeb27177502d90e93f60b_speed_edit_198_154.jpg', '2016-11-08 21:10:32');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
