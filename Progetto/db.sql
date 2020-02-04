-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 04, 2020 alle 11:38
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `artista_utente`
--

CREATE TABLE `artista_utente` (
  `id_artista` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `genere_artista` int(1) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `artista_utente`
--

INSERT INTO `artista_utente` (`id_artista`, `id_utente`, `genere_artista`, `data`) VALUES
(2, 1, 4, '2020-02-04 10:07:21'),
(3, 1, 4, '2020-02-04 10:08:44'),
(4, 1, 3, '2020-02-04 10:09:35'),
(5, 1, 2, '2020-02-04 10:10:17'),
(6, 1, 1, '2020-02-04 10:10:48');

-- --------------------------------------------------------

--
-- Struttura della tabella `artisti`
--

CREATE TABLE `artisti` (
  `id_artista` int(11) NOT NULL,
  `Artista` varchar(100) NOT NULL,
  `Discendenza` varchar(100) NOT NULL,
  `descrizione_artista` text NOT NULL,
  `immagine_artista` varchar(100) DEFAULT NULL,
  `tipo_artista` varchar(3) NOT NULL,
  `recensione_artista` int(1) NOT NULL,
  `anno_nascita` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `artisti`
--

INSERT INTO `artisti` (`id_artista`, `Artista`, `Discendenza`, `descrizione_artista`, `immagine_artista`, `tipo_artista`, `recensione_artista`, `anno_nascita`) VALUES
(2, 'Van Gogh', 'Puntinismo', 'Fu autore di quasi novecento dipinti[1] e di più di mille disegni, senza contare i numerosi schizzi non portati a termine e i tanti appunti destinati probabilmente all\'imitazione di disegni artistici di provenienza giapponese. Tanto geniale quanto incompreso se non addirittura disprezzato in vita, Van Gogh influenzò profondamente l\'arte del XX secolo; dopo aver trascorso molti anni soffrendo di frequenti disturbi mentali,[2][3] morì all\'età di soli trentasette anni.[4]', 'img/copertine/vg.jpg', '004', 4, '1853'),
(3, 'Picasso', 'Puntinismo', 'Pablo Ruiz y Picasso, semplicemente noto come Pablo Picasso (Malaga, 25 ottobre 1881 – Mougins, 8 aprile 1973), è stato un pittore e scultore spagnolo di fama mondiale, considerato uno dei protagonisti assoluti della pittura del XX secolo.\r\n\r\nSnodo cruciale tra la tradizione ottocentesca e l\'arte contemporanea, Picasso è stato un artista innovatore e poliedrico, che ha lasciato un segno indelebile nella storia dell\'arte mondiale per esser stato il fondatore, insieme a Georges Braque, del cubismo. Dopo aver trascorso una gioventù burrascosa, ben espressa nei quadri dei cosiddetti periodi blu e rosa, a partire dagli anni venti del Novecento conobbe una rapidissima fama: tra le sue opere universalmente conosciute Les demoiselles d\'Avignon (1907) e Guernica (1937).', 'img/copertine/pc.jpg', '001', 4, '1881'),
(4, 'Dali', 'Dada', 'Salvador Dalí, all\'anagrafe Salvador Domènec Felip Jacint Dalí i Domènech, 1º marchese di Dalí de Púbol (AFI: [səɫβəˈðo duˈmɛnək fəˈlip ʒəˈsin ðəˈɫi i duˈmɛnək]; Figueres, 11 maggio 1904 – Figueres, 23 gennaio 1989), è stato un pittore, scultore, scrittore, fotografo, cineasta, designer e sceneggiatore spagnolo.\r\n\r\n\r\nBlasone dei Marchesi di Púbol, concesso a Dalí da re Juan Carlos I di Spagna.\r\nDalí fu un pittore abile e virtuosissimo disegnatore[1], ma celebre anche per le immagini suggestive e bizzarre delle sue opere surrealiste. Il suo peculiare tocco pittorico fu attribuito all\'influenza che ebbero su di lui i maestri del Rinascimento[2][3]. Realizzò La persistenza della memoria, una delle sue opere più famose, nel 1931. Il talento artistico di Dalí trovò espressione in svariati ambiti, tra cui il cinema, la scultura e la fotografia, portandolo a collaborare con artisti di ogni settore.\r\n\r\nFaceva risalire il suo \"amore per tutto ciò che è dorato ed eccessivo, la mia passione per il lusso e la mia predilezione per gli abiti orientali\"[4] a una auto-attribuita \"discendenza araba\", sostenendo che i suoi antenati discendessero dai Mori.\r\n\r\nDalí, dotato di una grande immaginazione e con il vezzo di assumere atteggiamenti stravaganti, irritò coloro che hanno amato la sua arte e infastidì i suoi detrattori, in quanto i suoi modi eccentrici hanno in alcuni casi catturato l\'attenzione più delle sue opere[5].', 'img/copertine/da.jpg', '003', 4, '1904'),
(5, 'Da Vinci', 'Neoclassicismo', 'Leonardo di ser Piero da Vinci (Anchiano, 15 aprile 1452 – Amboise, 2 maggio 1519) è stato un inventore, artista e scienziato italiano.\r\n\r\nUomo d\'ingegno e talento universale[1] del Rinascimento, considerato uno dei più grandi geni dell\'umanità[2][3], incarnò in pieno lo spirito della sua epoca, portandolo alle maggiori forme di espressione nei più disparati campi dell\'arte e della conoscenza: fu infatti scienziato, filosofo, architetto, pittore, scultore, disegnatore, trattatista, scenografo, anatomista, botanico, musicista[4][5][6], ingegnere e progettista.', 'img/copertine/leo.jpg', '001', 4, '1452'),
(6, 'Monet', 'Puntinismo', 'Oscar-Claude Monet (Parigi, 14 novembre 1840 – Giverny, 5 dicembre 1926) è stato un pittore francese, considerato uno dei fondatori dell\'impressionismo francese e certamente il più coerente e prolifico del movimento. I suoi lavori si distinguono per la rappresentazione della sua immediata percezione dei soggetti, in particolar modo per quanto riguarda la paesaggistica e la pittura en plein air.\r\n\r\nDopo un soggiorno a Londra, la sua carriera ebbe una svolta con la mostra del 1874.\r\n\r\nNel 1883 si trasferì a Giverny, in Normandia, dove restò fino alla sua morte nel 1926.', 'img/copertine/mo.jpg', '003', 4, '1940');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `id_commento` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_artista` int(11) NOT NULL,
  `testo_commento` text NOT NULL,
  `data_commento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id_commento`, `id_utente`, `id_artista`, `testo_commento`, `data_commento`) VALUES
(1, 1, 2, 'è un artista fantastico', '2020-02-02 10:03:06'),
(2, 1, 3, 'è un artista fantastico', '2020-02-04 10:03:25'),
(3, 1, 4, 'è un artista fantastico', '2020-02-04 10:04:02'),
(4, 1, 5, 'è un artista fantastico', '2020-02-04 10:04:36'),
(5, 1, 6, 'è un artista fantastico', '2020-02-04 10:05:23');

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo_artista`
--

CREATE TABLE `tipo_artista` (
  `codice_tipo` varchar(3) NOT NULL,
  `nome_tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `tipo_artista`
--

INSERT INTO `tipo_artista` (`codice_tipo`, `nome_tipo`) VALUES
('001', 'Romanticismo'),
('002', 'Neoclassicismo'),
('003', 'Dada'),
('004', 'Puntinismo');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id_utente` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id_utente`, `username`, `password`, `email`) VALUES
(1, 'lucaantonio', '1f55c534c7f5321b5b864f46b1b8c47b', 'antonino@hotmail.com'),
(31, 'ciccio', 'f51828ffcd91c1df13dfec714a89c3f4', 'ciccio@hotmail.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `voto`
--

CREATE TABLE `voto` (
  `id_utente` int(11) NOT NULL,
  `id_artista` int(11) NOT NULL,
  `voto` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `voto`
--

INSERT INTO `voto` (`id_utente`, `id_artista`, `voto`) VALUES
(1, 2, 4),
(1, 3, 4),
(1, 4, 4),
(1, 5, 4),
(1, 6, 4);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `artista_utente`
--
ALTER TABLE `artista_utente`
  ADD PRIMARY KEY (`id_artista`,`id_utente`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `artisti`
--
ALTER TABLE `artisti`
  ADD PRIMARY KEY (`id_artista`),
  ADD KEY `tipo_artista` (`tipo_artista`) USING BTREE;
ALTER TABLE `artisti` ADD FULLTEXT KEY `Artista` (`Artista`);
ALTER TABLE `artisti` ADD FULLTEXT KEY `Discendenza` (`Discendenza`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`id_commento`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `id_artista` (`id_artista`) USING BTREE;

--
-- Indici per le tabelle `tipo_artista`
--
ALTER TABLE `tipo_artista`
  ADD PRIMARY KEY (`codice_tipo`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id_utente`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `voto`
--
ALTER TABLE `voto`
  ADD PRIMARY KEY (`id_utente`,`id_artista`),
  ADD KEY `id_artista` (`id_artista`) USING BTREE;

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `artisti`
--
ALTER TABLE `artisti`
  MODIFY `id_artista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `id_commento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=450;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `artista_utente`
--
ALTER TABLE `artista_utente`
  ADD CONSTRAINT `artista_utente_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artisti` (`id_artista`),
  ADD CONSTRAINT `artista_utente_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`);

--
-- Limiti per la tabella `artisti`
--
ALTER TABLE `artisti`
  ADD CONSTRAINT `artisti_ibfk_1` FOREIGN KEY (`tipo_artista`) REFERENCES `tipo_artista` (`codice_tipo`);

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`),
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`id_artista`) REFERENCES `artisti` (`id_artista`);

--
-- Limiti per la tabella `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `voto_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`),
  ADD CONSTRAINT `voto_ibfk_2` FOREIGN KEY (`id_artista`) REFERENCES `artisti` (`id_artista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
