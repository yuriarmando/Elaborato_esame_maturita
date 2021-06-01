-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 31, 2021 alle 12:03
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 8.0.2

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
-- Struttura della tabella `argomento`
--

CREATE TABLE `argomento` (
  `idargomento` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `descargomento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `argomento`
--

INSERT INTO `argomento` (`idargomento`, `idmateria`, `descargomento`) VALUES
(1, 1, 'Il neorealismo e i suoi autori'),
(2, 3, 'Progettazione di un sito web collegato a un database'),
(3, 2, 'I frattali');

-- --------------------------------------------------------

--
-- Struttura della tabella `log`
--

CREATE TABLE `log` (
  `idlog` int(11) NOT NULL,
  `datalog` date NOT NULL,
  `desclog` varchar(50) NOT NULL,
  `idtesina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `log`
--

INSERT INTO `log` (`idlog`, `datalog`, `desclog`, `idtesina`) VALUES
(27, '2030-05-21', 'file caricato', 86),
(62, '2031-05-21', 'file caricato', 132);

-- --------------------------------------------------------

--
-- Struttura della tabella `materie`
--

CREATE TABLE `materie` (
  `idmateria` int(11) NOT NULL,
  `nomemateria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `materie`
--

INSERT INTO `materie` (`idmateria`, `nomemateria`) VALUES
(1, 'italiano'),
(2, 'matematica'),
(3, 'informatica');

-- --------------------------------------------------------

--
-- Struttura della tabella `scuole`
--

CREATE TABLE `scuole` (
  `idscuola` int(11) NOT NULL,
  `nomescuola` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `scuole`
--

INSERT INTO `scuole` (`idscuola`, `nomescuola`) VALUES
(123, 'ITIS M. DELPOZZO'),
(312, 'ITC F.A. BONELLI'),
(392, 'LICEO SCIENTIFICO G.PEANO');

-- --------------------------------------------------------

--
-- Struttura della tabella `tesina`
--

CREATE TABLE `tesina` (
  `idtesina` int(11) NOT NULL,
  `nometesina` varchar(100) NOT NULL,
  `idautore` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `datapubb` date NOT NULL,
  `datacomp` date NOT NULL,
  `idArgomento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tesina`
--

INSERT INTO `tesina` (`idtesina`, `nometesina`, `idautore`, `idmateria`, `datapubb`, `datacomp`, `idArgomento`) VALUES
(86, 'provaneorealismo2.txt', 19, 3, '2030-05-21', '2021-05-01', 2),
(132, 'Lezione_6-FTP-SMTPaa1718 (1) (2).pdf', 19, 3, '2031-05-21', '2021-05-14', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `IDutente` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `anonimo` tinyint(1) NOT NULL,
  `amministratore` tinyint(1) DEFAULT 0,
  `idscuola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`IDutente`, `username`, `password`, `nome`, `cognome`, `email`, `anonimo`, `amministratore`, `idscuola`) VALUES
(12, 'bassibassi', 'bassi', 'Francesco', 'Bassignana', 'bassi@tesina.com', 1, 0, 123),
(16, 'yuriarmando', 'yuri', 'Yuri ', 'Armando', 'yuri.armando@icloud.com', 1, 0, 123),
(18, 'asas', '9987d22788e810116a45109f2ea88648', 'Andrea', 'Cardinale', 'yuripino709@hotmail.com', 1, 0, 392),
(19, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Signor', 'Admin', 'admin@thesis.com', 0, 1, 392);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `argomento`
--
ALTER TABLE `argomento`
  ADD PRIMARY KEY (`idargomento`),
  ADD KEY `idmateria` (`idmateria`);

--
-- Indici per le tabelle `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `log_ibfk_1` (`idtesina`);

--
-- Indici per le tabelle `materie`
--
ALTER TABLE `materie`
  ADD PRIMARY KEY (`idmateria`);

--
-- Indici per le tabelle `scuole`
--
ALTER TABLE `scuole`
  ADD PRIMARY KEY (`idscuola`);

--
-- Indici per le tabelle `tesina`
--
ALTER TABLE `tesina`
  ADD PRIMARY KEY (`idtesina`),
  ADD KEY `idautore` (`idautore`),
  ADD KEY `idmateria` (`idmateria`),
  ADD KEY `idArgomento` (`idArgomento`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`IDutente`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idscuola` (`idscuola`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `argomento`
--
ALTER TABLE `argomento`
  MODIFY `idargomento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `log`
--
ALTER TABLE `log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT per la tabella `materie`
--
ALTER TABLE `materie`
  MODIFY `idmateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `tesina`
--
ALTER TABLE `tesina`
  MODIFY `idtesina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `IDutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `argomento`
--
ALTER TABLE `argomento`
  ADD CONSTRAINT `argomento_ibfk_1` FOREIGN KEY (`idmateria`) REFERENCES `materie` (`idmateria`);

--
-- Limiti per la tabella `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`idtesina`) REFERENCES `tesina` (`idtesina`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tesina`
--
ALTER TABLE `tesina`
  ADD CONSTRAINT `tesina_ibfk_1` FOREIGN KEY (`idautore`) REFERENCES `utenti` (`IDutente`),
  ADD CONSTRAINT `tesina_ibfk_4` FOREIGN KEY (`idmateria`) REFERENCES `materie` (`idmateria`),
  ADD CONSTRAINT `tesina_ibfk_5` FOREIGN KEY (`idArgomento`) REFERENCES `argomento` (`idargomento`);

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`idscuola`) REFERENCES `scuole` (`idscuola`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
