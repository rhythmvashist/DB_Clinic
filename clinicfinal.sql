-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2018 at 08:27 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `userid` int(11) NOT NULL,
  `docid` int(11) NOT NULL,
  `appointmentTime` varchar(20) NOT NULL,
  `appointmentDate` date NOT NULL,
  `appointmentDay` varchar(20) NOT NULL,
  `room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buys`
--

CREATE TABLE `buys` (
  `buysuserid` int(11) NOT NULL,
  `buysmedid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buys`
--

INSERT INTO `buys` (`buysuserid`, `buysmedid`) VALUES
(1, 9),
(2, 4),
(3, 3),
(4, 7),
(5, 1),
(6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `docavailability`
--

CREATE TABLE `docavailability` (
  `Docid` int(11) NOT NULL,
  `Docdate` date NOT NULL,
  `Doctime` varchar(50) NOT NULL,
  `Docday` varchar(20) NOT NULL,
  `Booked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docavailability`
--

INSERT INTO `docavailability` (`Docid`, `Docdate`, `Doctime`, `Docday`, `Booked`) VALUES
(3, '2018-12-03', '10:00-12:00', 'Monday', 0),
(4, '2018-12-03', '12:30-1:30', 'Monday', 0),
(6, '2018-12-04', '12:00-1:00', 'Tuesday', 0),
(6, '2018-12-05', '10:00-12:00', 'Wednesday', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `docid` int(11) NOT NULL,
  `docName` varchar(50) NOT NULL,
  `docPassword` varchar(50) NOT NULL,
  `docType` varchar(100) NOT NULL,
  `docInfo` text NOT NULL,
  `docImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docName`, `docPassword`, `docType`, `docInfo`, `docImage`) VALUES
(1, 'Bita Shahir', '123456', 'Physician', 'Doctor Bita Shahir has been with DB clinic for 8 years now. She has been working as a Physician for 15 years. Bita is a great part of our team, because she cares so much about her patients and will never stop trying to help them. ', 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e813f4a3445aa82520e6172bed73ab1d&auto=format&fit=crop&w=1035&q=80'),
(2, 'Robert Blaine', '123456', 'Dentist', 'Doctor Robert Blaine specializes in Orthodontics and Dental Public health. Robert is a great addition to our team, working with DB clinic since 2012.', 'https://images.pexels.com/photos/325682/pexels-photo-325682.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260'),
(3, 'Jack Nichols', '123456', 'Cardiologist', 'Doctor Jack Nichols is the top cardiologist in the city. Jack Nichols is the head of the department and has been a loyal partner with us for years. With 34 years of experience, Doctor Nichols has never let us down.', 'https://images.pexels.com/photos/263210/pexels-photo-263210.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(4, 'Amy Adams', '123456', 'Pediatrician', 'Doctor Amy Adams is the doctor you want for your kids. Doctor Adams finished top of her class at Stanford University, then doing her residency at John Hopkins. We are pleased to have Amy working with us.', 'https://images.pexels.com/photos/371941/pexels-photo-371941.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(5, 'Nicholas Andrews ', '123456', 'Pharmacist ', 'Every great clinic needs a great pharmacy. This is why we are so happy to have Nicholas Andrews working with us. ', 'https://images.unsplash.com/photo-1511174511562-5f7f18b874f8?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=065b8114449e0f336f7bba21215c8414&auto=format&fit=crop&w=750&q=80'),
(6, 'Suz Nikkole', '123456', 'Cardiologist', 'Doctor Suk Nikkole is a Cardiologist specializing in Oncology. Devoted to her family and her job, Suk Nikkole is an amazing woman, winning a Nobel Prize for her contributions to Cardiology.', 'https://images.unsplash.com/photo-1536693658748-7c486242f817?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=a807e8347cd9bd795697b0f74c96628c&auto=format&fit=crop&w=1952&q=80');

-- --------------------------------------------------------

--
-- Table structure for table `illness_description`
--

CREATE TABLE `illness_description` (
  `illness_names` varchar(50) NOT NULL,
  `illness_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `illness_description`
--

INSERT INTO `illness_description` (`illness_names`, `illness_desc`) VALUES
('Asthma', 'Trouble breathing'),
('Bronchitis', 'Cough/Chest pains'),
('Heart arrhythmia', 'Fast heart beat'),
('Migraine ', 'Severe head pains'),
('Pneumonia', 'Fever, high temperature'),
('Tachychardia', 'Fast heart beat');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_info`
--

CREATE TABLE `medicine_info` (
  `MedID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Cost` int(11) DEFAULT NULL,
  `Info` varchar(300) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `medImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_info`
--

INSERT INTO `medicine_info` (`MedID`, `Name`, `Cost`, `Info`, `quantity`, `medImage`) VALUES
(1, 'Advil', 11, 'Pain relief Medication', 5, 'https://images.samsclubresources.com/is/image/samsclub/0030573015460_A?$img_size_380x380$'),
(2, 'Tylenol', 10, 'Pain relief Medication', 5, 'https://i5.walmartimages.ca/images/Large/919/495/6000197919495.jpg'),
(3, 'Aspirin', 12, 'Pain relief Medication', 0, 'https://i5.walmartimages.ca/images/Large/000/514/999999-56500000514.jpg'),
(4, 'Cough Syrup', 12, 'Cough Medication', 0, 'https://www.m-medix.com/2585-large_default/robitussin-chesty-cough-syrup-100ml.jpg'),
(5, 'Ibuprofen', 12, 'Pain relief Medication', 2, 'https://i5.walmartimages.com/asr/a3845763-4567-44c3-b627-d9038403aafc_1.96cd302fe46a6e39e420dafd150a71ac.jpeg?odnHeight=450&odnWidth=450&odnBg=FFFFFF'),
(6, 'Cold FX', 17, 'Cold/Flu Medication', 3, 'https://images-na.ssl-images-amazon.com/images/I/41RwHrzFbgL.jpg'),
(7, 'Vicks VapoRub', 20, 'Cold/Flu Medication', 3, 'https://images-na.ssl-images-amazon.com/images/I/71ePzeCqT7L._SL1500_.jpg'),
(8, 'NyQuil Cold and Flu', 22, 'Cold/Flu Medication', 3, 'https://azcdn.genesis.pgsitecore.com/en-us/-/media/Vicks/Images/Products/US/DayQuil%20Cold%20Flu/NyQuil%20HBP%20cold%20Flu%20Liquicaps/ABC_34_01.jpg?h=2500&la=en-US&w=2500&v=1-201707041838'),
(9, 'Benadryl Allergy', 13, 'Allergy Medication', 1, 'https://target.scene7.com/is/image/Target/GUEST_13dcad8b-3150-4099-9c2d-2b00ecb69765?wid=488&hei=488&fmt=pjpeg'),
(10, 'Cepacol Extra Strength', 8, 'Sore throat lozenges, relieves sore throat pain, soothes cough  ', 8, 'https://pics.drugstore.com/prodimg/369986/900.jpg'),
(11, 'Throat Coat', 7, 'Soothes sore throat, medicinal tea for throat health, relieves cough ', 0, 'https://images-na.ssl-images-amazon.com/images/I/61amixJdAML.jpg'),
(12, 'Vicks Nasal Spray', 8, 'Reduces the chance of developing a cold or flu, get rid of tickly throat and runny nose ', 4, 'https://azcdn.genesis.pgsitecore.com/en-gb/-/media/Vicks_GB/Assets/Desktop/Products_All/Product_Detail_Page/Packshots/Large/06_VICKS_FIRST_DEFENCE_NASAL_SPRAY.png?w=460&v=1-201605131145'),
(13, 'Medical Digital Thermometer', 6, 'For oral or under the armpit use. Digital fever thermometer ', 5, 'https://images-na.ssl-images-amazon.com/images/I/31XHiry5A1L._SL500_AC_SS350_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `medID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `arrivalDate` date NOT NULL,
  `quantity` int(11) DEFAULT '1',
  `DeliveryAddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `medID`, `userID`, `arrivalDate`, `quantity`, `DeliveryAddress`) VALUES
(1, 1, 4, '2018-11-26', 1, '123 Fraser Street, Vancouver BC'),
(2, 7, 4, '2018-11-29', 2, '123 Fraser Street, Vancouver BC'),
(3, 9, 4, '2018-11-08', 1, '123 Fraser Street, Vancouver BC'),
(9, 1, 4, '0000-00-00', 1, '123 Fraser Street, Vancouver BC'),
(10, 1, 1, '2018-11-24', 4, '100 Main Street, Vancouver BC'),
(11, 1, 1, '2018-11-24', 4, '100 Main Street, Vancouver BC'),
(12, 1, 1, '2018-11-24', 2, '100 Main Street, Vancouver BC'),
(13, 3, 1, '2018-12-04', 2, '100 Main Street, Vancouver BC'),
(14, 4, 1, '2018-12-04', 2, '100 Main Street, Vancouver BC');

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `userID` int(11) NOT NULL,
  `cardNumber` int(11) DEFAULT NULL,
  `cvv` int(11) NOT NULL,
  `expiryDate` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`userID`, `cardNumber`, `cvv`, `expiryDate`) VALUES
(1, 453952558, 446, '2020-01-01'),
(3, 558960266, 292, '2020-06-01'),
(4, 601185486, 743, '2019-01-01'),
(6, 123, 123, '123');

-- --------------------------------------------------------

--
-- Table structure for table `suggest`
--

CREATE TABLE `suggest` (
  `medName` varchar(50) NOT NULL,
  `medInfo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suggest`
--

INSERT INTO `suggest` (`medName`, `medInfo`) VALUES
('crosin', 'coroslkdjf  lakjsd flk'),
('run', 'redo');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPassword` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `userName`, `userPassword`, `email`, `address`) VALUES
(1, 'Kathy', '123456', 'kathy@gmail.com', '100 Main Street, Vancouver BC'),
(2, 'Jane', '123456', 'jane@gmail.com', '2970 King George Blvd\r\nSurrey, BC'),
(3, 'John', '123456', 'john@gmail.com', '4225 Cambie Street, Vancouver BC'),
(4, 'Bob', '123456', 'bob@gmail.com', '123 Fraser Street, Vancouver BC'),
(5, 'Leila', '123456', 'leila@gmail.com', '800 Columbia Street\r\nNew Westminster, BC'),
(6, 'Hans', '123456', 'hans@gmail.com', '32 maywood street'),
(7, 'amrit', '123456', 'amrit@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_illness`
--

CREATE TABLE `user_illness` (
  `userid` int(11) NOT NULL,
  `illness_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_illness`
--

INSERT INTO `user_illness` (`userid`, `illness_name`) VALUES
(1, 'Asthma'),
(2, 'Bronchitis'),
(3, 'Heart arrhythmia'),
(5, 'Migraine '),
(6, 'Pneumonia'),
(4, 'Tachychardia');

-- --------------------------------------------------------

--
-- Table structure for table `workas`
--

CREATE TABLE `workas` (
  `medid` int(11) NOT NULL,
  `pharmid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workas`
--

INSERT INTO `workas` (`medid`, `pharmid`) VALUES
(5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`docid`,`appointmentTime`,`appointmentDate`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `buys`
--
ALTER TABLE `buys`
  ADD PRIMARY KEY (`buysuserid`,`buysmedid`),
  ADD KEY `foreign` (`buysmedid`);

--
-- Indexes for table `docavailability`
--
ALTER TABLE `docavailability`
  ADD PRIMARY KEY (`Docid`,`Docdate`,`Doctime`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`docid`);

--
-- Indexes for table `illness_description`
--
ALTER TABLE `illness_description`
  ADD PRIMARY KEY (`illness_names`);

--
-- Indexes for table `medicine_info`
--
ALTER TABLE `medicine_info`
  ADD PRIMARY KEY (`MedID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `medID` (`medID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `suggest`
--
ALTER TABLE `suggest`
  ADD PRIMARY KEY (`medName`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user_illness`
--
ALTER TABLE `user_illness`
  ADD PRIMARY KEY (`illness_name`,`userid`),
  ADD KEY `foreign key` (`userid`);

--
-- Indexes for table `workas`
--
ALTER TABLE `workas`
  ADD KEY `medid` (`medid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`docid`) REFERENCES `docavailability` (`Docid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `buys`
--
ALTER TABLE `buys`
  ADD CONSTRAINT `buys_ibfk_1` FOREIGN KEY (`buysuserid`) REFERENCES `user_illness` (`userid`),
  ADD CONSTRAINT `foreign` FOREIGN KEY (`buysmedid`) REFERENCES `medicine_info` (`MedID`);

--
-- Constraints for table `docavailability`
--
ALTER TABLE `docavailability`
  ADD CONSTRAINT `docavailability_ibfk_1` FOREIGN KEY (`Docid`) REFERENCES `doctor` (`docid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`medID`) REFERENCES `medicine_info` (`MedID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD CONSTRAINT `payment_info_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_illness`
--
ALTER TABLE `user_illness`
  ADD CONSTRAINT `foreign key` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `user_illness_ibfk_1` FOREIGN KEY (`illness_name`) REFERENCES `illness_description` (`illness_names`);

--
-- Constraints for table `workas`
--
ALTER TABLE `workas`
  ADD CONSTRAINT `workas_ibfk_1` FOREIGN KEY (`medid`) REFERENCES `doctor` (`docid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
