-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2011 at 02:56 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: ext_php
--

-- --------------------------------------------------------

--
-- Table structure for table tickets
--

CREATE TABLE IF NOT EXISTS tramites (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  anio int(4) UNSIGNED NOT NULL,
  numero varchar(15) NOT NULL,
  escuela_id int(10) UNSIGNED NOT NULL,
  fecha date,
  asunto varchar(200),
  procedencia_id int(10),
  procedencia_remito varchar(10),
  observaciones varchar(255),
  estado enum('recibido','aprobado','rechazado','ensobrado','pase','finalizado'),
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Table structure for table tickets
--

CREATE TABLE IF NOT EXISTS tramites_estados (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  tramite_id int(10) UNSIGNED NOT NULL,
  fecha date,
  destino_id int(10),
  pase_remito varchar(10),
  observaciones varchar(255),
  estado enum('recibido','aprobado','rechazado','ensobrado','pase','finalizado'),
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;



--
-- Table structure for table socioeducativo
--

CREATE TABLE IF NOT EXISTS socioeducativo (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  tickets_id int(10) UNSIGNED NOT NULL,
  escuela_id int(10) UNSIGNED NOT NULL,
  fecha date,
  alumno_dni int(8),
  alumno varchar(120),
  ingreso_region enum('I', 'II', 'III', 'IV', 'V','VI','VII','VIII','IX') DEFAULT 'IV',
  ingreso_region_fecha date,
  circuito_id int(10),
  observaciones varchar(255),
  estado enum('recibido','aprobado','rechazado','ensobrado','pase','finalizado'),
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Table structure for table socioeducativo_estadoss
--

CREATE TABLE IF NOT EXISTS socioeducativo_estados (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  socioeducativo_id int(10) UNSIGNED NOT NULL,
  fecha date,
  actualización varchar(255),
  estado enum('recibido','aprobado','rechazado','ensobrado','pase','finalizado'),
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

