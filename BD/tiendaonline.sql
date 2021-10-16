-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2019 a las 01:32:44
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendaonline`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(3) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `cp` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `validado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellidos`, `email`, `direccion`, `cp`, `estado`, `telefono`, `password`, `validado`) VALUES
(1, 'Isai', 'Salazar Rodriguez', 'isai.salazar@hotmail.com', 'Rayon 722', '78430', 'San Luis Potosi', '4443166829', '123456789', 1),
(2, 'Pepe', 'Cuenca', 'pepe@hotmail.com', 'cristobal 234', '159', 'San Luis Potosi', '369852147', '987654321', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos`
--

CREATE TABLE `codigos` (
  `id_codigo` int(3) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `fecha_antigua` int(15) NOT NULL,
  `id_cliente` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `comentario` text COLLATE latin1_spanish_ci NOT NULL,
  `puntuacion` tinyint(1) NOT NULL,
  `correo` bit(1) NOT NULL,
  `url` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `fecha`, `nombre`, `comentario`, `puntuacion`, `correo`, `url`, `id_cliente`, `id_producto`, `id_marca`, `estado`) VALUES
(50, '2019-12-06 17:16:13', 'Isai 1', 'hjdshdshjdfjhdfhjdf bg', 4, b'1', '', 1, 1, 0, 0),
(51, '2019-12-06 19:23:54', 'Pepe 2', 'hdfhfdhdhdfhfdjjfhjffghjfg', 4, b'1', '', 2, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_imagen` int(4) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `prioridad` int(1) NOT NULL,
  `id_producto` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_imagen`, `nombre`, `prioridad`, `id_producto`) VALUES
(102, '1575519129_01.jpeg', 1, 1),
(103, '1575519129_02.jpg', 2, 1),
(104, '1575519129_03.jpg', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interruptor`
--

CREATE TABLE `interruptor` (
  `id_interruptor` int(11) NOT NULL,
  `estado` bit(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `interruptor`
--

INSERT INTO `interruptor` (`id_interruptor`, `estado`) VALUES
(1, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interruptor_stock`
--

CREATE TABLE `interruptor_stock` (
  `id` tinyint(1) NOT NULL,
  `estado` bit(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `interruptor_stock`
--

INSERT INTO `interruptor_stock` (`id`, `estado`) VALUES
(1, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `marca` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `marca`) VALUES
(1, 'Huawei'),
(5, 'Lanix'),
(6, 'Samsung'),
(7, 'Apple'),
(8, 'Nokia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido` int(5) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `cantidad` int(2) NOT NULL,
  `precio_producto` double NOT NULL,
  `id_cliente` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`pedido`, `producto`, `cantidad`, `precio_producto`, `id_cliente`) VALUES
(1, 'Samsung Galaxy s7', 2, 6800, 1),
(2, 'Samsung Galaxy s7', 1, 6800, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos2`
--

CREATE TABLE `pedidos2` (
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_pedido` double NOT NULL,
  `envio` bit(1) NOT NULL,
  `pago` varchar(50) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 0,
  `pedido` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos2`
--

INSERT INTO `pedidos2` (`fecha_pedido`, `total_pedido`, `envio`, `pago`, `estado`, `pedido`) VALUES
('2019-12-06 15:06:55', 13600, b'0', 'Efectivo', 0, 1),
('2019-12-06 19:23:31', 6800, b'0', 'Efectivo', 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(3) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `precio` double NOT NULL,
  `descripcion` text NOT NULL,
  `id_marca` int(2) NOT NULL,
  `inicio` int(1) NOT NULL DEFAULT 0,
  `cantidad` smallint(6) NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `descripcion`, `id_marca`, `inicio`, `cantidad`) VALUES
(1, 'Samsung Galaxy s7', 6800, 'Samsung galaxy con 4 nucelos, 16GB en tarjeta SD, 4GB de memoria interna, android 6, camara de 10Mp.', 6, 1, 97);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `codigos`
--
ALTER TABLE `codigos`
  ADD PRIMARY KEY (`id_codigo`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `interruptor`
--
ALTER TABLE `interruptor`
  ADD PRIMARY KEY (`id_interruptor`);

--
-- Indices de la tabla `interruptor_stock`
--
ALTER TABLE `interruptor_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `codigos`
--
ALTER TABLE `codigos`
  MODIFY `id_codigo` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `interruptor`
--
ALTER TABLE `interruptor`
  MODIFY `id_interruptor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `interruptor_stock`
--
ALTER TABLE `interruptor_stock`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
