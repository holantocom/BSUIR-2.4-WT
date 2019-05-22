-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 15 2019 г., 21:20
-- Версия сервера: 5.6.43-cll-lve
-- Версия PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `aqq16327_notes`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`, `price`) VALUES
(1, 'Экстра сыр', 1),
(2, 'Ветчина', 2),
(3, 'Помидоры', 1),
(4, 'Шампиньоны', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `order_ingredients`
--

CREATE TABLE `order_ingredients` (
  `order_id` int(11) NOT NULL,
  `pizza_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `order_ingredients`
--

INSERT INTO `order_ingredients` (`order_id`, `pizza_id`, `ingredient_id`) VALUES
(1, 1, 1),
(1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `order_pizzas`
--

CREATE TABLE `order_pizzas` (
  `order_id` int(11) NOT NULL,
  `pizza_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `order_pizzas`
--

INSERT INTO `order_pizzas` (`order_id`, `pizza_id`, `size_id`, `count`) VALUES
(1, 1, 1, 1),
(1, 1, 2, 1),
(1, 2, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `pizza`
--

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `kgprice` double NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `top` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `pizza`
--

INSERT INTO `pizza` (`id`, `name`, `description`, `kgprice`, `photo`, `top`) VALUES
(1, 'Пепперони и томаты', 'Соус барбекю, Томаты, Сыр моцарелла, Пепперони\r\n\r\nПищевая ценность на 100г продукта:\r\nЖиры - 9,4 г\r\nБелки - 9,7 г\r\nУглеводы - 28,6 г\r\nЭнергетическая ценность - 238,6 ккал', 268, 'https://images.dominos.by/media/dominos/osg/api/2018/12/12/pepperoni_i_tomaty_small.png', 1),
(2, 'Гавайская', 'Ананас, Сыр моцарелла, Томатный соус Domino\'s, Курица\r\n\r\nПищевая ценность на 100г продукта:\r\nЖиры - 6,6 г\r\nБелки - 10,1 г\r\nУглеводы - 26,2 г\r\nЭнергетическая ценность - 204,8 ккал', 268, 'https://images.dominos.by/media/dominos/osg/api/2018/09/12/gavayskaya.png', 0),
(3, 'Барбекю', 'Соус барбекю, Шампиньоны, Сыр моцарелла, Бекон, Курица, Лук\r\n\r\nПищевая ценность на 100г продукта:\r\nЖиры - 12,5 г\r\nБелки - 11,2 г\r\nУглеводы - 19,2 г\r\nЭнергетическая ценность - 235,0 ккал', 298, 'https://images.dominos.by/media/dominos/osg/api/2018/09/12/barbecue.png', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pizza_order`
--

CREATE TABLE `pizza_order` (
  `id` int(11) NOT NULL,
  `self_delivery` tinyint(1) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pizza_order`
--

INSERT INTO `pizza_order` (`id`, `self_delivery`, `customer_name`, `customer_email`, `location`, `comment`, `status`, `price`) VALUES
(1, 0, 'Илья', 'ilya@holanto.com', 'Гикало 9', 'В 4 корпус БГУИР', 'DONE', 968);

-- --------------------------------------------------------

--
-- Структура таблицы `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `kg` double NOT NULL,
  `type` varchar(20) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `size`
--

INSERT INTO `size` (`id`, `kg`, `type`, `size`) VALUES
(1, 1, 'Семейная', 36),
(2, 0.5, 'Классическая', 30),
(3, 0.3, 'Малая', 22);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `name_2` (`name`);

--
-- Индексы таблицы `order_ingredients`
--
ALTER TABLE `order_ingredients`
  ADD PRIMARY KEY (`order_id`,`pizza_id`,`ingredient_id`);

--
-- Индексы таблицы `order_pizzas`
--
ALTER TABLE `order_pizzas`
  ADD PRIMARY KEY (`order_id`,`pizza_id`,`size_id`);

--
-- Индексы таблицы `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `pizza_order`
--
ALTER TABLE `pizza_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `pizza_order`
--
ALTER TABLE `pizza_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
