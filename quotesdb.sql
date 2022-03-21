-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 03:53 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quotesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `author`) VALUES
(1, 'Walt Disney'),
(2, 'Will Ferrell'),
(3, 'Albert Einstein'),
(4, 'Uncle Iroh'),
(5, 'Confucius'),
(6, 'Lao Tzu'),
(7, 'Queen Elizabeth II'),
(10, 'nell'),
(11, 'nell'),
(12, 'nell');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Success'),
(2, 'Comedy'),
(3, 'Wisdom'),
(4, 'Life'),
(5, 'Friendship'),
(6, 'Grimm');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `quote` varchar(200) NOT NULL,
  `authorId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote`, `authorId`, `categoryId`) VALUES
(1, 'The way to get started is to quit talking and begin doing', 1, 1),
(2, 'Laughter is timeless, imagination has no age, dreams are forever.', 1, 1),
(3, 'It’s kind of fun to do the impossible. (modified)', 1, 1),
(4, 'Before you marry a person, you should first make them use a computer with slow Internet to see who they really are.', 2, 2),
(5, 'if you look for the dark, that is all you will ever see.', 4, 3),
(6, 'if you look for the dark, that is all you will ever see.', 4, 3),
(7, 'There is nothing wrong with a life of peace and prosperity. I suggest you think about what it is you want from your life.', 4, 3),
(8, 'Failure is only the opportunity to begin again.', 4, 3),
(9, 'It does not matter how slowly you go as long as you do not stop.', 5, 3),
(10, 'Common sense is the collection of prejudices acquired by age eighteen.', 3, 2),
(11, 'Never contract friendship with a man that is not better than thyself.', 5, 5),
(12, 'Life is really simple, but we insist on making it complicated.', 5, 4),
(13, 'I love Mickey Mouse more than any woman I have ever known.', 1, 2),
(14, 'Fill your bowl to the brim and it will spill. Keep sharpening your knife and it will blunt.', 6, 4),
(15, 'One who is too insistent on his own views, finds few to agree with him.', 6, 3),
(16, 'When a nation is filled with strife, then do patriots flourish.', 6, 3),
(17, 'Only two things are infinite, the universe and human stupidity, and I&#039;m not sure about the former.', 3, 2),
(18, 'The true sign of intelligence is not knowledge but imagination.', 3, 3),
(19, 'The important thing is not to stop questioning. Curiosity has its own reason for existing.', 3, 1),
(20, 'If people are good only because they fear punishment, and hope for reward, then we are a sorry lot indeed.', 3, 4),
(21, 'Only the wisest and stupidest of men never change.', 5, 2),
(22, 'A gentleman would be ashamed should his deeds not match his words.', 5, 3),
(23, 'The British constitution has always been puzzling and always will be.', 7, 2),
(24, 'How could man rejoice in victory and delight in the slaughter of men?', 6, 6),
(25, 'Man&#039;s enemies are not demons, but human beings like himself.', 6, 6),
(26, 'It is a miracle that curiosity survives formal education.', 3, 6),
(27, 'The only thing that interferes with my learning is my education.', 3, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorId` (`authorId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `quotes_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
