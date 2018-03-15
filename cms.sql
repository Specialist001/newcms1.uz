-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 15 2018 г., 20:48
-- Версия сервера: 5.6.37
-- Версия PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `title`, `content`, `date`) VALUES
(1, 'Lorem 1', '<p>Lorem ipsum,​</p>', '2018-03-12 18:47:05'),
(2, 'Lorem 2_new', '<ul><li>​ dasa sd<br></li><li>asdasd asd</li><li>&nbsp;asd&nbsp;</li><li>asd a sda sda s 123</li><li>123</li><li>123</li></ul><p>1231</p><p>23​</p>', '2018-03-12 18:48:32'),
(3, 'Lorem 3_1', '<p>&nbsp;hdsfhsd fuhsd fsd&nbsp;</p><p>fsd f</p><p><br></p><p>sd f</p><p>sd f​</p>', '2018-03-12 18:50:16'),
(4, 'Test New it\'s 4', '<p style=\"margin-left: 60px;\">​a sdasdas das dasd ad ssa das d</p>', '2018-03-12 18:51:14'),
(5, 'Test Page ID5', '<p>​assa ad asdsda&nbsp;</p>', '2018-03-14 17:29:56'),
(6, '​Test page id6', '<p>6 6 6 6 6 6&nbsp;</p>', '2018-03-14 17:34:36'),
(7, '​Test page id7 and', '<p>7 7 7 77&nbsp;</p>', '2018-03-14 17:35:47'),
(8, '8', '<p>​8</p>', '2018-03-14 17:37:42'),
(9, '9', '<p>​</p>', '2018-03-14 18:53:35'),
(10, '10', '<p>10​ 10</p>', '2018-03-15 13:14:24');

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `date`) VALUES
(1, '1 -', '<p>​ 1 1 1 1&nbsp;</p>', '2018-03-15 13:31:02'),
(2, '2', '<p>​2 2 2</p>', '2018-03-15 13:32:21'),
(3, '3', '<p>​3 3 3</p>', '2018-03-15 13:33:34');

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `key_field` varchar(100) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `setting`
--

INSERT INTO `setting` (`id`, `name`, `key_field`, `value`) VALUES
(1, 'Name Site', 'name_site', 'CMS'),
(2, 'Description', 'description', 'Example description'),
(3, 'Admin email', 'admin_email', 'admin@admin.com'),
(4, 'Language', 'language', 'english');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` enum('admin','moderator','user','') NOT NULL,
  `hash` varchar(32) NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`, `hash`, `date_reg`) VALUES
(1, 'admin@admin.com', 'b59c67bf196a4758191e42f76670ceba', 'admin', '74285a144e65ed7ef8851e75f27c1dd7', '2018-02-27 17:43:04'),
(2, 'test@admin.com', 'e4da3b7fbbce2345d7772b0674a318d5', 'user', 'new', '2018-03-12 23:46:45');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key_uindex` (`key_field`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
