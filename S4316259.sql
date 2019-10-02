-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Ott 02, 2019 alle 16:45
-- Versione del server: 5.5.55-0+deb8u1
-- PHP Version: 7.0.19-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `S4316259`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisti`
--

CREATE TABLE IF NOT EXISTS `acquisti` (
  `IdProdotto` int(10) NOT NULL,
  `IdUtente` int(20) NOT NULL,
  `Quantita` int(5) NOT NULL,
  `Acquistato` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `acquisti`
--

INSERT INTO `acquisti` (`IdProdotto`, `IdUtente`, `Quantita`, `Acquistato`) VALUES
(1, 1, 11, 1),
(1, 8, 1, 1),
(2, 1, 3, 1),
(2, 8, 6, 0),
(2, 8, 3, 1),
(2, 18, 1, 1),
(3, 1, 2, 1),
(3, 8, 7, 1),
(3, 19, 3, 1),
(4, 8, 1, 1),
(5, 1, 4, 1),
(5, 8, 3, 1),
(6, 1, 1, 1),
(6, 8, 7, 1),
(7, 8, 1, 1),
(13, 18, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `donazioni`
--

CREATE TABLE IF NOT EXISTS `donazioni` (
`IdDonazione` int(10) NOT NULL,
  `IdUtente` int(20) NOT NULL,
  `Somma` int(11) NOT NULL,
  `DataDonazione` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `donazioni`
--

INSERT INTO `donazioni` (`IdDonazione`, `IdUtente`, `Somma`, `DataDonazione`) VALUES
(1, 1, 50, '2019-01-18'),
(2, 1, 100, '2019-01-18'),
(3, 1, 200, '2019-01-18'),
(4, 1, 200, '2019-01-18'),
(5, 1, 1, '2019-01-18'),
(6, 8, 666, '2019-01-25'),
(7, 8, 666, '2019-01-25'),
(8, 9, 16112013, '2019-01-26'),
(9, 8, 42, '2019-01-28'),
(10, 8, 50, '2019-01-29'),
(11, 1, 309, '2019-04-03'),
(12, 1, 20, '2019-04-10'),
(13, 20, 2147483647, '2019-06-03');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE IF NOT EXISTS `prodotti` (
`IdProdotto` int(10) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `TipoProdotto` int(1) NOT NULL,
  `Descrizione` text,
  `Immagine` varchar(300) NOT NULL DEFAULT '../immagini/prodotti/predefinita.jpg',
  `Prezzo` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`IdProdotto`, `Nome`, `TipoProdotto`, `Descrizione`, `Immagine`, `Prezzo`) VALUES
(1, 'Arneis', 1, 'E'' uno dei migliori vini bianchi del Piemonte e d''Italia, con il suo retrogusto di mandorla amara e gli aromi di fiori e frutta che lo rendono assolutamente unico.', '../immagini/prodotti/predefinita.jpg', '100'),
(2, 'Cinque Terre', 1, 'Tra i pi&ugrave; famosi vini bianchi secchi, o dello Sciacchetr&agrave;, un vino liquoroso ottenuto da uva passita.', '../immagini/prodotti/predefinita.jpg', '20'),
(3, 'Gewurztraminer', 1, 'Fresco e ricercato, &egrave; un vino bianco pregiato che si pu&ograve; abbinare con successo alle ricche pietanze della cucina locale trentina.', '../immagini/prodotti/predefinita.jpg', '5'),
(4, 'Barolo', 0, 'Meraviglioso vino da arrosto che si produce con le uve di Nebbiolo delle sottovariet&agrave; Michet, Lampia e Ros&eacute; maturate in una ristretta zona delle Langhe che fa capo a Barolo in provincia di Cuneo. Ha un colore rosso granato con riflessi arancioni; profumo caratteristico, etereo, gradevole, intenso; sapore asciutto, pieno, robusto, austero ma vellutato.', '../immagini/prodotti/predefinita.jpg', '15'),
(5, 'Bracchetto d''Acqui', 0, 'Esclusivamente con le uve del vitigno Brachetto, provenienti da vigneo ACQUI ti collinari situati nei territori amministrativi di diciotto comuni della provincia di Asti e di otto comuni della provincia di Alessandria, tra cui Acqui Terme, si ottiene questo tipico vino dal colore rosso rubino di media intensit&agrave; e tendente al granato chiaro o rosato; aroma muschiato, molto delicato, caratteristico; sapore dolce, morbido, delicato.', '../immagini/prodotti/predefinita.jpg', '18'),
(6, 'Cabernet', 0, 'Con le uve di Cabernet Franc e/o Sauvignon e/o Carmen&egrave;re, a cui possono essere aggiunte quelle di altri vitigni a bacca rossa, non aromatici, raccomandati o autorizzati nelle due pro- vince interessate; ha colore rosso rubino carico, talvolta tendente al granato; odore gradevole, con profumo pi&ugrave; intenso se invecchiato; sapore asciutto, armonico, vellutato se invecchiato.', '../immagini/prodotti/predefinita.jpg', '30'),
(7, 'Passito', 0, 'Prodotto nella zona di Bagnoli di Sopra con le uve di Raboso Piave e/o Raboso veronese (minimo 70%) appassite in vigneto o in locali idonei; ha colore rosso rubino pi&ugrave; o meno intenso, tendente al granato se invecchiato; odore caratteristico, gradevole; sapore amabile, vellutato, caratteristico. ', '../immagini/prodotti/predefinita.jpg', '6'),
(13, 'Cerasuolo', 2, 'Questo vino deve il nome al suo colore ciliegia (in dialetto abruzzese â€œcerasaâ€ significa â€œciliegiaâ€). Ottenuto dalle stesse uve con cui si produce il Montepulciano dâ€™Abruzzo (il Cerasuolo Ã¨ una sua variante), il Cerasuolo ha un gusto fruttato, dal sapore secco, morbido e con retrogusto mandorlato.', '../immagini/prodotti/predefinita.jpg', '9');

-- --------------------------------------------------------

--
-- Struttura della tabella `ruoli`
--

CREATE TABLE IF NOT EXISTS `ruoli` (
  `IdRuolo` int(1) NOT NULL,
  `NomeRuolo` varchar(50) NOT NULL,
  `Descrizione` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ruoli`
--

INSERT INTO `ruoli` (`IdRuolo`, `NomeRuolo`, `Descrizione`) VALUES
(0, 'Utente', 'Utente generico del sito'),
(1, 'Amministratore', 'Amministra il sito internet in tutte le sue scelte');

-- --------------------------------------------------------

--
-- Struttura della tabella `tipologie`
--

CREATE TABLE IF NOT EXISTS `tipologie` (
  `ID` int(1) NOT NULL,
  `TipoProdotto` varchar(50) NOT NULL,
  `Descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tipologie`
--

INSERT INTO `tipologie` (`ID`, `TipoProdotto`, `Descrizione`) VALUES
(0, 'Vino Rosso', 'Eccoli, i nostri vini rossi! Tutti di altissima qualit&agrave;, perfetti per bere in compagnia del vostro cane con un piatto di carne rossa, costicine di agnello, brasati e formaggi di media stagionatura. Presentano dolci note di frutti di bosco, dal lampone al mirtillo, farete felici anche i vostri migliori amici!'),
(1, 'Vino Bianco', 'Scegliete i nostri vini bianchi! Tutti eleganti e sottili accuratamente selezionati. Presentano aromaticit&agrave; raffinate, delicate e fragranti di mela, albicocca e fiori bianchi, perfetti per piatti di pesce fresco in compagnia!'),
(2, 'Vino Ros&egrave;', 'Diverso ma buono allo stesso tempo, ecco il vino ros&egrave;! Sottovalutato da molti &egrave; perfetto con ogni pietanza, soprattutto con aperitivi e antipasti. Ha un gusto fresco e aromatico allo stesso tempo!');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
`IdUser` int(20) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Nickname` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Ruolo` int(1) NOT NULL DEFAULT '0',
  `Immagine` varchar(150) DEFAULT '../immagini/utenti/predefinita.png',
  `Descrizione` text,
  `DataNascita` date NOT NULL,
  `Sesso` varchar(1) NOT NULL,
  `Cani` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`IdUser`, `Nome`, `Cognome`, `Nickname`, `Password`, `Email`, `Ruolo`, `Immagine`, `Descrizione`, `DataNascita`, `Sesso`, `Cani`) VALUES
(1, 'Enrico', 'Porcile', 'Porci97', 'Binecobi*97', 'enrico.porcile@gmail.com', 1, '../immagini/utenti/Porci97.jpg', '', '1997-07-05', 'M', 0),
(8, '', '', 'cafi', 'lol', 'matteo.carniglia@gmail.com', 1, '../immagini/utenti/cafi.jpg', '', '0000-00-00', 'M', 0),
(9, 'carlotta', 'Agogliati', 'sidera', 'OTmalu10', 'sideramlp@gmail.com', 0, '../immagini/utenti/predefinita.png', NULL, '1997-09-15', 'f', 0),
(10, 'Davide', 'Beghetto ', 'dadog', 'S4249412', 'davidebeghetto@gmail.com', 0, '../immagini/utenti/predefinita.png', NULL, '1996-03-15', 'm', 0),
(18, 'asdfghj', '', 'aaaaaa', '33Caniii', 'aasdfghj@sdfghj.it', 0, '../immagini/utenti/predefinita.png', '', '0000-00-00', 'M', 0),
(19, 'pluto', 'pippo', '1234', 'Qwert111', 'pippo@pluto.it', 0, '../immagini/utenti/predefinita.png', NULL, '2018-11-11', 'm', 20),
(20, 'Test', 'Test', 'giuse', '12345678Aa', 'test@dddd.com', 0, '../immagini/utenti/giuse.jpg', '', '2019-06-05', 'M', 125),
(21, 'Mario', 'Mario', 'mario', 'Test1234', 'Mario@gmail.com', 0, '../immagini/utenti/predefinita.png', NULL, '2019-06-04', 'm', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acquisti`
--
ALTER TABLE `acquisti`
 ADD PRIMARY KEY (`IdProdotto`,`IdUtente`,`Acquistato`), ADD KEY `IdProdotto` (`IdProdotto`), ADD KEY `IdUtente` (`IdUtente`);

--
-- Indexes for table `donazioni`
--
ALTER TABLE `donazioni`
 ADD PRIMARY KEY (`IdDonazione`), ADD KEY `IdUtente` (`IdUtente`);

--
-- Indexes for table `prodotti`
--
ALTER TABLE `prodotti`
 ADD PRIMARY KEY (`IdProdotto`), ADD KEY `TipoProdotto` (`TipoProdotto`);

--
-- Indexes for table `ruoli`
--
ALTER TABLE `ruoli`
 ADD PRIMARY KEY (`IdRuolo`);

--
-- Indexes for table `tipologie`
--
ALTER TABLE `tipologie`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
 ADD PRIMARY KEY (`IdUser`), ADD UNIQUE KEY `Email` (`Email`), ADD UNIQUE KEY `Nickname` (`Nickname`), ADD KEY `Ruolo` (`Ruolo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donazioni`
--
ALTER TABLE `donazioni`
MODIFY `IdDonazione` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `prodotti`
--
ALTER TABLE `prodotti`
MODIFY `IdProdotto` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
MODIFY `IdUser` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `acquisti`
--
ALTER TABLE `acquisti`
ADD CONSTRAINT `acquisti_ibfk_4` FOREIGN KEY (`IdProdotto`) REFERENCES `prodotti` (`IdProdotto`) ON DELETE CASCADE,
ADD CONSTRAINT `acquisti_ibfk_3` FOREIGN KEY (`IdUtente`) REFERENCES `utenti` (`IdUser`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `donazioni`
--
ALTER TABLE `donazioni`
ADD CONSTRAINT `donazioni_ibfk_1` FOREIGN KEY (`IdUtente`) REFERENCES `utenti` (`IdUser`);

--
-- Limiti per la tabella `prodotti`
--
ALTER TABLE `prodotti`
ADD CONSTRAINT `prodotti_ibfk_1` FOREIGN KEY (`TipoProdotto`) REFERENCES `tipologie` (`ID`);

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`Ruolo`) REFERENCES `ruoli` (`IdRuolo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
