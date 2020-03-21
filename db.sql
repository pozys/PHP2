-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3308
-- Время создания: Мар 21 2020 г., 09:34
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(16) NOT NULL,
  `image_id` int(16) NOT NULL,
  `feedback` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `image_id`, `feedback`) VALUES
(1, 1, 'Первый отзыв'),
(2, 1, 'Второй отзыв'),
(3, 3, 'Первый'),
(4, 4, 'Первый отзыв'),
(5, 1, 'Еще один\r\nОчень Важный \r\nотзыв'),
(6, 8, 'Первый'),
(7, 8, 'Первый'),
(8, 8, 'Второй'),
(9, 5, 'Отзыв'),
(10, 5, 'Отзыв 2'),
(11, 5, 'Отзыв 3'),
(12, 1, 'Отзыв'),
(13, 4, 'Второй'),
(14, 4, 'Второй'),
(15, 7, 'Новый отзыв'),
(16, 8, 'Третий'),
(17, 3, 'Отзыв два'),
(18, 5, 'Отзыв 4'),
(19, 5, 'Отзыв 5'),
(20, 5, 'Jnps'),
(21, 1, 'Отзыв 4'),
(22, 1, ''),
(23, 5, 'Jnnndd');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(16) NOT NULL,
  `path` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `size` double NOT NULL DEFAULT 0,
  `viewings` int(15) NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0,
  `good_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `path`, `name`, `size`, `viewings`, `price`, `good_name`) VALUES
(1, 'img', 'product_1.jpg', 45, 75, 678.34, 'Товар 1'),
(2, 'img', 'product_2.jpg', 69.4, 9, 4333, 'Товар 2'),
(3, 'img', 'product_3.jpg', 62.2, 6, 2144.55, 'Товар 3'),
(4, 'img', 'product_4.jpg', 58.1, 70, 998.09, 'Товар 4'),
(5, 'img2', 'product_5.jpg', 70.3, 43, 3414.55, 'Товар 5'),
(6, 'img2', 'product_6.jpg', 63.3, 8, 339.93, 'Товар 6'),
(7, 'img2', 'product_7.jpg', 45.5, 7, 4111, 'Товар 7'),
(8, 'img2', 'product_8.jpg', 44.3, 13, 2342.44, 'Товар 8'),
(36, '', '', 0, 0, 444, 'sdfvsdfv'),
(37, '', '', 0, 0, 3344, 'Новый 55');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `tel` varchar(25) NOT NULL,
  `id` int(25) NOT NULL,
  `user_id` int(16) DEFAULT NULL,
  `sum` float DEFAULT NULL,
  `orders_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `status` varchar(100) DEFAULT 'Принят'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`tel`, `id`, `user_id`, `sum`, `orders_data`, `user_name`, `adress`, `status`) VALUES
('+79998334974', 10, 3, 1676.43, '{\"1\":{\"count\":1,\"good_name\":\"Товар 1\",\"price\":\"678.34\"},\"4\":{\"count\":1,\"good_name\":\"Товар 4\",\"price\":\"998.09\"}}', 'Культяпов Константин Вячеславович', 'Осановский проезд, дом 27, кв. 120', 'Обрабатывается'),
('+79998334974', 11, 3, 5449.02, '{\"6\":{\"count\":1,\"good_name\":\"Товар 6\",\"price\":\"339.93\"},\"7\":{\"count\":1,\"good_name\":\"Товар 7\",\"price\":\"4111\"},\"4\":{\"count\":1,\"good_name\":\"Товар 4\",\"price\":\"998.09\"}}', 'Культяпов Константин Вячеславович', 'Осановский проезд, дом 27, кв. 120', 'Доставлен'),
('test', 12, 4, 6829.1, '{\"5\":{\"count\":2,\"good_name\":\"Товар 5\",\"price\":\"3414.55\"}}', 'test', 'test', 'Обрабатывается'),
('+79998334974', 13, 3, 2035.02, '{\"1\":{\"count\":3,\"good_name\":\"Товар 1\",\"price\":\"678.34\"}}', 'Культяпов Константин Вячеславович', 'Осановский проезд, дом 27, кв. 120', 'Обрабатывается'),
('+79998334974', 47, 7, 678, '{\"1\":{\"count\":1,\"good_name\":\"Товар 1\",\"price\":678}}', 'Константин Вячеславович Культяпов', 'Осановский проезд, дом 27, кв. 120', 'Принят'),
('+79998334974', 48, 7, 678, '{\"1\":{\"count\":1,\"good_name\":\"Товар 1\",\"price\":678}}', 'Константин Вячеславович Культяпов', 'Осановский проезд, дом 27, кв. 120', 'Собран'),
('+79998334974', 49, 7, 678, '{\"1\":{\"count\":1,\"good_name\":\"Товар 1\",\"price\":678}}', 'Константин Вячеславович Культяпов', 'Осановский проезд, дом 27, кв. 120', 'Принят'),
('test', 50, 4, 1356, '{\"1\":{\"count\":2,\"good_name\":\"Товар 1\",\"price\":678}}', 'test', 'test', 'Принят'),
('+79998334974', 51, 8, 9344, '{\"1\":{\"count\":1,\"good_name\":\"Товар 1\",\"price\":678},\"2\":{\"count\":2,\"good_name\":\"Товар 2\",\"price\":4333}}', 'Константин Вячеславович Культяпов', 'Осановский проезд, дом 27, кв. 120', 'Принят');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(16) NOT NULL,
  `login` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `adress` varchar(255) NOT NULL,
  `tel` varchar(25) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `is_admin`, `adress`, `tel`, `blocked`) VALUES
(1, 'ivan', '$2y$10$XiouMCH0qdlyFBza4IamM.N6Gsr2DnB9ltJCAfA./ZQwe7lbdKa1S', 'Ваня', 1, '', '', 0),
(2, 'john', '$2y$10$LtCiljttZsXwPTK6WwbyDODplutcNqeNzEAqbdggKMMhBkRvLP.pi', 'John', 0, '', '', 0),
(3, 'pozys', '$2y$10$j3fowjtCTZ1eLow6/EGxku62dKZDkLNaC0GeutjwfUYbGSdYvzfrW', 'Культяпов Константин Вячеславович', 0, 'Осановский проезд, дом 27, кв. 120', '+79998334974', 0),
(4, 'test', '$2y$10$cTU8uUZA7Jnlg9gZekcasOJ6L.C9lxGQ3lSL9/gzCOZPkDGoWlhVu', 'test', 0, 'test', 'test', 0),
(5, 'admin', '$2y$10$K/5.tUsjfu/vzAthYvVi.uSqj6If.3AU9phO08Ok9I.lZrnXyT3Ay', 'Администратор', 1, 'Москва', '+79998334974', 0),
(6, 'ssss', '$2y$10$LVSHPHPZ6AYkAQmDouwvCO3IW/gm3PFERZv92fPMI901mGRc5yY7O', 'Константин Вячеславович Культяпов', 0, 'Осановский проезд, дом 27, кв. 120', '+79998334974', 0),
(7, 'rewer', '$2y$10$E6aGzInxii8qlU5VrWayLuuRO51KT8BQoRws5UohCNz6NkwaVB9Fe', 'Константин Вячеславович Культяпов', 0, 'Осановский проезд, дом 27, кв. 120', '+79998334974', 0),
(8, 'pozys2', '$2y$10$qh1Kf.RbwxVbwJxkEsuGSu6F8HUl/PiYRqvDrZ7CkhNKmzQHBmf2u', 'Константин Вячеславович Культяпов', 0, 'Осановский проезд, дом 27, кв. 120', '+79998334974', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
