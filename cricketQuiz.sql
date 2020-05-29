-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 20, 2020 at 08:51 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cricketQuiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `questionText` varchar(500) NOT NULL DEFAULT 'questionText',
  `optionA` varchar(100) NOT NULL DEFAULT 'optionA',
  `optionB` varchar(100) NOT NULL DEFAULT 'optionB',
  `optionC` varchar(100) NOT NULL DEFAULT 'optionC',
  `optionD` varchar(100) NOT NULL DEFAULT 'optionD',
  `correctAnswer` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `questionText`, `optionA`, `optionB`, `optionC`, `optionD`, `correctAnswer`) VALUES
(1, 'In which country did cricket originate?', 'England', 'China', 'Australia', 'India', 'A'),
(2, 'How many players are typically on a cricket team?', '11', '12', '5', '6', 'A'),
(3, 'Hitting the ball to the boundary on the ground is equivalent to how many runs?', '20', '10', '4', '8', 'C'),
(4, 'Hitting the ball over the boundary is equivalent to how many runs?', '2', '4', '10', '6', 'D'),
(5, 'The fielding team must get how many batsmen out before they can start batting?', '6', '10', '9', '3', 'B'),
(6, 'Which of the following is not a method of getting a batsman out?', 'Doing a backflip', 'Hitting the wickets with a ball', 'Catching a batsman\'s shot', 'Hitting a batsman\'s leg in front of the wicket (Leg Before Wicket)', 'A'),
(7, 'What is a wicket?', 'A small gate used on cricket playing grounds', 'A piece of wood the batsman holds in order to hit the ball', 'Protective gear worn by the batsman', 'A fancy hat', 'A'),
(8, 'Which is the biggest cricket league in the world?', 'Pakistan Super League', 'Big Bash League', 'India Premier League', 'T20 Blast', 'C'),
(9, 'How many umpires are on the field of play?', 'One', 'Two', 'Three', 'Four', 'B'),
(10, 'How many batsmen are on the field at the same time during play?', 'Five', 'Eleven', 'Two', 'One', 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
