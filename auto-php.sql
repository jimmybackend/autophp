-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-01-2022 a las 15:59:23
-- Versión del servidor: 5.6.13
-- Versión de PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `auto-php`
--
CREATE DATABASE IF NOT EXISTS `auto-php` DEFAULT CHARACTER SET latin7 COLLATE latin7_general_ci;
USE `auto-php`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detail_visit_1`
--

DROP TABLE IF EXISTS `detail_visit_1`;
CREATE TABLE IF NOT EXISTS `detail_visit_1` (
  `Idd_1` int(11) NOT NULL AUTO_INCREMENT,
  `Classification_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Msn_1` text COLLATE utf8_unicode_ci NOT NULL,
  `Datetime_1` datetime NOT NULL,
  `Id_1` int(11) NOT NULL,
  PRIMARY KEY (`Idd_1`),
  KEY `Id_1` (`Id_1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `landing_page`
--

DROP TABLE IF EXISTS `landing_page`;
CREATE TABLE IF NOT EXISTS `landing_page` (
  `Id_1` int(11) NOT NULL AUTO_INCREMENT,
  `Number_1` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `Name_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Lastname_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Birthday_1` date NOT NULL,
  `City_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Country_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Postal_code_1` int(11) NOT NULL,
  `Address_1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Phone_1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Email_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Pass_1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Service_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Select_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Msn_1` text COLLATE utf8_unicode_ci NOT NULL,
  `Datetime_1` datetime NOT NULL,
  `Ip_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Visit_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Var_1` int(11) NOT NULL,
  `Type_1` int(11) NOT NULL,
  PRIMARY KEY (`Id_1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visit`
--

DROP TABLE IF EXISTS `visit`;
CREATE TABLE IF NOT EXISTS `visit` (
  `Id_1` int(11) NOT NULL AUTO_INCREMENT,
  `Country_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Service_1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Select_1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Msn_1` text COLLATE utf8_unicode_ci NOT NULL,
  `Datetime_1` datetime NOT NULL,
  `Ip_1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Visit_1` int(11) NOT NULL,
  `Var_1` int(11) NOT NULL,
  `Type_1` int(11) NOT NULL,
  PRIMARY KEY (`Id_1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
