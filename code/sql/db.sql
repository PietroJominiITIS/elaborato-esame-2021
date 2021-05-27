-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2021 at 07:58 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elaborato`
--

-- --------------------------------------------------------

--
-- Table structure for table `Box`
--

CREATE TABLE `Box` (
  `BoxId` int(11) NOT NULL,
  `CaseT` int(11) NOT NULL,
  `Location` varchar(2) NOT NULL,
  `ArchivingDate` date NOT NULL,
  `DeletionDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CaseOutcome`
--

CREATE TABLE `CaseOutcome` (
  `Name` varchar(20) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CaseStatus`
--

CREATE TABLE `CaseStatus` (
  `Name` varchar(20) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CaseT`
--

CREATE TABLE `CaseT` (
  `CaseId` int(11) NOT NULL,
  `Court` varchar(2) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Outcome` varchar(20) NOT NULL,
  `Crime` text NOT NULL,
  `Year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Court`
--

CREATE TABLE `Court` (
  `Location` varchar(2) NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Document`
--

CREATE TABLE `Document` (
  `DocumentId` int(11) NOT NULL,
  `Box` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Description` text NOT NULL,
  `AcquisitionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `DocumentType`
--

CREATE TABLE `DocumentType` (
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Evidence`
--

CREATE TABLE `Evidence` (
  `EvidenceId` int(11) NOT NULL,
  `Box` int(11) NOT NULL,
  `Description` text NOT NULL,
  `AcquisitionDate` date NOT NULL,
  `Label` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Paper`
--

CREATE TABLE `Paper` (
  `PaperId` int(11) NOT NULL,
  `Box` int(11) NOT NULL,
  `Place` text NOT NULL,
  `Person` varchar(16) NOT NULL,
  `RegistrationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `CF` varchar(16) NOT NULL,
  `Name` int(11) NOT NULL,
  `Surname` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Report`
--

CREATE TABLE `Report` (
  `ReportId` int(11) NOT NULL,
  `Box` int(11) NOT NULL,
  `Place` text NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Transition`
--

CREATE TABLE `Transition` (
  `TransitionId` int(11) NOT NULL,
  `Box` int(11) NOT NULL,
  `FromL` varchar(2) NOT NULL,
  `ToL` varchar(2) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `DepartureTime` date NOT NULL,
  `ArrivalTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TransitionStatus`
--

CREATE TABLE `TransitionStatus` (
  `Name` varchar(20) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Box`
--
ALTER TABLE `Box`
  ADD PRIMARY KEY (`BoxId`),
  ADD KEY `CaseT` (`CaseT`),
  ADD KEY `Location` (`Location`);

--
-- Indexes for table `CaseOutcome`
--
ALTER TABLE `CaseOutcome`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `CaseStatus`
--
ALTER TABLE `CaseStatus`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `CaseT`
--
ALTER TABLE `CaseT`
  ADD PRIMARY KEY (`CaseId`),
  ADD KEY `Status` (`Status`),
  ADD KEY `Outcome` (`Outcome`),
  ADD KEY `Court` (`Court`);

--
-- Indexes for table `Court`
--
ALTER TABLE `Court`
  ADD PRIMARY KEY (`Location`);

--
-- Indexes for table `Document`
--
ALTER TABLE `Document`
  ADD PRIMARY KEY (`DocumentId`),
  ADD KEY `Box` (`Box`),
  ADD KEY `Type` (`Type`);

--
-- Indexes for table `DocumentType`
--
ALTER TABLE `DocumentType`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `Evidence`
--
ALTER TABLE `Evidence`
  ADD PRIMARY KEY (`EvidenceId`),
  ADD KEY `Box` (`Box`);

--
-- Indexes for table `Paper`
--
ALTER TABLE `Paper`
  ADD PRIMARY KEY (`PaperId`),
  ADD KEY `Box` (`Box`),
  ADD KEY `Person` (`Person`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`CF`);

--
-- Indexes for table `Report`
--
ALTER TABLE `Report`
  ADD PRIMARY KEY (`ReportId`),
  ADD KEY `Box` (`Box`);

--
-- Indexes for table `Transition`
--
ALTER TABLE `Transition`
  ADD PRIMARY KEY (`TransitionId`),
  ADD KEY `Box` (`Box`),
  ADD KEY `FromL` (`FromL`),
  ADD KEY `Transition_ibfk_3` (`ToL`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `TransitionStatus`
--
ALTER TABLE `TransitionStatus`
  ADD PRIMARY KEY (`Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Box`
--
ALTER TABLE `Box`
  MODIFY `BoxId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CaseT`
--
ALTER TABLE `CaseT`
  MODIFY `CaseId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Document`
--
ALTER TABLE `Document`
  MODIFY `DocumentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Evidence`
--
ALTER TABLE `Evidence`
  MODIFY `EvidenceId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Paper`
--
ALTER TABLE `Paper`
  MODIFY `PaperId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Report`
--
ALTER TABLE `Report`
  MODIFY `ReportId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Transition`
--
ALTER TABLE `Transition`
  MODIFY `TransitionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Box`
--
ALTER TABLE `Box`
  ADD CONSTRAINT `Box_ibfk_1` FOREIGN KEY (`CaseT`) REFERENCES `CaseT` (`CaseId`),
  ADD CONSTRAINT `Box_ibfk_2` FOREIGN KEY (`Location`) REFERENCES `Court` (`Location`) ON UPDATE CASCADE;

--
-- Constraints for table `CaseT`
--
ALTER TABLE `CaseT`
  ADD CONSTRAINT `CaseT_ibfk_1` FOREIGN KEY (`Status`) REFERENCES `CaseStatus` (`Name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `CaseT_ibfk_2` FOREIGN KEY (`Outcome`) REFERENCES `CaseOutcome` (`Name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `CaseT_ibfk_3` FOREIGN KEY (`Court`) REFERENCES `Court` (`Location`) ON UPDATE CASCADE;

--
-- Constraints for table `Document`
--
ALTER TABLE `Document`
  ADD CONSTRAINT `Document_ibfk_1` FOREIGN KEY (`Box`) REFERENCES `Box` (`BoxId`),
  ADD CONSTRAINT `Document_ibfk_2` FOREIGN KEY (`Type`) REFERENCES `DocumentType` (`Name`) ON UPDATE CASCADE;

--
-- Constraints for table `Evidence`
--
ALTER TABLE `Evidence`
  ADD CONSTRAINT `Evidence_ibfk_1` FOREIGN KEY (`Box`) REFERENCES `Box` (`BoxId`);

--
-- Constraints for table `Paper`
--
ALTER TABLE `Paper`
  ADD CONSTRAINT `Paper_ibfk_1` FOREIGN KEY (`Box`) REFERENCES `Box` (`BoxId`),
  ADD CONSTRAINT `Paper_ibfk_2` FOREIGN KEY (`Person`) REFERENCES `Person` (`CF`);

--
-- Constraints for table `Report`
--
ALTER TABLE `Report`
  ADD CONSTRAINT `Report_ibfk_1` FOREIGN KEY (`Box`) REFERENCES `Box` (`BoxId`);

--
-- Constraints for table `Transition`
--
ALTER TABLE `Transition`
  ADD CONSTRAINT `Transition_ibfk_1` FOREIGN KEY (`Box`) REFERENCES `Box` (`BoxId`),
  ADD CONSTRAINT `Transition_ibfk_2` FOREIGN KEY (`FromL`) REFERENCES `Court` (`Location`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Transition_ibfk_3` FOREIGN KEY (`ToL`) REFERENCES `Court` (`Location`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Transition_ibfk_4` FOREIGN KEY (`Status`) REFERENCES `TransitionStatus` (`Name`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
