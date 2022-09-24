-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2022 a las 23:32:18
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pinton`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_productos`
--

CREATE TABLE `categorias_productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias_productos`
--

INSERT INTO `categorias_productos` (`id`, `name`) VALUES
(0, 'Empanadas'),
(1, 'Pinchos'),
(2, 'Papas'),
(3, 'Hamburguesas'),
(4, 'Tragos'),
(5, 'Cervezas'),
(6, 'No Alcoholicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `urlname` varchar(32) DEFAULT NULL,
  `parents` bigint(20) UNSIGNED NOT NULL,
  `disabled_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `urlname`, `parents`, `disabled_at`) VALUES
(0, 'Todo', NULL, 0, NULL),
(1, 'Principal', NULL, 1, NULL),
(2, 'Estatico', NULL, 1, NULL),
(3, 'Post', NULL, 1, NULL),
(4, 'Voto', NULL, 1, NULL),
(5, 'Alerta', NULL, 1, NULL),
(6, 'Secretarias', NULL, 1, NULL),
(7, 'Comisiones', NULL, 1, NULL),
(8, 'Clubes', NULL, 1, NULL),
(9, 'Eliminados', NULL, 1, NULL),
(10, 'Admin:Codigos', NULL, 0, NULL),
(11, 'Admin:Usuarios', NULL, 0, NULL),
(12, 'Admin:Categorias', NULL, 0, NULL),
(20, 'Elecciones', NULL, 3, NULL),
(21, 'Reuniones', NULL, 3, NULL),
(22, 'Pruebas', NULL, 1, NULL),
(31, 'Secretaria de asuntos internos', 'internos', 65, NULL),
(32, 'Secretaria de finanzas', 'finanzas', 65, NULL),
(33, 'Secretaria de género', 'genero', 65, NULL),
(34, 'Secretaria de cultura', 'cultura', 65, NULL),
(35, 'Secretaria de nota y asuntos estudiantiles', 'estudiantiles', 65, NULL),
(36, 'Secretaria de asuntos edilicios', 'edilicios', 65, NULL),
(37, 'Secretaria de prensa y difusión', 'prensa', 65, NULL),
(38, 'Secretaria del turno noche', 'noche', 65, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `productoID` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `fecha_y_hora` datetime NOT NULL,
  `precio` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `productoID`, `cantidad`, `fecha_y_hora`, `precio`) VALUES
(1, 3, 2, '2022-09-24 21:32:32', '0.00'),
(2, 0, 6, '2022-09-24 21:32:32', '0.00'),
(3, 4, 3, '2022-09-24 21:32:32', '0.00'),
(4, 5, 4, '2022-09-24 21:32:32', '0.00'),
(5, 1, 8, '2022-09-24 21:32:32', '0.00'),
(6, 6, 5, '2022-09-24 21:32:32', '0.00'),
(7, 4, 2, '2022-09-24 21:32:32', '0.00'),
(8, 0, 14, '2022-09-24 21:32:32', '0.00'),
(9, 3, 4, '2022-09-24 21:32:32', '0.00'),
(10, 1, 6, '2022-09-23 21:32:32', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `stock` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `name`, `unit`, `stock`) VALUES
(1, 'lechuga', 'kg', 120),
(2, 'carne_de_res', 'kg', 167),
(3, 'tomate', 'kg', 164),
(4, 'cebolla', 'kg', 153),
(5, 'papa', 'kg', 98),
(6, 'zanahorias ', 'kg', 96),
(7, 'queso_cheddar', 'kg', 87),
(8, 'huevo', 'kg', 63),
(9, 'carne_de_cerdo', 'kg', 114),
(10, 'palta', 'kg', 95),
(11, 'sal', 'kg', 150),
(12, 'langostinos', 'kg', 70),
(13, 'pollo', 'kg', 60),
(14, 'garbanzo', 'kg', 80),
(15, 'salchichas', 'kg', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` decimal(20,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `categoryID` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `price`, `categoryID`, `name`) VALUES
(1, '0.00', 0, 'carne con salsa de tomate'),
(2, '0.00', 1, 'salchichas ahumadas'),
(3, '0.00', 1, 'pollo crispy'),
(4, '0.00', 1, 'pollo a la chapa'),
(5, '0.00', 1, 'langostino'),
(6, '0.00', 1, 'Vegano'),
(7, '0.00', 2, 'Papas simples'),
(8, '0.00', 2, 'Papas completas'),
(9, '0.00', 2, 'Papas pinton'),
(10, '0.00', 2, 'Nachos'),
(11, '0.00', 3, 'Mercedes'),
(12, '0.00', 3, 'New York'),
(13, '0.00', 3, 'Lincoln'),
(14, '0.00', 3, 'Vegetariana'),
(15, '0.00', 3, 'langostinos'),
(16, '0.00', 5, 'Birras Artesanales'),
(17, '0.00', 5, 'Birras Importadas'),
(18, '0.00', 4, 'Rhode Island'),
(19, '0.00', 4, 'Maj-Taj P-49'),
(20, '0.00', 4, 'Crystal Tangerine'),
(21, '0.00', 4, 'Cucumber Punch'),
(22, '0.00', 4, 'Margarita de Maracuyá'),
(23, '0.00', 4, 'Negroni Pintón'),
(24, '0.00', 4, 'Scottish Julep'),
(25, '0.00', 6, 'Limonada'),
(26, '0.00', 6, 'Limonada de maracuya'),
(27, '0.00', 6, 'Limonada de naranja'),
(28, '0.00', 6, 'Agua'),
(29, '0.00', 6, 'Agua saborizada'),
(30, '0.00', 6, 'Gaseosa'),
(32, '0.00', 0, 'cerdo con salsa Teriyaki');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reabastecimientos`
--

CREATE TABLE `reabastecimientos` (
  `id` int(10) UNSIGNED NOT NULL,
  `productoID` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `productID` int(10) UNSIGNED NOT NULL,
  `ingredientID` int(10) UNSIGNED NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`productID`, `ingredientID`, `amount`) VALUES
(1, 2, 1050),
(2, 15, 200),
(3, 14, 4836),
(4, 14, 2800),
(7, 5, 300),
(8, 5, 980),
(9, 5, 350),
(14, 14, 425),
(15, 12, 439),
(32, 9, 2000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `perms` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `perms`, `email`, `password`, `created_at`, `deleted_at`, `updated_at`, `code`) VALUES
(0, 18446744073709551615, 'root@root.com', 'e99a18c428cb38d5f260853678922e03', '2022-02-01 18:08:20', NULL, '2022-02-01 18:08:20', 'rootroot'),
(1, 2147483648, 'placeholdr@amogus.ar', 'e99a18c428cb38d5f260853678922e03', '2022-01-31 23:08:44', NULL, '2022-02-16 23:02:25', 'abcd1234'),
(5, 0, NULL, NULL, NULL, NULL, '2022-02-13 10:02:31', '9cbee866'),
(6, 68719476736, NULL, NULL, NULL, NULL, '2022-02-13 10:03:10', 'a5ecb7cc'),
(8, 274877906952, NULL, NULL, NULL, NULL, '2022-02-13 10:06:06', '636dc222'),
(9, 1024, NULL, NULL, NULL, NULL, '2022-02-13 22:59:06', 'c5e97985'),
(15, 309237710848, NULL, NULL, NULL, NULL, '2022-02-14 09:57:25', '38558156'),
(16, 17179876352, 'ponele@gmail.com', 'e99a18c428cb38d5f260853678922e03', '2022-02-16 23:01:39', NULL, '2022-02-16 23:02:44', 'c393a10e');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `urlname` (`urlname`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reabastecimientos`
--
ALTER TABLE `reabastecimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`productID`,`ingredientID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `reabastecimientos`
--
ALTER TABLE `reabastecimientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
