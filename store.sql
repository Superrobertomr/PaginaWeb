-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2018 a las 23:50:09
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `store`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `CodigoCat` varchar(2) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`CodigoCat`, `Nombre`, `Descripcion`) VALUES
('C1', 'Contabilidad web', 'Servicios contables vÃ­a web'),
('C2', 'Contabilidad Escritorio', 'Servicios contables en su empresa'),
('C3', 'Nomina Virtual', 'Nomina, asimilados y reportes virtualmente'),
('C4', 'Factura Web', 'FacturaciÃ³n vÃ­a web'),
('C5', 'BORRAME', 'PRUEBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `RFC` varchar(30) NOT NULL,
  `Nickname` varchar(30) NOT NULL,
  `NombreCompleto` varchar(70) NOT NULL,
  `Apellido` varchar(70) NOT NULL,
  `Clave` text NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` int(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`RFC`, `Nickname`, `NombreCompleto`, `Apellido`, `Clave`, `Direccion`, `Telefono`, `Email`, `status`) VALUES
('PRUEBA1231231', 'PRUEBA', 'PRUEBA', 'PRUEBA', '202cb962ac59075b964b07152d234b70', 'PRUEBA', 2147483647, 'robertomr01.rmrf@gmail.com@', 0),
('PRUEBAPRUEB21', 'Solideath', 'Ritian', 'Zhou', '202cb962ac59075b964b07152d234b70', 'China', 2147483647, 'ritian_zhou@gmail.com', 0),
('pruebaprueba1', 'prueba', 'prueba', 'prueba', '202cb962ac59075b964b07152d234b70', 'prueba', 2147483647, 'prueba', 0),
('pruebaprueba2', 'Pruebados', 'Pruebados', 'Pruebados', '81dc9bdb52d04dc20036dbd8313ed055', 'Prueba2', 2147483647, 'robertomr01.rmrf@gmail.com', 0),
('QWER121221QWE', 'YOLO', 'Ola', 'K Ase', '4297f44b13955235245b2497399d7a93', 'asfdjgfhasghafjsgj', 123123123, 'paco@gmail.com', 0),
('qwertyqwerty1', 'qwerty', 'qwerty', 'qwerty', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'qwerty123', 2147483647, 'robertomr01.rmrf@', 0),
('UEUO124587GHD', 'Ufuefue', 'enefuefue ubunufu', 'osas', '4297f44b13955235245b2497399d7a93', 'Aqui', 2147483647, 'asd@qwer.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `NumPedido` int(20) NOT NULL,
  `CodigoProd` varchar(30) NOT NULL,
  `CantidadProductos` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`NumPedido`, `CodigoProd`, `CantidadProductos`) VALUES
(65, '1001', 1),
(65, '1004', 1),
(65, '1001', 1),
(66, '1004', 1),
(66, '1005', 1),
(67, '1001', 1),
(68, '1001', 1),
(69, '1004', 1),
(70, '1004', 1),
(71, '1001', 1),
(73, '1001', 0),
(73, '1004', 0),
(74, '1006', 0),
(74, '1005', 0),
(75, '1004', 1),
(75, '1001', 1),
(76, '1001', 1),
(76, '1004', 1),
(77, '1001', 1),
(78, '1001', 1),
(78, '1001', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `IdLicencia` int(10) NOT NULL,
  `DescripcionLic` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `FechaVen` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `CodigoProd` varchar(30) NOT NULL,
  `NombreProd` varchar(30) NOT NULL,
  `CodigoCat` varchar(2) NOT NULL,
  `Precio` decimal(30,2) NOT NULL,
  `Descripcion` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `RFCProveedor` varchar(30) NOT NULL,
  `Imagen` varchar(150) NOT NULL,
  `Descuento` decimal(2,2) NOT NULL,
  `IVA` decimal(10,2) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`CodigoProd`, `NombreProd`, `CodigoCat`, `Precio`, `Descripcion`, `RFCProveedor`, `Imagen`, `Descuento`, `IVA`, `Estado`) VALUES
('1001', 'FacturaciÃ³n1', 'C1', '500.55', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...Lorem ipsum dolor sit amet, consectetur adipisicing elit...  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...Lorem ipsum dolor sit amet, consectetur adipisicing elit...  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...Lorem ipsum dolor sit amet, consectetur adipisicing elit...  Ut enim ad minim veniam, quis nostrud exercitatio', 'ROFR940115JF2', 'Logo_Nube_opt.png', '0.17', '0.00', 0),
('1002', 'NÃ³minas', 'C3', '121.50', 'Llevadas por nuestra empresa', 'ROFR940115JF2', 'Logo_Nube_opt.png', '0.40', '0.16', 0),
('1003', 'CFDI', 'C4', '111.00', 'FacturaciÃ³n con CFDI 3.3', 'ROFR940115JF2', 'Captura.PNG', '0.75', '0.16', 0),
('1004', 'Cuentas por cobrar', 'C1', '165.60', 'manejaremos de manera en linea tus cuentas por cobrar', 'ROFR940115JF2', 'Captura.PNG', '0.50', '0.16', 0),
('1005', 'FacturaciÃ³n web', 'C2', '232.33', 'vÃ­a web', 'ROFR940115JF2', 'Captura.PNG', '0.25', '0.16', 0),
('1006', 'Cuentas por cobrar', 'C2', '250.50', 'hÃ¡galo usted mismo', 'ROFR940115JF2', 'Captura.PNG', '0.25', '0.16', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `RFCProveedor` varchar(30) NOT NULL,
  `NombreProveedor` varchar(30) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` int(20) NOT NULL,
  `PaginaWeb` varchar(30) NOT NULL,
  `Clave` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`RFCProveedor`, `NombreProveedor`, `Direccion`, `Telefono`, `PaginaWeb`, `Clave`) VALUES
('PRUEBA1234567', 'ASESOR', 'ASESOR123', 2147483647, 'TUCONTADORVIRTUAL', '54a2ec5f4421fa24bfa9bf6461e649a2'),
('ROFR940115JF2', 'Contador Virtual', 'Av Hidalgo 18 y 19', 2147483647, 'tucontadorvirtual.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `IdRegistro` int(11) NOT NULL,
  `Nickname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`IdRegistro`, `Nickname`, `Email`, `Password`) VALUES
(1, '[Solideath]', '[robertomr01@hotmail.com]', '[123]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte`
--

CREATE TABLE `soporte` (
  `IdSoporte` int(10) NOT NULL,
  `NombreSop` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `DescripcionSop` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `NumPedido` int(20) NOT NULL,
  `Fecha` varchar(10) NOT NULL,
  `RFC` varchar(30) NOT NULL,
  `TotalPagar` decimal(30,2) NOT NULL,
  `Estado` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`NumPedido`, `Fecha`, `RFC`, `TotalPagar`, `Estado`) VALUES
(65, '2018-01-19', 'UEUO124587GHD', '912.75', 'Entregado'),
(66, '2018-01-19', 'UEUO124587GHD', '256.75', 'Pendiente'),
(67, '2018-01-19', 'UEUO124587GHD', '415.46', 'Pendiente'),
(68, '2018-01-19', 'UEUO124587GHD', '415.46', 'Pendiente'),
(69, '2018-01-19', 'UEUO124587GHD', '82.80', 'Pendiente'),
(70, '2018-01-19', 'UEUO124587GHD', '82.80', 'Pendiente'),
(71, '2018-01-19', 'UEUO124587GHD', '415.46', 'Pendiente'),
(73, '2018-01-20', 'UEUO124587GHD', '498.26', 'Pendiente'),
(74, '2018-01-20', 'UEUO124587GHD', '362.12', 'Pendiente'),
(75, '2018-01-20', 'UEUO124587GHD', '498.26', 'Pendiente'),
(76, '2018-01-20', 'UEUO124587GHD', '525.12', 'Pendiente'),
(77, '2018-01-24', 'UEUO124587GHD', '500.55', 'Pendiente'),
(78, '2018-01-24', 'UEUO124587GHD', '1001.10', 'Pendiente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CodigoCat`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`RFC`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD KEY `NumPedido` (`NumPedido`),
  ADD KEY `CodigoProd` (`CodigoProd`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`IdLicencia`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`CodigoProd`),
  ADD KEY `CodigoCat` (`CodigoCat`),
  ADD KEY `NITProveedor` (`RFCProveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`RFCProveedor`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`IdRegistro`);

--
-- Indices de la tabla `soporte`
--
ALTER TABLE `soporte`
  ADD PRIMARY KEY (`IdSoporte`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`NumPedido`),
  ADD KEY `NIT` (`RFC`),
  ADD KEY `NIT_2` (`RFC`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `IdLicencia` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `IdRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `soporte`
--
ALTER TABLE `soporte`
  MODIFY `IdSoporte` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `NumPedido` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_8` FOREIGN KEY (`CodigoProd`) REFERENCES `producto` (`CodigoProd`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_ibfk_9` FOREIGN KEY (`NumPedido`) REFERENCES `venta` (`NumPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_8` FOREIGN KEY (`RFCProveedor`) REFERENCES `proveedor` (`RFCProveedor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_9` FOREIGN KEY (`CodigoCat`) REFERENCES `categoria` (`CodigoCat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`RFC`) REFERENCES `cliente` (`RFC`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
