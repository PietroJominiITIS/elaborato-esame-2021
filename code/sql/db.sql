-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2021 at 07:36 PM
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
  `Location` text NOT NULL,
  `ArchivingDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CaseOutcome`
--

CREATE TABLE `CaseOutcome` (
  `Name` text NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CaseStatus`
--

CREATE TABLE `CaseStatus` (
  `Name` text NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CaseT`
--

CREATE TABLE `CaseT` (
  `CaseId` int(11) NOT NULL,
  `Court` text NOT NULL,
  `Status` text NOT NULL,
  `Outcome` text NOT NULL,
  `Crime` text NOT NULL,
  `Year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Court`
--

CREATE TABLE `Court` (
  `Location` text NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `DeletedBox`
--

CREATE TABLE `DeletedBox` (
  `DeletionId` int(11) NOT NULL,
  `Box` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Document`
--

CREATE TABLE `Document` (
  `DocumentId` int(11) NOT NULL,
  `Box` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Description` text NOT NULL,
  `AcquisitionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `DocumentType`
--

CREATE TABLE `DocumentType` (
  `Name` text NOT NULL
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
  `Person` int(11) NOT NULL,
  `RegistrationDate` date NOT NULL
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
  `FromL` int(11) NOT NULL,
  `ToL` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `DepartureTime` date NOT NULL,
  `ArrivalTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TransitionStatus`
--

CREATE TABLE `TransitionStatus` (
  `Name` text NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Box`
--
ALTER TABLE `Box`
  ADD PRIMARY KEY (`BoxId`);

--
-- Indexes for table `CaseOutcome`
--
ALTER TABLE `CaseOutcome`
  ADD PRIMARY KEY (`Name`(20));

--
-- Indexes for table `CaseStatus`
--
ALTER TABLE `CaseStatus`
  ADD PRIMARY KEY (`Name`(20));

--
-- Indexes for table `CaseT`
--
ALTER TABLE `CaseT`
  ADD PRIMARY KEY (`CaseId`);

--
-- Indexes for table `Court`
--
ALTER TABLE `Court`
  ADD PRIMARY KEY (`Location`(2));

--
-- Indexes for table `DeletedBox`
--
ALTER TABLE `DeletedBox`
  ADD PRIMARY KEY (`DeletionId`);

--
-- Indexes for table `Document`
--
ALTER TABLE `Document`
  ADD PRIMARY KEY (`DocumentId`);

--
-- Indexes for table `DocumentType`
--
ALTER TABLE `DocumentType`
  ADD PRIMARY KEY (`Name`(20));

--
-- Indexes for table `Evidence`
--
ALTER TABLE `Evidence`
  ADD PRIMARY KEY (`EvidenceId`);

--
-- Indexes for table `Paper`
--
ALTER TABLE `Paper`
  ADD PRIMARY KEY (`PaperId`);

--
-- Indexes for table `Report`
--
ALTER TABLE `Report`
  ADD PRIMARY KEY (`ReportId`);

--
-- Indexes for table `Transition`
--
ALTER TABLE `Transition`
  ADD PRIMARY KEY (`TransitionId`);

--
-- Indexes for table `TransitionStatus`
--
ALTER TABLE `TransitionStatus`
  ADD PRIMARY KEY (`Name`(20));

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
-- AUTO_INCREMENT for table `DeletedBox`
--
ALTER TABLE `DeletedBox`
  MODIFY `DeletionId` int(11) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
