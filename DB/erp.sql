-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2021 a las 17:55:59
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `erp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `id_envio` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `cp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccion1` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `direccion2` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad_estado` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_venta` int(11) NOT NULL,
  `estatus` varchar(105) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(20) NOT NULL,
  `genero` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `genero`) VALUES
(1, 'Antena'),
(2, 'Decodificador'),
(3, 'TV-BOX SKY'),
(4, 'Modem SKY WIFI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(20) NOT NULL,
  `id_venta` int(20) NOT NULL,
  `metodo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_ventas`
--

CREATE TABLE `productos_ventas` (
  `id` int(11) NOT NULL,
  `id_venta` int(20) NOT NULL,
  `id_producto` int(20) NOT NULL,
  `cantidad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `precio` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id` int(20) NOT NULL,
  `id_usuario` int(20) DEFAULT NULL,
  `Nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `id_genero` int(20) DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad-descontar` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `precio` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `creado` datetime NOT NULL,
  `actualizado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id`, `id_usuario`, `Nombre`, `foto`, `id_genero`, `descripcion`, `cantidad`, `cantidad-descontar`, `precio`, `creado`, `actualizado`) VALUES
(1, 1, 'Antena SKY', '64322605_95641666.jpg', 1, 'Antena con mas de 80 canales en HD y FHD.', '485', '', '250', '2021-09-24 00:00:46', '2021-09-23 22:00:46'),
(2, 1, 'Decodificador SKY', '41436109_58978850.jpg', 2, 'Hola mundo de nuevo!', '505', '', '400', '2021-10-10 22:46:20', '2021-10-10 20:46:20'),
(3, 1, 'Router SKY WIFI', '20263196_88669996.jpg', 4, 'Wifi de la mejor calidad', '518', '', '570', '2021-10-10 22:53:06', '2021-10-10 20:53:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(20) NOT NULL,
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `rol` int(20) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `creado`, `actualizado`) VALUES
(1, 'Administrador', '2001@gmail.com', '$2y$10$MJlujy1qBwHoH3yTzOsbrejYhwuhD8T8PxzNq82Yv7StE07xn91ci', 1, '2021-09-23', '2021-11-20 18:47:47'),
(2, 'César_Jo', 'cesar@gmail.com', '$2y$10$FjyGfTNH5o4eHhSdVIrvj.z.f9UMZEse3XFhwORW25QtYHbznEaA6', 2, '2021-10-15', '2021-11-26 18:34:30'),
(3, 'Kevin2001', 'kevin@gmail.com', '$2y$10$K6cqeZbOw.0xr7GKXJj4iuAXySiFZivETaqtYqEpKkFu.CUVIUrD2', 2, '2021-10-27', '2021-11-27 17:49:51'),
(6, 'miguel', 'miguel@gmail.com', '$2y$10$wh6rE8/zNH6yK0pnsD0Y0OsEuByMwo3E9xP.908Q9YsmjIXzvQsCy', 0, '2021-10-29', '2021-11-26 18:34:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(20) NOT NULL,
  `id_usuario` int(20) NOT NULL,
  `total` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id_envio`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_ventas`
--
ALTER TABLE `productos_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id_envio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `productos_ventas`
--
ALTER TABLE `productos_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
