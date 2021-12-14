CREATE DATABASE `usuarios_ds_noite`;

USE usuarios_ds_noite;

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(11) AUTO_INCREMENT,
`nome` varchar(255) DEFAULT NULL,
`email` varchar(255) UNIQUE DEFAULT NULL,
`sexo` varchar(10) DEFAULT NULL,
`telefone` varchar(25) DEFAULT NULL,
`senha` varchar(255) DEFAULT NULL,
`dtnasc` varchar(25) DEFAULT NULL,
`tipo` varchar(25) DEFAULT NULL,
`avatar` varchar(255) DEFAULT NULL,
`data` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;