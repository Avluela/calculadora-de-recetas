-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2019 a las 18:42:10
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calculadora_recetas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` tinyint(2) UNSIGNED NOT NULL,
  `categoria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(1, 'postre'),
(2, 'relleno'),
(3, 'cobertura'),
(4, 'plato principal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingrediente`
--

CREATE TABLE `ingrediente` (
  `id_ingrediente` mediumint(4) UNSIGNED NOT NULL,
  `ingrediente` varchar(30) NOT NULL,
  `id_medida` tinyint(3) UNSIGNED NOT NULL,
  `costo_unidad` float(4,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ingrediente`
--

INSERT INTO `ingrediente` (`id_ingrediente`, `ingrediente`, `id_medida`, `costo_unidad`) VALUES
(8, 'Tiempo de Trabajo', 5, 1.77),
(9, 'Harina Leudante', 1, 0.45),
(10, 'Azúcar', 1, 0.45),
(11, 'Manteca', 1, 1.00),
(12, 'Chocolate en Polvo', 1, 0.52),
(13, 'Huevos', 13, 3.25),
(14, 'Leche Líquida Entera', 3, 0.80),
(15, 'Aceite de Girasol', 3, 0.11),
(16, 'Chocolate de Cobertura', 1, 1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida`
--

CREATE TABLE `medida` (
  `id_medida` tinyint(3) UNSIGNED NOT NULL,
  `medida` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medida`
--

INSERT INTO `medida` (`id_medida`, `medida`) VALUES
(1, 'g'),
(3, 'ml'),
(5, 'min'),
(13, 'unid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_receta`
--

CREATE TABLE `nivel_receta` (
  `id_nivel` tinyint(2) UNSIGNED NOT NULL,
  `nivel` varchar(10) DEFAULT NULL COMMENT 'las recetas secundarias son las que se adicionan a las recetas primarias'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel_receta`
--

INSERT INTO `nivel_receta` (`id_nivel`, `nivel`) VALUES
(1, 'primaria'),
(2, 'secundaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_receta` mediumint(4) UNSIGNED NOT NULL,
  `receta` varchar(50) NOT NULL,
  `porciones` tinyint(2) DEFAULT NULL,
  `peso` smallint(5) UNSIGNED DEFAULT NULL,
  `preparacion` text DEFAULT NULL,
  `id_categoria` tinyint(2) UNSIGNED DEFAULT NULL,
  `id_nivel` tinyint(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_receta`, `receta`, `porciones`, `peso`, `preparacion`, `id_categoria`, `id_nivel`) VALUES
(1, 'Bizcochuelo de Chocolate', 8, 500, 'se baten los huevos enteros con el azúcar, agregando poco a poco la harina, la manteca derretida (a baño maría) y el chocolate. Se añade la leche, lo justo y necesario para obtener una pasta lisa y homogénea, pero espesa.\r\nSe aceita un molde redondo y se deposita en él esta pasta, que se cuece en el horno a una temperatura moderada.\r\nSe puede servir cubierto con crema de chocolate o chocolate derretido.', 1, 1),
(2, 'Cobertura de Chocolate', 1, NULL, 'derretir el chocolate a baño maria y verter sobre lo que se quiera cubrir', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta_ingredientes`
--

CREATE TABLE `receta_ingredientes` (
  `id_receta` mediumint(4) UNSIGNED NOT NULL,
  `id_ingrediente` mediumint(4) UNSIGNED NOT NULL,
  `cantidad` mediumint(4) UNSIGNED DEFAULT NULL,
  `rendimiento` tinyint(3) UNSIGNED NOT NULL COMMENT 'porcentaje de rendimiento'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `receta_ingredientes`
--

INSERT INTO `receta_ingredientes` (`id_receta`, `id_ingrediente`, `cantidad`, `rendimiento`) VALUES
(1, 8, 60, 100),
(1, 9, 250, 100),
(1, 10, 250, 100),
(1, 11, 125, 100),
(1, 12, 125, 100),
(1, 13, 4, 100),
(1, 14, 50, 100),
(1, 15, 15, 100),
(2, 16, NULL, 75);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`id_ingrediente`),
  ADD KEY `id_medida` (`id_medida`);

--
-- Indices de la tabla `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`id_medida`);

--
-- Indices de la tabla `nivel_receta`
--
ALTER TABLE `nivel_receta`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_nivel` (`id_nivel`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `receta_ingredientes`
--
ALTER TABLE `receta_ingredientes`
  ADD PRIMARY KEY (`id_receta`,`id_ingrediente`),
  ADD KEY `id_receta` (`id_receta`),
  ADD KEY `id_ingrediente` (`id_ingrediente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `id_ingrediente` mediumint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `medida`
--
ALTER TABLE `medida`
  MODIFY `id_medida` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `nivel_receta`
--
ALTER TABLE `nivel_receta`
  MODIFY `id_nivel` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_receta` mediumint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD CONSTRAINT `ingrediente_ibfk_2` FOREIGN KEY (`id_medida`) REFERENCES `medida` (`id_medida`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`id_nivel`) REFERENCES `nivel_receta` (`id_nivel`),
  ADD CONSTRAINT `receta_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `receta_ingredientes`
--
ALTER TABLE `receta_ingredientes`
  ADD CONSTRAINT `receta_ingredientes_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `receta` (`id_receta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receta_ingredientes_ibfk_2` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingrediente` (`id_ingrediente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
