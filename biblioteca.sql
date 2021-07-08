-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2021 a las 07:03:32
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control-biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL,
  `aut_autor` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id_autor`, `aut_autor`) VALUES
(2, 'Paul Celan'),
(3, 'Louis-Ferdinand Céline'),
(4, 'Miguel de Cervantes'),
(5, 'Geoffrey Chaucer'),
(6, 'carlos Altamirano'),
(11, 'Dante Alighieri'),
(12, 'Jane Austen'),
(13, 'Chinua Achebe'),
(14, 'Lewis Carroll'),
(15, 'SERGIO CASTRO'),
(16, 'CARL SAGAN'),
(17, 'J. R. R. Tolkien');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `cat_categoria` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `cat_categoria`) VALUES
(1, 'Matematicas'),
(3, 'Física'),
(4, 'Literatura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `id_editorial` int(11) NOT NULL,
  `edi_editorial` varchar(64) NOT NULL,
  `edi_pais` varchar(64) NOT NULL,
  `edi_ciudad` varchar(64) NOT NULL,
  `edi_detalle` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`id_editorial`, `edi_editorial`, `edi_pais`, `edi_ciudad`, `edi_detalle`) VALUES
(1, 'Alienta Editorial', 'Spain', 'Barcelona', 'Alienta Editorialadada'),
(5, 'Alfaguara', 'Spain', 'Madrid', 'Fue fundada en 1964 por el escritor Camilo José Cela, donde publicó algunas de sus obras y las de muchos escritores del momento.'),
(6, 'DESTINO', 'Spain', 'Barcelona', 'Destino convoca anualmente el Premio Nadal, galardón de gran prestigio que en sus más de sesenta años de historia ha reconocido novelas esenciales de la literatura española'),
(7, 'THE GALOBART BOOKS', 'Colombia', 'Bogotá', 'Somos una editorial que nace con el propósito de crear coffee table books para diferentes públicos. Porque son muchas las personas que coleccionan estas pequeñas obras de arte y muy distintas sus aspiraciones, anhelos y aficiones'),
(8, 'PLANETA', 'Spain', 'Barcelona', 'Editorial Planeta, embrión de lo que es hoy el Grupo Planeta, se fundó en 1945, hace más de sesenta años. Es la editorial de prestigio con mayor influencia en el mundo de habla hispana.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `id_ubicacion` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_editorial` int(11) NOT NULL,
  `lib_titulo` varchar(64) NOT NULL,
  `lib_year` mediumint(4) NOT NULL,
  `lib_edicion` varchar(64) NOT NULL,
  `lib_isbn` varchar(64) NOT NULL,
  `lib_estado` int(2) NOT NULL DEFAULT 1,
  `lib_descripcion` text DEFAULT NULL,
  `lib_portada` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `id_autor`, `id_ubicacion`, `id_categoria`, `id_editorial`, `lib_titulo`, `lib_year`, `lib_edicion`, `lib_isbn`, `lib_estado`, `lib_descripcion`, `lib_portada`) VALUES
(10, 13, 1, 4, 1, 'Todo se desmorona', 1958, '2010', '9788499082691', 0, 'La novela poscolonialista por excelencia: una de las grandes obras del siglo XX.\r\nLa tragedia personal y colectiva de un poderoso guerrero Ibo que ve cómo todo su mundo se viene abajo con la llegada del hombre blanco.', '611.jpeg'),
(14, 14, 2, 4, 5, 'LAS AVENTURAS DE ALICIA EN EL PAIS DE LAS MARAVILLAS', 1865, '2017', '9788498014167', 0, 'Desde el momento en que Alicia cae por la madriguera, esta fantástica aventura onírica, llena de personajes inolvidables, capta de inmediato la imaginación tanto de niños como de adultos.', '915.jpeg'),
(15, 4, 3, 4, 6, 'DON QUIJOTE DE LA MANCHA', 1605, '2019', '9788423355235', 2, 'En un lugar de la Mancha, de cuyo nombre no quiero acordarme, vivía no hace mucho un hidalgo de los de lanza ya olvidada, escudo antiguo, rocín flaco y galgo corredor.', '441.jpeg'),
(16, 15, 4, 1, 7, 'HISTORIA DE LAS MATEMATICAS', 2021, 'segunda', '9788412264982', 2, '', '828.jpeg'),
(17, 16, 5, 3, 8, 'COSMOS', 2004, 'primera', '9788408053040', 0, 'Cosmos trata de la ciencia en su contexto humano más amplio y explica cómo la ciencia y la civilización se desarrollan conjuntamente.', '139.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `pre_prestamo` int(11) NOT NULL,
  `pre_fechaPedido` datetime NOT NULL,
  `pre_fechaPrestamo` datetime DEFAULT NULL,
  `pre_fechaDevolucion` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `pre_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `pre_prestamo`, `pre_fechaPedido`, `pre_fechaPrestamo`, `pre_fechaDevolucion`, `id_usuario`, `id_libro`, `pre_estado`) VALUES
(7, 1, '2021-03-21 14:22:00', '2021-03-22 17:51:05', NULL, 5, 14, 0),
(8, 2, '2021-03-21 14:31:19', NULL, NULL, 5, 16, 4),
(9, 2, '2021-03-23 20:55:12', '2021-03-23 21:32:54', NULL, 5, 17, 0),
(22, 4, '2021-03-23 21:26:59', '2021-03-23 21:30:40', NULL, 5, 10, 0),
(23, 5, '2021-03-23 21:27:31', '2021-03-23 21:35:13', NULL, 5, 15, 3),
(24, 1, '2021-03-23 21:27:51', NULL, NULL, 5, 16, 1),
(25, 1, '2021-03-24 00:57:19', NULL, NULL, 6, 15, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id_ubicacion` int(11) NOT NULL,
  `ubi_percha` varchar(64) NOT NULL,
  `ubi_hilera` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id_ubicacion`, `ubi_percha`, `ubi_hilera`) VALUES
(1, 'primera', 'primera'),
(2, 'Primera', 'Segunda'),
(3, 'primera', 'Tercera'),
(4, 'Segunda', 'Primera'),
(5, 'Segunda', 'Segunda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usu_perfil` varchar(16) NOT NULL,
  `usu_nombre` varchar(256) NOT NULL,
  `usu_password` text NOT NULL,
  `usu_cedula` varchar(16) NOT NULL,
  `usu_celular` varchar(16) DEFAULT NULL,
  `usu_telefono` varchar(16) DEFAULT NULL,
  `usu_direccion` varchar(516) DEFAULT NULL,
  `usu_email` varchar(256) NOT NULL,
  `usu_activo` int(11) NOT NULL DEFAULT 0,
  `usu_emailEncriptado` varchar(516) NOT NULL,
  `usu_foto` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usu_perfil`, `usu_nombre`, `usu_password`, `usu_cedula`, `usu_celular`, `usu_telefono`, `usu_direccion`, `usu_email`, `usu_activo`, `usu_emailEncriptado`, `usu_foto`) VALUES
(1, 'admin', 'Admin', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', '0503301236', '(111) 111-1111', '(11) 111-1111', 'sadsdssssss', 'admin@gmail.com', 1, 'db1e0a3750e0399df3eeee808187d9b4', 'vistas/img/usuarios/1/921.jpeg'),
(5, 'usuario', 'Carlos Altamirano', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', '0503301236', '(222) 222-2222', '(22) 222-2222', 'kilometro 7 y medio la esperanza frente a la gasolinera en un cerramiento con pared blanca calle G y decima tercera casa color kkdasd', 'carlos0altamirano@gmail.com', 1, 'e8fb0d77f1af0e544ce48fcc48ec166e', 'vistas/img/usuarios/5/537.png'),
(6, 'usuario', 'usuario 2', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', '0503301244', NULL, NULL, NULL, 'usuario2@gmail.com', 1, '', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id_autor`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`id_editorial`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`),
  ADD UNIQUE KEY `lib_isbn` (`lib_isbn`),
  ADD KEY `id_autor` (`id_autor`),
  ADD KEY `id_ubicacion` (`id_ubicacion`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_editorial` (`id_editorial`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id_ubicacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `id_editorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id_ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `id_autor` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`),
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `id_editorial` FOREIGN KEY (`id_editorial`) REFERENCES `editoriales` (`id_editorial`),
  ADD CONSTRAINT `id_ubicacion` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicaciones` (`id_ubicacion`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `id_libro` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
