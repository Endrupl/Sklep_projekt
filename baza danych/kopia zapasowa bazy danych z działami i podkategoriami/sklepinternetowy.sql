-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Gru 2017, 17:30
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklepinternetowy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dzialy`
--

CREATE TABLE `dzialy` (
  `idDzialu` int(3) NOT NULL,
  `nazwa` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `dzialy`
--

INSERT INTO `dzialy` (`idDzialu`, `nazwa`) VALUES
(1, 'Elektronika');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `idKategorii` int(3) NOT NULL,
  `nazwa` varchar(20) NOT NULL,
  `idDzialu` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`idKategorii`, `nazwa`, `idDzialu`) VALUES
(1, 'RTV i AGD', 1),
(2, 'Laptopy', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyki`
--

CREATE TABLE `koszyki` (
  `idKoszyka` int(5) NOT NULL,
  `idKonta` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `koszyki`
--

INSERT INTO `koszyki` (`idKoszyka`, `idKonta`) VALUES
(1, 1),
(2, 5),
(3, 3),
(5, 6),
(6, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `podkategorie`
--

CREATE TABLE `podkategorie` (
  `idPodkategorii` int(3) NOT NULL,
  `nazwa` varchar(20) NOT NULL,
  `idKategorii` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `podkategorie`
--

INSERT INTO `podkategorie` (`idPodkategorii`, `nazwa`, `idKategorii`) VALUES
(1, 'AGD do zabudowy', 1),
(2, 'Acer', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `idProduktu` int(5) NOT NULL,
  `nazwa` varchar(20) NOT NULL,
  `cena` double(7,2) NOT NULL,
  `liczba` int(3) NOT NULL,
  `opisSlowny` varchar(250) DEFAULT NULL,
  `idPodkategorii` int(3) NOT NULL,
  `Zdjecie` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`idProduktu`, `nazwa`, `cena`, `liczba`, `opisSlowny`, `idPodkategorii`, `Zdjecie`) VALUES
(1, 'LAPTOP ACER A515 FHD', 120.00, 21, 'Acer Aspire 5 i5-7200U 2x2.50-3,10GHz/15,6 ...', 2, 'Zdjecia/laptop_acer_a515_fhd.jpg'),
(2, 'ACER SPIN 5 SP531 i5', 2399.00, 92, 'Szybki, niezawodny, bezkompromisowy ...', 2, 'Zdjecia/acer_spin_5_sp531_i5.jpg'),
(3, 'ACER ASPIRE V13 i3 2', 255.00, 0, 'SPECYFIKACJA TECHNICZNA \r\nPROCESOR  INTEL CORE i3-4005U 2x1.7GHz \r\nMATRYCA  13.3\" 1366x768 MATOWA\r\nPAMIĘĆ RAM  4GB ', 2, 'Zdjecia/acer_aspire_v13_i3.jpg'),
(4, 'OKAP KUCHENNY CUBA K', 265.00, 93, 'Ergonomiczne sterowanie mechaniczne ...', 1, 'Zdjecia/okap_kuchenny_cuba.jpg'),
(5, 'Lodówka do zabudowy ', 2829.00, 20, 'Lodówka do zabudowySamsung BRB260 ...', 1, 'Zdjecia/lodowka_do_zabudowy.jpg'),
(6, 'OKAP TELESKOPOWY KUC', 169.00, 216, 'Okap kuchenny marki Berdsen, model BT-230 ...', 1, 'Zdjecia/okap_teleskopowy_kuchenny.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `idUzytkownika` int(5) NOT NULL,
  `login` varchar(15) NOT NULL,
  `haslo` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `nazwisko` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `imie` varchar(30) DEFAULT NULL,
  `ulica` varchar(30) DEFAULT NULL,
  `nrMieszkania` varchar(10) DEFAULT NULL,
  `nrDomu` varchar(10) DEFAULT NULL,
  `miasto` varchar(30) DEFAULT NULL,
  `kodPocztowy` varchar(6) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL,
  `zablokowany` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`idUzytkownika`, `login`, `haslo`, `email`, `nazwisko`, `imie`, `ulica`, `nrMieszkania`, `nrDomu`, `miasto`, `kodPocztowy`, `admin`, `zablokowany`) VALUES
(1, 'andrzej', '$2y$10$Ti1ibz9BCW1kbs8FEmn1UuMuUnWeOWL0bStymrDDQgYGyD5Fdop2C', 'andrzej@halina.pl', 'Świderski', 'Andrzej', 'Kotlet', '', '3', '', '18-412', 1, b'0'),
(2, 'tester', '$2y$10$nzdSPEWplFE9zGQImgo1IuG0jF1tZWLUILbVT97hM1rWgikunbX2O', 'tester@tester.pl', 'Kowalski', 'Jan', 'Zachlapana', '', '10', '', '00-999', 0, b'0'),
(3, 'maxior', '$2y$10$xosYDXo4rS5dqo5vK8mNR.NcSxfY9jMPcX.1Xj7Kj1PKWyVSfPrIm', 'maks@o2.pl', 'GÅ‚owacki', 'Maksymilian', 'Waska', '', '3a', 'Rydzewo', '18-412', 0, b'0'),
(4, 'antek', '$2y$10$95RtM8ZrOEEOmu1RR1QPxuKuO49SqVp.t8WoJqevWybTz4jUPMJ/e', 'antek@o2.pl', 'Macierewicz', 'Antoni', 'Narobisie', '0', '', 'Wojskwow', '00-210', 1, b'1'),
(5, 'beatris', '$2y$10$MbVGguST9RVqTHMobwu.ueKZeoX2DG/XrN2Uib1E6D.rPNg3KMO9.', 'beata@o2.pl', 'Pierdzimaka', 'Beata', 'Kotleta 1', '', '2', 'Pulpeciki', '00-000', 0, b'1'),
(6, 'Halinka', '$2y$10$6BR6QPvZ3MuDIGfAO325kOpNHmPXwSTMY9rTv4KXe0XwAebJn87Uq', 'dudul@halina.pl', 'Macmilan', 'Johny', 'Smyczkowa 5/7', '31', '31', 'Warsaw', '00-001', 0, b'0'),
(7, 'pantadeusz', '$2y$10$M4mCSDjNzMJXcmpVM7f4vuI0BaKdBE7p25P.uDN5H.FkOHOPL0OpO', 'pan@tadeusz.pl', 'Tadeusz', 'Pan', 'Tadeuszowska', '22', '22', 'Panowo', '20-171', 0, b'0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `idZamowienia` int(6) NOT NULL,
  `idProduktu` int(5) NOT NULL,
  `dataZamowienia` date NOT NULL,
  `liczba` int(3) NOT NULL,
  `stanPotwierdzenia` tinyint(1) NOT NULL,
  `stanRealizacji` tinyint(1) NOT NULL,
  `idKoszyka` int(5) NOT NULL,
  `cena` double(5,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`idZamowienia`, `idProduktu`, `dataZamowienia`, `liczba`, `stanPotwierdzenia`, `stanRealizacji`, `idKoszyka`, `cena`) VALUES
(1, 1, '2017-12-12', 1, 1, 1, 1, 100.00),
(2, 6, '2017-12-12', 2, 0, 0, 3, 100.00),
(3, 5, '2017-12-13', 2, 1, 1, 3, 100.00),
(4, 4, '2017-12-06', 1, 0, 0, 3, 100.00),
(5, 1, '2017-12-05', 2, 0, 0, 3, 100.00),
(6, 3, '2017-12-20', 1, 1, 1, 5, 100.00),
(7, 1, '2017-12-20', 1, 1, 1, 1, 100.00),
(8, 1, '2017-12-20', 1, 1, 1, 5, 100.00),
(9, 4, '2017-12-20', 2, 1, 1, 5, 100.00),
(10, 1, '2017-12-20', 1, 1, 0, 5, 100.00),
(11, 1, '2017-12-22', 1, 1, 0, 6, 100.00),
(12, 1, '2017-12-22', 1, 0, 0, 6, 1.00);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `dzialy`
--
ALTER TABLE `dzialy`
  ADD PRIMARY KEY (`idDzialu`);

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`idKategorii`),
  ADD KEY `idDzialu` (`idDzialu`);

--
-- Indexes for table `koszyki`
--
ALTER TABLE `koszyki`
  ADD PRIMARY KEY (`idKoszyka`),
  ADD KEY `idKonta` (`idKonta`);

--
-- Indexes for table `podkategorie`
--
ALTER TABLE `podkategorie`
  ADD PRIMARY KEY (`idPodkategorii`),
  ADD KEY `idKategorii` (`idKategorii`);

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`idProduktu`),
  ADD KEY `idPodkategorii` (`idPodkategorii`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`idUzytkownika`);

--
-- Indexes for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`idZamowienia`),
  ADD KEY `idProduktu` (`idProduktu`),
  ADD KEY `idKoszyka` (`idKoszyka`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `dzialy`
--
ALTER TABLE `dzialy`
  MODIFY `idDzialu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `idKategorii` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `koszyki`
--
ALTER TABLE `koszyki`
  MODIFY `idKoszyka` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `podkategorie`
--
ALTER TABLE `podkategorie`
  MODIFY `idPodkategorii` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `idProduktu` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `idUzytkownika` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `idZamowienia` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
