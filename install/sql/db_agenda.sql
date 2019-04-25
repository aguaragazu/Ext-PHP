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
-- Table structure for table circuitos
--

CREATE TABLE IF NOT EXISTS circuitos (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  numero tinyint(2) NOT NULL,
  nivel varchar(128) NOT NULL,
  zona varchar(128) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Table structure for table escuelas
--

CREATE TABLE IF NOT EXISTS escuelas (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  codigo int(10) UNSIGNED NOT NULL,
  cue int(10) UNSIGNED NOT NULL,
  anexo tinyint(2) UNSIGNED NOT NULL,
  region enum('I', 'II', 'III', 'IV', 'V','VI','VII','VIII','IX') DEFAULT 'IV',
  circuito_id int(10) UNSIGNED NOT NULL,
  nivel enum('inicial', 'secundaria', 'superior'),
  nodo 	enum('santafe','rafaela','reconquista','rosario'),
  zona enum('N','S'),
  numero int(5) UNSIGNED NOT NULL,
  nombre varchar(200),
  turno enum('M', 'T', 'C', 'V'),
  propietario varchar(250),
  tipo_entidad_id int(10),
  domicilio varchar(250),
  tel_caracteristica int(6),
  tel_numero int(8),
  tel_interno int(4),
  email varchar(190),
  empa tinyint(1),
  edi tinyint(1),
  sarh tinyint(1),
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


--
-- Table structure for table oficinas
--

CREATE TABLE IF NOT EXISTS oficinas (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  oficina varchar(190) NOT NULL,
  referencia varchar(128) NOT NULL,
  tel_caracteristica int(6),
  tel_numero1 int(8),
  tel_numero2 int(8),
  tel_numero3 int(8),
  tel_interno1 int(4),
  tel_interno2 int(4),
  tel_interno3 int(4),
  cel_caracteristica int(6),
  cel_numero int(8),
  email varchar(190),
  spep tinyint(1) DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Table structure for table personas
--

CREATE TABLE IF NOT EXISTS personas (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  dni int(8) UNSIGNED ZEROFILL,
  apellido varchar(128) NOT NULL,
  nombre varchar(200) NOT NULL,
  email varchar(190),
  tel_caracteristica int(6),
  tel_numero int(8),
  tel_interno int(4),
  cel_caracteristica int(6),
  cel_numero int(8),
  cargo varchar(190),
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Table structure for table supervisores
--

CREATE TABLE IF NOT EXISTS supervisores (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  circuito_id int(10) UNSIGNED NOT NULL,
  persona_id int(10) UNSIGNED NOT NULL,
  desde date NOT NULL,
  hasta date NOT NULL,
  activo tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Table structure for table agentes
--

CREATE TABLE IF NOT EXISTS agentes (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  escuela_id int(10) UNSIGNED NOT NULL,
  persona_id int(10) UNSIGNED NOT NULL,
  cargo enum('prosecretario', 'secretario', 'vicedirector', 'director', 'representante_legal'),
  desde date NOT NULL,
  hasta date NOT NULL,
  activo tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

