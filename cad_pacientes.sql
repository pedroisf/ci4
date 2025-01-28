-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 24/01/2025 às 01:10
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `datatable`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cad_pacientes`
--

DROP TABLE IF EXISTS `cad_pacientes`;
CREATE TABLE IF NOT EXISTS `cad_pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usr_ins_cpa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dta_ins_cpa` date NOT NULL,
  `usr_upd_cpa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dta_upd_cpa` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabela de Cadastro de Pacientes';

--
-- Despejando dados para a tabela `cad_pacientes`
--

INSERT INTO `cad_pacientes` (`id`, `nome`, `data_nascimento`, `sexo`, `endereco`, `telefone`, `usr_ins_cpa`, `dta_ins_cpa`, `usr_upd_cpa`, `dta_upd_cpa`) VALUES
(1, 'Ana Silva', '1900-05-15', 'F', 'Rua A, 123, São Paulo, SP', '85992241434', 'admin', '2025-01-01', 'admin', '2025-01-01'),
(2, 'Carlos Souza', '1990-08-20', 'M', 'Avenida B, 456, Rio de Janeiro, RJ', '21938473341', 'admin', '2025-01-01', 'admin', '2025-01-01'),
(3, 'Mariana Oliveira', '1978-12-30', 'F', 'Praça C, 789, Belo Horizonte, MG', '21934562342', 'admin', '2025-01-01', 'admin', '2025-01-01'),
(4, 'João Santos', '1982-03-12', 'M', 'Rua D, 1011, Curitiba, PR', '21987567567', 'admin', '2025-01-01', 'admin', '2025-01-01'),
(5, 'Julia Costa', '1995-07-25', 'F', 'Avenida E, 1213, Salvador, BA', '21932346745', 'admin', '2025-01-01', 'admin', '2025-01-01'),
(6, 'Pedro Almeida', '1988-11-05', 'M', 'Rua F, 1415, Fortaleza, CE', '21938473341', 'admin', '2025-01-01', 'admin', '2025-01-01'),
(7, 'Fernanda Lima', '1992-04-17', 'F', 'Praça G, 1617, Recife, PE', '2147483647', 'admin', '2025-01-01', 'admin', '2025-01-01'),
(8, 'Ricardo Pereira', '1980-09-22', 'M', 'Avenida H, 1819, Porto Alegre, RS', '2147483647', 'admin', '2025-01-01', 'admin', '2025-01-01'),
(9, 'Tatiane Rocha', '1993-06-14', 'F', 'Rua I, 2021, Brasília, DF', '2147483647', 'admin', '2025-01-01', 'admin', '2025-01-01'),
(10, 'Lucas Martins', '1987-10-10', 'M', 'Avenida J, 2223, Manaus, AM', '2147483647', 'admin', '2025-01-01', 'admin', '2025-01-01'),
(11, 'Camila Ferreira', '1991-02-28', 'F', 'Rua K, 2425,São Luís, MA', '2147483647', 'admin', '2025-01-02', 'admin', '2025-02-02'),
(12, 'André Gomes', '1984-03-15', 'M', 'Praça L ,2627 ,Natal ,RN', '2147483647', 'admin', '2025-03-03', 'admin', '2025-03-03'),
(13, 'Patrícia Dias', '1979-11-11', 'F', 'Avenida M ,2829 ,Campo Grande ,MS ', '2147483647', 'admin ', '2025-04-04', 'admin ', '2025-04-04'),
(14, 'Gustavo Nascimento ', '1994-07-20', 'M ', 'Rua N ,3031 ,Teresina ,PI ', '2147483647', 'admin ', '2025-05-05', 'admin ', '2025-05-05'),
(15, 'Sofia Almeida ', '1986-08-30', 'F ', 'Praça Q ,3636 ,João Pessoa ,PB ', '2147483647', 'admin ', '2025-01-22', 'admin ', '2025-01-22'),
(16, 'Felipe Silva ', '1979-11-11', 'M ', 'Rua P ,3434 ,Florianópolis ,SC ', '2147483647', 'admin ', '2025-01-22', 'admin ', '2025-01-22'),
(17, 'Vanessa Costa ', '1989-12-11', 'F ', 'Praça Q ,3636 ,Aracaju ,SE ', '2147483647', 'admin ', '2025-01-22', 'admin ', '2025-01-22'),
(18, 'Rafael Oliveira ', '1969-11-25', 'M', 'Avenida R ,3838 ,Belém ,PA', '2147483647', 'admin', '2025-01-22', 'admin', '2025-01-22'),
(19, 'Bianca Mendes ', '1978-07-30', 'F', 'Rua S ,4040 ,Goiânia ,GO', '2147483647', 'admin', '2025-01-22', 'admin', '2025-01-22'),
(20, 'Thiago Almeida ', '2000-07-22', 'M', 'Avenida T ,4242 ,Belém ,PA', '2147483647', 'admin', '2025-01-22', 'admin', '2025-01-22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
