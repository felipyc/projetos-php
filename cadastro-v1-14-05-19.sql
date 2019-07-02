-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15-Maio-2019 às 02:43
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `banco`
--

CREATE TABLE IF NOT EXISTS `banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titular` varchar(100) NOT NULL,
  `agencia` int(11) NOT NULL,
  `conta` int(11) NOT NULL,
  `digito` tinyint(3) unsigned NOT NULL,
  `senha` varchar(50) NOT NULL,
  `saldo` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `banco`
--

INSERT INTO `banco` (`id`, `titular`, `agencia`, `conta`, `digito`, `senha`, `saldo`) VALUES
(1, 'Felipy Camargo de Souza', 8695, 33451, 1, '2527d6ee36e5d91ced907633b787976c', 932510);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `idcurso` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(30) NOT NULL,
  `descricao` text,
  `carga` int(10) unsigned DEFAULT NULL,
  `totaulas` int(10) unsigned DEFAULT NULL,
  `ano` year(4) DEFAULT '2016',
  PRIMARY KEY (`idcurso`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`idcurso`, `nome`, `descricao`, `carga`, `totaulas`, `ano`) VALUES
(1, 'HTML5', 'Curso de HTML5', 40, 37, 2014),
(2, 'Algoritmos', 'Lógica de Programação', 20, 15, 2014),
(3, 'Photoshop5', 'Dicas de Photoshop CC', 10, 8, 2014),
(4, 'PHP', 'Curso de PHP para iniciantes', 40, 20, 2015),
(5, 'Java', 'Introdução à Linguagem Java', 40, 29, 2015),
(6, 'MySQL', 'Bancos de Dados MySQL', 30, 15, 2016),
(7, 'Word', 'Curso completo de Word', 40, 30, 2016),
(8, 'Python', 'Curso de Python', 40, 18, 2017),
(9, 'POO', 'Curso de Programação Orientada a Objetos', 60, 35, 2016),
(10, 'Excel', 'Curso completo de Excel', 40, 30, 2017),
(11, 'Responsividade', 'Curso de Responsividade', 30, 15, 2018),
(12, 'C++', 'Curso de C++ com Orientação a Objetos', 40, 25, 2017),
(13, 'C#', 'Curso de C#', 30, 12, 2017),
(14, 'Android', 'Curso de Desenvolvimento de Aplicativos para Android', 60, 30, 2018),
(15, 'JavaScript', 'Curso de JavaScript', 35, 18, 2017),
(16, 'PowerPoint', 'Curso completo de PowerPoint', 30, 12, 2018),
(17, 'Swift', 'Curso de Desenvolvimento de Aplicativos para iOS', 60, 30, 2019),
(18, 'Hardware', 'Curso de Montagem e Manutenção de PCs', 30, 12, 2017),
(19, 'Redes', 'Curso de Redes para Iniciantes', 40, 15, 2016),
(20, 'Segurança', 'Curso de Segurança', 15, 8, 2018),
(21, 'SEO', 'Curso de Otimização de Sites', 30, 12, 2017),
(22, 'Premiere', 'Curso de Edição de Vídeos com Premiere', 20, 10, 2017),
(23, 'After Effects', 'Curso de Efeitos em Vídeos com After Effects', 20, 10, 2018),
(24, 'WordPress', 'Curso de Criação de Sites com WordPress', 60, 30, 2019),
(25, 'Joomla', 'Curso de Criação de Sites com Joomla', 60, 30, 2019),
(26, 'Magento', 'Curso de Criação de Lojas Virtuais com Magento', 50, 25, 2019),
(27, 'Modelagem de Dados', 'Curso de Modelagem de Dados', 30, 12, 2020),
(28, 'HTML4', 'Curso Básico de HTML, versão 4.0', 20, 9, 2010),
(29, 'PHP7', 'Curso de PHP, versão 7.0', 40, 20, 2020),
(30, 'PHP4', 'Curso de PHP, versão 4.0', 30, 11, 2010);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gafanhotos`
--

CREATE TABLE IF NOT EXISTS `gafanhotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `profissao` varchar(20) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `sexo` enum('M','F') DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `altura` decimal(3,2) DEFAULT NULL,
  `nacionalidade` varchar(20) DEFAULT 'Brasil',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Extraindo dados da tabela `gafanhotos`
--

INSERT INTO `gafanhotos` (`id`, `nome`, `profissao`, `nascimento`, `sexo`, `peso`, `altura`, `nacionalidade`) VALUES
(1, 'Daniel Morais', 'Auxiliar Administrat', '1984-01-02', 'M', '78.50', '1.83', 'Brasil'),
(2, 'Talita Nascimento', 'Farmacêutico', '1999-12-30', 'F', '55.20', '1.65', 'Portugal'),
(3, 'Emerson Gabriel', 'Programador', '1920-12-30', 'M', '50.20', '1.65', 'Moçambique'),
(4, 'Lucas Damasceno', 'Auxiliar Administrat', '1930-11-02', 'M', '63.20', '1.75', 'Irlanda'),
(5, 'Leila Martins', 'Farmacêutico', '1975-04-22', 'F', '99.00', '2.15', 'Brasil'),
(6, 'Letícia Neves', 'Programador', '1999-12-03', 'F', '87.00', '2.00', 'Brasil'),
(7, 'Janaína Couto', 'Auxiliar Administrat', '1987-11-12', 'F', '75.40', '1.66', 'EUA'),
(8, 'Carlisson Rosa', 'Professor', '2010-08-01', 'M', '78.22', '1.98', 'Brasil'),
(9, 'Jackson Telles', 'Programador', '1999-01-23', 'M', '55.75', '1.33', 'Portugal'),
(10, 'Danilo Araujo', 'Dentista', '1975-12-10', 'M', '99.21', '1.87', 'EUA'),
(11, 'Andreia Delfino', 'Auxiliar Administrat', '1975-07-01', 'F', '48.64', '1.54', 'Irlanda'),
(12, 'Valter Vilmerson', 'Ator', '1985-10-12', 'M', '88.55', '2.03', 'Brasil'),
(13, 'Allan Silva', 'Programador', '1993-11-11', 'M', '76.99', '1.55', 'Brasil'),
(14, 'Rosana Kunz', 'Professor', '1935-01-16', 'F', '55.24', '1.87', 'Brasil'),
(15, 'Josiane Dutra', 'Empreendedor', '1950-01-20', 'F', '98.70', '1.04', 'Portugal'),
(16, 'Elvis Schwarz', 'Dentista', '2011-05-07', 'M', '66.69', '1.76', 'EUA'),
(17, 'Paulo Narley', 'Auxiliar Administrat', '1997-03-17', 'M', '120.10', '2.22', 'Brasil'),
(18, 'Joade Assis', 'Médico', '1930-12-01', 'M', '65.88', '1.78', 'França'),
(19, 'Nara Matos', 'Programador', '1978-03-17', 'F', '65.90', '1.33', 'Brasil'),
(20, 'Marcos Dissotti', 'Empreendedor', '2010-01-01', 'M', '53.79', '1.54', 'Portugal'),
(21, 'Ana Carolina Mendes', 'Ator', '2000-12-15', 'F', '88.30', '1.54', 'Brasil'),
(22, 'Guilherme de Sousa', 'Dentista', '2001-05-18', 'M', '132.70', '1.97', 'Moçambique'),
(23, 'Bruno Torres', 'Auxiliar Administrat', '2000-01-30', 'M', '44.65', '1.65', 'Brasil'),
(24, 'Yuji Homa', 'Empreendedor', '1996-12-25', 'M', '33.90', '1.22', 'Japão'),
(25, 'Raian Porto', 'Programador', '1989-05-05', 'M', '54.89', '1.54', 'Brasil'),
(26, 'Paulo Batista', 'Ator', '1999-03-15', 'M', '110.12', '1.87', 'Portugal'),
(27, 'Monique Precivalli', 'Auxiliar Administrat', '2013-12-30', 'F', '48.20', '1.22', 'Brasil'),
(28, 'Herisson Silva', 'Auxiliar Administrat', '1965-10-10', 'M', '74.65', '1.56', 'EUA'),
(29, 'Tiago Ulisses', 'Dentista', '1993-04-22', 'M', '150.30', '2.35', 'Brasil'),
(30, 'Anderson Rafael', 'Programador', '1989-12-01', 'M', '64.22', '1.44', 'Irlanda'),
(31, 'Karine Ribeiro', 'Empreendedor', '1988-10-01', 'F', '42.10', '1.65', 'Brasil'),
(32, 'Roberto Luiz Debarba', 'Ator', '2007-01-09', 'M', '77.44', '1.56', 'Brasil'),
(33, 'Jarismar Andrade', 'Dentista', '2000-06-23', 'F', '63.70', '1.33', 'Brasil'),
(34, 'Janaina Oliveira', 'Professor', '1955-03-12', 'F', '52.90', '1.76', 'Canadá'),
(35, 'Márcio Mello', 'Programador', '2011-11-20', 'M', '54.11', '1.55', 'EUA'),
(36, 'Robson Rodolpho', 'Auxiliar Administrat', '2000-08-08', 'M', '110.10', '1.76', 'Brasil'),
(37, 'Daniele Moledo', 'Empreendedor', '2006-08-11', 'F', '101.30', '1.99', 'Brasil'),
(38, 'Neto Sophiate', 'Ator', '1996-05-17', 'M', '59.28', '1.65', 'Portugal'),
(39, 'Neriton Dias', 'Auxiliar Administrat', '2009-10-30', 'M', '48.99', '1.29', 'Brasil'),
(40, 'André Schmidt', 'Programador', '1993-07-26', 'M', '55.37', '1.22', 'Angola'),
(41, 'Isaias Buscarino', 'Dentista', '2001-01-07', 'M', '99.90', '1.55', 'Moçambique'),
(42, 'Rafael Guimma', 'Empreendedor', '1968-04-11', 'M', '88.88', '1.54', 'Brasil'),
(43, 'Ana Carolina Hernandes', 'Ator', '1970-10-11', 'F', '65.40', '2.08', 'EUA'),
(44, 'Luiz Paulo', 'Professor', '1984-11-01', 'M', '75.12', '1.38', 'Portugal'),
(45, 'Bruna Teles', 'Programador', '1980-11-07', 'F', '55.10', '1.86', 'Brasil'),
(46, 'Diogo Padilha', 'Auxiliar Administrat', '2000-03-03', 'M', '54.34', '1.88', 'Angola'),
(47, 'Bruno Miltersteiner', 'Dentista', '1986-02-19', 'M', '77.45', '1.65', 'Alemanha'),
(48, 'Elaine Nunes', 'Programador', '1998-08-15', 'F', '35.90', '2.00', 'Canadá'),
(49, 'Silvio Ricardo', 'Programador', '2012-03-12', 'M', '65.99', '1.23', 'EUA'),
(50, 'Denilson Barbosa da Silva', 'Empreendedor', '2000-01-08', 'M', '97.30', '2.00', 'Brasil'),
(51, 'Jucinei Teixeira', 'Professor', '1977-11-22', 'F', '44.80', '1.76', 'Portugal'),
(52, 'Bruna Santos', 'Auxiliar Administrat', '1991-12-01', 'F', '76.30', '1.45', 'Canadá'),
(53, 'André Vitebo', 'Médico', '1970-07-01', 'M', '44.11', '1.55', 'Brasil'),
(54, 'Andre Santini', 'Programador', '1991-08-15', 'M', '66.00', '1.76', 'Itália'),
(55, 'Ruan Valente', 'Programador', '1998-03-19', 'M', '101.90', '1.76', 'Canadá'),
(56, 'Nailton Mauricio', 'Médico', '1992-04-25', 'M', '86.01', '1.43', 'EUA'),
(57, 'Rita Pontes', 'Professor', '1999-09-02', 'F', '54.10', '1.35', 'Angola'),
(58, 'Carlos Camargo', 'Programador', '2005-02-22', 'M', '124.65', '1.33', 'Brasil'),
(59, 'Philppe Oliveira', 'Auxiliar Administrat', '2000-05-23', 'M', '105.10', '2.19', 'Brasil'),
(60, 'Dayana Dias', 'Professor', '1993-05-30', 'F', '88.30', '1.66', 'Angola'),
(61, 'Silvana Albuquerque', 'Programador', '1999-05-22', 'F', '56.00', '1.50', 'Brasil');

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeriausers`
--

CREATE TABLE IF NOT EXISTS `galeriausers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `donoimagem` int(11) NOT NULL,
  `caminhodaimagem` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Extraindo dados da tabela `galeriausers`
--

INSERT INTO `galeriausers` (`id`, `donoimagem`, `caminhodaimagem`) VALUES
(1, 2, '2-1-galeria.jpeg'),
(2, 2, '2-2-galeria.jpeg'),
(3, 2, '2-3-galeria.jpeg'),
(4, 2, '2-4-galeria.jpeg'),
(5, 2, '2-5-galeria.jpeg'),
(6, 2, '2-6-galeria.jpeg'),
(7, 2, '2-7-galeria.jpeg'),
(8, 2, '2-8-galeria.jpeg'),
(9, 2, '2-9-galeria.jpeg'),
(10, 2, '2-10-galeria.jpeg'),
(11, 2, '2-11-galeria.jpeg'),
(12, 2, '2-12-galeria.png'),
(13, 2, '2-13-galeria.jpeg'),
(14, 2, '2-14-galeria.jpeg'),
(15, 2, '2-15-galeria.jpeg'),
(16, 3, '3-1-galeria.jpeg'),
(17, 3, '3-2-galeria.jpeg'),
(18, 3, '3-3-galeria.jpeg'),
(19, 3, '3-4-galeria.jpeg'),
(20, 3, '3-5-galeria.jpeg'),
(21, 3, '3-6-galeria.jpeg'),
(22, 3, '3-7-galeria.jpeg'),
(23, 3, '3-8-galeria.jpeg'),
(24, 3, '3-9-galeria.jpeg'),
(25, 3, '3-10-galeria.jpeg'),
(26, 3, '3-11-galeria.jpeg'),
(27, 3, '3-12-galeria.jpeg'),
(28, 3, '3-13-galeria.jpeg'),
(29, 3, '3-14-galeria.jpeg'),
(30, 3, '3-15-galeria.jpeg'),
(31, 7, '7-1-galeria.jpeg'),
(32, 7, '7-2-galeria.jpeg'),
(33, 7, '7-3-galeria.jpeg'),
(34, 7, '7-4-galeria.jpeg'),
(35, 7, '7-5-galeria.jpeg'),
(36, 7, '7-6-galeria.jpeg'),
(37, 7, '7-7-galeria.jpeg'),
(38, 7, '7-8-galeria.jpeg'),
(39, 7, '7-9-galeria.jpeg'),
(40, 7, '7-10-galeria.jpeg'),
(41, 7, '7-11-galeria.jpeg'),
(42, 7, '7-12-galeria.jpeg'),
(43, 7, '7-13-galeria.jpeg'),
(44, 7, '7-14-galeria.jpeg'),
(45, 7, '7-15-galeria.jpeg'),
(46, 8, '8-1-galeria.jpeg'),
(47, 8, '8-2-galeria.jpeg'),
(48, 8, '8-3-galeria.jpeg'),
(49, 8, ''),
(50, 8, ''),
(51, 8, ''),
(52, 8, ''),
(53, 8, ''),
(54, 8, ''),
(55, 8, ''),
(56, 8, ''),
(57, 8, ''),
(58, 8, ''),
(59, 8, ''),
(60, 8, ''),
(61, 9, '9-1-galeria.jpeg'),
(62, 9, '9-2-galeria.jpeg'),
(63, 9, '9-3-galeria.jpeg'),
(64, 9, '9-4-galeria.jpeg'),
(65, 9, '9-5-galeria.jpeg'),
(66, 9, '9-6-galeria.jpeg'),
(67, 9, '9-7-galeria.jpeg'),
(68, 9, '9-8-galeria.jpeg'),
(69, 9, '9-9-galeria.jpeg'),
(70, 9, '9-10-galeria.jpeg'),
(71, 9, '9-11-galeria.jpeg'),
(72, 9, '9-12-galeria.jpeg'),
(73, 9, '9-13-galeria.jpeg'),
(74, 9, '9-14-galeria.jpeg'),
(75, 9, '9-15-galeria.jpeg'),
(76, 10, '10-1-galeria.jpeg'),
(77, 10, '10-2-galeria.jpeg'),
(78, 10, '10-3-galeria.jpeg'),
(79, 10, '10-4-galeria.jpeg'),
(80, 10, '10-5-galeria.jpeg'),
(81, 10, '10-6-galeria.jpeg'),
(82, 10, '10-7-galeria.jpeg'),
(83, 10, '10-8-galeria.jpeg'),
(84, 10, '10-9-galeria.jpeg'),
(85, 10, '10-10-galeria.jpeg'),
(86, 10, '10-11-galeria.jpeg'),
(87, 10, '10-12-galeria.jpeg'),
(88, 10, '10-13-galeria.jpeg'),
(89, 10, '10-14-galeria.jpeg'),
(90, 10, '10-15-galeria.jpeg'),
(91, 11, '11-1-galeria.jpeg'),
(92, 11, '11-2-galeria.jpeg'),
(93, 11, '11-3-galeria.jpeg'),
(94, 11, '11-4-galeria.jpeg'),
(95, 11, '11-5-galeria.jpeg'),
(96, 11, '11-6-galeria.jpeg'),
(97, 11, '11-7-galeria.jpeg'),
(98, 11, '11-8-galeria.jpeg'),
(99, 11, '11-9-galeria.jpeg'),
(100, 11, '11-10-galeria.jpeg'),
(101, 11, '11-11-galeria.jpeg'),
(102, 11, '11-12-galeria.jpeg'),
(103, 11, '11-13-galeria.jpeg'),
(104, 11, '11-14-galeria.jpeg'),
(105, 11, '11-15-galeria.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicobanco`
--

CREATE TABLE IF NOT EXISTS `historicobanco` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `de` int(11) NOT NULL,
  `para` int(11) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `valor` float NOT NULL,
  `data_operacao` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `idposts` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(20) NOT NULL,
  `data` datetime NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `imgsrc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idposts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`idposts`, `autor`, `data`, `titulo`, `descricao`, `imgsrc`) VALUES
(1, 'naruto', '2019-05-01 00:00:00', 'Justiça concede regime semiaberto a Alexandre Nardoni', 'noite ainda não ter sido notificado sobre a concessão da juíza, mas disse que, se confirmada a notícia, a Promotoria vai recorrer da decisão.', 'posts-1.jpg'),
(2, 'naruto', '2019-05-02 00:00:00', 'Novo layout consolida Agência IBGE Notícias como plataforma', 'A Agência IBGE Notícias ganhará novo visual a partir da próxima quinta-feira (2), com uma nova estrutura da página principal, que integra a', 'posts-2.jpg'),
(3, 'Maik', '2019-05-03 00:00:00', 'Notícias do dia: Luto por Beth, Venezuela, ''balbúrdia''', 'Neymar vaiado em jogo do PSG, final do prazo para declarar IR, desemprego e mais um ataque a tiros nos EUA também foram destaques', 'posts-3.jpg'),
(4, 'Maik', '2019-05-04 00:00:00', 'Ana Maria Braga se emociona ao homenagear Beth Carvalho', 'Ana Maria Braga se emociona no Mais Você desta quarta-feira (1º) ao falar da morte de Beth Carvalho. Luiza Leão - Publicado em 01/05/2019', 'posts-4.jpg'),
(5, 'João', '2019-05-05 00:00:00', 'Notícias do dia: Operação da PF no PSL-MG, Bolsonaro na Agrishow', 'Chanceler Ernesto Araújo em Washington, penúltimo dia para declaração do Imposto de Renda e ameaça a estudantes brasileiros em Lisboa', 'posts-5.jpg'),
(6, 'João', '2019-05-06 00:00:00', 'No que depender de nós, Lula não terá chance de liberdade', 'Em entrevista hoje ao programa Brasil Urgente, da TV Bandeirantes, o presidente Jair Bolsonaro (PSL) voltou a criticar gestões petistas', 'posts-6.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema`
--

CREATE TABLE IF NOT EXISTS `sistema` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagemperfil` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codeinvite` varchar(150) CHARACTER SET latin1 NOT NULL,
  `limiteconvite` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `sistema`
--

INSERT INTO `sistema` (`id`, `nome`, `email`, `senha`, `imagemperfil`, `codeinvite`, `limiteconvite`) VALUES
(2, 'maik', 'maik@gmail.com', 'ee319e813a48a4d0afffc8523337cfde', '2-imagemperfil.jpeg', 'dec3fc7a404dadf1de542462439e058e', 1),
(3, 'regina', 'regina@gmail.com', '221182760f5b980c97c7a74a94d57364', '3-imagemperfil.jpeg', '09ac53173398041d65ca8e271927459e', 1),
(4, 'paulo', 'paulo@gmail.com', 'dd41cb18c930753cbecf993f828603dc', '4-imagemperfil.jpeg', '6ee236e4d0ab7380bb1bee87b8f0dce5', 1),
(5, 'tiago', 'tiago@gmail.com', 'c11845c9a05c8df7b137f49504dd918b', '5-imagemperfil.jpeg', 'ea5c1d6e9b8aaef1dd8db58d1667720a', 1),
(6, 'wellington', 'wellington@gmail.com', 'ebc7824e9b9304c9e17677f50b93156c', '6-imagemperfil.jpeg', '83928fd7d0850848886bcd6cbae4c2ff', 1),
(7, 'Felipy Camargo', 'felipycamargo@gmail.com', '448f9634f0081ef58e104708ca37b0d4', '7-imagemperfil.png', '161d2f555768542717834efc22648227', 4),
(8, 'sergio', 'sergio@gmail.com', '3bffa4ebdf4874e506c2b12405796aa5', '', '97f4607153c3cb1e2b0940f06261bf55', 1),
(9, 'Tadeu', 'tadeu@gmail.com', '3821c8bb9990e92045d0116f5a45242e', '9-imagemperfil.jpeg', 'c7689e1e4ae759209d878fcc95c7eaec', 1),
(10, 'Kowalski', 'kowalski@gmail.com', 'a8393058e7f0735a5578a6f288c388dc', '10-imagemperfil.jpeg', '141906617875fe0f34c038ee350bfade', 1),
(11, 'Eduardo', 'eduardo@gmail.com', '6d6354ece40846bf7fca65dfabd5d9d4', '11-imagemperfil.jpeg', 'bc5f4c96b7cc8f260c7f90951489fa3b', 1),
(12, 'Pedro', 'pedro@gmail.com', 'c6cc8094c2dc07b700ffcc36d64e2138', '', 'c3b7f393410fe6185ba5d966a213a38f', 1),
(13, 'diego', 'diego@gmail.com', '078c007bd92ddec308ae2f5115c1775d', '', 'a9c033f9b68a989437c64ca2bd228c5e', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistemacomentarios`
--

CREATE TABLE IF NOT EXISTS `sistemacomentarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `donocomentario` int(10) unsigned NOT NULL,
  `comentario` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datacomentario` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `donocomentario` (`donocomentario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `sistemacomentarios`
--

INSERT INTO `sistemacomentarios` (`id`, `donocomentario`, `comentario`, `datacomentario`) VALUES
(1, 2, 'Que Deus nos conceda um dia abençoado e cheio de vitórias! Bom dia!', '2019-05-01 00:00:00'),
(2, 2, 'Bom dia! Que seu dia seja igual a vontade de Deus: bom, perfeito e agradável.', '2019-05-02 00:00:00'),
(3, 2, 'Senhor, todos os dias sou presenteada com riquezas incalculáveis. Ensina-me a ter olhos doces para perceber, e sobretudo agradecer. Bom dia.', '2019-05-03 00:00:00'),
(4, 3, 'Não acredite em algo simplesmente porque ouviu. Não acredite em algo simplesmente porque todos falam a respeito. Não acredite em algo simplesmente porque está escrito em seus livros religiosos. Não acredite em algo só porque seus professores e mestre', '2019-05-04 00:00:00'),
(5, 4, 'Podemos acreditar que tudo que a vida nos oferecerá no futuro é repetir o que fizemos ontem e hoje. Mas, se prestarmos atenção, vamos nos dar conta de que nenhum dia é igual a outro. Cada manhã traz uma bênção escondida; uma benção que só serve para ', '2019-05-10 00:00:00'),
(6, 5, 'odos nós desejamos ajudar uns aos outros. Os seres humanos são assim. Desejamos viver para a felicidade do próximo - não para o seu infortúnio. Por que havemos de odiar e desprezar uns aos outros? Neste mundo há espaço para todos. A terra, que é boa ', '2019-05-11 22:00:33');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `sistemacomentarios`
--
ALTER TABLE `sistemacomentarios`
  ADD CONSTRAINT `sistemacomentarios_ibfk_1` FOREIGN KEY (`donocomentario`) REFERENCES `sistema` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
