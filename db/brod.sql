-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 07:07 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `brod-revised`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
`actId` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `clubId` int(11) NOT NULL,
  `actName` text NOT NULL,
  `description` text NOT NULL,
  `note` text NOT NULL,
  `actDate` varchar(20) NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`actId`, `user_Id`, `type`, `clubId`, `actName`, `description`, `note`, `actDate`, `date_added`) VALUES
(2, 0, '', 0, 'Activity 5', '', '', '2022-12-23', ''),
(3, 0, '', 0, 'Activity 3', '', '', '2022-12-10', '2022-12-11'),
(4, 0, '', 0, 'Activity 2', '', '', '2022-12-11', '2022-12-11'),
(5, 0, '', 0, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.', '', '', '2022-12-11', '2022-12-11'),
(6, 0, '', 0, 'sample', '', '', '2022-12-27', '2022-12-27'),
(8, 0, '', 0, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.', '', '', '2023-03-30', '2022-12-27'),
(9, 80, '', 4, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.', '', '', '2023-03-30', '2023-03-02'),
(10, 80, '', 4, 'samlpesample', '', '', '2023-03-02', '2023-03-02'),
(11, 80, '', 4, 'announcement', '', '', '2023-03-20', '2023-03-01'),
(12, 80, 'Event', 4, 'Titles123', 'Descriptions123', 'Optionals123', '2023-04-14', '2023-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`attendanceId` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `eventName` varchar(255) NOT NULL,
  `TimeIn` varchar(50) NOT NULL,
  `date_added` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceId`, `user_Id`, `eventName`, `TimeIn`, `date_added`) VALUES
(6, 81, '1', '17:37', '2023-03-01'),
(7, 67, 'Sample', '18:11', '2023-03-01'),
(8, 72, 'Sample2', '18:12', '2023-03-01'),
(9, 75, 'Sample3', '18:12', '2023-03-01'),
(10, 76, 'Sample4', '18:12', '2023-03-01'),
(11, 91, 'sample1', '15:50', '2023-03-22'),
(12, 93, 'sample2', '15:52', '2023-03-22'),
(13, 85, '2', '14:30', '2023-04-08'),
(14, 86, '3', '14:31', '2023-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE IF NOT EXISTS `club` (
`clubId` int(11) NOT NULL,
  `addedBy` int(11) NOT NULL,
  `clubName` varchar(255) NOT NULL,
  `clubAddress` varchar(255) NOT NULL,
  `clubDescription` varchar(255) NOT NULL,
  `clubStatus` varchar(50) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Approved, 2=Denied',
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`clubId`, `addedBy`, `clubName`, `clubAddress`, `clubDescription`, `clubStatus`, `date_added`) VALUES
(4, 80, 'Team Honda XRM', 'ds', 's', '1', '2023-02-14'),
(8, 0, 'dsadadad', '', '', '2', '2023-03-14'),
(9, 0, 'Club 1', '', '', '1', '2023-03-21'),
(10, 0, 'Club 2', '', '', '1', '2023-03-21'),
(11, 0, 'Club 4', '', '', '1', '2023-03-21'),
(14, 0, 'Club 5', '', '', '1', '2023-03-22'),
(17, 0, 'club 6', '', '', '1', '2023-03-23'),
(18, 0, 'fdsg', '', '', '0', '2023-03-29'),
(19, 0, 'fds', '', 'sd', '0', '2023-03-29'),
(20, 0, 'gfdd', 'gdfgdfg', 'fdgdfgd', '0', '2023-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `clubactivity`
--

CREATE TABLE IF NOT EXISTS `clubactivity` (
`act_Id` int(11) NOT NULL,
  `club_Id` int(11) NOT NULL,
  `club_Officer_Id` int(11) NOT NULL,
  `description` text NOT NULL,
  `venue` varchar(255) NOT NULL,
  `activity_date` varchar(50) NOT NULL,
  `activity_time` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `clubactivity`
--

INSERT INTO `clubactivity` (`act_Id`, `club_Id`, `club_Officer_Id`, `description`, `venue`, `activity_date`, `activity_time`, `date_created`) VALUES
(1, 10, 80, 'Activty2', 'Venue2', '2023-04-21', '17:30', '2023-04-08 05:37:11'),
(2, 10, 66, 'fdsfsf123aa', 'fdsfsfsd123aa', '2023-04-04', '20:13', '2023-04-09 12:09:02'),
(3, 10, 66, 'gfdg', 'dfgdfgdf', '2023-04-11', '20:27', '2023-04-09 12:23:05'),
(4, 17, 66, 'gfdg', 'dfgdfgdf', '2023-04-05', '20:27', '2023-04-09 12:23:17'),
(5, 17, 66, 'Sasa', 'Sasa', '2023-04-11', '20:27', '2023-04-09 12:24:22'),
(6, 10, 66, 'gfdgdgdf', 'gdfgdgdf', '2023-04-06', '20:28', '2023-04-09 12:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
`commentId` int(11) NOT NULL,
  `announcementId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `announcementId`, `userId`, `comment`, `date_added`) VALUES
(1, 8, 66, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.', ''),
(2, 9, 67, 'Lorem ipsum, dolor ', ''),
(3, 8, 67, 'Test', '2022-12-31'),
(4, 8, 67, 'HAHA', '2022-12-31'),
(5, 8, 67, 'GEGE', '2022-12-31'),
(6, 8, 67, 'gsgs', '2022-12-31'),
(7, 8, 67, 'gfg', '2022-12-31'),
(8, 8, 66, 'Test124', '2023-01-01'),
(9, 8, 67, 'Test123', '2023-01-01'),
(10, 8, 67, 'Test12345', '2023-01-01'),
(11, 8, 80, 'GAGA', '2023-01-02'),
(12, 8, 80, 'Testtest', '2023-01-03'),
(13, 9, 92, 'nice', '2023-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `customization`
--

CREATE TABLE IF NOT EXISTS `customization` (
`customID` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'Inactive',
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `customization`
--

INSERT INTO `customization` (`customID`, `picture`, `status`, `date_added`) VALUES
(19, '2.jpg', 'Inactive', '2022-12-27'),
(20, '321419245_822226208885120_3065306908583075774_n.jpg', 'Inactive', '2023-03-21'),
(21, '336185018_578456240997789_2230463751654843250_n.jpg', 'Active', '2023-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`event_Id` int(11) NOT NULL,
  `route_Id` int(11) NOT NULL,
  `event_desc` text NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `club_Officer_Id` int(11) NOT NULL,
  `date_event_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_Id`, `route_Id`, `event_desc`, `event_type`, `club_Officer_Id`, `date_event_added`) VALUES
(1, 0, 'sample 11', 'type 11', 66, '2023-04-09 06:03:25'),
(3, 0, 'as', 'ddsa', 66, '2023-04-09 06:17:22'),
(4, 0, 'fdsf', 'sdfsdsdfsd', 66, '2023-04-09 06:17:29'),
(5, 0, 'gfdgd', 'gdfgdfgfd', 66, '2023-04-09 06:45:37'),
(6, 0, 'gfg', 'dgdgdfgd', 66, '2023-04-09 06:45:47'),
(7, 4, 'sample', 'sample', 66, '2023-04-09 12:55:54'),
(8, 5, 'dsadsa', 'dsadasdas', 66, '2023-04-09 12:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE IF NOT EXISTS `incident` (
`incidentId` int(11) NOT NULL,
  `reporterId` int(11) NOT NULL,
  `incidentLocation` text NOT NULL,
  `dateOccurence` varchar(100) NOT NULL,
  `timeOccurence` varchar(100) NOT NULL,
  `incidentDescription` text NOT NULL,
  `incidentinjuries` text NOT NULL,
  `incidentStatus` int(11) NOT NULL DEFAULT '0' COMMENT '0=Unverified, 1=Verified',
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`incidentId`, `reporterId`, `incidentLocation`, `dateOccurence`, `timeOccurence`, `incidentDescription`, `incidentinjuries`, `incidentStatus`, `date_added`) VALUES
(2, 80, 'fdsf', '2022-12-16', '19:15', 'fdg', 'gfdgfd', 1, '2022-12-30'),
(3, 81, 'gfdgdf', '2022-12-16', '19:19', 'gfdgf', 'dgdfgdf', 2, '2022-12-30'),
(4, 86, 'fdsfsfsd', '2023-01-26', '19:00', 'fsdfsf', 'sdfsdfs', 1, '2023-01-01'),
(5, 83, 'fds', '2023-01-02', '17:43', 'fgfd', 'gfd', 2, '2023-01-03'),
(6, 82, 'fsd', '2023-01-13', '17:59', 'fdsf', 'sfsd', 0, '2023-01-03'),
(7, 85, 'dsadsad', '2023-03-07', '18:40', 'dsfds', '', 2, '2023-03-01'),
(8, 66, 'Panglao', '2023-03-21', '17:42', 'bangga motor', '', 1, '2023-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `personinvolved`
--

CREATE TABLE IF NOT EXISTS `personinvolved` (
`involvedId` int(11) NOT NULL,
  `reporterId` int(11) NOT NULL,
  `personInvolved` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `personinvolved`
--

INSERT INTO `personinvolved` (`involvedId`, `reporterId`, `personInvolved`, `position`, `date_added`) VALUES
(1, 67, 'fdsfsdfsf', 'fdsfsdfsdd', '2023-01-01'),
(2, 67, 'fdsfsdfsfsffds', 'fsdfs', '2023-01-01'),
(3, 80, 'fdsf', 'ds', '2023-01-03'),
(4, 80, 'fdf', 'dsf', '2023-01-03'),
(5, 80, 'ds', 'adsadas', '2023-03-01'),
(6, 80, 'morata', 'officer', '2023-03-22'),
(7, 80, 'emariwn', 'member', '2023-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `requestletter`
--

CREATE TABLE IF NOT EXISTS `requestletter` (
`requestId` int(11) NOT NULL,
  `requestedby` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `fileType` varchar(255) NOT NULL,
  `fileSize` varchar(255) NOT NULL,
  `requestStatus` varchar(255) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Approved, 2=Denied',
  `date_added` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `date_approved` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `requestletter`
--

INSERT INTO `requestletter` (`requestId`, `requestedby`, `event_title`, `file`, `fileType`, `fileSize`, `requestStatus`, `date_added`, `reason`, `date_approved`) VALUES
(1, 76, 'Event1', 'brod-officer-scopes.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '', '1', '2023-01-04', '', ''),
(2, 80, 'Event2', 'brod-officer-scopes.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '', '2', '2023-01-04', '', ''),
(3, 80, 'Event3', '18221-brod-officer-scopes.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '', '1', '2023-01-04', '', '2023-04-09'),
(4, 80, 'Event4', '26046-brgy-bugs.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '', '1', '2023-01-04', 'HALA KA', '2023-04-09'),
(5, 80, 'Event5', '67477-drivers-violation-additional-features.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '', '1', '2023-01-04', '', '2023-04-09'),
(6, 80, 'Event6', '10272-changees.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '', '1', '2023-03-29', 'Bagay lang', '2023-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `ride_comments`
--

CREATE TABLE IF NOT EXISTS `ride_comments` (
`comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ride_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_commented` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ride_comments`
--

INSERT INTO `ride_comments` (`comment_id`, `user_id`, `ride_id`, `comment`, `date_commented`) VALUES
(1, 66, 7, 'Sample comment', '2023-04-10 04:46:42'),
(2, 66, 7, 'Sample comment2', '2023-04-10 05:02:44'),
(3, 80, 6, 'Sample comment3', '2023-04-10 05:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `ride_direction`
--

CREATE TABLE IF NOT EXISTS `ride_direction` (
`ride_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `startingPoint` text NOT NULL,
  `firstStop` text NOT NULL,
  `secondStop` text NOT NULL,
  `thirdStop` text NOT NULL,
  `destination` text NOT NULL,
  `rideDate` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ride_direction`
--

INSERT INTO `ride_direction` (`ride_id`, `added_by`, `startingPoint`, `firstStop`, `secondStop`, `thirdStop`, `destination`, `rideDate`) VALUES
(1, 0, 'test1234', 'ww', 'ee', 'rr', 'test', '2023-01-06'),
(3, 0, 'tagbi', 'dauis', '', '', 'panglao', '2023-01-11'),
(4, 0, 'fdsf', 'f', '', 'fdsf', '43', '2023-01-11'),
(5, 0, 'fdsfs', '', 'fdsf', 'sfsdfs', 'fds', '2023-01-05'),
(6, 80, 'fdsf', 'sdfsf', 'dsfsdfds', '', 'fsdfs', '2023-01-14'),
(7, 66, 'fdsf', 'dsfs', 'fsf', 'sfsd', 'fds', '2023-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_Id` int(11) NOT NULL,
  `club` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'user.png',
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'Member',
  `user_status` varchar(20) NOT NULL DEFAULT '0' COMMENT '0=Inactive, 1=Active',
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Approved, 2=Denied',
  `verification_code` int(11) NOT NULL,
  `date_registered` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `club`, `firstname`, `middlename`, `lastname`, `suffix`, `dob`, `age`, `email`, `contact`, `birthplace`, `gender`, `civilstatus`, `occupation`, `religion`, `house_no`, `street_name`, `purok`, `zone`, `barangay`, `municipality`, `province`, `region`, `image`, `password`, `user_type`, `user_status`, `account_status`, `verification_code`, `date_registered`) VALUES
(66, 4, 'BROD', 'C', 'Officer C', '3', '1997-09-22', '25 years old', 'admin@gmail.com', '9359428963', 'Poblacion, Medellin, Cebu', 'Male', 'Married', 'Web developer', 'Bible Baptist Church', '1234', 'Sitio Upper Landing', 'Purok San Isidro', 'Ambot', 'Daanlungsod', 'Medellin', '', 'VII', '13.jpg', '0192023a7bbd73250516f069df18b500', 'BROD', '1', 1, 374025, '2022-11-25'),
(80, 9, 'Club C', '', 'Officer', '', '2023-01-01', '1 day old', 'clubCOfficer@gmail.com', '9123456789', '3', 'Male', 'Widow/ER', 'Alright', 'Evangelical Christianity', '3', '3', '3', '3', '3', '3', '', '3', 'academia.png', '0192023a7bbd73250516f069df18b500', 'CLUB', '1', 1, 0, '2023-01-02'),
(81, 9, 'Club A', '', 'Officer', '', '2003-06-12', '19 years old', 'clubAofficer@gmail.com', '9506365264', '1', 'Male', 'Single', '1', 'Other Religion', '1', '1', '1', '1', '1', '1', '1', '1', '3.jpg', '0192023a7bbd73250516f069df18b500', 'CLUB', '0', 2, 0, '2023-03-21'),
(82, 10, 'Club B', '', 'Officer', '', '2000-06-08', '22 years old', 'clubBofficer@gmail.com', '9506365297', '2', 'Male', 'Single', '2', 'Other Religion', '2', '2', '2', '2', '2', '2', '2', '2', '2.jpg', '0192023a7bbd73250516f069df18b500', 'CLUB', '1', 0, 0, '2023-03-21'),
(83, 11, 'Club D', '', 'Officer', '', '1999-03-10', '24 years old', 'clubDofficer@gmail.com', '9562319852', '4', 'Female', 'Widow/ER', '4', 'Other Religion', '4', '4', '4', '4', '4', '4', '4', '4', '14.jpg', '0192023a7bbd73250516f069df18b500', 'CLUB', '1', 1, 0, '2023-03-21'),
(84, 12, 'Club E', '', 'Officer', '', '1998-06-25', '24 years old', 'clubEofficer@gmail.com', '9564985294', '5', 'Female', 'Married', '5', 'Methodist', '5', '5', '5', '5', '5', '5', '5', '5', '24.jpg', '0192023a7bbd73250516f069df18b500', 'CLUB', '1', 0, 0, '2023-03-21'),
(85, 9, 'Member A', '', 'Pajente', '', '2014-11-16', '8 years old', 'memberA@gmail.com', '9506326592', '1', 'Male', 'Single', '1', 'Other Religion', '1', '1', '1', '1s', '1', '1', '1', '1', 'HAROS logo.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '1', 1, 0, '2023-03-21'),
(86, 9, 'Member A', '', 'Morata', '', '2017-06-21', '5 years old', 'memberA1@gmail.com', '9526192162', '1', 'Female', 'Single', '1', 'Islam', '1', '1', '1', '1', '1', '1', '1', '1', '4.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 1, 0, '2023-03-21'),
(87, 9, 'Member A', '', 'Salva', '', '2021-06-10', '1 year old', 'memberA2@gmail.com', '9562195278', '1', 'Male', 'Separated', '1', 'Hindu', '1', '1', '1', '1', '1', '1', '1', '1', '12.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(88, 10, 'Member B', '', 'Pajente', '', '2020-02-05', '3 years old', 'memberB@gmail.com', '9561978462', '2', 'Male', 'Widow/ER', '2', 'Iglesia Ni Cristo', '2', '2', '2', '2', '2', '2', '2', '2', '2.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(89, 10, 'Member B', '', 'Morata', '', '2015-02-19', '8 years old', 'memberB1@gmail.com', '9136298292', '2', 'Female', 'Single', '2', 'Methodist', '2', '2', '2', '2', '2', '2', '2', '2', '14.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(90, 10, 'Member B', '', 'Salva', '', '2016-09-17', '6 years old', 'memberB2@gmail.com', '9616894284', '2', 'Male', 'Married', '2', 'Buddhist', '2', '2', '2', '2', '2', '2', '2', '2', '17.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(91, 4, 'Member C', '', 'Pajente', '', '2017-05-11', '5 years old', 'memberC@gmail.com', '9876543215', '3', 'Male', 'Single', '3', 'United Church of Christ in the Philippines', '3', '3', '3', '3', '3', '3', '3', '3', '4.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(92, 4, 'Member C', '', 'Morata', '', '2006-02-15', '17 years old', 'memberC1@gmail.com', '9561632559', '3', 'Female', 'Married', '3', 'Buddhist', '3', '3', '3', '3', '3', '3', '3', '3', 'minimalism-1644666519306-6515.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(93, 4, 'Member C', '', 'Salva', '', '2004-06-30', '18 years old', 'memberC2@gmail.com', '9865321472', '3', 'Male', 'Separated', '3', 'Jehovah''s Witnesses', '3', '3', '3', '3', '3', '3', '3', '3', 'academia.png', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(94, 11, 'Member D', '', 'Pajente', '', '2003-02-05', '20 years old', 'memberD@gmail.com', '9856326951', '4', 'Male', 'Separated', '4', 'Aglipayan', '4', '4', '4', '4', '4', '4', '4', '4', 'HAROS logo.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '1', 1, 0, '2023-03-21'),
(95, 11, 'Member D', '', 'Morata', '', '2001-07-04', '21 years old', 'memberD1@gmail.com', '9865333693', '4', 'Female', 'Widow/ER', '4', 'Protestants', '4', '4', '4', '4', '4', '4', '4', '4', 'Untitled-1.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(96, 11, 'Member D', '', 'Salva', '', '2021-06-26', '1 year old', 'memberD2@gmail.com', '9562326262', '4', 'Male', 'Separated', '4', 'Ang Dating Daan', '4', '4', '4', '4', '4', '4', '4', '4', '17.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(97, 12, 'Member E', '', 'Pajente', '', '2014-11-16', '8 years old', 'memberE@gmail.com', '9526262949', '5', 'Male', 'Single', '5', 'Other Religion', '5', '5', '5', '5', '5', '5', '5', '5', 'HAROS logo.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(98, 12, 'Member E', '', 'Morata', '', '2022-05-10', '10 months old', 'memberE1@gmail.com', '9506564988', '5', 'Female', 'Single', '5', 'United Church of Christ in the Philippines', '5', '5', '5', '5', '5', '5', '5', '5', '17.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(99, 12, 'Member E', '', 'Salva', '', '2023-03-03', '2 weeks old', 'memberE2@gmail.com', '9696969623', '5', 'Male', 'Widow/ER', '5', 'Jehovah''s Witnesses', '5', '5', '5', '5', '5', '5', '5', '5', '12.jpg', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-21'),
(100, 4, 'Emarwin', 'Pelonio', 'Pajente', '', '1999-10-04', '23 years old', 'emarwin@gmail.com', '9562326949', 'San Antonio Jasaan', 'Male', 'Single', 'gamer', 'Other Religion', '1', 'skina', 'ilaha', 'zero', 'Bahala', 'Panglao', 'Bohol', 'VII', 'AdminLTELogo.png', '0192023a7bbd73250516f069df18b500', 'Member', '0', 0, 0, '2023-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `witness`
--

CREATE TABLE IF NOT EXISTS `witness` (
`witnessId` int(11) NOT NULL,
  `reporterId` int(11) NOT NULL,
  `witnessName` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `witness`
--

INSERT INTO `witness` (`witnessId`, `reporterId`, `witnessName`, `date_added`) VALUES
(1, 67, 'fdsfsd', '2023-01-01'),
(2, 80, 'fds', '2023-01-03'),
(3, 80, 'fdsfsd', '2023-01-03'),
(4, 80, 'dsdsadsa', '2023-03-01'),
(5, 80, '', '2023-03-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
 ADD PRIMARY KEY (`actId`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`attendanceId`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
 ADD PRIMARY KEY (`clubId`);

--
-- Indexes for table `clubactivity`
--
ALTER TABLE `clubactivity`
 ADD PRIMARY KEY (`act_Id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `customization`
--
ALTER TABLE `customization`
 ADD PRIMARY KEY (`customID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`event_Id`);

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
 ADD PRIMARY KEY (`incidentId`);

--
-- Indexes for table `personinvolved`
--
ALTER TABLE `personinvolved`
 ADD PRIMARY KEY (`involvedId`);

--
-- Indexes for table `requestletter`
--
ALTER TABLE `requestletter`
 ADD PRIMARY KEY (`requestId`);

--
-- Indexes for table `ride_comments`
--
ALTER TABLE `ride_comments`
 ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `ride_direction`
--
ALTER TABLE `ride_direction`
 ADD PRIMARY KEY (`ride_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_Id`);

--
-- Indexes for table `witness`
--
ALTER TABLE `witness`
 ADD PRIMARY KEY (`witnessId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
MODIFY `actId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `attendanceId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
MODIFY `clubId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `clubactivity`
--
ALTER TABLE `clubactivity`
MODIFY `act_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `customization`
--
ALTER TABLE `customization`
MODIFY `customID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `event_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
MODIFY `incidentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `personinvolved`
--
ALTER TABLE `personinvolved`
MODIFY `involvedId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `requestletter`
--
ALTER TABLE `requestletter`
MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ride_comments`
--
ALTER TABLE `ride_comments`
MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ride_direction`
--
ALTER TABLE `ride_direction`
MODIFY `ride_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `witness`
--
ALTER TABLE `witness`
MODIFY `witnessId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
