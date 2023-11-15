-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla alquiler.alquiler
CREATE TABLE IF NOT EXISTS `alquiler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cantidad` int NOT NULL,
  `tipo_precio` int NOT NULL DEFAULT '0',
  `monto` decimal(10,2) NOT NULL,
  `abono` decimal(10,2) NOT NULL,
  `fecha_prestamo` datetime NOT NULL,
  `fecha_devolucion` datetime NOT NULL,
  `observacion` text,
  `estado` int NOT NULL DEFAULT '1',
  `id_cliente` int NOT NULL,
  `id_vehiculo` int NOT NULL,
  `id_doc` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_vehiculo` (`id_vehiculo`),
  KEY `id_doc` (`id_doc`),
  CONSTRAINT `alquiler_ibfk_1` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `alquiler_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `alquiler_ibfk_3` FOREIGN KEY (`id_doc`) REFERENCES `documentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla alquiler.alquiler: ~0 rows (aproximadamente)

-- Volcando estructura para tabla alquiler.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `codphone` varchar(10) DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `direccion` text NOT NULL,
  `clave` varchar(150) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla alquiler.clientes: ~0 rows (aproximadamente)

-- Volcando estructura para tabla alquiler.configuracion
CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ruc` varchar(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `mensaje` text NOT NULL,
  `logo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla alquiler.configuracion: ~1 rows (aproximadamente)
INSERT INTO `configuracion` (`id`, `ruc`, `nombre`, `telefono`, `correo`, `direccion`, `mensaje`, `logo`) VALUES
	(1, '12345678910', 'Vida Informático', '963852147', 'programadornaju@gmail.com', 'LIMA PERU', 'GRACIAS POR SU PREFERENCIA', 'logo.png');

-- Volcando estructura para tabla alquiler.documentos
CREATE TABLE IF NOT EXISTS `documentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `documento` varchar(20) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla alquiler.documentos: ~2 rows (aproximadamente)

-- Volcando estructura para tabla alquiler.marcas
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla alquiler.marcas: ~8 rows (aproximadamente)
INSERT INTO `marcas` (`id`, `marca`, `estado`, `fecha`) VALUES
	(1, 'FERRARI', 1, '2021-11-11 18:45:57'),
	(2, 'HONDA', 1, '2021-11-11 18:46:06'),
	(3, 'NISAN', 1, '2021-11-11 18:46:19'),
	(4, 'TOYOTA', 1, '2021-11-11 18:46:28'),
	(5, 'VOLVO', 1, '2021-11-11 18:46:38'),
	(6, 'SUZUKI', 1, '2021-11-11 18:46:53'),
	(7, 'MORGAN', 1, '2021-11-11 18:47:22'),
	(8, 'TESLA', 1, '2021-11-11 18:47:30');

-- Volcando estructura para tabla alquiler.reservas
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `f_recogida` datetime NOT NULL,
  `f_entrega` datetime NOT NULL,
  `cantidad` int NOT NULL DEFAULT '0',
  `tipo_precio` int NOT NULL DEFAULT '1',
  `monto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `f_reserva` datetime NOT NULL,
  `observacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `estado` int NOT NULL DEFAULT '0',
  `id_vehiculo` int NOT NULL,
  `id_cliente` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla alquiler.reservas: ~2 rows (aproximadamente)

-- Volcando estructura para tabla alquiler.tipos
CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla alquiler.tipos: ~7 rows (aproximadamente)
INSERT INTO `tipos` (`id`, `tipo`, `estado`, `fecha`) VALUES
	(1, 'CAMIONETA', 1, '2021-11-11 14:44:50'),
	(2, 'MINI BAN', 1, '2021-11-11 14:46:20'),
	(3, 'MOTOCICLETA', 1, '2021-11-11 18:48:32'),
	(4, 'MOTO CARRO', 1, '2021-11-11 18:48:55'),
	(5, 'TURISMO', 1, '2021-11-11 18:49:13'),
	(6, 'CAMION', 1, '2021-11-11 18:49:21'),
	(7, 'Furgón', 1, '2021-11-11 18:49:54'),
	(8, 'Mercedes Grand Sedan', 1, '2023-11-09 18:40:29');

-- Volcando estructura para tabla alquiler.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `correo` varchar(80) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `perfil` varchar(50) NOT NULL DEFAULT 'avatar.svg',
  `clave` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla alquiler.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `apellido`, `correo`, `telefono`, `direccion`, `perfil`, `clave`, `fecha`, `estado`) VALUES
	(1, 'ADMIN', 'VIDA INFORMÁTICO', 'SITIO WEB', 'admin@angelsifuentes.com', '925491523', 'HUARI - ANCASH', '20231114201652.jpg', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2023-11-15 16:17:19', 1);

-- Volcando estructura para tabla alquiler.vehiculos
CREATE TABLE IF NOT EXISTS `vehiculos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `placa` varchar(50) NOT NULL,
  `precio_hora` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_dia` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_mes` decimal(10,2) NOT NULL DEFAULT '0.00',
  `modelo` varchar(50) NOT NULL,
  `kilometraje` varchar(50) NOT NULL,
  `transmision` varchar(50) NOT NULL,
  `asientos` int NOT NULL DEFAULT '0',
  `equipaje` varchar(50) NOT NULL,
  `combustible` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_tipo` int NOT NULL,
  `id_marca` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_marca` (`id_marca`),
  KEY `id_tipo` (`id_tipo`),
  CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla alquiler.vehiculos: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
