-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Giu 16, 2018 alle 18:04
-- Versione del server: 5.7.22-0ubuntu0.16.04.1
-- Versione PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fantacalcio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `calciatori`
--

CREATE TABLE `calciatori` (
  `id` int(11) NOT NULL,
  `cognome` varchar(60) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `posizione` enum('POR','DIF','CEN','ATT') DEFAULT NULL,
  `squadra` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `calciatori`
--

INSERT INTO `calciatori` (`id`, `cognome`, `nome`, `posizione`, `squadra`) VALUES
(1, 'Griezman', 'Antoine', 'ATT', 'Francia'),
(2, 'Hazard', 'Edin', 'ATT', 'Belgio'),
(3, 'Neuer', 'Manuel', 'POR', 'Germania'),
(4, 'Ter Stegen', 'Marc-Andrè', 'POR', 'Germania'),
(5, 'Ochoa', 'Guillerme', 'POR', 'Messico'),
(6, 'Ramos', 'Sergio', 'DIF', 'Spagna'),
(7, 'Boateng', 'Jérôme', 'DIF', 'Germania'),
(8, 'Alderweireld', 'Toby', 'DIF', 'Belgio'),
(9, 'Kompany', 'Vincent', 'DIF', 'Belgio'),
(10, 'Gimenez', 'Josè', 'DIF', 'Uruguay'),
(11, 'Granqvist', 'Andreas', 'DIF', 'Svezia'),
(12, 'Fabra', 'Frank', 'DIF', 'Colombia'),
(13, 'Mercado', 'Gabriel Ivan', 'DIF', 'Argentina'),
(14, 'Silva', 'David', 'CEN', 'Spagna'),
(15, 'Kante', 'N\'Golo', 'CEN', 'Francia'),
(16, 'Willian', NULL, 'CEN', 'Brasile'),
(17, 'Kroos', 'Toni', 'CEN', 'Germania'),
(18, 'Perisic', 'Ivan', 'CEN', 'Croazia'),
(19, 'Zielinski', 'Piotr', 'CEN', 'Polonia'),
(20, 'Joao Mario', NULL, 'CEN', 'Portogallo'),
(21, 'Xherdan', 'Shaqiri', 'CEN', 'Svizzera'),
(22, 'Neymar', NULL, 'ATT', 'Brasile'),
(23, 'Milik', 'Arkadiusz', 'ATT', 'Polonia'),
(24, 'Guerrero', 'Paolo', 'ATT', 'Perù'),
(25, 'Dybala', 'Paulo', 'ATT', 'Argentina'),
(26, 'Falcao', NULL, 'ATT', 'Colombia'),
(27, 'Keita', 'Baldè', 'ATT', 'Senegal'),
(28, 'Alisson', 'Becker', 'POR', 'Brasile'),
(29, 'Ederson', NULL, 'POR', 'Brasile'),
(30, 'Akinfeev', 'Igor', 'POR', 'Russia'),
(31, 'Thiago Silva', NULL, 'DIF', 'Brasile'),
(32, 'Umtiti', 'Samuel', 'DIF', 'Francia'),
(33, 'Hummels', 'Mats', 'DIF', 'Germania'),
(34, 'Pique', 'Gerard', 'DIF', 'Spagna'),
(35, 'Cédric', 'Soares', 'DIF', 'Portogallo'),
(36, 'Koulibaly ', 'Kalidou', 'DIF', 'Senegal'),
(37, 'Pazdan', 'Michal', 'DIF', 'Polonia'),
(38, 'Lichtsteiner ', 'Stephan', 'DIF', 'Svizzera'),
(39, 'Ozil', 'Mesut', 'CEN', 'Germania'),
(40, 'Draxler', 'Julian', 'CEN', 'Germania'),
(41, 'Dier', 'Eric', 'CEN', 'Inghilterra'),
(42, 'Thiago', 'Alcántara', 'CEN', 'Spagna'),
(43, 'Busquets', 'Sergio', 'CEN', 'Spagna'),
(44, 'Goretzka', 'Leon', 'CEN', 'Germania'),
(45, 'Renato Augusto', NULL, 'CEN', 'Brasile'),
(46, 'Kovacic', 'Mateo', 'CEN', 'Croazia'),
(47, 'Lukaku ', 'Romelu', 'ATT', 'Belgio'),
(48, 'Mandzukic', 'Mario', 'ATT', 'Croazia'),
(49, 'Muller', 'Thomas', 'ATT', 'Germania'),
(50, 'Coutinho', 'Philippe', 'ATT', 'Brasile'),
(51, 'Mertens', 'Dries', 'ATT', 'Belgio'),
(52, 'André Silva', NULL, 'ATT', 'Portogallo'),
(53, 'Courtois', 'Thibaut', 'POR', 'Belgio'),
(54, 'Arias', 'Santiago', 'DIF', 'Colombia'),
(55, 'Mendy', 'Benjamin', 'DIF', 'Francia'),
(56, 'Miranda', NULL, 'DIF', 'Brasile'),
(57, 'Godin', 'Diego', 'DIF', 'Uruguay');

-- --------------------------------------------------------

--
-- Struttura della tabella `formazioni`
--

CREATE TABLE `formazioni` (
  `id` int(11) NOT NULL,
  `id_giornata` int(11) NOT NULL,
  `id_calciatore` int(11) NOT NULL,
  `voto` float(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `giornate`
--

CREATE TABLE `giornate` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `giornate`
--

INSERT INTO `giornate` (`id`, `data`, `numero`) VALUES
(1, '2018-06-14', 1),
(2, '2018-06-19', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `squadre`
--

CREATE TABLE `squadre` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `tesserati`
--

CREATE TABLE `tesserati` (
  `id` int(11) NOT NULL,
  `id_squadra` int(11) NOT NULL,
  `id_calciatore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `timestamp` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password`, `timestamp`) VALUES
(1, 'alealagna', 'e759b9abfd6b531e4e7144151511a2d8', '15:40:39'),
(2, 'viciofranklin', '189bbbb00c5f1fb7fba9ad9285f193d1', '11:56:59');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `calciatori`
--
ALTER TABLE `calciatori`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `formazioni`
--
ALTER TABLE `formazioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_giornata` (`id_giornata`),
  ADD KEY `id_calciatore` (`id_calciatore`);

--
-- Indici per le tabelle `giornate`
--
ALTER TABLE `giornate`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `squadre`
--
ALTER TABLE `squadre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `tesserati`
--
ALTER TABLE `tesserati`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_calciatore` (`id_calciatore`),
  ADD KEY `id_squadra` (`id_squadra`) USING BTREE;

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `calciatori`
--
ALTER TABLE `calciatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT per la tabella `formazioni`
--
ALTER TABLE `formazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `giornate`
--
ALTER TABLE `giornate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `squadre`
--
ALTER TABLE `squadre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `tesserati`
--
ALTER TABLE `tesserati`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `formazioni`
--
ALTER TABLE `formazioni`
  ADD CONSTRAINT `formazioni_ibfk_1` FOREIGN KEY (`id_giornata`) REFERENCES `giornate` (`id`),
  ADD CONSTRAINT `formazioni_ibfk_2` FOREIGN KEY (`id_calciatore`) REFERENCES `calciatori` (`id`);

--
-- Limiti per la tabella `squadre`
--
ALTER TABLE `squadre`
  ADD CONSTRAINT `squadre_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id`);

--
-- Limiti per la tabella `tesserati`
--
ALTER TABLE `tesserati`
  ADD CONSTRAINT `tesserati_ibfk_1` FOREIGN KEY (`id_squadra`) REFERENCES `squadre` (`id`),
  ADD CONSTRAINT `tesserati_ibfk_2` FOREIGN KEY (`id_calciatore`) REFERENCES `calciatori` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
