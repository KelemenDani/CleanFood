-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2025. Már 06. 11:28
-- Kiszolgáló verziója: 5.7.24
-- PHP verzió: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `cleanfood`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allergens`
--

CREATE TABLE `allergens` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `allergens`
--

INSERT INTO `allergens` (`id`, `name`) VALUES
(1, 'Gluténmentes'),
(2, 'Laktózmentes'),
(3, 'Vegán'),
(4, 'Vegetáriánus'),
(5, 'Halmentes'),
(6, 'Rákfélék'),
(7, 'Dióféléktől mentes'),
(8, 'Szójamentes'),
(9, 'Minden-mentes');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `couponcode` varchar(50) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `validity` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `gps_data` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foods`
--

CREATE TABLE `foods` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `restaurants_id` int(255) NOT NULL,
  `allergens_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `foods`
--

INSERT INTO `foods` (`id`, `name`, `price`, `restaurants_id`, `allergens_id`) VALUES
(1, 'Vegetáriánus WHOPPER', '1720', 1, 4),
(2, 'Gluténmentes WHOPPER', '2120', 1, 1),
(3, 'Kis Sült krumpli', '770', 1, 9),
(4, 'Közepes Sült Krumpli', '890', 1, 9),
(5, 'XXL Sült Krumpli', '1040', 1, 9),
(6, 'Édesburgonya', '1050', 1, 9),
(7, 'Vegetáriánus WHOPPER', '1720', 2, 4),
(8, 'Gluténmentes WHOPPER', '2120', 2, 1),
(9, 'Kis Sült krumpli', '770', 2, 9),
(10, 'Közepes Sült krumpli', '890', 2, 9),
(11, 'XXL Sült krumpli', '1040', 2, 9),
(12, 'Édesburgonya', '1050', 2, 9),
(13, 'Vegetáriánus WHOPPER', '1720', 3, 4),
(14, 'Gluténmentes WHOPPER', '2120', 3, 1),
(15, 'Kis Sült krumpli', '770', 3, 9),
(16, 'Közepes Sült krumpli', '890', 3, 9),
(17, 'XXL Sült krumpli', '1040', 3, 9),
(18, 'Édesburgonya', '1050', 3, 9),
(19, 'Gluténmentes McFarm', '2070', 4, 1),
(20, 'Gluténmentes Dupla SajtBurger', '1810', 1, 1),
(21, 'Kis burgonya', '730', 4, 9),
(22, 'Közepes burgonya', '920', 4, 9),
(23, 'Nagy burgonya', '990', 4, 9),
(24, 'Gluténmentes McFarm', '2070', 5, 1),
(25, 'Gluténmentes Dupla SajtBurger', '1810', 5, 1),
(26, 'Kis burgonya', '730', 5, 9),
(27, 'Közepes burgonya', '920', 5, 9),
(28, 'Nagy burgonya', '990', 5, 9),
(29, 'Gluténmentes McFarm', '2070', 6, 1),
(30, 'Gluténmentes Dupla SajtBurger', '1810', 6, 1),
(31, 'Kis burgonya', '730', 6, 9),
(32, 'Közepes burgonya', '920', 6, 9),
(33, 'Nagy burgonya', '990', 6, 9),
(34, 'Gluténmentes McFarm', '2070', 7, 1),
(35, 'Gluténmentes Dupla SajtBurger', '1810', 7, 1),
(36, 'Kis burgonya', '730', 7, 9),
(37, 'Közepes burgonya', '920', 7, 9),
(38, 'Nagy burgonya', '990', 7, 9),
(39, 'Görög NEM Pipi Gyros Tekercs', '3390', 8, 3),
(40, 'TÁL Laska Gyors', '4390', 8, 4),
(41, 'Sült burgonya', '1290', 8, 9),
(42, 'Friss Saláta', '1590', 8, 1),
(43, 'Brownie (nyers) GM', '1590', 8, 1),
(44, 'Snickers (nyers) GM', '1590', 8, 1),
(45, 'Mogyoróvajas Sajttorta (nyers) GM', '1690', 8, 1),
(46, 'Isler (nyers) GM', '1290', 8, 1),
(47, 'Tiramisu GM', '1690', 8, 1),
(48, 'Gyümölcsös köles-rudi pohárkrém GM', '1690', 8, 1),
(49, 'Pisztáciás Sajttorta GM', '1690', 8, 1),
(50, 'Áfonya torta (nyers) GM', '1690', 8, 1),
(51, 'Narancsos Csokitorta (nyers) GM', '1690', 8, 1),
(52, 'Flódni (nyers) GM', '1690', 8, 1),
(53, 'Vegán Cheddar Sajt', '890', 9, 4),
(54, 'Burgonyakrémleves', '2350', 9, 4),
(55, 'Sütőtökkrémleves', '2350', 9, 4),
(56, 'Bundázott zöldségek csatnival', '5850', 9, 4),
(57, 'Zöldséges árpagyöngy rizottó', '5650', 9, 4),
(58, 'Édesburgonya curry', '5850', 9, 4),
(59, 'Grillezett camambert áfonyalekvárral', '6250', 9, 4),
(60, 'Basmati rizs', '1450', 9, 9),
(61, 'Édesburgonya', '1450', 9, 9),
(62, 'Fűszeres burgonya', '1450', 9, 9),
(63, 'Indiai kenyér', '1250', 9, 9),
(64, 'Gyros tál', '5250', 9, 9),
(65, 'Falafel tál', '4750', 9, 9),
(66, 'Buddha tál', '4750', 9, 9),
(67, 'Sajtos-spenótos tagiatelle', '4750', 9, 9),
(68, 'Gorgonzolás casarecce', '4750', 9, 9),
(69, 'Vegán bolognai', '4450', 9, 3),
(70, 'Céklás répasaláta', '3850', 9, 9),
(71, 'Vöröslencsés quinoa saláta', '3650', 9, 9),
(72, 'Kapros árpagyöngysaláta', '3650', 9, 9),
(73, 'Vöröslencsés burger', '4850', 9, 9),
(74, 'Céklás burger', '4650', 9, 9),
(75, 'Diós palacsinta', '2850', 9, 9),
(76, 'Vegán túrógombóc', '2850', 9, 3),
(77, 'Karamellás mogyorótorta szelet', '2100', 9, 9),
(78, 'Gyümölcstorta szelet', '1800', 9, 9),
(79, 'Sajtos-tejfölös lángos', '2690', 9, 9),
(80, 'Sonkás bagel', '3390', 11, 2),
(81, 'Vegán mediterrán ciabatta', '2790', 11, 1),
(82, 'Vegán briós', '1190', 11, 1),
(83, 'Zserbó szelet', '1790', 11, 2),
(84, 'Túrós citromos mákos torta SZELET', '1690', 11, 2),
(85, 'Csirkés csoda burger', '4990', 11, 9),
(86, 'Klasszikus marha mámor', '4990', 11, 9),
(87, 'Margherita pizza', '4890', 11, 9),
(88, 'Sonkás pizza', '5190', 11, 9),
(89, 'Sajtos twister', '1399', 11, 8),
(90, 'Bécsi sós perec', '1690', 11, 8),
(91, 'Gluténmentes karamellás mandulatorta', '1490', 12, 1),
(92, 'Vegán citromos, málnás muffin', '1290', 12, 3),
(93, 'Málnás brownie', '1490', 12, 1),
(94, 'Narancsos vegán croissant', '1090', 12, 3),
(95, 'latte', '1440', 12, 9),
(96, 'cold brew', '1640', 12, 9),
(97, 'caramel frappuccino', '1940', 12, 9),
(98, 'iced mocha', '1740', 12, 9),
(99, 'Vegán gyümölcstorta', '20000', 13, 3),
(100, 'Málnás túrótorta szelet', '1700', 13, 2),
(101, 'Bounty golyó', '600', 13, 1),
(103, 'Málnás fehércsokis túró rudi torta', '16000', 13, 2),
(104, 'Zserbó torta', '19000', 13, 2),
(105, 'Pisztáciás mignon', '500', 13, 1),
(106, 'Vegán Csokoládé tortaszelet', '1390', 14, 3),
(107, 'Liszt- és Tejmentes Meggyes Mákos tortaszelet', '1440', 14, 2),
(108, 'Cukor- és Lisztmentes Málnás Csoki szelet', '1490', 14, 1),
(109, 'Lisztmentes Rusztikus Almás Diós Vaníliás tortaszelet', '1440', 14, 1),
(110, 'Pisztáciás Vaníliás tortaszelet', '1490', 14, 1),
(111, 'Sweet’n Marcell’s Burger', '5190', 15, 4),
(112, 'Cheesy G Burger', '5190', 15, 9),
(113, 'Ropogós sültkrumpli', '990', 15, 9),
(114, 'Brownie', '1349', 16, 1),
(115, 'Csokis muffin', '1639', 16, 1),
(116, 'Sajtos pogácsa', '1024', 16, 1),
(117, 'Sajtos snackrúd', '1024', 16, 1),
(118, 'Kakaós csiga', '1415', 16, 1),
(119, 'Csokis keksz', '1024', 16, 1),
(120, 'Vegán Eper torta', '21000', 18, 3),
(121, 'Vegán Pisztácia torta', '20000', 18, 3),
(122, 'Vegán áfonyás csokoládés torta', '21000', 18, 3),
(123, 'Nagyi kedvence', '19000', 18, 1),
(124, 'Meggyes vaníliás torta', '19000', 18, 2),
(125, 'Light Dió revolúció torta', '20000', 18, 1),
(126, 'Banán', '150', 19, 9),
(127, 'Fahéj', '190', 19, 9),
(128, 'Avokádó', '600', 19, 9),
(129, 'Laktózmentes-Tej', '600', 19, 2),
(130, 'Gluténmentes-Liszt', '1000', 19, 1),
(131, 'Gluténmentes-Kenyér', '800', 19, 1),
(132, 'Cukkini', '500', 19, 9),
(133, 'Répa', '80', 19, 9),
(134, 'Laktózmentes-Joghurt', '1000', 19, 2),
(135, 'Szójakocka', '415', 19, 3),
(136, 'Vegán szalámi', '900', 19, 3),
(137, 'Tojás(10)', '700', 19, 9),
(138, 'Laktózmentes Túró-rudi', '320', 19, 2),
(139, 'Csirkemell-steak meleg körettel vagy választható salátával', '2990', 10, 1),
(140, 'Sült csirkecomb rizs', '1990', 10, 1),
(141, 'Póréhagyma krémleves', '2590', 10, 4),
(142, 'Gombapaprikás galuskával', '2590', 10, 4),
(143, 'Joghurtos-zöldfűszeres zöldborsó krémleves', '2590', 10, 4),
(144, 'Sajtos-babkrémes pupusa', '2590', 10, 4),
(145, 'Édesköményes tojásleves', '2590', 10, 4),
(146, 'Vega füstölt tofus rakott zöldbab', '2590', 10, 4),
(147, 'Remy levese', '2590', 10, 4),
(148, 'Mozzarellás aracini', '2590', 10, 4),
(149, 'Zöldséges fejtett bableves', '2590', 10, 4),
(150, 'Matcha limonádé', '1490', 10, 9),
(151, 'Pisztáciás matcha latte', '1490', 10, 9),
(152, 'Klasszikus limonádé', '1190', 10, 9),
(153, 'Ízesített limonádé', '1490', 10, 9);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orderedfoods`
--

CREATE TABLE `orderedfoods` (
  `orders_id` int(11) NOT NULL,
  `foods_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `restaurants_id` int(11) NOT NULL,
  `coupons_id` int(11) DEFAULT NULL,
  `couriers_id` int(11) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` enum('Recorded','In Progress','Delivered','Deleted') NOT NULL DEFAULT 'Recorded'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `opening` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `city`, `address`, `opening`) VALUES
(1, 'Burger King', 'Pécs', 'Bajcsy-Zsilinszky utca 11.', '8-21'),
(2, 'Burger King', 'Pécs', 'Tüzér utca 5.', '8-24'),
(3, 'Burger King', 'Pécs', 'Bányavasút utca 2.', '8-24'),
(4, 'McDonalds', 'Pécs', 'Zsolnay Vilmos utca 4-6', '7-23'),
(5, 'McDonalds', 'Pécs', 'Bajcsy-Zsilinszky utca 11/1', '7-23'),
(6, 'McDonalds', 'Pécs', 'Siklósi út 68', '7-23'),
(7, 'McDonalds', 'Pécs', 'Megyeri út 70', '9-21'),
(8, 'LYR Speciality Coffee and Food', 'Pécs', 'Ferencesek utcája 4.', '10-20'),
(9, 'Mandala Étterem', 'Pécs', 'Perczel Miklós u. 26/1', '11:31-14:30'),
(10, 'UMAMI Kávézó és Étterem', 'Pécs', 'Szigeti út 12.', '7-18'),
(11, 'Szafi Pékség', 'Pécs', 'Király utca 15.', '8-17'),
(12, 'Starbucks', 'Pécs', 'Bajcsy-Zsilinszky utca 11', '7-20'),
(13, 'Vagamary Cukrászda', 'Pécs', 'Hunyadi János utca 20.', '10-18'),
(14, 'Trüffel Cukrászda', 'Pécs', 'Hársfa út 34.', '8-19'),
(15, 'Megyeri Burgers', 'Pécs', 'Megyeri út 121.', '17-23'),
(16, 'Pékinas', 'Pécs', 'Hengermalom utca 8.', '6-20:30'),
(17, 'Buddha Original Thai Wok and Sushi Bar', 'Pécs', 'Széchenyi tér 16-17', '11-24'),
(18, 'Magda Cukrászda', 'Pécs', 'Kandó Kálmán utca 4.', '10-19'),
(19, 'Cleanfood Shop', 'Pécs', 'Siklósi út 3', '-24');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `jelszo`, `phonenumber`, `city`, `zipcode`) VALUES
(21, 'weett', 'werner.valer@szechenyi.hu', '$2y$10$LNYbr8h.5VhjWLmNahJ6.OK7gb0jPBMdA0xIEqWAmdEuVpUwqe3Mi', '06203873375', 'SZEDERKÉNY', '7751'),
(22, 'Werner Valér', 'werner.valer2005@gmail.com', '$2y$10$2yszI9fWIjjkMfh8GE/6seRdOo8mJCA0EhwKsMP3wMXj1aYwBVaZG', '06203873375', 'SZEDERKÉNY', '7751'),
(23, 'Kelemen Dani', 'kelemendani6@gmail.com', '$2y$10$5DJFmS5U6ALG2oDV051dyeRlFcGnoEQYEGJbpJaPCcaurTpPe/aEK', '06300848809', 'Pécs', '7632');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `couponcode` (`couponcode`);

--
-- A tábla indexei `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurants_id` (`restaurants_id`);

--
-- A tábla indexei `orderedfoods`
--
ALTER TABLE `orderedfoods`
  ADD PRIMARY KEY (`orders_id`,`foods_id`),
  ADD KEY `foods_id` (`foods_id`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `restaurants_id` (`restaurants_id`),
  ADD KEY `coupons_id` (`coupons_id`),
  ADD KEY `couriers_id` (`couriers_id`);

--
-- A tábla indexei `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`restaurants_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `orderedfoods`
--
ALTER TABLE `orderedfoods`
  ADD CONSTRAINT `orderedfoods_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderedfoods_ibfk_2` FOREIGN KEY (`foods_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`restaurants_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`coupons_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`couriers_id`) REFERENCES `couriers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
