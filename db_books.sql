-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 02 2018 г., 14:11
-- Версия сервера: 10.1.30-MariaDB
-- Версия PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_books`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_avtors`
--

CREATE TABLE `tbl_avtors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_avtors`
--

INSERT INTO `tbl_avtors` (`id`, `name`) VALUES
(1, 'Толстой'),
(2, 'Гоголь'),
(3, 'Акунин'),
(4, 'Пушкин'),
(7, 'Достоевский'),
(9, 'Лермонтов');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_books`
--

CREATE TABLE `tbl_books` (
  `id` int(11) NOT NULL,
  `avtor` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `genre` varchar(17) NOT NULL,
  `page` int(5) NOT NULL,
  `src` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_books`
--

INSERT INTO `tbl_books` (`id`, `avtor`, `name`, `year`, `genre`, `page`, `src`) VALUES
(11, 3, 'Азазель', 1998, 'детектив', 310, 'азазель.jpg'),
(4, 2, 'мёртвые души', 1842, 'детектив', 500, 'мёртвые души.jpg'),
(7, 4, 'Сказка о рыбаке и рыбке', 1835, 'сказка', 300, 'Сказка о рыбаке и рыбке.gif'),
(12, 3, 'Турецкий гамбит', 1998, 'детектив', 222, 'турецкий гамбит.jpg'),
(9, 3, 'Нефритовые чётка', 2006, 'детектив', 704, 'нефритовые чётка.jpg'),
(10, 3, 'Особые поручения', 1980, 'детектив', 523, 'особые поручения.jpg'),
(13, 1, 'Война и мир', 1973, 'роман', 1290, 'Война и мир.gif'),
(14, 9, 'Демон', 1842, 'поэма', 100, 'Демон.jpg'),
(15, 7, 'Идеот', 1868, 'роман', 305, 'Идеот.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(17) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `pass`) VALUES
(1, 'qwer', '4321');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tbl_avtors`
--
ALTER TABLE `tbl_avtors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tbl_avtors`
--
ALTER TABLE `tbl_avtors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
