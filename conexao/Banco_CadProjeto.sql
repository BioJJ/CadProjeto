

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `data_nascimento` date NOT NULL,
  `logradouro` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `cep` int(20) NOT NULL,
  `idcurso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `idprofessor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `professor` (
  `id_professor` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_criacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `idcurso` (`idcurso`);

ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `idprofessor` (`idprofessor`);


ALTER TABLE `professor`
  ADD PRIMARY KEY (`id_professor`);


ALTER TABLE `aluno`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `professor`
  MODIFY `id_professor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;


ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`id_curso`);


ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`idprofessor`) REFERENCES `professor` (`id_professor`);
COMMIT;


