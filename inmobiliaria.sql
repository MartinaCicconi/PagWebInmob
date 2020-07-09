-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2020 a las 21:30:54
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `borrar_administrador`
--

CREATE TABLE `borrar_administrador` (
  `DNI` int(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellido` varchar(30) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Contrasena` varchar(30) NOT NULL,
  `id_tipousuario` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `borrar_administrador`
--

INSERT INTO `borrar_administrador` (`DNI`, `Nombre`, `Apellido`, `Telefono`, `Email`, `Contrasena`, `id_tipousuario`) VALUES
(38455127, 'Martina', 'Cicconi', '165847979', 'martinacicconi@gmail.com', 'admin', 0),
(0, 'rufus', 'cicconi', '1234', 'r@g.com', 'rufus', 0),
(37445889, 'Micaela', 'Cicconi', '128997456', 'micac@gmail.com', 'mica', 0),
(12345678, 'Manuela', 'Maneiro', '115897474', 'mm@gmail.com', 'duena', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotospropiedades`
--

CREATE TABLE `fotospropiedades` (
  `NombreArchivo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `idFoto` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `idProp` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `fotospropiedades`
--

INSERT INTO `fotospropiedades` (`NombreArchivo`, `idFoto`, `idProp`) VALUES
('imagenes/Propiedad_7/fotoA.jpg', '0', '7'),
('imagenes/Propiedad_7/fotoB.jpg', '1', '7'),
('imagenes/Propiedad_7/fotoC.jpg', '2', '7'),
('imagenes/Propiedad_7/fotoD.jpg', '3', '7'),
('imagenes/Propiedad_7/fotoE.jpg', '4', '7'),
('imagenes/Propiedad_8/fotoA.jpg', '0', '8'),
('imagenes/Propiedad_8/fotoB.jpg', '1', '8'),
('imagenes/Propiedad_8/fotoC.jpg', '2', '8'),
('imagenes/Propiedad_8/fotoD.jpg', '3', '8'),
('imagenes/Propiedad_8/fotoE.jpg', '4', '8'),
('imagenes/Propiedad_12/fotoA.jpg', '0', '12'),
('imagenes/Propiedad_12/fotoB.jpg', '1', '12'),
('imagenes/Propiedad_13/fotoA.jpg', '0', '13'),
('imagenes/Propiedad_13/fotoB.jpg', '1', '13'),
('imagenes/Propiedad_13/fotoC.jpg', '2', '13'),
('imagenes/Propiedad_14/fotoA.jpg', '0', '14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `Id_Prop` int(3) NOT NULL,
  `Direccion` text NOT NULL,
  `id_tipopropiedad` int(10) NOT NULL,
  `Precio` int(8) NOT NULL,
  `Estado` text NOT NULL,
  `Informacion` varchar(350) NOT NULL,
  `Cant_habitaciones` int(10) NOT NULL,
  `Cochera` tinyint(1) NOT NULL,
  `Patio` tinyint(1) NOT NULL,
  `Piscina` int(1) NOT NULL,
  `Balcon` int(1) NOT NULL,
  `Quincho` int(1) NOT NULL,
  `Activa` int(1) NOT NULL DEFAULT 1,
  `id_ubicacion` int(11) NOT NULL,
  `direc_visible` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`Id_Prop`, `Direccion`, `id_tipopropiedad`, `Precio`, `Estado`, `Informacion`, `Cant_habitaciones`, `Cochera`, `Patio`, `Piscina`, `Balcon`, `Quincho`, `Activa`, `id_ubicacion`, `direc_visible`) VALUES
(8, 'Garay 340', 3, 99999, 'Venta', 'Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueb. ', -1, 0, 0, 0, 0, 0, 1, 4, '1'),
(7, 'Moreno 930', 3, 12000, 'Alquiler', '  Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueb', -1, 1, 0, 0, 0, 0, 1, 1, '1'),
(12, 'Alberti 400', 2, 30000, 'Alquiler', '      Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del in', -1, 0, 0, 0, 0, 0, 1, 2, '1'),
(13, 'Garay 1200', 4, 200000, 'Venta', '  Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueb', -1, 0, 0, 0, 0, 0, 1, 1, '1'),
(14, 'Suarez 1500', 4, 130000, 'Venta', 'Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueble. Texto descriptivo del inmueb. ', -1, 0, 0, 0, 0, 0, 1, 1, '1'),
(15, 'Brown 890', 1, 100, 'Venta', '                                              ', -1, 1, 1, 0, 1, 1, 1, 2, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopropiedad`
--

CREATE TABLE `tipopropiedad` (
  `id_tipo` int(10) NOT NULL,
  `tipo_propiedad` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `activo` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tipopropiedad`
--

INSERT INTO `tipopropiedad` (`id_tipo`, `tipo_propiedad`, `activo`) VALUES
(1, 'Casa', 1),
(2, 'Departamento', 1),
(3, 'Local', 1),
(4, 'Terreno', 1),
(5, 'Campo', 1),
(6, 'Duplex', 1),
(7, 'Fondo De Comercio', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `id` int(1) NOT NULL,
  `tipo` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`id`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `activa` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id`, `nombre`, `activa`) VALUES
(1, 'Coronel Pringles, Bs As', 1),
(2, 'BahÃ­a Blanca, Bs As', 1),
(3, 'Villa Regina', 1),
(4, 'Coronel Suarez, Bs As ', 1),
(5, 'Cabildo', 1),
(6, 'La Colina', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `DNI` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Apellido` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Telefono` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `Email` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Contrasena` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `id_tipousuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `DNI`, `Nombre`, `Apellido`, `Telefono`, `Email`, `Contrasena`, `id_tipousuario`) VALUES
(6, '38914219', 'Martina', 'Cicconi', '2915007940', 'martinacicconi@gmail.com', 'admin', 1),
(7, '12133', 'prueba', 'probando', '12132', 'pp@gmail.com', '1234', 2),
(8, '55555555', 'Alabama', 'Casale', '12234335', 'alabama.casale@gmail.com', 'inmobiliaria', 2),
(9, '1', 'verificando', 'verif', '12345687', 'vv@gmail.com', 'hola1234', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `borrar_administrador`
--
ALTER TABLE `borrar_administrador`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`Id_Prop`);

--
-- Indices de la tabla `tipopropiedad`
--
ALTER TABLE `tipopropiedad`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `Id_Prop` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tipopropiedad`
--
ALTER TABLE `tipopropiedad`
  MODIFY `id_tipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
