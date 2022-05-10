-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Maj 2022, 15:15
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12
 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
 
 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
 
--
-- Baza danych: `księgarnia`
--
 
-- --------------------------------------------------------
 
--
-- Struktura tabeli dla tabeli `autor`
--
 
CREATE TABLE `autor` (
  `id_auora` int(10) NOT NULL,
  `Nazwisko` varchar(20) DEFAULT NULL,
  `Imie` varchar(20) DEFAULT NULL,
  `Narodowosc` varchar(20) DEFAULT NULL,
  `Okres_Wydania` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
--
-- Zrzut danych tabeli `autor`
--
 
INSERT INTO `autor` (`id_auora`, `Nazwisko`, `Imie`, `Narodowosc`, `Okres_Wydania`) VALUES
(1, 'Pala', 'Michal', 'Polska', '0000-00-00'),
(2, 'Palad', 'Michal', 'Polska', '0000-00-00');
 
-- --------------------------------------------------------
 
--
-- Struktura tabeli dla tabeli `klient`
--
 
CREATE TABLE `klient` (
  `id_klient` int(10) UNSIGNED NOT NULL,
  `Nazwisko` varchar(15) DEFAULT NULL,
  `Imie` varchar(20) DEFAULT NULL,
  `Adres` varchar(25) DEFAULT NULL,
  `Telefon` int(10) DEFAULT NULL,
  `Email` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
--
-- Zrzut danych tabeli `klient`
--
 
INSERT INTO `klient` (`id_klient`, `Nazwisko`, `Imie`, `Adres`, `Telefon`, `Email`) VALUES
(1, 'Pala', 'Michal', 'Ham', 123456789, 'jdpsa@gmail.com'),
(2, 'Palkowski', 'Pawel', 'Buczynowa', 201313132, 'maly@gmail.com'),
(3, 'Palakowski', 'Michal', 'Balakowska', 123, 'michalpalkwos@g');
 
-- --------------------------------------------------------
 
--
-- Struktura tabeli dla tabeli `ksiazka`
--
 
CREATE TABLE `ksiazka` (
  `idKsiazka` int(10) NOT NULL,
  `Autor_id_auora` int(10) NOT NULL,
  `tytul` varchar(20) DEFAULT NULL,
  `miejsce_wydania` varchar(20) DEFAULT NULL,
  `Rok_wydania` varchar(4) NOT NULL,
  `wydawnictwo` varchar(20) NOT NULL,
  `cena` varchar(20) NOT NULL,
  `jezyk_wydania` varchar(20) NOT NULL,
  `Imie` varchar(20) NOT NULL,
  `Nazwisko` varchar(20) NOT NULL,
  `Osiągniecia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
--
-- Zrzut danych tabeli `ksiazka`
--
 
INSERT INTO `ksiazka` (`idKsiazka`, `Autor_id_auora`, `tytul`, `miejsce_wydania`, `Rok_wydania`, `wydawnictwo`, `cena`, `jezyk_wydania`, `Imie`, `Nazwisko`, `Osiągniecia`) VALUES
(1, 2313, 'Niewiem', 'Polska', '2000', 'Helion', '120.00 zł', 'Niemiecki', 'Paweł', 'Pawłowski', ''),
(2, 2445, 'HALO', 'Polska', '2001', 'Helion', '100.00 zł', 'Angielski', 'Julia', 'Kowalczuk', ''),
(3, 9921, 'idahfosa', 'Anglia', '2010', 'Helion', '75.00 zł', 'Angielski', 'Kamil', 'Karaś', ''),
(4, 8913, 'sjgdhbaf', 'Gdzies w Polsce', '2020', 'Gelion', '99.99 zł', 'Niemiecki', 'Bartosz', 'Walczuk', '');
 
-- --------------------------------------------------------
 
--
-- Struktura tabeli dla tabeli `zamowienia`
--
 
CREATE TABLE `zamowienia` (
  `id_zamowienia` int(20) UNSIGNED NOT NULL,
  `Klient_id_klient` int(20) UNSIGNED NOT NULL,
  `Data_Zamowienia` date DEFAULT NULL,
  `Data_Wysylki` date DEFAULT NULL,
  `Koszt_Wysylki` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
--
-- Zrzut danych tabeli `zamowienia`
--
 
INSERT INTO `zamowienia` (`id_zamowienia`, `Klient_id_klient`, `Data_Zamowienia`, `Data_Wysylki`, `Koszt_Wysylki`) VALUES
(21012, 123, '2012-12-12', '0000-00-00', 30),
(32131, 2133, '0000-00-00', '0000-00-00', 50),
(321312, 2133, '0000-00-00', '0000-00-00', 50);
 
-- --------------------------------------------------------
 
--
-- Struktura tabeli dla tabeli `zamowienia_has_ksiazka`
--
 
CREATE TABLE `zamowienia_has_ksiazka` (
  `Zamowienia_id_zamowienia` int(10) UNSIGNED NOT NULL,
  `Ksiazka_idKsiazka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
--
-- Indeksy dla zrzutów tabel
--
 
--
-- Indeksy dla tabeli `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id_auora`);
 
--
-- Indeksy dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id_klient`);
 
--
-- Indeksy dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  ADD PRIMARY KEY (`idKsiazka`),
  ADD KEY `Ksiazka_FKIndex1` (`Autor_id_auora`);
 
--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id_zamowienia`),
  ADD KEY `Zamowienia_FKIndex1` (`Klient_id_klient`);
 
--
-- Indeksy dla tabeli `zamowienia_has_ksiazka`
--
ALTER TABLE `zamowienia_has_ksiazka`
  ADD PRIMARY KEY (`Zamowienia_id_zamowienia`,`Ksiazka_idKsiazka`),
  ADD KEY `Zamowienia_has_Ksiazka_FKIndex1` (`Zamowienia_id_zamowienia`),
  ADD KEY `Zamowienia_has_Ksiazka_FKIndex2` (`Ksiazka_idKsiazka`);
 
--
-- AUTO_INCREMENT dla zrzuconych tabel
--
 
--
-- AUTO_INCREMENT dla tabeli `autor`
--
ALTER TABLE `autor`
  MODIFY `id_auora` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
 
--
-- AUTO_INCREMENT dla tabeli `klient`
--
ALTER TABLE `klient`
  MODIFY `id_klient` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
 
--
-- AUTO_INCREMENT dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  MODIFY `idKsiazka` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
 
--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id_zamowienia` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321313;
COMMIT;
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
