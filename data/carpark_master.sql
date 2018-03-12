-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for carpark
CREATE DATABASE IF NOT EXISTS `carpark` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `carpark`;


-- Dumping structure for table carpark.campus
CREATE TABLE IF NOT EXISTS `campus` (
  `campusid` int(11) NOT NULL AUTO_INCREMENT,
  `campusname` varchar(255) NOT NULL,
  PRIMARY KEY (`campusid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table carpark.campus: ~0 rows (approximately)
/*!40000 ALTER TABLE `campus` DISABLE KEYS */;
/*!40000 ALTER TABLE `campus` ENABLE KEYS */;


-- Dumping structure for table carpark.carpark
CREATE TABLE IF NOT EXISTS `carpark` (
  `carparkid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `openinghour` int(8) NOT NULL,
  `closinghour` int(8) NOT NULL,
  `numberspaces` int(10) NOT NULL,
  `numberdisabled` int(10) NOT NULL,
  `spacesavailable` int(10) NOT NULL,
  `dspacesavailable` int(10) NOT NULL,
  `latitude` float(13,10) NOT NULL,
  `longitude` float(13,10) NOT NULL,
  `priceperhour` int(16) NOT NULL,
  `isforstaff` tinyint(1) NOT NULL,
  `isforstudents` tinyint(1) NOT NULL,
  `isforpublic` tinyint(1) NOT NULL,
  `membersonly` tinyint(1) NOT NULL,
  `campus_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`carparkid`),
  KEY `fk_campus_id` (`campus_id`),
  CONSTRAINT `fk_campus_id` FOREIGN KEY (`campus_id`) REFERENCES `campus` (`campusid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table carpark.carpark: ~0 rows (approximately)
/*!40000 ALTER TABLE `carpark` DISABLE KEYS */;
/*!40000 ALTER TABLE `carpark` ENABLE KEYS */;


-- Dumping structure for table carpark.facility
CREATE TABLE IF NOT EXISTS `facility` (
  `facilityid` int(11) NOT NULL AUTO_INCREMENT,
  `facilityname` varchar(255) NOT NULL,
  `carpark_id` int(11) NOT NULL,
  PRIMARY KEY (`facilityid`),
  KEY `fk_carpark_id` (`carpark_id`),
  CONSTRAINT `fk_carpark_id` FOREIGN KEY (`carpark_id`) REFERENCES `carpark` (`carparkid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table carpark.facility: ~0 rows (approximately)
/*!40000 ALTER TABLE `facility` DISABLE KEYS */;
/*!40000 ALTER TABLE `facility` ENABLE KEYS */;


-- Dumping structure for table carpark.historicaloccupancy
CREATE TABLE IF NOT EXISTS `historicaloccupancy` (
  `occupancyid` int(11) NOT NULL AUTO_INCREMENT,
  `carpark_id` int(11) NOT NULL,
  `weekofyear` int(6) NOT NULL,
  `7` int(7) NOT NULL,
  `8` int(7) NOT NULL,
  `9` int(7) NOT NULL,
  `10` int(7) NOT NULL,
  `11` int(7) NOT NULL,
  `12` int(7) NOT NULL,
  `13` int(7) NOT NULL,
  `14` int(7) NOT NULL,
  `15` int(7) NOT NULL,
  `16` int(7) NOT NULL,
  `17` int(7) NOT NULL,
  `18` int(7) NOT NULL,
  `19` int(7) NOT NULL,
  `20` int(7) NOT NULL,
  `21` int(7) NOT NULL,
  PRIMARY KEY (`occupancyid`),
  KEY `fk_carpark_id_occupancy` (`carpark_id`),
  CONSTRAINT `fk_carpark_id_occupancy` FOREIGN KEY (`carpark_id`) REFERENCES `carpark` (`carparkid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table carpark.historicaloccupancy: ~0 rows (approximately)
/*!40000 ALTER TABLE `historicaloccupancy` DISABLE KEYS */;
/*!40000 ALTER TABLE `historicaloccupancy` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
