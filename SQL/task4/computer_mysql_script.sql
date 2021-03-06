SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS computers;

USE  computers;

CREATE TABLE `pc` (
  `id` int(11) NOT NULL,
  `speed` int(4) NOT NULL,
  `ram` int(4) NOT NULL,
  `hdd` int(4) NOT NULL,
  `price` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pc`
--

INSERT INTO `pc` (`id`, `speed`, `ram`, `hdd`, `price`) VALUES
(1, 2500, 2048, 250, 860),
(2, 2800, 3096, 500, 980),
(3, 3000, 4096, 640, 1020),
(4, 3200, 8192, 750, 1150),
(5, 2500, 2048, 250, 860),
(6, 2800, 3096, 500, 980),
(7, 3000, 4096, 640, 1020),
(8, 3200, 8192, 750, 1150),
(9, 3500, 8192, 750, 1350),
(10, 3500, 16384, 1024, 1650),
(11, 3500, 8192, 750, 1350),
(12, 3500, 16384, 1024, 1650),
(13, 1600, 512, 160, 430),
(14, 1200, 512, 200, 380),
(15, 1600, 512, 160, 430),
(16, 1200, 512, 200, 380);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `pc`
--
ALTER TABLE `pc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
