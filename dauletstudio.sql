-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 07 2020 г., 13:49
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dauletstudio`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `uri` text NOT NULL,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `block` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `counter`
--

CREATE TABLE `counter` (
  `id` int(11) NOT NULL,
  `agent` text NOT NULL,
  `uri` text NOT NULL,
  `ip` text NOT NULL,
  `ref` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `product` text NOT NULL,
  `link` text NOT NULL,
  `date` datetime NOT NULL,
  `block` int(11) NOT NULL DEFAULT 0,
  `readed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `uri` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `img` text NOT NULL,
  `alt` text NOT NULL,
  `date` datetime NOT NULL,
  `author` text NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `uid` int(11) NOT NULL,
  `type` text NOT NULL,
  `block` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `stats`
--

CREATE TABLE `stats` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `type` text NOT NULL,
  `block` int(11) NOT NULL DEFAULT 1,
  `place` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `stats`
--

INSERT INTO `stats` (`id`, `content`, `type`, `block`, `place`) VALUES
(17, '<a href=\"index.php\">Басты бет</a>', 'menu', 0, 1),
(18, 'Ава - 1000тг', 'price', 0, 1),
(19, '<a href=\"login.php\">Админ панель</a>', 'link', 0, 100),
(22, '<a href=\"https://vk.com/kz.wikipedia\">Vk</a>', 'link', 0, 1),
(24, 'Логотип - 800тг', 'price', 0, 2),
(25, '<a href=\"order.php\">Тапсырыс беру</a>', 'menu', 0, 2),
(29, 'Редизайн - 1800тг', 'price', 0, 5),
(30, 'Шапка, обложка - 400тг', 'price', 0, 3),
(31, 'Афиша - 1300тг', 'price', 0, 4),
(32, 'Жаңа бөлім', 'link', 1, 0),
(33, '<a href=\"https://www.instagram.com/daulet_studio/\">Instagram</a>', 'link', 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `email` text NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `reset` text NOT NULL,
  `online` text NOT NULL,
  `date` datetime NOT NULL,
  `ip` text NOT NULL,
  `block` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `name`, `password`, `reset`, `online`, `date`, `ip`, `block`) VALUES
(4, 'admin', 'kz_wikipedia@mail.r', 'Nurdaulet Makstuov', 'de0ebd40e423b797f328a5896fab461c', '1324e4ff4b6fec1904025340a8e34f24', '87f51223b92e552931a81d66c5fea5eb', '2020-04-27 21:15:20', '127.0.0.1', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `posts` ADD FULLTEXT KEY `similar` (`content`,`title`);

--
-- Индексы таблицы `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT для таблицы `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `stats`
--
ALTER TABLE `stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
