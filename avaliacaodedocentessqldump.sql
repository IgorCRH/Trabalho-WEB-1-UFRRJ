-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Jul-2023 às 19:55
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avaliacaodedocentes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `CodigoDiscente` int(11) NOT NULL,
  `CodigoDocente` int(11) NOT NULL,
  `NotadeOrganizacaodasAulas` double(3,1) DEFAULT NULL,
  `NotadoPlanodeCurso` double(3,1) DEFAULT NULL,
  `NotadeDidatica` double(3,1) DEFAULT NULL,
  `NotadeEsclarecimentodeDuvidas` double(3,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`CodigoDiscente`, `CodigoDocente`, `NotadeOrganizacaodasAulas`, `NotadoPlanodeCurso`, `NotadeDidatica`, `NotadeEsclarecimentodeDuvidas`) VALUES
(1, 1, 4.0, 3.0, 2.0, 2.0),
(2, 1, 3.0, 1.0, 4.0, 5.0),
(2, 3, 5.0, 3.0, 1.0, 2.0),
(4, 3, 5.0, 4.0, 3.0, 1.0),
(5, 1, 4.0, 5.0, 5.0, 1.0),
(6, 1, 4.0, 3.0, 3.0, 1.0),
(7, 2, 3.0, 3.0, 4.0, 1.0),
(7, 3, 1.0, 5.0, 5.0, 4.0),
(7, 4, 5.0, 1.0, 1.0, 4.0),
(10, 1, 5.0, 5.0, 3.0, 1.0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `docente`
--

CREATE TABLE `docente` (
  `CodigoDocente` int(11) NOT NULL,
  `Nome` varchar(80) DEFAULT NULL,
  `CPF` varchar(14) DEFAULT NULL,
  `DataNascimento` date DEFAULT NULL,
  `Departamento` varchar(90) DEFAULT NULL,
  `Curso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `docente`
--

INSERT INTO `docente` (`CodigoDocente`, `Nome`, `CPF`, `DataNascimento`, `Departamento`, `Curso`) VALUES
(1, 'Fernando Maciel', '994.653.450-91', '1996-03-05', 'Computação', 'Sistemas de Informação'),
(2, 'Mauricio Alexandre', '784.453.870-81', '1992-04-15', 'Fitotecnia', 'Agronomia'),
(3, 'Victor Rosa', '484.361.730-07', '1999-11-16', 'Letras e Comunicação Social', 'Letras'),
(4, 'Fábio Costa', '218.213.760-21', '1992-10-19', 'Petrologia e Geotecnia', 'Geologia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `respondente`
--

CREATE TABLE `respondente` (
  `CodigoDiscente` int(11) NOT NULL,
  `Nome` varchar(80) DEFAULT NULL,
  `CPF` varchar(14) DEFAULT NULL,
  `DataNascimento` date DEFAULT NULL,
  `Peso` float NOT NULL,
  `Altura` float NOT NULL,
  `Horas_Sono_Dia` int(11) NOT NULL,
  `Senha` varchar(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PrimeiroLogin` tinyint(1) NOT NULL DEFAULT '1',
  `AcessoAtivo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `respondente`
--

INSERT INTO `respondente` (`CodigoDiscente`, `Nome`, `CPF`, `DataNascimento`, `Peso`, `Altura`, `Horas_Sono_Dia`, `Senha`, `Email`, `PrimeiroLogin`, `AcessoAtivo`) VALUES
(1, 'Aladdin de Jasmine e Abu', '209.720.440-60', '2000-06-06', 90, 1.7, 6, '3adb15v', 'aladin20@gmail.com', 0, 1),
(2, 'Rodolfo Pietro Filiberto Raffaelo Guglielm', '418.070.780-27', '1960-02-28', 60, 1.69, 8, 'g3tabs', 'rodilindo20@rocketmail.com, pietroro@outlook.com', 0, 1),
(3, 'Naruto Uzumaki', '624.047.300-61', '2005-05-03', 111, 1.64, 12, 'vibora305', 'narutouzumaki35@rocketmail.com', 0, 1),
(4, 'Vegeta IV.', '747.966.160-63', '1980-07-02', 78, 1.65, 6, 'marcelovb4', 'vegetawarrior30@gmail.com', 0, 1),
(5, 'Kakarotto Son Goku', '938.995.160-79', '1984-09-01', 132, 1, 7, 'kakafera51', 'kakasgoku@gmail.com', 0, 1),
(6, 'Marcela Almeidina', '564.513.990-94', '1996-10-05', 80, 1.7, 9, 'naosou arr', 'marcealmeida25@gmail.com, almeidinhasra@yahoo.com', 0, 1),
(7, 'Pastor Sanderson', '048.281.980-40', '1992-04-28', 150, 1.79, 3, 'sandinnaoe', 'sandincria@gmail.com', 0, 1),
(8, 'Matias Moreira', '449.078.900-95', '2015-11-12', 75, 1.86, 7, 'poqueisso2', 'tseridonme@protonmail.com', 0, 1),
(9, 'Emily Ferraz', '427.149.840-88', '1989-05-15', 98, 1.94, 12, 'emiferraz5', 'claramlyferraz@gmail.com, clarinhafer@rocketmail.com, claraz@uol.com.br', 0, 0),
(10, 'Robert Rodrigo', '220.193.600-55', '1998-10-22', 93, 1.95, 10, 'rodrirb35', 'rodrig251@outlook.com, rodriguinho31@uol.com.br', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`CodigoDiscente`,`CodigoDocente`),
  ADD KEY `CodigoDocente` (`CodigoDocente`);

--
-- Indexes for table `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`CodigoDocente`),
  ADD UNIQUE KEY `CPF` (`CPF`);

--
-- Indexes for table `respondente`
--
ALTER TABLE `respondente`
  ADD PRIMARY KEY (`CodigoDiscente`),
  ADD UNIQUE KEY `CPF` (`CPF`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `docente`
--
ALTER TABLE `docente`
  MODIFY `CodigoDocente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `respondente`
--
ALTER TABLE `respondente`
  MODIFY `CodigoDiscente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`CodigoDiscente`) REFERENCES `respondente` (`CodigoDiscente`),
  ADD CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`CodigoDocente`) REFERENCES `docente` (`CodigoDocente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
