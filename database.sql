-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Vært: mysql8.gigahost.dk
-- Genereringstid: 16. 06 2014 kl. 10:18:43
-- Serverversion: 5.1.73-1-log
-- PHP-version: 5.3.3-7+squeeze19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `starlight_warptwist`
--

CREATE DATABASE  IF NOT EXISTS `peterslyst_com_db`;
USE `peterslyst_com_db`;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` text COLLATE utf8_bin NOT NULL,
  `dato` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `beskrivelse` text COLLATE utf8_bin NOT NULL,
  `billede` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Data dump for tabellen `blog`
--

INSERT INTO `blog` (`id`, `titel`, `dato`, `beskrivelse`, `billede`) VALUES
(1, 'Siden er oprettet', '2014-06-13 08:53:00', 'Database opdateringer er færdige.', '../img/blog/bannerholder.jpg');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `brugere`
--

CREATE TABLE IF NOT EXISTS `brugere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brugernavn` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `salt` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Data dump for tabellen `brugere`
--

INSERT INTO `brugere` (`id`, `brugernavn`, `password`, `email`, `salt`) VALUES
(1, 'warptwist', '78a5633369eaca9238814f448d8b4c934cd2a0191fa8cd52f2a93ef6745979db', 'warptwist@gmail.com', '2dd'),
(2, 'testuser', 'efa1f1d52e68dbfaf6d98f0855f2e53df49892ad210f68945b5b78debba4963e', 'testuser@test.com', '87b');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `historie`
--

CREATE TABLE IF NOT EXISTS `historie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` text COLLATE utf8_bin NOT NULL,
  `beskrivelse` text COLLATE utf8_bin NOT NULL,
  `billede` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Data dump for tabellen `historie`
--

INSERT INTO `historie` (`id`, `titel`, `beskrivelse`, `billede`) VALUES
(1, 'Gårdens historie', 'Vi overtog gården sommeren 2013 og har i efteråret 2013 bygget en stor maskinhal, til maskiner og gårdbutikken. \r\nI foråret 2014 begyndte vi at bygge et nyt stuehus, som vi forventer står færdig til jul 2014. \r\nFølg med her på siden. Der vil løbende komme tekst og billeder af byggeriet. \r\nMålet for fremtiden er at blive en gårdbutik, som folk husker og vender tilbage til. \r\nHer på Peterslyst sætter vi ”fra jord til bord” meget højt og kunnderne skal vide at det er kvalitet de får. \r\n', '../img/historie.jpg');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `udlejning`
--

CREATE TABLE IF NOT EXISTS `udlejning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` text COLLATE utf8_bin NOT NULL,
  `beskrivelse` text COLLATE utf8_bin NOT NULL,
  `billede` text COLLATE utf8_bin NOT NULL,
  `kategori` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Data dump for tabellen `udlejning`
--

INSERT INTO `udlejning` (`id`, `titel`, `beskrivelse`, `billede`, `kategori`) VALUES
(1, 'Motorsav', 'Perfekt sav til mindre og mellem store træer. Pris 350 kr pr dag + moms \r\n', '../img/udlejning/motorsav.jpg', ''),
(2, 'Stillads', 'Bukke stillads, har mange dele. Bla 10 plader, 12 bukker og rækværk. Ring for pris. \r\n', '../img/udlejning/stillads.jpg', '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `udvalg`
--

CREATE TABLE IF NOT EXISTS `udvalg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` text COLLATE utf8_bin NOT NULL,
  `beskrivelse` text COLLATE utf8_bin NOT NULL,
  `billede` text COLLATE utf8_bin NOT NULL,
  `aktiv` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Data dump for tabellen `udvalg`
--

INSERT INTO `udvalg` (`id`, `titel`, `beskrivelse`, `billede`, `aktiv`) VALUES
(2, 'Kartofler', 'Arielle er en meget tidlig kartoffel sort med en lys gul farve. Den er med en fin smag, hvis den bliver \r\nhøstet tidlig. Det vil sige den skal høstes i første halvdel af juni. Formen er rund / oval, hvilket gør \r\nden egnet til at rense i hånden under en vandhane, eller en let omgang i en skrællemaskine. Den \r\nlyse gule farve gør den attraktiv på en tallerken. ', '../img/produkter/kartoffel_1.jpg', 0),
(4, 'Jordbær', 'Her skulle der have stået noget smart om jordbær, og hvad de kan bruges til.', '../img/produkter/jordbaer.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `vikarservice`
--

CREATE TABLE IF NOT EXISTS `vikarservice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` text COLLATE utf8_bin NOT NULL,
  `beskrivelse` text COLLATE utf8_bin NOT NULL,
  `billede` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Data dump for tabellen `vikarservice`
--

INSERT INTO `vikarservice` (`id`, `titel`, `beskrivelse`, `billede`) VALUES
(1, 'Palles Vikarservice', 'Lej en professionel handy-man! Slip for personale administration og spildtid, hos os kan du leje en fleksibel arbejdskraft på time – eller opgavebasis. Vi leverer den ekstra indsats til opgaver inden for landbrug, skovbrug, entreprenør, maskinfører, taxa kørsel mm. Ring på 40 36 41 42 for at høre nærmere. Til den private tilbyder jeg havearbejde, anlægning af terrasse eller indkørsel, opsætning af køkken, bryggers, maler arbejde, opsætning af skillevæk. Ring med din opgave og jeg kommer og ser på det.', '/img/bannerholder.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
