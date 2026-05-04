-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
<<<<<<< HEAD
-- Host: localhost
-- Generation Time: Apr 29, 2026 at 01:50 PM
=======
-- Host: 127.0.0.1
-- Generation Time: May 03, 2026 at 12:12 PM
>>>>>>> 0be0c7e (Update dashboard events and admin files)
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Database: `paugnatdb`
--
<<<<<<< HEAD
CREATE DATABASE IF NOT EXISTS `paugnatDb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `paugnatDb`;
=======
CREATE DATABASE IF NOT EXISTS `paugnatdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `paugnatdb`;
>>>>>>> 0be0c7e (Update dashboard events and admin files)

-- --------------------------------------------------------

--
-- Table structure for table `adminlogs`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `adminLogs`;
CREATE TABLE `adminLogs` (
  `logId` int(11) NOT NULL,
  `adminId` int(11) DEFAULT NULL,
  `actionType` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `affectedTable` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
DROP TABLE IF EXISTS `adminlogs`;

CREATE TABLE `adminlogs` (
    `logId` int(11) NOT NULL,
    `adminId` int(11) DEFAULT NULL,
    `actionType` enum('INSERT', 'UPDATE', 'DELETE') NOT NULL,
    `affectedTable` varchar(50) NOT NULL,
    `description` text DEFAULT NULL,
    `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
>>>>>>> 0be0c7e (Update dashboard events and admin files)

--
-- Dumping data for table `adminlogs`
--

<<<<<<< HEAD
INSERT INTO `adminLogs` (`logId`, `adminId`, `actionType`, `affectedTable`, `description`, `createdAt`) VALUES
(1, 2, 'INSERT', 'admins', 'New admin created: admin2', '2026-04-17 03:19:19'),
(2, 2, 'UPDATE', 'admins', 'Username changed', '2026-04-17 03:21:13'),
(3, 1, 'DELETE', 'admins', 'Admin deleted: admin', '2026-04-17 03:22:16'),
(4, 3, 'INSERT', 'admins', 'New admin created: Patrick', '2026-04-18 03:44:08'),
(5, 3, 'UPDATE', 'admins', 'Password changed', '2026-04-18 03:44:34'),
(6, 2, 'DELETE', 'admins', 'Admin deleted: Justine', '2026-04-18 03:44:50'),
(7, 3, 'UPDATE', 'admins', 'Username changed', '2026-04-18 03:47:59'),
(8, 3, 'UPDATE', 'admins', 'Password changed', '2026-04-18 03:47:59'),
(9, 4, 'INSERT', 'admins', 'New admin created: admin', '2026-04-25 02:32:36'),
(10, 3, 'UPDATE', 'admins', 'Password changed', '2026-04-25 02:41:39'),
(11, 4, 'DELETE', 'admins', 'Admin deleted: admin', '2026-04-25 02:54:59'),
(12, 5, 'INSERT', 'admins', 'New admin created: admin', '2026-04-25 02:55:48');
=======
INSERT INTO
    `adminlogs` (
        `logId`,
        `adminId`,
        `actionType`,
        `affectedTable`,
        `description`,
        `createdAt`
    )
VALUES (
        1,
        2,
        'INSERT',
        'admins',
        'New admin created: admin2',
        '2026-04-17 03:19:19'
    ),
    (
        2,
        2,
        'UPDATE',
        'admins',
        'Username changed',
        '2026-04-17 03:21:13'
    ),
    (
        3,
        1,
        'DELETE',
        'admins',
        'Admin deleted: admin',
        '2026-04-17 03:22:16'
    ),
    (
        4,
        3,
        'INSERT',
        'admins',
        'New admin created: Patrick',
        '2026-04-18 03:44:08'
    ),
    (
        5,
        3,
        'UPDATE',
        'admins',
        'Password changed',
        '2026-04-18 03:44:34'
    ),
    (
        6,
        2,
        'DELETE',
        'admins',
        'Admin deleted: Justine',
        '2026-04-18 03:44:50'
    ),
    (
        7,
        3,
        'UPDATE',
        'admins',
        'Username changed',
        '2026-04-18 03:47:59'
    ),
    (
        8,
        3,
        'UPDATE',
        'admins',
        'Password changed',
        '2026-04-18 03:47:59'
    ),
    (
        9,
        4,
        'INSERT',
        'admins',
        'New admin created: admin',
        '2026-04-25 02:32:36'
    ),
    (
        10,
        3,
        'UPDATE',
        'admins',
        'Password changed',
        '2026-04-25 02:41:39'
    ),
    (
        11,
        4,
        'DELETE',
        'admins',
        'Admin deleted: admin',
        '2026-04-25 02:54:59'
    ),
    (
        12,
        5,
        'INSERT',
        'admins',
        'New admin created: admin',
        '2026-04-25 02:55:48'
    ),
    (
        13,
        6,
        'INSERT',
        'admins',
        'New admin created: Trix',
        '2026-05-03 09:34:49'
    ),
    (
        14,
        5,
        'DELETE',
        'admins',
        'Admin deleted: admin',
        '2026-05-03 09:35:08'
    ),
    (
        15,
        6,
        'UPDATE',
        'admins',
        'Username changed',
        '2026-05-03 09:35:38'
    );
>>>>>>> 0be0c7e (Update dashboard events and admin files)

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
<<<<<<< HEAD
=======

>>>>>>> 0be0c7e (Update dashboard events and admin files)
CREATE TABLE `admins` (
    `id` int(11) NOT NULL,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

<<<<<<< HEAD
INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(3, 'PatrickLouise', '$2y$10$8blWSfmcjR.nRjfnwoyGweTG9vKVgp/MWfjr6.o7xAiLTUGyLiCO2'),
(5, 'admin', '$2y$10$zqOdpq8PZa8UHhenxyBwgetAx97.4jIUHvjqyTYcYggu7YDLpZlF6');
=======
INSERT INTO
    `admins` (`id`, `username`, `password`)
VALUES (
        3,
        'PatrickLouise',
        '$2y$10$8blWSfmcjR.nRjfnwoyGweTG9vKVgp/MWfjr6.o7xAiLTUGyLiCO2'
    ),
    (
        6,
        'TrixJhon',
        '$2y$10$8blWSfmcjR.nRjfnwoyGweTG9vKVgp/MWfjr6.o7xAiLTUGyLiCO2'
    );
>>>>>>> 0be0c7e (Update dashboard events and admin files)

--
-- Triggers `admins`
--
<<<<<<< HEAD
DROP TRIGGER IF EXISTS `after_admin_delete`;
=======
DROP TRIGGER IF EXISTS `afterAdminDelete`;

>>>>>>> 0be0c7e (Update dashboard events and admin files)
DELIMITER $$

CREATE TRIGGER `afterAdminDelete` AFTER DELETE ON `admins` FOR EACH ROW BEGIN
    INSERT INTO adminLogs (adminId, actionType, affectedTable, description)
    VALUES (
        OLD.id,
        'DELETE',
        'admins',
        CONCAT('Admin deleted: ', OLD.username)
    );
END
$$
<<<<<<< HEAD
DELIMITER ;
DROP TRIGGER IF EXISTS `after_admin_insert`;
=======

DELIMITER;

DROP TRIGGER IF EXISTS `afterAdminInsert`;

>>>>>>> 0be0c7e (Update dashboard events and admin files)
DELIMITER $$

CREATE TRIGGER `afterAdminInsert` AFTER INSERT ON `admins` FOR EACH ROW BEGIN
    INSERT INTO adminLogs (adminId, actionType, affectedTable, description)
    VALUES (
        NEW.id,
        'INSERT',
        'admins',
        CONCAT('New admin created: ', NEW.username)
    );
END
$$
<<<<<<< HEAD
DELIMITER ;
DROP TRIGGER IF EXISTS `after_admin_update`;
=======

DELIMITER;

DROP TRIGGER IF EXISTS `afterAdminUpdate`;

>>>>>>> 0be0c7e (Update dashboard events and admin files)
DELIMITER $$

CREATE TRIGGER `afterAdminUpdate` AFTER UPDATE ON `admins` FOR EACH ROW BEGIN
    IF OLD.username <> NEW.username THEN
        INSERT INTO adminLogs (adminId, actionType, affectedTable, description)
        VALUES (NEW.id, 'UPDATE', 'admins', 'Username changed');
    END IF;

    IF OLD.password <> NEW.password THEN
        INSERT INTO adminLogs (adminId, actionType, affectedTable, description)
        VALUES (NEW.id, 'UPDATE', 'admins', 'Password changed');
    END IF;

END
$$

DELIMITER;

-- --------------------------------------------------------

--
-- Table structure for table `collegelogs`
--

DROP TABLE IF EXISTS `collegelogs`;

CREATE TABLE `collegelogs` (
    `logId` int(11) NOT NULL,
    `collegeId` int(11) DEFAULT NULL,
    `actionType` enum('INSERT', 'UPDATE', 'DELETE') NOT NULL,
    `description` text DEFAULT NULL,
    `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `collegelogs`
--

INSERT INTO
    `collegelogs` (
        `logId`,
        `collegeId`,
        `actionType`,
        `description`,
        `createdAt`
    )
VALUES (
        1,
        2,
        'INSERT',
        'College created: College of Engineering',
        '2026-04-18 03:36:14'
    ),
    (
        3,
        2,
        'UPDATE',
        'dean: Dr. Juan → Dr. Santos; ',
        '2026-04-18 03:40:27'
    ),
    (
        4,
        2,
        'UPDATE',
        'year: 1995 → 2000; points: 150 → 200; ',
        '2026-04-18 03:46:51'
    ),
    (
        5,
        2,
        'UPDATE',
        'code: COE → COS; ',
        '2026-04-21 10:54:57'
    ),
    (
        6,
        2,
        'DELETE',
        'Deleted college: College of Engineering',
        '2026-04-21 10:55:17'
    ),
    (
        7,
        3,
        'INSERT',
        'College created: College of Engineering',
        '2026-04-25 02:55:49'
    ),
    (
        8,
        4,
        'INSERT',
        'College created: College of Science',
        '2026-04-25 02:55:49'
    ),
    (
        9,
        5,
        'INSERT',
        'College created: College of Business',
        '2026-04-25 02:55:49'
    ),
    (
        10,
        6,
        'INSERT',
        'College created: College of Education',
        '2026-04-25 02:55:49'
    ),
    (
        11,
        7,
        'INSERT',
        'College created: College of Arts',
        '2026-04-25 02:55:49'
    ),
    (
        12,
        4,
        'UPDATE',
        'points: 120 → 200; ',
        '2026-04-25 03:04:59'
    ),
    (
        13,
        7,
        'UPDATE',
        'points: 80 → 90; ',
        '2026-04-25 04:00:37'
    ),
    (
        14,
        8,
        'INSERT',
        'College created: College of Information Technology',
        '2026-04-25 04:03:33'
    ),
    (
        15,
        8,
        'UPDATE',
        'points: 30 → 240; ',
        '2026-04-29 12:03:52'
    ),
    (
        16,
        8,
        'UPDATE',
        'points changed; ',
        '2026-04-30 08:18:12'
    ),
    (
        17,
        8,
        'UPDATE',
        'points changed; ',
        '2026-04-30 08:19:07'
    ),
    (
        18,
        8,
        'UPDATE',
        'points changed; ',
        '2026-04-30 08:19:24'
    ),
    (
        19,
        7,
        'UPDATE',
        'points changed; ',
        '2026-04-30 08:25:59'
    ),
    (
        20,
        8,
        'UPDATE',
        'points changed; ',
        '2026-04-30 12:11:28'
    ),
    (
        21,
        6,
        'UPDATE',
        'points changed; ',
        '2026-04-30 12:50:42'
    ),
    (
        22,
        3,
        'UPDATE',
        'points changed; ',
        '2026-05-02 08:21:51'
    ),
    (
        23,
        6,
        'UPDATE',
        'points changed; ',
        '2026-05-02 09:17:15'
    ),
    (
        24,
        4,
        'UPDATE',
        'points changed; ',
        '2026-05-03 09:19:34'
    ),
    (
        25,
        8,
        'DELETE',
        'Deleted college: College of Information Technology',
        '2026-05-03 09:40:21'
    ),
    (
        26,
        3,
        'UPDATE',
        'code: \"COE\" → \"COEe\"; ',
        '2026-05-03 09:43:40'
    ),
    (
        27,
        3,
        'UPDATE',
        'email: \"engineering@gmail.com\" → \"engineering2@gmail.com\"; ',
        '2026-05-03 09:45:03'
    ),
    (
        28,
        3,
        'UPDATE',
        'email: \"engineering2@gmail.com\" → \"engineering3@gmail.com\"; ',
        '2026-05-03 09:51:32'
    ),
    (
        29,
        7,
        'DELETE',
        'Deleted college: College of Arts',
        '2026-05-03 09:52:15'
    ),
    (
        30,
        9,
        'INSERT',
        'College created: College Of Arts and Culture',
        '2026-05-03 09:52:52'
    );

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

DROP TABLE IF EXISTS `colleges`;
<<<<<<< HEAD
=======

>>>>>>> 0be0c7e (Update dashboard events and admin files)
CREATE TABLE `colleges` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `code` varchar(20) DEFAULT NULL,
    `description` text DEFAULT NULL,
    `deanName` varchar(100) DEFAULT NULL,
    `email` varchar(100) DEFAULT NULL,
    `phone` varchar(20) DEFAULT NULL,
    `building` varchar(100) DEFAULT NULL,
    `establishedYear` year(4) DEFAULT NULL,
    `points` int(11) DEFAULT 0,
    `status` enum('active', 'inactive') DEFAULT 'active',
    `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
    `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO
    `colleges` (
        `id`,
        `name`,
        `code`,
        `description`,
        `deanName`,
        `email`,
        `phone`,
        `building`,
        `establishedYear`,
        `points`,
        `status`,
        `createdAt`,
        `updatedAt`
    )
VALUES (
        3,
        'College of Engineering',
        'COE',
        NULL,
        NULL,
        'engineering3@gmail.com',
        NULL,
        'Bldg-54',
        NULL,
        160,
        'active',
        '2026-04-25 02:55:49',
        '2026-05-03 09:51:32'
    ),
    (
        4,
        'College of Science',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        240,
        'active',
        '2026-04-25 02:55:49',
        '2026-05-03 09:19:34'
    ),
    (
        5,
        'College of Business',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        100,
        'active',
        '2026-04-25 02:55:49',
        '2026-04-25 02:55:49'
    ),
    (
        6,
        'College of Education',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        100,
        'active',
        '2026-04-25 02:55:49',
        '2026-05-02 09:17:15'
    ),
    (
        9,
        'College Of Arts and Culture',
        'CAC',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        0,
        'active',
        '2026-05-03 09:52:52',
        '2026-05-03 09:52:52'
    );

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `name`, `code`, `description`, `dean_name`, `email`, `phone`, `building`, `established_year`, `points`, `status`, `created_at`, `updated_at`) VALUES
(3, 'College of Engineering', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 150, 'active', '2026-04-25 02:55:49', '2026-04-25 02:55:49'),
(4, 'College of Science', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 200, 'active', '2026-04-25 02:55:49', '2026-04-25 03:04:59'),
(5, 'College of Business', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 'active', '2026-04-25 02:55:49', '2026-04-25 02:55:49'),
(6, 'College of Education', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90, 'active', '2026-04-25 02:55:49', '2026-04-25 02:55:49'),
(7, 'College of Arts', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90, 'active', '2026-04-25 02:55:49', '2026-04-25 04:00:37'),
(8, 'College of Information Technology', 'CIT', 'djofhjsdhfkjdsgdgdfgf', 'dgfgdfgdfgdfg', 'fgdfgdhg@gmail.com', '09978976343', '45', '2001', 30, 'active', '2026-04-25 04:03:33', '2026-04-25 04:03:33');

--
-- Triggers `colleges`
--
<<<<<<< HEAD
DROP TRIGGER IF EXISTS `colleges_after_delete`;
=======
DROP TRIGGER IF EXISTS `afterCollegeDelete`;

>>>>>>> 0be0c7e (Update dashboard events and admin files)
DELIMITER $$

CREATE TRIGGER `afterCollegeDelete` AFTER DELETE ON `colleges` FOR EACH ROW BEGIN
    INSERT INTO collegeLogs (collegeId, actionType, description)
    VALUES (
        OLD.id,
        'DELETE',
        CONCAT('Deleted college: ', OLD.name)
    );
END
$$
<<<<<<< HEAD
DELIMITER ;
DROP TRIGGER IF EXISTS `colleges_after_insert`;
=======

DELIMITER;

DROP TRIGGER IF EXISTS `afterCollegeInsert`;

>>>>>>> 0be0c7e (Update dashboard events and admin files)
DELIMITER $$

CREATE TRIGGER `afterCollegeInsert` AFTER INSERT ON `colleges` FOR EACH ROW BEGIN
    INSERT INTO collegeLogs (collegeId, actionType, description)
    VALUES (
        NEW.id,
        'INSERT',
        CONCAT('College created: ', NEW.name)
    );
END
$$
<<<<<<< HEAD
DELIMITER ;
DROP TRIGGER IF EXISTS `colleges_after_update`;
=======

DELIMITER;

DROP TRIGGER IF EXISTS `afterCollegeUpdate`;

>>>>>>> 0be0c7e (Update dashboard events and admin files)
DELIMITER $$

CREATE TRIGGER `afterCollegeUpdate` AFTER UPDATE ON `colleges` FOR EACH ROW BEGIN
    DECLARE changes TEXT DEFAULT '';

    IF NOT (IFNULL(OLD.name,'') = IFNULL(NEW.name,'')) THEN
        SET changes = CONCAT(changes, 'name: "', OLD.name, '" → "', NEW.name, '"; ');
    END IF;

    IF NOT (IFNULL(OLD.code,'') = IFNULL(NEW.code,'')) THEN
        SET changes = CONCAT(changes, 'code: "', OLD.code, '" → "', NEW.code, '"; ');
    END IF;

    IF NOT (IFNULL(OLD.deanName,'') = IFNULL(NEW.deanName,'')) THEN
        SET changes = CONCAT(changes, 'deanName: "', OLD.deanName, '" → "', NEW.deanName, '"; ');
    END IF;

    IF NOT (IFNULL(OLD.email,'') = IFNULL(NEW.email,'')) THEN
        SET changes = CONCAT(changes, 'email: "', OLD.email, '" → "', NEW.email, '"; ');
    END IF;

    IF NOT (IFNULL(OLD.phone,'') = IFNULL(NEW.phone,'')) THEN
        SET changes = CONCAT(changes, 'phone: "', OLD.phone, '" → "', NEW.phone, '"; ');
    END IF;

    IF NOT (IFNULL(OLD.building,'') = IFNULL(NEW.building,'')) THEN
        SET changes = CONCAT(changes, 'building: "', OLD.building, '" → "', NEW.building, '"; ');
    END IF;

    IF NOT (IFNULL(OLD.establishedYear,'') = IFNULL(NEW.establishedYear,'')) THEN
        SET changes = CONCAT(changes, 'establishedYear: ', OLD.establishedYear, ' → ', NEW.establishedYear, '; ');
    END IF;

    IF NOT (IFNULL(OLD.points,0) = IFNULL(NEW.points,0)) THEN
        SET changes = CONCAT(changes, 'points: ', OLD.points, ' → ', NEW.points, '; ');
    END IF;

    IF NOT (IFNULL(OLD.status,'') = IFNULL(NEW.status,'')) THEN
        SET changes = CONCAT(changes, 'status: ', OLD.status, ' → ', NEW.status, '; ');
    END IF;

    IF changes <> '' THEN
        INSERT INTO collegelogs (collegeId, actionType, description)
        VALUES (
            NEW.id,
            'UPDATE',
            changes
        );
    END IF;
END
$$

DELIMITER;

-- --------------------------------------------------------

--
-- Table structure for table `eventimages`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `college_logs`;
CREATE TABLE `college_logs` (
  `log_id` int(11) NOT NULL,
  `college_id` int(11) DEFAULT NULL,
  `action_type` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
DROP TABLE IF EXISTS `eventimages`;

CREATE TABLE `eventimages` (
    `id` int(11) NOT NULL,
    `eventId` int(11) NOT NULL,
    `imagePath` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
>>>>>>> 0be0c7e (Update dashboard events and admin files)

--
-- Dumping data for table `eventimages`
--

<<<<<<< HEAD
INSERT INTO `college_logs` (`log_id`, `college_id`, `action_type`, `description`, `created_at`) VALUES
(1, 2, 'INSERT', 'College created: College of Engineering', '2026-04-18 03:36:14'),
(3, 2, 'UPDATE', 'dean: Dr. Juan → Dr. Santos; ', '2026-04-18 03:40:27'),
(4, 2, 'UPDATE', 'year: 1995 → 2000; points: 150 → 200; ', '2026-04-18 03:46:51'),
(5, 2, 'UPDATE', 'code: COE → COS; ', '2026-04-21 10:54:57'),
(6, 2, 'DELETE', 'Deleted college: College of Engineering', '2026-04-21 10:55:17'),
(7, 3, 'INSERT', 'College created: College of Engineering', '2026-04-25 02:55:49'),
(8, 4, 'INSERT', 'College created: College of Science', '2026-04-25 02:55:49'),
(9, 5, 'INSERT', 'College created: College of Business', '2026-04-25 02:55:49'),
(10, 6, 'INSERT', 'College created: College of Education', '2026-04-25 02:55:49'),
(11, 7, 'INSERT', 'College created: College of Arts', '2026-04-25 02:55:49'),
(12, 4, 'UPDATE', 'points: 120 → 200; ', '2026-04-25 03:04:59'),
(13, 7, 'UPDATE', 'points: 80 → 90; ', '2026-04-25 04:00:37'),
(14, 8, 'INSERT', 'College created: College of Information Technology', '2026-04-25 04:03:33');
=======
INSERT INTO
    `eventimages` (`id`, `eventId`, `imagePath`)
VALUES (
        1,
        1,
        'images/events/1777712748_616_0.jpg'
    );

-- --------------------------------------------------------

--
-- Table structure for table `eventlogs`
--

DROP TABLE IF EXISTS `eventlogs`;

CREATE TABLE `eventlogs` (
    `logId` int(11) NOT NULL,
    `eventId` int(11) DEFAULT NULL,
    `actionType` enum('INSERT', 'UPDATE', 'DELETE') NOT NULL,
    `description` text DEFAULT NULL,
    `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `eventlogs`
--

INSERT INTO
    `eventlogs` (
        `logId`,
        `eventId`,
        `actionType`,
        `description`,
        `createdAt`
    )
VALUES (
        1,
        9,
        'INSERT',
        'Event created: \"Sepak Takraw\" scheduled on 2026-05-15',
        '2026-05-03 07:56:20'
    ),
    (
        2,
        2,
        'UPDATE',
        'Event updated: \"BadMinton\" → \"BadMinton Season 2\" | Date: 2026-04-28 → 2026-04-28 | Status: upcoming → upcoming',
        '2026-05-03 07:56:36'
    ),
    (
        3,
        6,
        'DELETE',
        'Event deleted: \"Hockey\" (was scheduled on 2026-05-21, status: upcoming)',
        '2026-05-03 07:56:47'
    ),
    (
        4,
        10,
        'INSERT',
        'Event created: \"Long Jump\" scheduled on 2026-06-26',
        '2026-05-03 09:53:40'
    ),
    (
        5,
        10,
        'UPDATE',
        'Event updated: \"Long Jump\" → \"Long Jump\" | Date: 2026-06-26 → 2026-06-27 | Status: upcoming → upcoming',
        '2026-05-03 09:54:30'
    ),
    (
        6,
        3,
        'DELETE',
        'Event deleted: \"Chessss\" (was scheduled on 2026-04-26, status: upcoming)',
        '2026-05-03 09:55:42'
    );
>>>>>>> 0be0c7e (Update dashboard events and admin files)

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
<<<<<<< HEAD
=======

>>>>>>> 0be0c7e (Update dashboard events and admin files)
CREATE TABLE `events` (
    `id` int(11) NOT NULL,
    `eventName` varchar(100) NOT NULL,
    `description` text DEFAULT NULL,
    `eventType` enum(
        'sports',
        'academic',
        'cultural'
    ) DEFAULT 'sports',
    `eventDate` date NOT NULL,
    `startTime` time DEFAULT NULL,
    `endTime` time DEFAULT NULL,
    `location` varchar(150) DEFAULT NULL,
    `status` enum(
        'upcoming',
        'ongoing',
        'finished',
        'cancelled'
    ) DEFAULT 'upcoming',
    `maxParticipants` int(11) DEFAULT NULL,
    `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
    `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `imagePath` varchar(255) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO
    `events` (
        `id`,
        `eventName`,
        `description`,
        `eventType`,
        `eventDate`,
        `startTime`,
        `endTime`,
        `location`,
        `status`,
        `maxParticipants`,
        `createdAt`,
        `updatedAt`,
        `imagePath`
    )
VALUES (
        1,
        'BasketBalllll',
        '21 Under Category',
        'sports',
        '2026-04-26',
        '13:05:42',
        '11:09:42',
        'DRER GYM',
        'upcoming',
        100,
        '2026-04-25 03:07:04',
        '2026-05-03 07:53:19',
        NULL
    ),
    (
        2,
        'BadMinton Season 2',
        'Senior High BadMinton Tournament',
        'sports',
        '2026-04-28',
        '11:40:31',
        '17:35:31',
        'Gym',
        'upcoming',
        30,
        '2026-04-25 03:36:34',
        '2026-05-03 07:56:36',
        NULL
    ),
    (
        9,
        'Sepak Takraw',
        NULL,
        'sports',
        '2026-05-15',
        NULL,
        NULL,
        NULL,
        'upcoming',
        NULL,
        '2026-05-03 07:56:20',
        '2026-05-03 07:56:20',
        NULL
    ),
    (
        10,
        'Long Jump',
        NULL,
        'sports',
        '2026-06-27',
        NULL,
        NULL,
        NULL,
        'upcoming',
        NULL,
        '2026-05-03 09:53:40',
        '2026-05-03 09:54:30',
        NULL
    );

--
-- Triggers `events`
--
DROP TRIGGER IF EXISTS `afterEventDelete`;

DELIMITER $$

CREATE TRIGGER `afterEventDelete` AFTER DELETE ON `events` FOR EACH ROW BEGIN
  INSERT INTO eventLogs (eventId, actionType, description)
  VALUES (
    OLD.id,
    'DELETE',
    CONCAT(
      'Event deleted: "',
      OLD.eventName,
      '" (was scheduled on ',
      OLD.eventDate,
      ', status: ',
      OLD.status,
      ')'
    )
  );
END
$$

DELIMITER;

DROP TRIGGER IF EXISTS `afterEventInsert`;

DELIMITER $$

CREATE TRIGGER `afterEventInsert` AFTER INSERT ON `events` FOR EACH ROW BEGIN
  INSERT INTO eventLogs (eventId, actionType, description)
  VALUES (
    NEW.id,
    'INSERT',
    CONCAT('Event created: "', NEW.eventName, '" scheduled on ', NEW.eventDate)
  );
END
$$

DELIMITER;

DROP TRIGGER IF EXISTS `afterEventUpdate`;

DELIMITER $$

CREATE TRIGGER `afterEventUpdate` AFTER UPDATE ON `events` FOR EACH ROW BEGIN
  INSERT INTO eventLogs (eventId, actionType, description)
  VALUES (
    NEW.id,
    'UPDATE',
    CONCAT(
      'Event updated: "',
      OLD.eventName,
      '" → "',
      NEW.eventName,
      '" | Date: ',
      OLD.eventDate,
      ' → ',
      NEW.eventDate,
      ' | Status: ',
      OLD.status,
      ' → ',
      NEW.status
    )
  );
END
$$

DELIMITER;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventName`, `description`, `eventType`, `eventDate`, `startTime`, `endTime`, `location`, `status`, `maxParticipants`, `createdAt`, `updatedAt`) VALUES
(1, 'JiggleMyBall', '21 Under Category', 'sports', '2026-04-26', '13:05:42', '11:09:42', 'DRER GYM', 'upcoming', 100, '2026-04-25 03:07:04', '2026-04-25 03:52:52'),
(2, 'BadMinton', 'Senior High BadMinton Tournament', 'sports', '2026-04-28', '11:40:31', '17:35:31', 'Gym', 'upcoming', 30, '2026-04-25 03:36:34', '2026-04-25 03:36:34'),
(3, 'Chess', NULL, 'sports', '2026-04-26', NULL, NULL, NULL, 'upcoming', NULL, '2026-04-25 03:59:13', '2026-04-25 03:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
<<<<<<< HEAD
=======

>>>>>>> 0be0c7e (Update dashboard events and admin files)
CREATE TABLE `messages` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `email` varchar(150) NOT NULL,
    `message` text NOT NULL,
    `status` enum('new', 'read') NOT NULL DEFAULT 'new',
    `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO
    `messages` (
        `id`,
        `name`,
        `email`,
        `message`,
        `status`,
        `createdAt`
    )
VALUES (
        1,
        'Patrick Louise Casiño',
        'casinopatricklouise@gmail.com',
        'Check check',
        'new',
        '2026-04-30 09:02:17'
    ),
    (
        2,
        'Patrick Louise Casiño',
        'casinopatricklouise@gmail.com',
        'mictest123456789',
        'new',
        '2026-05-02 09:36:28'
    ),
    (
        3,
        'Patrick Louise Casiño',
        'casinopatricklouise@gmail.com',
        'New Message May 3 2026',
        'new',
        '2026-05-03 07:15:50'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogs`
--
ALTER TABLE `adminlogs` ADD PRIMARY KEY (`logId`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `collegelogs`
--
ALTER TABLE `collegelogs` ADD PRIMARY KEY (`logId`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `name` (`name`),
ADD UNIQUE KEY `code` (`code`),
ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `eventimages`
--
ALTER TABLE `eventimages` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventlogs`
--
ALTER TABLE `eventlogs` ADD PRIMARY KEY (`logId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages` ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogs`
--
<<<<<<< HEAD
ALTER TABLE `adminLogs`
  MODIFY `logId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
=======
ALTER TABLE `adminlogs`
MODIFY `logId` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 16;
>>>>>>> 0be0c7e (Update dashboard events and admin files)

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
=======
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `collegelogs`
--
ALTER TABLE `collegelogs`
MODIFY `logId` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 31;
>>>>>>> 0be0c7e (Update dashboard events and admin files)

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
=======
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 10;
>>>>>>> 0be0c7e (Update dashboard events and admin files)

--
-- AUTO_INCREMENT for table `eventimages`
--
<<<<<<< HEAD
ALTER TABLE `college_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
=======
ALTER TABLE `eventimages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `eventlogs`
--
ALTER TABLE `eventlogs`
MODIFY `logId` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 7;
>>>>>>> 0be0c7e (Update dashboard events and admin files)

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
=======
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 11;
>>>>>>> 0be0c7e (Update dashboard events and admin files)

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;