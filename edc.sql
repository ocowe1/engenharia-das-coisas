-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Nov-2019 às 13:12
-- Versão do servidor: 10.1.40-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `calendar`
--

CREATE TABLE `calendar` (
  `calendar_id` int(11) NOT NULL,
  `calendar_day` int(11) NOT NULL,
  `calendar_month` int(11) NOT NULL,
  `calendar_year` int(11) NOT NULL,
  `calendar_name` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `calendar`
--

INSERT INTO `calendar` (`calendar_id`, `calendar_day`, `calendar_month`, `calendar_year`, `calendar_name`, `user_id`) VALUES
(2, 25, 11, 2019, 'P1 - Programação', 7),
(4, 27, 11, 2019, 'P2 - Fisica 3', 7),
(5, 26, 11, 2019, 'Eixo - Estatística', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `comentario_id` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publicacao_id` int(11) NOT NULL,
  `data` varchar(150) NOT NULL,
  `hora` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`comentario_id`, `comentario`, `user_id`, `publicacao_id`, `data`, `hora`) VALUES
(1, 'Amazing', 7, 2, '09-10-2019', '10:37'),
(7, 'Amazing', 7, 2, '09-10-2019', '10:43'),
(8, '0', 7, 2, '09-10-2019', '11:41'),
(9, 'Também achei', 7, 2, '10-10-2019', '09:01'),
(10, 'Também achei', 7, 2, '10-10-2019', '09:10'),
(11, 'Amazing', 7, 2, '10-10-2019', '11:38'),
(12, 'a', 7, 16, '10-10-2019', '17:43'),
(13, 'as', 7, 20, '11-10-2019', '12:01'),
(14, 'sa', 7, 21, '11-10-2019', '12:02'),
(15, 'j', 7, 22, '11-10-2019', '12:04'),
(16, '3', 7, 63, '16-10-2019', '09:39'),
(17, 'a', 1, 69, '21-10-2019', '08:56'),
(18, 'a', 7, 70, '21-10-2019', '09:21'),
(19, 'p', 7, 70, '22-10-2019', '08:38'),
(20, 'a', 7, 70, '22-10-2019', '08:38'),
(21, 'g', 7, 70, '22-10-2019', '08:38'),
(22, 'a', 7, 70, '22-10-2019', '08:39'),
(23, '3', 7, 68, '22-10-2019', '11:05'),
(24, 'asp', 7, 57, '22-10-2019', '11:05'),
(25, '5', 7, 77, '23-10-2019', '09:20'),
(26, '555', 7, 75, '24-10-2019', '08:28'),
(27, '555', 7, 75, '24-10-2019', '08:28'),
(28, '858', 7, 74, '24-10-2019', '08:32'),
(29, '55', 7, 74, '24-10-2019', '08:32'),
(30, 'a', 7, 81, '29-10-2019', '11:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `contact_id` int(11) NOT NULL,
  `contact_email` varchar(150) NOT NULL,
  `contact_name` varchar(150) NOT NULL,
  `contact_assunto` varchar(150) NOT NULL,
  `contact_mensagem` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`contact_id`, `contact_email`, `contact_name`, `contact_assunto`, `contact_mensagem`, `user_id`) VALUES
(2, 'viniciusath@hotmail.com', 'Vinicius Costa Santos', 'Teste de email', 'Teste', 7),
(3, 'viniciusath@hotmail.com', 'Vinicius Costa Santos', 'Teste de email', 'Teste', 7),
(4, 'teste@teste.com', 'Vinicius Costa Santos', 'd', '123', 7),
(5, 'teste@teste.com', 'Vinicius Costa Santos', 'd', '123', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo_disciplina`
--

CREATE TABLE `conteudo_disciplina` (
  `conteudo_id` int(11) NOT NULL,
  `conteudo_nome` varchar(150) NOT NULL,
  `conteudo_desc` varchar(500) NOT NULL,
  `arquivo` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL,
  `disciplina_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `data` varchar(150) NOT NULL,
  `hora` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `conteudo_disciplina`
--

INSERT INTO `conteudo_disciplina` (`conteudo_id`, `conteudo_nome`, `conteudo_desc`, `arquivo`, `status`, `disciplina_id`, `professor_id`, `data`, `hora`) VALUES
(4, '1', 'Desenho citado na ultima aula.', 'android-chrome-192x192.png', 'ativo', 1, 7, '25-10-2019', '10:43'),
(9, '5', 'asas', 'favicon-32x32.png', 'ativo', 1, 7, '25-10-2019', '11:28'),
(10, '6', 'dasd', 'favicon-32x32.png', 'ativo', 1, 7, '25-10-2019', '11:29'),
(11, '7', 'Desenho citado na ultima aula.', 'android-chrome-192x192.png', 'ativo', 1, 7, '25-10-2019', '10:43'),
(12, '8', 'asas', 'favicon-32x32.png', 'ativo', 1, 7, '25-10-2019', '11:28'),
(13, '9', 'dasd', 'favicon-32x32.png', 'ativo', 1, 7, '25-10-2019', '11:29'),
(16, '12', 'dasd', 'favicon-32x32.png', 'ativo', 1, 7, '25-10-2019', '11:29'),
(19, '15', 'dasd', 'favicon-32x32.png', 'oculto', 1, 7, '25-10-2019', '11:29'),
(20, '16', 'Desenho citado na ultima aula.', 'android-chrome-192x192.png', 'oculto', 1, 7, '25-10-2019', '10:43'),
(21, '17', 'asas', 'favicon-32x32.png', 'oculto', 1, 7, '25-10-2019', '11:28'),
(22, '18', 'dasd', 'favicon-32x32.png', 'oculto', 1, 7, '25-10-2019', '11:29'),
(23, '19', 'Desenho citado na ultima aula.', 'android-chrome-192x192.png', 'oculto', 1, 7, '25-10-2019', '10:43'),
(25, 'Carla', 'foi entre carla e leticia', '[Section]_-_Components.png', 'ativo', 11, 7, '31-10-2019', '14:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `curtida_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publicacao_id` int(11) NOT NULL,
  `data` varchar(150) NOT NULL,
  `hora` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curtidas`
--

INSERT INTO `curtidas` (`curtida_id`, `user_id`, `publicacao_id`, `data`, `hora`) VALUES
(56, 1, 1, '10-10-2019', '11:53'),
(57, 1, 2, '10-10-2019', '11:53'),
(61, 7, 2, '10-10-2019', '15:31'),
(68, 7, 16, '10-10-2019', '17:09'),
(69, 7, 20, '11-10-2019', '09:51'),
(70, 7, 1, '11-10-2019', '15:34'),
(71, 7, 22, '15-10-2019', '08:44'),
(72, 7, 67, '17-10-2019', '15:04'),
(73, 7, 69, '17-10-2019', '15:04'),
(74, 7, 65, '17-10-2019', '15:05'),
(75, 7, 71, '22-10-2019', '09:17'),
(76, 7, 70, '22-10-2019', '09:17'),
(77, 7, 64, '22-10-2019', '09:51'),
(79, 7, 75, '23-10-2019', '09:18'),
(80, 7, 77, '23-10-2019', '09:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `disciplina_id` int(11) NOT NULL,
  `disciplina` varchar(150) NOT NULL,
  `professor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `disciplinas`
--

INSERT INTO `disciplinas` (`disciplina_id`, `disciplina`, `professor_id`) VALUES
(1, 'Língua Portuguesa Italiana', 7),
(2, 'Francês Espanhol', 7),
(3, 'Matemática', 7),
(4, 'Geometria Análitica', 7),
(5, 'Cálculo 1', 7),
(6, 'Fisica 1', 7),
(7, 'Fisica 4', 7),
(8, 'Sei lá', 7),
(9, '66', 7),
(10, 'Matemática para Humanas', 7),
(11, 'o melhor papo do brasil', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `email_enviado`
--

CREATE TABLE `email_enviado` (
  `email_id` int(11) NOT NULL,
  `email_assunto` varchar(150) NOT NULL,
  `email_conteudo` varchar(500) NOT NULL,
  `user_id_enviado` int(11) NOT NULL,
  `user_name_enviado` varchar(150) NOT NULL,
  `user_email_enviado` varchar(150) NOT NULL,
  `user_id_recebido` int(11) NOT NULL,
  `user_name_recebido` varchar(150) NOT NULL,
  `user_email_recebido` varchar(150) NOT NULL,
  `data` varchar(150) NOT NULL,
  `hora` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `email_enviado`
--

INSERT INTO `email_enviado` (`email_id`, `email_assunto`, `email_conteudo`, `user_id_enviado`, `user_name_enviado`, `user_email_enviado`, `user_id_recebido`, `user_name_recebido`, `user_email_recebido`, `data`, `hora`) VALUES
(31, 'conte', 'conte', 8, 'Clariosvaldo Nunes', 'valdinho@gmail.com', 7, 'Vinicius Costa Santos', 'teste@teste.com', '01-11-2019', '09:00'),
(32, '666666666', '66666666666666', 7, 'Vinicius Costa Santos', 'teste@teste.com', 7, 'Vinicius Costa Santos', 'teste@teste.com', '06-11-2019', '10:28'),
(34, '666666666', '66666666666666', 7, 'Vinicius Costa Santos', 'teste@teste.com', 7, 'Vinicius Costa Santos', 'teste@teste.com', '06-11-2019', '10:30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `email_recebido`
--

CREATE TABLE `email_recebido` (
  `email_id` int(11) NOT NULL,
  `email_assunto` varchar(150) NOT NULL,
  `email_conteudo` varchar(500) NOT NULL,
  `user_id_enviado` int(11) NOT NULL,
  `user_name_enviado` varchar(150) NOT NULL,
  `user_email_enviado` varchar(150) NOT NULL,
  `user_id_recebido` int(11) NOT NULL,
  `user_name_recebido` varchar(150) NOT NULL,
  `user_email_recebido` varchar(150) NOT NULL,
  `data` varchar(150) NOT NULL,
  `hora` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `email_recebido`
--

INSERT INTO `email_recebido` (`email_id`, `email_assunto`, `email_conteudo`, `user_id_enviado`, `user_name_enviado`, `user_email_enviado`, `user_id_recebido`, `user_name_recebido`, `user_email_recebido`, `data`, `hora`) VALUES
(19, 'Teste de email021', '33', 7, 'Vinicius Costa Santos', 'teste@teste.com', 1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '03-10-2019', '15:45'),
(22, 'Teste de email', 'sasa', 7, 'Vinicius Costa Santos', 'teste@teste.com', 1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '03-10-2019', '17:28'),
(23, 'Teste de email', '020105', 7, 'Vinicius Costa Santos', 'teste@teste.com', 1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '08-10-2019', '09:02'),
(24, 'Teste de email', '050608', 7, 'Vinicius Costa Santos', 'teste@teste.com', 1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '08-10-2019', '09:05'),
(25, 'Testando o n312br', 'Olá,\r\n\r\nSomos, funcionarios, unimes, que estão, sei lá, bla bla bal\r\n\r\natt, bladfmlaks', 7, 'Vinicius Costa Santos', 'teste@teste.com', 1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '08-10-2019', '09:55'),
(26, 'd', '3', 7, 'Vinicius Costa Santos', 'teste@teste.com', 1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '17-10-2019', '15:49'),
(27, 'sd', 'ds', 7, 'Vinicius Costa Santos', 'teste@teste.com', 1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '17-10-2019', '15:52'),
(29, 's', 'dasd', 7, 'Vinicius Costa Santos', 'teste@teste.com', 1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '17-10-2019', '15:56'),
(31, 'fgfg', 'fgfgfg', 7, 'Vinicius Costa Santos', 'teste@teste.com', 1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '17-10-2019', '15:56'),
(32, 'sa', 'sas', 7, 'Vinicius Costa Santos', 'teste@teste.com', 1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '17-10-2019', '15:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `log_name` varchar(150) NOT NULL,
  `log_descricao` varchar(500) NOT NULL,
  `user_id` varchar(150) NOT NULL,
  `tipo` varchar(150) NOT NULL,
  `data` varchar(15) NOT NULL,
  `hora` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `log`
--

INSERT INTO `log` (`log_id`, `log_name`, `log_descricao`, `user_id`, `tipo`, `data`, `hora`) VALUES
(773, 'Login de usuário', 'O usuário de id registrado realizou login.', '8', 'Login', '30-10-2019', '13:09'),
(774, 'Logout de usuário', 'O usuário de id registrado realizou o logout.', 'valdinho@gmail.com', 'Logout', '30-10-2019', '10:43'),
(775, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '31-10-2019', '12:23'),
(776, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '31-10-2019', '12:50'),
(777, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '31-10-2019', '12:55'),
(778, 'Logout de usuário', 'O usuário de id registrado realizou o logout.', '7', 'Logout', '31-10-2019', '08:55'),
(779, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '31-10-2019', '13:56'),
(780, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '31-10-2019', '14:46'),
(781, 'Exclusão de conteúdo', 'A publicação de id:81, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(782, 'Exclusão de conteúdo', 'A publicação de id:80, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(783, 'Exclusão de conteúdo', 'A publicação de id:79, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(784, 'Exclusão de conteúdo', 'A publicação de id:78, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(785, 'Exclusão de conteúdo', 'A publicação de id:77, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(786, 'Exclusão de conteúdo', 'A publicação de id:76, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(787, 'Exclusão de conteúdo', 'A publicação de id:75, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(788, 'Exclusão de conteúdo', 'A publicação de id:74, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(789, 'Exclusão de conteúdo', 'A publicação de id:73, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(790, 'Exclusão de conteúdo', 'A publicação de id:72, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(791, 'Exclusão de conteúdo', 'O arquivo de id:27, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(792, 'Exclusão de conteúdo', 'O arquivo de id:26, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(793, 'Exclusão de conteúdo', 'O arquivo de id:25, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '31-10-2019', '10:53'),
(794, 'Ocultação de conteúdo', 'O arquivo de id:24, foi oculto pelo usuario de id registrado.', '7', 'Ocultação', '31-10-2019', '10:53'),
(795, 'Ocultação de conteúdo', 'O arquivo de id:23, foi oculto pelo usuario de id registrado.', '7', 'Ocultação', '31-10-2019', '10:53'),
(796, 'Ocultação de conteúdo', 'O arquivo de id:21, foi oculto pelo usuario de id registrado.', '7', 'Ocultação', '31-10-2019', '10:53'),
(797, 'Ocultação de conteúdo', 'O arquivo de id:19, foi oculto pelo usuario de id registrado.', '7', 'Ocultação', '31-10-2019', '10:53'),
(798, 'Ocultação de conteúdo', 'O arquivo de id:20, foi oculto pelo usuario de id registrado.', '7', 'Ocultação', '31-10-2019', '10:54'),
(799, 'Login de usuário', 'O usuário de id registrado realizou login.', '8', 'Login', '31-10-2019', '15:29'),
(800, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '31-10-2019', '18:11'),
(801, 'Nova Disciplina', 'O professor de id registrado adicionou uma nova disciplina com o nome de: o melhor papo do brasil', '7', 'Disciplina', '31-10-2019', '14:11'),
(802, 'Upload de conteúdo', 'O professor de id registrado realizou o upload de conteúdo', '7', 'Conteúdo', '31-10-2019', '14:11'),
(803, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '31-10-2019', '18:24'),
(804, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '01-11-2019', '12:08'),
(805, 'Exclusão de conteúdo', 'O arquivo de id:17, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '01-11-2019', '08:10'),
(806, 'Exclusão de conteúdo', 'O arquivo de id:18, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '01-11-2019', '08:10'),
(807, 'Exclusão de conteúdo', 'O arquivo de id:14, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '01-11-2019', '08:10'),
(808, 'Exclusão de conteúdo', 'O arquivo de id:8, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '01-11-2019', '08:10'),
(809, 'Exclusão de conteúdo', 'O arquivo de id:6, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '01-11-2019', '08:10'),
(810, 'Exclusão de conteúdo', 'O arquivo de id:7, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '01-11-2019', '08:10'),
(811, 'Exclusão de conteúdo', 'O arquivo de id:15, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '01-11-2019', '08:10'),
(812, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 9', '7', '', '01-11-2019', '08:11'),
(813, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 28', '7', '', '01-11-2019', '08:20'),
(814, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 30', '7', '', '01-11-2019', '08:23'),
(815, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 12', '7', '', '01-11-2019', '08:23'),
(816, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 10', '7', '', '01-11-2019', '08:24'),
(817, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 11', '7', '', '01-11-2019', '08:34'),
(818, 'Login de usuário', 'O usuário de id registrado realizou login.', '8', 'Login', '01-11-2019', '12:55'),
(819, 'Envio de mensagem', 'O usuário do id registrado enviou uma mensagem de assunto conte para o usuario teste@teste.com de id 7', '7', '', '01-11-2019', '09:00'),
(820, 'Envio de mensagem', 'O usuário do id registrado enviou uma mensagem de assunto conte para o usuario teste@teste.com de id 7', '8', '', '01-11-2019', '09:00'),
(821, 'Envio de mensagem', 'O usuário do id registrado enviou uma mensagem de assunto <td><form action=\"<?php echo base_url (\'professor/escrever\') ?>\" method=\"post\"><button type=\"submit\" class=\"btn btn-primary btn-block margin-bottom\">Escrever</button></form></td> para o usuario teste@teste.com de id 7', '7', '', '01-11-2019', '09:08'),
(822, 'Envio de mensagem', 'O usuário do id registrado enviou uma mensagem de assunto <td><form action=\"<?php echo base_url (\'professor/escrever\') ?>\" method=\"post\"><button type=\"submit\" class=\"btn btn-primary btn-block margin-bottom\">Escrever</button></form></td> para o usuario teste@teste.com de id 7', '7', '', '01-11-2019', '09:09'),
(823, 'Resposta de mensagem', 'O usuário do id registrado respondeu a mensagem de assunto RE: conte para o usuario teste@teste.com', '7', '', '01-11-2019', '09:15'),
(824, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 36', '7', '', '01-11-2019', '09:17'),
(825, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 35', '7', '', '01-11-2019', '09:17'),
(826, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 34', '7', '', '01-11-2019', '09:22'),
(827, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(828, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(829, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(830, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(831, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(832, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(833, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(834, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(835, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(836, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(837, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(838, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(839, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(840, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(841, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(842, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(843, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(844, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(845, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(846, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(847, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(848, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(849, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(850, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(851, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(852, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(853, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(854, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(855, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(856, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(857, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: Professor', '7', 'Autorização', '01-11-2019', '13:22'),
(858, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 33', '7', '', '01-11-2019', '09:22'),
(859, 'Acesso não autorizado', 'Usuário de id registrado tentou acessar área: VXN1w6FyaW8', '7', 'Autorização', '01-11-2019', '13:27'),
(860, 'Envio de mensagem', 'O usuário do id registrado enviou uma mensagem de assunto Escrever para o usuario teste@teste.com de id 7', '7', '', '01-11-2019', '09:28'),
(861, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 35', '7', '', '01-11-2019', '09:28'),
(862, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 33', '7', '', '01-11-2019', '09:28'),
(863, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 32', '7', '', '01-11-2019', '09:31'),
(864, 'Envio de mensagem', 'O usuário do id registrado enviou uma mensagem de assunto Escrever para o usuario teste@teste.com de id 7', '7', '', '01-11-2019', '09:31'),
(865, 'Exclusão de conteúdo', 'O arquivo de id:24, foi excluida pelo usuario de id registrado.', '7', 'Exclusão', '01-11-2019', '09:31'),
(866, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 39', '7', '', '01-11-2019', '09:31'),
(867, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 37', '7', '', '01-11-2019', '09:31'),
(868, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 34', '7', '', '01-11-2019', '09:31'),
(869, 'Logout de usuário', 'O usuário de id registrado realizou o logout.', '7', 'Logout', '01-11-2019', '09:33'),
(870, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '01-11-2019', '13:33'),
(871, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 36', '7', '', '01-11-2019', '09:33'),
(872, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '01-11-2019', '13:36'),
(873, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 37', '7', '', '01-11-2019', '09:40'),
(874, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '01-11-2019', '13:47'),
(875, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '01-11-2019', '13:49'),
(876, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 29', '7', '', '01-11-2019', '09:49'),
(877, 'Logout de usuário', 'O usuário de id registrado realizou o logout.', '7', 'Logout', '01-11-2019', '09:53'),
(878, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '01-11-2019', '13:53'),
(879, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 40', '7', '', '01-11-2019', '09:53'),
(880, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 30', '7', '', '01-11-2019', '09:54'),
(881, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 27', '7', '', '01-11-2019', '09:54'),
(882, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 28', '7', '', '01-11-2019', '10:11'),
(883, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 25', '7', '', '01-11-2019', '10:28'),
(884, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 24', '7', '', '01-11-2019', '10:30'),
(885, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 22', '7', '', '01-11-2019', '10:33'),
(886, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 26', '7', '', '01-11-2019', '10:37'),
(887, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '01-11-2019', '14:42'),
(888, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '01-11-2019', '14:58'),
(889, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '04-11-2019', '12:19'),
(890, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '04-11-2019', '15:19'),
(891, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '06-11-2019', '12:48'),
(892, 'Logout de usuário', 'O usuário de id registrado realizou o logout.', '7', 'Logout', '06-11-2019', '10:16'),
(893, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '06-11-2019', '13:16'),
(894, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 11', '7', '', '06-11-2019', '10:16'),
(895, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 7', '7', '', '06-11-2019', '10:16'),
(896, 'Envio de mensagem', 'O usuário do id registrado enviou uma mensagem de assunto 666666666 para o usuario teste@teste.com de id 7', '7', '', '06-11-2019', '10:30'),
(897, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 39', '7', '', '06-11-2019', '10:30'),
(898, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 38', '7', '', '06-11-2019', '10:45'),
(899, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 33', '7', '', '06-11-2019', '10:52'),
(900, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 40', '7', '', '06-11-2019', '10:52'),
(901, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 23', '7', '', '06-11-2019', '10:53'),
(902, 'Apagou a mensagem recebida', 'O usuario de id registrado apagou a mensagem recebida de id 41', '7', '', '06-11-2019', '10:53'),
(903, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '11-11-2019', '12:40'),
(904, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 10', '7', '', '11-11-2019', '09:51'),
(905, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 21', '7', '', '11-11-2019', '10:01'),
(906, 'Login de usuário', 'O usuário de id registrado realizou login.', '7', 'Login', '11-11-2019', '13:09'),
(907, 'Apagou a mensagem enviada', 'O usuario de id registrado apagou a mensagem enviada de id 9', '7', '', '11-11-2019', '10:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `profile_descricao` varchar(100) NOT NULL,
  `profile_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `profile`
--

INSERT INTO `profile` (`profile_id`, `profile_descricao`, `profile_status`) VALUES
(1, 'MASTER', 1),
(2, 'ADMINISTRADOR', 1),
(3, 'GESTOR', 1),
(4, 'PROFESSOR', 1),
(5, 'USER', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacoes`
--

CREATE TABLE `publicacoes` (
  `publicacao_id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `conteudo` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `arquivo` varchar(150) NOT NULL,
  `download_name` varchar(150) NOT NULL,
  `tipo` int(11) NOT NULL,
  `direcionado` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL,
  `data` varchar(150) NOT NULL,
  `hora` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `publicacoes`
--

INSERT INTO `publicacoes` (`publicacao_id`, `titulo`, `conteudo`, `user_id`, `arquivo`, `download_name`, `tipo`, `direcionado`, `status`, `data`, `hora`) VALUES
(72, 'sd', 'asd', 7, '', '', 2, 'Todas', 'excluido', '23-10-2019', '08:45'),
(73, 'sda', 'sda', 7, '', '', 2, 'Todas', 'excluido', '23-10-2019', '08:45'),
(74, 'as', 'dsd', 7, '', '', 2, 'Todas', 'excluido', '23-10-2019', '08:45'),
(75, 'as', 'dsa', 7, '', '', 2, 'Todas', 'excluido', '23-10-2019', '08:45'),
(76, 'sda', 'sda', 7, '', '', 2, 'Todas', 'excluido', '23-10-2019', '08:45'),
(77, 'sda', 'sda', 7, '', '', 2, 'Todas', 'excluido', '23-10-2019', '08:45'),
(78, 'sda', 'sda', 7, '', '', 2, 'Todas', 'excluido', '23-10-2019', '08:45'),
(79, 'sda', 'sdsa', 7, '', '', 2, 'Todas', 'excluido', '23-10-2019', '08:45'),
(80, 'da', 'sda', 7, 'avatar04.png', '', 1, 'Todas', 'excluido', '23-10-2019', '08:46'),
(81, 'd', 'dd', 7, 'favicon-32x32.png', '', 1, 'Todas', 'excluido', '25-10-2019', '10:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `resp_comentario`
--

CREATE TABLE `resp_comentario` (
  `resp_id` int(11) NOT NULL,
  `resposta` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publicacao_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL,
  `data` varchar(150) NOT NULL,
  `hora` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resp_comentario`
--

INSERT INTO `resp_comentario` (`resp_id`, `resposta`, `user_id`, `publicacao_id`, `comentario_id`, `data`, `hora`) VALUES
(4, 'né', 7, 2, 10, '10-10-2019', '09:18'),
(5, 'ee', 7, 2, 10, '10-10-2019', '09:18'),
(6, 'e.e', 7, 2, 10, '10-10-2019', '09:18'),
(7, 'e.e', 7, 2, 10, '10-10-2019', '09:18'),
(8, '2', 8, 70, 18, '21-10-2019', '10:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_senha` varchar(32) NOT NULL,
  `user_curso` varchar(150) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `alter_dados` varchar(150) DEFAULT NULL,
  `user_ra` varchar(15) DEFAULT NULL,
  `user_celular` varchar(20) NOT NULL,
  `email_conf` tinyint(1) NOT NULL,
  `user_token` varchar(35) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `user_img` varchar(150) NOT NULL,
  `user_profile` varchar(150) NOT NULL,
  `user_cidade` varchar(150) NOT NULL,
  `cadastro_data` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_senha`, `user_curso`, `semestre`, `alter_dados`, `user_ra`, `user_celular`, `email_conf`, `user_token`, `profile_id`, `user_img`, `user_profile`, `user_cidade`, `cadastro_data`) VALUES
(1, 'Vinícius Costa Santos', 'viniciusath@hotmail.com', '784652dff0dea3ba3558a0b9a9d8a8c0', 'Engenharia da Computação', 2, '01-01-2018', '11180051', '13981575072', 1, '0', 5, 'avatar5.png', 'Master', '', '01-01-2018'),
(7, 'Vinicius Costa Santos', 'teste@teste.com', '698dc19d489c4e4db73e28a713eab07b', 'Engenharia Civil', 5, '05-02-2019', '151515151515', '2525252525', 1, '0', 3, 'avatar04.png', 'Usuario', 'São Vicente/SP', '03-07-2019'),
(8, 'Clariosvaldo Nunes', 'valdinho@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', 'Engenharia de Produção', NULL, '21-10-2019', '111111111', '13385258852', 1, '0', 5, 'default.png', 'Usuário', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`calendar_id`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`comentario_id`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `conteudo_disciplina`
--
ALTER TABLE `conteudo_disciplina`
  ADD PRIMARY KEY (`conteudo_id`);

--
-- Indexes for table `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`curtida_id`);

--
-- Indexes for table `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`disciplina_id`);

--
-- Indexes for table `email_enviado`
--
ALTER TABLE `email_enviado`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `email_recebido`
--
ALTER TABLE `email_recebido`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `publicacoes`
--
ALTER TABLE `publicacoes`
  ADD PRIMARY KEY (`publicacao_id`);

--
-- Indexes for table `resp_comentario`
--
ALTER TABLE `resp_comentario`
  ADD PRIMARY KEY (`resp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `calendar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `comentario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `conteudo_disciplina`
--
ALTER TABLE `conteudo_disciplina`
  MODIFY `conteudo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `curtida_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `disciplina_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `email_enviado`
--
ALTER TABLE `email_enviado`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `email_recebido`
--
ALTER TABLE `email_recebido`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=908;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `publicacoes`
--
ALTER TABLE `publicacoes`
  MODIFY `publicacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `resp_comentario`
--
ALTER TABLE `resp_comentario`
  MODIFY `resp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
