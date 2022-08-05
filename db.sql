-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 05 2022 г., 22:49
-- Версия сервера: 10.3.34-MariaDB-0+deb10u1
-- Версия PHP: 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `journal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `black_list`
--

CREATE TABLE `black_list` (
  `date_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `black_list`
--

INSERT INTO `black_list` (`date_id`, `user_id`, `reason`) VALUES
(127, 55, 'Отсутствие на 20.08.2020');

-- --------------------------------------------------------

--
-- Структура таблицы `black_list_backup`
--

CREATE TABLE `black_list_backup` (
  `date_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_id_backup` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `black_list_backup`
--

INSERT INTO `black_list_backup` (`date_id`, `user_id`, `reason`, `date_id_backup`) VALUES
(107, 39, 'За отсутствие на 16.08.2020', 123),
(107, 39, 'За отсутствие на 16.08.2020', 127),
(107, 39, 'За отсутствие на 16.08.2020', 129),
(107, 45, 'За отсутствие на 16.08.2020', 123),
(107, 45, 'За отсутствие на 16.08.2020', 127),
(107, 45, 'За отсутствие на 16.08.2020', 129),
(108, 39, 'За отсутствие на 17.08.2020', 123),
(108, 39, 'За отсутствие на 17.08.2020', 130),
(108, 45, 'За отсутствие на 17.08.2020', 123),
(108, 45, 'За отсутствие на 17.08.2020', 130),
(109, 55, 'За отсутствие на 18.08.2020', 129),
(109, 55, 'За отсутствие на 18.08.2020', 136),
(123, 55, 'За отсутствие на 19.08.2020', 137),
(135, 47, 'За отсутствие на 26.08.2020', 136),
(135, 51, 'За отсутствие на 26.08.2020', 137);

-- --------------------------------------------------------

--
-- Структура таблицы `dates`
--

CREATE TABLE `dates` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dates`
--

INSERT INTO `dates` (`id`, `date`) VALUES
(21, 1596056400),
(56, 1596661200),
(92, 1596834000),
(97, 1597006800),
(105, 1597352400),
(106, 1597438800),
(107, 1597525200),
(108, 1597611600),
(109, 1597698000),
(123, 1597784400),
(127, 1597870800),
(129, 1598130000),
(130, 1598216400),
(135, 1598389200),
(136, 1598562000),
(137, 1659646800);

-- --------------------------------------------------------

--
-- Структура таблицы `dates_work`
--

CREATE TABLE `dates_work` (
  `date_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `exist` tinyint(1) NOT NULL,
  `miss` tinyint(1) NOT NULL,
  `miss_lessons` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dates_work`
--

INSERT INTO `dates_work` (`date_id`, `user_id`, `exist`, `miss`, `miss_lessons`) VALUES
(21, 3, 1, 1, 3),
(21, 39, 0, 0, 0),
(21, 43, 1, 0, 0),
(56, 3, 1, 1, 3),
(56, 39, 0, 0, 0),
(56, 43, 1, 0, 0),
(92, 3, 1, 1, 3),
(92, 39, 0, 0, 0),
(92, 43, 1, 0, 0),
(92, 44, 1, 0, 0),
(92, 46, 1, 0, 0),
(92, 51, 0, 0, 0),
(92, 52, 1, 0, 0),
(92, 53, 1, 0, 0),
(92, 55, 0, 0, 0),
(92, 56, 1, 0, 0),
(92, 57, 1, 0, 0),
(92, 58, 0, 0, 0),
(97, 3, 1, 1, 3),
(97, 39, 0, 0, 0),
(97, 43, 1, 0, 0),
(97, 44, 1, 0, 0),
(97, 46, 1, 0, 0),
(97, 51, 0, 0, 0),
(97, 52, 1, 0, 0),
(97, 53, 1, 0, 0),
(97, 55, 0, 0, 0),
(97, 56, 1, 0, 0),
(97, 57, 1, 0, 0),
(97, 58, 1, 0, 0),
(105, 3, 1, 1, 3),
(105, 39, 0, 0, 0),
(105, 43, 1, 0, 0),
(105, 44, 1, 0, 0),
(105, 46, 1, 0, 0),
(105, 51, 0, 0, 0),
(105, 52, 1, 0, 0),
(105, 53, 1, 0, 0),
(105, 55, 0, 0, 0),
(105, 56, 1, 0, 0),
(105, 57, 1, 0, 0),
(105, 58, 1, 0, 0),
(106, 3, 1, 1, 3),
(106, 39, 0, 0, 0),
(106, 43, 1, 0, 0),
(106, 44, 1, 0, 0),
(106, 46, 1, 0, 0),
(106, 51, 0, 0, 0),
(106, 52, 1, 0, 0),
(106, 53, 1, 0, 0),
(106, 55, 0, 0, 0),
(106, 56, 1, 0, 0),
(106, 57, 1, 0, 0),
(106, 58, 1, 0, 0),
(107, 3, 1, 1, 3),
(107, 39, 0, 0, 0),
(107, 43, 1, 0, 0),
(107, 44, 1, 0, 0),
(107, 46, 1, 0, 0),
(107, 51, 0, 0, 0),
(107, 52, 1, 0, 0),
(107, 53, 1, 0, 0),
(107, 55, 0, 0, 0),
(107, 56, 1, 0, 0),
(107, 57, 1, 0, 0),
(107, 58, 1, 0, 0),
(108, 3, 1, 1, 3),
(108, 39, 0, 0, 0),
(108, 43, 1, 0, 0),
(108, 44, 1, 0, 0),
(108, 46, 1, 0, 0),
(108, 51, 0, 0, 0),
(108, 52, 1, 0, 0),
(108, 53, 1, 0, 0),
(108, 55, 0, 0, 0),
(108, 56, 1, 0, 0),
(108, 57, 1, 0, 0),
(108, 58, 1, 0, 0),
(109, 3, 1, 1, 3),
(109, 39, 0, 0, 0),
(109, 43, 1, 0, 0),
(109, 44, 1, 0, 0),
(109, 46, 1, 0, 0),
(109, 51, 0, 0, 0),
(109, 52, 1, 0, 0),
(109, 53, 1, 0, 0),
(109, 55, 0, 0, 0),
(109, 56, 1, 0, 0),
(109, 57, 1, 0, 0),
(109, 58, 1, 0, 0),
(123, 3, 1, 0, 3),
(123, 39, 1, 0, 0),
(123, 43, 1, 1, 3),
(123, 44, 1, 0, 0),
(123, 46, 1, 0, 0),
(123, 51, 0, 0, 0),
(123, 52, 0, 0, 0),
(123, 53, 1, 0, 0),
(123, 55, 0, 0, 0),
(123, 56, 1, 0, 0),
(123, 57, 1, 0, 0),
(123, 58, 1, 1, 2),
(123, 59, 1, 0, 0),
(127, 3, 1, 0, 3),
(127, 39, 0, 0, 0),
(127, 43, 1, 1, 3),
(127, 44, 1, 0, 0),
(127, 46, 1, 0, 0),
(127, 51, 0, 0, 0),
(127, 52, 0, 0, 0),
(127, 53, 1, 0, 0),
(127, 55, 0, 0, 0),
(127, 56, 1, 0, 0),
(127, 57, 1, 0, 0),
(127, 58, 1, 1, 2),
(127, 59, 1, 0, 0),
(129, 3, 1, 0, 0),
(129, 39, 1, 0, 0),
(129, 43, 1, 0, 0),
(129, 44, 1, 0, 0),
(129, 46, 1, 0, 0),
(129, 51, 1, 0, 0),
(129, 52, 1, 0, 0),
(129, 53, 1, 0, 0),
(129, 55, 1, 0, 0),
(129, 56, 1, 0, 0),
(129, 57, 1, 0, 0),
(129, 58, 1, 0, 0),
(129, 59, 1, 0, 0),
(130, 3, 1, 0, 0),
(130, 39, 1, 0, 0),
(130, 43, 1, 0, 0),
(130, 44, 1, 0, 0),
(130, 46, 1, 0, 0),
(130, 51, 1, 0, 0),
(130, 52, 1, 0, 0),
(130, 53, 1, 0, 0),
(130, 55, 1, 0, 0),
(130, 56, 1, 0, 0),
(130, 57, 0, 0, 0),
(130, 58, 1, 0, 0),
(130, 59, 1, 0, 0),
(135, 3, 0, 0, 0),
(135, 39, 0, 0, 0),
(135, 43, 1, 0, 0),
(135, 44, 1, 0, 0),
(135, 46, 1, 0, 0),
(135, 51, 0, 0, 0),
(135, 52, 0, 0, 0),
(135, 53, 1, 0, 0),
(135, 55, 0, 0, 0),
(135, 56, 1, 0, 0),
(135, 57, 0, 0, 0),
(135, 58, 1, 0, 0),
(135, 59, 1, 0, 0),
(136, 3, 1, 0, 0),
(136, 39, 1, 0, 0),
(136, 43, 1, 0, 0),
(136, 44, 1, 0, 0),
(136, 46, 1, 0, 0),
(136, 51, 1, 0, 0),
(136, 52, 1, 0, 0),
(136, 53, 1, 0, 0),
(136, 55, 1, 0, 0),
(136, 56, 1, 0, 0),
(136, 57, 1, 0, 0),
(136, 58, 1, 0, 0),
(136, 59, 1, 0, 0),
(137, 3, 0, 0, 7),
(137, 39, 1, 0, 0),
(137, 43, 1, 1, 0),
(137, 44, 1, 0, 0),
(137, 46, 0, 0, 7),
(137, 51, 1, 0, 0),
(137, 52, 1, 0, 0),
(137, 53, 1, 1, 2),
(137, 55, 0, 0, 7),
(137, 56, 1, 0, 0),
(137, 57, 1, 0, 0),
(137, 58, 1, 0, 0),
(137, 59, 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `duty_list`
--

CREATE TABLE `duty_list` (
  `date_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `duty_list`
--

INSERT INTO `duty_list` (`date_id`, `user_id`, `reason`) VALUES
(97, 46, 'По списку'),
(105, 52, 'По списку'),
(105, 57, 'По списку'),
(106, 43, 'По списку'),
(106, 44, 'По списку'),
(107, 3, 'По списку'),
(107, 58, 'По списку'),
(108, 3, 'По списку'),
(108, 58, 'По списку'),
(109, 46, 'По списку'),
(109, 56, 'По списку'),
(123, 46, 'По списку'),
(123, 56, 'По списку'),
(127, 46, 'По списку'),
(127, 56, 'По списку'),
(129, 39, 'За отсутствие на 16.08.2020'),
(130, 39, 'За отсутствие на 17.08.2020'),
(135, 53, 'По списку'),
(136, 55, 'За отсутствие на 18.08.2020'),
(137, 51, 'За отсутствие на 26.08.2020'),
(137, 55, 'За отсутствие на 19.08.2020');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Администраторы'),
(2, 'Пользователи');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `miss_user` tinyint(1) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `group_id`, `name`, `surname`, `login`, `email`, `miss_user`, `password`) VALUES
(3, 2, 'Игорь', 'Щеглов', 'fhdjfj', 'efhdjf@fhdj.tu', 0, '$2y$10$2xnGMcGWVRawom1hzmP3WOvcVZt/E5Xcdb/Itgq7u278kyMHemasS'),
(39, 2, 'Александра', 'Яковлева', 'Sinot', 'dsdhsjkf@fdsfsk.ru', 0, '$2y$10$RxmAE22fpXXwqTKWhxxHs.Vgyi6IBx7RCMlAmCjuxReMjhn7hRjXu'),
(43, 2, 'Богдан', 'Дегтярев', 'Simov', 'svinot@gg.bet', 0, '$2y$10$mGum7Ha3A/dtr54ZBESgGOvcYVLaFLeWRTBRhu8m0ZUgu73r.Gp7S'),
(44, 2, 'Алексей', 'Кузнецов', 'Jorik', 'jorik@gg.eu', 0, '$2y$10$1icewcUc5dLlKqalV3srl.HxxrEHdjhxPKKKpIxq6cU3vvB4FQGLe'),
(46, 2, 'Варвара', 'Полякова', 'durov', 'durov@gg.ru', 0, '$2y$10$U/12UJkRLSjwJ9XMYyjMOuIL8GSkG4YQ926QXdE1hum9BrL/8PIIS'),
(51, 2, 'Вероника', 'Попова', 'SAMSON', 'ya@ya.ru', 0, '$2y$10$LnqHSt.3ygUZtGWWrfhTcO2lEFARL7nKjWBb8hbPNbv/ZpnCCZWTa'),
(52, 2, 'Руслан', 'Селезнев', 'fjdslf', 'DilordYT@gg.ru', 0, '$2y$10$d.RnW07fGwB6ypAnqxwFLOdpg1GgawfqXyXl8dloqVJDOP2OeVMau'),
(53, 2, 'Ирина', 'Гаврилова', 'EdisonPts', 'EdisonPts@gg.ru', 0, '$2y$10$97oyInpxLopAfF6270VPPeWdBWpvFsSUTQ6ifGjx5bundaPp/oQSa'),
(55, 2, 'Варвара', 'Новикова', '_jorik_', 'sharik@gg.ru', 0, '$2y$10$pLXfr9PuABTwprClryHp0OgKQhoqdIc8sC7UWGF6XHKRr8W2lCmcW'),
(56, 2, 'Мария', 'Воронина', 'durov12', 'popa@gg.ru', 0, '$2y$10$WFGhboDYPTcxwLN6dS93se74mOgVX2O0rju0Y/uuDFIDNj5m18p6S'),
(57, 2, 'Георгий', 'Иванов', 'emae', 'emae@gg.ru', 0, '$2y$10$r90YbgWfazQbtUseLXNPF.f9sezeqL4t/oozvQAl1SBSbbXfW2486'),
(58, 2, 'Михаил', 'Максимов', 'Ura', 'ya@yandex.ru', 0, '$2y$10$AJC3sRnCnSf1XeSZaYtOCejEfP0hdVQcbe7as1RbUMeaJdQ20JT/G'),
(59, 1, 'Виктория', 'Смирнова', 'Admin', 'admin@gg.bet', 1, '$2y$10$/mGEIL3KrIhurjhd.9MC4Ov.Y2/7A9tkCagOPetjMfww0MVgGBMJO');

-- --------------------------------------------------------

--
-- Структура таблицы `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `token`, `info`, `date`) VALUES
(143, 59, '$2y$10$cNWMy4rVka6PCX2/uA4RouQBtfRh8MV6N16cGjr3UFE5k1J3GZbD.', 'Chrome 85.0.4183.83', 1598647946),
(144, 59, '$2y$10$dPiYDhU3Wv9qD.BSSKD0Oun4ihmVBBAOn638UcCe9FxYUGrHjrogu', 'Chrome 104.0.0.0', 1659722526);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `black_list`
--
ALTER TABLE `black_list`
  ADD PRIMARY KEY (`date_id`,`user_id`),
  ADD KEY `FK_DATES_USER` (`user_id`),
  ADD KEY `FK_DATES_BLACK` (`date_id`);

--
-- Индексы таблицы `black_list_backup`
--
ALTER TABLE `black_list_backup`
  ADD PRIMARY KEY (`date_id`,`user_id`,`date_id_backup`),
  ADD KEY `FK_DATES_USER` (`user_id`),
  ADD KEY `FK_DATES_BLACK` (`date_id`),
  ADD KEY `FK_DATES_BK_BLACK` (`date_id_backup`);

--
-- Индексы таблицы `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Индексы таблицы `dates_work`
--
ALTER TABLE `dates_work`
  ADD PRIMARY KEY (`date_id`,`user_id`),
  ADD KEY `FK_USER_DWORK` (`user_id`),
  ADD KEY `FK_DATES_DWORK` (`date_id`) USING BTREE;

--
-- Индексы таблицы `duty_list`
--
ALTER TABLE `duty_list`
  ADD PRIMARY KEY (`date_id`,`user_id`),
  ADD KEY `FK_USER_EXEC` (`user_id`),
  ADD KEY `FK_DATES_EXEC` (`date_id`) USING BTREE;

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_GROUP_USER` (`group_id`);

--
-- Индексы таблицы `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `FK_TOKEN_USER` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT для таблицы `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `black_list`
--
ALTER TABLE `black_list`
  ADD CONSTRAINT `FK_DATES_BLACK` FOREIGN KEY (`date_id`) REFERENCES `dates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DATES_USER` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `black_list_backup`
--
ALTER TABLE `black_list_backup`
  ADD CONSTRAINT `FK_DATES_BK_BLACK` FOREIGN KEY (`date_id_backup`) REFERENCES `dates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `dates_work`
--
ALTER TABLE `dates_work`
  ADD CONSTRAINT `FK_DATES_DWORK` FOREIGN KEY (`date_id`) REFERENCES `dates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USER_DWORK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `duty_list`
--
ALTER TABLE `duty_list`
  ADD CONSTRAINT `FK_DATES_EXEC` FOREIGN KEY (`date_id`) REFERENCES `dates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USER_EXEC` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_GROUP_USER` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `FK_TOKEN_USER` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
