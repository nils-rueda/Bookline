CREATE DATABASE `bddlibreria`;
USE `bddlibreria`;

-- --------------------------------------------------------------------------------------

DROP TABLE IF EXISTS `tablalibros`;

CREATE TABLE `tablalibros`(
  `idlibro` int,
  `Autor` varchar(50),
  `Titulo` varchar(100),
  `Genero` varchar(50),
  `Precio` int,
  `Stock` int,
  PRIMARY KEY (`idlibro`)
);

INSERT INTO `tablalibros` VALUES (6534,'Borges','El Aleph','Ficcion', 19, 100);
INSERT INTO `tablalibros` VALUES (2434,'Wilde','El retrato de Dorian Grey', 'Ficcion', 23, 100);
INSERT INTO `tablalibros` VALUES (3444,'Harari','Homo Deus','Ensayo', 29, 100);
INSERT INTO `tablalibros` VALUES (0438,'Schopenhauer','El mundo como voluntad y representacion','Ensayo', 31, 70);
INSERT INTO `tablalibros` VALUES (0439,'B. Russell','Sobre los problemas de la filosofia','Ensayo', 19, 70);
INSERT INTO `tablalibros` VALUES (4518,'Lorca','Poeta en NY','Poesia', 9, 100);
INSERT INTO `tablalibros` VALUES (5219,'T. Mann','La montaña magica','Ficcion', 9, 100);
INSERT INTO `tablalibros` VALUES (5217,'Herbert','Dune','Ficcion', 19, 200);
INSERT INTO `tablalibros` VALUES (5216,'Fitzgerald','El gran Gatsby','Ficcion', 29, 400);
INSERT INTO `tablalibros` VALUES (5215,'Fromm','El miedo a la libertad','Ensayo', 13, 90);
INSERT INTO `tablalibros` VALUES (5214,'Tussell','Historia Contemporanea Universal','Ensayo', 31, 70);
INSERT INTO `tablalibros` VALUES (5213,'Freud','El malestar en la cultura','Ensayo', 11, 40);

-- --------------------------------------------------------------------------------------

DROP TABLE IF EXISTS `tablausuarios`;

CREATE TABLE `tablausuarios`(
  `usuarioID` int NOT NULL AUTO_INCREMENT, 
  -- A continuación: CHECK es un 'CONSTRAINT'. En "`puesto`" sólo puede haber 3 tipos específicos: administrador, empleado, o cliente.
  `puesto` varchar(30) CHECK (`puesto`='administrador' OR `puesto`='empleado' OR `puesto`='cliente'), 
  `email` varchar(100),
  `contrasena` varchar(100),
  `nombre` varchar(30),
  PRIMARY KEY (`usuarioID`)
);


INSERT INTO `tablausuarios`(`puesto`, `email`, `contrasena`, `nombre`) VALUES ('administrador', 'fanta@xmail.com', '1234', 'fanta');

INSERT INTO `tablausuarios`(`puesto`, `email`, `contrasena`, `nombre`) VALUES ('empleado', 'gil@xmail.com', '1234', 'fernando_gil');
INSERT INTO `tablausuarios`(`puesto`, `email`, `contrasena`, `nombre`) VALUES ('empleado', 'dav@xmail.com', '1234', 'david_phi');
INSERT INTO `tablausuarios`(`puesto`, `email`, `contrasena`, `nombre`) VALUES ('empleado', 'lema@xmail.com', '1234', 'elena_phi');

INSERT INTO `tablausuarios`(`puesto`, `email`, `contrasena`, `nombre`) VALUES ('cliente', 'cooper@xmail.com', '1234', 'cooper');
INSERT INTO `tablausuarios`(`puesto`, `email`, `contrasena`, `nombre`) VALUES ('cliente', 'truman@xmail.com', '1234', 'truman');
INSERT INTO `tablausuarios`(`puesto`, `email`, `contrasena`, `nombre`) VALUES ('cliente', 'lucy@xmail.com', '1234', 'lucy');
INSERT INTO `tablausuarios`(`puesto`, `email`, `contrasena`, `nombre`) VALUES ('cliente', 'andy@xmail.com', '1234', 'andy');
INSERT INTO `tablausuarios`(`puesto`, `email`, `contrasena`, `nombre`) VALUES ('cliente', 'letsrock@xmail.com', '1234', 'theArm');


-- --------------------------------------------------------------------------------------

DROP TABLE IF EXISTS `tablacompraventas`;

CREATE TABLE `tablacompraventas`(
  `id_compraventa` int NOT NULL AUTO_INCREMENT,
  `fecha_compraventa` date,
  `idlibro` int NOT NULL,
  `precio_unidad` int,
  PRIMARY KEY (`id_compraventa`)
);