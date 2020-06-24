CREATE SCHEMA `escola1` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;


CREATE TABLE `usuarios` (
  `id`int(10) primary key NOT NULL AUTO_INCREMENT ,
  `nome` varchar(220) NOT NULL,
  `matricula` varchar(220) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `tipo` text NOT NULL
) 


use escola1;


INSERT INTO `usuarios` (`nome`, `matricula`, `senha`, `tipo`) VALUES
('Eliabe Guerreiro da Paz', '0000', '$2y$10$HTkPAlcGnFkwFcW.PCKw8OHZGOiseiTohH4Lw7Et2f60R4tN/bo7S', 'Admin');




CREATE TABLE `aulas` (
  `id`int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT ,
  `num_fila` varchar(220) NOT NULL,
  `link` varchar(220) NOT NULL,
  `sala` varchar(220) NOT NULL
) 


INSERT INTO `aulas` (`num_fila`, `link`, `sala`) VALUES
('1', 'e2qG5uwDCW4', 'sala01');


CREATE TABLE `entrada` (
  `id` int(10) NOT NULL,
  `matricula` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `entrada` varchar(200) COLLATE utf8_unicode_ci NOT NULL
)


CREATE TABLE `sessoes` (
  `id` int(10) NOT NULL,
  `nome` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `matricula` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dia` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `entrada` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `saida` varchar(10) COLLATE utf8_unicode_ci NOT NULL
)