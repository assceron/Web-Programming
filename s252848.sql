-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 18, 2018 alle 14:58
-- Versione del server: 10.1.33-MariaDB
-- Versione PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s252848`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `rectagle`
--

CREATE TABLE `rectagle` (
  `riga` int(11) NOT NULL,
  `colonna` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `rectagle`
--

INSERT INTO `rectagle` (`riga`, `colonna`, `user_id`, `time`) VALUES
(1, 3, 18, '2018-07-18 03:27:37'),
(1, 4, 18, '2018-07-18 03:27:37'),
(1, 5, 18, '2018-07-18 03:27:37'),
(1, 6, 18, '2018-07-18 03:27:37'),
(3, 0, 17, '2018-07-18 03:27:05'),
(4, 0, 17, '2018-07-18 03:27:05'),
(5, 0, 17, '2018-07-18 03:27:05'),
(6, 0, 17, '2018-07-18 03:27:05');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_pwd`) VALUES
(17, 'u1@p.it', '$2y$10$1oLQPn.TBf46vHujWP5xauQ/on3EWapfcoQcJFx1IoTwzEphsA8zW'),
(18, 'u2@p.it', '$2y$10$lWAGpOkptuSXU3WxEU47s.W0guy6iz8hryg.7YEr/jPs7K3WFjNlu');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `rectagle`
--
ALTER TABLE `rectagle`
  ADD PRIMARY KEY (`riga`,`colonna`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
