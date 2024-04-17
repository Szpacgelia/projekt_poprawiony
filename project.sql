-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 09:02 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `user_id`, `date`) VALUES
(42, 'Moja rodzina i ja spędziliśmy wspaniały tydzień w hotelu Eden Haven. To było nasze pierwsze doświadczenie w tym hotelu, ale na pewno nie ostatnie. Baseny były ogromnym hitem dla naszych dzieci, które przez cały dzień mogły korzystać z atrakcji wodnych. Dla nas dorosłych hotel oferował również wiele rozrywek, od relaksujących zabiegów w spa po aktywności sportowe na świeżym powietrzu. Restauracje serwowały pyszne dania z lokalnych produktów, co dodatkowo podkreśliło nasze doświadczenie kulinarnie. W hotelu panowała przyjazna atmosfera, a personel zadbał o to, abyśmy czuli się jak w domu. Gorąco polecam Eden Haven wszystkim rodzinom szukającym doskonałego miejsca na wakacje.', 12, '2024-04-16 18:51:34'),
(43, 'Hotel Eden Haven to idealne miejsce na romantyczny wyjazd we dwoje. Zatrzymaliśmy się tu na naszą rocznicę ślubu i byliśmy zachwyceni. Pokój z widokiem na morze był urządzony ze smakiem i sprawiał wrażenie przytulnego gniazdka miłości. Wieczory spędzaliśmy na spacerach po urokliwych okolicznych uliczkach lub relaksując się w luksusowym spa hotelowym. Restauracje w okolicy oferowały romantyczne kolacje przy świecach i pyszne dania, które przysporzyły nam niezapomnianych doświadczeń kulinarnych. Eden Haven to naprawdę magiczne miejsce, które polecam wszystkim zakochanym parom!', 13, '2024-04-16 18:52:49'),
(44, 'Przyjazny dla rodzin hotel z mnóstwem atrakcji dla dzieci. Nasze dzieci uwielbiały baseny i program animacyjny. Wrócimy tu z całą rodziną!', 14, '2024-04-16 18:53:58');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo_url` varchar(1000) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `photo_url`, `content`) VALUES
(12, 'Nowy Szef Kuchni i Ekskluzywne Menu Degustacyjne', 'uploads/gastronomia_kuchnia.png', 'Z dumą prezentujemy naszego nowego Szefa Kuchni, szefa kuchni Michela, który właśnie dołączył do zespołu Eden Haven. Szef Michel przygotował wyjątkowe menu degustacyjne, które łączy lokalne smaki z międzynarodowym wpływem kulinarnym. Zachęcamy naszych gości do zarezerwowania stołu i doświadczenia niezapomnianych smaków w naszej restauracji.'),
(13, 'Weekendowa Rekreacja dla Całej Rodziny', 'uploads/widoki.jpg', 'Planujesz rodzinny wyjazd? W Eden Haven przygotowaliśmy nową specjalną ofertę na weekendową rekreację dla całej rodziny! Nasze atrakcje obejmują zajęcia dla dzieci, spacery po okolicy, basen dla dzieci i wiele więcej. Spędź czas z bliskimi, odpocznijcie i cieszcie się wspólnymi chwilami w naszym rajskim ośrodku.'),
(14, 'Zaplanuj Swoje Wesele w Eden Haven', 'uploads/sala_weselna.jpg', 'Szukasz idealnego miejsca na swoje wymarzone wesele? Sala weselna Eden Haven to doskonały wybór! Nasz uroczy ośrodek oferuje przepiękne otoczenie, eleganckie sale bankietowe i profesjonalną obsługę, aby Twoje wesele było wyjątkowe i niezapomniane. Skontaktuj się z nami, aby dowiedzieć się więcej o naszych pakietach weselnych i zarezerwować termin.'),
(15, 'Letnia Sielanka w Eden Haven', 'uploads/lato.jpg', 'Wyjątkowe Pakiety Wakacyjne: Lato nadchodzi wielkimi krokami, a wraz z nim nadszedł czas na niezapomnianą sielankę w Eden Haven! Oferujemy specjalne letnie pakiety wakacyjne, które obejmują luksusowe zakwaterowanie, dostęp do wszystkich naszych udogodnień, w tym basenów, spa i restauracji, oraz różnorodne atrakcje na świeżym powietrzu. Zarezerwuj swój urlop już dziś i rozkoszuj się relaksem w naszym rajskim ośrodku!'),
(16, 'Wyjątkowe Spotkania Biznesowe w Eden Haven', 'uploads/sala_konf.jpg', 'Planujesz ważne spotkanie biznesowe lub konferencję? Eden Haven oferuje idealne zaplecze do organizacji udanych wydarzeń biznesowych! Nasze eleganckie sale konferencyjne są wyposażone w najnowocześniejszy sprzęt audiowizualny, a nasz doświadczony personel zapewni profesjonalną obsługę od początku do końca. Skontaktuj się z nami, aby zarezerwować termin i uzyskać więcej informacji na temat naszych pakietów konferencyjnych.'),
(17, 'Ekskluzywne Spa Weekend dla Pary', 'uploads/spa.jpg', 'Czas na odrobinę relaksu i odnowy! Zaplanuj romantyczny weekend w Eden Haven i skorzystaj z naszego ekskluzywnego pakietu spa dla pary. Oferujemy luksusowe zabiegi spa, relaksujące masaże i dostęp do naszych basenów i saun. Odkryj razem z ukochaną osobą siłę relaksu i odprężenia w naszym oazie spokoju. Zarezerwujcie swój pobyt już dziś i stwórzcie wspólne wspomnienia, które będziecie wspominać przez lata!');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `room` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `start_date`, `end_date`, `room`, `user_id`) VALUES
(11, '2024-04-12', '2024-04-20', 1, 1),
(12, '2024-04-01', '2024-04-04', 2, 1),
(13, '2024-04-28', '2024-05-05', 3, 1),
(14, '2024-04-02', '2024-04-18', 3, 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `admin`) VALUES
(1, 'admin', '$2y$10$poAw1qGGtHSD51GV4h/udumQ8awi/vZldqoYznyFEKoRioBxxXur.', 'admin@admin.pl', 1),
(10, 'test', '$2y$10$h3HJ4OU5TBFwY2OSE5at5eZGeMzgu/gZ5XCKfknCayJ3B8EJH63L6', 'test@test.pl', 0),
(12, 'Arek', '$2y$10$QztDfHOkrBCw/zwSdUoHoeNXRNQrnCG5ux4wPsu99snnXjSCL4zL.', 'arek@onet.eu', 0),
(13, 'Janina', '$2y$10$taabz6Gm72YsitpaOeo5UubQRWw5eDaCvo6ZJvbUdEik/epPMUbci', 'janina@interia.pl', 0),
(14, 'Krzysztof', '$2y$10$n92GBoW21ykfKIElYETaperFYMl8b2TkvlYbKV1MwkB5lAv0gYu3W', 'krzysztof@wp.pl', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
