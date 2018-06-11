-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Giu 11, 2018 alle 14:39
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

-- --------------------------------------------------------

--
-- Struttura della tabella `squadre`
--

CREATE TABLE `squadre` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `id_utente` int(11) DEFAULT NULL
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
  `password` varchar(15) NOT NULL,
  `timestamp` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD KEY `id_squadra` (`id_squadra`),
  ADD KEY `id_calciatore` (`id_calciatore`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `formazioni`
--
ALTER TABLE `formazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `giornate`
--
ALTER TABLE `giornate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
