-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 16 2018 г., 17:32
-- Версия сервера: 5.7.19-log
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php3`
--
CREATE DATABASE IF NOT EXISTS `php3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `php3`;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `category_name`) VALUES
(1, 'Каталог'),
(2, 'Одежда'),
(3, 'Продукты'),
(4, 'Верхняя одежда'),
(5, 'Молочные продуткы');

-- --------------------------------------------------------

--
-- Структура таблицы `category_links`
--

CREATE TABLE `category_links` (
  `parent_id` int(11) UNSIGNED NOT NULL,
  `child_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_links`
--

INSERT INTO `category_links` (`parent_id`, `child_id`, `level`) VALUES
(1, 1, 0),
(1, 2, 1),
(1, 3, 1),
(1, 4, 2),
(1, 5, 2),
(2, 2, 1),
(2, 4, 2),
(3, 3, 1),
(3, 5, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `nested`
--

CREATE TABLE `nested` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `nleft` int(11) NOT NULL,
  `nright` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nested`
--

INSERT INTO `nested` (`id`, `level`, `nleft`, `nright`) VALUES
(1, 1, 1, 22),
(2, 2, 2, 9),
(3, 2, 10, 15),
(4, 2, 16, 21),
(5, 3, 3, 4),
(6, 3, 5, 8),
(7, 3, 11, 14),
(8, 3, 17, 18),
(9, 3, 19, 20),
(10, 4, 6, 7),
(11, 4, 12, 13);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `nested`
--
ALTER TABLE `nested`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `nested`
--
ALTER TABLE `nested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
