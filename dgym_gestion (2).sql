-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2015 a las 21:03:42
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dgym_gestion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dieta`
--

CREATE TABLE IF NOT EXISTS `dieta` (
`id_dieta` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `funcion` text COLLATE utf8_bin NOT NULL,
  `descripcion` text COLLATE utf8_bin NOT NULL,
  `tabla` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `dieta`
--

INSERT INTO `dieta` (`id_dieta`, `nombre`, `funcion`, `descripcion`, `tabla`) VALUES
(1, 'Hidratos de carbono', 'Subir peso', 'En este campo se escribirá una descripción explicando los objetivos que buscamos aplicando esta dieta.', 'AAA'),
(2, 'Alta en proteínas', 'Marcar musculo', 'En este campo se escribirá una descripción explicando los objetivos que buscamos aplicando esta dieta.(2)', '<table border="1" cellpadding="1" cellspacing="1" style="width:500px"><tbody><tr><td>EJEMPLO</td><td>TABLA</td></tr><tr><td>1</td><td>2</td></tr><tr><td>3</td><td>4</td></tr></tbody></table><p>&nbsp;</p>'),
(3, 'Dieta limpia', 'Aprender a comer sano', 'En este campo se escribirá una descripción explicando los objetivos que buscamos aplicando esta dieta.(2)', '<table border="1" cellpadding="1" cellspacing="1" style="width:500px"> 	<tbody> 		<tr> 			<td>EJEMPLO</td> 			<td>TABLA</td> 		</tr> 		<tr> 			<td>1</td> 			<td>2</td> 		</tr> 		<tr> 			<td>3</td> 			<td>4</td> 		</tr> 	</tbody> </table>  <p>&nbsp;</p>'),
(4, 'Baja en calorias', 'Funcion de la dieta', 'Aquí se escribirá la descripción de la dieta.', '<table border="1" cellspacing="1" cellpadding="1" style="width: 500px;"><tbody><tr><td>aaaa</td><td>ssss</td></tr><tr><td>aaaa</td><td>aaa</td></tr><tr><td>ss</td><td>aaaa</td></tr></tbody></table><p><br></p>'),
(11, 'Estricta', 'jhkhjk', 'jkjjk', '<p>tujyujkktyukiuytk</p>'),
(12, 'Dieta fibra', 'Acelerar el metabolismo', 'daiofhnsdoifhnouishgvudsfshvugdhui', '<p>dfsfargfergre</p>'),
(16, 'Verde', 'sadfgasfgñ', 'ghgfgdfhñ', '<p>fdgdtsghretñ</p>'),
(17, 'Dieta 10', 'fff', 'rfrf', '<p>rf</p>'),
(19, 'Dieta Sana', 'Limpiar metabolismo', 'Eliminar toxinas del cuerpo basándose en una dieta rica en vegetales y baja en grasas.', '<table border="1" cellpadding="1" cellspacing="1" style="width:500px"><thead><tr><th scope="row">aaa</th><th scope="col">bbb</th><th scope="col">ccc</th><th scope="col">ddd</th><th scope="col">eee</th><th scope="col">fff</th></tr></thead><tbody><tr><th scope="row">1</th><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr><tr><th scope="row">2</th><td>6</td><td>7</td><td>8</td><td>9</td><td>0</td></tr><tr><th scope="row">3</th><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr><tr><th scope="row">4</th><td>6</td><td>7</td><td>8</td><td>9</td><td>0</td></tr></tbody></table><p><br></p>'),
(20, 'aaasa', 'aaaaa', 'sss', '<p><br></p>'),
(21, 'dsfsdfds', 'dfdffd', 'dfdfdf', '<p><br></p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamiento`
--

CREATE TABLE IF NOT EXISTS `entrenamiento` (
`id_entrenamiento` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_bin NOT NULL,
  `funcion` text COLLATE utf8_bin NOT NULL,
  `descripcion` text COLLATE utf8_bin NOT NULL,
  `tabla` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `entrenamiento`
--

INSERT INTO `entrenamiento` (`id_entrenamiento`, `nombre`, `funcion`, `descripcion`, `tabla`) VALUES
(3, 'Entrenamiento de fondo', 'Aumentar la resistencia', 'Descripción del entrenamiento de fondo Descripción del entrenamiento de fondo Descripción del entrenamiento de fondo Descripción del entrenamiento de fondo Descripción del entrenamiento de fondo Descripción del entrenamiento de fondo Descripción del entrenamiento de fondo Descripción del entrenamiento de fondo Descripción del entrenamiento de fondo ', '<table border="1" cellspacing="1" cellpadding="1" style="width: 500px;"><tbody><tr><td>aa</td><td><br></td></tr><tr><td><br></td><td>aa</td></tr><tr><td>aa</td><td><br></td></tr></tbody></table><p><br></p>'),
(4, 'Nuevo entrenamientoo', 'abc', 'abc', '<table border="1" cellspacing="1" cellpadding="1" style="width: 500px;"><tbody><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td>sds</td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td>dssd</td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td><td><br></td></tr></tbody></table><p><br></p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_usuarios`
--

CREATE TABLE IF NOT EXISTS `historial_usuarios` (
`id_historial_usuarios` int(11) NOT NULL,
  `evento` varchar(200) COLLATE utf8_bin NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=157 ;

--
-- Volcado de datos para la tabla `historial_usuarios`
--

INSERT INTO `historial_usuarios` (`id_historial_usuarios`, `evento`, `fecha`) VALUES
(4, 'admin(1) elimino a .', '2015-03-18'),
(5, 'admin(1) elimino a .', '2015-03-18'),
(6, 'admin(1) elimino a .', '2015-03-18'),
(7, 'admin(1) añadio a 123.', '2015-03-18'),
(8, 'admin(1) elimino a 54.', '2015-03-18'),
(9, 'admin(1) elimino a pp33444ipi.', '2015-03-18'),
(10, 'admin(1) elimino a Joaquin.', '2015-03-18'),
(12, 'Joaquin(55) elimino a sdfsdfsddsffd.', '2015-03-18'),
(13, 'Joaquin(55) elimino a iiifudhs.', '2015-03-18'),
(14, 'Joaquin(55) elimino a juanito.', '2015-03-18'),
(28, 'admin(1) elimino a usuario2.', '2015-03-30'),
(35, 'admin(1) elimino a 45.', '2015-04-11'),
(36, 'admin(1) elimino a we.', '2015-04-11'),
(37, 'admin(1) añadio a nuevisisimo.', '2015-04-11'),
(38, 'admin(1) elimino a nuevisisimo.', '2015-04-11'),
(41, 'admin(1) elimino a jajajajaj.', '2015-04-11'),
(43, 'admin(1) elimino a nuevoooo.', '2015-04-11'),
(44, 'admin(1) elimino a nuevo_administrador.', '2015-04-11'),
(45, 'admin(1) elimino a Joaquin Gomez.', '2015-04-11'),
(48, 'admin(1) elimino a merchi.', '2015-04-12'),
(49, 'admin(1) añadio a aaaaa.', '2015-04-12'),
(50, 'admin(1) añadio a aaaaaaaaa.', '2015-04-12'),
(51, 'admin(1) añadio a nuevo.', '2015-04-12'),
(52, 'admin(1) añadio a Joaquin Gomez.', '2015-04-12'),
(53, 'nuevo(63) añadio a asas.', '2015-04-12'),
(54, 'admin(1) elimino a nuevo.', '2015-04-12'),
(55, 'admin(1) añadio a nuevo.', '2015-04-12'),
(56, 'admin(1) elimino a asas.', '2015-04-13'),
(57, 'admin(1) elimino a nuevo.', '2015-04-13'),
(58, 'admin(1) elimino a dewded.', '2015-04-13'),
(59, 'admin(1) elimino a aaaaaaaaa.', '2015-04-13'),
(60, 'admin(1) elimino a nuevisimo.', '2015-04-13'),
(61, 'admin(1) añadio a 12.', '2015-04-13'),
(62, 'admin(1) elimino a 12.', '2015-04-13'),
(63, 'admin(1) añadio a aas.', '2015-04-13'),
(64, 'admin(1) elimino a aas.', '2015-04-13'),
(65, 'admin(1) elimino a aaaaa.', '2015-04-13'),
(66, 'admin(1) elimino a 1111112.', '2015-04-13'),
(67, 'admin(1) añadio a 123.', '2015-04-13'),
(68, 'admin(1) añadio a 3232.', '2015-04-13'),
(69, 'admin(1) añadio a 32313.', '2015-04-13'),
(70, 'admin(1) añadio a 123123.', '2015-04-13'),
(71, 'admin(1) añadio a 1.', '2015-04-13'),
(72, 'admin(1) añadio a 12333.', '2015-04-13'),
(73, 'admin(1) elimino a 1.', '2015-04-13'),
(74, 'admin(1) elimino a 12333.', '2015-04-13'),
(75, 'admin(1) elimino a 123123.', '2015-04-13'),
(76, 'admin(1) elimino a 32313.', '2015-04-13'),
(77, 'admin(1) elimino a 3232.', '2015-04-13'),
(78, 'admin(1) añadio a aaaaaaa.', '2015-04-13'),
(79, 'admin(1) elimino a aaaaaaa.', '2015-04-13'),
(80, 'admin(1) añadio a aaaaa.', '2015-04-13'),
(81, 'admin(1) añadio a aaa.', '2015-04-13'),
(82, 'admin(1) añadio a uuuuuu.', '2015-04-13'),
(83, 'admin(1) añadio a asdfadfds.', '2015-04-13'),
(84, 'admin(1) añadio a trtgrgrt.', '2015-04-13'),
(85, 'admin(1) añadio a sdasd.', '2015-04-13'),
(86, 'admin(1) elimino a sdasd.', '2015-04-13'),
(87, 'admin(1) elimino a trtgrgrt.', '2015-04-13'),
(88, 'admin(1) elimino a asdfadfds.', '2015-04-13'),
(89, 'admin(1) elimino a uuuuuu.', '2015-04-13'),
(90, 'admin(1) elimino a aaa.', '2015-04-13'),
(91, 'admin(1) añadio a dfgdf.', '2015-04-13'),
(92, 'admin(1) añadio a 454.', '2015-04-13'),
(93, 'admin(1) añadio a sdijiasdhj.', '2015-04-13'),
(94, 'admin(1) añadio a wewfrfr.', '2015-04-13'),
(95, 'admin(1) añadio a fff.', '2015-04-13'),
(96, 'admin(1) elimino a fff.', '2015-04-13'),
(97, 'admin(1) elimino a wewfrfr.', '2015-04-13'),
(98, 'admin(1) elimino a sdijiasdhj.', '2015-04-13'),
(99, 'admin(1) elimino a 454.', '2015-04-13'),
(100, 'admin(1) elimino a dfgdf.', '2015-04-13'),
(101, 'admin(1) añadio a eeee.', '2015-04-14'),
(102, 'admin(1) añadio a NUeeevo.', '2015-05-13'),
(103, 'admin(1) añadio a entrenador.', '2015-05-13'),
(104, 'admin(1) añadio a Jose García.', '2015-05-13'),
(105, 'admin(1) añadio a Antonio Perez.', '2015-05-13'),
(106, 'admin(1) añadio a Juan Ruiz.', '2015-05-13'),
(107, 'admin(1) añadio a .', '2015-05-13'),
(108, 'admin(1) añadio a " nombre ".', '2015-05-13'),
(109, 'admin(1) añadio a 3434.', '2015-05-13'),
(110, 'admin(1) añadio a joa.', '2015-05-13'),
(111, 'admin(1) añadio a Alfonso.', '2015-05-13'),
(112, 'admin(1) elimino a 3434.', '2015-05-13'),
(113, 'admin(1) elimino a joa.', '2015-05-13'),
(114, 'admin(1) añadio a Rafaél Fernández.', '2015-05-13'),
(115, 'admin(1) añadio a Raúl Alvarez.', '2015-05-13'),
(116, 'admin(1) elimino a aaaaa.', '2015-05-13'),
(117, 'admin(1) elimino a eeee.', '2015-05-13'),
(118, 'admin(1) elimino a NUeeevo.', '2015-05-13'),
(119, 'admin(1) elimino a 123.', '2015-05-13'),
(120, 'admin(1) añadio a Alejandro Paz.', '2015-05-13'),
(121, 'admin(1) elimino a ddddd.', '2015-05-13'),
(122, 'admin(1) elimino a aaaas.', '2015-05-13'),
(123, 'admin(1) elimino a Raúl Alvarez.', '2015-05-22'),
(124, 'admin(1) añadio a El nuevo.', '2015-05-25'),
(125, 'admin(1) añadio a asdf.', '2015-05-28'),
(126, 'admin(1) añadio a aaaaaaaaaaaaa.', '2015-05-28'),
(127, 'admin(1) añadio a asas.', '2015-05-28'),
(128, 'admin(1) añadio a 2222.', '2015-05-28'),
(129, 'admin(1) añadio a rrr.', '2015-05-28'),
(130, 'admin(1) añadio a rddsdsrr.', '2015-05-28'),
(131, 'admin(1) añadio a gsfgdfg.', '2015-05-28'),
(132, 'admin(1) añadio a sss.', '2015-05-28'),
(133, 'admin(1) añadio a nuuuuueee.', '2015-05-28'),
(134, 'admin(1) añadio a asasasasas.', '2015-05-28'),
(135, 'admin(1) añadio a pepito.', '2015-05-28'),
(136, 'admin(1) añadio a prueba fecha pago.', '2015-05-28'),
(137, 'admin(1) elimino a prueba fecha pago.', '2015-05-31'),
(138, 'admin(1) añadio a asd.', '2015-05-31'),
(139, 'admin(1) añadio a etrtret.', '2015-05-31'),
(140, 'admin(1) añadio a Juan Luis.', '2015-05-31'),
(141, 'admin(1) añadio a sssdes.', '2015-05-31'),
(142, 'admin(1) añadio a ttttt.', '2015-05-31'),
(143, 'admin(1) añadio a ooooooo.', '2015-05-31'),
(144, 'admin(1) añadio a Pedro Perez.', '2015-06-01'),
(145, 'admin(1) elimino a usuario.', '2015-06-01'),
(146, 'admin(1) elimino a usuario1.', '2015-06-01'),
(147, 'admin(1) añadio a usuario1.', '2015-06-01'),
(148, 'admin(1) añadio a usuario2.', '2015-06-01'),
(149, 'admin(1) añadio a usuario3.', '2015-06-01'),
(150, 'admin(1) elimino a usuario1.', '2015-06-01'),
(151, 'admin(1) elimino a Pedro Perez.', '2015-06-01'),
(152, 'admin(1) elimino a usuario2.', '2015-06-01'),
(153, 'admin(1) elimino a usuario3.', '2015-06-01'),
(154, 'admin(1) añadio a usuario1.', '2015-06-01'),
(155, 'admin(1) añadio a usuario2.', '2015-06-01'),
(156, 'admin(1) añadio a usuario3.', '2015-06-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
`id_pago` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id_pago`, `id_usuario`, `fecha_pago`, `fecha_vencimiento`) VALUES
(27, 105, '2015-06-01', '2015-07-01'),
(28, 106, '2015-06-01', '2015-07-01'),
(29, 107, '2015-06-01', '2015-07-01'),
(30, 107, '2015-07-01', '2015-08-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `contrasenna` varchar(100) COLLATE utf8_bin NOT NULL,
  `permiso` int(11) NOT NULL,
  `dni` varchar(9) COLLATE utf8_bin NOT NULL,
  `fecha_alta` date NOT NULL,
  `telefono` int(9) DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `altura` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8_bin DEFAULT 'foto_defecto.png',
  `dieta` int(255) NOT NULL,
  `entrenamiento` int(255) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `dentro` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=108 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `contrasenna`, `permiso`, `dni`, `fecha_alta`, `telefono`, `email`, `nacimiento`, `peso`, `altura`, `foto`, `dieta`, `entrenamiento`, `activo`, `dentro`) VALUES
(1, 'admin', '123', 0, '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, 'foto_defecto.png', 0, 0, 0, 0),
(58, 'entrenador1', '123', 1, '', '2015-04-11', 693614905, 'joaquin.gomez@gmail.com', NULL, NULL, NULL, 'foto_defecto.png', 0, 0, 0, 0),
(64, 'Joaquin Gomez', '123', 2, '28846042V', '2015-04-12', 954000000, 'joaquin.gomez@gmail.com', '2014-08-12', 73, '1,72', '1432829263-1432822992-1432822677-prueba.jpg', 16, 3, 1, 1),
(79, 'entrenador', '123', 1, '', '2015-05-13', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 0, 0),
(80, 'Jose García', 'jose123', 2, '69889651O', '2015-05-13', 658745454, 'josegarcia@gmail.com', '1990-12-12', 68, '1,80', 'foto_defecto.png', 3, 1, 0, 0),
(81, 'Antonio Perez', '456789', 2, '69741257E', '2015-05-13', 695474752, 'antoniperez@gmail.com', '1986-03-10', 82, '1,87', 'foto_defecto.png', 12, 3, 1, 0),
(82, 'Juan Ruiz', '444', 2, '45789632F', '2015-05-13', 635898754, 'juan@hotmail.com', '0000-00-00', 85, '1,77', 'avatar04.png', 3, 2, 0, 0),
(85, 'Alfonso', '555', 2, '55555555N', '2015-05-13', 698542154, 'alonso@gmail.com', '0000-00-00', 79, '1,80', 'foto_defecto.png', 11, 2, 0, 0),
(86, 'Rafaél Fernández', '456', 2, '69854785R', '2015-05-13', 698554692, 'rafa@gamil.com', '1978-03-22', 76, '1,86', 'foto_defecto.png', 3, 2, 1, 0),
(88, 'Alejandro Paz', 'ale123', 1, '85456988F', '2015-05-13', 987445123, 'alejandropaz@gmail.com', '1993-03-15', 79, '1,81', 'foto_defecto.png', 0, 0, 1, 0),
(89, 'El nuevo', '123', 2, '', '2015-05-25', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 16, 0, 1, 0),
(90, 'sss', 'ss', 2, '', '2015-05-28', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 1, 0),
(91, 'nuuuuueee', 'aa', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 0, 0),
(92, 'asasasasas', 'ss', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 1, 0),
(93, 'pepito', '22', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 0, 0),
(95, 'asd', 'aa', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 0, 0),
(96, 'etrtret', '44', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 1, 0),
(97, 'Juan Luis', '123', 2, '11', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 1, 0),
(98, 'sssdes', '22', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 1, 0),
(99, 'ttttt', '55', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 1, 0),
(100, 'ooooooo', '77', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 1, 0),
(105, 'usuario1', '123', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 1, 0),
(106, 'usuario2', '123', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 1, 0),
(107, 'usuario3', '123', 2, '', '0000-00-00', 0, '-', '0000-00-00', 0, '-', 'foto_defecto.png', 0, 0, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dieta`
--
ALTER TABLE `dieta`
 ADD PRIMARY KEY (`id_dieta`), ADD FULLTEXT KEY `tabla` (`tabla`);

--
-- Indices de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
 ADD PRIMARY KEY (`id_entrenamiento`);

--
-- Indices de la tabla `historial_usuarios`
--
ALTER TABLE `historial_usuarios`
 ADD PRIMARY KEY (`id_historial_usuarios`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
 ADD PRIMARY KEY (`id_pago`,`id_usuario`), ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dieta`
--
ALTER TABLE `dieta`
MODIFY `id_dieta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
MODIFY `id_entrenamiento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `historial_usuarios`
--
ALTER TABLE `historial_usuarios`
MODIFY `id_historial_usuarios` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
