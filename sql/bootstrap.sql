DROP DATABASE IF EXISTS mahndb;
CREATE DATABASE mahndb;
USE mahndb;
CREATE TABLE cases (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	case_nr INT(4) NOT NULL,
	case_reason TEXT NOT NULL,
	case_memo TEXT NOT NULL,
	case_followup DATE NOT NULL,
	case_created DATETIME NOT NULL,
	case_deleted TINYINT(1) NOT NULL DEFAULT 0,
	tenancy_id INT UNSIGNED NOT NULL,
	case_type_id INT UNSIGNED NOT NULL
);
CREATE TABLE appointments (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	appointment_datetime DATETIME NOT NULL,
	appointment_description TEXT NOT NULL,
	appointment_location VARCHAR(255) NOT NULL,
	appointment_closed TINYINT(1) NOT NULL DEFAULT 0,
	case_id INT UNSIGNED NOT NULL
);
CREATE TABLE costs (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	cost_date DATE NOT NULL,
	cost_amount DECIMAL(11,2) NOT NULL,
	cost_description TEXT NOT NULL,
	cost_type_id INT UNSIGNED NOT NULL,
	case_id INT UNSIGNED NOT NULL
);
CREATE TABLE events (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	event_date DATE NOT NULL,
	event_description TEXT NOT NULL,
	event_file VARCHAR(255) NOT NULL,
	event_type_id INT UNSIGNED NOT NULL,
	court_id INT UNSIGNED NOT NULL,
	case_id INT UNSIGNED NOT NULL
);
CREATE TABLE courts (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	court_name VARCHAR(255) NOT NULL,
	address_id INT UNSIGNED NOT NULL
);
CREATE TABLE addresses (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	address_street VARCHAR(255) NOT NULL,
	address_street_number VARCHAR(255) NOT NULL,
	address_phone_number VARCHAR(255) NOT NULL,
	address_fax_number VARCHAR(255) NOT NULL,
	address_email VARCHAR(255) NOT NULL,
	place_id VARCHAR(255) NOT NULL
);
CREATE TABLE places (
	id VARCHAR(255) NOT NULL PRIMARY KEY,
	place_name VARCHAR(255) NOT NULL,
	place_country VARCHAR(255) NOT NULL
);
CREATE TABLE tenancies (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	tenancy_ve VARCHAR(255) NOT NULL,
	address_id INT UNSIGNED NOT NULL
);
CREATE TABLE case_types (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	type_name VARCHAR(255) NOT NULL
);
CREATE TABLE cost_types (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	type_name VARCHAR(255) NOT NULL
);
CREATE TABLE event_types (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	type_name VARCHAR(255) NOT NULL
);
CREATE TABLE persons (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	person_title VARCHAR(255) NOT NULL,
	person_firstname VARCHAR(255) NOT NULL,
	person_lastname VARCHAR(255) NOT NULL,
	address_id INT UNSIGNED NOT NULL
);
CREATE TABLE claimants (
	case_id INT UNSIGNED NOT NULL,
	person_id INT UNSIGNED NOT NULL,
	PRIMARY KEY(case_id, person_id)
);
CREATE TABLE defendants (
	case_id INT UNSIGNED NOT NULL,
	person_id INT UNSIGNED NOT NULL,
	PRIMARY KEY(case_id, person_id)
);

CREATE TABLE cl_lawyers (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	cl_lawyer_ref VARCHAR(255) NOT NULL,
	cl_lawyer_charged DATE NOT NULL,
	person_id INT UNSIGNED NOT NULL,
	case_id INT UNSIGNED NOT NULL		
);
CREATE TABLE def_lawyers (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	def_lawyer_ref VARCHAR(255) NOT NULL,
	person_id INT UNSIGNED NOT NULL,
	case_id INT UNSIGNED NOT NULL		
);
ALTER TABLE claimants CHANGE person_id claimant_id INT UNSIGNED NOT NULL;
ALTER TABLE defendants CHANGE person_id defendant_id INT UNSIGNED NOT NULL;
-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 25. November 2011 um 10:07
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `mahndb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address_street` varchar(255) NOT NULL,
  `address_street_number` varchar(255) NOT NULL,
  `address_phone_number` varchar(255) NOT NULL,
  `address_fax_number` varchar(255) NOT NULL,
  `address_email` varchar(255) NOT NULL,
  `place_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `addresses`
--

INSERT INTO `addresses` (`id`, `address_street`, `address_street_number`, `address_phone_number`, `address_fax_number`, `address_email`, `place_id`) VALUES
(1, 'Beckstraße', '99', '02041 3767190', '02041 3767196', 'info@lautblick.de', '46238'),
(2, 'Kaninenberghöhe', '8', '1234567890', '1234567890', 'info@agv-essen.com', '12345'),
(3, 'Hebeleckstraße', '111', '02041 41880', '', 'peter@muster.de', '46240'),
(4, 'Beckstraße', '99', '02041 3767190', '02041 3767196', 'info@lautblick.de', '46238'),
(5, 'Hellweg', '3', '', '', '', '12345'),
(6, 'Musterweg', '76', '', '', '', '12345'),
(7, 'hjkhjkhkjh', '656', '675764564576', '67574654564', 'nbhjgjgjh.de', '767867'),
(8, 'äöl', 'u65', '234234', '234234', 'äölä.de', '765765'),
(9, 'üpo', '098', '8765765', '6757567', 'üpo.de', '986876');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_datetime` datetime NOT NULL,
  `appointment_description` text NOT NULL,
  `appointment_location` varchar(255) NOT NULL,
  `appointment_closed` tinyint(1) NOT NULL DEFAULT '0',
  `case_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `appointments`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cases`
--

CREATE TABLE IF NOT EXISTS `cases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `case_nr` int(4) NOT NULL,
  `case_reason` text NOT NULL,
  `case_memo` text NOT NULL,
  `case_followup` date NOT NULL,
  `case_created` datetime NOT NULL,
  `case_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `tenancy_id` int(10) unsigned NOT NULL,
  `case_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `cases`
--

INSERT INTO `cases` (`id`, `case_nr`, `case_reason`, `case_memo`, `case_followup`, `case_created`, `case_deleted`, `tenancy_id`, `case_type_id`) VALUES
(1, 1, 'Hello', 'Yiiiiiieeeeehaaaaaaaaaa!	', '2011-11-30', '2011-11-22 18:16:12', 0, 4, 2),
(2, 2, 'Nur so! ;)', 'kkk', '2011-11-30', '2011-11-24 17:09:54', 0, 3, 2),
(3, 3, '', '', '0000-00-00', '2011-11-24 20:24:36', 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `case_types`
--

CREATE TABLE IF NOT EXISTS `case_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `case_types`
--

INSERT INTO `case_types` (`id`, `type_name`) VALUES
(1, 'Räumungsklage'),
(2, 'Zahlungsklage'),
(3, 'Räumungs- und Zahlungsklage'),
(4, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `claimants`
--

CREATE TABLE IF NOT EXISTS `claimants` (
  `case_id` int(10) unsigned NOT NULL,
  `claimant_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`case_id`,`claimant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `claimants`
--

INSERT INTO `claimants` (`case_id`, `claimant_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(2, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cl_lawyers`
--

CREATE TABLE IF NOT EXISTS `cl_lawyers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cl_lawyer_ref` varchar(255) NOT NULL,
  `cl_lawyer_charged` date NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `case_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `cl_lawyers`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `costs`
--

CREATE TABLE IF NOT EXISTS `costs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cost_date` date NOT NULL,
  `cost_amount` decimal(11,2) NOT NULL,
  `cost_description` text NOT NULL,
  `cost_type_id` int(10) unsigned NOT NULL,
  `case_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `costs`
--

INSERT INTO `costs` (`id`, `cost_date`, `cost_amount`, `cost_description`, `cost_type_id`, `case_id`) VALUES
(1, '2011-11-24', 123.95, 'Was so anfällt bei Gericht.', 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cost_types`
--

CREATE TABLE IF NOT EXISTS `cost_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `cost_types`
--

INSERT INTO `cost_types` (`id`, `type_name`) VALUES
(1, 'Gerichtskosten');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `courts`
--

CREATE TABLE IF NOT EXISTS `courts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `court_name` varchar(255) NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `courts`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `defendants`
--

CREATE TABLE IF NOT EXISTS `defendants` (
  `case_id` int(10) unsigned NOT NULL,
  `defendant_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`case_id`,`defendant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `defendants`
--

INSERT INTO `defendants` (`case_id`, `defendant_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 8),
(2, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `def_lawyers`
--

CREATE TABLE IF NOT EXISTS `def_lawyers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `def_lawyer_ref` varchar(255) NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `case_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `def_lawyers`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_date` date NOT NULL,
  `event_description` text NOT NULL,
  `event_file` varchar(255) NOT NULL,
  `event_type_id` int(10) unsigned NOT NULL,
  `court_id` int(10) unsigned NOT NULL,
  `case_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `events`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_types`
--

CREATE TABLE IF NOT EXISTS `event_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `event_types`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_title` varchar(255) NOT NULL,
  `person_firstname` varchar(255) NOT NULL,
  `person_lastname` varchar(255) NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `persons`
--

INSERT INTO `persons` (`id`, `person_title`, `person_firstname`, `person_lastname`, `address_id`) VALUES
(1, 'Herr', 'Sebastian', 'Kluth', 1),
(2, 'Herr', 'Stefan', 'Dahmer', 2),
(3, 'Herr', 'Peter', 'Stratmann', 3),
(4, 'Herr', 'Thomas', 'Rybka', 4),
(5, 'Herr', 'Wilhelm', 'Mustermann', 5),
(6, 'Frau', 'Gisela', 'Gutnuss', 6),
(7, 'hj', 'kjhkjhjh', 'jkhkjhjkjk', 7),
(8, 'äöl', 'äöl', 'äöl', 8),
(9, 'üpo', 'üpo', 'üpo', 9);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `id` varchar(255) NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `place_country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `places`
--

INSERT INTO `places` (`id`, `place_name`, `place_country`) VALUES
('46238', 'Bottrop', ''),
('12345', 'Essen', ''),
('46240', 'Bottrop', ''),
('767867', 'nbmnbnbmn', ''),
('765765', 'ölä', ''),
('986876', 'üpo', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tenancies`
--

CREATE TABLE IF NOT EXISTS `tenancies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tenancy_ve` varchar(255) NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `tenancies`
--

INSERT INTO `tenancies` (`id`, `tenancy_ve`, `address_id`) VALUES
(1, '12345.456244', 0),
(2, 'XDFJJL', 0),
(3, 'XDFJJL.klk', 0),
(4, '12345.45624', 0);
