-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Версия сервера: 5.7.32-0ubuntu0.18.04.1
-- Версия PHP: 7.3.26-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `vk_link` varchar(255) DEFAULT NULL,
  `ig_link` varchar(255) DEFAULT NULL,
  `tg_link` varchar(255) DEFAULT NULL,
  `status` enum('offline','online','dnd','afk') NOT NULL DEFAULT 'offline',
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Очистить таблицу перед добавлением данных `users`
--

TRUNCATE TABLE `users`;
--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `phone`, `image`, `address`, `company`, `position`, `vk_link`, `ig_link`, `tg_link`, `status`, `role`) VALUES
(1, 'Admin', 'asd@asd.ru', '$2y$10$C4bhdsDnPGYMWSJ.Ad/w5uisIqji/t6dbYZRyPwI1FDDGBFursOwe', '+7 999 777 55 33', 'img/demo/avatars/avatar-admin.png', 'Toronto, Canada', 'Users admin Lt.', 'Admin', 'https://vk.com', '', '', 'offline', 'admin'),
(2, '', 'qwe@qwe.ru', '$2y$10$P/93uSuvfs9QAlKLreNIuOHd/9RqtliuLN06qAMrU9ncvvH0enLka', '', '', '', '', '', '', 'https://instagram.com', '', 'offline', 'user'),
(3, 'Oliver Kopyov', 'oliver.kopyov@smartadminwebapp.com', '$2y$10$vJYKLXyfTsoluUptyr004OqHiafi2bWhC9CCNKDFOyyuwYAHp/TXK', '+1 317-456-2564', 'img/demo/avatars/avatar-b.png', '15 Charist St, Detroit, MI, 48212, USA', 'Gotbootstrap Inc.', 'IT Director', 'https://vk.com', 'https://instagram.com', 'https://t.me/', 'offline', 'user'),
(4, 'Alita Gray', 'Alita@smartadminwebapp.com', '$2y$10$vPP6YF/IaCjjQVzpDAvxV.gyZq2Smul3jnaVme1sfisfptYIhkVqq', '+1 313-461-1347', 'img/demo/avatars/avatar-c.png', '134 Hamtrammac, Detroit, MI, 48314, USA', 'Gotbootstrap Inc.', 'Project Manager', '', '', 'https://t.me/', 'dnd', 'user'),
(5, 'Dr. John Cook PhD', 'john.cook@smartadminwebapp.com', '$2y$10$TPdv5Dd0L0p02lolHjaB3.TE4oUOPwKjYn79CgQTmwl9iGNNeGBNK', '+1 313-779-1347', 'img/demo/avatars/avatar-e.png', '55 Smyth Rd, Detroit, MI, 48341, USA', 'Gotbootstrap Inc.', 'Human Resources', '', 'https://instagram.com', '', 'offline', 'user'),
(6, 'Jim Ketty', 'jim.ketty@smartadminwebapp.com', '$2y$10$DVYZu6cMPLEieSGf6037LuN41Fll9/rKX0vmn4MRqQ4jvhsClXqQ6', '+1 313-779-3314', 'img/demo/avatars/avatar-k.png', '134 Tasy Rd, Detroit, MI, 48212, USA', 'Gotbootstrap Inc.', 'Staff Orgnizer', 'https://vk.com', '', '', 'offline', 'user'),
(7, 'Dr. John Oliver', 'john.oliver@smartadminwebapp.com', '$2y$10$Q8VCYV1J3I.z337xM0MRmOvP6/RIkDCA0j5DyrkrgnCWHiGRT9QFq', '+1 313-779-8134', 'img/demo/avatars/avatar-g.png', '134 Gallery St, Detroit, MI, 46214, USA', 'Gotbootstrap Inc.', 'Oncologist', '', 'https://instagram.com', 'https://t.me/', 'afk', 'user'),
(8, 'Sarah McBrook', 'sarah.mcbrook@smartadminwebapp.com', '$2y$10$7mHc3AnnTruHrvAOTLoEueGwgZg6d.xoY7DvxT7DLOrY4.Tu6tdCS', '+1 313-779-7613', 'img/demo/avatars/avatar-h.png', '13 Jamie Rd, Detroit, MI, 48313, USA', 'Gotbootstrap Inc.', 'Xray Division', '', '', '', 'offline', 'user'),
(9, 'Jimmy Fellan', 'jimmy.fallan@smartadminwebapp.com', '$2y$10$pszfdPDrcMG/rKEnrRiPC.BU3rPBa3jKv5OOwBALXbKoaTsvNluTC', '+1 313-779-4314', 'img/demo/avatars/avatar-i.png', '55 Smyth Rd, Detroit, MI, 48341, USA', 'Gotbootstrap Inc.', 'Accounting', 'https://vk.com', '', '', 'dnd', 'user'),
(10, 'Arica Grace', 'arica.grace@smartadminwebapp.com', '$2y$10$OjK3kncruHwpiUzgt5RlQurs9HcInJnZqK9iTrKx94zSOAQ6fQdHu', '+1 313-779-3347', 'img/demo/avatars/avatar-j.png', '798 Smyth Rd, Detroit, MI, 48341, USA', 'Gotbootstrap Inc.', 'Accounting', '', '', 'https://t.me/', 'offline', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
