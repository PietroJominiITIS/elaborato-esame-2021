-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2021 at 10:41 AM
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

--
-- Dumping data for table `Box`
--

INSERT INTO `Box` (`BoxId`, `CaseT`, `Location`, `ArchivingDate`, `DeletionDate`) VALUES
(15, 20, 'TO', '2021-05-31', NULL),
(16, 22, 'CN', '2021-05-31', NULL),
(17, 22, 'TO', '2021-06-01', NULL),
(18, 20, 'CN', '2021-05-25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `CaseOutcome`
--

CREATE TABLE `CaseOutcome` (
  `Name` varchar(20) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CaseOutcome`
--

INSERT INTO `CaseOutcome` (`Name`, `Description`) VALUES
('Acquitted', 'The accused has been aquitted'),
('Condemned', 'The accused has been condamned');

-- --------------------------------------------------------

--
-- Table structure for table `CaseStatus`
--

CREATE TABLE `CaseStatus` (
  `Name` varchar(20) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CaseStatus`
--

INSERT INTO `CaseStatus` (`Name`, `Description`) VALUES
('Canceled', 'The case is no longer active'),
('First', 'akes place before the court'),
('Preliminary', 'Preliminary stage'),
('Second', 'Takes place before the court of appeal'),
('Third', 'Takes place in cassation');

-- --------------------------------------------------------

--
-- Table structure for table `CaseT`
--

CREATE TABLE `CaseT` (
  `CaseId` int(11) NOT NULL,
  `Court` varchar(2) NOT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `Outcome` varchar(20) DEFAULT NULL,
  `Crime` text NOT NULL,
  `Year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CaseT`
--

INSERT INTO `CaseT` (`CaseId`, `Court`, `Status`, `Outcome`, `Crime`, `Year`) VALUES
(20, 'TO', NULL, NULL, 'TO Crime', 2021),
(21, 'TO', NULL, NULL, 'TO Crime no Box', 2021),
(22, 'CN', NULL, NULL, 'CN Crime', 2021),
(23, 'CN', NULL, NULL, 'CN Crime no Box', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `Court`
--

CREATE TABLE `Court` (
  `Location` varchar(2) NOT NULL,
  `Name` text NOT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Court`
--

INSERT INTO `Court` (`Location`, `Name`, `Password`) VALUES
('AL', 'Alessandria', 'e892e780304dc3ef15e69b9f3fed3669'),
('AT', 'Asti', 'fa868488740aa25870ced6b9169951fb'),
('BI', 'Biella', 'af7f0273997b9b290bd7c57aa19f36c2'),
('CN', 'Cuneo', '1c2903397d8833382673bab22aa8b937'),
('NO', 'Novara', 'c2f3f489a00553e7a01d369c103c7251'),
('TO', 'Torino', '304917b92bc3dc0953aab8356f74c02c'),
('VB', 'Verbania', '952e108649eee4b686c2431edc8fcd17'),
('VC', 'Vercelli', 'b7128ad1d9b838be26989d1037a8c987');

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

--
-- Dumping data for table `Document`
--

INSERT INTO `Document` (`DocumentId`, `Box`, `Type`, `Description`, `AcquisitionDate`) VALUES
(7, 15, 'Letter', 'TO 1 Document', '2021-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `DocumentType`
--

CREATE TABLE `DocumentType` (
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DocumentType`
--

INSERT INTO `DocumentType` (`Name`) VALUES
('Letter'),
('Photo'),
('Receipt');

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

--
-- Dumping data for table `Evidence`
--

INSERT INTO `Evidence` (`EvidenceId`, `Box`, `Description`, `AcquisitionDate`, `Label`) VALUES
(8, 15, 'TO 1 Evidence', '2021-05-31', 'TO Evidence'),
(9, 17, 'CN 2 Evidence', '2021-05-31', 'Will be transferred with the whole box');

-- --------------------------------------------------------

--
-- Table structure for table `Paper`
--

CREATE TABLE `Paper` (
  `PaperId` int(11) NOT NULL,
  `Box` int(11) NOT NULL,
  `Place` text NOT NULL,
  `PersonCF` varchar(16) NOT NULL,
  `RegistrationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Paper`
--

INSERT INTO `Paper` (`PaperId`, `Box`, `Place`, `PersonCF`, `RegistrationDate`) VALUES
(4, 15, 'TO 1 Paper', '---', '2021-05-31'),
(5, 18, 'TO Paper to be transferred with the whole box', '---', '2021-05-11');

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

--
-- Dumping data for table `Report`
--

INSERT INTO `Report` (`ReportId`, `Box`, `Place`, `Date`) VALUES
(1, 15, 'TO 1 Report', '2021-05-31'),
(2, 16, 'CN 2 Report', '2021-05-31');

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
  `DepartureTime` date DEFAULT NULL,
  `ArrivalTime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Transition`
--

INSERT INTO `Transition` (`TransitionId`, `Box`, `FromL`, `ToL`, `Status`, `DepartureTime`, `ArrivalTime`) VALUES
(19, 17, 'CN', 'TO', 'Completed', NULL, '2021-05-31'),
(20, 18, 'TO', 'CN', 'Completed', NULL, '2021-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `TransitionStatus`
--

CREATE TABLE `TransitionStatus` (
  `Name` varchar(20) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TransitionStatus`
--

INSERT INTO `TransitionStatus` (`Name`, `Description`) VALUES
('Accepted', ''),
('Completed', ''),
('Requested', ''),
('Transiting', '');

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
  ADD KEY `Type` (`Type`),
  ADD KEY `Document_ibfk_1` (`Box`);

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
  ADD KEY `Evidence_ibfk_1` (`Box`);

--
-- Indexes for table `Paper`
--
ALTER TABLE `Paper`
  ADD PRIMARY KEY (`PaperId`),
  ADD KEY `Paper_ibfk_1` (`Box`);

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
  ADD KEY `FromL` (`FromL`),
  ADD KEY `Transition_ibfk_3` (`ToL`),
  ADD KEY `Status` (`Status`),
  ADD KEY `Transition_ibfk_1` (`Box`);

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
  MODIFY `BoxId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `CaseT`
--
ALTER TABLE `CaseT`
  MODIFY `CaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `Document`
--
ALTER TABLE `Document`
  MODIFY `DocumentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Evidence`
--
ALTER TABLE `Evidence`
  MODIFY `EvidenceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Paper`
--
ALTER TABLE `Paper`
  MODIFY `PaperId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Report`
--
ALTER TABLE `Report`
  MODIFY `ReportId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Transition`
--
ALTER TABLE `Transition`
  MODIFY `TransitionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `Paper_ibfk_1` FOREIGN KEY (`Box`) REFERENCES `Box` (`BoxId`);

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
