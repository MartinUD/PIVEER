-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 20 maj 2024 kl 13:24
-- Serverversion: 10.4.28-MariaDB
-- PHP-version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `arendehanteringdatabas`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `issues`
--

CREATE TABLE `issues` (
  `title` text NOT NULL,
  `required_role` text NOT NULL,
  `id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `issuer` text NOT NULL,
  `assinged_to` text NOT NULL,
  `issue_conversation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `issues`
--

INSERT INTO `issues` (`title`, `required_role`, `id`, `date`, `issuer`, `assinged_to`, `issue_conversation`) VALUES
('Test1', 'user', 3, '2024-04-26', 'Mohammed Admin', 'Abdul Twopac', '{\r\n    \"conversation\": {\r\n        \"msg1\": {\r\n            \"text\": \"pedo pedo pedo\",\r\n            \"timestamp\": \"24-24-24\",\r\n            \"user\": \"admin\"\r\n        },\r\n        \"msg2\": {\r\n            \"text\": \"yeah yeah yeah\",\r\n            \"timestamp\": \"24-24-24\",\r\n            \"user\": \"abdul\"\r\n        },\r\n        \"msg3\": {\r\n            \"text\": \"test\",\r\n            \"timestamp\": \"2024-05-13\",\r\n            \"user\": \"Abdul\"\r\n        },\r\n        \"msg4\": {\r\n            \"text\": \"testa msg4?\",\r\n            \"timestamp\": \"2024-05-13\",\r\n            \"user\": \"Abdul\"\r\n        },\r\n        \"msg5\": {\r\n            \"text\": \"testa msg4\",\r\n            \"timestamp\": \"2024-05-13\",\r\n            \"user\": \"Abdul\"\r\n        },\r\n        \"msg6\": {\r\n            \"text\": \"testa msg5\",\r\n            \"timestamp\": \"2024-05-13\",\r\n            \"user\": \"Abdul\"\r\n        },\r\n        \"msg7\": {\r\n            \"text\": \"testa msg5\",\r\n            \"timestamp\": \"2024-05-13\",\r\n            \"user\": \"Abdul\"\r\n        }\r\n    }\r\n}'),
('Test2', 'user', 4, '2024-04-26', 'Mohammed Admin', 'Abdul Twopac', '{\n    \"conversation\": {\n        \"msg1\": {\n            \"text\": \"pedo pedo pedo\",\n            \"timestamp\": \"24-24-24\",\n            \"user\": \"admin\"\n        },\n        \"msg2\": {\n            \"text\": \"yeah yeah yeah\",\n            \"timestamp\": \"24-24-24\",\n            \"user\": \"abdul\"\n        },\n        \"msg3\": {\n            \"text\": \"test\",\n            \"timestamp\": \"2024-05-13\",\n            \"user\": \"Abdul\"\n        },\n        \"msg4\": {\n            \"text\": \"testa msg4?\",\n            \"timestamp\": \"2024-05-13\",\n            \"user\": \"Abdul\"\n        },\n        \"msg5\": {\n            \"text\": \"testa msg4\",\n            \"timestamp\": \"2024-05-13\",\n            \"user\": \"Abdul\"\n        },\n        \"msg6\": {\n            \"text\": \"testa msg5\",\n            \"timestamp\": \"2024-05-13\",\n            \"user\": \"Abdul\"\n        },\n        \"msg7\": {\n            \"text\": \"testa msg5\",\n            \"timestamp\": \"2024-05-13\",\n            \"user\": \"Abdul\"\n        }\n    }\n}');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` int(11) NOT NULL,
  `role` text NOT NULL,
  `full_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `role`, `full_name`) VALUES
(1, 'admin', 12345, 'owner', 'Mohammed Admin'),
(2, 'Ali', 12345, 'worker', 'Ali Shakur'),
(3, 'Abdul', 12345, 'user', 'Abdul Twopac');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
