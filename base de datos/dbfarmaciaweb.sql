SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `dbfarmaciaweb`
--




CREATE TABLE `carrito` (
  `idproducto` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `presentacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(18,2) NOT NULL,
  `descuento` decimal(18,2) NOT NULL,
  `importe` decimal(18,2) NOT NULL,
  `session_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `carritoc` (
  `idproducto` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `presentacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(18,2) NOT NULL,
  `importe` decimal(18,2) NOT NULL,
  `session_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `forma_farmaceutica` varchar(255) NOT NULL,
  `ff_simplificada` varchar(255) NOT NULL,
  `idsucu_c` int(11) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) NOT NULL,
  `documento` char(8) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `idsucu_c` int(11) NOT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO cliente VALUES
("1","publico en general","","","","","1");




CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `idlab_pro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` decimal(18,2) NOT NULL,
  `igv` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `docu` varchar(30) NOT NULL,
  `num_docu` char(50) NOT NULL,
  `idsucu_c` int(11) NOT NULL,
  PRIMARY KEY (`idcompra`),
  KEY `FK_compra_proveedor_idprovedor` (`idlab_pro`),
  CONSTRAINT `FK_compra_laboratorio_proveedor_idlab_pro` FOREIGN KEY (`idlab_pro`) REFERENCES `laboratorio_proveedor` (`idlab_pro`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `configuracion` (
  `idconfi` int(11) NOT NULL,
  `logo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `empresa` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `moneda` varchar(255) CHARACTER SET latin1 NOT NULL,
  `imp_num` varchar(30) CHARACTER SET latin1 NOT NULL,
  `imp_letra` varchar(10) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idconfi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO configuracion VALUES
("1","logo2.jpg","SISFARMA UMG","Q.","7","IVA");




CREATE TABLE `detallecompra` (
  `idcompra` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` decimal(18,2) NOT NULL,
  `precio` decimal(18,2) NOT NULL,
  `importe` decimal(18,2) NOT NULL,
  KEY `FK_detallecompra_productos_idproducto` (`idproducto`),
  KEY `FK_detallecompra_compra_idcompra` (`idcompra`),
  CONSTRAINT `FK_detallecompra_compra_idcompra` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`),
  CONSTRAINT `FK_detallecompra_productos_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `detalleventa` (
  `idventa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` decimal(18,2) NOT NULL,
  `precio` decimal(18,2) NOT NULL,
  `descuento` decimal(18,2) NOT NULL,
  `importe` decimal(18,2) NOT NULL,
  KEY `FK_detalleventa_productos_idproducto` (`idproducto`),
  KEY `FK_detalleventa_venta_idventa` (`idventa`),
  CONSTRAINT `FK_detalleventa_productos_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`),
  CONSTRAINT `FK_detalleventa_venta_idventa` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `laboratorio_proveedor` (
  `idlab_pro` int(11) NOT NULL AUTO_INCREMENT,
  `laboratorio` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `ruc` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `idsucu_c` int(11) NOT NULL,
  PRIMARY KEY (`idlab_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `lote` (
  `idlote` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `idsucu_c` int(11) NOT NULL,
  PRIMARY KEY (`idlote`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `presentacion` (
  `idpresentacion` int(11) NOT NULL AUTO_INCREMENT,
  `presentacion` varchar(255) NOT NULL,
  `idsucu_c` int(11) NOT NULL,
  PRIMARY KEY (`idpresentacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `producto_similar` (
  `idp_similar` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `presentacion` varchar(255) NOT NULL,
  PRIMARY KEY (`idp_similar`),
  KEY `FK_producto_similar_productos_idproducto` (`idproducto`),
  CONSTRAINT `FK_producto_similar_productos_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  `idlote` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `stockminimo` int(11) NOT NULL,
  `precio_compra` decimal(18,2) NOT NULL,
  `precio_venta` decimal(18,2) NOT NULL,
  `descuento` decimal(18,2) DEFAULT NULL,
  `ventasujeta` varchar(50) NOT NULL,
  `fecha_registro` date NOT NULL,
  `reg_sanitario` varchar(255) DEFAULT NULL,
  `idcategoria` int(11) NOT NULL,
  `idpresentacion` int(11) NOT NULL,
  `idlab_pro` int(11) NOT NULL,
  `idsintoma` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `idsucu_c` int(11) NOT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `FK_productos_presentacion_idpresentacion` (`idpresentacion`),
  KEY `FK_productos_categoria_idcategoria` (`idcategoria`),
  KEY `FK_productos_laboratorio_idlab` (`idlab_pro`),
  KEY `FK_productos_sintoma_idsintoma` (`idsintoma`),
  KEY `FK_productos_lote_idlote` (`idlote`),
  CONSTRAINT `FK_productos_categoria_idcategoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_productos_laboratorio_proveedor_idlab_pro` FOREIGN KEY (`idlab_pro`) REFERENCES `laboratorio_proveedor` (`idlab_pro`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_productos_lote_idlote` FOREIGN KEY (`idlote`) REFERENCES `lote` (`idlote`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_productos_presentacion_idpresentacion` FOREIGN KEY (`idpresentacion`) REFERENCES `presentacion` (`idpresentacion`),
  CONSTRAINT `FK_productos_sintoma_idsintoma` FOREIGN KEY (`idsintoma`) REFERENCES `sintoma` (`idsintoma`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `sintoma` (
  `idsintoma` int(11) NOT NULL AUTO_INCREMENT,
  `sintoma` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idsucu_c` int(11) NOT NULL,
  PRIMARY KEY (`idsintoma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `sucursal` (
  `idsucursal` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `ruc_letra` varchar(30) NOT NULL,
  `ruc_num` char(30) NOT NULL,
  `representante` varchar(255) DEFAULT NULL,
  `serie` varchar(50) NOT NULL,
  PRIMARY KEY (`idsucursal`),
  UNIQUE KEY `direccion` (`direccion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO sucursal VALUES
("5","Farmacia UMG","Antigua","45621454","UMG","01","Christopher Jimenez","0");




CREATE TABLE `sucursal_usuario` (
  `idsucu_usu` int(11) NOT NULL AUTO_INCREMENT,
  `idsucu` int(11) NOT NULL,
  `idusuu` int(11) NOT NULL,
  PRIMARY KEY (`idsucu_usu`),
  KEY `FK_sucursal_usuario_usuario_idusu` (`idusuu`),
  KEY `FK_sucursal_usuario_sucursal_idsucursal` (`idsucu`),
  CONSTRAINT `FK_sucursal_usuario_sucursal_idsucursal` FOREIGN KEY (`idsucu`) REFERENCES `sucursal` (`idsucursal`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sucursal_usuario_usuario_idusu` FOREIGN KEY (`idusuu`) REFERENCES `usuario` (`idusu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO sucursal_usuario VALUES
("1","5","1");




CREATE TABLE `usuario` (
  `idusu` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `cargo_usu` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fechaingreso` date NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `estado` varchar(30) NOT NULL,
  PRIMARY KEY (`idusu`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO usuario VALUES
("1","cjimenez","8bc27d0fe7597042436b8bb4d8247862","administrador","christopher orlando","cjimenez@miumg.edu.gt","41687174","2022-09-17","ADMINISTRADOR","Activo");




CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` decimal(18,2) NOT NULL,
  `igv` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `efectivo` decimal(18,2) DEFAULT NULL,
  `vuelto` decimal(18,2) DEFAULT NULL,
  `tipo_docu` varchar(30) NOT NULL,
  `num_docu` varchar(255) NOT NULL,
  `serie` varchar(50) NOT NULL,
  `idsucu_c` int(11) NOT NULL,
  PRIMARY KEY (`idventa`),
  KEY `FK_venta_usuario_idusu` (`idusuario`),
  KEY `FK_venta_cliente_idcliente` (`idcliente`),
  CONSTRAINT `FK_venta_cliente_idcliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_venta_usuario_idusu` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;