-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2021 a las 05:50:06
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `matricula` int(10) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellidop` varchar(25) NOT NULL,
  `apellidom` varchar(25) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `img` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`matricula`, `nombre`, `apellidop`, `apellidom`, `telefono`, `email`, `img`) VALUES
(17971200, 'Jeser leonel', 'Pena', 'Nieto', '9531271332', 'roter.herbst@gmail.com', 'FolderGrey.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `username` varchar(20) NOT NULL,
  `edad` varchar(5) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `ciudad` varchar(60) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `password` varchar(35) NOT NULL,
  `img` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `username`, `edad`, `sexo`, `email`, `direccion`, `telefono`, `ciudad`, `cp`, `password`, `img`) VALUES
(3, 'Jeser', 'Roterherbst', '21', 'Hombre', 'roter.herbst@gmail.com', 'Oaxaca', '9531271332', 'Putla', '71006', 'Roterherbst', 'aziz-acharki-549137-unsplash-1200x775.jpg'),
(4, 'Damaris', 'damaris', '18', 'Mujer', 'damaris.g102@gmail.com', 'oaxaca', '9532126137', 'oaxaca', '71001', 'b45d3d7d084f5acfa63eb6d0ba85cccf', 'HP-Explorer-Dock-512.png'),
(5, 'Jeser', 'jeser1', '21', 'Hombre', 'caosmagesoacnedro@gmail.com', 'oaxaca', '9531271224', 'oaxaxca', '71006', '0a9725e4fd8d3b0b72dcfc4c7e1d0133', 'HP-Firefox-Dock-512.png'),
(6, 'jeser', 'jeser', '20', 'Hombre', 'roter.herbst@gmail.com', 'oaxaca', '9531271332', 'oaxaca', '71006', 'b45d3d7d084f5acfa63eb6d0ba85cccf', 'HP-GarageBand-Dock-512.png'),
(7, 'Loenel', 'Leonelp', '21', 'Hombre', 'roter.herbst@gmail.comm', 'Oaxaca', '9531271332', 'Oaxaca', '71006', 'bd462d5d7e7d5f8416515c6b0f3ed640', 'suspended_by_conzitool_deix8hy-pre.jpg'),
(8, 'Jeserpena', 'Jeserpena', '21', 'Hombre', 'Jeser_pena@gmail.com', 'oaxaca', '9531271332', 'Oaxaca', '71006', 'bd462d5d7e7d5f8416515c6b0f3ed640', 'Headphones.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
