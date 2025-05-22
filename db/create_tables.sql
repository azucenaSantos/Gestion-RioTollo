CREATE TABLE `grupos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(25) NOT NULL,
    `id_coordinador` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `id_coordinadora` (`id_coordinador`)
);
CREATE TABLE `grupos_trabajadores` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `trabajador_nombre` varchar(50) NOT NULL,
    `id_grupo` int(11) NOT NULL,
    `id_trabajador` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `id_grupo` (`id_grupo`),
    KEY `id_trabajador` (`id_trabajador`)
);
CREATE TABLE `ms_roles` (
    `id` int(11) NOT NULL,
    `nombre` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
);
CREATE TABLE `trabajos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(50) NOT NULL,
    `zona` varchar(25) NOT NULL,
    `parcelas` varchar(50) NOT NULL,
    `porcentaje` int(11) NOT NULL,
    `finalizado` tinyint(1) NOT NULL DEFAULT 0,
    `hora_inicio` time NOT NULL,
    `hora_fin` time NOT NULL,
    `fecha` date NOT NULL,
    `anotaciones` varchar(100) NOT NULL,
    `id_zona` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `id_zona` (`id_zona`)
);
CREATE TABLE `trabajos_grupos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_trabajo` int(11) NOT NULL,
    `id_grupo` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `id_trabajo` (`id_trabajo`),
    KEY `id_grupo` (`id_grupo`)
);
CREATE TABLE `trabajos_parcelas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_parcela` int(11) NOT NULL,
    `id_trabajo` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `trabajos_parcelas_ibfk_1` (`id_parcela`),
    KEY `trabajos_parcelas_ibfk_2` (`id_trabajo`)
);
CREATE TABLE `trabajos_registro` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_grupo` int(11) NOT NULL,
    `id_trabajo` int(11) NOT NULL,
    `porcentaje_inicial` int(11) NOT NULL,
    `porcentaje_final` int(11) NOT NULL,
    `hora_inicio` time NOT NULL,
    `hora_fin` time NOT NULL,
    `fecha` date NOT NULL,
    PRIMARY KEY (`id`),
    KEY `id_grupo` (`id_grupo`),
    KEY `id_trabajo` (`id_trabajo`)
);
CREATE TABLE `usuarios` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(30) NOT NULL,
    `apellido` varchar(30) NOT NULL,
    `nombre_usuario` varchar(50) NOT NULL,
    `contrasena` varchar(60) NOT NULL,
    `contrasena_cambiada` tinyint(1) NOT NULL DEFAULT 0,
    `id_rol` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `id_rol` (`id_rol`)
);
CREATE TABLE `zonas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(25) NOT NULL,
    `limites` text NOT NULL,
    PRIMARY KEY (`id`)
);
CREATE TABLE `zonas_parcelas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `num_parcela` int(11) NOT NULL,
    `descripcion` text NOT NULL,
    `id_zona` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `id_zona` (`id_zona`)
);