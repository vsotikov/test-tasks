-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 03:40 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `entry_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `entry_id`, `author_id`, `comment`, `created_at`, `ip`) VALUES
(2, 4, 1, 'First Comment', '2018-04-22 13:14:06', 2130706433),
(3, 4, 1, 'Second Comment', '2018-04-22 13:14:21', 2130706433);

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(512) NOT NULL,
  `text` text NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `title`, `text`, `author_id`, `created_at`) VALUES
(1, 'Test entry', 'Test entry text', 1, '2018-04-21 11:57:26'),
(2, 'Second entry', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula, mauris eget tincidunt hendrerit, nisi dui luctus leo, ut facilisis urna dui at purus. Cras sed sodales lectus. Integer quis consequat lacus, non malesuada tellus. Morbi posuere lectus a sagittis consequat. Vestibulum a velit varius, mattis neque eget, ornare mi. Vivamus a nunc malesuada, pretium erat eget, ornare nunc. Nam vel urna a purus interdum mattis. Nam sit amet porttitor nulla. Etiam dignissim urna at velit consequat, at egestas ligula facilisis. Vestibulum cursus ligula augue, nec ullamcorper odio vulputate sed. Duis gravida magna velit, id malesuada justo efficitur vel. Morbi placerat malesuada urna, eu aliquet urna tempus eget.\r\n\r\nQuisque placerat congue nisl a sagittis. Ut convallis, augue eu convallis imperdiet, ipsum tortor porttitor nulla, sed gravida elit mi sed diam. Nam ex ligula, porttitor vel accumsan quis, ullamcorper sed leo. Nunc nibh lectus, euismod vel ligula in, lobortis blandit ex. Nullam rhoncus erat sit amet ipsum auctor, at dictum sem imperdiet. Nulla aliquam dui eu dolor egestas, at aliquet sapien commodo. Nunc maximus eget odio nec pulvinar. Quisque ultricies at mauris et facilisis. Donec maximus purus ac magna lacinia mollis. Phasellus ex diam, sollicitudin laoreet est sed, dapibus tempus turpis. Curabitur commodo fermentum lacus id pulvinar. Praesent a tempus justo, et congue libero. Duis ac orci sed sem accumsan maximus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\r\n\r\nQuisque pretium turpis in ante molestie congue. Phasellus tempus erat at porta varius. Aliquam accumsan at elit eu mollis. Quisque luctus metus vel risus tincidunt aliquam. Sed euismod ante eget neque tincidunt molestie. Morbi a imperdiet lacus. Phasellus gravida risus eleifend ipsum gravida, non scelerisque neque venenatis. Nulla ipsum est, viverra vitae diam id, ultrices vestibulum orci. Fusce hendrerit vitae risus vel rutrum. Nunc pharetra tortor ut est tempus auctor. Integer neque odio, consectetur eu accumsan a, lacinia ac purus. Fusce quis ex et leo lacinia laoreet ut ac dolor. Nullam consectetur aliquam neque, eu faucibus nunc finibus sed. Etiam diam libero, tristique non vulputate eget, tincidunt non mi. Integer non accumsan ligula.\r\n\r\nEtiam nec consequat odio, vel rutrum lorem. Sed porta interdum pharetra. Vivamus vel erat dignissim, luctus purus vel, ultrices turpis. Morbi finibus erat arcu, et eleifend augue pulvinar vitae. Curabitur rhoncus sed nunc ac pretium. Praesent sagittis, odio sed ultricies fringilla, nisl lorem hendrerit justo, ac rhoncus lacus ex eget sapien. Fusce vulputate malesuada nibh condimentum euismod. Integer non tortor sem. Quisque massa diam, finibus in rhoncus vel, sagittis in magna. Vestibulum tincidunt mauris a libero tincidunt, in accumsan tortor lobortis. Sed posuere viverra justo ac luctus.\r\n\r\nVivamus risus neque, cursus vel nunc at, pharetra maximus turpis. Vivamus mauris mi, consectetur et nisi eu, elementum interdum leo. Nullam dolor enim, vehicula sed dui sed, finibus gravida urna. Pellentesque non lobortis eros, vitae tincidunt felis. Etiam scelerisque, tortor vel viverra tempus, justo nibh mollis magna, vel mollis erat urna at neque. Donec fringilla id orci tincidunt commodo. Praesent fermentum, justo ac convallis egestas, felis ante mollis ante, eu sollicitudin lacus dui id augue. Nunc ut massa quis orci ultricies lacinia in ut turpis. Curabitur tempor euismod condimentum.', 1, '2018-04-21 12:19:04'),
(3, 'Third entry', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula, mauris eget tincidunt hendrerit, nisi dui luctus leo, ut facilisis urna dui at purus. Cras sed sodales lectus. Integer quis consequat lacus, non malesuada tellus. Morbi posuere lectus a sagittis consequat. Vestibulum a velit varius, mattis neque eget, ornare mi. Vivamus a nunc malesuada, pretium erat eget, ornare nunc. Nam vel urna a purus interdum mattis. Nam sit amet porttitor nulla. Etiam dignissim urna at velit consequat, at egestas ligula facilisis. Vestibulum cursus ligula augue, nec ullamcorper odio vulputate sed. Duis gravida magna velit, id malesuada justo efficitur vel. Morbi placerat malesuada urna, eu aliquet urna tempus eget.\r\n\r\nQuisque placerat congue nisl a sagittis. Ut convallis, augue eu convallis imperdiet, ipsum tortor porttitor nulla, sed gravida elit mi sed diam. Nam ex ligula, porttitor vel accumsan quis, ullamcorper sed leo. Nunc nibh lectus, euismod vel ligula in, lobortis blandit ex. Nullam rhoncus erat sit amet ipsum auctor, at dictum sem imperdiet. Nulla aliquam dui eu dolor egestas, at aliquet sapien commodo. Nunc maximus eget odio nec pulvinar. Quisque ultricies at mauris et facilisis. Donec maximus purus ac magna lacinia mollis. Phasellus ex diam, sollicitudin laoreet est sed, dapibus tempus turpis. Curabitur commodo fermentum lacus id pulvinar. Praesent a tempus justo, et congue libero. Duis ac orci sed sem accumsan maximus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\r\n\r\nQuisque pretium turpis in ante molestie congue. Phasellus tempus erat at porta varius. Aliquam accumsan at elit eu mollis. Quisque luctus metus vel risus tincidunt aliquam. Sed euismod ante eget neque tincidunt molestie. Morbi a imperdiet lacus. Phasellus gravida risus eleifend ipsum gravida, non scelerisque neque venenatis. Nulla ipsum est, viverra vitae diam id, ultrices vestibulum orci. Fusce hendrerit vitae risus vel rutrum. Nunc pharetra tortor ut est tempus auctor. Integer neque odio, consectetur eu accumsan a, lacinia ac purus. Fusce quis ex et leo lacinia laoreet ut ac dolor. Nullam consectetur aliquam neque, eu faucibus nunc finibus sed. Etiam diam libero, tristique non vulputate eget, tincidunt non mi. Integer non accumsan ligula.\r\n\r\nEtiam nec consequat odio, vel rutrum lorem. Sed porta interdum pharetra. Vivamus vel erat dignissim, luctus purus vel, ultrices turpis. Morbi finibus erat arcu, et eleifend augue pulvinar vitae. Curabitur rhoncus sed nunc ac pretium. Praesent sagittis, odio sed ultricies fringilla, nisl lorem hendrerit justo, ac rhoncus lacus ex eget sapien. Fusce vulputate malesuada nibh condimentum euismod. Integer non tortor sem. Quisque massa diam, finibus in rhoncus vel, sagittis in magna. Vestibulum tincidunt mauris a libero tincidunt, in accumsan tortor lobortis. Sed posuere viverra justo ac luctus.\r\n\r\nVivamus risus neque, cursus vel nunc at, pharetra maximus turpis. Vivamus mauris mi, consectetur et nisi eu, elementum interdum leo. Nullam dolor enim, vehicula sed dui sed, finibus gravida urna. Pellentesque non lobortis eros, vitae tincidunt felis. Etiam scelerisque, tortor vel viverra tempus, justo nibh mollis magna, vel mollis erat urna at neque. Donec fringilla id orci tincidunt commodo. Praesent fermentum, justo ac convallis egestas, felis ante mollis ante, eu sollicitudin lacus dui id augue. Nunc ut massa quis orci ultricies lacinia in ut turpis. Curabitur tempor euismod condimentum.', 1, '2018-04-22 12:19:15'),
(4, 'Forth entry', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula, mauris eget tincidunt hendrerit, nisi dui luctus leo, ut facilisis urna dui at purus. Cras sed sodales lectus. Integer quis consequat lacus, non malesuada tellus. Morbi posuere lectus a sagittis consequat. Vestibulum a velit varius, mattis neque eget, ornare mi. Vivamus a nunc malesuada, pretium erat eget, ornare nunc. Nam vel urna a purus interdum mattis. Nam sit amet porttitor nulla. Etiam dignissim urna at velit consequat, at egestas ligula facilisis. Vestibulum cursus ligula augue, nec ullamcorper odio vulputate sed. Duis gravida magna velit, id malesuada justo efficitur vel. Morbi placerat malesuada urna, eu aliquet urna tempus eget.\r\n\r\nQuisque placerat congue nisl a sagittis. Ut convallis, augue eu convallis imperdiet, ipsum tortor porttitor nulla, sed gravida elit mi sed diam. Nam ex ligula, porttitor vel accumsan quis, ullamcorper sed leo. Nunc nibh lectus, euismod vel ligula in, lobortis blandit ex. Nullam rhoncus erat sit amet ipsum auctor, at dictum sem imperdiet. Nulla aliquam dui eu dolor egestas, at aliquet sapien commodo. Nunc maximus eget odio nec pulvinar. Quisque ultricies at mauris et facilisis. Donec maximus purus ac magna lacinia mollis. Phasellus ex diam, sollicitudin laoreet est sed, dapibus tempus turpis. Curabitur commodo fermentum lacus id pulvinar. Praesent a tempus justo, et congue libero. Duis ac orci sed sem accumsan maximus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\r\n\r\nQuisque pretium turpis in ante molestie congue. Phasellus tempus erat at porta varius. Aliquam accumsan at elit eu mollis. Quisque luctus metus vel risus tincidunt aliquam. Sed euismod ante eget neque tincidunt molestie. Morbi a imperdiet lacus. Phasellus gravida risus eleifend ipsum gravida, non scelerisque neque venenatis. Nulla ipsum est, viverra vitae diam id, ultrices vestibulum orci. Fusce hendrerit vitae risus vel rutrum. Nunc pharetra tortor ut est tempus auctor. Integer neque odio, consectetur eu accumsan a, lacinia ac purus. Fusce quis ex et leo lacinia laoreet ut ac dolor. Nullam consectetur aliquam neque, eu faucibus nunc finibus sed. Etiam diam libero, tristique non vulputate eget, tincidunt non mi. Integer non accumsan ligula.\r\n\r\nEtiam nec consequat odio, vel rutrum lorem. Sed porta interdum pharetra. Vivamus vel erat dignissim, luctus purus vel, ultrices turpis. Morbi finibus erat arcu, et eleifend augue pulvinar vitae. Curabitur rhoncus sed nunc ac pretium. Praesent sagittis, odio sed ultricies fringilla, nisl lorem hendrerit justo, ac rhoncus lacus ex eget sapien. Fusce vulputate malesuada nibh condimentum euismod. Integer non tortor sem. Quisque massa diam, finibus in rhoncus vel, sagittis in magna. Vestibulum tincidunt mauris a libero tincidunt, in accumsan tortor lobortis. Sed posuere viverra justo ac luctus.\r\n\r\nVivamus risus neque, cursus vel nunc at, pharetra maximus turpis. Vivamus mauris mi, consectetur et nisi eu, elementum interdum leo. Nullam dolor enim, vehicula sed dui sed, finibus gravida urna. Pellentesque non lobortis eros, vitae tincidunt felis. Etiam scelerisque, tortor vel viverra tempus, justo nibh mollis magna, vel mollis erat urna at neque. Donec fringilla id orci tincidunt commodo. Praesent fermentum, justo ac convallis egestas, felis ante mollis ante, eu sollicitudin lacus dui id augue. Nunc ut massa quis orci ultricies lacinia in ut turpis. Curabitur tempor euismod condimentum.', 1, '2018-04-22 12:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'vitaliy', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `entry_id` (`entry_id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `author_id_fk` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `entry_id_fk` FOREIGN KEY (`entry_id`) REFERENCES `entries` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `author_id` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
