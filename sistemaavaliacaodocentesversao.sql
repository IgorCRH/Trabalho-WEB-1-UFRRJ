-- Criação da tabela Respondente
CREATE TABLE Respondente (
  CodigoDiscente INT PRIMARY KEY AUTO_INCREMENT,
  Nome VARCHAR(80),
  CPF VARCHAR(14) UNIQUE,
  DataNascimento DATE,
  Peso FLOAT NOT NULL,
  Altura FLOAT NOT NULL,
  Horas_Sono_Dia INT(11) NOT NULL,
  Senha VARCHAR(10) NOT NULL,
  Email VARCHAR(100) NOT NULL
);

-- Criação da tabela Docente
CREATE TABLE Docente (
  CodigoDocente INT PRIMARY KEY AUTO_INCREMENT,
  Nome VARCHAR(80),
  CPF VARCHAR(14) UNIQUE,
  DataNascimento DATE,
  Departamento VARCHAR(90),
  Curso VARCHAR(50)
);

-- Criação da tabela Avaliação
CREATE TABLE Avaliacao (
  CodigoDiscente INT,
  CodigoDocente INT,
  NotadeOrganizacaodasAulas DOUBLE(3,1),
  NotadoPlanodeCurso DOUBLE(3,1),
  NotadeDidatica DOUBLE(3,1),
  NotadeEsclarecimentodeDuvidas DOUBLE(3,1),
  PRIMARY KEY (CodigoDiscente, CodigoDocente),
  FOREIGN KEY (CodigoDiscente) REFERENCES Respondente(CodigoDiscente),
  FOREIGN KEY (CodigoDocente) REFERENCES Docente(CodigoDocente)
);

-- Inserção de dados na tabela Docente
INSERT INTO Docente (Nome, CPF, DataNascimento, Departamento, Curso)
VALUES ('Fernando Maciel', '994.653.450-91', '1996-03-05', 'Computação', 'Sistemas de Informação'),
       ('Mauricio Alexandre', '784.453.870-81', '1992-04-15', 'Fitotecnia', 'Agronomia'),
       ('Victor Rosa', '484.361.730-07', '1999-11-16', 'Letras e Comunicação Social', 'Letras'),
       ('Fábio Costa', '218.213.760-21', '1992-10-19', 'Petrologia e Geotecnia', 'Geologia');

-- Inserção de dados na tabela Respondente
INSERT INTO `Respondente` (`Nome`, `CPF`, `DataNascimento`, `Peso`, `Altura`, `Horas_Sono_Dia`,  `Senha`, `Email`) VALUES
('Aladdin de Jasmine e Abu', '209.720.440-60', '2000-06-06', 90, 1.7, 6, '9MWU8US9', 'aladin20@gmail.com'),
('Rodolfo Pietro Filiberto Raffaelo Guglielm', '418.070.780-27', '1960-02-28', 60, 1.69, 8, '4SI4G9D9', 'rodpietro15@yahoo.com'),
('Naruto Uzumaki', '624.047.300-61', '2005-05-03', 111, 1.64, 12, '0CNB76TK', 'narutouzumaki35@rocketmail.com'),
('Vegeta IV.', '747.966.160-63', '1980-07-02', 78, 1.65, 6, '18ELP7PT', 'vegetawarrior30@gmail.com'),
('Kakarotto Son Goku', '938.995.160-79', '1984-09-01', 132, 1, 7, '7EXQ8KRW', 'kakasgoku@gmail.com');

ALTER TABLE Respondente
ADD PrimeiroLogin TINYINT(1) NOT NULL DEFAULT 1 AFTER Email;

UPDATE Respondente
SET PrimeiroLogin = 1;

ALTER TABLE Respondente ADD COLUMN AcessoAtivo BOOLEAN NOT NULL DEFAULT 1;