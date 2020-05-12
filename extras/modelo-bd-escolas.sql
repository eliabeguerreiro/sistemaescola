CREATE SCHEMA `escola1` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;


CREATE TABLE escola1.`usuarios` (
  `id`int(10) primary key NOT NULL NULL AUTO_INCREMENT ,
  `nome` varchar(220) NOT NULL,
  `matricula` varchar(220) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `tipo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4_900_ai_ci;


use escola1;


INSERT INTO `usuarios` (`nome`, `matricula`, `senha`, `tipo`) VALUES
('Eliabe Guerreiro da Paz', '0000', '$2y$10$HTkPAlcGnFkwFcW.PCKw8OHZGOiseiTohH4Lw7Et2f60R4tN/bo7S', 'Admin');




CREATE TABLE escola1.`aulas` (
  `id`int(10) PRIMARY KEY NOT NULL NULL AUTO_INCREMENT ,
  `num_fila` varchar(220) NOT NULL,
  `link` varchar(220) NOT NULL,
  `sala` varchar(220) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4_900_ai_ci;


INSERT INTO `aulas` (`num_fila`, `link`, `sala`) VALUES
('1', 'e2qG5uwDCW4', 'sala01');
