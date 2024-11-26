-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2023 a las 04:41:34
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
-- Base de datos: `ads_2023_2_g08`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `idproductoa` int(5) NOT NULL,
  `idproducto` int(5) DEFAULT NULL,
  `cantidad` int(5) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `tiempo_entrada_sistema` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idarticulo` int(5) NOT NULL COMMENT 'Identificador de la tabla Artículo',
  `nombre` varchar(30) DEFAULT NULL COMMENT 'Nombre del Artículo',
  `descripcion` varchar(250) DEFAULT NULL COMMENT 'Descripción del Artículo',
  `orden` int(5) DEFAULT 1 COMMENT 'Numero de Orden al momento de listar',
  `estado` char(1) DEFAULT 'A' COMMENT 'A: Activo, I:Inactivo',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora del sistema al momento de registrar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Categoría de Servicios';

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idarticulo`, `nombre`, `descripcion`, `orden`, `estado`, `fecha_hora_sistema`) VALUES
(1, 'Muebles', 'Sofás, camas, mesas, sillas, cómodas, armarios, estanterías, etc.', 2, 'A', '2023-09-25 22:55:37'),
(2, 'Electrodomésticos', 'Refrigeradores, lavadoras, secadoras, lavavajillas, hornos, microondas, etc.', 3, 'A', '2023-09-25 22:55:37'),
(3, 'Electrónica', 'Televisores, computadoras, equipos de sonido, reproductores de DVD, consolas de videojuegos, etc.', 4, 'A', '2023-09-25 22:59:02'),
(4, 'Artículos de Cocina', 'Utensilios de cocina, ollas, sartenes, platos, vasos, cubiertos, electrodomésticos pequeños, etc.', 5, 'A', '2023-09-25 22:59:02'),
(5, 'Ropa y Ropa de Cama', 'Ropa de cama, almohadas, edredones, ropa, calzado, etc.', 6, 'A', '2023-09-25 22:59:02'),
(6, 'Muebles Pequeños', 'Mesitas de noche, mesas de café, lámparas, espejos, etc.', 7, 'A', '2023-09-25 22:59:02'),
(7, 'Artículos de Decoración', 'Cuadros, esculturas, cortinas, alfombras, plantas de interior, etc.', 8, 'A', '2023-09-25 22:59:02'),
(8, 'Bienes Personales', 'Documentos importantes, joyas, fotografías, libros, recuerdos, etc.', 9, 'A', '2023-09-25 22:59:02'),
(9, 'Artículos de Jardinería', 'Herramientas de jardín, macetas, muebles de patio, parrillas, etc.', 10, 'A', '2023-09-25 22:59:02'),
(10, 'Objetos Frágiles', 'Cristalería, vajilla, espejos, lámparas de cristal, artículos coleccionables, etc.', 11, 'A', '2023-09-25 22:59:02'),
(11, 'Recursos Mi Mudanza Top', 'Recursos que son requeridos para brindar el servicio de mudanza. No son Artículos', 1, 'A', '2023-09-30 19:49:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `idcategoria` int(5) NOT NULL COMMENT 'Identificador de la tabla Categoría',
  `nombre` varchar(30) DEFAULT NULL COMMENT 'Nombre de la Categoría',
  `descripcion` varchar(250) DEFAULT NULL COMMENT 'Descripción de la categoría',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora del sistema al momento de registrar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Categoría de Productos';

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`idcategoria`, `nombre`, `descripcion`, `fecha_hora_sistema`) VALUES
(1, 'Servicios de Transporte', 'Camiones y vehículos de transporte.\r\nCombustible y mantenimiento de flota.\r\nSeguros de transporte de mercancías.', '2023-09-03 19:50:22'),
(2, 'Materiales de Embalaje', 'Cajas de cartón de varios tamaños.\r\nPapel de embalaje y envoltura de burbujas.\r\nCintas adhesivas y etiquetas.', '2023-09-03 19:50:22'),
(3, 'Equipos de Manipulación', 'Carretillas y carros de mano.\r\nElevadores y montacargas.\r\nCorreas y arneses de carga.', '2023-09-03 19:50:22'),
(4, 'Personal de Trabajo', 'Conductores y operadores de vehículos.\r\nEquipo de carga y descarga.\r\nPersonal de embalaje y desembalaje.', '2023-09-03 19:50:22'),
(5, 'Almacenamiento Temporal', 'Almacenes o depósitos para almacenamiento temporal.\r\nSistemas de seguridad y vigilancia.\r\nEstanterías y paletas de almacenamiento.', '2023-09-03 19:50:22'),
(6, 'Tecnología y Software', 'Software de gestión de mudanzas y logística.\r\nEquipos de comunicación y seguimiento de flota.\r\nDispositivos de registro y facturación.', '2023-09-03 19:50:22'),
(7, 'Seguro y Responsabilidad Civil', 'Seguro de responsabilidad civil para la empresa.\r\nPólizas de seguro de mercancías y propiedad.\r\nSeguro de accidentes laborales.', '2023-09-03 19:50:22'),
(8, 'Material de Oficina y Administ', 'Muebles de oficina y equipo informático.\r\nSuministros de oficina (papel, bolígrafos, etc.).\r\nSoftware de contabilidad y gestión financiera.', '2023-09-03 19:50:22'),
(9, 'Marketing y Publicidad', 'Diseño de logotipo y materiales de marca.\r\nPublicidad en línea y campañas de marketing.\r\nFolletos y material promocional.', '2023-09-03 19:50:22'),
(10, 'Entrenamiento y Certificacione', 'Capacitación para el personal en técnicas de embalaje y carga.\r\nCertificaciones de seguridad y cumplimiento normativo.\r\nEntrenamiento en servicio al cliente y gestión de quejas.', '2023-09-03 19:50:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_servicio`
--

CREATE TABLE `categoria_servicio` (
  `idcategoria` int(5) NOT NULL COMMENT '	Identificador de la tabla Categoría',
  `nombre` varchar(10) DEFAULT NULL COMMENT 'Nombre de la Categoría',
  `descripcion` varchar(300) DEFAULT NULL COMMENT 'Descripción de la categoría',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora del sistema al momento de registrar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categoria_servicio`
--

INSERT INTO `categoria_servicio` (`idcategoria`, `nombre`, `descripcion`, `fecha_hora_sistema`) VALUES
(1, 'NORMAL', 'Servicio de categoria normal el cual no incluye servicios adicionales como el embalaje', '2023-10-12 19:13:30'),
(2, 'PREMIUM', 'Servicio de categoria premium el cual incluye incluido el servicio de embalaje', '2023-10-12 19:13:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(5) NOT NULL COMMENT 'Identificador de la tabla cliente',
  `tipo_persona` char(1) DEFAULT NULL COMMENT 'N: Natural, J: Juridico',
  `nombre` varchar(150) DEFAULT NULL COMMENT 'Nombre del cliente',
  `tipo_documento` varchar(3) DEFAULT NULL COMMENT 'RUC; DNI; CE',
  `numero_documento` int(11) DEFAULT NULL COMMENT 'Nro. Documento DNI(8), RUC(11)',
  `direccion` varchar(150) DEFAULT NULL COMMENT 'Dirección del cliente',
  `telefono` varchar(25) DEFAULT NULL COMMENT 'Teléfonos del cliente, separados por comas',
  `correo` varchar(50) DEFAULT NULL COMMENT 'correo electrónico del cliente',
  `estado` char(1) DEFAULT NULL COMMENT 'A: Activo; I:Inactivo',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'YYYY-MM-DD HH:MM:SS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `tipo_persona`, `nombre`, `tipo_documento`, `numero_documento`, `direccion`, `telefono`, `correo`, `estado`, `fecha_hora_sistema`) VALUES
(1, 'N', 'Manuel Chávez Castro', 'DNI', 7963210, 'Jr. Jose Galvez 2000 - Lince', '987654321, (01)4235555', 'manuel@pucp.pe', 'A', '2022-08-31 04:24:47'),
(2, 'J', 'Pontificia Universidad Católica del Perú', 'RUC', 2147483647, 'Av. Riva Aguero 1313 - San Miguel', '(01)6035555', 'webmaster@pucp.pe', 'A', '2022-08-31 04:26:14'),
(3, 'N', 'David Allasi', 'DNI', 87654321, 'Av. Los Heroes 2000 - Miraflores', '965784321, (01)5435555', 'david@pucp.pe', 'A', '2022-08-31 04:28:32'),
(4, 'J', 'Grupo Interbank', 'RUC', 2147483647, 'Av. Lima 113 - San Isidro', '(01)7735555', 'webmaster@interbank.pe', 'A', '2022-08-31 04:28:32'),
(5, 'N', 'Juan Perez', 'DNI', 81498423, 'Av. Lima 507', '987654321', 'juan.perez@gmail.com', 'I', '2023-09-28 22:22:58'),
(6, 'J', 'Distribuidora Quipu SAC', 'RUC', 2087654321, 'Calle Residencial 567', '(01)5427513 ', 'ventas@distribuidoraquipu.com', 'A', '2023-09-28 22:28:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato de servicios`
--

CREATE TABLE `contrato de servicios` (
  `id_contrato` int(11) NOT NULL COMMENT 'numero de contrato',
  `id_cliente` int(11) DEFAULT NULL COMMENT 'cliente ',
  `fecha_inicio_contrato` date DEFAULT NULL COMMENT 'fecha de firma de contrato',
  `fecha_finalizacion_contrato` date DEFAULT NULL COMMENT 'fecha de fin del contrato',
  `tipo_servicio` varchar(50) DEFAULT NULL COMMENT 'tipo de servicio a contratar',
  `detalles_servicio` text DEFAULT NULL COMMENT 'detalle del servicio en especifico',
  `costo_servicio` decimal(10,0) DEFAULT NULL COMMENT 'costo total del servicio',
  `terminios_condiciones` text DEFAULT NULL COMMENT 'clausulas ',
  `estado` varchar(11) DEFAULT NULL COMMENT 'APROBADO O RECHAZADO',
  `fecha_sistema` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `contrato de servicios`
--

INSERT INTO `contrato de servicios` (`id_contrato`, `id_cliente`, `fecha_inicio_contrato`, `fecha_finalizacion_contrato`, `tipo_servicio`, `detalles_servicio`, `costo_servicio`, `terminios_condiciones`, `estado`, `fecha_sistema`) VALUES
(1, 123456, '2023-09-04', '2023-10-04', 'mudanza por partes', 'se realizo una mudanza de un duplex ubicado en jesus maria hasta la molina', 5000, 'leer contrato', 'realizado', '2023-10-13 07:22:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `idcotizacion` int(5) NOT NULL COMMENT 'Identificador de la tabla cotizacion',
  `idservicio` int(5) DEFAULT NULL COMMENT 'Identificador de la tabla servicio',
  `idcliente` int(5) DEFAULT NULL COMMENT 'Identificador de la tabla cliente',
  `nombre` varchar(30) DEFAULT NULL COMMENT 'Nombre del solicitante',
  `origen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Dirección de origen de la mudanza',
  `destino` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Direccion de destino de la mudanza',
  `fecha_cotizacion` timestamp NULL DEFAULT current_timestamp() COMMENT 'YYYY-MM-DD HH:MM:SS',
  `estado_cotizacion` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'P: pendiente, A: aceptada, R: rechazada',
  `descripcion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Detalles específicos sobre la mudanza'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`idcotizacion`, `idservicio`, `idcliente`, `nombre`, `origen`, `destino`, `fecha_cotizacion`, `estado_cotizacion`, `descripcion`) VALUES
(1, 1, 5, 'Juan Perez', 'Av. Lima 507', 'Av. Tupac Amaru ', '2023-09-28 23:01:26', 'A', 'Se requiere una mudanza de tipo residencial, tener especial cuidado con los electrodomesticos.'),
(2, 2, 6, 'Distribuidora Quipu SAC', 'Av. Mercurio 321', 'Av. Marte 567', '2023-10-13 19:14:17', 'A', 'Mudanza de un local a otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion_os`
--

CREATE TABLE `gestion_os` (
  `idventa` int(5) NOT NULL COMMENT 'idventa',
  `cliente` varchar(30) DEFAULT NULL COMMENT 'cliente que requiere el servicio',
  `nombre` varchar(50) DEFAULT NULL COMMENT 'nombre del tipo de servicio brindado',
  `origen` varchar(100) DEFAULT NULL COMMENT 'origen del servicio',
  `destino` varchar(100) DEFAULT NULL COMMENT 'destino del servicio',
  `fecha_documento` date DEFAULT NULL COMMENT 'fecha de servicio ingresado',
  `comentarios` varchar(500) DEFAULT NULL COMMENT 'comentarios de la mudanza',
  `estado` varchar(10) DEFAULT NULL COMMENT 'REALIZADO\r\nNO REALIZADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `gestion_os`
--

INSERT INTO `gestion_os` (`idventa`, `cliente`, `nombre`, `origen`, `destino`, `fecha_documento`, `comentarios`, `estado`) VALUES
(1, 'Manuel Chávez Castro', 'Mudanza a larga distancia plus', 'Panamericana sur Km 38, Punta Hermosa', 'Calle Río Cenepa 107, La Molina', '2023-10-04', 'Movilizar los artículos con cuidado, ponerlos de forma horizontal, antes de llegar al destino llamar a encargado.', 'REALIZADO'),
(2, 'Juan Perez', 'Mudanza residencial', 'Av. Lima 507', 'Av. Tupac Amaru ', '2023-10-12', 'Se requiere una mudanza de tipo residencial, tener especial cuidado con los electrodomesticos.', 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `idinsumo` int(5) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL COMMENT 'Descripción del insumo',
  `marca` varchar(30) DEFAULT NULL,
  `unidad` varchar(6) DEFAULT NULL COMMENT 'Unidad de medida del insumo',
  `estado` char(1) DEFAULT NULL COMMENT '1: Disponible / 2: Fuera de stock',
  `comentario` varchar(200) DEFAULT NULL COMMENT 'Comentario adicional del producto',
  `fecha_hora_sistema` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mudanza`
--

CREATE TABLE `mudanza` (
  `idregistro` int(5) NOT NULL COMMENT 'id del registro',
  `idservicio` int(5) DEFAULT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'nombre del servicio',
  `etapas` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'detalles del servicio brindado',
  `incidentes` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'posibles incidentes '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mudanza`
--

INSERT INTO `mudanza` (`idregistro`, `idservicio`, `nombre`, `etapas`, `incidentes`) VALUES
(2, 11, 'Embalaje con papel', '1º Registro de artículos\r\n2º Selección de cantidad de papel a utilizar\r\n3º Proceso de embalaje con papel', 'Artículo dañado\r\nArtículo roto\r\nArtículos mal embalado\r\nFalta de material para embalar'),
(3, 10, 'Embalaje con plástico', '1º Registro de artículos\r\n2º Selección de cantidad de plástico a utilizar\r\n3º Proceso de embalaje con plástico', 'Artículo dañado\r\nArtículo roto\r\nArtículos mal embalado\r\nFalta de material para embalar'),
(4, 1, 'Mudanza residencial', '1º Preparación de artículos\r\n2º Recolección de artículos\r\n3º Aseguramiento de artículos\r\n3º Transporte hacia dirección\r\n4º Entrega de artículos\r\n5º Verificación de números de artículos', 'Artículo dañado\r\nArtículo roto\r\nDirección incorrecta\r\nChoque contra otro carro\r\nFalta de capacidad del vehículo\r\nMal acondicionamiento de artículos\r\nFalta de herramientas para el transporte'),
(5, 5, 'Mudanza residencial plus', '1º Preparación de artículos\r\n2º Selección de cantidad de material a utilizar\r\n3º Proceso de embalaje con material indicado\r\n4º Recolección de artículos\r\n5º Aseguramiento de artículos\r\n6º Transporte hacia dirección\r\n7º Entrega de artículos\r\n8º Verificación de números de artículos', 'Artículo dañado\r\nArtículo roto\r\nDirección incorrecta\r\nChoque contra otro carro\r\nFalta de capacidad del vehículo\r\nMal acondicionamiento de artículos\r\nFalta de herramientas para el transporte'),
(6, 3, 'Mudanza a larga distancia', '1º Preparación de artículos\r\n2º Recolección de artículos\r\n3º Aseguramiento de artículos\r\n3º Transporte hacia dirección\r\n4º Entrega de artículos\r\n5º Verificación de números de artículos', '\r\nArtículo dañado\r\nArtículo roto\r\nDirección incorrecta\r\nChoque contra otro carro\r\nFalta de capacidad del vehículo\r\nMal acondicionamiento de artículos\r\nFalta de herramientas para el transporte\r\nAusencia de gasolina suficiente para el traslado'),
(7, 7, 'Mudanza a larga distancia plus', '1º Preparación de artículos\r\n2º Selección de cantidad de material a utilizar\r\n3º Proceso de embalaje con material indicado\r\n4º Recolección de artículos\r\n5º Aseguramiento de artículos\r\n6º Transporte hacia dirección\r\n7º Entrega de artículos\r\n8º Verificación de números de artículos', 'Artículo dañado\r\nArtículo roto\r\nDirección incorrecta\r\nChoque contra otro carro\r\nFalta de capacidad del vehículo\r\nMal acondicionamiento de artículos\r\nFalta de herramientas para el transporte\r\nFalta de gasolina suficiente para traslado'),
(8, 2, 'Mudanzas comerciales', '1º Preparación de artículos\r\n4º Recolección de artículos\r\n5º Aseguramiento de artículos\r\n6º Transporte hacia dirección\r\n7º Entrega de artículos\r\n8º Verificación de números de artículos', 'Artículo dañado\r\nArtículo roto\r\nDirección incorrecta\r\nChoque contra otro carro\r\nFalta de capacidad del vehículo\r\nMal acondicionamiento de artículos\r\nFalta de herramientas para el transporte\r\nProblemas con documentación del local'),
(9, 6, 'Mudanzas comerciales plus', '1º Preparación de artículos\r\n2º Selección de cantidad de material a utilizar\r\n3º Proceso de embalaje con material indicado\r\n4º Recolección de artículos\r\n5º Aseguramiento de artículos\r\n6º Transporte hacia dirección\r\n7º Entrega de artículos\r\n8º Verificación de números de artículos', 'Artículo dañado\r\nArtículo roto\r\nDirección incorrecta\r\nChoque contra otro carro\r\nFalta de capacidad del vehículo\r\nMal acondicionamiento de artículos\r\nFalta de herramientas para el transporte\r\nProblemas con documentación del local'),
(10, 4, 'Mudanza de carga pesada', '1º Preparación de artículos\r\n2º Recolección de artículos\r\n3º Aseguramiento de artículos\r\n3º Transporte hacia dirección\r\n4º Entrega de artículos\r\n5º Verificación de números de artículos', 'Artículo dañado\r\nArtículo roto\r\nDirección incorrecta\r\nChoque contra otro carro\r\nFalta de capacidad del vehículo\r\nMal acondicionamiento de artículos\r\nFalta de herramientas para el transporte\r\nInmovilización del vehículo por exceso de carga'),
(11, 8, 'Mudanza de carga pesada plus', '1º Preparación de artículos\r\n2º Selección de cantidad de material a utilizar\r\n3º Proceso de embalaje con material indicado\r\n4º Recolección de artículos\r\n5º Aseguramiento de artículos\r\n6º Transporte hacia dirección\r\n7º Entrega de artículos\r\n8º Verificación de números de artículos', 'Artículo dañado\r\nArtículo roto\r\nDirección incorrecta\r\nChoque contra otro carro\r\nFalta de capacidad del vehículo\r\nMal acondicionamiento de artículos\r\nFalta de herramientas para el transporte\r\nInmovilización del vehículo por exceso de carga'),
(12, 9, 'Embalaje con cartón', '1º Registro de artículos\r\n2º Selección de cantidad de cartón a utilizar\r\n3º Proceso de embalaje con cartón', 'Artículo dañado\r\nArtículo roto\r\nArtículos mal embalado\r\nFalta de material para embalar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `idcompra` int(5) NOT NULL,
  `idproveedor` int(5) DEFAULT NULL,
  `proveedor` varchar(200) DEFAULT NULL,
  `ruc` varchar(11) DEFAULT NULL,
  `id_insumo` int(5) DEFAULT NULL,
  `cantidad` int(5) DEFAULT NULL,
  `comentario` varchar(200) DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `arancel` varchar(3) DEFAULT NULL,
  `fecha_hora_sistema` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_servicio`
--

CREATE TABLE `orden_servicio` (
  `idordenservicio` int(5) NOT NULL COMMENT 'Identificador de la Orden de Servicio',
  `idusuario` int(5) DEFAULT NULL COMMENT 'Identificador de la tabla Usuario',
  `idcliente` int(5) DEFAULT NULL COMMENT 'Identificador de la tabla cliente',
  `idservicio` int(5) DEFAULT NULL COMMENT 'Identificador de la tabla Servicio',
  `fecha_orden` date DEFAULT NULL COMMENT 'Fecha de Orden de Servicio',
  `ubicacion_origen` varchar(200) DEFAULT NULL COMMENT 'Ubicación de donde parte el servicio',
  `ubicacion_destino` varchar(200) DEFAULT NULL COMMENT 'Ubicación a donde llega el servicio',
  `observacion` varchar(250) DEFAULT NULL COMMENT 'Observaciones',
  `costo_orden` decimal(10,2) DEFAULT NULL COMMENT 'Costo del servicio',
  `porcentaje_ganancia` decimal(10,2) DEFAULT NULL COMMENT 'Porcentaje de Ganancia',
  `total` decimal(10,2) DEFAULT NULL COMMENT 'Total del servicio',
  `estado` char(1) DEFAULT NULL COMMENT 'A: Activo; I:Inactivo',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'YYYY-MM-DD HH:MM:SS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `orden_servicio`
--

INSERT INTO `orden_servicio` (`idordenservicio`, `idusuario`, `idcliente`, `idservicio`, `fecha_orden`, `ubicacion_origen`, `ubicacion_destino`, `observacion`, `costo_orden`, `porcentaje_ganancia`, `total`, `estado`, `fecha_hora_sistema`) VALUES
(1, 1, 1, 6, '2023-09-30', 'Lince', 'SJL', 'Ninguno', 80810.80, 30.00, 105054.04, 'A', '2023-09-30 17:54:35'),
(2, 1, 4, 7, '2023-10-01', 'San Miguel', 'San Borja', '', 1945.00, 30.00, 2528.50, 'A', '2023-09-30 20:58:33'),
(3, 1, 4, 6, '2023-10-03', 'San Miguel', 'La Molina', 'Desde la PUCP', 2078.00, 30.00, 2701.40, 'A', '2023-10-03 22:51:25'),
(4, 3, 4, 7, '2023-01-01', '1', '1', 'Observaciones de la orden', 24.31, 9.21, 26.55, 'A', '2023-10-15 22:09:50'),
(5, 3, 4, 3, '2023-02-01', '1', '1', 'Observaciones de la orden', 19.15, 11.71, 21.39, 'A', '2023-10-15 22:09:50'),
(6, 3, 3, 3, '2023-03-01', '1', '1', 'Observaciones de la orden', 398.17, 13.25, 0.00, 'A', '2023-10-15 22:09:50'),
(7, 3, 1, 1, '2023-04-01', '1', '1', 'Observaciones de la orden', 291.02, 5.68, 0.00, 'A', '2023-10-15 22:09:50'),
(8, 1, 2, 2, '2023-05-01', '1', '1', 'Observaciones de la orden', 123.30, 16.34, 0.00, 'A', '2023-10-15 22:09:50'),
(9, 4, 2, 4, '2023-06-01', '1', '1', 'Observaciones de la orden', 382.90, 14.40, 0.00, 'A', '2023-10-15 22:09:50'),
(10, 1, 1, 7, '2023-07-01', '1', '1', 'Observaciones de la orden', 154.22, 10.24, 0.00, 'A', '2023-10-15 22:09:50'),
(11, 1, 1, 1, '2023-08-01', '1', '1', 'Observaciones de la orden', 273.61, 1.42, 0.00, 'A', '2023-10-15 22:09:50'),
(12, 1, 4, 3, '2023-09-01', '1', '1', 'Observaciones de la orden', 327.69, 4.01, 0.00, 'A', '2023-10-15 22:09:50'),
(13, 2, 4, 1, '2023-10-01', '1', '1', 'Observaciones de la orden', 110.05, 8.28, 0.00, 'A', '2023-10-15 22:09:50'),
(14, 3, 1, 1, '2023-11-01', '1', '1', 'Observaciones de la orden', 283.78, 14.59, 0.00, 'A', '2023-10-15 22:09:50'),
(15, 4, 4, 1, '2023-12-01', '1', '1', 'Observaciones de la orden', 159.58, 4.82, 0.00, 'A', '2023-10-15 22:09:50'),
(16, 3, 1, 3, '2023-01-01', '1', '1', 'Observaciones de la orden', 255.35, 9.99, 0.00, 'A', '2023-10-15 22:11:40'),
(17, 4, 2, 7, '2023-02-01', '1', '1', 'Observaciones de la orden', 394.84, 11.21, 0.00, 'A', '2023-10-15 22:11:40'),
(18, 1, 1, 5, '2023-03-01', '1', '1', 'Observaciones de la orden', 141.50, 7.52, 0.00, 'A', '2023-10-15 22:11:40'),
(19, 4, 4, 7, '2023-04-01', '1', '1', 'Observaciones de la orden', 334.72, 14.84, 0.00, 'A', '2023-10-15 22:11:40'),
(20, 4, 2, 5, '2023-05-01', '1', '1', 'Observaciones de la orden', 120.48, 6.08, 0.00, 'A', '2023-10-15 22:11:40'),
(21, 4, 4, 1, '2023-06-01', '1', '1', 'Observaciones de la orden', 197.52, 2.65, 0.00, 'A', '2023-10-15 22:11:40'),
(22, 1, 2, 6, '2023-07-01', '1', '1', 'Observaciones de la orden', 320.11, 0.48, 0.00, 'A', '2023-10-15 22:11:40'),
(23, 3, 1, 3, '2023-08-01', '1', '1', 'Observaciones de la orden', 399.59, 17.00, 0.00, 'A', '2023-10-15 22:11:40'),
(24, 4, 3, 6, '2023-09-01', '1', '1', 'Observaciones de la orden', 284.86, 16.00, 0.00, 'A', '2023-10-15 22:11:40'),
(25, 4, 3, 2, '2023-10-01', '1', '1', 'Observaciones de la orden', 177.59, 9.73, 0.00, 'A', '2023-10-15 22:11:40'),
(26, 1, 1, 2, '2023-11-01', '1', '1', 'Observaciones de la orden', 114.80, 18.05, 0.00, 'A', '2023-10-15 22:11:40'),
(27, 4, 4, 4, '2023-12-01', '1', '1', 'Observaciones de la orden', 157.11, 11.66, 0.00, 'A', '2023-10-15 22:11:40'),
(28, 4, 2, 1, '2023-01-01', '1', '1', 'Observaciones de la orden', 248.09, 0.95, 0.00, 'A', '2023-10-15 22:11:55'),
(29, 2, 3, 3, '2023-02-01', '1', '1', 'Observaciones de la orden', 436.83, 0.49, 0.00, 'A', '2023-10-15 22:11:55'),
(30, 2, 4, 2, '2023-03-01', '1', '1', 'Observaciones de la orden', 114.12, 7.43, 0.00, 'A', '2023-10-15 22:11:55'),
(31, 3, 3, 3, '2023-04-01', '1', '1', 'Observaciones de la orden', 307.35, 15.81, 0.00, 'A', '2023-10-15 22:11:55'),
(32, 4, 4, 3, '2023-05-01', '1', '1', 'Observaciones de la orden', 220.49, 13.74, 0.00, 'A', '2023-10-15 22:11:55'),
(33, 3, 1, 4, '2023-06-01', '1', '1', 'Observaciones de la orden', 117.54, 4.95, 0.00, 'A', '2023-10-15 22:11:55'),
(34, 1, 1, 2, '2023-07-01', '1', '1', 'Observaciones de la orden', 144.65, 9.25, 0.00, 'A', '2023-10-15 22:11:55'),
(35, 3, 2, 2, '2023-08-01', '1', '1', 'Observaciones de la orden', 129.84, 1.89, 0.00, 'A', '2023-10-15 22:11:55'),
(36, 1, 2, 6, '2023-09-01', '1', '1', 'Observaciones de la orden', 361.47, 8.95, 0.00, 'A', '2023-10-15 22:11:55'),
(37, 2, 3, 1, '2023-10-01', '1', '1', 'Observaciones de la orden', 133.56, 17.82, 0.00, 'A', '2023-10-15 22:11:55'),
(38, 4, 3, 5, '2023-11-01', '1', '1', 'Observaciones de la orden', 161.62, 11.87, 0.00, 'A', '2023-10-15 22:11:55'),
(39, 3, 2, 4, '2023-12-01', '1', '1', 'Observaciones de la orden', 137.75, 2.04, 0.00, 'A', '2023-10-15 22:11:55'),
(40, 3, 4, 5, '2023-01-01', '1', '1', 'Observaciones de la orden', 324.05, 16.68, 0.00, 'A', '2023-10-15 22:11:56'),
(41, 2, 2, 4, '2023-02-01', '1', '1', 'Observaciones de la orden', 226.45, 5.49, 0.00, 'A', '2023-10-15 22:11:56'),
(42, 3, 1, 6, '2023-03-01', '1', '1', 'Observaciones de la orden', 461.88, 17.14, 0.00, 'A', '2023-10-15 22:11:56'),
(43, 4, 3, 3, '2023-04-01', '1', '1', 'Observaciones de la orden', 456.55, 7.49, 0.00, 'A', '2023-10-15 22:11:56'),
(44, 3, 3, 2, '2023-05-01', '1', '1', 'Observaciones de la orden', 358.87, 15.66, 0.00, 'A', '2023-10-15 22:11:57'),
(45, 3, 3, 1, '2023-06-01', '1', '1', 'Observaciones de la orden', 257.83, 0.17, 0.00, 'A', '2023-10-15 22:11:57'),
(46, 3, 3, 5, '2023-07-01', '1', '1', 'Observaciones de la orden', 177.78, 17.49, 0.00, 'A', '2023-10-15 22:11:57'),
(47, 3, 1, 7, '2023-08-01', '1', '1', 'Observaciones de la orden', 419.72, 7.44, 0.00, 'A', '2023-10-15 22:11:57'),
(48, 1, 3, 4, '2023-09-01', '1', '1', 'Observaciones de la orden', 327.37, 7.18, 0.00, 'A', '2023-10-15 22:11:57'),
(49, 1, 2, 5, '2023-10-01', '1', '1', 'Observaciones de la orden', 196.02, 18.74, 0.00, 'A', '2023-10-15 22:11:57'),
(50, 2, 2, 4, '2023-11-01', '1', '1', 'Observaciones de la orden', 296.22, 5.45, 0.00, 'A', '2023-10-15 22:11:57'),
(51, 4, 3, 3, '2023-12-01', '1', '1', 'Observaciones de la orden', 364.42, 16.37, 0.00, 'A', '2023-10-15 22:11:57'),
(52, 2, 3, 7, '2023-01-01', '1', '1', 'Observaciones de la orden', 142.57, 4.56, 0.00, 'A', '2023-10-15 23:04:45'),
(53, 1, 2, 6, '2023-02-01', '1', '1', 'Observaciones de la orden', 385.85, 14.27, 0.00, 'A', '2023-10-15 23:04:45'),
(54, 2, 1, 1, '2023-03-01', '1', '1', 'Observaciones de la orden', 277.16, 8.47, 0.00, 'A', '2023-10-15 23:04:45'),
(55, 2, 3, 5, '2023-04-01', '1', '1', 'Observaciones de la orden', 312.66, 19.69, 0.00, 'A', '2023-10-15 23:04:45'),
(56, 3, 1, 2, '2023-05-01', '1', '1', 'Observaciones de la orden', 223.16, 0.55, 0.00, 'A', '2023-10-15 23:04:45'),
(57, 2, 2, 3, '2023-06-01', '1', '1', 'Observaciones de la orden', 392.10, 10.48, 0.00, 'A', '2023-10-15 23:04:45'),
(58, 1, 4, 5, '2023-07-01', '1', '1', 'Observaciones de la orden', 360.70, 14.80, 0.00, 'A', '2023-10-15 23:04:45'),
(59, 2, 1, 6, '2023-08-01', '1', '1', 'Observaciones de la orden', 186.94, 15.30, 0.00, 'A', '2023-10-15 23:04:45'),
(60, 3, 1, 5, '2023-09-01', '1', '1', 'Observaciones de la orden', 263.35, 6.59, 0.00, 'A', '2023-10-15 23:04:45'),
(61, 3, 2, 4, '2023-10-01', '1', '1', 'Observaciones de la orden', 430.36, 19.03, 0.00, 'A', '2023-10-15 23:04:45'),
(62, 3, 3, 7, '2023-11-01', '1', '1', 'Observaciones de la orden', 338.76, 9.56, 0.00, 'A', '2023-10-15 23:04:45'),
(63, 2, 3, 6, '2023-12-01', '1', '1', 'Observaciones de la orden', 273.75, 2.14, 0.00, 'A', '2023-10-15 23:04:46'),
(64, 4, 1, 2, '2023-01-01', '1', '1', 'Observaciones de la orden', 353.73, 13.85, 0.00, 'A', '2023-10-15 23:04:48'),
(65, 3, 3, 1, '2023-02-01', '1', '1', 'Observaciones de la orden', 180.38, 17.76, 0.00, 'A', '2023-10-15 23:04:48'),
(66, 2, 3, 1, '2023-03-01', '1', '1', 'Observaciones de la orden', 332.59, 9.27, 0.00, 'A', '2023-10-15 23:04:48'),
(67, 1, 3, 4, '2023-04-01', '1', '1', 'Observaciones de la orden', 224.71, 7.84, 0.00, 'A', '2023-10-15 23:04:48'),
(68, 2, 2, 1, '2023-05-01', '1', '1', 'Observaciones de la orden', 275.34, 1.10, 0.00, 'A', '2023-10-15 23:04:48'),
(69, 3, 3, 4, '2023-06-01', '1', '1', 'Observaciones de la orden', 324.80, 14.79, 0.00, 'A', '2023-10-15 23:04:48'),
(70, 4, 4, 1, '2023-07-01', '1', '1', 'Observaciones de la orden', 295.02, 0.95, 0.00, 'A', '2023-10-15 23:04:48'),
(71, 3, 1, 5, '2023-08-01', '1', '1', 'Observaciones de la orden', 279.71, 19.18, 0.00, 'A', '2023-10-15 23:04:48'),
(72, 3, 3, 6, '2023-09-01', '1', '1', 'Observaciones de la orden', 155.93, 10.66, 0.00, 'A', '2023-10-15 23:04:48'),
(73, 4, 4, 3, '2023-10-01', '1', '1', 'Observaciones de la orden', 103.77, 3.94, 0.00, 'A', '2023-10-15 23:04:48'),
(74, 3, 4, 6, '2023-11-01', '1', '1', 'Observaciones de la orden', 416.10, 5.47, 0.00, 'A', '2023-10-15 23:04:49'),
(75, 2, 4, 7, '2023-12-01', '1', '1', 'Observaciones de la orden', 433.01, 16.79, 0.00, 'A', '2023-10-15 23:04:49'),
(76, 1, 2, 4, '2023-01-01', '1', '1', 'Observaciones de la orden', 109.87, 5.94, 0.00, 'A', '2023-10-15 23:04:50'),
(77, 3, 1, 1, '2023-02-01', '1', '1', 'Observaciones de la orden', 345.67, 4.80, 0.00, 'A', '2023-10-15 23:04:50'),
(78, 2, 4, 3, '2023-03-01', '1', '1', 'Observaciones de la orden', 119.06, 10.66, 0.00, 'A', '2023-10-15 23:04:50'),
(79, 2, 4, 4, '2023-04-01', '1', '1', 'Observaciones de la orden', 422.13, 2.37, 0.00, 'A', '2023-10-15 23:04:50'),
(80, 3, 4, 2, '2023-05-01', '1', '1', 'Observaciones de la orden', 325.81, 5.52, 0.00, 'A', '2023-10-15 23:04:50'),
(81, 1, 2, 3, '2023-06-01', '1', '1', 'Observaciones de la orden', 423.73, 15.65, 0.00, 'A', '2023-10-15 23:04:50'),
(82, 2, 2, 5, '2023-07-01', '1', '1', 'Observaciones de la orden', 317.63, 4.47, 0.00, 'A', '2023-10-15 23:04:50'),
(83, 3, 2, 2, '2023-08-01', '1', '1', 'Observaciones de la orden', 473.70, 6.01, 0.00, 'A', '2023-10-15 23:04:50'),
(84, 2, 3, 1, '2023-09-01', '1', '1', 'Observaciones de la orden', 387.69, 8.11, 0.00, 'A', '2023-10-15 23:04:50'),
(85, 4, 4, 2, '2023-10-01', '1', '1', 'Observaciones de la orden', 165.65, 1.62, 0.00, 'A', '2023-10-15 23:04:50'),
(86, 2, 2, 5, '2023-11-01', '1', '1', 'Observaciones de la orden', 185.74, 19.28, 0.00, 'A', '2023-10-15 23:04:50'),
(87, 3, 1, 7, '2023-12-01', '1', '1', 'Observaciones de la orden', 371.97, 15.83, 0.00, 'A', '2023-10-15 23:04:50'),
(88, 3, 3, 6, '2023-01-01', '1', '1', 'Observaciones de la orden', 155.55, 16.37, 0.00, 'A', '2023-10-15 23:04:51'),
(89, 1, 3, 2, '2023-02-01', '1', '1', 'Observaciones de la orden', 425.68, 6.11, 0.00, 'A', '2023-10-15 23:04:51'),
(90, 4, 4, 6, '2023-03-01', '1', '1', 'Observaciones de la orden', 330.02, 14.28, 0.00, 'A', '2023-10-15 23:04:51'),
(91, 2, 4, 6, '2023-04-01', '1', '1', 'Observaciones de la orden', 374.30, 6.60, 0.00, 'A', '2023-10-15 23:04:51'),
(92, 1, 3, 6, '2023-05-01', '1', '1', 'Observaciones de la orden', 253.84, 10.34, 0.00, 'A', '2023-10-15 23:04:51'),
(93, 3, 4, 5, '2023-06-01', '1', '1', 'Observaciones de la orden', 470.16, 9.29, 0.00, 'A', '2023-10-15 23:04:51'),
(94, 1, 3, 2, '2023-07-01', '1', '1', 'Observaciones de la orden', 329.45, 15.30, 0.00, 'A', '2023-10-15 23:04:51'),
(95, 2, 1, 7, '2023-08-01', '1', '1', 'Observaciones de la orden', 190.81, 10.55, 0.00, 'A', '2023-10-15 23:04:51'),
(96, 3, 2, 3, '2023-09-01', '1', '1', 'Observaciones de la orden', 264.30, 11.31, 0.00, 'A', '2023-10-15 23:04:51'),
(97, 2, 4, 7, '2023-10-01', '1', '1', 'Observaciones de la orden', 368.71, 0.19, 0.00, 'A', '2023-10-15 23:04:51'),
(98, 4, 4, 2, '2023-11-01', '1', '1', 'Observaciones de la orden', 409.64, 11.07, 0.00, 'A', '2023-10-15 23:04:51'),
(99, 4, 3, 6, '2023-12-01', '1', '1', 'Observaciones de la orden', 427.61, 9.98, 0.00, 'A', '2023-10-15 23:04:51'),
(100, 4, 2, 6, '2023-01-01', '1', '1', 'Observaciones de la orden', 264.59, 9.37, 0.00, 'A', '2023-10-15 23:04:52'),
(101, 1, 3, 2, '2023-02-01', '1', '1', 'Observaciones de la orden', 244.42, 10.12, 0.00, 'A', '2023-10-15 23:04:52'),
(102, 1, 2, 4, '2023-03-01', '1', '1', 'Observaciones de la orden', 295.76, 16.21, 0.00, 'A', '2023-10-15 23:04:52'),
(103, 4, 2, 4, '2023-04-01', '1', '1', 'Observaciones de la orden', 200.64, 4.98, 0.00, 'A', '2023-10-15 23:04:52'),
(104, 4, 4, 6, '2023-05-01', '1', '1', 'Observaciones de la orden', 187.75, 7.44, 0.00, 'A', '2023-10-15 23:04:52'),
(105, 3, 2, 6, '2023-06-01', '1', '1', 'Observaciones de la orden', 180.71, 3.63, 0.00, 'A', '2023-10-15 23:04:52'),
(106, 3, 2, 5, '2023-07-01', '1', '1', 'Observaciones de la orden', 341.87, 7.15, 0.00, 'A', '2023-10-15 23:04:52'),
(107, 1, 3, 2, '2023-08-01', '1', '1', 'Observaciones de la orden', 112.72, 12.58, 0.00, 'A', '2023-10-15 23:04:52'),
(108, 4, 4, 2, '2023-09-01', '1', '1', 'Observaciones de la orden', 136.45, 2.09, 0.00, 'A', '2023-10-15 23:04:52'),
(109, 1, 1, 3, '2023-10-01', '1', '1', 'Observaciones de la orden', 133.18, 18.84, 0.00, 'A', '2023-10-15 23:04:52'),
(110, 4, 2, 1, '2023-11-01', '1', '1', 'Observaciones de la orden', 427.00, 2.93, 0.00, 'A', '2023-10-15 23:04:52'),
(111, 2, 4, 5, '2023-12-01', '1', '1', 'Observaciones de la orden', 192.42, 2.42, 0.00, 'A', '2023-10-15 23:04:52'),
(112, 2, 3, 4, '2023-01-01', '1', '1', 'Observaciones de la orden', 256.57, 9.98, 0.00, 'A', '2023-10-15 23:04:57'),
(113, 4, 4, 1, '2023-02-01', '1', '1', 'Observaciones de la orden', 291.96, 9.09, 0.00, 'A', '2023-10-15 23:04:57'),
(114, 2, 4, 4, '2023-03-01', '1', '1', 'Observaciones de la orden', 215.68, 4.63, 0.00, 'A', '2023-10-15 23:04:57'),
(115, 4, 1, 2, '2023-04-01', '1', '1', 'Observaciones de la orden', 209.05, 14.64, 0.00, 'A', '2023-10-15 23:04:58'),
(116, 3, 4, 7, '2023-05-01', '1', '1', 'Observaciones de la orden', 300.92, 11.63, 0.00, 'A', '2023-10-15 23:04:58'),
(117, 3, 2, 7, '2023-06-01', '1', '1', 'Observaciones de la orden', 286.91, 10.92, 0.00, 'A', '2023-10-15 23:04:58'),
(118, 3, 3, 4, '2023-07-01', '1', '1', 'Observaciones de la orden', 492.37, 18.24, 0.00, 'A', '2023-10-15 23:04:58'),
(119, 3, 1, 5, '2023-08-01', '1', '1', 'Observaciones de la orden', 463.46, 19.35, 0.00, 'A', '2023-10-15 23:04:58'),
(120, 1, 2, 7, '2023-09-01', '1', '1', 'Observaciones de la orden', 367.47, 0.95, 0.00, 'A', '2023-10-15 23:04:58'),
(121, 3, 4, 1, '2023-10-01', '1', '1', 'Observaciones de la orden', 195.34, 18.66, 0.00, 'A', '2023-10-15 23:04:58'),
(122, 1, 3, 1, '2023-11-01', '1', '1', 'Observaciones de la orden', 263.68, 16.72, 0.00, 'A', '2023-10-15 23:04:58'),
(123, 3, 4, 1, '2023-12-01', '1', '1', 'Observaciones de la orden', 366.98, 13.61, 0.00, 'A', '2023-10-15 23:04:58'),
(124, 2, 2, 3, '2023-01-01', '1', '1', 'Observaciones de la orden', 122.66, 15.98, 0.00, 'A', '2023-10-15 23:04:59'),
(125, 3, 2, 7, '2023-02-01', '1', '1', 'Observaciones de la orden', 475.57, 3.89, 0.00, 'A', '2023-10-15 23:04:59'),
(126, 3, 4, 1, '2023-03-01', '1', '1', 'Observaciones de la orden', 183.78, 10.14, 0.00, 'A', '2023-10-15 23:04:59'),
(127, 4, 4, 7, '2023-04-01', '1', '1', 'Observaciones de la orden', 283.78, 11.51, 0.00, 'A', '2023-10-15 23:04:59'),
(128, 4, 4, 4, '2023-05-01', '1', '1', 'Observaciones de la orden', 266.61, 15.63, 0.00, 'A', '2023-10-15 23:04:59'),
(129, 1, 1, 5, '2023-06-01', '1', '1', 'Observaciones de la orden', 284.23, 16.00, 0.00, 'A', '2023-10-15 23:04:59'),
(130, 1, 4, 1, '2023-07-01', '1', '1', 'Observaciones de la orden', 232.22, 15.61, 0.00, 'A', '2023-10-15 23:04:59'),
(131, 3, 4, 7, '2023-08-01', '1', '1', 'Observaciones de la orden', 492.68, 9.84, 0.00, 'A', '2023-10-15 23:04:59'),
(132, 4, 1, 3, '2023-09-01', '1', '1', 'Observaciones de la orden', 440.70, 15.86, 0.00, 'A', '2023-10-15 23:04:59'),
(133, 3, 4, 4, '2023-10-01', '1', '1', 'Observaciones de la orden', 264.34, 3.09, 0.00, 'A', '2023-10-15 23:04:59'),
(134, 2, 2, 1, '2023-11-01', '1', '1', 'Observaciones de la orden', 355.16, 4.87, 0.00, 'A', '2023-10-15 23:04:59'),
(135, 2, 2, 4, '2023-12-01', '1', '1', 'Observaciones de la orden', 320.55, 3.34, 0.00, 'A', '2023-10-15 23:04:59'),
(136, 1, 3, 6, '2023-01-01', '1', '1', 'Observaciones de la orden', 402.53, 2.79, 0.00, 'A', '2023-10-15 23:05:00'),
(137, 4, 4, 2, '2023-02-01', '1', '1', 'Observaciones de la orden', 351.73, 6.16, 0.00, 'A', '2023-10-15 23:05:00'),
(138, 1, 3, 3, '2023-03-01', '1', '1', 'Observaciones de la orden', 106.21, 15.55, 0.00, 'A', '2023-10-15 23:05:00'),
(139, 2, 2, 5, '2023-04-01', '1', '1', 'Observaciones de la orden', 320.88, 3.16, 0.00, 'A', '2023-10-15 23:05:00'),
(140, 1, 4, 1, '2023-05-01', '1', '1', 'Observaciones de la orden', 382.48, 19.04, 0.00, 'A', '2023-10-15 23:05:00'),
(141, 2, 2, 5, '2023-06-01', '1', '1', 'Observaciones de la orden', 449.73, 10.48, 0.00, 'A', '2023-10-15 23:05:00'),
(142, 2, 1, 5, '2023-07-01', '1', '1', 'Observaciones de la orden', 209.77, 6.33, 0.00, 'A', '2023-10-15 23:05:00'),
(143, 1, 2, 7, '2023-08-01', '1', '1', 'Observaciones de la orden', 466.92, 11.42, 0.00, 'A', '2023-10-15 23:05:00'),
(144, 1, 4, 6, '2023-09-01', '1', '1', 'Observaciones de la orden', 363.40, 15.26, 0.00, 'A', '2023-10-15 23:05:00'),
(145, 1, 3, 7, '2023-10-01', '1', '1', 'Observaciones de la orden', 341.91, 0.37, 0.00, 'A', '2023-10-15 23:05:00'),
(146, 2, 4, 5, '2023-11-01', '1', '1', 'Observaciones de la orden', 128.04, 4.83, 0.00, 'A', '2023-10-15 23:05:00'),
(147, 1, 4, 4, '2023-12-01', '1', '1', 'Observaciones de la orden', 408.32, 4.31, 0.00, 'A', '2023-10-15 23:05:00'),
(148, 2, 1, 3, '2023-01-01', '1', '1', 'Observaciones de la orden', 160.01, 0.86, 0.00, 'A', '2023-10-15 23:05:01'),
(149, 3, 3, 1, '2023-02-01', '1', '1', 'Observaciones de la orden', 488.01, 9.76, 0.00, 'A', '2023-10-15 23:05:01'),
(150, 3, 2, 3, '2023-03-01', '1', '1', 'Observaciones de la orden', 224.53, 12.89, 0.00, 'A', '2023-10-15 23:05:01'),
(151, 3, 3, 6, '2023-04-01', '1', '1', 'Observaciones de la orden', 330.10, 19.17, 0.00, 'A', '2023-10-15 23:05:01'),
(152, 3, 3, 2, '2023-05-01', '1', '1', 'Observaciones de la orden', 449.36, 4.55, 0.00, 'A', '2023-10-15 23:05:01'),
(153, 1, 1, 4, '2023-06-01', '1', '1', 'Observaciones de la orden', 176.39, 7.81, 0.00, 'A', '2023-10-15 23:05:01'),
(154, 1, 1, 4, '2023-07-01', '1', '1', 'Observaciones de la orden', 436.45, 9.76, 0.00, 'A', '2023-10-15 23:05:01'),
(155, 4, 1, 3, '2023-08-01', '1', '1', 'Observaciones de la orden', 147.75, 10.44, 0.00, 'A', '2023-10-15 23:05:01'),
(156, 4, 4, 6, '2023-09-01', '1', '1', 'Observaciones de la orden', 404.28, 9.56, 0.00, 'A', '2023-10-15 23:05:01'),
(157, 4, 3, 2, '2023-10-01', '1', '1', 'Observaciones de la orden', 286.13, 10.14, 0.00, 'A', '2023-10-15 23:05:01'),
(158, 3, 3, 6, '2023-11-01', '1', '1', 'Observaciones de la orden', 104.95, 8.81, 0.00, 'A', '2023-10-15 23:05:01'),
(159, 2, 2, 2, '2023-12-01', '1', '1', 'Observaciones de la orden', 321.36, 0.26, 0.00, 'A', '2023-10-15 23:05:01'),
(160, 3, 2, 6, '2023-01-01', '1', '1', 'Observaciones de la orden', 180.08, 0.95, 0.00, 'A', '2023-10-15 23:05:02'),
(161, 2, 2, 5, '2023-02-01', '1', '1', 'Observaciones de la orden', 198.76, 16.23, 0.00, 'A', '2023-10-15 23:05:02'),
(162, 1, 3, 2, '2023-03-01', '1', '1', 'Observaciones de la orden', 107.03, 10.49, 0.00, 'A', '2023-10-15 23:05:02'),
(163, 1, 3, 7, '2023-04-01', '1', '1', 'Observaciones de la orden', 376.98, 4.47, 0.00, 'A', '2023-10-15 23:05:02'),
(164, 2, 3, 4, '2023-05-01', '1', '1', 'Observaciones de la orden', 351.02, 12.33, 0.00, 'A', '2023-10-15 23:05:02'),
(165, 4, 3, 7, '2023-06-01', '1', '1', 'Observaciones de la orden', 435.74, 2.95, 0.00, 'A', '2023-10-15 23:05:02'),
(166, 3, 3, 5, '2023-07-01', '1', '1', 'Observaciones de la orden', 188.43, 8.54, 0.00, 'A', '2023-10-15 23:05:02'),
(167, 1, 1, 7, '2023-08-01', '1', '1', 'Observaciones de la orden', 272.63, 7.51, 0.00, 'A', '2023-10-15 23:05:02'),
(168, 1, 3, 2, '2023-09-01', '1', '1', 'Observaciones de la orden', 318.09, 13.74, 0.00, 'A', '2023-10-15 23:05:02'),
(169, 1, 4, 1, '2023-10-01', '1', '1', 'Observaciones de la orden', 332.61, 6.73, 0.00, 'A', '2023-10-15 23:05:02'),
(170, 1, 4, 1, '2023-11-01', '1', '1', 'Observaciones de la orden', 229.66, 2.91, 0.00, 'A', '2023-10-15 23:05:02'),
(171, 4, 3, 1, '2023-12-01', '1', '1', 'Observaciones de la orden', 461.76, 2.37, 0.00, 'A', '2023-10-15 23:05:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_servicio_articulo`
--

CREATE TABLE `orden_servicio_articulo` (
  `idordenservicioarticulo` int(5) NOT NULL COMMENT 'Identificador de la Tabla Orden de Servicio por Artículo',
  `idordenservicio` int(5) DEFAULT NULL COMMENT 'Identificador de la tabla Orden de Servicio',
  `idarticulo` int(5) DEFAULT NULL COMMENT 'Identificador de la tabla Artículo',
  `cantidad_articulo` int(5) DEFAULT NULL COMMENT 'Cantidad de Artículos',
  `valor_articulo` decimal(10,2) DEFAULT NULL COMMENT 'Valor de cada artículo',
  `estado` char(1) DEFAULT NULL COMMENT 'N: Nuevo; C:Conservado; D:Degastado',
  `idproducto` int(5) DEFAULT NULL COMMENT 'Insumo o producto a emplear',
  `cantidad_producto` int(11) DEFAULT NULL COMMENT 'Cantidad de productos a emplear',
  `costo_articulo` decimal(10,2) DEFAULT NULL COMMENT 'Total del gasto del producto/insumo a emplear',
  `observacion` varchar(250) DEFAULT NULL COMMENT 'Observaciones sobre el lote de articulos',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'YYYY-MM-DD HH:MM:SS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `orden_servicio_articulo`
--

INSERT INTO `orden_servicio_articulo` (`idordenservicioarticulo`, `idordenservicio`, `idarticulo`, `cantidad_articulo`, `valor_articulo`, `estado`, `idproducto`, `cantidad_producto`, `costo_articulo`, `observacion`, `fecha_hora_sistema`) VALUES
(1, 1, 4, 3, 1000.00, 'C', 1, 1, 80000.00, 'Se requiere de 2 personas', '2023-09-30 18:49:21'),
(2, 1, 3, 2, 1500.00, 'C', 3, 2, 4.40, 'PC + Monitor + Teclado + Mouse', '2023-09-30 20:10:18'),
(3, 1, 6, 10, 300.00, 'N', 2, 1, 2.00, 'Envoltorios', '2023-09-30 20:12:51'),
(4, 1, 7, 1, 100.00, 'N', 3, 1, 2.20, 'Plantas', '2023-09-30 20:14:26'),
(5, 1, 10, 1, 300.00, 'N', 3, 1, 2.20, 'Copas de cristales', '2023-09-30 20:16:43'),
(6, 2, 11, 1, 0.00, 'C', 4, 1, 1200.00, 'Transporte para la mudanza', '2023-09-30 21:02:21'),
(7, 2, 11, 1, 0.00, 'N', 6, 4, 400.00, '1 chofer y 3 estibadores', '2023-09-30 21:03:54'),
(8, 2, 11, 3, 0.00, 'N', 5, 5, 150.00, 'Compra de 5 galones', '2023-09-30 21:09:26'),
(9, 2, 2, 3, 1000.00, 'C', 7, 3, 45.00, 'Refrigeradora, Lavadora y Cocina', '2023-09-30 21:10:01'),
(11, 3, 11, 1, 0.00, 'C', 4, 1, 1200.00, 'Placa, nombre conductor', '2023-10-03 23:02:39'),
(12, 3, 11, 1, 0.00, 'N', 6, 3, 300.00, 'Jose, Pedro y Luis', '2023-10-03 23:03:27'),
(13, 3, 11, 1, 0.00, 'N', 5, 10, 300.00, '', '2023-10-03 23:05:04'),
(14, 3, 3, 20, 2000.00, 'C', 3, 20, 60.00, 'Notebook HP', '2023-10-03 23:06:16'),
(15, 3, 1, 20, 300.00, 'C', 2, 5, 10.00, '', '2023-10-03 23:08:22'),
(16, 3, 7, 20, 100.00, 'C', 2, 2, 4.00, 'Cuadros de Pintura', '2023-10-03 23:15:12'),
(17, 3, 7, 20, 100.00, 'C', 2, 2, 4.00, 'Cuadros de Pintura', '2023-10-03 23:16:39'),
(20, 4, 9, 1, 10.00, 'N', 2, 1, 2.00, '', '2023-10-20 03:09:23'),
(21, 4, 9, 1, 10.00, 'N', 2, 1, 2.00, '', '2023-10-20 03:09:34'),
(22, 4, 9, 1, 10.00, 'N', 2, 1, 2.00, '', '2023-10-20 03:13:46'),
(24, 7, 0, 1, 10.00, 'N', 6, 1, 100.00, '', '2023-10-20 03:32:17'),
(25, 7, 0, 1, 10.00, 'N', 2, 1, 2.00, '', '2023-10-20 03:32:23'),
(26, 7, 0, 1, 10.00, 'N', 3, 1, 3.00, '', '2023-10-20 03:32:32'),
(28, 8, 4, 1, 10.00, 'N', 7, 1, 15.00, '', '2023-12-01 02:22:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_servicio_comprobante`
--

CREATE TABLE `orden_servicio_comprobante` (
  `idordenserviciocomprobante` int(5) NOT NULL COMMENT 'Identificador de la tabla Orden de Servicio Comprobante',
  `idordenservicio` int(5) DEFAULT NULL COMMENT 'Identificador de la Tabla Orden de Servicio',
  `idusuario` int(5) DEFAULT NULL COMMENT 'Identificador de la tabla Usuario',
  `tipo_documento` varchar(7) DEFAULT NULL COMMENT 'FACTURA / BOLETA: Boleta',
  `numero_documento` int(11) DEFAULT NULL COMMENT 'Numero de documento',
  `razon_social` varchar(100) DEFAULT NULL COMMENT 'Nombre de la entidad que registra el comprobante',
  `forma_pago` varchar(20) DEFAULT NULL COMMENT '	Forma de pago: EFECTIVO/TARJETA DE CREDITO/TARJETA DEBITO/TRANSFERENCIA CTA./YAPE',
  `numero_operacion` varchar(20) DEFAULT NULL COMMENT 'Numero de operación en caso pague con una Transferencia o Tarjeta de Crédito/Debito',
  `subtotal` decimal(10,2) DEFAULT NULL COMMENT 'Subtotal del documento',
  `igv` decimal(10,2) DEFAULT NULL COMMENT 'IGV',
  `total` decimal(10,2) DEFAULT NULL COMMENT 'Total del documento',
  `estado` char(1) DEFAULT NULL COMMENT 'A: Activo; I:Inactivo',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'YYYY-MM-DD HH:MM:SS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_proveedores`
--

CREATE TABLE `pagos_proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(30) DEFAULT NULL,
  `fecha_transaccion` date DEFAULT NULL,
  `concepto` text DEFAULT NULL,
  `monto` decimal(10,0) DEFAULT NULL,
  `estado_pago` varchar(20) DEFAULT NULL,
  `metodo_pago` varchar(20) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_sistema` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pagos_proveedores`
--

INSERT INTO `pagos_proveedores` (`id_proveedor`, `nombre_proveedor`, `fecha_transaccion`, `concepto`, `monto`, `estado_pago`, `metodo_pago`, `fecha_vencimiento`, `fecha_sistema`) VALUES
(1, 'juan perez', '2023-05-24', 'pidio un mudanza de cuadros de alta gama de surco a la molina', 2000, 'pagado', 'transferencia', '2023-10-12', '2023-10-13 07:20:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_personal` int(5) NOT NULL COMMENT 'id del personal ',
  `nombre` varchar(20) DEFAULT NULL COMMENT 'nombre del trabajador',
  `apellido` varchar(20) DEFAULT NULL COMMENT 'apellido del trabajador',
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'fecha de nacimiento',
  `correo` varchar(50) DEFAULT NULL COMMENT 'correo del trabajador',
  `dni` varchar(8) DEFAULT NULL COMMENT 'documento del trabajador',
  `celular` varchar(9) DEFAULT NULL COMMENT 'numero móvil',
  `area` char(1) DEFAULT NULL COMMENT '1. Administracion\r\n2. Operaciones\r\n3. Comercial/Ventas\r\n4. Logistica\r\n5. Finanzas',
  `puesto` varchar(50) DEFAULT NULL COMMENT 'puesto del trabajador',
  `fecha_inicio` date DEFAULT NULL COMMENT 'fecha de ingreso',
  `salario` decimal(10,0) DEFAULT NULL COMMENT 'salario mensual',
  `fotografia` blob DEFAULT NULL,
  `fecha_sistema` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'fecha de ingreso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `nombre`, `apellido`, `fecha_nacimiento`, `correo`, `dni`, `celular`, `area`, `puesto`, `fecha_inicio`, `salario`, `fotografia`, `fecha_sistema`) VALUES
(1, 'Alberto', 'Morales', '1999-02-04', 'morales@pucp.pe', '78494565', '984565123', '2', NULL, NULL, NULL, NULL, '2023-10-13 03:31:34'),
(2, 'Edgar', 'Canache', '0000-00-00', 'edgarcanache@gmail.com', '75482163', '986532142', '3', NULL, NULL, NULL, NULL, '2023-10-13 03:32:53'),
(3, 'jesus', 'rivero', '0000-00-00', 'riverojesus@gmail.com', '78945621', '963258741', '1', NULL, NULL, NULL, NULL, '2023-10-13 03:34:02'),
(4, 'Francis', 'Jimenz', '2023-10-14', 'contabilidad@pucp.pe', '87654321', '98373772', '2', 'Jefe', '2023-10-14', 2000, '', '2023-10-13 22:36:20'),
(5, 'Cesar', 'Rodriguez', '2023-10-14', 'luchita@gmail.com', '87654313', '98373724', '2', 'Asistente', '2023-10-14', 2000, '', '2023-10-13 22:37:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planillas`
--

CREATE TABLE `planillas` (
  `id_planilla` int(11) NOT NULL COMMENT 'numero de planilla dentro de la empresa',
  `id_personal` int(11) NOT NULL COMMENT 'id del personal asociado a la planilla',
  `fecha_planilla` date NOT NULL COMMENT 'fecha de ingreso a planilla',
  `horas_trabajadas` int(11) NOT NULL COMMENT 'horas trabajadas durante su jornada',
  `salario_base` decimal(10,0) NOT NULL COMMENT 'salario minimo, sujeto a bonificaciones y descuentos',
  `bonificaciones` decimal(10,0) NOT NULL COMMENT 'incentivos por buen desempeño',
  `deducciones` decimal(10,0) NOT NULL COMMENT 'deducciones para pago de impuestos',
  `monto_total` decimal(10,0) NOT NULL COMMENT 'monto a entregar despues de beneficios y deducciones',
  `fecha_sistema` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `planillas`
--

INSERT INTO `planillas` (`id_planilla`, `id_personal`, `fecha_planilla`, `horas_trabajadas`, `salario_base`, `bonificaciones`, `deducciones`, `monto_total`, `fecha_sistema`) VALUES
(1562461884, 1234567899, '2023-10-13', 40, 1300, 300, 100, 1500, '2023-10-13 07:17:56'),
(1562461885, 1234567899, '2023-10-13', 40, 1300, 300, 100, 1500, '2023-10-13 07:19:20'),
(1562461886, 324, '2023-10-13', 12, 1000, 134, 23, 1234, '2023-10-14 04:38:35'),
(1562461887, 425672, '2023-10-14', 30, 1200, 0, 0, 1200, '2023-10-14 05:46:04'),
(1562461888, 325, '2023-10-14', 30, 1235, 0, 0, 1235, '2023-10-14 06:17:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_atencion`
--

CREATE TABLE `plan_atencion` (
  `idplan` int(11) NOT NULL,
  `fechaplan` timestamp NULL DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plan_atencion`
--

INSERT INTO `plan_atencion` (`idplan`, `fechaplan`, `nombre`, `tipo`) VALUES
(1, '2023-10-11 07:51:39', 'Mudanza residencial', 1),
(2, '2023-10-13 07:51:39', 'Embalaje con cartón', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(5) NOT NULL COMMENT 'Identificador  de la tabla Producto',
  `idcategoria` int(5) DEFAULT NULL COMMENT 'Identificador de la tabla categoria producto',
  `nombre` varchar(50) DEFAULT NULL COMMENT 'Nombre del Producto',
  `descripcion` varchar(250) DEFAULT NULL COMMENT 'Descripción del Producto',
  `nombre_imagen` varchar(50) DEFAULT NULL COMMENT 'Imagen del Producto',
  `codigo_barras` varchar(25) DEFAULT NULL COMMENT 'Código de barras del producto',
  `stock` int(5) DEFAULT 0 COMMENT 'Stock del producto',
  `precio_compra` decimal(10,2) DEFAULT NULL COMMENT 'Precio del valor de compra del producto',
  `precio_venta` decimal(10,2) DEFAULT NULL COMMENT 'Precio del valor del servicio del insumo/producto al cotizar por su uso/alquiler/prorrateo',
  `estado` char(1) DEFAULT NULL COMMENT 'A:Activo; I:Inactivo',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'YYYY-MM-DD HH:MM:SS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Almacena todos los productos de la tienda';

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `idcategoria`, `nombre`, `descripcion`, `nombre_imagen`, `codigo_barras`, `stock`, `precio_compra`, `precio_venta`, `estado`, `fecha_hora_sistema`) VALUES
(1, 1, 'Camioneta de Mudanza de 1 Tonelada', 'Placa A0G-1023', 'camioneta.png', '123456', 2, 80000.00, 800.00, 'A', '2023-09-17 23:23:32'),
(2, 2, 'Cinta de embalaje 2x110', 'Esta cinta transparente es un accesorio ideal para que conserves en perfecto estado todos tus objetos al momento de embalarlos. Puede ser empleado para el sellado de cajas de cartón y bolsas plásticas.', 'cinta_embalaje.jpeg', '2354987', 100, 2.00, 2.00, 'A', '2023-09-19 21:22:01'),
(3, 5, 'Caja de cartón pequeña', 'Caja para mudanza de locales y domicilios', 'caja_carton.jpeg', '987546210354', 50, 2.00, 3.00, 'A', '2023-09-19 23:28:20'),
(4, 1, 'Camioneta de Mudanza de 2 Toneladas', 'Placa POP-0537', 'camioneta.png', '65478988', 2, 120000.00, 1200.00, 'A', '2023-09-30 20:51:13'),
(5, 1, 'Gasolina 90', 'Combustible', 'gasolina.jpg', '235478', 0, 18.00, 30.00, 'A', '2023-09-30 20:55:10'),
(6, 1, 'Estibadores', 'Personas que se encargan de la mudanza', 'estibador.png', '', 20, 50.00, 100.00, 'A', '2023-09-30 20:57:27'),
(7, 5, 'Caja de cartón Grande', 'Caja para mudanza de artículos grandes', 'caja_carton.jpeg', '987546210354', 52, 10.00, 15.00, 'A', '2023-09-19 23:28:20'),
(8, 5, 'Caja de cartón Mediano', 'Caja para mudanza de artículos medianos', 'caja_carton.jpeg', '98210354', 50, 5.00, 10.00, 'A', '2023-09-19 23:28:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int(5) NOT NULL,
  `ruc` varchar(11) DEFAULT NULL COMMENT 'Ruc del proveedor',
  `nombre_comercial` varchar(200) DEFAULT NULL COMMENT 'Nombre de la empresa',
  `estado` char(1) DEFAULT NULL COMMENT '1: Habido / 2: No habido',
  `correo` varchar(50) DEFAULT NULL COMMENT 'Correo de contacto del Proveedor',
  `clave` varchar(20) DEFAULT NULL COMMENT 'Clave del usuario',
  `direccion` varchar(50) DEFAULT NULL,
  `numero_contacto` varchar(20) DEFAULT NULL COMMENT 'Numero de Contacto',
  `metodo_pago` char(1) DEFAULT NULL COMMENT 'E: Contado / C: Credito',
  `fecha_hora_sistema` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `ruc`, `nombre_comercial`, `estado`, `correo`, `clave`, `direccion`, `numero_contacto`, `metodo_pago`, `fecha_hora_sistema`) VALUES
(1, '65454530218', 'ALOY SAC', 'A', 'aloy@ventas.com', '4567897', NULL, '9994545813', 'C', '2023-10-13 05:10:38'),
(2, '88521650462', 'Puentes Industriales SAC', 'A', 'pindustriales@ventas.com', '123456789', NULL, '999888777', 'E', '2023-10-13 05:11:57'),
(3, '12345678912', 'Pinocho SAC', 'A', 'pinocho@madera.com', '123456', NULL, '999666333', 'C', '2023-10-13 06:56:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamo`
--

CREATE TABLE `reclamo` (
  `idreclamo` int(11) NOT NULL COMMENT 'Identificador de la tabla reclamo',
  `idtiporeclamo` int(11) DEFAULT NULL COMMENT 'Identificador de la tabla tipo reclamo',
  `fecha_reclamo` timestamp NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora que se realizó el reclamo',
  `idcliente` int(11) DEFAULT NULL COMMENT 'Identificador de la tabla cliente',
  `nombre` varchar(50) DEFAULT NULL COMMENT 'Nombre del cliente',
  `descripcion` varchar(150) DEFAULT NULL COMMENT 'Detalles del reclamo realizado por el cliente',
  `estado` varchar(1) DEFAULT NULL COMMENT 'A: activo, P: pendiente, I: inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `reclamo`
--

INSERT INTO `reclamo` (`idreclamo`, `idtiporeclamo`, `fecha_reclamo`, `idcliente`, `nombre`, `descripcion`, `estado`) VALUES
(1, 2, '2023-09-29 21:12:18', 5, 'Juan Perez', 'Hubo un retraso de 1 hora al momento de realizar la mudanza', 'A'),
(2, 4, '2023-09-29 21:12:18', 6, 'Distribuidora Quipu', 'Error al colocar la razón social', 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idservicio` int(5) NOT NULL COMMENT 'Identificador de la tabla servicio',
  `idcategoria` int(5) DEFAULT NULL COMMENT 'Identificador de la tabla categoria servicio',
  `nombre` varchar(30) DEFAULT NULL COMMENT 'Nombre de la Categoría',
  `descripcion` varchar(250) DEFAULT NULL COMMENT 'Descripción de la categoría',
  `estado` varchar(1) NOT NULL COMMENT 'A: Activo, I: Inactivo',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora del sistema al momento de registrar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idservicio`, `idcategoria`, `nombre`, `descripcion`, `estado`, `fecha_hora_sistema`) VALUES
(1, 1, 'Mudanza residencial', 'Servicios de mudanza para hogares y apartamentos, que incluyen el transporte y descarga de muebles y pertenencias personales.', 'A', '2023-10-12 18:44:34'),
(2, 1, 'Mudanzas comerciales', 'Mudanzas diseñadas para empresas y oficinas, que implican trasladar equipos de oficina, archivos y mobiliario de oficina de un lugar a otro.', 'A', '2023-10-12 18:44:34'),
(3, 1, 'Mudanzas a larga distancia', 'Mudanzas que involucran trasladar bienes a través de largas distancias dentro del mismo país, a menudo requieren planificación logística y coordinación.', 'A', '2023-10-12 18:44:34'),
(4, 1, 'Mudanzas de carga pesada', 'Servicios diseñados para mover artículos extremadamente pesados o voluminosos, como maquinaria industrial, equipos de construcción o vehículos.', 'A', '2023-10-12 18:44:34'),
(5, 2, 'Mudanza residencial plus', 'Es el mismo servicio de mudanza residencial pero con el servicio de embalaje añadido', 'A', '2023-10-12 18:44:34'),
(6, 2, 'Mudanzas comerciales plus', 'Es el mismo servicio de mudanza comercial pero con el servicio de embalaje añadido', 'A', '2023-10-12 18:44:34'),
(7, 2, 'Mudanzas a larga distancia plu', 'Es el mismo servicio de mudanza a larga distancia pero con el servicio de embalaje añadido', 'A', '2023-10-12 18:44:34'),
(8, 2, 'Mudanzas de carga pesada plus', 'Es el mismo servicio de mudanza de carga pesada pero con el servicio de embalaje añadido.', 'A', '2023-10-12 18:44:34'),
(9, 1, 'Embalaje con carton', 'Servico de embalaje con el material de cartón', 'A', '2023-10-12 18:44:34'),
(10, 1, 'Embalaje con plastico', 'Servico de embalaje con el material de plástico', 'A', '2023-10-12 18:44:34'),
(11, 1, 'Embalaje con papel', 'Servico de embalaje con el material de papel', 'A', '2023-10-12 18:44:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_reclamo`
--

CREATE TABLE `tipo_reclamo` (
  `idtiporeclamo` int(11) NOT NULL COMMENT 'Identificador de la tabla tipo reclamo',
  `nombre` varchar(50) DEFAULT NULL COMMENT 'Nombre del tipo de reclamo',
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_reclamo`
--

INSERT INTO `tipo_reclamo` (`idtiporeclamo`, `nombre`, `descripcion`) VALUES
(1, 'Daños a la propiedad', 'Reclamos relacionados con daños materiales a los objetos durante la mudanza.'),
(2, 'Retraso en la mudanza', 'Reclamos debido a retrasos en la fecha de entrega acordada.'),
(3, 'Mala conducta del personal', 'Reclamos por el comportamiento inapropiado o poco profesional del personal de la empresa de mudanzas.'),
(4, 'Facturación incorrecta', 'Reclamos relacionados con errores en la facturación o el cobro de servicios.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE `transporte` (
  `idtransporte` int(5) NOT NULL,
  `marca` varchar(30) DEFAULT NULL COMMENT 'Marca del carro',
  `modelo` varchar(50) DEFAULT NULL COMMENT 'Modelo del transporte',
  `estado` char(1) DEFAULT NULL COMMENT 'A: ACTIVO / I: INACTIVO',
  `placa` varchar(6) DEFAULT NULL COMMENT 'placa del vehiculo',
  `capacidad_toneladas` int(3) DEFAULT NULL COMMENT 'Capacidad en toneladas',
  `fecha_compra` date DEFAULT NULL,
  `consumo_combustible` varchar(3) DEFAULT NULL,
  `fecha_entrada_sistema` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `transporte`
--

INSERT INTO `transporte` (`idtransporte`, `marca`, `modelo`, `estado`, `placa`, `capacidad_toneladas`, `fecha_compra`, `consumo_combustible`, `fecha_entrada_sistema`) VALUES
(1, 'MAN', 'TLG 8.180', 'A', 'ASD-12', 8, '2014-10-17', '24', '2023-10-13 05:06:38'),
(2, 'Renault', 'Midlum 220 DXI', 'A', 'SSS-22', 14, '2023-10-07', NULL, '2023-10-13 05:06:38'),
(4, 'AXE', 'DEDESADA', 'A', 'FRD123', 20, '2023-10-10', '16', '2023-10-13 06:46:30'),
(5, 'HAS', 'XL38', 'A', 'UTP-23', 24, '2023-10-13', '32', '2023-10-13 21:45:31'),
(6, 'HYUNDAI', '123', 'A', 'UTP-32', 18, '2023-09-14', '30', '2023-10-13 23:44:24'),
(7, 'FERRARI', 'GHOST', 'A', 'UTP-25', 9, '2023-12-01', '23', '2023-12-01 01:50:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(5) NOT NULL COMMENT 'Identificador de la tabla',
  `nombre` varchar(30) DEFAULT NULL COMMENT 'Nombre',
  `apellido` varchar(30) DEFAULT NULL COMMENT 'Apellido',
  `nombre_imagen` varchar(50) DEFAULT NULL COMMENT 'Imagen del Usuario',
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'YYYY-MM-DD',
  `perfil` varchar(5) NOT NULL COMMENT 'Perfiles de usuario [ADMIN / CONTA / COMERC / LOGIS / OPERA].',
  `correo` varchar(50) DEFAULT NULL COMMENT 'correo electrónico del usuario',
  `clave` varchar(20) DEFAULT NULL COMMENT 'Password del usuario',
  `estado` char(1) DEFAULT NULL COMMENT 'A:Activo; I:Inactivo',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'YYYY-MM-DD HH:MM:SS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `apellido`, `nombre_imagen`, `fecha_nacimiento`, `perfil`, `correo`, `clave`, `estado`, `fecha_hora_sistema`) VALUES
(1, 'Administrador', 'ERP', 'neo.jpg', '2000-07-24', 'ADMIN', 'admin@pucp.pe', '123456', 'A', '2022-08-28 06:43:03'),
(2, 'Maria', 'Gracia', 'avatar2.png', '2010-05-24', 'CONTA', 'contabilidad@pucp.pe', '123456', 'I', '2022-08-28 06:44:49'),
(3, 'Andrea', 'Suarez', 'keanu.jpeg', '2000-01-13', 'COMER', 'comercial@pucp.pe', '123456', 'A', '2022-08-30 10:00:00'),
(4, 'Gustavo', 'Aguilar', 'user7-128x128.jpg', '2002-11-10', 'LOGIS', 'logistica@pucp.pe', '123456', 'A', '2022-08-30 10:00:00'),
(7, 'Jhosep', 'Tupia', 'avatar.png', '2003-02-23', 'ADMIN', 'jhosep@pucp.edu.pe', '123456', 'A', '2023-09-19 22:55:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(5) NOT NULL COMMENT 'Identificador de la tabla venta',
  `idusuario` int(5) NOT NULL COMMENT 'Identificador de la tabla usuario',
  `idcliente` int(5) NOT NULL COMMENT 'Identificador de la tabla cliente',
  `fecha_documento` date DEFAULT NULL COMMENT 'Fecha del documento',
  `tipo_documento` varchar(7) DEFAULT NULL COMMENT 'FACTURA / BOLETA',
  `numero_documento` int(11) DEFAULT NULL COMMENT 'Numero de documento',
  `razon_social` varchar(100) DEFAULT NULL COMMENT 'Nombre de la entidad que registra en la venta',
  `forma_pago` varchar(20) DEFAULT NULL COMMENT 'Forma de pago: EFECTIVO/TARJETA DE CREDITO/TARJETA DEBITO/TRANSFERENCIA CTA./YAPE',
  `numero_operacion` varchar(20) DEFAULT NULL COMMENT 'Numero de operación en caso pague con una Transferencia o Tarjeta de Credito/Debito',
  `subtotal` decimal(10,2) DEFAULT NULL COMMENT 'Subtotal de la compra',
  `igv` decimal(10,2) DEFAULT NULL COMMENT 'IGV',
  `total` decimal(10,2) DEFAULT NULL COMMENT 'Total de la venta',
  `estado` char(1) DEFAULT NULL COMMENT 'A: Activo; I:Inactivo',
  `fecha_hora_sistema` timestamp NULL DEFAULT current_timestamp() COMMENT 'YYYY-MM-DD HH:MM:SS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Almacena todas las ventas de la tienda';

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `idusuario`, `idcliente`, `fecha_documento`, `tipo_documento`, `numero_documento`, `razon_social`, `forma_pago`, `numero_operacion`, `subtotal`, `igv`, `total`, `estado`, `fecha_hora_sistema`) VALUES
(1, 4, 5, '2023-09-29', 'BOLETA', 145, '2081498423', 'EFECTIVO', NULL, 1017.00, 183.00, 1200.00, 'I', '2023-09-29 21:03:58'),
(2, 3, 6, '2023-09-29', 'FACTURA', 146, '2087654321', 'YAPE', '23543', 2542.37, 457.63, 3000.00, 'I', '2023-09-29 21:10:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`idproductoa`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idarticulo`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `categoria_servicio`
--
ALTER TABLE `categoria_servicio`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `contrato de servicios`
--
ALTER TABLE `contrato de servicios`
  ADD PRIMARY KEY (`id_contrato`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`idcotizacion`),
  ADD KEY `idservicio` (`idservicio`,`idcliente`),
  ADD KEY `idcliente` (`idcliente`);

--
-- Indices de la tabla `gestion_os`
--
ALTER TABLE `gestion_os`
  ADD KEY `fk_gestionos_venta` (`idventa`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`idinsumo`);

--
-- Indices de la tabla `mudanza`
--
ALTER TABLE `mudanza`
  ADD PRIMARY KEY (`idregistro`),
  ADD KEY `fk_mudanza_servicio` (`idservicio`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD KEY `idproveedor` (`idproveedor`,`id_insumo`);

--
-- Indices de la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  ADD PRIMARY KEY (`idordenservicio`),
  ADD KEY `fk_ordenservicio_cliente` (`idcliente`),
  ADD KEY `fk_ordenservicio_usuario` (`idusuario`),
  ADD KEY `fk_ordenservicio_servicio` (`idservicio`);

--
-- Indices de la tabla `orden_servicio_articulo`
--
ALTER TABLE `orden_servicio_articulo`
  ADD PRIMARY KEY (`idordenservicioarticulo`),
  ADD KEY `fk_ordenservicioarticulo_ordenservicio` (`idordenservicio`),
  ADD KEY `fk_ordenservicioarticulo_articulo` (`idarticulo`),
  ADD KEY `fk_ordenservicioarticulo_producto` (`idproducto`);

--
-- Indices de la tabla `orden_servicio_comprobante`
--
ALTER TABLE `orden_servicio_comprobante`
  ADD PRIMARY KEY (`idordenserviciocomprobante`),
  ADD KEY `fk_ordenserviciocomprobante_ordenservicio` (`idordenservicio`),
  ADD KEY `fk_ordenserviciocomprobante_usuario` (`idusuario`);

--
-- Indices de la tabla `pagos_proveedores`
--
ALTER TABLE `pagos_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_personal`);

--
-- Indices de la tabla `planillas`
--
ALTER TABLE `planillas`
  ADD PRIMARY KEY (`id_planilla`),
  ADD KEY `id_personal` (`id_personal`);

--
-- Indices de la tabla `plan_atencion`
--
ALTER TABLE `plan_atencion`
  ADD PRIMARY KEY (`idplan`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fk_producto_categoriaproducto` (`idcategoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `reclamo`
--
ALTER TABLE `reclamo`
  ADD PRIMARY KEY (`idreclamo`),
  ADD KEY `idtiporeclamo` (`idtiporeclamo`,`idcliente`),
  ADD KEY `idcliente` (`idcliente`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idservicio`),
  ADD KEY `fk_servicio_categoriaservicio` (`idcategoria`);

--
-- Indices de la tabla `tipo_reclamo`
--
ALTER TABLE `tipo_reclamo`
  ADD PRIMARY KEY (`idtiporeclamo`);

--
-- Indices de la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`idtransporte`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `fk_venta_usuario` (`idusuario`),
  ADD KEY `fk_venta_cliente` (`idcliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `idproductoa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Artículo', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  MODIFY `idcategoria` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Categoría', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `categoria_servicio`
--
ALTER TABLE `categoria_servicio`
  MODIFY `idcategoria` int(5) NOT NULL AUTO_INCREMENT COMMENT '	Identificador de la tabla Categoría', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla cliente', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `contrato de servicios`
--
ALTER TABLE `contrato de servicios`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT COMMENT 'numero de contrato', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `idcotizacion` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla cotizacion', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `idinsumo` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mudanza`
--
ALTER TABLE `mudanza`
  MODIFY `idregistro` int(5) NOT NULL AUTO_INCREMENT COMMENT 'id del registro', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `idcompra` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  MODIFY `idordenservicio` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la Orden de Servicio', AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT de la tabla `orden_servicio_articulo`
--
ALTER TABLE `orden_servicio_articulo`
  MODIFY `idordenservicioarticulo` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la Tabla Orden de Servicio por Artículo', AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `orden_servicio_comprobante`
--
ALTER TABLE `orden_servicio_comprobante`
  MODIFY `idordenserviciocomprobante` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Orden de Servicio Comprobante';

--
-- AUTO_INCREMENT de la tabla `pagos_proveedores`
--
ALTER TABLE `pagos_proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_personal` int(5) NOT NULL AUTO_INCREMENT COMMENT 'id del personal ', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `planillas`
--
ALTER TABLE `planillas`
  MODIFY `id_planilla` int(11) NOT NULL AUTO_INCREMENT COMMENT 'numero de planilla dentro de la empresa', AUTO_INCREMENT=1562461889;

--
-- AUTO_INCREMENT de la tabla `plan_atencion`
--
ALTER TABLE `plan_atencion`
  MODIFY `idplan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador  de la tabla Producto', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reclamo`
--
ALTER TABLE `reclamo`
  MODIFY `idreclamo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla reclamo', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idservicio` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla servicio', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipo_reclamo`
--
ALTER TABLE `tipo_reclamo`
  MODIFY `idtiporeclamo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla tipo reclamo', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transporte`
--
ALTER TABLE `transporte`
  MODIFY `idtransporte` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla venta', AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`idservicio`) REFERENCES `servicio` (`idservicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mudanza`
--
ALTER TABLE `mudanza`
  ADD CONSTRAINT `mudanza_ibfk_1` FOREIGN KEY (`idservicio`) REFERENCES `servicio` (`idservicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `orden_compra_ibfk_1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  ADD CONSTRAINT `fk_ordenservicio_cliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordenservicio_servicio` FOREIGN KEY (`idservicio`) REFERENCES `servicio` (`idservicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordenservicio_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria_producto` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reclamo`
--
ALTER TABLE `reclamo`
  ADD CONSTRAINT `reclamo_tipo_reclamo` FOREIGN KEY (`idtiporeclamo`) REFERENCES `tipo_reclamo` (`idtiporeclamo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_servicio_categoriaservicio` FOREIGN KEY (`idcategoria`) REFERENCES `categoria_servicio` (`idcategoria`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
