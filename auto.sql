-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 09 2021 г., 22:24
-- Версия сервера: 8.0.19
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `auto`
--
CREATE DATABASE IF NOT EXISTS `auto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `auto`;

-- --------------------------------------------------------

--
-- Структура таблицы `ad`
--

CREATE TABLE `ad` (
  `id` int NOT NULL,
  `year` int NOT NULL COMMENT 'год',
  `engine` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'двигатель',
  `price` float DEFAULT NULL COMMENT 'цена',
  `users_id` int NOT NULL COMMENT 'продавец',
  `marka_auto_id` int NOT NULL COMMENT 'марка'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ad`
--

INSERT INTO `ad` (`id`, `year`, `engine`, `price`, `users_id`, `marka_auto_id`) VALUES
(3, 12300, 'бензин', 123, 1, 2),
(4, 1989, 'disel', 1000, 2, 3),
(5, 1989, 'бензин', 123, 2, 2),
(6, 1989, 'бензин', 1000, 3, 4),
(8, 1989, 'disel', 709, 1, 3),
(9, 2021, 'бензин', 12500, 2, 2),
(10, 2022, 'бензин', 23000, 2, 5),
(11, 1999, 'disel', 10007, 1, 5),
(12, 2022, 'disel', 29000, 2, 5),
(13, 2023, 'disel', 21000, 2, 2),
(14, 2022, 'бензин', 11000, 2, 5),
(15, 1905, 'бензин', 38000, 1, 3),
(16, 2002, 'бензин', 2560, 4, 4),
(18, 2014, 'бензин', 2400, 4, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `marka_auto`
--

CREATE TABLE `marka_auto` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `marka_auto`
--

INSERT INTO `marka_auto` (`id`, `name`) VALUES
(1, 'opel'),
(2, 'Lada'),
(3, 'Reno'),
(4, 'Nissan'),
(5, 'Audi');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `user_groups_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `user_groups_id`) VALUES
(1, 'OLeg ', 'Lego', '888', 2),
(2, 'Nina', 'nina1', 'ed81cfe8ce2b8a95572c6126aeb5d45c', 2),
(3, 'Gena', 'gena1', '12b5e2cf0cf63b866ee597ff761ed124', 2),
(4, 'Fedor', 'fedor1', '1326da349743aa8189f8605277139d82', 2),
(5, 'Rita', 'rita1', 'ad8b629bb137e8ecd7a1e45344fd5a92', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `code`) VALUES
(1, 'Администраторы', 'admin'),
(2, 'Гость', 'guest'),
(3, 'Продавец', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`id`,`year`),
  ADD KEY `fk_ad_Users1_idx` (`users_id`),
  ADD KEY `fk_ad_marka_auto1_idx` (`marka_auto_id`);

--
-- Индексы таблицы `marka_auto`
--
ALTER TABLE `marka_auto`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Users_User_groups1_idx` (`user_groups_id`);

--
-- Индексы таблицы `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ad`
--
ALTER TABLE `ad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `marka_auto`
--
ALTER TABLE `marka_auto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `ad`
--
ALTER TABLE `ad`
  ADD CONSTRAINT `fk_ad_marka_auto1` FOREIGN KEY (`marka_auto_id`) REFERENCES `marka_auto` (`id`),
  ADD CONSTRAINT `fk_ad_Users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_Users_User_groups1` FOREIGN KEY (`user_groups_id`) REFERENCES `user_groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
