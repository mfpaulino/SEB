-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 24/08/2017 às 16:43
-- Versão do servidor: 10.0.30-MariaDB-0+deb8u2
-- Versão do PHP: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `cciex_siaudi`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfis`
--

CREATE TABLE IF NOT EXISTS `perfis` (
`id_perfil` int(11) NOT NULL,
  `perfil` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `permissoes` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `perfis`
--

INSERT INTO `perfis` (`id_perfil`, `perfil`, `descricao`, `permissoes`) VALUES
(1, 'Administrador', '(Responsável pelo Sistema na Unidade)', ''),
(2, 'Auditor/Analista', '(Integrante Seção de Auditoria)', ''),
(3, 'Coordenador', '(Ch Seção de Auditoria)', ''),
(4, 'Gerente', '(Integrantes da SPE)', ''),
(5, 'Gestor', '(Cmt/Ch/Dir/OD)', ''),
(6, 'Operador', '(Militar/Servidor Civil Designado pelo Gestor)', ''),
(7, 'Supervisor', '(Ch CCIEX, Ch ICFEx)', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfis_unidade`
--

CREATE TABLE IF NOT EXISTS `perfis_unidade` (
  `unidade` varchar(255) NOT NULL,
  `perfis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `perfis_unidade`
--

INSERT INTO `perfis_unidade` (`unidade`, `perfis`) VALUES
('cciex', 'a:5:{i:0;s:13:"Administrador";i:1;s:16:"Auditor/Analista";i:2;s:11:"Coordenador";i:3;s:7:"Gerente";i:4;s:10:"Supervisor";}'),
('icfex', 'a:4:{i:0;s:13:"Administrador";i:1;s:16:"Auditor/Analista";i:2;s:11:"Coordenador";i:3;s:10:"Supervisor";}'),
('unidades', 'a:3:{i:0;s:13:"Administrador";i:1;s:6:"Gestor";i:2;s:8:"Operador";}');

-- --------------------------------------------------------

--
-- Estrutura para tabela `postos`
--

CREATE TABLE IF NOT EXISTS `postos` (
`id_posto` tinyint(2) NOT NULL,
  `posto` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `postos`
--

INSERT INTO `postos` (`id_posto`, `posto`) VALUES
(1, 'Gen Ex'),
(2, 'Gen Div'),
(3, 'Gen Bda'),
(4, 'Cel'),
(5, 'Ten Cel'),
(6, 'Maj'),
(7, 'Cap'),
(8, '1º Ten'),
(9, '2º Ten'),
(10, 'Asp Of'),
(11, 'S Ten'),
(12, '1º Sgt'),
(13, '2º Sgt'),
(14, '3º Sgt'),
(15, 'T Mor'),
(16, 'Cb'),
(17, 'T1'),
(18, 'T2'),
(19, 'Sd'),
(20, 'SC');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `cpf` char(11) NOT NULL,
  `rg` varchar(200) NOT NULL,
  `senha` tinyblob NOT NULL,
  `nome_guerra` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `ritex` char(7) NOT NULL,
  `celular` char(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `id_posto` char(2) NOT NULL,
  `codom` char(6) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `ultimo_acesso` datetime NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cpf`, `rg`, `senha`, `nome_guerra`, `nome`, `email`, `ritex`, `celular`, `avatar`, `id_posto`, `codom`, `id_perfil`, `ultimo_acesso`, `status`) VALUES
(1, '09172517840', '0623900644', 0x243261243038244e4455794e4445354d4463304e546b35597a526a594f374835776a5458416f4d3139496d31764e5872484a507451656f4776583536, 'Paulino', 'Marcelo Paulino', 'mdfpaulino@gmail.com', '8603590', '61992688145', '', '7', '016139', 2, '2017-08-23 17:01:07', 'habilitado'),
(9, '00917251784', '3232323', 0x243261243038244d5441774d7a49344e7a55334d4455354f5456694d2e665a746e6e4d4d724f325742594c50435a493346685055357853412e4e574b, 'dsdsdsddsdsd', '1', 'mfpaulino1@uol.com.br', '', '', '', '2', '055905', 3, '2017-08-23 17:01:07', 'recebido'),
(23, '72517840091', '1111', 0x243261243038244e444d794e5451354d4459314e546b355a47466b4d65544d652f5774426365396354414d35644e70624a545865716b706a46544c69, 'Rerer ', 'Fdfg G G ', 'fddfdf@uol.com.br', '', '', '00917251784.jpg', '12', '016139', 1, '2017-08-23 17:01:07', 'recebido'),
(32, '17251784009', '1111', 0x243261243038244e7a6b7a4e7a63794d5445784e546b355a6a4a6a4e65527a554e6570644f787753754168586567647a7a2f4678336f6d4d4e795253, 'Sasasa ', 'Swswsw Swsws ', 'mfpaulino@uol.com.br', '', '', 'default_avatar.jpg', '5', '016139', 1, '0000-00-00 00:00:00', 'recebido');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `perfis`
--
ALTER TABLE `perfis`
 ADD PRIMARY KEY (`id_perfil`);

--
-- Índices de tabela `perfis_unidade`
--
ALTER TABLE `perfis_unidade`
 ADD PRIMARY KEY (`unidade`);

--
-- Índices de tabela `postos`
--
ALTER TABLE `postos`
 ADD PRIMARY KEY (`id_posto`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `perfis`
--
ALTER TABLE `perfis`
MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `postos`
--
ALTER TABLE `postos`
MODIFY `id_posto` tinyint(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
