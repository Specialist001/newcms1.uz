-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 07 2018 г., 15:29
-- Версия сервера: 5.6.37-log
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
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`) VALUES
(1, 'Home'),
(2, 'Pages'),
(3, 'Posts'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_item`
--

CREATE TABLE `menu_item` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `parent` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(5) NOT NULL,
  `link` varchar(255) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_item`
--

INSERT INTO `menu_item` (`id`, `menu_id`, `name`, `parent`, `position`, `link`) VALUES
(1, 0, 'Home', 0, 0, '#'),
(2, 0, 'About', 0, 0, '#'),
(3, 0, 'Sample Post', 0, 0, '#'),
(4, 0, 'Contact', 0, 0, '#'),
(5, 4, 'Admin', 0, 0, '/admin/'),
(6, 4, 'New item 1', 0, 1, '#'),
(7, 4, 'New item 2', 0, 2, '#'),
(8, 3, 'New item', 0, 0, '#');

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'publish',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `title`, `content`, `status`, `date`) VALUES
(1, 'Lorem ipsum', '<p>Dolor sit amet​</p>', 'publish', '2018-03-10 13:36:22'),
(2, 'Lorem ipsum', '<p>Dolor sit amet​ 2</p>', 'publish', '2018-03-10 13:38:15'),
(3, 'Lorem ipsum', '<ul><li>​<span>Dolor sit amet</span><span>​ 3</span><br></li><li>Dolor sit amet​ 3<span class=\"redactor-invisible-space\">​</span><br></li><li>Dolor sit amet​ 3<br></li></ul>', 'publish', '2018-03-10 13:39:07'),
(4, 'fatal', '<p>a sjdhajskdh ajdks h​</p>', 'publish', '2018-03-12 07:10:51'),
(5, 'Ferrum', '<p>1 2 3 4 5​</p>', 'publish', '2018-03-12 08:47:52');

-- --------------------------------------------------------

--
-- Структура таблицы `plugin`
--

CREATE TABLE `plugin` (
  `id` int(11) NOT NULL,
  `directory` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'publish',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `status`, `date`) VALUES
(1, '1 -', '<p>​ 1 1 1 1&nbsp;</p>', 'publish', '2018-03-15 09:31:02'),
(2, '2', '<p>​2 2 2</p>', 'publish', '2018-03-15 09:32:21'),
(3, '3', '<p>​3 3 3</p>', 'publish', '2018-03-15 09:33:34');

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `key_field` varchar(100) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `section` varchar(155) NOT NULL DEFAULT 'general'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `setting`
--

INSERT INTO `setting` (`id`, `name`, `key_field`, `value`, `section`) VALUES
(1, 'Name Site', 'name_site', 'nCms', 'general'),
(2, 'Description', 'description', 'Example new CMS', 'general'),
(3, 'Admin email', 'admin_email', 'admin@admin.com', 'general'),
(4, 'Language', 'language', 'english', 'general'),
(5, 'Active theme', 'active_theme', 'default', 'theme');

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
(1, 'admin@admin.com', 'b59c67bf196a4758191e42f76670ceba', 'admin', '39e39597da8d38666ece5a2eced00b72', '2018-02-27 17:43:04');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
