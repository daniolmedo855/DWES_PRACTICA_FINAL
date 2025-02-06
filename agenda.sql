-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2025 a las 13:06:50
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(20) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`id`, `usuario`, `nombre`, `apellidos`, `fecha`) VALUES
(1, 6, 'Hola', 'Adios', '2011-06-02'),
(3, 2, 'Sofia', 'Gomezs', '1995-07-30'),
(4, 3, 'Raul', 'Fernandez', '1992-11-10'),
(5, 2, 'Luis', 'Sanchez', '1993-03-25'),
(6, 3, 'Elena', 'Torres', '1997-06-18'),
(7, 4, 'Carlos', 'Ramirez', '1994-05-12'),
(8, 5, 'Marina', 'Diaz', '1996-08-20'),
(9, 6, 'Adrian', 'Castillo', '1990-10-15'),
(10, 7, 'Beatriz', 'Moreno', '1998-12-05'),
(14, 2, 'Claudia', 'Fernandez', '1995-11-23'),
(16, 3, 'Beatriz', 'Lopez', '1996-09-14'),
(17, 4, 'Carmen', 'Gonzalez', '1993-07-30'),
(18, 4, 'Mario', 'Ramirez', '1990-12-10'),
(19, 5, 'Sergio', 'Ortega', '1991-03-21'),
(20, 5, 'Angela', 'Torres', '1995-05-25'),
(21, 6, 'Laura', 'Martinez', '1997-06-07'),
(22, 6, 'Javier', 'Sanchez', '1992-10-01'),
(23, 7, 'Pablo', 'Dominguez', '1994-04-29'),
(24, 7, 'Raquel', 'Castro', '1996-08-12'),
(25, 8, 'Esteban', 'Gutierrez', '1993-05-18'),
(26, 8, 'Victoria', 'Navarro', '1997-11-03'),
(27, 9, 'Oscar', 'Iglesias', '1992-12-24'),
(28, 9, 'Elena', 'Vargas', '1995-09-09'),
(29, 10, 'Hector', 'Paredes', '1991-02-13'),
(30, 10, 'Silvia', 'Fuentes', '1996-07-17'),
(33, 2, 'Diego', 'Morales', '1992-08-19'),
(34, 3, 'Claudias', 'Fernandez', '1995-11-16'),
(35, 3, 'Antonio', 'Ruiz', '1994-02-05'),
(36, 3, 'Beatriz', 'Lopez', '1996-09-14'),
(39, 5, 'Sergio', 'Ortega', '1991-03-21'),
(40, 5, 'Angela', 'Torres', '1995-05-25'),
(41, 6, 'Laura', 'Martinez', '1997-06-07'),
(42, 6, 'Javier', 'Sanchez', '1992-10-01'),
(43, 7, 'Pablo', 'Dominguez', '1994-04-29'),
(44, 7, 'Raquel', 'Castro', '1996-08-12'),
(45, 8, 'Esteban', 'Gutierrez', '1993-05-18'),
(46, 8, 'Victoria', 'Navarro', '1997-11-03'),
(47, 9, 'Oscar', 'Iglesias', '1992-12-24'),
(48, 9, 'Elena', 'Vargas', '1995-09-09'),
(49, 10, 'Hector', 'Paredes', '1991-02-13'),
(50, 10, 'Silvia', 'Fuentes', '1996-07-17'),
(53, 2, 'Sofia', '123', '2025-02-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `plataforma` varchar(20) NOT NULL,
  `anio` year(4) NOT NULL,
  `imagen` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `usuario`, `titulo`, `plataforma`, `anio`, `imagen`) VALUES
(53, 2, 'The Last of Us', 'PlayStation 5', '2020', '../img/20.jpg'),
(54, 3, 'God of War', 'PlayStation 4', '2018', 'god_of_war.jpg'),
(55, 4, 'Minecraft', 'PC', '2011', 'minecraft.jpg'),
(56, 5, 'The Witcher 3', 'PC', '2015', 'witcher_3.jpg'),
(57, 6, 'Cyberpunk 2077', 'PlayStation 4', '2020', 'cyberpunk_2077.jpg'),
(58, 7, 'FIFA 21', 'Xbox One', '2020', 'fifa_21.jpg'),
(59, 8, 'Gran Turismo 7', 'PlayStation 5', '2022', 'gran_turismo_7.jpg'),
(60, 9, 'Red Dead Redemption 2', 'PlayStation 4', '2018', 'rdr_2.jpg'),
(61, 10, 'Animal Crossing: New Horizons', 'Nintendo Switch', '2020', 'animal_crossing.jpg'),
(62, 2, 'Call of Duty: Warzone', 'PC', '2020', '../img/21.jpg'),
(63, 2, 'prueba', 'prueba1', '2111', '../img/19.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED NOT NULL,
  `amigo` bigint(20) UNSIGNED NOT NULL,
  `juego` bigint(20) UNSIGNED NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `devuelto` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `usuario`, `amigo`, `juego`, `fecha_prestamo`, `devuelto`) VALUES
(161, 2, 3, 62, '2025-02-15', 1),
(162, 2, 5, 62, '2025-02-08', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `contrasenia` varchar(20) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT 0 CHECK (`admin` in (0,1))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasenia`, `admin`) VALUES
(1, 'admin', 'admin', 1),
(2, 'Daniel', '1234', 0),
(3, 'Pedro', 'secure456', 0),
(4, 'Marta', 'clave789', 0),
(5, 'Andres', 'andrespass', 0),
(6, 'Sergio', 'sergio123', 0),
(7, 'Elena', 'elena456', 0),
(8, 'Diego', 'diego789', 0),
(9, 'Raquel', 'raquelpass', 0),
(10, 'Hugo', 'hugo123', 0),
(11, 'Manuel', 'manuelpass', 0),
(12, 'Rocio', 'rocio123', 0),
(13, 'David', 'david456', 0),
(14, 'Sandra', 'sandra789', 0),
(15, 'Juan', 'juanpass', 0),
(16, 'Isabel', 'isabel123', 0),
(17, 'Cristian', 'cristian456', 0),
(18, 'Natalia', 'natalia789', 0),
(19, 'Alberto', 'albertopass', 0),
(20, 'Patricia', 'patricia123', 0),
(40, 'asdasd', 'aaa', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_ami_usu` (`usuario`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_jue_usu` (`usuario`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_pre_usu` (`usuario`),
  ADD KEY `fk_pre_jue` (`juego`),
  ADD KEY `fk_pre_ami` (`amigo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `fk_ami_usu` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `fk_jue_usu` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `fk_pre_ami` FOREIGN KEY (`amigo`) REFERENCES `amigos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pre_jue` FOREIGN KEY (`juego`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pre_usu` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
