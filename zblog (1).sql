-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 08 2021 г., 17:14
-- Версия сервера: 10.4.14-MariaDB
-- Версия PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `zblog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `article` text NOT NULL,
  `short_article` text DEFAULT NULL,
  `is_public` tinyint(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `category`, `title`, `article`, `short_article`, `is_public`) VALUES
(1, 1, 'title', 'article', 'short_article', 1),
(2, 1, 'title 2', 'article 2', 'short article 2', 1),
(3, 1, 'Заголовок', 'Статья', 'Начало статьи', 1),
(4, 2, 'Категория #3111', 'article', 'begin', 1),
(5, 1, 'docker', 'Статья', 'Начало статьи', 1),
(6, 4, 'Категория #31', 'Статья * 21', 'Начало статьи * 12', 1),
(7, 1, 'docker', 'ооо', 'ггг', 1),
(8, 1, 'docker', '6665544444', '1121122777777', 1),
(9, 4, 'docker', '6666666666', '444444444', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_key` varchar(20) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `category_key`, `category_name`) VALUES
(1, 'categoryKey', 'categoryName'),
(2, '456', '777'),
(4, '12454677', '09866649'),
(7, '111', '77777');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `article` int(11) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `article`, `user_email`, `comment`) VALUES
(1, 1, 'qwerty@mail.ru', '2222222222222'),
(2, 1, 'qwe6rty@mail.ru', '77777777777777777777'),
(3, 1, 'qwerty@mail.ru', '111111111111'),
(4, 1, 'qwerty@mail.ru', '444444444444'),
(5, 1, 'nnnnnnnqwerty@mail.ru', 'ммммммммттттттт'),
(6, 1, 'qwerty@mail.ru', 'Hello'),
(7, 1, 'qwerty@mail.ru', '888'),
(9, 1, 'qwerty@mail.ru', 'пппппппппп'),
(10, 3, 'qwerty@mail.ru', 'jjjjjj'),
(11, 1, 'qwerty@mail.ru', '1112223334567890');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `usr_name` varchar(100) NOT NULL,
  `usr_password` varchar(100) NOT NULL,
  `usr_email` varchar(60) NOT NULL,
  `usr_password_salt` varchar(100) DEFAULT NULL,
  `usr_registration_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `usr_name`, `usr_password`, `usr_email`, `usr_password_salt`, `usr_registration_date`) VALUES
(1, 'user123', '123123', 'user@ya.ru', NULL, NULL),
(2, 'user', 'fe480b4d4d115c61af52ed249f42806f', 'yaya@ya.ru', 'ef6fe2ce3ae7bff643d97aa02d2c7db6', '2021-01-07 17:20:06'),
(3, 'user5', '29e6c7572bb3f15d03e49d4d994331c0', 'yaya@ya.ru', 'cfb957847c134c20f4bea811147c2e60', '2021-01-07 17:23:40'),
(4, 'user6', '8c1db1ccd3e94910c81f0d817253ef72', 'yaya@ya.ru', '37735b5c9d62ad8c5cbfa22e3344f644', '2021-01-07 23:24:05'),
(5, 'user44', '16f7ba58bb7eeeccd16b5e197eb24aae', 'chibinyov@gmail.com', 'dbbbaaa6e5b79f27d1ed1d42fd99cb46', '2021-01-08 00:37:04'),
(6, 'user444', 'a76552a9e836f7e63b73f1b84cf2471a', 'chibinyov@rambler.ru', '71468f144b10a907a3346681881ec54c', '2021-01-08 00:39:09');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_key` (`category_key`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article` (`article`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9DFDCDFE1` (`usr_name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ifbk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`article`) REFERENCES `article` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
