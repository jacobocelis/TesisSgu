-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2015 a las 10:17:59
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tsg`
--
CREATE DATABASE IF NOT EXISTS `tsg` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tsg`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_authassignment`
--

DROP TABLE IF EXISTS `cruge_authassignment`;
CREATE TABLE IF NOT EXISTS `cruge_authassignment` (
  `userid` int(11) NOT NULL,
  `itemname` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  `activo` tinyint(1) DEFAULT '1',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_authitem`
--

DROP TABLE IF EXISTS `cruge_authitem`;
CREATE TABLE IF NOT EXISTS `cruge_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cruge_authitem`
--

INSERT INTO `cruge_authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('action_mttocorrectivo_cerrarOrdenes', 0, '', NULL, 'N;'),
('action_mttocorrectivo_crearOrdenCorrectiva', 0, '', NULL, 'N;'),
('action_mttocorrectivo_verOrdenes', 0, '', NULL, 'N;'),
('action_mttoPreventivo_actualizarCheck', 0, '', NULL, 'N;'),
('action_mttoPreventivo_ActualizarRepuesto', 0, '', NULL, 'N;'),
('action_mttoPreventivo_ActualizarServicio', 0, '', NULL, 'N;'),
('action_mttoPreventivo_actualizarSpan', 0, '', NULL, 'N;'),
('action_mttoPreventivo_actualizarSpanListas', 0, '', NULL, 'N;'),
('action_mttoPreventivo_agregarActividad', 0, '', NULL, 'N;'),
('action_mttoPreventivo_agregarFactura', 0, '', NULL, 'N;'),
('action_mttoPreventivo_agregarRecurso', 0, '', NULL, 'N;'),
('action_mttoPreventivo_agregarRecursoAdicional', 0, '', NULL, 'N;'),
('action_mttopreventivo_calendario', 0, '', NULL, 'N;'),
('action_mttoPreventivo_cambiarFecha', 0, '', NULL, 'N;'),
('action_mttopreventivo_cerrarOrdenes', 0, '', NULL, 'N;'),
('action_mttoPreventivo_crearOrden', 0, '', NULL, 'N;'),
('action_mttopreventivo_crearOrdenPreventiva', 0, '', NULL, 'N;'),
('action_mttoPreventivo_estatusOrden', 0, '', NULL, 'N;'),
('action_mttoPreventivo_getUltimoKm', 0, '', NULL, 'N;'),
('action_mttopreventivo_historicoGastos', 0, '', NULL, 'N;'),
('action_mttopreventivo_historicoOrdenes', 0, '', NULL, 'N;'),
('action_mttopreventivo_historicoPreventivo', 0, '', NULL, 'N;'),
('action_mttoPreventivo_index', 0, '', NULL, 'N;'),
('action_mttopreventivo_iniciales', 0, '', NULL, 'N;'),
('action_mttoPreventivo_insumos', 0, '', NULL, 'N;'),
('action_mttoPreventivo_mttopRealizados', 0, '', NULL, 'N;'),
('action_mttoPreventivo_ObtenerActividad', 0, '', NULL, 'N;'),
('action_mttoPreventivo_parametros', 0, '', NULL, 'N;'),
('action_mttopreventivo_planes', 0, '', NULL, 'N;'),
('action_mttoPreventivo_registrarFacturacion', 0, '', NULL, 'N;'),
('action_mttoPreventivo_repuesto', 0, '', NULL, 'N;'),
('action_mttopreventivo_verOrdenes', 0, '', NULL, 'N;'),
('action_mttoPreventivo_vistaPrevia', 0, '', NULL, 'N;'),
('action_mttoPreventivo_vistaPreviaPDF', 0, '', NULL, 'N;'),
('action_neumaticos_cerrarOrdenes', 0, '', NULL, 'N;'),
('action_neumaticos_crearOrdenCorrectiva', 0, '', NULL, 'N;'),
('action_neumaticos_verOrdenes', 0, '', NULL, 'N;');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_authitemchild`
--

DROP TABLE IF EXISTS `cruge_authitemchild`;
CREATE TABLE IF NOT EXISTS `cruge_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_field`
--

DROP TABLE IF EXISTS `cruge_field`;
CREATE TABLE IF NOT EXISTS `cruge_field` (
`idfield` int(11) NOT NULL,
  `fieldname` varchar(20) NOT NULL,
  `longname` varchar(50) DEFAULT NULL,
  `position` int(11) DEFAULT '0',
  `required` int(11) DEFAULT '0',
  `fieldtype` int(11) DEFAULT '0',
  `fieldsize` int(11) DEFAULT '20',
  `maxlength` int(11) DEFAULT '45',
  `showinreports` int(11) DEFAULT '0',
  `useregexp` varchar(512) DEFAULT NULL,
  `useregexpmsg` varchar(512) DEFAULT NULL,
  `predetvalue` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_fieldvalue`
--

DROP TABLE IF EXISTS `cruge_fieldvalue`;
CREATE TABLE IF NOT EXISTS `cruge_fieldvalue` (
`idfieldvalue` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idfield` int(11) NOT NULL,
  `value` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_session`
--

DROP TABLE IF EXISTS `cruge_session`;
CREATE TABLE IF NOT EXISTS `cruge_session` (
`idsession` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `created` bigint(30) DEFAULT NULL,
  `expire` bigint(30) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `ipaddress` varchar(45) DEFAULT NULL,
  `usagecount` int(11) DEFAULT '0',
  `lastusage` bigint(30) DEFAULT NULL,
  `logoutdate` bigint(30) DEFAULT NULL,
  `ipaddressout` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cruge_session`
--

INSERT INTO `cruge_session` (`idsession`, `iduser`, `created`, `expire`, `status`, `ipaddress`, `usagecount`, `lastusage`, `logoutdate`, `ipaddressout`) VALUES
(1, 1, 1432705965, 1432765905, 1, '::1', 1, 1432705965, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_system`
--

DROP TABLE IF EXISTS `cruge_system`;
CREATE TABLE IF NOT EXISTS `cruge_system` (
`idsystem` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `largename` varchar(45) DEFAULT NULL,
  `sessionmaxdurationmins` int(11) DEFAULT '999',
  `sessionmaxsameipconnections` int(11) DEFAULT '10',
  `sessionreusesessions` int(11) DEFAULT '1' COMMENT '1yes 0no',
  `sessionmaxsessionsperday` int(11) DEFAULT '-1',
  `sessionmaxsessionsperuser` int(11) DEFAULT '-1',
  `systemnonewsessions` int(11) DEFAULT '0' COMMENT '1yes 0no',
  `systemdown` int(11) DEFAULT '0',
  `registerusingcaptcha` int(11) DEFAULT '0',
  `registerusingterms` int(11) DEFAULT '0',
  `terms` blob,
  `registerusingactivation` int(11) DEFAULT '1',
  `defaultroleforregistration` varchar(64) DEFAULT NULL,
  `registerusingtermslabel` varchar(100) DEFAULT NULL,
  `registrationonlogin` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cruge_system`
--

INSERT INTO `cruge_system` (`idsystem`, `name`, `largename`, `sessionmaxdurationmins`, `sessionmaxsameipconnections`, `sessionreusesessions`, `sessionmaxsessionsperday`, `sessionmaxsessionsperuser`, `systemnonewsessions`, `systemdown`, `registerusingcaptcha`, `registerusingterms`, `terms`, `registerusingactivation`, `defaultroleforregistration`, `registerusingtermslabel`, `registrationonlogin`) VALUES
(1, 'default', NULL, 999, 10, 1, -1, 1, 0, 0, 0, 0, NULL, 0, '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_user`
--

DROP TABLE IF EXISTS `cruge_user`;
CREATE TABLE IF NOT EXISTS `cruge_user` (
`iduser` int(11) NOT NULL,
  `regdate` bigint(30) DEFAULT NULL,
  `actdate` bigint(30) DEFAULT NULL,
  `logondate` bigint(30) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL COMMENT 'Hashed password',
  `authkey` varchar(100) DEFAULT NULL COMMENT 'llave de autentificacion',
  `state` int(11) DEFAULT '0',
  `totalsessioncounter` int(11) DEFAULT '0',
  `currentsessioncounter` int(11) DEFAULT '0',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cruge_user`
--

INSERT INTO `cruge_user` (`iduser`, `regdate`, `actdate`, `logondate`, `username`, `email`, `password`, `authkey`, `state`, `totalsessioncounter`, `currentsessioncounter`, `fecha`) VALUES
(1, NULL, NULL, 1432705965, 'admin', 'admin@tucorreo.com', '123456', NULL, 1, NULL, NULL, NULL),
(2, NULL, NULL, NULL, 'invitado', 'invitado', 'nopassword', NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_accioncaucho`
--

DROP TABLE IF EXISTS `sgu_accioncaucho`;
CREATE TABLE IF NOT EXISTS `sgu_accioncaucho` (
`id` int(11) NOT NULL,
  `accion` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_accioncaucho`
--

INSERT INTO `sgu_accioncaucho` (`id`, `accion`) VALUES
(1, 'Renovar'),
(2, 'Rotación'),
(3, 'Reparar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_actividades`
--

DROP TABLE IF EXISTS `sgu_actividades`;
CREATE TABLE IF NOT EXISTS `sgu_actividades` (
`id` int(11) NOT NULL,
  `ultimoKm` int(11) NOT NULL DEFAULT '-1',
  `ultimoFecha` date NOT NULL DEFAULT '0000-01-01',
  `frecuenciaKm` int(11) NOT NULL,
  `frecuenciaMes` int(11) DEFAULT NULL,
  `proximoKm` int(11) DEFAULT NULL,
  `proximoFecha` date DEFAULT NULL,
  `duracion` int(11) NOT NULL DEFAULT '0',
  `atraso` int(11) DEFAULT NULL,
  `idprioridad` int(11) NOT NULL,
  `idtiempod` int(11) NOT NULL,
  `idtiempof` int(11) NOT NULL,
  `idactividadesGrupo` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idactividadMtto` int(11) NOT NULL,
  `fechaComenzada` date DEFAULT NULL,
  `fechaRealizada` date NOT NULL DEFAULT '0000-01-01',
  `kmRealizada` int(11) NOT NULL DEFAULT '-1',
  `procedimiento` varchar(200) DEFAULT NULL,
  `idvehiculo` int(11) NOT NULL,
  `inicial` int(11) DEFAULT '0',
  `factura` int(11) NOT NULL DEFAULT '1',
  `noConfirmo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_actividades`
--

INSERT INTO `sgu_actividades` (`id`, `ultimoKm`, `ultimoFecha`, `frecuenciaKm`, `frecuenciaMes`, `proximoKm`, `proximoFecha`, `duracion`, `atraso`, `idprioridad`, `idtiempod`, `idtiempof`, `idactividadesGrupo`, `idestatus`, `idactividadMtto`, `fechaComenzada`, `fechaRealizada`, `kmRealizada`, `procedimiento`, `idvehiculo`, `inicial`, `factura`, `noConfirmo`) VALUES
(1, 121145, '2014-12-27', 5000, 30, 126145, '2015-01-26', 1, 18, 2, 1, 1, 1, 3, 2, '2015-02-13', '2015-02-13', 125355, '', 1, 1, 1, 0),
(2, 62292, '2014-12-19', 5000, 30, 67292, '2015-01-18', 1, -3, 2, 1, 1, 1, 3, 2, '2015-01-15', '2015-01-15', 67412, '', 2, 1, 1, 0),
(5, 120880, '2014-12-14', 5000, 30, 125880, '2015-01-13', 1, 2, 1, 1, 1, 3, 3, 9, '2015-01-15', '2015-01-15', 125345, '', 1, 1, 1, 0),
(6, 63714, '2014-12-13', 5000, 30, 68714, '2015-01-12', 1, 3, 1, 1, 1, 3, 3, 9, '2015-01-15', '2015-01-15', 67412, '', 2, 1, 1, 0),
(7, 120506, '2014-12-12', 5000, 30, 125506, '2015-01-11', 1, 4, 1, 1, 1, 4, 3, 6, '2015-01-15', '2015-01-15', 125345, '', 1, 1, 1, 0),
(8, 62861, '2014-12-04', 5000, 30, 67861, '2015-01-03', 1, 12, 1, 1, 1, 4, 3, 6, '2015-01-15', '2015-01-15', 67412, '', 2, 1, 1, 0),
(9, 120616, '2014-12-18', 5000, 30, 125616, '2015-01-17', 1, -2, 1, 1, 1, 5, 3, 12, '2015-01-15', '2015-01-15', 125345, '', 1, 1, 1, 0),
(10, 63714, '2014-12-21', 5000, 30, 68714, '2015-01-20', 1, -5, 1, 1, 1, 5, 3, 12, '2015-01-15', '2015-01-15', 67412, '', 2, 1, 1, 0),
(11, 120351, '2014-12-22', 5000, 30, 125351, '2015-01-21', 1, -6, 1, 1, 1, 6, 3, 11, '2015-01-15', '2015-01-15', 125345, '', 1, 1, 1, 0),
(12, 63572, '2014-12-26', 5000, 30, 68572, '2015-01-25', 1, -10, 1, 1, 1, 6, 3, 11, '2015-01-15', '2015-01-15', 67412, '', 2, 1, 1, 0),
(13, 119823, '2014-12-11', 5000, 30, 124823, '2015-01-10', 1, 5, 1, 1, 1, 7, 3, 10, '2015-01-15', '2015-01-15', 125345, '', 1, 1, 1, 0),
(14, 61581, '2015-01-02', 5000, 30, 66581, '2015-02-01', 1, 12, 1, 1, 1, 7, 3, 10, '2015-02-13', '2015-02-13', 67432, '', 2, 1, 1, 0),
(15, 67412, '2015-01-15', 5000, 30, 72412, '2015-02-14', 1, -1, 1, 1, 1, 4, 3, 6, '2015-02-13', '2015-02-13', 67432, '', 2, 0, 1, 0),
(16, 125345, '2015-01-15', 5000, 30, 130345, '2015-02-14', 1, -1, 1, 1, 1, 7, 3, 10, '2015-02-13', '2015-02-13', 125355, '', 1, 0, 1, 0),
(17, 125345, '2015-01-15', 5000, 30, 130345, '2015-02-14', 1, -1, 1, 1, 1, 4, 3, 6, '2015-02-13', '2015-02-13', 125355, '', 1, 0, 1, 0),
(18, 67412, '2015-01-15', 5000, 30, 72412, '2015-02-14', 1, -1, 1, 1, 1, 3, 3, 9, '2015-02-13', '2015-02-13', 67432, '', 2, 0, 1, 0),
(19, 125345, '2015-01-15', 5000, 30, 130345, '2015-02-14', 1, -1, 1, 1, 1, 3, 3, 9, '2015-02-13', '2015-02-13', 125355, '', 1, 0, 1, 0),
(20, 125345, '2015-01-15', 5000, 30, 130345, '2015-02-14', 1, -1, 1, 1, 1, 5, 3, 12, '2015-02-13', '2015-02-13', 125355, '', 1, 0, 1, 0),
(21, 67412, '2015-01-15', 5000, 30, 72412, '2015-02-14', 1, -1, 2, 1, 1, 1, 3, 2, '2015-02-13', '2015-02-13', 67432, '', 2, 0, 1, 0),
(22, 67412, '2015-01-15', 5000, 30, 72412, '2015-02-14', 1, -1, 1, 1, 1, 5, 3, 12, '2015-02-13', '2015-02-13', 67432, '', 2, 0, 1, 0),
(23, 125345, '2015-01-15', 5000, 30, 130345, '2015-02-14', 1, -1, 1, 1, 1, 6, 3, 11, '2015-02-13', '2015-02-13', 125355, '', 1, 0, 1, 0),
(24, 67412, '2015-01-15', 5000, 30, 72412, '2015-02-14', 1, -1, 1, 1, 1, 6, 3, 11, '2015-02-13', '2015-02-13', 67432, '', 2, 0, 1, 0),
(25, 125355, '2015-02-13', 5000, 30, 130355, '2015-03-15', 1, 5, 2, 1, 1, 1, 3, 2, '2015-03-20', '2015-03-20', 125355, '', 1, 0, 1, 0),
(26, 67432, '2015-02-13', 5000, 30, 72432, '2015-03-15', 1, 5, 1, 1, 1, 7, 3, 10, '2015-03-20', '2015-03-20', 67432, '', 2, 0, 1, 0),
(27, 67432, '2015-02-13', 5000, 30, 72432, '2015-03-15', 1, 5, 2, 1, 1, 1, 3, 2, '2015-03-20', '2015-03-20', 67432, '', 2, 0, 1, 0),
(28, 125355, '2015-02-13', 5000, 30, 130355, '2015-03-15', 1, 5, 1, 1, 1, 5, 3, 12, '2015-03-20', '2015-03-20', 125355, '', 1, 0, 1, 0),
(29, 125355, '2015-02-13', 5000, 30, 130355, '2015-03-15', 1, 5, 1, 1, 1, 3, 3, 9, '2015-03-20', '2015-03-20', 125355, '', 1, 0, 1, 0),
(30, 67432, '2015-02-13', 5000, 30, 72432, '2015-03-15', 1, 5, 1, 1, 1, 3, 3, 9, '2015-03-20', '2015-03-20', 67432, '', 2, 0, 1, 0),
(31, 125355, '2015-02-13', 5000, 30, 130355, '2015-03-15', 1, 5, 1, 1, 1, 4, 3, 6, '2015-03-20', '2015-03-20', 125355, '', 1, 0, 1, 0),
(32, 125355, '2015-02-13', 5000, 30, 130355, '2015-03-15', 1, 5, 1, 1, 1, 7, 3, 10, '2015-03-20', '2015-03-20', 125355, '', 1, 0, 1, 0),
(33, 125355, '2015-02-13', 5000, 30, 130355, '2015-03-15', 1, 5, 1, 1, 1, 6, 3, 11, '2015-03-20', '2015-03-20', 125355, '', 1, 0, 1, 0),
(34, 67432, '2015-02-13', 5000, 30, 72432, '2015-03-15', 1, 5, 1, 1, 1, 4, 3, 6, '2015-03-20', '2015-03-20', 67432, '', 2, 0, 1, 0),
(35, 67432, '2015-02-13', 5000, 30, 72432, '2015-03-15', 1, 5, 1, 1, 1, 5, 3, 12, '2015-03-20', '2015-03-20', 67432, '', 2, 0, 1, 0),
(36, 67432, '2015-02-13', 5000, 30, 72432, '2015-03-15', 1, 5, 1, 1, 1, 6, 3, 11, '2015-03-20', '2015-03-20', 67432, '', 2, 0, 1, 0),
(37, 125355, '2015-03-20', 5000, 30, 130355, '2015-04-19', 1, -3, 1, 1, 1, 7, 3, 10, '2015-04-16', '2015-04-16', 125355, '', 1, 0, 1, 0),
(38, 125355, '2015-03-20', 5000, 30, 130355, '2015-04-19', 1, -3, 1, 1, 1, 4, 3, 6, '2015-04-16', '2015-04-16', 125355, '', 1, 0, 1, 0),
(39, 67432, '2015-03-20', 5000, 30, 72432, '2015-04-19', 1, -3, 1, 1, 1, 3, 3, 9, '2015-04-16', '2015-04-16', 67432, '', 2, 0, 1, 0),
(40, 125355, '2015-03-20', 5000, 30, 130355, '2015-04-19', 1, -3, 1, 1, 1, 3, 3, 9, '2015-04-16', '2015-04-16', 125355, '', 1, 0, 1, 0),
(41, 125355, '2015-03-20', 5000, 30, 130355, '2015-04-19', 1, -3, 2, 1, 1, 1, 3, 2, '2015-04-16', '2015-04-16', 125355, '', 1, 0, 1, 0),
(42, 125355, '2015-03-20', 5000, 30, 130355, '2015-04-19', 1, -3, 1, 1, 1, 5, 3, 12, '2015-04-16', '2015-04-16', 125355, '', 1, 0, 1, 0),
(43, 67432, '2015-03-20', 5000, 30, 72432, '2015-04-19', 1, -3, 1, 1, 1, 5, 3, 12, '2015-04-16', '2015-04-16', 67432, '', 2, 0, 1, 0),
(44, 67432, '2015-03-20', 5000, 30, 72432, '2015-04-19', 1, -3, 2, 1, 1, 1, 3, 2, '2015-04-16', '2015-04-16', 67432, '', 2, 0, 1, 0),
(45, 67432, '2015-03-20', 5000, 30, 72432, '2015-04-19', 1, -3, 1, 1, 1, 4, 3, 6, '2015-04-16', '2015-04-16', 67432, '', 2, 0, 1, 0),
(46, 67432, '2015-03-20', 5000, 30, 72432, '2015-04-19', 1, -3, 1, 1, 1, 7, 3, 10, '2015-04-16', '2015-04-16', 67432, '', 2, 0, 1, 0),
(47, 125355, '2015-03-20', 5000, 30, 130355, '2015-04-19', 1, -3, 1, 1, 1, 6, 3, 11, '2015-04-16', '2015-04-16', 125355, '', 1, 0, 1, 0),
(48, 67432, '2015-03-20', 5000, 30, 72432, '2015-04-19', 1, -3, 1, 1, 1, 6, 3, 11, '2015-04-16', '2015-04-16', 67432, '', 2, 0, 1, 0),
(49, 67432, '2015-04-16', 5000, 30, 72432, '2015-05-16', 1, 0, 2, 1, 1, 1, 3, 2, '2015-05-16', '2015-05-16', 67463, '', 2, 0, 1, 0),
(50, 67432, '2015-04-16', 5000, 30, 72432, '2015-05-16', 1, 0, 1, 1, 1, 5, 3, 12, '2015-05-16', '2015-05-16', 67463, '', 2, 0, 1, 0),
(51, 125355, '2015-04-16', 5000, 30, 130355, '2015-05-16', 1, 0, 1, 1, 1, 5, 3, 12, '2015-05-16', '2015-05-16', 125397, '', 1, 0, 1, 0),
(52, 125355, '2015-04-16', 5000, 30, 130355, '2015-05-16', 1, 0, 2, 1, 1, 1, 3, 2, '2015-05-16', '2015-05-16', 125397, '', 1, 0, 1, 0),
(53, 125355, '2015-04-16', 5000, 30, 130355, '2015-05-16', 1, 0, 1, 1, 1, 7, 3, 10, '2015-05-16', '2015-05-16', 125397, '', 1, 0, 1, 0),
(54, 125355, '2015-04-16', 5000, 30, 130355, '2015-05-16', 1, 0, 1, 1, 1, 3, 3, 9, '2015-05-16', '2015-05-16', 125397, '', 1, 0, 1, 0),
(55, 125355, '2015-04-16', 5000, 30, 130355, '2015-05-16', 1, 0, 1, 1, 1, 6, 3, 11, '2015-05-16', '2015-05-16', 125397, '', 1, 0, 1, 0),
(56, 67432, '2015-04-16', 5000, 30, 72432, '2015-05-16', 1, 0, 1, 1, 1, 3, 3, 9, '2015-05-16', '2015-05-16', 67463, '', 2, 0, 1, 0),
(57, 67432, '2015-04-16', 5000, 30, 72432, '2015-05-16', 1, 0, 1, 1, 1, 7, 3, 10, '2015-05-16', '2015-05-16', 67463, '', 2, 0, 1, 0),
(58, 125355, '2015-04-16', 5000, 30, 130355, '2015-05-16', 1, 0, 1, 1, 1, 4, 3, 6, '2015-05-16', '2015-05-16', 125397, '', 1, 0, 1, 0),
(59, 67432, '2015-04-16', 5000, 30, 72432, '2015-05-16', 1, 0, 1, 1, 1, 4, 3, 6, '2015-05-16', '2015-05-16', 67463, '', 2, 0, 1, 0),
(60, 67432, '2015-04-16', 5000, 30, 72432, '2015-05-16', 1, 0, 1, 1, 1, 6, 3, 11, '2015-05-16', '2015-05-16', 67463, '', 2, 0, 1, 0),
(61, 67463, '2015-05-16', 5000, 30, 72463, '2015-06-13', 1, -30, 1, 1, 1, 3, 2, 9, NULL, '0000-01-01', -1, '', 2, 0, 1, 0),
(62, 125397, '2015-05-16', 5000, 30, 130397, '2015-06-17', 1, -30, 1, 1, 1, 6, 2, 11, NULL, '0000-01-01', -1, '', 1, 0, 1, 0),
(63, 125397, '2015-05-16', 5000, 30, 130397, '2015-06-15', 1, -30, 1, 1, 1, 3, 2, 9, NULL, '0000-01-01', -1, '', 1, 0, 1, 0),
(64, 125397, '2015-05-16', 5000, 30, 130397, '2015-06-09', 1, -30, 1, 1, 1, 7, 2, 10, NULL, '0000-01-01', -1, '', 1, 0, 1, 0),
(65, 67463, '2015-05-16', 5000, 30, 72463, '2015-06-15', 1, -30, 2, 1, 1, 1, 2, 2, NULL, '0000-01-01', -1, '', 2, 0, 1, 0),
(66, 67463, '2015-05-16', 5000, 30, 72463, '2015-05-30', 1, -30, 1, 1, 1, 4, 2, 6, NULL, '0000-01-01', -1, '', 2, 0, 1, 0),
(67, 125397, '2015-05-16', 5000, 30, 130397, '2015-06-11', 1, -30, 1, 1, 1, 4, 2, 6, NULL, '0000-01-01', -1, '', 1, 0, 1, 0),
(68, 67463, '2015-05-16', 5000, 30, 72463, '2015-06-01', 1, -30, 1, 1, 1, 7, 2, 10, NULL, '0000-01-01', -1, '', 2, 0, 1, 0),
(69, 67463, '2015-05-16', 5000, 30, 72463, '2015-06-08', 1, NULL, 1, 1, 1, 5, 2, 12, NULL, '0000-01-01', -1, '', 2, 0, 1, 0),
(70, 125397, '2015-05-16', 5000, 30, 130397, '2015-06-09', 1, NULL, 1, 1, 1, 5, 2, 12, NULL, '0000-01-01', -1, '', 1, 0, 1, 0),
(71, 125397, '2015-05-16', 5000, 30, 130397, '2015-06-15', 1, NULL, 2, 1, 1, 1, 2, 2, NULL, '0000-01-01', -1, '', 1, 0, 1, 0),
(72, 67463, '2015-05-16', 5000, 30, 72463, '2015-06-11', 1, NULL, 1, 1, 1, 6, 2, 11, NULL, '0000-01-01', -1, '', 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_actividadesgrupo`
--

DROP TABLE IF EXISTS `sgu_actividadesgrupo`;
CREATE TABLE IF NOT EXISTS `sgu_actividadesgrupo` (
`id` int(11) NOT NULL,
  `procedimiento` varchar(200) DEFAULT NULL,
  `frecuenciaKm` int(11) NOT NULL,
  `frecuenciaMes` int(11) DEFAULT NULL,
  `duracion` int(11) NOT NULL DEFAULT '0',
  `diasParo` int(11) DEFAULT NULL,
  `idprioridad` int(11) NOT NULL,
  `idtiempod` int(11) NOT NULL,
  `idtiempof` int(11) NOT NULL,
  `idactividadMtto` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_actividadesgrupo`
--

INSERT INTO `sgu_actividadesgrupo` (`id`, `procedimiento`, `frecuenciaKm`, `frecuenciaMes`, `duracion`, `diasParo`, `idprioridad`, `idtiempod`, `idtiempof`, `idactividadMtto`, `idgrupo`) VALUES
(1, NULL, 5000, 30, 0, NULL, 2, 1, 1, 2, 1),
(3, NULL, 5000, 30, 0, NULL, 1, 1, 1, 9, 1),
(4, NULL, 5000, 30, 0, NULL, 1, 1, 1, 6, 1),
(5, NULL, 5000, 30, 0, NULL, 1, 1, 1, 12, 1),
(6, NULL, 5000, 30, 0, NULL, 1, 1, 1, 11, 1),
(7, NULL, 5000, 30, 0, NULL, 1, 1, 1, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_actividadmtto`
--

DROP TABLE IF EXISTS `sgu_actividadmtto`;
CREATE TABLE IF NOT EXISTS `sgu_actividadmtto` (
`id` int(11) NOT NULL,
  `actividad` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_actividadmtto`
--

INSERT INTO `sgu_actividadmtto` (`id`, `actividad`) VALUES
(1, 'Lavado y engrase'),
(2, 'Cambio de aceite y filtro'),
(3, 'Cambio de correa de los tiempos, polea y tesor'),
(4, 'Cambio de correa de servicios'),
(5, 'Cambio de bujías'),
(6, 'Inspección de bandas poleas y tensores'),
(9, 'Chequeo del nivel de fluidos'),
(10, 'Limpieza revisión y ajuste'),
(11, 'Inspección de luces'),
(12, 'Inspección de filtro de aire'),
(13, 'Cambio de filtro de combustible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_actividadrecurso`
--

DROP TABLE IF EXISTS `sgu_actividadrecurso`;
CREATE TABLE IF NOT EXISTS `sgu_actividadrecurso` (
`id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idactividades` int(11) NOT NULL,
  `idinsumo` int(11) DEFAULT NULL,
  `idrepuesto` int(11) DEFAULT NULL,
  `idservicio` int(11) DEFAULT NULL,
  `idunidad` int(11) NOT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `idactividadRecursoGrupo` int(11) DEFAULT NULL,
  `costoUnitario` float NOT NULL DEFAULT '0',
  `costoTotal` float NOT NULL DEFAULT '0',
  `serialGuardado` int(11) NOT NULL DEFAULT '0',
  `iva` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_actividadrecurso`
--

INSERT INTO `sgu_actividadrecurso` (`id`, `cantidad`, `idactividades`, `idinsumo`, `idrepuesto`, `idservicio`, `idunidad`, `detalle`, `idactividadRecursoGrupo`, `costoUnitario`, `costoTotal`, `serialGuardado`, `iva`) VALUES
(1, 4, 1, 1, NULL, NULL, 4, '', 1, 1800, 7200, 0, 0.12),
(2, 4, 2, 1, NULL, NULL, 4, '', 1, 1750, 7000, 0, 0.12),
(3, 1, 1, 16, NULL, NULL, 1, '', 2, 650, 650, 0, 0.12),
(4, 1, 2, 16, NULL, NULL, 1, '', 2, 600, 600, 0, 0.12),
(5, 4, 21, 1, NULL, NULL, 4, '', 1, 2100, 8400, 0, 0.12),
(6, 1, 21, 16, NULL, NULL, 1, '', 2, 400, 400, 0, 0.12),
(7, 4, 25, 1, NULL, NULL, 4, '', 1, 2500, 10000, 0, 0.12),
(8, 1, 25, 16, NULL, NULL, 1, '', 2, 500, 500, 0, 0.12),
(9, 4, 27, 1, NULL, NULL, 4, '', 1, 2500, 10000, 0, 0.12),
(10, 1, 27, 16, NULL, NULL, 1, '', 2, 500, 500, 0, 0.12),
(11, 4, 41, 1, NULL, NULL, 4, '', 1, 750, 3000, 0, 0.12),
(12, 1, 41, 16, NULL, NULL, 1, '', 2, 500, 500, 0, 0.12),
(13, 4, 44, 1, NULL, NULL, 4, '', 1, 750, 3000, 0, 0.12),
(14, 1, 44, 16, NULL, NULL, 1, '', 2, 500, 500, 0, 0.12),
(15, 4, 49, 1, NULL, NULL, 4, '', 1, 500, 2000, 0, 0.12),
(16, 1, 49, 16, NULL, NULL, 1, '', 2, 500, 500, 0, 0.12),
(17, 4, 52, 1, NULL, NULL, 4, '', 1, 1522, 6088, 0, 0.12),
(18, 1, 52, 16, NULL, NULL, 1, '', 2, 650, 650, 0, 0.12),
(19, 4, 65, 1, NULL, NULL, 4, '', 1, 0, 0, 0, NULL),
(20, 1, 65, 16, NULL, NULL, 1, '', 2, 0, 0, 0, NULL),
(21, 4, 71, 1, NULL, NULL, 4, '', 1, 0, 0, 0, NULL),
(22, 1, 71, 16, NULL, NULL, 1, '', 2, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_actividadrecursogrupo`
--

DROP TABLE IF EXISTS `sgu_actividadrecursogrupo`;
CREATE TABLE IF NOT EXISTS `sgu_actividadrecursogrupo` (
`id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idactividadesGrupo` int(11) NOT NULL,
  `idinsumo` int(11) DEFAULT NULL,
  `idrepuesto` int(11) DEFAULT NULL,
  `idservicio` int(11) DEFAULT NULL,
  `idunidad` int(11) NOT NULL,
  `detalle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_actividadrecursogrupo`
--

INSERT INTO `sgu_actividadrecursogrupo` (`id`, `cantidad`, `idactividadesGrupo`, `idinsumo`, `idrepuesto`, `idservicio`, `idunidad`, `detalle`) VALUES
(1, 4, 1, 1, NULL, NULL, 4, ''),
(2, 1, 1, 16, NULL, NULL, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_asigchasis`
--

DROP TABLE IF EXISTS `sgu_asigchasis`;
CREATE TABLE IF NOT EXISTS `sgu_asigchasis` (
`id` int(11) NOT NULL,
  `idchasis` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_asigchasis`
--

INSERT INTO `sgu_asigchasis` (`id`, `idchasis`, `idgrupo`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_bitacora`
--

DROP TABLE IF EXISTS `sgu_bitacora`;
CREATE TABLE IF NOT EXISTS `sgu_bitacora` (
`id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `evento` varchar(45) NOT NULL,
  `tabla` varchar(45) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_bitacora`
--

INSERT INTO `sgu_bitacora` (`id`, `fecha`, `evento`, `tabla`, `idusuario`) VALUES
(1, '2015-01-15 01:31:10', 'DELETE', 'sgu_actividades', 1),
(2, '2015-01-15 01:31:10', 'DELETE', 'sgu_actividadesGrupo', 1),
(3, '2015-01-15 01:44:36', 'INSERT', 'sgu_actividades', 1),
(4, '2015-01-15 01:44:36', 'UPDATE', 'sgu_actividades', 1),
(5, '2015-01-15 01:44:38', 'INSERT', 'sgu_actividades', 1),
(6, '2015-01-15 01:44:38', 'UPDATE', 'sgu_actividades', 1),
(7, '2015-01-15 01:44:39', 'INSERT', 'sgu_actividades', 1),
(8, '2015-01-15 01:44:39', 'UPDATE', 'sgu_actividades', 1),
(9, '2015-01-15 01:44:42', 'INSERT', 'sgu_actividades', 1),
(10, '2015-01-15 01:44:42', 'UPDATE', 'sgu_actividades', 1),
(11, '2015-01-15 01:44:44', 'INSERT', 'sgu_actividades', 1),
(12, '2015-01-15 01:44:44', 'UPDATE', 'sgu_actividades', 1),
(13, '2015-01-15 01:44:46', 'INSERT', 'sgu_actividades', 1),
(14, '2015-01-15 01:44:46', 'UPDATE', 'sgu_actividades', 1),
(15, '2015-01-15 01:44:48', 'INSERT', 'sgu_actividades', 1),
(16, '2015-01-15 01:44:48', 'UPDATE', 'sgu_actividades', 1),
(17, '2015-01-15 01:44:48', 'INSERT', 'sgu_actividadRecurso', 1),
(18, '2015-01-15 01:44:48', 'INSERT', 'sgu_actividadRecurso', 1),
(19, '2015-01-15 01:44:50', 'INSERT', 'sgu_actividades', 1),
(20, '2015-01-15 01:44:50', 'UPDATE', 'sgu_actividades', 1),
(21, '2015-01-15 01:44:53', 'INSERT', 'sgu_actividades', 1),
(22, '2015-01-15 01:44:53', 'UPDATE', 'sgu_actividades', 1),
(23, '2015-01-15 01:44:54', 'INSERT', 'sgu_actividades', 1),
(24, '2015-01-15 01:44:54', 'UPDATE', 'sgu_actividades', 1),
(25, '2015-02-13 02:10:02', 'INSERT', 'sgu_actividades', 1),
(26, '2015-02-13 02:10:02', 'UPDATE', 'sgu_actividades', 1),
(27, '2015-02-13 02:10:02', 'INSERT', 'sgu_actividadRecurso', 1),
(28, '2015-02-13 02:10:02', 'INSERT', 'sgu_actividadRecurso', 1),
(29, '2015-02-13 02:10:04', 'INSERT', 'sgu_actividades', 1),
(30, '2015-02-13 02:10:04', 'UPDATE', 'sgu_actividades', 1),
(31, '2015-02-13 02:10:06', 'INSERT', 'sgu_actividades', 1),
(32, '2015-02-13 02:10:06', 'UPDATE', 'sgu_actividades', 1),
(33, '2015-02-13 02:10:06', 'INSERT', 'sgu_actividadRecurso', 1),
(34, '2015-02-13 02:10:06', 'INSERT', 'sgu_actividadRecurso', 1),
(35, '2015-02-13 02:10:08', 'INSERT', 'sgu_actividades', 1),
(36, '2015-02-13 02:10:08', 'UPDATE', 'sgu_actividades', 1),
(37, '2015-02-13 02:10:10', 'INSERT', 'sgu_actividades', 1),
(38, '2015-02-13 02:10:10', 'UPDATE', 'sgu_actividades', 1),
(39, '2015-02-13 02:10:12', 'INSERT', 'sgu_actividades', 1),
(40, '2015-02-13 02:10:12', 'UPDATE', 'sgu_actividades', 1),
(41, '2015-02-13 02:10:14', 'INSERT', 'sgu_actividades', 1),
(42, '2015-02-13 02:10:14', 'UPDATE', 'sgu_actividades', 1),
(43, '2015-02-13 02:10:17', 'INSERT', 'sgu_actividades', 1),
(44, '2015-02-13 02:10:17', 'UPDATE', 'sgu_actividades', 1),
(45, '2015-02-13 02:10:19', 'INSERT', 'sgu_actividades', 1),
(46, '2015-02-13 02:10:19', 'UPDATE', 'sgu_actividades', 1),
(47, '2015-02-13 02:10:22', 'INSERT', 'sgu_actividades', 1),
(48, '2015-02-13 02:10:22', 'UPDATE', 'sgu_actividades', 1),
(49, '2015-02-13 02:10:28', 'INSERT', 'sgu_actividades', 1),
(50, '2015-02-13 02:10:28', 'UPDATE', 'sgu_actividades', 1),
(51, '2015-02-13 02:10:31', 'INSERT', 'sgu_actividades', 1),
(52, '2015-02-13 02:10:31', 'UPDATE', 'sgu_actividades', 1),
(53, '2015-03-20 02:24:22', 'INSERT', 'sgu_actividades', 1),
(54, '2015-03-20 02:24:22', 'UPDATE', 'sgu_actividades', 1),
(55, '2015-03-20 02:24:27', 'INSERT', 'sgu_actividades', 1),
(56, '2015-03-20 02:24:27', 'UPDATE', 'sgu_actividades', 1),
(57, '2015-03-20 02:24:29', 'INSERT', 'sgu_actividades', 1),
(58, '2015-03-20 02:24:29', 'UPDATE', 'sgu_actividades', 1),
(59, '2015-03-20 02:24:31', 'INSERT', 'sgu_actividades', 1),
(60, '2015-03-20 02:24:31', 'UPDATE', 'sgu_actividades', 1),
(61, '2015-03-20 02:24:33', 'INSERT', 'sgu_actividades', 1),
(62, '2015-03-20 02:24:33', 'UPDATE', 'sgu_actividades', 1),
(63, '2015-03-20 02:24:33', 'INSERT', 'sgu_actividadRecurso', 1),
(64, '2015-03-20 02:24:33', 'INSERT', 'sgu_actividadRecurso', 1),
(65, '2015-03-20 02:24:36', 'INSERT', 'sgu_actividades', 1),
(66, '2015-03-20 02:24:36', 'UPDATE', 'sgu_actividades', 1),
(67, '2015-03-20 02:24:38', 'INSERT', 'sgu_actividades', 1),
(68, '2015-03-20 02:24:38', 'UPDATE', 'sgu_actividades', 1),
(69, '2015-03-20 02:24:41', 'INSERT', 'sgu_actividades', 1),
(70, '2015-03-20 02:24:41', 'UPDATE', 'sgu_actividades', 1),
(71, '2015-03-20 02:24:41', 'INSERT', 'sgu_actividadRecurso', 1),
(72, '2015-03-20 02:24:41', 'INSERT', 'sgu_actividadRecurso', 1),
(73, '2015-03-20 02:24:43', 'INSERT', 'sgu_actividades', 1),
(74, '2015-03-20 02:24:43', 'UPDATE', 'sgu_actividades', 1),
(75, '2015-03-20 02:24:45', 'INSERT', 'sgu_actividades', 1),
(76, '2015-03-20 02:24:45', 'UPDATE', 'sgu_actividades', 1),
(77, '2015-03-20 02:24:47', 'INSERT', 'sgu_actividades', 1),
(78, '2015-03-20 02:24:47', 'UPDATE', 'sgu_actividades', 1),
(79, '2015-03-20 02:24:50', 'INSERT', 'sgu_actividades', 1),
(80, '2015-03-20 02:24:50', 'UPDATE', 'sgu_actividades', 1),
(81, '2015-04-16 02:45:52', 'INSERT', 'sgu_actividades', 1),
(82, '2015-04-16 02:45:52', 'UPDATE', 'sgu_actividades', 1),
(83, '2015-04-16 02:45:52', 'INSERT', 'sgu_actividadRecurso', 1),
(84, '2015-04-16 02:45:52', 'INSERT', 'sgu_actividadRecurso', 1),
(85, '2015-04-16 02:45:54', 'INSERT', 'sgu_actividades', 1),
(86, '2015-04-16 02:45:54', 'UPDATE', 'sgu_actividades', 1),
(87, '2015-04-16 02:45:56', 'INSERT', 'sgu_actividades', 1),
(88, '2015-04-16 02:45:56', 'UPDATE', 'sgu_actividades', 1),
(89, '2015-04-16 02:45:58', 'INSERT', 'sgu_actividades', 1),
(90, '2015-04-16 02:45:58', 'UPDATE', 'sgu_actividades', 1),
(91, '2015-04-16 02:45:58', 'INSERT', 'sgu_actividadRecurso', 1),
(92, '2015-04-16 02:45:58', 'INSERT', 'sgu_actividadRecurso', 1),
(93, '2015-04-16 02:46:01', 'INSERT', 'sgu_actividades', 1),
(94, '2015-04-16 02:46:01', 'UPDATE', 'sgu_actividades', 1),
(95, '2015-04-16 02:46:03', 'INSERT', 'sgu_actividades', 1),
(96, '2015-04-16 02:46:03', 'UPDATE', 'sgu_actividades', 1),
(97, '2015-04-16 02:46:05', 'INSERT', 'sgu_actividades', 1),
(98, '2015-04-16 02:46:05', 'UPDATE', 'sgu_actividades', 1),
(99, '2015-04-16 02:46:07', 'INSERT', 'sgu_actividades', 1),
(100, '2015-04-16 02:46:07', 'UPDATE', 'sgu_actividades', 1),
(101, '2015-04-16 02:46:09', 'INSERT', 'sgu_actividades', 1),
(102, '2015-04-16 02:46:09', 'UPDATE', 'sgu_actividades', 1),
(103, '2015-04-16 02:46:11', 'INSERT', 'sgu_actividades', 1),
(104, '2015-04-16 02:46:11', 'UPDATE', 'sgu_actividades', 1),
(105, '2015-04-16 02:46:13', 'INSERT', 'sgu_actividades', 1),
(106, '2015-04-16 02:46:13', 'UPDATE', 'sgu_actividades', 1),
(107, '2015-04-16 02:46:15', 'INSERT', 'sgu_actividades', 1),
(108, '2015-04-16 02:46:15', 'UPDATE', 'sgu_actividades', 1),
(109, '2015-05-16 03:22:11', 'INSERT', 'sgu_actividades', 1),
(110, '2015-05-16 03:22:11', 'UPDATE', 'sgu_actividades', 1),
(111, '2015-05-16 03:22:13', 'INSERT', 'sgu_actividades', 1),
(112, '2015-05-16 03:22:13', 'UPDATE', 'sgu_actividades', 1),
(113, '2015-05-16 03:22:15', 'INSERT', 'sgu_actividades', 1),
(114, '2015-05-16 03:22:15', 'UPDATE', 'sgu_actividades', 1),
(115, '2015-05-16 03:22:17', 'INSERT', 'sgu_actividades', 1),
(116, '2015-05-16 03:22:17', 'UPDATE', 'sgu_actividades', 1),
(117, '2015-05-16 03:22:19', 'INSERT', 'sgu_actividades', 1),
(118, '2015-05-16 03:22:19', 'UPDATE', 'sgu_actividades', 1),
(119, '2015-05-16 03:22:19', 'INSERT', 'sgu_actividadRecurso', 1),
(120, '2015-05-16 03:22:19', 'INSERT', 'sgu_actividadRecurso', 1),
(121, '2015-05-16 03:22:22', 'INSERT', 'sgu_actividades', 1),
(122, '2015-05-16 03:22:22', 'UPDATE', 'sgu_actividades', 1),
(123, '2015-05-16 03:22:24', 'INSERT', 'sgu_actividades', 1),
(124, '2015-05-16 03:22:24', 'UPDATE', 'sgu_actividades', 1),
(125, '2015-05-16 03:22:26', 'INSERT', 'sgu_actividades', 1),
(126, '2015-05-16 03:22:26', 'UPDATE', 'sgu_actividades', 1),
(127, '2015-05-16 03:23:58', 'INSERT', 'sgu_actividades', 1),
(128, '2015-05-16 03:23:58', 'UPDATE', 'sgu_actividades', 1),
(129, '2015-05-16 03:24:01', 'INSERT', 'sgu_actividades', 1),
(130, '2015-05-16 03:24:01', 'UPDATE', 'sgu_actividades', 1),
(131, '2015-05-16 03:24:03', 'INSERT', 'sgu_actividades', 1),
(132, '2015-05-16 03:24:03', 'UPDATE', 'sgu_actividades', 1),
(133, '2015-05-16 03:24:03', 'INSERT', 'sgu_actividadRecurso', 1),
(134, '2015-05-16 03:24:03', 'INSERT', 'sgu_actividadRecurso', 1),
(135, '2015-05-16 03:24:05', 'INSERT', 'sgu_actividades', 1),
(136, '2015-05-16 03:24:05', 'UPDATE', 'sgu_actividades', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_cantidad`
--

DROP TABLE IF EXISTS `sgu_cantidad`;
CREATE TABLE IF NOT EXISTS `sgu_cantidad` (
`id` int(11) NOT NULL,
  `codigoPiezaEnUso` varchar(100) DEFAULT NULL,
  `detallePieza` varchar(100) DEFAULT NULL,
  `fechaIncorporacion` date NOT NULL DEFAULT '0000-01-01',
  `idCaracteristicaVeh` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  `evento` int(11) NOT NULL DEFAULT '0',
  `anterior` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_cantidad`
--

INSERT INTO `sgu_cantidad` (`id`, `codigoPiezaEnUso`, `detallePieza`, `fechaIncorporacion`, `idCaracteristicaVeh`, `estado`, `evento`, `anterior`) VALUES
(1, '5TW4G21', '850A 12V', '2014-09-11', 1, 1, 1, NULL),
(2, 'C1RT123', '850A 12V', '2015-01-02', 2, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_cantidadgrupo`
--

DROP TABLE IF EXISTS `sgu_cantidadgrupo`;
CREATE TABLE IF NOT EXISTS `sgu_cantidadgrupo` (
`id` int(11) NOT NULL,
  `detallePieza` varchar(100) DEFAULT NULL,
  `idCaracteristicaVehGrupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_cantidadgrupo`
--

INSERT INTO `sgu_cantidadgrupo` (`id`, `detallePieza`, `idCaracteristicaVehGrupo`) VALUES
(1, '850A 12V', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_caracteristicaveh`
--

DROP TABLE IF EXISTS `sgu_caracteristicaveh`;
CREATE TABLE IF NOT EXISTS `sgu_caracteristicaveh` (
`id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `idvehiculo` int(11) NOT NULL,
  `idrepuesto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_caracteristicaveh`
--

INSERT INTO `sgu_caracteristicaveh` (`id`, `cantidad`, `idvehiculo`, `idrepuesto`) VALUES
(1, 1, 1, 9),
(2, 1, 2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_caracteristicavehgrupo`
--

DROP TABLE IF EXISTS `sgu_caracteristicavehgrupo`;
CREATE TABLE IF NOT EXISTS `sgu_caracteristicavehgrupo` (
`id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `idgrupo` int(11) NOT NULL,
  `idrepuesto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_caracteristicavehgrupo`
--

INSERT INTO `sgu_caracteristicavehgrupo` (`id`, `cantidad`, `idgrupo`, `idrepuesto`) VALUES
(1, 1, 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_caucho`
--

DROP TABLE IF EXISTS `sgu_caucho`;
CREATE TABLE IF NOT EXISTS `sgu_caucho` (
`id` int(11) NOT NULL,
  `idmedidaCaucho` int(11) NOT NULL,
  `idrin` int(11) NOT NULL,
  `idpiso` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_caucho`
--

INSERT INTO `sgu_caucho` (`id`, `idmedidaCaucho`, `idrin`, `idpiso`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 3, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_cauchorep`
--

DROP TABLE IF EXISTS `sgu_cauchorep`;
CREATE TABLE IF NOT EXISTS `sgu_cauchorep` (
`id` int(11) NOT NULL,
  `idchasis` int(11) NOT NULL,
  `idcaucho` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_cauchorep`
--

INSERT INTO `sgu_cauchorep` (`id`, `idchasis`, `idcaucho`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_chasis`
--

DROP TABLE IF EXISTS `sgu_chasis`;
CREATE TABLE IF NOT EXISTS `sgu_chasis` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `nroEjes` int(11) NOT NULL,
  `cantidadNormales` int(11) NOT NULL,
  `cantidadRepuesto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_chasis`
--

INSERT INTO `sgu_chasis` (`id`, `nombre`, `nroEjes`, `cantidadNormales`, `cantidadRepuesto`) VALUES
(1, 'Automovil', 2, 4, 1),
(2, 'Encava grande', 3, 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_color`
--

DROP TABLE IF EXISTS `sgu_color`;
CREATE TABLE IF NOT EXISTS `sgu_color` (
`id` int(11) NOT NULL,
  `color` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_color`
--

INSERT INTO `sgu_color` (`id`, `color`) VALUES
(1, 'Amarillo'),
(2, 'Azul'),
(3, 'Blanco'),
(4, 'Naranja'),
(5, 'Rojo'),
(6, 'Verde'),
(7, 'Negro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_combust`
--

DROP TABLE IF EXISTS `sgu_combust`;
CREATE TABLE IF NOT EXISTS `sgu_combust` (
`id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `costoLitro` float NOT NULL,
  `idtipoCombustible` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_combust`
--

INSERT INTO `sgu_combust` (`id`, `tipo`, `costoLitro`, `idtipoCombustible`) VALUES
(1, 'Gasolina 91', 0.07, 1),
(2, 'Gasolina 95', 0.095, 1),
(3, 'Diesel super', 0.1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_departamento`
--

DROP TABLE IF EXISTS `sgu_departamento`;
CREATE TABLE IF NOT EXISTS `sgu_departamento` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_detalleeje`
--

DROP TABLE IF EXISTS `sgu_detalleeje`;
CREATE TABLE IF NOT EXISTS `sgu_detalleeje` (
`id` int(11) NOT NULL,
  `nroRuedas` int(11) NOT NULL,
  `idchasis` int(11) NOT NULL,
  `idposicionEje` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_detalleeje`
--

INSERT INTO `sgu_detalleeje` (`id`, `nroRuedas`, `idchasis`, `idposicionEje`, `nombre`) VALUES
(1, 2, 1, 1, 1),
(2, 2, 1, 2, 2),
(3, 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_detalleeventoca`
--

DROP TABLE IF EXISTS `sgu_detalleeventoca`;
CREATE TABLE IF NOT EXISTS `sgu_detalleeventoca` (
`id` int(11) NOT NULL,
  `fechaFalla` date NOT NULL,
  `fechaRealizada` date NOT NULL DEFAULT '0000-01-01',
  `comentario` varchar(100) DEFAULT NULL,
  `idhistoricoCaucho` int(11) NOT NULL,
  `idfallaCaucho` int(11) DEFAULT NULL,
  `idestatus` int(11) NOT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `idaccionCaucho` int(11) NOT NULL,
  `idNuevoCaucho` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_detalleeventoca`
--

INSERT INTO `sgu_detalleeventoca` (`id`, `fechaFalla`, `fechaRealizada`, `comentario`, `idhistoricoCaucho`, `idfallaCaucho`, `idestatus`, `idempleado`, `idaccionCaucho`, `idNuevoCaucho`) VALUES
(1, '2015-03-20', '2015-03-20', NULL, 1, NULL, 3, NULL, 1, 7),
(2, '2015-03-20', '2015-03-20', NULL, 2, NULL, 3, NULL, 1, 6),
(3, '2015-04-16', '2015-04-16', '', 4, 1, 3, 4, 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_detalleorden`
--

DROP TABLE IF EXISTS `sgu_detalleorden`;
CREATE TABLE IF NOT EXISTS `sgu_detalleorden` (
`id` int(11) NOT NULL,
  `idordenMtto` int(11) NOT NULL,
  `idactividades` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_detalleorden`
--

INSERT INTO `sgu_detalleorden` (`id`, `idordenMtto`, `idactividades`) VALUES
(1, 1, 8),
(2, 1, 13),
(3, 1, 7),
(4, 1, 6),
(5, 1, 5),
(6, 1, 9),
(7, 1, 2),
(8, 1, 10),
(9, 1, 11),
(10, 1, 12),
(11, 2, 1),
(12, 2, 14),
(13, 2, 23),
(14, 2, 22),
(15, 2, 21),
(16, 2, 20),
(17, 2, 19),
(18, 2, 18),
(19, 2, 17),
(20, 2, 16),
(21, 2, 15),
(22, 2, 24),
(23, 4, 25),
(24, 4, 35),
(25, 4, 34),
(26, 4, 33),
(27, 4, 32),
(28, 4, 31),
(29, 4, 30),
(30, 4, 29),
(31, 4, 28),
(32, 4, 27),
(33, 4, 26),
(34, 4, 36),
(35, 8, 37),
(36, 8, 47),
(37, 8, 46),
(38, 8, 45),
(39, 8, 44),
(40, 8, 43),
(41, 8, 42),
(42, 8, 41),
(43, 8, 40),
(44, 8, 39),
(45, 8, 38),
(46, 8, 48),
(47, 12, 49),
(48, 12, 59),
(49, 12, 58),
(50, 12, 57),
(51, 12, 56),
(52, 12, 55),
(53, 12, 54),
(54, 12, 53),
(55, 13, 50),
(56, 13, 51),
(57, 13, 52),
(58, 13, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_detalleordenco`
--

DROP TABLE IF EXISTS `sgu_detalleordenco`;
CREATE TABLE IF NOT EXISTS `sgu_detalleordenco` (
`id` int(11) NOT NULL,
  `idordenMtto` int(11) NOT NULL,
  `idreporteFalla` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_detalleordenco`
--

INSERT INTO `sgu_detalleordenco` (`id`, `idordenMtto`, `idreporteFalla`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 5, 5),
(4, 6, 6),
(5, 9, 7),
(6, 9, 8),
(7, 11, 10),
(8, 11, 9),
(9, 14, 12),
(10, 15, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_detallerueda`
--

DROP TABLE IF EXISTS `sgu_detallerueda`;
CREATE TABLE IF NOT EXISTS `sgu_detallerueda` (
`id` int(11) NOT NULL,
  `idposicionRueda` int(11) NOT NULL,
  `iddetalleEje` int(11) NOT NULL,
  `idcaucho` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_detallerueda`
--

INSERT INTO `sgu_detallerueda` (`id`, `idposicionRueda`, `iddetalleEje`, `idcaucho`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 1, 2, 2),
(4, 2, 2, 2),
(5, 1, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_detordneumatico`
--

DROP TABLE IF EXISTS `sgu_detordneumatico`;
CREATE TABLE IF NOT EXISTS `sgu_detordneumatico` (
`id` int(11) NOT NULL,
  `idordenMtto` int(11) NOT NULL,
  `iddetalleEventoCa` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_detordneumatico`
--

INSERT INTO `sgu_detordneumatico` (`id`, `idordenMtto`, `iddetalleEventoCa`) VALUES
(1, 7, 1),
(2, 7, 2),
(3, 10, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_detreccaucho`
--

DROP TABLE IF EXISTS `sgu_detreccaucho`;
CREATE TABLE IF NOT EXISTS `sgu_detreccaucho` (
`id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costoUnitario` float NOT NULL DEFAULT '0',
  `costoTotal` float NOT NULL DEFAULT '0',
  `idrecursoCaucho` int(11) NOT NULL,
  `iddetalleEventoCa` int(11) NOT NULL,
  `idunidad` int(11) NOT NULL,
  `iva` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_detreccaucho`
--

INSERT INTO `sgu_detreccaucho` (`id`, `cantidad`, `costoUnitario`, `costoTotal`, `idrecursoCaucho`, `iddetalleEventoCa`, `idunidad`, `iva`) VALUES
(1, 1, 2500, 2500, 1, 3, 1, 0.12),
(2, 1, 150, 150, 4, 3, 8, 0.12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_empleado`
--

DROP TABLE IF EXISTS `sgu_empleado`;
CREATE TABLE IF NOT EXISTS `sgu_empleado` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `cedula` int(11) NOT NULL,
  `idtipoEmpleado` int(11) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_empleado`
--

INSERT INTO `sgu_empleado` (`id`, `nombre`, `apellido`, `cedula`, `idtipoEmpleado`, `activo`) VALUES
(1, 'Juan', 'Pérez', 8745856, 1, 1),
(2, 'José', 'Gonzáles', 7845856, 1, 1),
(3, 'Luis ', 'Sánchez', 9855474, 1, 1),
(4, 'Alejandro', 'Carrero', 1452145, 1, 1),
(5, 'Aberto', 'Cárdenas', 4785745, 2, 1),
(6, 'Carlos', 'Escalante', 12745963, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_estacionservicio`
--

DROP TABLE IF EXISTS `sgu_estacionservicio`;
CREATE TABLE IF NOT EXISTS `sgu_estacionservicio` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_estacionservicio`
--

INSERT INTO `sgu_estacionservicio` (`id`, `nombre`, `direccion`) VALUES
(1, 'E/S paramillo', 'Zona industrial, paramillo'),
(2, 'E/S las Vegas', 'Las vegas de Táriba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_estado`
--

DROP TABLE IF EXISTS `sgu_estado`;
CREATE TABLE IF NOT EXISTS `sgu_estado` (
`id` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_estado`
--

INSERT INTO `sgu_estado` (`id`, `estado`, `descripcion`) VALUES
(1, 'ACTIVO', 'El vehiculo se encuentra operando'),
(2, 'AVERIADO', 'El vehiculo se le registró una avería'),
(3, 'EN MTTO', 'El vehiculo tiene una orden de mtto abierta'),
(4, 'DESINCORPORADO', 'El vehiculo ya no existe en la flota');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_estados`
--

DROP TABLE IF EXISTS `sgu_estados`;
CREATE TABLE IF NOT EXISTS `sgu_estados` (
`id` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_estados`
--

INSERT INTO `sgu_estados` (`id`, `estado`) VALUES
(4, 'Distrito capital'),
(2, 'Mérida'),
(1, 'Táchira'),
(3, 'Zulia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_estatus`
--

DROP TABLE IF EXISTS `sgu_estatus`;
CREATE TABLE IF NOT EXISTS `sgu_estatus` (
`id` int(11) NOT NULL,
  `estatus` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_estatus`
--

INSERT INTO `sgu_estatus` (`id`, `estatus`) VALUES
(1, 'Por definir'),
(2, 'No ejecutado'),
(3, 'Ejecutado'),
(4, 'En progreso'),
(5, 'Abierta'),
(6, 'Lista para cerrar'),
(7, 'Cerrada'),
(8, 'Por atender');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_estatuscaucho`
--

DROP TABLE IF EXISTS `sgu_estatuscaucho`;
CREATE TABLE IF NOT EXISTS `sgu_estatuscaucho` (
`id` int(11) NOT NULL,
  `estatusCaucho` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_estatuscaucho`
--

INSERT INTO `sgu_estatuscaucho` (`id`, `estatusCaucho`) VALUES
(1, 'Montado'),
(2, 'Rotado'),
(3, 'Desmontado'),
(4, 'Repuesto'),
(5, 'Por definir'),
(6, 'Por definir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_factura`
--

DROP TABLE IF EXISTS `sgu_factura`;
CREATE TABLE IF NOT EXISTS `sgu_factura` (
`id` int(11) NOT NULL,
  `fechaFactura` date NOT NULL,
  `codigo` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idordenMtto` int(11) NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  `iva` float NOT NULL DEFAULT '0',
  `totalFactura` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_factura`
--

INSERT INTO `sgu_factura` (`id`, `fechaFactura`, `codigo`, `idproveedor`, `idordenMtto`, `total`, `iva`, `totalFactura`) VALUES
(1, '2015-01-15', 1425412, 1, 1, 7600, 912, 8512),
(2, '2015-02-13', 123, 1, 2, 16650, 1998, 18648),
(3, '2015-01-06', 744578, 1, 3, 40000, 4800, 44800),
(4, '2015-03-20', 253252, 1, 4, 21000, 2520, 23520),
(5, '2015-03-04', 77747, 1, 5, 4500, 540, 5040),
(6, '2015-03-10', 66006, 1, 6, 5000, 600, 5600),
(7, '2015-03-20', 1102021, 1, 7, 19000, 2280, 21280),
(8, '2015-04-16', 2201010, 1, 8, 7000, 840, 7840),
(9, '2015-04-16', 123, 1, 9, 17000, 2040, 19040),
(10, '2015-04-16', 2520, 1, 10, 2650, 318, 2968),
(11, '2015-02-25', 1237474, 1, 11, 11500, 1380, 12880),
(12, '2015-05-16', 85585, 1, 12, 2500, 300, 2800),
(13, '2015-05-16', 32353, 1, 13, 6738, 808.56, 7546.56),
(14, '2015-05-16', 96568, 1, 14, 2000, 240, 2240),
(15, '2015-05-20', 89858, 1, 15, 5000, 600, 5600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_falla`
--

DROP TABLE IF EXISTS `sgu_falla`;
CREATE TABLE IF NOT EXISTS `sgu_falla` (
`id` int(11) NOT NULL,
  `falla` varchar(120) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_falla`
--

INSERT INTO `sgu_falla` (`id`, `falla`, `tipo`) VALUES
(1, 'El vehiculo se apagó de repente y no quizo encender de nuevo', 0),
(2, 'Latonería y pintura', 1),
(3, 'Reconstrucción completa del motor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_fallacaucho`
--

DROP TABLE IF EXISTS `sgu_fallacaucho`;
CREATE TABLE IF NOT EXISTS `sgu_fallacaucho` (
`id` int(11) NOT NULL,
  `falla` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_fallacaucho`
--

INSERT INTO `sgu_fallacaucho` (`id`, `falla`) VALUES
(1, 'Perdió el aire completamente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_foto`
--

DROP TABLE IF EXISTS `sgu_foto`;
CREATE TABLE IF NOT EXISTS `sgu_foto` (
`id` int(11) NOT NULL,
  `imagen` mediumtext NOT NULL,
  `idvehiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_grupo`
--

DROP TABLE IF EXISTS `sgu_grupo`;
CREATE TABLE IF NOT EXISTS `sgu_grupo` (
`id` int(11) NOT NULL,
  `grupo` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `idtipo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_grupo`
--

INSERT INTO `sgu_grupo` (`id`, `grupo`, `descripcion`, `idtipo`) VALUES
(1, 'Encava ENT-610', 'Rutas grandes', 1),
(2, 'Iveco 59-12', 'Rutas pequeñas', 1),
(3, 'Corolla 2012 A/AC', 'Autos corolla', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_historicocaucho`
--

DROP TABLE IF EXISTS `sgu_historicocaucho`;
CREATE TABLE IF NOT EXISTS `sgu_historicocaucho` (
`id` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-01-01',
  `serial` varchar(45) NOT NULL DEFAULT '0',
  `idestatusCaucho` int(11) NOT NULL,
  `idcaucho` int(11) NOT NULL,
  `idmarcaCaucho` int(11) DEFAULT NULL,
  `idvehiculo` int(11) NOT NULL,
  `iddetalleRueda` int(11) DEFAULT NULL,
  `idasigChasis` int(11) NOT NULL,
  `costounitario` float NOT NULL DEFAULT '0',
  `iva` float DEFAULT NULL,
  `inicial` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_historicocaucho`
--

INSERT INTO `sgu_historicocaucho` (`id`, `fecha`, `serial`, `idestatusCaucho`, `idcaucho`, `idmarcaCaucho`, `idvehiculo`, `iddetalleRueda`, `idasigChasis`, `costounitario`, `iva`, `inicial`) VALUES
(1, '2014-02-13', 'AW11', 3, 1, 1, 4, 1, 1, 0, NULL, 1),
(2, '2014-02-13', 'BC14', 3, 1, 1, 4, 2, 1, 0, NULL, 1),
(3, '2014-09-15', 'LA43', 1, 2, 1, 4, 3, 1, 0, NULL, 1),
(4, '2014-09-15', 'CV31', 1, 2, 1, 4, 4, 1, 0, NULL, 1),
(5, '2015-01-15', '43BG', 4, 1, 1, 4, NULL, 1, 0, NULL, 1),
(6, '2015-03-20', 'LK22', 1, 1, 1, 4, 2, 1, 9500, 0.12, 0),
(7, '2015-03-20', 'LO54', 1, 1, 1, 4, 1, 1, 9500, 0.12, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_historicocombustible`
--

DROP TABLE IF EXISTS `sgu_historicocombustible`;
CREATE TABLE IF NOT EXISTS `sgu_historicocombustible` (
`id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `litros` float NOT NULL,
  `costoTotal` float NOT NULL,
  `idestacionServicio` int(11) NOT NULL,
  `idconductor` int(11) NOT NULL,
  `idvehiculo` int(11) NOT NULL,
  `historico` int(11) NOT NULL,
  `idcombust` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_historicocombustible`
--

INSERT INTO `sgu_historicocombustible` (`id`, `fecha`, `litros`, `costoTotal`, `idestacionServicio`, `idconductor`, `idvehiculo`, `historico`, `idcombust`) VALUES
(1, '2015-01-01 11:46:00', 45, 4.5, 1, 1, 1, 1, 3),
(2, '2015-01-01 11:46:00', 48, 4.8, 1, 2, 2, 1, 3),
(3, '2015-01-01 11:46:00', 35, 3.5, 1, 3, 3, 1, 3),
(4, '2015-01-01 11:46:00', 32, 3.04, 1, 4, 4, 1, 2),
(5, '2015-01-05 14:46:00', 45, 4.5, 1, 1, 1, 1, 3),
(6, '2015-01-06 14:46:00', 50, 5, 1, 2, 2, 1, 3),
(7, '2015-01-08 14:46:00', 46, 4.6, 1, 3, 3, 1, 3),
(8, '2015-01-10 14:46:00', 35, 3.325, 1, 4, 4, 1, 2),
(9, '2015-01-12 01:49:00', 25, 2.5, 1, 1, 1, 1, 3),
(10, '2015-01-12 01:49:00', 29, 2.9, 1, 2, 2, 1, 3),
(11, '2015-01-12 01:49:00', 36, 3.6, 1, 3, 3, 1, 3),
(12, '2015-01-12 01:49:00', 17, 1.615, 2, 4, 4, 1, 2),
(13, '2015-02-11 02:19:00', 50, 5, 1, 1, 1, 1, 3),
(14, '2015-02-11 02:19:00', 50, 5, 1, 2, 2, 1, 3),
(15, '2015-02-12 02:19:00', 50, 5, 1, 3, 3, 1, 3),
(16, '2015-02-10 02:19:00', 50, 4.75, 1, 4, 4, 1, 2),
(17, '2015-03-16 02:33:00', 49, 4.9, 1, 1, 1, 1, 3),
(18, '2015-03-17 02:33:00', 49, 4.9, 1, 2, 2, 1, 3),
(19, '2015-03-18 02:33:00', 25, 2.5, 1, 3, 3, 1, 3),
(20, '2015-03-19 02:33:00', 33, 3.135, 1, 4, 4, 1, 2),
(21, '2015-05-09 03:33:00', 50, 5, 1, 1, 1, 0, 3),
(22, '2015-05-09 03:33:00', 45, 4.5, 1, 2, 2, 0, 3),
(23, '2015-05-09 03:33:00', 25, 2.5, 1, 3, 3, 0, 3),
(24, '2015-05-09 03:33:00', 35, 3.325, 1, 4, 4, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_historicoedos`
--

DROP TABLE IF EXISTS `sgu_historicoedos`;
CREATE TABLE IF NOT EXISTS `sgu_historicoedos` (
`id` int(11) NOT NULL,
  `idestado` int(11) NOT NULL,
  `idvehiculo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `motivo` varchar(200) DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_historicoedos`
--

INSERT INTO `sgu_historicoedos` (`id`, `idestado`, `idvehiculo`, `fecha`, `motivo`) VALUES
(1, 1, 1, '2014-01-01', 'Registrado en el sistema'),
(2, 1, 2, '2014-01-01', 'Registrado en el sistema'),
(3, 1, 3, '2014-01-01', 'Registrado en el sistema'),
(4, 1, 4, '2014-01-01', 'Registrado en el sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_historicoempleados`
--

DROP TABLE IF EXISTS `sgu_historicoempleados`;
CREATE TABLE IF NOT EXISTS `sgu_historicoempleados` (
`id` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT '0000-01-01',
  `idempleado` int(11) NOT NULL,
  `idvehiculo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_historicoempleados`
--

INSERT INTO `sgu_historicoempleados` (`id`, `fechaInicio`, `fechaFin`, `idempleado`, `idvehiculo`) VALUES
(1, '2014-12-19', '0000-01-01', 1, 1),
(2, '2014-12-19', '0000-01-01', 2, 2),
(3, '2014-12-19', '0000-01-01', 3, 3),
(4, '2014-12-19', '0000-01-01', 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_historicoviajes`
--

DROP TABLE IF EXISTS `sgu_historicoviajes`;
CREATE TABLE IF NOT EXISTS `sgu_historicoviajes` (
`id` int(11) NOT NULL,
  `fechaSalida` date NOT NULL,
  `horaSalida` time NOT NULL,
  `fechaLlegada` date NOT NULL,
  `horaLlegada` time NOT NULL,
  `nroPersonas` int(11) NOT NULL,
  `ultimaRutina` int(11) NOT NULL DEFAULT '0',
  `idviaje` int(11) NOT NULL,
  `idvehiculo` int(11) NOT NULL,
  `idconductor` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_historicoviajes`
--

INSERT INTO `sgu_historicoviajes` (`id`, `fechaSalida`, `horaSalida`, `fechaLlegada`, `horaLlegada`, `nroPersonas`, `ultimaRutina`, `idviaje`, `idvehiculo`, `idconductor`) VALUES
(1, '2015-01-12', '09:00:00', '2015-01-12', '11:00:00', 32, 0, 1, 1, 1),
(2, '2015-01-13', '06:00:00', '2015-01-13', '08:00:00', 32, 0, 3, 2, 1),
(3, '2015-01-14', '07:00:00', '2015-01-14', '08:00:00', 25, 0, 1, 3, 3),
(4, '2015-02-13', '07:00:00', '2015-02-13', '08:00:00', 25, 0, 1, 3, 3),
(5, '2015-04-09', '03:00:00', '2015-04-09', '07:00:00', 32, 0, 2, 1, 1),
(6, '2015-04-11', '10:00:00', '2015-04-11', '12:00:00', 32, 0, 2, 1, 1),
(7, '2015-04-16', '06:00:00', '2015-04-16', '09:00:00', 32, 0, 3, 2, 2),
(8, '2015-04-16', '06:00:00', '2015-04-16', '10:00:00', 25, 0, 3, 3, 3),
(9, '2015-03-09', '08:00:00', '2015-03-09', '10:00:00', 32, 0, 4, 1, 1),
(10, '2015-03-18', '08:00:00', '2015-03-18', '10:00:00', 32, 0, 2, 2, 2),
(11, '2015-03-18', '09:00:00', '2015-03-18', '12:00:00', 25, 0, 4, 3, 3),
(12, '2015-03-17', '06:00:00', '2015-03-17', '09:00:00', 5, 0, 3, 4, 4),
(13, '2015-05-16', '06:00:00', '2015-05-16', '09:00:00', 32, 0, 3, 2, 2),
(14, '2015-05-16', '06:00:00', '2015-05-16', '10:00:00', 25, 0, 3, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_infgrupo`
--

DROP TABLE IF EXISTS `sgu_infgrupo`;
CREATE TABLE IF NOT EXISTS `sgu_infgrupo` (
`id` int(11) NOT NULL,
  `informacion` varchar(60) NOT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_informacion`
--

DROP TABLE IF EXISTS `sgu_informacion`;
CREATE TABLE IF NOT EXISTS `sgu_informacion` (
`id` int(11) NOT NULL,
  `informacion` varchar(60) NOT NULL,
  `descripcion` varchar(80) DEFAULT NULL,
  `idvehiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_insumo`
--

DROP TABLE IF EXISTS `sgu_insumo`;
CREATE TABLE IF NOT EXISTS `sgu_insumo` (
`id` int(11) NOT NULL,
  `insumo` varchar(100) NOT NULL,
  `tipoInsumo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_insumo`
--

INSERT INTO `sgu_insumo` (`id`, `insumo`, `tipoInsumo`) VALUES
(1, 'Aceite SAE 20W50', 1),
(2, 'Aceite SAE 15W40', 1),
(3, 'Aceite hidraulico', 1),
(4, 'Aceite multigrado', 1),
(5, 'Grasa de alta temperatura', 1),
(6, 'Aceite para transmisión manual', 1),
(7, 'Motorkote', 1),
(8, 'Liga de frenos DOT3', 2),
(9, 'liga de frenos DOT4', 2),
(10, 'Refrigerante', 2),
(11, 'Anticongelante', 2),
(12, 'Liquido limpiarabrisas', 3),
(13, 'Champu para carros', 3),
(14, 'Cepillos limpiaparabrisas', 3),
(15, 'Filtro de aire', 5),
(16, 'Filtro de aceite', 5),
(17, 'Filtro de gasolina', 5),
(18, 'Filtro de diesel', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_kilometraje`
--

DROP TABLE IF EXISTS `sgu_kilometraje`;
CREATE TABLE IF NOT EXISTS `sgu_kilometraje` (
`id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `lectura` int(11) NOT NULL,
  `idvehiculo` int(11) NOT NULL,
  `idhistoricoViajes` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_kilometraje`
--

INSERT INTO `sgu_kilometraje` (`id`, `fecha`, `lectura`, `idvehiculo`, `idhistoricoViajes`) VALUES
(1, '2014-11-07', 125345, 1, NULL),
(2, '2014-11-07', 67412, 2, NULL),
(3, '2014-11-07', 147831, 3, NULL),
(4, '2014-11-07', 257896, 4, NULL),
(5, '2015-01-15', 125355, 1, NULL),
(6, '2015-01-15', 67432, 2, NULL),
(7, '2015-01-15', 147841, 3, NULL),
(8, '2015-04-16', 125366, 1, NULL),
(9, '2015-04-16', 125377, 1, NULL),
(10, '2015-04-16', 67452, 2, NULL),
(11, '2015-04-16', 147861, 3, NULL),
(12, '2015-03-18', 125397, 1, NULL),
(13, '2015-03-18', 67463, 2, NULL),
(14, '2015-03-18', 147881, 3, NULL),
(15, '2015-03-18', 257916, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_lugar`
--

DROP TABLE IF EXISTS `sgu_lugar`;
CREATE TABLE IF NOT EXISTS `sgu_lugar` (
`id` int(11) NOT NULL,
  `lugar` varchar(45) NOT NULL,
  `idestados` int(11) NOT NULL,
  `primario` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_lugar`
--

INSERT INTO `sgu_lugar` (`id`, `lugar`, `idestados`, `primario`) VALUES
(1, 'UNET', 1, 1),
(2, 'Centro', 1, 0),
(3, 'Táriba', 1, 0),
(4, 'Cordero', 1, 0),
(5, 'Palmira', 1, 0),
(6, 'Santa Ana', 1, 0),
(7, 'Sto. Domingo', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_marca`
--

DROP TABLE IF EXISTS `sgu_marca`;
CREATE TABLE IF NOT EXISTS `sgu_marca` (
`id` int(11) NOT NULL,
  `marca` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_marca`
--

INSERT INTO `sgu_marca` (`id`, `marca`) VALUES
(1, 'Chevrolet'),
(2, 'Toyota'),
(3, 'Encava'),
(4, 'Iveco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_marcacaucho`
--

DROP TABLE IF EXISTS `sgu_marcacaucho`;
CREATE TABLE IF NOT EXISTS `sgu_marcacaucho` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_marcacaucho`
--

INSERT INTO `sgu_marcacaucho` (`id`, `nombre`) VALUES
(1, 'Firestone'),
(2, 'Goodyear'),
(3, 'Dunlop');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_medidacaucho`
--

DROP TABLE IF EXISTS `sgu_medidacaucho`;
CREATE TABLE IF NOT EXISTS `sgu_medidacaucho` (
`id` int(11) NOT NULL,
  `medida` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_medidacaucho`
--

INSERT INTO `sgu_medidacaucho` (`id`, `medida`) VALUES
(1, '165/60'),
(2, '175/60'),
(3, '195/80');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_modelo`
--

DROP TABLE IF EXISTS `sgu_modelo`;
CREATE TABLE IF NOT EXISTS `sgu_modelo` (
`id` int(11) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `idmarca` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_modelo`
--

INSERT INTO `sgu_modelo` (`id`, `modelo`, `idmarca`) VALUES
(1, 'Aveo', 1),
(2, '59-12', 4),
(3, 'Corolla', 2),
(4, 'ENT-610', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_ordenmtto`
--

DROP TABLE IF EXISTS `sgu_ordenmtto`;
CREATE TABLE IF NOT EXISTS `sgu_ordenmtto` (
`id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `taller` int(11) NOT NULL,
  `cOperativo` int(11) NOT NULL,
  `cTaller` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_ordenmtto`
--

INSERT INTO `sgu_ordenmtto` (`id`, `fecha`, `tipo`, `idestatus`, `taller`, `cOperativo`, `cTaller`) VALUES
(1, '2015-01-15 01:38:00', 0, 7, 1, 5, 6),
(2, '2015-02-13 02:08:00', 0, 7, 1, 5, 6),
(3, '2015-01-06 02:14:00', 1, 7, 1, 5, 6),
(4, '2015-03-20 02:23:00', 0, 7, 1, 5, 6),
(5, '2015-03-04 02:29:00', 1, 7, 1, 5, 6),
(6, '2015-03-09 02:31:00', 1, 7, 1, 5, 6),
(7, '2015-03-20 02:37:00', 2, 7, 1, 5, 6),
(8, '2015-04-16 02:43:00', 0, 7, 1, 5, 6),
(9, '2015-04-16 02:49:00', 1, 7, 1, 5, 6),
(10, '2015-04-16 02:57:00', 2, 7, 1, 5, 6),
(11, '2015-02-25 03:14:00', 1, 7, 1, 5, 6),
(12, '2015-05-16 03:20:00', 0, 7, 1, 5, 6),
(13, '2015-05-16 03:23:00', 0, 7, 1, 5, 6),
(14, '2015-05-16 03:26:00', 1, 7, 1, 5, 6),
(15, '2015-05-20 03:37:00', 1, 7, 1, 5, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_parametro`
--

DROP TABLE IF EXISTS `sgu_parametro`;
CREATE TABLE IF NOT EXISTS `sgu_parametro` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `valor` varchar(45) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_parametro`
--

INSERT INTO `sgu_parametro` (`id`, `nombre`, `valor`, `descripcion`, `fecha`) VALUES
(1, 'IVA', '12', 'Impuesto valor agregado', '2014-12-10'),
(2, 'alertaReposicion', '5', 'Días que un vehiculo no ha tenido reposición de combustible', '2014-12-30'),
(3, 'alertaCambioCauchos', '1', 'Tiempo que un neumático no se ha cambiado', '2015-01-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_piso`
--

DROP TABLE IF EXISTS `sgu_piso`;
CREATE TABLE IF NOT EXISTS `sgu_piso` (
`id` int(11) NOT NULL,
  `piso` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_piso`
--

INSERT INTO `sgu_piso` (`id`, `piso`) VALUES
(1, 'convencional'),
(2, 'radial'),
(3, 'tracción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_posicioneje`
--

DROP TABLE IF EXISTS `sgu_posicioneje`;
CREATE TABLE IF NOT EXISTS `sgu_posicioneje` (
`id` int(11) NOT NULL,
  `posicionEje` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_posicioneje`
--

INSERT INTO `sgu_posicioneje` (`id`, `posicionEje`) VALUES
(1, 'Delantero'),
(2, 'Trasero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_posicionrueda`
--

DROP TABLE IF EXISTS `sgu_posicionrueda`;
CREATE TABLE IF NOT EXISTS `sgu_posicionrueda` (
`id` int(11) NOT NULL,
  `posicionRueda` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_posicionrueda`
--

INSERT INTO `sgu_posicionrueda` (`id`, `posicionRueda`) VALUES
(1, 'Derecho'),
(2, 'Izquierdo'),
(3, 'Delantero'),
(4, 'Trasero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_prioridad`
--

DROP TABLE IF EXISTS `sgu_prioridad`;
CREATE TABLE IF NOT EXISTS `sgu_prioridad` (
`id` int(11) NOT NULL,
  `prioridad` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_prioridad`
--

INSERT INTO `sgu_prioridad` (`id`, `prioridad`) VALUES
(1, 'Baja'),
(2, 'Media'),
(3, 'Alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_propiedad`
--

DROP TABLE IF EXISTS `sgu_propiedad`;
CREATE TABLE IF NOT EXISTS `sgu_propiedad` (
`id` int(11) NOT NULL,
  `propiedad` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_propiedad`
--

INSERT INTO `sgu_propiedad` (`id`, `propiedad`) VALUES
(1, 'UNET'),
(2, 'Decanato de investigación'),
(3, 'SIRCA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_proveedor`
--

DROP TABLE IF EXISTS `sgu_proveedor`;
CREATE TABLE IF NOT EXISTS `sgu_proveedor` (
`id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `RIF` varchar(15) NOT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_proveedor`
--

INSERT INTO `sgu_proveedor` (`id`, `nombre`, `RIF`, `direccion`, `telefono`) VALUES
(1, 'Rectificadora la concordia', 'J-1932324-1', 'La concordia', '02763478745'),
(2, 'Autolavado Las vegas', 'J-1232345-5', 'Las vegas Táriba', '02763945257');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_recursocaucho`
--

DROP TABLE IF EXISTS `sgu_recursocaucho`;
CREATE TABLE IF NOT EXISTS `sgu_recursocaucho` (
`id` int(11) NOT NULL,
  `recurso` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_recursocaucho`
--

INSERT INTO `sgu_recursocaucho` (`id`, `recurso`, `descripcion`) VALUES
(1, 'Zapata #1', NULL),
(2, 'Zapata #2', NULL),
(3, 'Zapata #3', NULL),
(4, 'Servicio balanceo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_recursofalla`
--

DROP TABLE IF EXISTS `sgu_recursofalla`;
CREATE TABLE IF NOT EXISTS `sgu_recursofalla` (
`id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costoUnitario` float NOT NULL DEFAULT '0',
  `costoTotal` float NOT NULL DEFAULT '0',
  `idinsumo` int(11) DEFAULT NULL,
  `idservicio` int(11) DEFAULT NULL,
  `idrepuesto` int(11) DEFAULT NULL,
  `idreporteFalla` int(11) NOT NULL,
  `idunidad` int(11) NOT NULL,
  `garantia` int(11) DEFAULT NULL,
  `idtiempo` int(11) DEFAULT NULL,
  `iva` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_recursofalla`
--

INSERT INTO `sgu_recursofalla` (`id`, `cantidad`, `costoUnitario`, `costoTotal`, `idinsumo`, `idservicio`, `idrepuesto`, `idreporteFalla`, `idunidad`, `garantia`, `idtiempo`, `iva`) VALUES
(1, 1, 15000, 15000, NULL, 2, NULL, 1, 8, NULL, NULL, 0.12),
(2, 1, 25000, 25000, NULL, 3, NULL, 2, 8, NULL, NULL, 0.12),
(3, 1, 4500, 4500, NULL, NULL, 18, 5, 1, NULL, NULL, 0.12),
(4, 1, 5000, 5000, NULL, NULL, 10, 6, 1, NULL, NULL, 0.12),
(5, 4, 500, 2000, NULL, NULL, 11, 8, 1, NULL, NULL, 0.12),
(6, 1, 15000, 15000, NULL, NULL, 9, 7, 1, NULL, 1, 0.12),
(7, 1, 3500, 3500, NULL, NULL, 12, 9, 2, NULL, NULL, 0.12),
(8, 4, 2000, 8000, NULL, NULL, 14, 10, 1, NULL, NULL, 0.12),
(9, 4, 500, 2000, NULL, NULL, 11, 12, 1, NULL, NULL, 0.12),
(10, 1, 5000, 5000, NULL, 4, NULL, 14, 8, NULL, NULL, 0.12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_reportefalla`
--

DROP TABLE IF EXISTS `sgu_reportefalla`;
CREATE TABLE IF NOT EXISTS `sgu_reportefalla` (
`id` int(11) NOT NULL,
  `detalle` varchar(150) DEFAULT NULL,
  `fechaFalla` date NOT NULL,
  `fechaRealizada` date NOT NULL DEFAULT '0000-01-01',
  `kmRealizada` int(11) NOT NULL DEFAULT '-1',
  `diasParo` int(11) NOT NULL DEFAULT '0',
  `idtiempo` int(11) NOT NULL DEFAULT '1',
  `idvehiculo` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `idfalla` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `arreglos` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_reportefalla`
--

INSERT INTO `sgu_reportefalla` (`id`, `detalle`, `fechaFalla`, `fechaRealizada`, `kmRealizada`, `diasParo`, `idtiempo`, `idvehiculo`, `idempleado`, `idfalla`, `idestatus`, `tipo`, `lugar`, `arreglos`) VALUES
(1, '', '2015-01-06', '2015-01-10', 147831, 4, 1, 3, 3, 3, 3, 1, NULL, NULL),
(2, '', '2015-01-06', '2015-01-13', 257896, 7, 1, 4, 4, 2, 3, 1, NULL, NULL),
(5, '', '2015-03-02', '2015-03-04', 0, 2, 1, 1, 1, 1, 3, 0, '', 'cambio de valvula iac'),
(6, '', '2015-03-09', '2015-03-10', 0, 1, 1, 2, 2, 1, 3, 0, 'Las lomas', 'problema electrico'),
(7, '', '2015-04-13', '2015-04-16', 0, 3, 1, 3, 3, 1, 3, 0, '', ''),
(8, '', '2015-04-14', '2015-04-16', 0, 2, 1, 4, 4, 1, 3, 0, '', ''),
(9, '', '2015-02-25', '2015-02-25', 0, 0, 1, 1, 1, 1, 3, 0, 'palmira', ''),
(10, '', '2015-02-22', '2015-02-25', 0, 3, 1, 2, 2, 1, 3, 0, 'zona industrial', ''),
(12, '', '2015-05-14', '2015-05-16', 0, 2, 1, 1, 1, 1, 3, 0, 'palmira', ''),
(14, '', '2015-05-19', '2015-05-20', 0, 1, 1, 2, 4, 1, 3, 0, 'zona industrial', 'limpieza de inyectores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_repuesto`
--

DROP TABLE IF EXISTS `sgu_repuesto`;
CREATE TABLE IF NOT EXISTS `sgu_repuesto` (
`id` int(11) NOT NULL,
  `repuesto` varchar(200) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `idsubTipoRepuesto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_repuesto`
--

INSERT INTO `sgu_repuesto` (`id`, `repuesto`, `descripcion`, `idsubTipoRepuesto`) VALUES
(1, 'Radiador', NULL, 3),
(2, 'Tambor', NULL, 4),
(3, 'Collarin', NULL, 5),
(4, 'Disco', NULL, 5),
(5, 'Plato', NULL, 5),
(6, 'Carburador', NULL, 6),
(7, 'Amortiguador', NULL, 8),
(8, 'Alternador', NULL, 9),
(9, 'Batería', NULL, 9),
(10, 'Bobina', NULL, 9),
(11, 'Bujía', NULL, 9),
(12, 'Cable bujía', NULL, 9),
(13, 'Bomba combustible', NULL, 10),
(14, 'Inyector', NULL, 10),
(15, 'Capot', NULL, 11),
(16, 'Silenciador', NULL, 12),
(17, 'Parachoques', NULL, 11),
(18, 'Valvula IAC', NULL, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_rin`
--

DROP TABLE IF EXISTS `sgu_rin`;
CREATE TABLE IF NOT EXISTS `sgu_rin` (
`id` int(11) NOT NULL,
  `rin` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_rin`
--

INSERT INTO `sgu_rin` (`id`, `rin`) VALUES
(1, 13),
(2, 14),
(3, 15),
(4, 16),
(5, 17),
(6, 18),
(7, 19),
(8, 20),
(9, 21),
(10, 22),
(11, 23),
(12, 24),
(13, 25),
(14, 26),
(15, 27),
(16, 28),
(17, 29),
(18, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_servicio`
--

DROP TABLE IF EXISTS `sgu_servicio`;
CREATE TABLE IF NOT EXISTS `sgu_servicio` (
`id` int(11) NOT NULL,
  `servicio` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_servicio`
--

INSERT INTO `sgu_servicio` (`id`, `servicio`) VALUES
(1, 'Lavado y engrase'),
(2, 'rectificación pieza'),
(3, 'latoneria y pintura'),
(4, 'limpieza de inyectores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_subtiporepuesto`
--

DROP TABLE IF EXISTS `sgu_subtiporepuesto`;
CREATE TABLE IF NOT EXISTS `sgu_subtiporepuesto` (
`id` int(11) NOT NULL,
  `idTipoRepuesto` int(11) NOT NULL,
  `subTipo` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_subtiporepuesto`
--

INSERT INTO `sgu_subtiporepuesto` (`id`, `idTipoRepuesto`, `subTipo`) VALUES
(1, 1, 'Aire acondicionado'),
(2, 1, 'Caja sincrónica'),
(3, 1, 'Enfriamiento'),
(4, 1, 'Frenos'),
(5, 1, 'Kit clutch'),
(6, 1, 'Motor'),
(7, 1, 'Transmisión'),
(8, 1, 'Tren delantero'),
(9, 2, 'Sistema eléctrico'),
(10, 2, 'Sensores y actuadores'),
(11, 3, 'Carrocería'),
(12, 3, 'Escape');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_tiempo`
--

DROP TABLE IF EXISTS `sgu_tiempo`;
CREATE TABLE IF NOT EXISTS `sgu_tiempo` (
`id` int(11) NOT NULL,
  `tiempo` varchar(10) NOT NULL,
  `sqlTimevalues` varchar(45) DEFAULT NULL,
  `segundosUnidad` int(11) DEFAULT NULL,
  `palabraUnidad` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_tiempo`
--

INSERT INTO `sgu_tiempo` (`id`, `tiempo`, `sqlTimevalues`, `segundosUnidad`, `palabraUnidad`) VALUES
(1, 'Día(s)', 'D', 86400, 'day'),
(2, 'Hora(s)', 'H', 3600, 'hour'),
(3, 'Mes(es)', 'M', 2629750, 'month'),
(4, 'Año(s)', 'Y', 31556900, 'year'),
(5, 'Minuto(s)', 'i', 60, 'minute');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_tipo`
--

DROP TABLE IF EXISTS `sgu_tipo`;
CREATE TABLE IF NOT EXISTS `sgu_tipo` (
`id` int(11) NOT NULL,
  `tipo` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_tipo`
--

INSERT INTO `sgu_tipo` (`id`, `tipo`) VALUES
(1, 'Autobus'),
(2, 'Automovil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_tipocombustible`
--

DROP TABLE IF EXISTS `sgu_tipocombustible`;
CREATE TABLE IF NOT EXISTS `sgu_tipocombustible` (
`id` int(11) NOT NULL,
  `combustible` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_tipocombustible`
--

INSERT INTO `sgu_tipocombustible` (`id`, `combustible`) VALUES
(1, 'Gasolina'),
(2, 'Diesel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_tipoempleado`
--

DROP TABLE IF EXISTS `sgu_tipoempleado`;
CREATE TABLE IF NOT EXISTS `sgu_tipoempleado` (
`id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_tipoempleado`
--

INSERT INTO `sgu_tipoempleado` (`id`, `tipo`) VALUES
(1, 'Conductor'),
(2, 'Coordinador operativo'),
(3, 'Coordinador de transporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_tipoinsumo`
--

DROP TABLE IF EXISTS `sgu_tipoinsumo`;
CREATE TABLE IF NOT EXISTS `sgu_tipoinsumo` (
`id` int(11) NOT NULL,
  `tipo` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_tipoinsumo`
--

INSERT INTO `sgu_tipoinsumo` (`id`, `tipo`) VALUES
(1, 'Lubricantes'),
(2, 'Fluidos'),
(3, 'Limpieza'),
(4, 'Autopartes'),
(5, 'Filtros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_tiporepuesto`
--

DROP TABLE IF EXISTS `sgu_tiporepuesto`;
CREATE TABLE IF NOT EXISTS `sgu_tiporepuesto` (
`id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_tiporepuesto`
--

INSERT INTO `sgu_tiporepuesto` (`id`, `tipo`) VALUES
(1, 'Mecánico'),
(2, 'Eléctrico'),
(3, 'Físico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_tipoviaje`
--

DROP TABLE IF EXISTS `sgu_tipoviaje`;
CREATE TABLE IF NOT EXISTS `sgu_tipoviaje` (
`id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_tipoviaje`
--

INSERT INTO `sgu_tipoviaje` (`id`, `tipo`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_unidad`
--

DROP TABLE IF EXISTS `sgu_unidad`;
CREATE TABLE IF NOT EXISTS `sgu_unidad` (
  `id` int(11) NOT NULL,
  `unidad` varchar(30) NOT NULL,
  `corto` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_unidad`
--

INSERT INTO `sgu_unidad` (`id`, `unidad`, `corto`) VALUES
(1, 'Pieza(s)', 'Pza(s)'),
(2, 'Kit', 'Kit'),
(3, 'Galón(es)', 'Gal'),
(4, 'Litro(s)', 'L'),
(5, 'Juego', 'Jgo.'),
(6, 'Tubo(s)', 'Tubo(s)'),
(7, 'Centímetros cúbicos', 'CC'),
(8, 'Servicio', 'Serv.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_vehiculo`
--

DROP TABLE IF EXISTS `sgu_vehiculo`;
CREATE TABLE IF NOT EXISTS `sgu_vehiculo` (
`id` int(11) NOT NULL,
  `numeroUnidad` int(11) NOT NULL,
  `serialCarroceria` varchar(45) NOT NULL,
  `serialMotor` varchar(45) NOT NULL,
  `placa` varchar(7) NOT NULL,
  `anno` int(11) NOT NULL,
  `nroPuestos` int(11) NOT NULL,
  `comentario` varchar(200) DEFAULT NULL,
  `idmodelo` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `idcolor` int(11) NOT NULL,
  `idpropiedad` int(11) NOT NULL,
  `idcombustible` int(11) NOT NULL,
  `fechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `KmInicial` int(11) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_vehiculo`
--

INSERT INTO `sgu_vehiculo` (`id`, `numeroUnidad`, `serialCarroceria`, `serialMotor`, `placa`, `anno`, `nroPuestos`, `comentario`, `idmodelo`, `idgrupo`, `idcolor`, `idpropiedad`, `idcombustible`, `fechaRegistro`, `KmInicial`, `activo`) VALUES
(1, 17, '6V57932453GV', '634656953', 'PAA24V', 2006, 32, ' ', 4, 1, 3, 1, 2, '2015-01-01 04:30:00', 125345, 1),
(2, 15, 'F54959495', '456789678', 'AB232GS', 2006, 32, ' ', 4, 1, 2, 2, 2, '2015-01-01 04:30:00', 67412, 1),
(3, 4, '6FHEF4467', '789234545', 'AF453FT', 2008, 25, ' ', 2, 2, 1, 1, 2, '2015-01-01 04:30:00', 147831, 1),
(4, 7, 'HZ1345GFT54', '634238998', 'AB546NJ', 2010, 5, '', 3, 3, 3, 3, 1, '2015-01-01 04:30:00', 257896, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgu_viaje`
--

DROP TABLE IF EXISTS `sgu_viaje`;
CREATE TABLE IF NOT EXISTS `sgu_viaje` (
`id` int(11) NOT NULL,
  `distanciaKm` float NOT NULL,
  `idOrigen` int(11) NOT NULL,
  `idDestino` int(11) NOT NULL,
  `idtipo` int(11) NOT NULL,
  `viaje` varchar(80) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sgu_viaje`
--

INSERT INTO `sgu_viaje` (`id`, `distanciaKm`, `idOrigen`, `idDestino`, `idtipo`, `viaje`) VALUES
(1, 10, 1, 3, 1, 'UNET -> Táriba'),
(2, 11, 3, 1, 1, 'Táriba -> UNET'),
(3, 20, 1, 5, 1, 'UNET -> Palmira'),
(4, 20, 5, 1, 1, 'Palmira -> UNET');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cruge_authassignment`
--
ALTER TABLE `cruge_authassignment`
 ADD PRIMARY KEY (`userid`,`itemname`), ADD KEY `fk_cruge_authassignment_user` (`userid`), ADD KEY `fk_cruge_authassignment_cruge_authitem1_idx` (`itemname`);

--
-- Indices de la tabla `cruge_authitem`
--
ALTER TABLE `cruge_authitem`
 ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `cruge_authitemchild`
--
ALTER TABLE `cruge_authitemchild`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indices de la tabla `cruge_field`
--
ALTER TABLE `cruge_field`
 ADD PRIMARY KEY (`idfield`);

--
-- Indices de la tabla `cruge_fieldvalue`
--
ALTER TABLE `cruge_fieldvalue`
 ADD PRIMARY KEY (`idfieldvalue`), ADD KEY `fk_cruge_fieldvalue_cruge_user1` (`iduser`), ADD KEY `fk_cruge_fieldvalue_cruge_field1` (`idfield`);

--
-- Indices de la tabla `cruge_session`
--
ALTER TABLE `cruge_session`
 ADD PRIMARY KEY (`idsession`), ADD KEY `crugesession_iduser` (`iduser`);

--
-- Indices de la tabla `cruge_system`
--
ALTER TABLE `cruge_system`
 ADD PRIMARY KEY (`idsystem`);

--
-- Indices de la tabla `cruge_user`
--
ALTER TABLE `cruge_user`
 ADD PRIMARY KEY (`iduser`);

--
-- Indices de la tabla `sgu_accioncaucho`
--
ALTER TABLE `sgu_accioncaucho`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_actividades`
--
ALTER TABLE `sgu_actividades`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_actividades_sgu_prioridad1_idx` (`idprioridad`), ADD KEY `fk_sgu_actividades_sgu_tiempo1_idx` (`idtiempod`), ADD KEY `fk_sgu_actividades_sgu_tiempo2_idx` (`idtiempof`), ADD KEY `fk_sgu_actividades_sgu_actividadesGrupo1_idx` (`idactividadesGrupo`), ADD KEY `fk_sgu_actividades_sgu_estatus1_idx` (`idestatus`), ADD KEY `fk_sgu_actividades_sgu_actividadMtto1_idx` (`idactividadMtto`), ADD KEY `fk_sgu_actividades_sgu_vehiculo1_idx` (`idvehiculo`);

--
-- Indices de la tabla `sgu_actividadesgrupo`
--
ALTER TABLE `sgu_actividadesgrupo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_actividadesGrupo_sgu_prioridad1_idx` (`idprioridad`), ADD KEY `fk_sgu_actividadesGrupo_sgu_tiempo1_idx` (`idtiempod`), ADD KEY `fk_sgu_actividadesGrupo_sgu_tiempo2_idx` (`idtiempof`), ADD KEY `fk_sgu_actividadesGrupo_sgu_actividadMtto1_idx` (`idactividadMtto`), ADD KEY `fk_sgu_actividadesGrupo_sgu_grupo1_idx` (`idgrupo`);

--
-- Indices de la tabla `sgu_actividadmtto`
--
ALTER TABLE `sgu_actividadmtto`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_actividadrecurso`
--
ALTER TABLE `sgu_actividadrecurso`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_actividadRecurso_sgu_actividades1_idx` (`idactividades`), ADD KEY `fk_sgu_actividadRecurso_sgu_insumo1_idx` (`idinsumo`), ADD KEY `fk_sgu_actividadRecurso_sgu_repuesto1_idx` (`idrepuesto`), ADD KEY `fk_sgu_actividadRecurso_sgu_unidad1_idx` (`idunidad`), ADD KEY `fk_sgu_actividadRecurso_sgu_actividadRecursoGrupo1_idx` (`idactividadRecursoGrupo`), ADD KEY `fk_sgu_actividadRecurso_sgu_servicio1_idx` (`idservicio`);

--
-- Indices de la tabla `sgu_actividadrecursogrupo`
--
ALTER TABLE `sgu_actividadrecursogrupo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_actividadRecursoGrupo_sgu_actividadesGrupo1_idx` (`idactividadesGrupo`), ADD KEY `fk_sgu_actividadRecursoGrupo_sgu_insumo1_idx` (`idinsumo`), ADD KEY `fk_sgu_actividadRecursoGrupo_sgu_repuesto1_idx` (`idrepuesto`), ADD KEY `fk_sgu_actividadRecursoGrupo_sgu_unidad1_idx` (`idunidad`), ADD KEY `fk_sgu_actividadRecursoGrupo_sgu_servicio1_idx` (`idservicio`);

--
-- Indices de la tabla `sgu_asigchasis`
--
ALTER TABLE `sgu_asigchasis`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_asigChasis_sgu_chasis1_idx` (`idchasis`), ADD KEY `fk_sgu_asigChasis_sgu_grupo1_idx` (`idgrupo`);

--
-- Indices de la tabla `sgu_bitacora`
--
ALTER TABLE `sgu_bitacora`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_bitacora_cruge_user1_idx` (`idusuario`);

--
-- Indices de la tabla `sgu_cantidad`
--
ALTER TABLE `sgu_cantidad`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_SGU_Cantidad_SGU_CaracteristicaVeh1_idx` (`idCaracteristicaVeh`), ADD KEY `fk_sgu_Cantidad_sgu_Cantidad1_idx` (`anterior`);

--
-- Indices de la tabla `sgu_cantidadgrupo`
--
ALTER TABLE `sgu_cantidadgrupo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_SGU_CantidadGrupo_SGU_CaracteristicaVehGrupo1_idx` (`idCaracteristicaVehGrupo`);

--
-- Indices de la tabla `sgu_caracteristicaveh`
--
ALTER TABLE `sgu_caracteristicaveh`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_SGU_CaracteristicaVeh_SGU_vehiculo1_idx` (`idvehiculo`), ADD KEY `fk_SGU_CaracteristicaVeh_SGU_repuesto1_idx` (`idrepuesto`);

--
-- Indices de la tabla `sgu_caracteristicavehgrupo`
--
ALTER TABLE `sgu_caracteristicavehgrupo`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unicoSGU_CaracteristicaVehGrupo` (`idgrupo`,`idrepuesto`), ADD KEY `fk_SGU_CaracteristicaVehGrupo_SGU_grupo1_idx` (`idgrupo`), ADD KEY `fk_SGU_CaracteristicaVehGrupo_SGU_repuesto1_idx` (`idrepuesto`);

--
-- Indices de la tabla `sgu_caucho`
--
ALTER TABLE `sgu_caucho`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_caucho_sgu_medidaCaucho1_idx` (`idmedidaCaucho`), ADD KEY `fk_sgu_caucho_sgu_rin1_idx` (`idrin`), ADD KEY `fk_sgu_caucho_sgu_piso1_idx` (`idpiso`);

--
-- Indices de la tabla `sgu_cauchorep`
--
ALTER TABLE `sgu_cauchorep`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_cauchoRep_sgu_chasis1_idx` (`idchasis`), ADD KEY `fk_sgu_cauchoRep_sgu_caucho1_idx` (`idcaucho`);

--
-- Indices de la tabla `sgu_chasis`
--
ALTER TABLE `sgu_chasis`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_color`
--
ALTER TABLE `sgu_color`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_combust`
--
ALTER TABLE `sgu_combust`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_combust_sgu_tipoCombustible1_idx` (`idtipoCombustible`);

--
-- Indices de la tabla `sgu_departamento`
--
ALTER TABLE `sgu_departamento`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_detalleeje`
--
ALTER TABLE `sgu_detalleeje`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_detalleEje_sgu_chasis1_idx` (`idchasis`), ADD KEY `fk_sgu_detalleEje_sgu_posicionEje1_idx` (`idposicionEje`);

--
-- Indices de la tabla `sgu_detalleeventoca`
--
ALTER TABLE `sgu_detalleeventoca`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_detalleFallaCa_sgu_historicoCaucho1_idx` (`idhistoricoCaucho`), ADD KEY `fk_sgu_detalleFallaCa_sgu_fallaCaucho1_idx` (`idfallaCaucho`), ADD KEY `fk_sgu_detalleEventoCa_sgu_estatus1_idx` (`idestatus`), ADD KEY `fk_sgu_detalleEventoCa_sgu_empleado1_idx` (`idempleado`), ADD KEY `fk_sgu_detalleEventoCa_sgu_accionCaucho1_idx` (`idaccionCaucho`), ADD KEY `fk_sgu_detalleEventoCa_sgu_historicoCaucho2_idx` (`idNuevoCaucho`);

--
-- Indices de la tabla `sgu_detalleorden`
--
ALTER TABLE `sgu_detalleorden`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_detalleOrden_sgu_ordenMtto1_idx` (`idordenMtto`), ADD KEY `fk_sgu_detalleOrden_sgu_actividades1_idx` (`idactividades`);

--
-- Indices de la tabla `sgu_detalleordenco`
--
ALTER TABLE `sgu_detalleordenco`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_detalleOrdenCo_sgu_ordenMtto1_idx` (`idordenMtto`), ADD KEY `fk_sgu_detalleOrdenCo_sgu_reporteFalla1_idx` (`idreporteFalla`);

--
-- Indices de la tabla `sgu_detallerueda`
--
ALTER TABLE `sgu_detallerueda`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_detalleRueda_sgu_posicionRueda1_idx` (`idposicionRueda`), ADD KEY `fk_sgu_detalleRueda_sgu_detalleEje1_idx` (`iddetalleEje`), ADD KEY `fk_sgu_detalleRueda_sgu_caucho1_idx` (`idcaucho`);

--
-- Indices de la tabla `sgu_detordneumatico`
--
ALTER TABLE `sgu_detordneumatico`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_detOrdNeumatico_sgu_ordenMtto1_idx` (`idordenMtto`), ADD KEY `fk_sgu_detOrdNeumatico_sgu_detalleFallaCa1_idx` (`iddetalleEventoCa`);

--
-- Indices de la tabla `sgu_detreccaucho`
--
ALTER TABLE `sgu_detreccaucho`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_detRecCaucho_sgu_recursoCaucho1_idx` (`idrecursoCaucho`), ADD KEY `fk_sgu_detRecCaucho_sgu_detalleEventoCa1_idx` (`iddetalleEventoCa`), ADD KEY `fk_sgu_detRecCaucho_sgu_unidad1_idx` (`idunidad`);

--
-- Indices de la tabla `sgu_empleado`
--
ALTER TABLE `sgu_empleado`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_empleado_sgu_tipoEmpleado1_idx` (`idtipoEmpleado`);

--
-- Indices de la tabla `sgu_estacionservicio`
--
ALTER TABLE `sgu_estacionservicio`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_estado`
--
ALTER TABLE `sgu_estado`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_estados`
--
ALTER TABLE `sgu_estados`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `estado_UNIQUE` (`estado`);

--
-- Indices de la tabla `sgu_estatus`
--
ALTER TABLE `sgu_estatus`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_estatuscaucho`
--
ALTER TABLE `sgu_estatuscaucho`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_factura`
--
ALTER TABLE `sgu_factura`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_factura_sgu_proveedor1_idx` (`idproveedor`), ADD KEY `fk_sgu_factura_sgu_ordenMtto1_idx` (`idordenMtto`);

--
-- Indices de la tabla `sgu_falla`
--
ALTER TABLE `sgu_falla`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_fallacaucho`
--
ALTER TABLE `sgu_fallacaucho`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_foto`
--
ALTER TABLE `sgu_foto`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_SGU_foto_SGU_vehiculo1_idx` (`idvehiculo`);

--
-- Indices de la tabla `sgu_grupo`
--
ALTER TABLE `sgu_grupo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_SGU_grupo_SGU_tipo1_idx` (`idtipo`);

--
-- Indices de la tabla `sgu_historicocaucho`
--
ALTER TABLE `sgu_historicocaucho`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_historicoCaucho_sgu_estatusCaucho1_idx` (`idestatusCaucho`), ADD KEY `fk_sgu_historicoCaucho_sgu_caucho1_idx` (`idcaucho`), ADD KEY `fk_sgu_historicoCaucho_sgu_marcaCaucho1_idx` (`idmarcaCaucho`), ADD KEY `fk_sgu_historicoCaucho_sgu_vehiculo1_idx` (`idvehiculo`), ADD KEY `fk_sgu_historicoCaucho_sgu_detalleRueda1_idx` (`iddetalleRueda`), ADD KEY `fk_sgu_historicoCaucho_sgu_asigChasis1_idx` (`idasigChasis`);

--
-- Indices de la tabla `sgu_historicocombustible`
--
ALTER TABLE `sgu_historicocombustible`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_historicoCombustible_sgu_vehiculo1_idx` (`idvehiculo`), ADD KEY `fk_sgu_historicoCombustible_sgu_empleado1_idx` (`idconductor`), ADD KEY `fk_sgu_historicoCombustible_sgu_estacionServicio1_idx` (`idestacionServicio`), ADD KEY `fk_sgu_historicoCombustible_sgu_combust1_idx` (`idcombust`);

--
-- Indices de la tabla `sgu_historicoedos`
--
ALTER TABLE `sgu_historicoedos`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_SGU_historicoEdos_SGU_estado1_idx` (`idestado`), ADD KEY `fk_SGU_historicoEdos_SGU_vehiculo1_idx` (`idvehiculo`);

--
-- Indices de la tabla `sgu_historicoempleados`
--
ALTER TABLE `sgu_historicoempleados`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_historicoEmpleados_sgu_empleado1_idx` (`idempleado`), ADD KEY `fk_sgu_historicoEmpleados_sgu_vehiculo1_idx` (`idvehiculo`);

--
-- Indices de la tabla `sgu_historicoviajes`
--
ALTER TABLE `sgu_historicoviajes`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unico_historico` (`fechaSalida`,`fechaLlegada`,`idviaje`,`idvehiculo`,`nroPersonas`,`idconductor`), ADD KEY `fk_sgu_historicoViajes_sgu_viaje1_idx` (`idviaje`), ADD KEY `fk_sgu_historicoViajes_sgu_vehiculo1_idx` (`idvehiculo`), ADD KEY `fk_sgu_historicoViajes_sgu_empleado1_idx` (`idconductor`);

--
-- Indices de la tabla `sgu_infgrupo`
--
ALTER TABLE `sgu_infgrupo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_infGrupo_sgu_grupo1_idx` (`idgrupo`);

--
-- Indices de la tabla `sgu_informacion`
--
ALTER TABLE `sgu_informacion`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_informacion_sgu_vehiculo1_idx` (`idvehiculo`);

--
-- Indices de la tabla `sgu_insumo`
--
ALTER TABLE `sgu_insumo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_insumo_sgu_tipoInsumo1_idx` (`tipoInsumo`);

--
-- Indices de la tabla `sgu_kilometraje`
--
ALTER TABLE `sgu_kilometraje`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_kilometraje_sgu_vehiculo1_idx` (`idvehiculo`), ADD KEY `fk_sgu_kilometraje_sgu_historicoViajes1_idx` (`idhistoricoViajes`);

--
-- Indices de la tabla `sgu_lugar`
--
ALTER TABLE `sgu_lugar`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_lugar_sgu_estados1_idx` (`idestados`);

--
-- Indices de la tabla `sgu_marca`
--
ALTER TABLE `sgu_marca`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_marcacaucho`
--
ALTER TABLE `sgu_marcacaucho`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_medidacaucho`
--
ALTER TABLE `sgu_medidacaucho`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_modelo`
--
ALTER TABLE `sgu_modelo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_SGU_modelo_SGU_marca1_idx` (`idmarca`);

--
-- Indices de la tabla `sgu_ordenmtto`
--
ALTER TABLE `sgu_ordenmtto`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_ordenMtto_sgu_estatus1_idx` (`idestatus`), ADD KEY `fk_sgu_ordenMtto_sgu_proveedor1_idx` (`taller`), ADD KEY `fk_sgu_ordenMtto_sgu_empleado1_idx` (`cOperativo`), ADD KEY `fk_sgu_ordenMtto_sgu_empleado2_idx` (`cTaller`);

--
-- Indices de la tabla `sgu_parametro`
--
ALTER TABLE `sgu_parametro`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_piso`
--
ALTER TABLE `sgu_piso`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_posicioneje`
--
ALTER TABLE `sgu_posicioneje`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_posicionrueda`
--
ALTER TABLE `sgu_posicionrueda`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_prioridad`
--
ALTER TABLE `sgu_prioridad`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_propiedad`
--
ALTER TABLE `sgu_propiedad`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_proveedor`
--
ALTER TABLE `sgu_proveedor`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_recursocaucho`
--
ALTER TABLE `sgu_recursocaucho`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_recursofalla`
--
ALTER TABLE `sgu_recursofalla`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_recursoFalla_sgu_reporteFalla1_idx` (`idreporteFalla`), ADD KEY `fk_sgu_recursoFalla_sgu_unidad1_idx` (`idunidad`), ADD KEY `fk_sgu_recursoFalla_sgu_insumo1_idx` (`idinsumo`), ADD KEY `fk_sgu_recursoFalla_sgu_servicio1_idx` (`idservicio`), ADD KEY `fk_sgu_recursoFalla_sgu_repuesto1_idx` (`idrepuesto`), ADD KEY `fk_sgu_recursoFalla_sgu_tiempo1_idx` (`idtiempo`);

--
-- Indices de la tabla `sgu_reportefalla`
--
ALTER TABLE `sgu_reportefalla`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_reporteFalla_sgu_vehiculo1_idx` (`idvehiculo`), ADD KEY `fk_sgu_reporteFalla_sgu_empleado1_idx` (`idempleado`), ADD KEY `fk_sgu_reporteFalla_sgu_falla1_idx` (`idfalla`), ADD KEY `fk_sgu_reporteFalla_sgu_tiempo1_idx` (`idtiempo`), ADD KEY `fk_sgu_reporteFalla_sgu_estatus1_idx` (`idestatus`);

--
-- Indices de la tabla `sgu_repuesto`
--
ALTER TABLE `sgu_repuesto`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unicoSGU_repuesto` (`repuesto`,`idsubTipoRepuesto`), ADD KEY `fk_SGU_repuesto_SGU_subTipoRepuesto1_idx` (`idsubTipoRepuesto`);

--
-- Indices de la tabla `sgu_rin`
--
ALTER TABLE `sgu_rin`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_servicio`
--
ALTER TABLE `sgu_servicio`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_subtiporepuesto`
--
ALTER TABLE `sgu_subtiporepuesto`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_SGU_subTipoRepuesto_SGU_TipoRepuesto1_idx` (`idTipoRepuesto`);

--
-- Indices de la tabla `sgu_tiempo`
--
ALTER TABLE `sgu_tiempo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_tipo`
--
ALTER TABLE `sgu_tipo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_tipocombustible`
--
ALTER TABLE `sgu_tipocombustible`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_tipoempleado`
--
ALTER TABLE `sgu_tipoempleado`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_tipoinsumo`
--
ALTER TABLE `sgu_tipoinsumo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_tiporepuesto`
--
ALTER TABLE `sgu_tiporepuesto`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_tipoviaje`
--
ALTER TABLE `sgu_tipoviaje`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_unidad`
--
ALTER TABLE `sgu_unidad`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgu_vehiculo`
--
ALTER TABLE `sgu_vehiculo`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `numeroUnidad_UNIQUE` (`numeroUnidad`), ADD UNIQUE KEY `serialCarroceria_UNIQUE` (`serialCarroceria`), ADD UNIQUE KEY `serialChasis_UNIQUE` (`serialMotor`), ADD UNIQUE KEY `placa_UNIQUE` (`placa`), ADD KEY `fk_SGU_vehiculo_SGU_modelo1_idx` (`idmodelo`), ADD KEY `fk_SGU_vehiculo_SGU_grupo1_idx` (`idgrupo`), ADD KEY `fk_SGU_vehiculo_SGU_color1_idx` (`idcolor`), ADD KEY `fk_SGU_vehiculo_sgu_propiedad1_idx` (`idpropiedad`), ADD KEY `fk_sgu_vehiculo_sgu_tipoCombustible1_idx` (`idcombustible`);

--
-- Indices de la tabla `sgu_viaje`
--
ALTER TABLE `sgu_viaje`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sgu_viaje_sgu_lugar1_idx` (`idOrigen`), ADD KEY `fk_sgu_viaje_sgu_lugar2_idx` (`idDestino`), ADD KEY `fk_sgu_viaje_sgu_tipo1_idx` (`idtipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cruge_field`
--
ALTER TABLE `cruge_field`
MODIFY `idfield` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cruge_fieldvalue`
--
ALTER TABLE `cruge_fieldvalue`
MODIFY `idfieldvalue` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cruge_session`
--
ALTER TABLE `cruge_session`
MODIFY `idsession` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cruge_system`
--
ALTER TABLE `cruge_system`
MODIFY `idsystem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cruge_user`
--
ALTER TABLE `cruge_user`
MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_accioncaucho`
--
ALTER TABLE `sgu_accioncaucho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_actividades`
--
ALTER TABLE `sgu_actividades`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT de la tabla `sgu_actividadesgrupo`
--
ALTER TABLE `sgu_actividadesgrupo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sgu_actividadmtto`
--
ALTER TABLE `sgu_actividadmtto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `sgu_actividadrecurso`
--
ALTER TABLE `sgu_actividadrecurso`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `sgu_actividadrecursogrupo`
--
ALTER TABLE `sgu_actividadrecursogrupo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_asigchasis`
--
ALTER TABLE `sgu_asigchasis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sgu_bitacora`
--
ALTER TABLE `sgu_bitacora`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT de la tabla `sgu_cantidad`
--
ALTER TABLE `sgu_cantidad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_cantidadgrupo`
--
ALTER TABLE `sgu_cantidadgrupo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sgu_caracteristicaveh`
--
ALTER TABLE `sgu_caracteristicaveh`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_caracteristicavehgrupo`
--
ALTER TABLE `sgu_caracteristicavehgrupo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sgu_caucho`
--
ALTER TABLE `sgu_caucho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_cauchorep`
--
ALTER TABLE `sgu_cauchorep`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sgu_chasis`
--
ALTER TABLE `sgu_chasis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_color`
--
ALTER TABLE `sgu_color`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sgu_combust`
--
ALTER TABLE `sgu_combust`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_departamento`
--
ALTER TABLE `sgu_departamento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sgu_detalleeje`
--
ALTER TABLE `sgu_detalleeje`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_detalleeventoca`
--
ALTER TABLE `sgu_detalleeventoca`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_detalleorden`
--
ALTER TABLE `sgu_detalleorden`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `sgu_detalleordenco`
--
ALTER TABLE `sgu_detalleordenco`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `sgu_detallerueda`
--
ALTER TABLE `sgu_detallerueda`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `sgu_detordneumatico`
--
ALTER TABLE `sgu_detordneumatico`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_detreccaucho`
--
ALTER TABLE `sgu_detreccaucho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_empleado`
--
ALTER TABLE `sgu_empleado`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `sgu_estacionservicio`
--
ALTER TABLE `sgu_estacionservicio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_estado`
--
ALTER TABLE `sgu_estado`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sgu_estados`
--
ALTER TABLE `sgu_estados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sgu_estatus`
--
ALTER TABLE `sgu_estatus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `sgu_estatuscaucho`
--
ALTER TABLE `sgu_estatuscaucho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `sgu_factura`
--
ALTER TABLE `sgu_factura`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `sgu_falla`
--
ALTER TABLE `sgu_falla`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_fallacaucho`
--
ALTER TABLE `sgu_fallacaucho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sgu_foto`
--
ALTER TABLE `sgu_foto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sgu_grupo`
--
ALTER TABLE `sgu_grupo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_historicocaucho`
--
ALTER TABLE `sgu_historicocaucho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sgu_historicocombustible`
--
ALTER TABLE `sgu_historicocombustible`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `sgu_historicoedos`
--
ALTER TABLE `sgu_historicoedos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sgu_historicoempleados`
--
ALTER TABLE `sgu_historicoempleados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sgu_historicoviajes`
--
ALTER TABLE `sgu_historicoviajes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `sgu_infgrupo`
--
ALTER TABLE `sgu_infgrupo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sgu_informacion`
--
ALTER TABLE `sgu_informacion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sgu_insumo`
--
ALTER TABLE `sgu_insumo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `sgu_kilometraje`
--
ALTER TABLE `sgu_kilometraje`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `sgu_lugar`
--
ALTER TABLE `sgu_lugar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sgu_marca`
--
ALTER TABLE `sgu_marca`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sgu_marcacaucho`
--
ALTER TABLE `sgu_marcacaucho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_medidacaucho`
--
ALTER TABLE `sgu_medidacaucho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_modelo`
--
ALTER TABLE `sgu_modelo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sgu_ordenmtto`
--
ALTER TABLE `sgu_ordenmtto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `sgu_parametro`
--
ALTER TABLE `sgu_parametro`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_piso`
--
ALTER TABLE `sgu_piso`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_posicioneje`
--
ALTER TABLE `sgu_posicioneje`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_posicionrueda`
--
ALTER TABLE `sgu_posicionrueda`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sgu_prioridad`
--
ALTER TABLE `sgu_prioridad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_propiedad`
--
ALTER TABLE `sgu_propiedad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_proveedor`
--
ALTER TABLE `sgu_proveedor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_recursocaucho`
--
ALTER TABLE `sgu_recursocaucho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sgu_recursofalla`
--
ALTER TABLE `sgu_recursofalla`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `sgu_reportefalla`
--
ALTER TABLE `sgu_reportefalla`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `sgu_repuesto`
--
ALTER TABLE `sgu_repuesto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `sgu_rin`
--
ALTER TABLE `sgu_rin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `sgu_servicio`
--
ALTER TABLE `sgu_servicio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sgu_subtiporepuesto`
--
ALTER TABLE `sgu_subtiporepuesto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `sgu_tiempo`
--
ALTER TABLE `sgu_tiempo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `sgu_tipo`
--
ALTER TABLE `sgu_tipo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_tipocombustible`
--
ALTER TABLE `sgu_tipocombustible`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sgu_tipoempleado`
--
ALTER TABLE `sgu_tipoempleado`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_tipoinsumo`
--
ALTER TABLE `sgu_tipoinsumo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `sgu_tiporepuesto`
--
ALTER TABLE `sgu_tiporepuesto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_tipoviaje`
--
ALTER TABLE `sgu_tipoviaje`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sgu_vehiculo`
--
ALTER TABLE `sgu_vehiculo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sgu_viaje`
--
ALTER TABLE `sgu_viaje`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cruge_authassignment`
--
ALTER TABLE `cruge_authassignment`
ADD CONSTRAINT `fk_cruge_authassignment_cruge_authitem1` FOREIGN KEY (`itemname`) REFERENCES `cruge_authitem` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_cruge_authassignment_user` FOREIGN KEY (`userid`) REFERENCES `cruge_user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cruge_authitemchild`
--
ALTER TABLE `cruge_authitemchild`
ADD CONSTRAINT `crugeauthitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `cruge_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `crugeauthitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `cruge_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cruge_fieldvalue`
--
ALTER TABLE `cruge_fieldvalue`
ADD CONSTRAINT `fk_cruge_fieldvalue_cruge_field1` FOREIGN KEY (`idfield`) REFERENCES `cruge_field` (`idfield`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_cruge_fieldvalue_cruge_user1` FOREIGN KEY (`iduser`) REFERENCES `cruge_user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_actividades`
--
ALTER TABLE `sgu_actividades`
ADD CONSTRAINT `fk_sgu_actividades_sgu_actividadMtto1` FOREIGN KEY (`idactividadMtto`) REFERENCES `sgu_actividadmtto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividades_sgu_actividadesGrupo1` FOREIGN KEY (`idactividadesGrupo`) REFERENCES `sgu_actividadesgrupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividades_sgu_estatus1` FOREIGN KEY (`idestatus`) REFERENCES `sgu_estatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividades_sgu_prioridad1` FOREIGN KEY (`idprioridad`) REFERENCES `sgu_prioridad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividades_sgu_tiempo1` FOREIGN KEY (`idtiempod`) REFERENCES `sgu_tiempo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividades_sgu_tiempo2` FOREIGN KEY (`idtiempof`) REFERENCES `sgu_tiempo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividades_sgu_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_actividadesgrupo`
--
ALTER TABLE `sgu_actividadesgrupo`
ADD CONSTRAINT `fk_sgu_actividadesGrupo_sgu_actividadMtto1` FOREIGN KEY (`idactividadMtto`) REFERENCES `sgu_actividadmtto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadesGrupo_sgu_grupo1` FOREIGN KEY (`idgrupo`) REFERENCES `sgu_grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadesGrupo_sgu_prioridad1` FOREIGN KEY (`idprioridad`) REFERENCES `sgu_prioridad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadesGrupo_sgu_tiempo1` FOREIGN KEY (`idtiempod`) REFERENCES `sgu_tiempo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadesGrupo_sgu_tiempo2` FOREIGN KEY (`idtiempof`) REFERENCES `sgu_tiempo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_actividadrecurso`
--
ALTER TABLE `sgu_actividadrecurso`
ADD CONSTRAINT `fk_sgu_actividadRecurso_sgu_actividadRecursoGrupo1` FOREIGN KEY (`idactividadRecursoGrupo`) REFERENCES `sgu_actividadrecursogrupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadRecurso_sgu_actividades1` FOREIGN KEY (`idactividades`) REFERENCES `sgu_actividades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadRecurso_sgu_insumo1` FOREIGN KEY (`idinsumo`) REFERENCES `sgu_insumo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadRecurso_sgu_repuesto1` FOREIGN KEY (`idrepuesto`) REFERENCES `sgu_repuesto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadRecurso_sgu_servicio1` FOREIGN KEY (`idservicio`) REFERENCES `sgu_servicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadRecurso_sgu_unidad1` FOREIGN KEY (`idunidad`) REFERENCES `sgu_unidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_actividadrecursogrupo`
--
ALTER TABLE `sgu_actividadrecursogrupo`
ADD CONSTRAINT `fk_sgu_actividadRecursoGrupo_sgu_actividadesGrupo1` FOREIGN KEY (`idactividadesGrupo`) REFERENCES `sgu_actividadesgrupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadRecursoGrupo_sgu_insumo1` FOREIGN KEY (`idinsumo`) REFERENCES `sgu_insumo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadRecursoGrupo_sgu_repuesto1` FOREIGN KEY (`idrepuesto`) REFERENCES `sgu_repuesto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadRecursoGrupo_sgu_servicio1` FOREIGN KEY (`idservicio`) REFERENCES `sgu_servicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_actividadRecursoGrupo_sgu_unidad1` FOREIGN KEY (`idunidad`) REFERENCES `sgu_unidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_asigchasis`
--
ALTER TABLE `sgu_asigchasis`
ADD CONSTRAINT `fk_sgu_asigChasis_sgu_chasis1` FOREIGN KEY (`idchasis`) REFERENCES `sgu_chasis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_asigChasis_sgu_grupo1` FOREIGN KEY (`idgrupo`) REFERENCES `sgu_grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_bitacora`
--
ALTER TABLE `sgu_bitacora`
ADD CONSTRAINT `fk_sgu_bitacora_cruge_user1` FOREIGN KEY (`idusuario`) REFERENCES `cruge_user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_cantidad`
--
ALTER TABLE `sgu_cantidad`
ADD CONSTRAINT `fk_SGU_Cantidad_SGU_CaracteristicaVeh1` FOREIGN KEY (`idCaracteristicaVeh`) REFERENCES `sgu_caracteristicaveh` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_sgu_Cantidad_sgu_Cantidad1` FOREIGN KEY (`anterior`) REFERENCES `sgu_cantidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_cantidadgrupo`
--
ALTER TABLE `sgu_cantidadgrupo`
ADD CONSTRAINT `fk_SGU_CantidadGrupo_SGU_CaracteristicaVehGrupo1` FOREIGN KEY (`idCaracteristicaVehGrupo`) REFERENCES `sgu_caracteristicavehgrupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sgu_caracteristicaveh`
--
ALTER TABLE `sgu_caracteristicaveh`
ADD CONSTRAINT `fk_SGU_CaracteristicaVeh_SGU_repuesto1` FOREIGN KEY (`idrepuesto`) REFERENCES `sgu_repuesto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_SGU_CaracteristicaVeh_SGU_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sgu_caracteristicavehgrupo`
--
ALTER TABLE `sgu_caracteristicavehgrupo`
ADD CONSTRAINT `fk_SGU_CaracteristicaVehGrupo_SGU_grupo1` FOREIGN KEY (`idgrupo`) REFERENCES `sgu_grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_SGU_CaracteristicaVehGrupo_SGU_repuesto1` FOREIGN KEY (`idrepuesto`) REFERENCES `sgu_repuesto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sgu_caucho`
--
ALTER TABLE `sgu_caucho`
ADD CONSTRAINT `fk_sgu_caucho_sgu_medidaCaucho1` FOREIGN KEY (`idmedidaCaucho`) REFERENCES `sgu_medidacaucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_caucho_sgu_piso1` FOREIGN KEY (`idpiso`) REFERENCES `sgu_piso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_caucho_sgu_rin1` FOREIGN KEY (`idrin`) REFERENCES `sgu_rin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_cauchorep`
--
ALTER TABLE `sgu_cauchorep`
ADD CONSTRAINT `fk_sgu_cauchoRep_sgu_caucho1` FOREIGN KEY (`idcaucho`) REFERENCES `sgu_caucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_cauchoRep_sgu_chasis1` FOREIGN KEY (`idchasis`) REFERENCES `sgu_chasis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_combust`
--
ALTER TABLE `sgu_combust`
ADD CONSTRAINT `fk_sgu_combust_sgu_tipoCombustible1` FOREIGN KEY (`idtipoCombustible`) REFERENCES `sgu_tipocombustible` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_detalleeje`
--
ALTER TABLE `sgu_detalleeje`
ADD CONSTRAINT `fk_sgu_detalleEje_sgu_chasis1` FOREIGN KEY (`idchasis`) REFERENCES `sgu_chasis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detalleEje_sgu_posicionEje1` FOREIGN KEY (`idposicionEje`) REFERENCES `sgu_posicioneje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_detalleeventoca`
--
ALTER TABLE `sgu_detalleeventoca`
ADD CONSTRAINT `fk_sgu_detalleEventoCa_sgu_accionCaucho1` FOREIGN KEY (`idaccionCaucho`) REFERENCES `sgu_accioncaucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detalleEventoCa_sgu_empleado1` FOREIGN KEY (`idempleado`) REFERENCES `sgu_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detalleEventoCa_sgu_estatus1` FOREIGN KEY (`idestatus`) REFERENCES `sgu_estatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detalleEventoCa_sgu_fallaCaucho1` FOREIGN KEY (`idfallaCaucho`) REFERENCES `sgu_fallacaucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detalleEventoCa_sgu_historicoCaucho1` FOREIGN KEY (`idhistoricoCaucho`) REFERENCES `sgu_historicocaucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detalleEventoCa_sgu_historicoCaucho2` FOREIGN KEY (`idNuevoCaucho`) REFERENCES `sgu_historicocaucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_detalleorden`
--
ALTER TABLE `sgu_detalleorden`
ADD CONSTRAINT `fk_sgu_detalleOrden_sgu_actividades1` FOREIGN KEY (`idactividades`) REFERENCES `sgu_actividades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_sgu_detalleOrden_sgu_ordenMtto1` FOREIGN KEY (`idordenMtto`) REFERENCES `sgu_ordenmtto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sgu_detalleordenco`
--
ALTER TABLE `sgu_detalleordenco`
ADD CONSTRAINT `fk_sgu_detalleOrdenCo_sgu_ordenMtto1` FOREIGN KEY (`idordenMtto`) REFERENCES `sgu_ordenmtto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detalleOrdenCo_sgu_reporteFalla1` FOREIGN KEY (`idreporteFalla`) REFERENCES `sgu_reportefalla` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_detallerueda`
--
ALTER TABLE `sgu_detallerueda`
ADD CONSTRAINT `fk_sgu_detalleRueda_sgu_caucho1` FOREIGN KEY (`idcaucho`) REFERENCES `sgu_caucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detalleRueda_sgu_detalleEje1` FOREIGN KEY (`iddetalleEje`) REFERENCES `sgu_detalleeje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detalleRueda_sgu_posicionRueda1` FOREIGN KEY (`idposicionRueda`) REFERENCES `sgu_posicionrueda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_detordneumatico`
--
ALTER TABLE `sgu_detordneumatico`
ADD CONSTRAINT `fk_sgu_detOrdNeumatico_sgu_detalleEventoCa1` FOREIGN KEY (`iddetalleEventoCa`) REFERENCES `sgu_detalleeventoca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detOrdNeumatico_sgu_ordenMtto1` FOREIGN KEY (`idordenMtto`) REFERENCES `sgu_ordenmtto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_detreccaucho`
--
ALTER TABLE `sgu_detreccaucho`
ADD CONSTRAINT `fk_sgu_detRecCaucho_sgu_detalleEventoCa1` FOREIGN KEY (`iddetalleEventoCa`) REFERENCES `sgu_detalleeventoca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detRecCaucho_sgu_recursoCaucho1` FOREIGN KEY (`idrecursoCaucho`) REFERENCES `sgu_recursocaucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_detRecCaucho_sgu_unidad1` FOREIGN KEY (`idunidad`) REFERENCES `sgu_unidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_empleado`
--
ALTER TABLE `sgu_empleado`
ADD CONSTRAINT `fk_sgu_empleado_sgu_tipoEmpleado1` FOREIGN KEY (`idtipoEmpleado`) REFERENCES `sgu_tipoempleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_factura`
--
ALTER TABLE `sgu_factura`
ADD CONSTRAINT `fk_sgu_factura_sgu_ordenMtto1` FOREIGN KEY (`idordenMtto`) REFERENCES `sgu_ordenmtto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_sgu_factura_sgu_proveedor1` FOREIGN KEY (`idproveedor`) REFERENCES `sgu_proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_foto`
--
ALTER TABLE `sgu_foto`
ADD CONSTRAINT `fk_SGU_foto_SGU_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_grupo`
--
ALTER TABLE `sgu_grupo`
ADD CONSTRAINT `fk_SGU_grupo_SGU_tipo1` FOREIGN KEY (`idtipo`) REFERENCES `sgu_tipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_historicocaucho`
--
ALTER TABLE `sgu_historicocaucho`
ADD CONSTRAINT `fk_sgu_historicoCaucho_sgu_asigChasis1` FOREIGN KEY (`idasigChasis`) REFERENCES `sgu_asigchasis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoCaucho_sgu_caucho1` FOREIGN KEY (`idcaucho`) REFERENCES `sgu_caucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoCaucho_sgu_detalleRueda1` FOREIGN KEY (`iddetalleRueda`) REFERENCES `sgu_detallerueda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoCaucho_sgu_estatusCaucho1` FOREIGN KEY (`idestatusCaucho`) REFERENCES `sgu_estatuscaucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoCaucho_sgu_marcaCaucho1` FOREIGN KEY (`idmarcaCaucho`) REFERENCES `sgu_marcacaucho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoCaucho_sgu_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_historicocombustible`
--
ALTER TABLE `sgu_historicocombustible`
ADD CONSTRAINT `fk_sgu_historicoCombustible_sgu_combust1` FOREIGN KEY (`idcombust`) REFERENCES `sgu_combust` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoCombustible_sgu_empleado1` FOREIGN KEY (`idconductor`) REFERENCES `sgu_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoCombustible_sgu_estacionServicio1` FOREIGN KEY (`idestacionServicio`) REFERENCES `sgu_estacionservicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoCombustible_sgu_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_historicoedos`
--
ALTER TABLE `sgu_historicoedos`
ADD CONSTRAINT `fk_SGU_historicoEdos_SGU_estado1` FOREIGN KEY (`idestado`) REFERENCES `sgu_estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_SGU_historicoEdos_SGU_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sgu_historicoempleados`
--
ALTER TABLE `sgu_historicoempleados`
ADD CONSTRAINT `fk_sgu_historicoEmpleados_sgu_empleado1` FOREIGN KEY (`idempleado`) REFERENCES `sgu_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoEmpleados_sgu_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sgu_historicoviajes`
--
ALTER TABLE `sgu_historicoviajes`
ADD CONSTRAINT `fk_sgu_historicoViajes_sgu_empleado1` FOREIGN KEY (`idconductor`) REFERENCES `sgu_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoViajes_sgu_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_historicoViajes_sgu_viaje1` FOREIGN KEY (`idviaje`) REFERENCES `sgu_viaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_infgrupo`
--
ALTER TABLE `sgu_infgrupo`
ADD CONSTRAINT `fk_sgu_infGrupo_sgu_grupo1` FOREIGN KEY (`idgrupo`) REFERENCES `sgu_grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_informacion`
--
ALTER TABLE `sgu_informacion`
ADD CONSTRAINT `fk_sgu_informacion_sgu_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_insumo`
--
ALTER TABLE `sgu_insumo`
ADD CONSTRAINT `fk_sgu_insumo_sgu_tipoInsumo1` FOREIGN KEY (`tipoInsumo`) REFERENCES `sgu_tipoinsumo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_kilometraje`
--
ALTER TABLE `sgu_kilometraje`
ADD CONSTRAINT `fk_sgu_kilometraje_sgu_historicoViajes1` FOREIGN KEY (`idhistoricoViajes`) REFERENCES `sgu_historicoviajes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_sgu_kilometraje_sgu_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sgu_lugar`
--
ALTER TABLE `sgu_lugar`
ADD CONSTRAINT `fk_sgu_lugar_sgu_estados1` FOREIGN KEY (`idestados`) REFERENCES `sgu_estados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_modelo`
--
ALTER TABLE `sgu_modelo`
ADD CONSTRAINT `fk_SGU_modelo_SGU_marca1` FOREIGN KEY (`idmarca`) REFERENCES `sgu_marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_ordenmtto`
--
ALTER TABLE `sgu_ordenmtto`
ADD CONSTRAINT `fk_sgu_ordenMtto_sgu_empleado1` FOREIGN KEY (`cOperativo`) REFERENCES `sgu_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_ordenMtto_sgu_empleado2` FOREIGN KEY (`cTaller`) REFERENCES `sgu_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_ordenMtto_sgu_estatus1` FOREIGN KEY (`idestatus`) REFERENCES `sgu_estatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_ordenMtto_sgu_proveedor1` FOREIGN KEY (`taller`) REFERENCES `sgu_proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_recursofalla`
--
ALTER TABLE `sgu_recursofalla`
ADD CONSTRAINT `fk_sgu_recursoFalla_sgu_insumo1` FOREIGN KEY (`idinsumo`) REFERENCES `sgu_insumo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_recursoFalla_sgu_reporteFalla1` FOREIGN KEY (`idreporteFalla`) REFERENCES `sgu_reportefalla` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_recursoFalla_sgu_repuesto1` FOREIGN KEY (`idrepuesto`) REFERENCES `sgu_repuesto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_recursoFalla_sgu_servicio1` FOREIGN KEY (`idservicio`) REFERENCES `sgu_servicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_recursoFalla_sgu_tiempo1` FOREIGN KEY (`idtiempo`) REFERENCES `sgu_tiempo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_recursoFalla_sgu_unidad1` FOREIGN KEY (`idunidad`) REFERENCES `sgu_unidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_reportefalla`
--
ALTER TABLE `sgu_reportefalla`
ADD CONSTRAINT `fk_sgu_reporteFalla_sgu_empleado1` FOREIGN KEY (`idempleado`) REFERENCES `sgu_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_reporteFalla_sgu_estatus1` FOREIGN KEY (`idestatus`) REFERENCES `sgu_estatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_reporteFalla_sgu_falla1` FOREIGN KEY (`idfalla`) REFERENCES `sgu_falla` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_reporteFalla_sgu_tiempo1` FOREIGN KEY (`idtiempo`) REFERENCES `sgu_tiempo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_reporteFalla_sgu_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `sgu_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_repuesto`
--
ALTER TABLE `sgu_repuesto`
ADD CONSTRAINT `fk_SGU_repuesto_SGU_subTipoRepuesto1` FOREIGN KEY (`idsubTipoRepuesto`) REFERENCES `sgu_subtiporepuesto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sgu_subtiporepuesto`
--
ALTER TABLE `sgu_subtiporepuesto`
ADD CONSTRAINT `fk_SGU_subTipoRepuesto_SGU_TipoRepuesto1` FOREIGN KEY (`idTipoRepuesto`) REFERENCES `sgu_tiporepuesto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sgu_vehiculo`
--
ALTER TABLE `sgu_vehiculo`
ADD CONSTRAINT `fk_SGU_vehiculo_SGU_color1` FOREIGN KEY (`idcolor`) REFERENCES `sgu_color` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_SGU_vehiculo_SGU_grupo1` FOREIGN KEY (`idgrupo`) REFERENCES `sgu_grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_SGU_vehiculo_SGU_modelo1` FOREIGN KEY (`idmodelo`) REFERENCES `sgu_modelo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_SGU_vehiculo_sgu_propiedad1` FOREIGN KEY (`idpropiedad`) REFERENCES `sgu_propiedad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_vehiculo_sgu_tipoCombustible1` FOREIGN KEY (`idcombustible`) REFERENCES `sgu_tipocombustible` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sgu_viaje`
--
ALTER TABLE `sgu_viaje`
ADD CONSTRAINT `fk_sgu_viaje_sgu_lugar1` FOREIGN KEY (`idOrigen`) REFERENCES `sgu_lugar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_viaje_sgu_lugar2` FOREIGN KEY (`idDestino`) REFERENCES `sgu_lugar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sgu_viaje_sgu_tipo1` FOREIGN KEY (`idtipo`) REFERENCES `sgu_tipoviaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
