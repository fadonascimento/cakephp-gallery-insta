-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2014 at 05:06 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `instagram`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `default_name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `default_name`, `path`, `model`, `event_id`, `tags`, `status`, `created`, `modified`) VALUES
(9, NULL, NULL, NULL, NULL, 10, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'vontadedenaoirembora', NULL, NULL, NULL, 11, 'vontadedenaoirembora', NULL, '2014-05-26 02:19:34', '2014-05-26 02:19:34'),
(11, 'vontadedenaoirembora', NULL, NULL, NULL, 11, 'vontadedenaoirembora', NULL, '2014-05-26 02:19:34', '2014-05-26 02:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(111) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `tags`, `event_date`, `customer_id`, `created`, `modified`) VALUES
(2, 'Evento Teste', 'vontadedenaoirembora', '2014-05-25 22:13:00', 2, '2014-05-25 22:14:25', '2014-05-25 22:37:14'),
(10, 'asd', 'teste', '2014-05-26 02:18:00', 1, '2014-05-26 02:18:52', '2014-05-26 02:18:52'),
(11, 'Rodeio de Americana', 'vontadedenaoirembora', '2014-05-26 02:19:00', 1, '2014-05-26 02:19:34', '2014-05-27 22:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `obs` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `obs`, `created`, `modified`) VALUES
(1, 'Admin', NULL, '2014-05-20 05:31:40', '2014-05-20 05:31:40'),
(2, 'Cliente', NULL, '2014-05-20 05:31:55', '2014-05-20 05:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `size` bigint(20) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `media_id` bigint(111) DEFAULT NULL,
  `style` varchar(255) DEFAULT 'full',
  `order` int(11) NOT NULL DEFAULT '9999999',
  `result` text,
  `instagram_id` bigint(111) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `folder_id` (`album_id`),
  KEY `main_id` (`media_id`),
  KEY `instagram_id` (`instagram_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `name`, `path`, `size`, `album_id`, `media_id`, `style`, `order`, `result`, `instagram_id`, `created`, `modified`) VALUES
(1, NULL, NULL, NULL, 10, NULL, 'full', 9999999, '{"attribution":null,"tags":["vontadedenaoirembora","espetacular"],"type":"image","location":{"latitude":38.7458639,"longitude":-9.1390105},"comments":{"count":2,"data":[{"created_time":"1400933221","text":"Voltaaa!!! #saudades","from":{"username":"fernandapulier","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_23423250_75sq_1397513839.jpg","id":"23423250","full_name":"Fernanda Pulier"},"id":"727403041902068149"},{"created_time":"1400947050","text":"To chegando amanh\\u00e3 @fernandapulier !!!","from":{"username":"bruninha_marrara","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_218016823_75sq_1378335477.jpg","id":"218016823","full_name":"Bruna Marrara Polastri"},"id":"727519043600024392"}]},"filter":"Normal","created_time":"1400921909","link":"http:\\/\\/instagram.com\\/p\\/oX6ufjHIO5\\/","likes":{"count":43,"data":[{"username":"mmgazzinelli","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_462844712_75sq_1398539418.jpg","id":"462844712","full_name":"Ma\\u00edra Gazzinelli"},{"username":"robertaclolato","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_30344225_75sq_1390746685.jpg","id":"30344225","full_name":"Roberta Lolato"},{"username":"joaopedrojpaa","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_266187208_75sq_1373641689.jpg","id":"266187208","full_name":"Joao Pedro Andrade Almeida"},{"username":"barbaramolinari","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_30331023_75sq_1399567781.jpg","id":"30331023","full_name":"barbaramolinari"}]},"images":{"low_resolution":{"url":"http:\\/\\/scontent-b.cdninstagram.com\\/hphotos-ash\\/t51.2885-15\\/10387878_697332083662911_145284879_a.jpg","width":306,"height":306},"thumbnail":{"url":"http:\\/\\/scontent-b.cdninstagram.com\\/hphotos-ash\\/t51.2885-15\\/10387878_697332083662911_145284879_s.jpg","width":150,"height":150},"standard_resolution":{"url":"http:\\/\\/scontent-b.cdninstagram.com\\/hphotos-ash\\/t51.2885-15\\/10387878_697332083662911_145284879_n.jpg","width":640,"height":640}},"users_in_photo":[{"position":{"y":0.8203704,"x":0.8981481},"user":{"username":"inezmarrara","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_729558741_75sq_1385769678.jpg","id":"729558741","full_name":"Inez Costa Marrara Polastri"}},{"position":{"y":0.59814817,"x":0.64166665},"user":{"username":"geraldinopolastrijunior","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_1110729988_75sq_1392945172.jpg","id":"1110729988","full_name":"Geraldino Polastri J\\u00fanior"}}],"caption":{"created_time":"1400921909","text":"#espetacular #vontadedenaoirembora","from":{"username":"bruninha_marrara","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_218016823_75sq_1378335477.jpg","id":"218016823","full_name":"Bruna Marrara Polastri"},"id":"727308148609417991"},"user_has_liked":false,"id":"727308146512266169_218016823","user":{"username":"bruninha_marrara","website":"","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_218016823_75sq_1378335477.jpg","full_name":"Bruna Marrara Polastri","bio":"","id":"218016823"}}', 727308148609417991, '2014-05-27 22:31:37', '2014-05-27 22:31:37'),
(2, NULL, NULL, NULL, 10, NULL, 'full', 9999999, '{"attribution":null,"tags":["vontadedenaoirembora"],"type":"image","location":null,"comments":{"count":0,"data":[]},"filter":"Valencia","created_time":"1400181131","link":"http:\\/\\/instagram.com\\/p\\/oB1zgKxm4w\\/","likes":{"count":2,"data":[{"username":"paulomanzatojr","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_248314617_75sq_1397660003.jpg","id":"248314617","full_name":"Paulo Manzato Jr"},{"username":"vanessamariela","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/profile_264570394_75sq_1369994610.jpg","id":"264570394","full_name":"Vanessa Oliveira\\ud83c\\udf80"}]},"images":{"low_resolution":{"url":"http:\\/\\/scontent-a.cdninstagram.com\\/hphotos-prn\\/t51.2885-15\\/10369354_248834015322027_1376693280_a.jpg","width":306,"height":306},"thumbnail":{"url":"http:\\/\\/scontent-a.cdninstagram.com\\/hphotos-prn\\/t51.2885-15\\/10369354_248834015322027_1376693280_s.jpg","width":150,"height":150},"standard_resolution":{"url":"http:\\/\\/scontent-a.cdninstagram.com\\/hphotos-prn\\/t51.2885-15\\/10369354_248834015322027_1376693280_n.jpg","width":640,"height":640}},"users_in_photo":[],"caption":{"created_time":"1400181131","text":"#vontadedenaoirembora","from":{"username":"helolazarin","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/anonymousUser.jpg","id":"674354506","full_name":"Heloisa Lazarin"},"id":"721094051306565248"},"user_has_liked":false,"id":"721094051054906928_674354506","user":{"username":"helolazarin","website":"","profile_picture":"http:\\/\\/images.ak.instagram.com\\/profiles\\/anonymousUser.jpg","full_name":"Heloisa Lazarin","bio":"","id":"674354506"}}', 721094051306565248, '2014-05-27 22:43:48', '2014-05-27 22:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `name` varchar(90) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `password` char(40) DEFAULT NULL,
  `username` varchar(90) DEFAULT NULL,
  `phone` varchar(90) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `name`, `email`, `password`, `username`, `phone`, `created`, `modified`) VALUES
(1, 1, 'Fabricio', 'fadonascimento@gmail.com', '42eee4f3bc55529258df15f5248889f7472d0d38', NULL, NULL, '2014-05-20 05:29:40', '2014-05-20 05:38:30'),
(2, 2, 'Teste', 'teste@teste.com', NULL, NULL, '11111', '2014-05-25 15:44:51', '2014-05-25 15:44:51');
