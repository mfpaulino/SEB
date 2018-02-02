-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 02/02/2018 às 07:51
-- Versão do servidor: 10.0.32-MariaDB-0+deb8u1
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
-- Estrutura para tabela `adm_areas`
--

CREATE TABLE IF NOT EXISTS `adm_areas` (
`id_area` int(11) NOT NULL,
  `area` varchar(255) NOT NULL,
  `id_subarea_vinc` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_areas`
--

INSERT INTO `adm_areas` (`id_area`, `area`, `id_subarea_vinc`) VALUES
(7, 'Área 7', 'a:4:{i:0;s:2:"13";i:1;s:2:"11";i:2;s:2:"17";i:3;s:2:"15";}'),
(8, 'Área 8', 'a:2:{i:1;s:2:"16";i:2;s:2:"13";}'),
(9, 'Área 9', 'a:1:{i:0;s:2:"14";}'),
(10, 'Área 10', ''),
(11, 'Área 12', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_avisos`
--

CREATE TABLE IF NOT EXISTS `adm_avisos` (
`id_aviso` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` varchar(500) NOT NULL,
  `autor` varchar(11) NOT NULL,
  `dt_aviso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dt_validade` date NOT NULL,
  `publico` varchar(255) NOT NULL,
  `status` varchar(7) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_avisos`
--

INSERT INTO `adm_avisos` (`id_aviso`, `titulo`, `texto`, `autor`, `dt_aviso`, `dt_validade`, `publico`, `status`) VALUES
(23, 'teste', 'teste1', '00917251784', '2018-02-01 15:38:59', '2018-02-01', 'a:7:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"9";i:5;s:2:"10";i:6;s:2:"11";}', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_categorias`
--

CREATE TABLE IF NOT EXISTS `adm_categorias` (
`id_categoria` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `localidades` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_categorias`
--

INSERT INTO `adm_categorias` (`id_categoria`, `categoria`, `localidades`) VALUES
(28, 'A', 'PA, MG, AM'),
(29, 'C', 'MG, SC, RS'),
(30, 'D', 'aa,aa,a,a,a,a'),
(31, 'E', 'PB, PA, BA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_diarias`
--

CREATE TABLE IF NOT EXISTS `adm_diarias` (
`id_diaria` int(11) NOT NULL,
  `id_posto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_diarias`
--

INSERT INTO `adm_diarias` (`id_diaria`, `id_posto`, `id_categoria`, `valor`) VALUES
(3, 6, 26, 100),
(4, 4, 26, 200),
(5, 11, 26, 200),
(6, 1, 26, 650.21),
(8, 10, 26, 80),
(9, 3, 26, 1),
(10, 2, 26, 0.55),
(11, 8, 26, 120.15),
(12, 1, 27, 150),
(13, 6, 28, 200),
(14, 3, 29, 1500),
(15, 5, 28, 200),
(16, 8, 28, 1.11),
(17, 14, 28, 1.21),
(18, 3, 28, 1140);

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_fontes_informacao`
--

CREATE TABLE IF NOT EXISTS `adm_fontes_informacao` (
`id_fonte_info` int(11) NOT NULL,
  `fonte_info` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_fontes_informacao`
--

INSERT INTO `adm_fontes_informacao` (`id_fonte_info`, `fonte_info`) VALUES
(3, 'Fonte 1'),
(4, 'Fonte 4');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_info_requeridas`
--

CREATE TABLE IF NOT EXISTS `adm_info_requeridas` (
`id_info_req` int(11) NOT NULL,
  `info_req` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_info_requeridas`
--

INSERT INTO `adm_info_requeridas` (`id_info_req`, `info_req`) VALUES
(1, 'Informação teste1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_perfis`
--

CREATE TABLE IF NOT EXISTS `adm_perfis` (
`id_perfil` int(11) NOT NULL,
  `perfil` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_perfis`
--

INSERT INTO `adm_perfis` (`id_perfil`, `perfil`, `descricao`) VALUES
(1, 'Administrador', '(Responsável pelo Sistema na Unidade)'),
(2, 'Auditor/Analista', '(Integrante Seção de Auditoria)'),
(3, 'Coordenador', '(Ch Seção de Auditoria)'),
(4, 'Gestor', '(Cmt/Ch/Dir/OD)'),
(5, 'Operador', '(Militar/Servidor Civil Designado pelo Gestor)'),
(6, 'Supervisor', '(Ch CCIEX, Ch ICFEx)');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_perfis_administra`
--

CREATE TABLE IF NOT EXISTS `adm_perfis_administra` (
`id_perfil_admin` int(11) NOT NULL,
  `id_perfil_om` int(11) NOT NULL COMMENT 'adm_perfis_unidade.id_perfil_om',
  `id_perfil` int(11) NOT NULL COMMENT 'adm_perfis.id_perfil',
  `lista_perfis` varchar(200) NOT NULL COMMENT 'perfis administrados'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_perfis_administra`
--

INSERT INTO `adm_perfis_administra` (`id_perfil_admin`, `id_perfil_om`, `id_perfil`, `lista_perfis`) VALUES
(1, 1, 1, 'a:6:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"8";i:5;s:2:"10";}'),
(2, 1, 2, 'a:1:{i:0;s:1:"1";}'),
(3, 1, 3, ''),
(4, 1, 6, ''),
(5, 2, 1, 'a:4:{i:0;s:1:"5";i:1;s:1:"6";i:2;s:1:"7";i:3;s:2:"10";}'),
(6, 2, 2, ''),
(7, 2, 3, ''),
(8, 2, 6, 'a:1:{i:0;s:1:"8";}'),
(9, 3, 1, 'a:1:{i:0;s:2:"11";}'),
(10, 3, 4, 'a:1:{i:0;s:2:"10";}'),
(11, 3, 5, ''),
(12, 2, 5, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_perfis_unidade`
--

CREATE TABLE IF NOT EXISTS `adm_perfis_unidade` (
`id_perfil_om` int(11) NOT NULL,
  `unidade` varchar(255) NOT NULL,
  `perfis` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_perfis_unidade`
--

INSERT INTO `adm_perfis_unidade` (`id_perfil_om`, `unidade`, `perfis`) VALUES
(1, 'CCIEx', 'a:4:{i:0;s:13:"Administrador";i:1;s:16:"Auditor/Analista";i:2;s:11:"Coordenador";i:3;s:10:"Supervisor";}'),
(2, 'ICFEx', 'a:5:{i:0;s:13:"Administrador";i:1;s:16:"Auditor/Analista";i:2;s:11:"Coordenador";i:3;s:10:"Supervisor";i:4;s:8:"Operador";}'),
(3, 'Unidade', 'a:3:{i:0;s:13:"Administrador";i:1;s:6:"Gestor";i:2;s:8:"Operador";}');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_permissoes`
--

CREATE TABLE IF NOT EXISTS `adm_permissoes` (
`id_permissao` int(11) NOT NULL,
  `permissao` varchar(255) NOT NULL,
  `descricao` varchar(512) NOT NULL,
  `lista_perfis` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_permissoes`
--

INSERT INTO `adm_permissoes` (`id_permissao`, `permissao`, `descricao`, `lista_perfis`) VALUES
(9, 'adm_areas', 'Administrar Lista de Áreas/Processos', 'a:1:{i:0;s:1:"1";}'),
(10, 'adm_avisos', 'Administrar Avisos', 'a:1:{i:0;s:1:"1";}'),
(11, 'adm_categorias', 'Administrar Categorias (localidades para diárias)', 'a:1:{i:0;s:1:"1";}'),
(12, 'adm_diarias', 'Administrar Valores de Diárias', 'a:1:{i:0;s:1:"1";}'),
(13, 'adm_fontes_informacao', 'Administrar Lista de Fontes de Informações', 'a:1:{i:0;s:1:"1";}'),
(14, 'adm_info_requeridas', 'Administrar Lista de Informações Requeridas', 'a:1:{i:0;s:1:"1";}'),
(15, 'adm_perfis', 'Administrar Perfis do Sistema', 'a:1:{i:0;s:1:"1";}'),
(16, 'adm_permissoes', 'Administrar Permissões do Sistema', 'a:1:{i:0;s:1:"1";}'),
(17, 'adm_poss_achados', 'Administrar Lista de Possíveis Achados', 'a:1:{i:0;s:1:"1";}'),
(18, 'adm_proc_analise', 'Administrar Lista de Procedimentos de Análise', 'a:1:{i:0;s:1:"1";}'),
(19, 'adm_proc_coleta', 'Administrar Lista de Procedimentos de Coleta de Dados', 'a:1:{i:0;s:1:"1";}'),
(20, 'adm_questoes', 'Administrar Lista de Questões de Auditoria', 'a:1:{i:0;s:1:"1";}'),
(21, 'adm_subareas', 'Administrar Lista de Subáreas/Subprocessos', 'a:1:{i:0;s:1:"1";}'),
(22, 'adm_sugestoes_admin', 'Administrar Sugestões', 'a:1:{i:0;s:1:"1";}'),
(23, 'adm_tipo_evento', 'Administrar Lista de Tipos de Eventos', 'a:1:{i:0;s:1:"1";}'),
(24, 'adm_sugestoes', 'Realizar Sugestões ao Sistema', 'a:1:{i:0;s:1:"1";}'),
(25, 'adm_usuarios', 'Administrar Usuários do Sistema', 'a:1:{i:0;s:1:"1";}');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_poss_achados`
--

CREATE TABLE IF NOT EXISTS `adm_poss_achados` (
`id_poss_achado` int(11) NOT NULL,
  `poss_achado` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_poss_achados`
--

INSERT INTO `adm_poss_achados` (`id_poss_achado`, `poss_achado`) VALUES
(1, 'Possível achado 1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_proc_analise`
--

CREATE TABLE IF NOT EXISTS `adm_proc_analise` (
`id_proc_ana` int(11) NOT NULL,
  `proc_ana` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_proc_analise`
--

INSERT INTO `adm_proc_analise` (`id_proc_ana`, `proc_ana`) VALUES
(2, 'Proc 1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_proc_coleta`
--

CREATE TABLE IF NOT EXISTS `adm_proc_coleta` (
`id_proc_coleta` int(11) NOT NULL,
  `proc_coleta` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_proc_coleta`
--

INSERT INTO `adm_proc_coleta` (`id_proc_coleta`, `proc_coleta`) VALUES
(1, 'Proc 1 coleta');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_questoes`
--

CREATE TABLE IF NOT EXISTS `adm_questoes` (
`id_questao` int(11) NOT NULL,
  `questao` varchar(255) NOT NULL,
  `id_info_req_vinc` varchar(500) NOT NULL,
  `id_poss_achado_vinc` varchar(500) NOT NULL,
  `id_proc_ana_vinc` varchar(500) NOT NULL,
  `id_proc_coleta_vinc` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_questoes`
--

INSERT INTO `adm_questoes` (`id_questao`, `questao`, `id_info_req_vinc`, `id_poss_achado_vinc`, `id_proc_ana_vinc`, `id_proc_coleta_vinc`) VALUES
(3, 'Questão 3', '', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"2";}', 'a:1:{i:0;s:1:"1";}'),
(4, 'Questão 4', '', '', '', 'a:1:{i:0;s:1:"1";}'),
(5, 'Questão 5', '', '', '', ''),
(6, 'Questão 6', 'a:1:{i:0;s:1:"1";}', '', '', ''),
(7, 'Questão 7', '', 'a:1:{i:0;s:1:"1";}', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_subareas`
--

CREATE TABLE IF NOT EXISTS `adm_subareas` (
`id_subarea` int(11) NOT NULL,
  `subarea` varchar(255) NOT NULL,
  `id_questao_vinc` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_subareas`
--

INSERT INTO `adm_subareas` (`id_subarea`, `subarea`, `id_questao_vinc`) VALUES
(11, 'rr3r23r23r23rv', ''),
(13, 'dgfgfgfgfgfgfqqq qqq', ''),
(14, 'sdsdsdsdsds d wf rf iwof oir jriwfj i3rfj poe fkpo f 4r .', ''),
(15, 'Subárea1', 'a:1:{i:0;s:1:"6";}'),
(16, 'Subárwwea1', ''),
(17, 'Subárea2', ''),
(18, 'erercer ce', ''),
(19, 'xxxxxxxxxxxxxxxxxxxxxxx', 'a:1:{i:0;s:1:"3";}'),
(21, 'Subárea3', 'a:1:{i:0;s:1:"7";}');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_sugestoes`
--

CREATE TABLE IF NOT EXISTS `adm_sugestoes` (
`id_sugestao` int(11) NOT NULL,
  `sugestao` varchar(255) NOT NULL,
  `tabela` varchar(255) NOT NULL,
  `id_pai` int(11) NOT NULL,
  `usuario` varchar(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_sugestoes`
--

INSERT INTO `adm_sugestoes` (`id_sugestao`, `sugestao`, `tabela`, `id_pai`, `usuario`, `data`) VALUES
(1, 'teste', '', 0, '00917251784', '2017-10-30 17:46:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_tipo_evento`
--

CREATE TABLE IF NOT EXISTS `adm_tipo_evento` (
`id_tipo_evento` int(11) NOT NULL,
  `tipo_evento` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_tipo_evento`
--

INSERT INTO `adm_tipo_evento` (`id_tipo_evento`, `tipo_evento`) VALUES
(3, 'testete ededed'),
(1, 'Tipo 11'),
(2, 'Tipo 2');

-- --------------------------------------------------------

--
-- Estrutura para tabela `correio_enviados`
--

CREATE TABLE IF NOT EXISTS `correio_enviados` (
`id_correio` int(11) NOT NULL,
  `destinatario` varchar(1000) NOT NULL,
  `assunto` varchar(1000) NOT NULL,
  `texto` varchar(1000) NOT NULL,
  `remetente` char(11) NOT NULL,
  `data` datetime NOT NULL,
  `excluida` char(3) NOT NULL DEFAULT 'nao'
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `correio_enviados`
--

INSERT INTO `correio_enviados` (`id_correio`, `destinatario`, `assunto`, `texto`, `remetente`, `data`, `excluida`) VALUES
(84, '23;32;', 'Sem vdvd   f f wf cf weassunto', 'ikuukuk', '17251784009', '2017-09-27 15:18:09', 'nao'),
(85, '9;', 'Sem ass', '<p>wswswswswswswsw<br></p>', '00917251784', '2017-09-28 09:26:07', 'nao'),
(86, '9;', 'Sem assunto', '<p>fefefefefefe<br></p>', '72517840091', '2017-10-02 14:11:08', 'nao'),
(87, '34;23;', 'Sem f f ss  fwef wef iweo jiwef efdfs f sf sfassunto', '<p>wdwdwdw<br></p>', '00917251784', '2017-10-03 13:59:42', 'nao'),
(88, '32;', 'Sem assunto', '<p>efefefefefef<br></p>', '00917251784', '2017-10-03 16:08:32', 'nao'),
(89, '9;1;', 'Sem assunto', '<p>aqaqaqaqa<br></p>', '00917251784', '2017-10-03 16:11:52', 'nao'),
(90, '9;32;34;1;', 'Sem ', '<p>qaqaqa<br></p>', '00917251784', '2017-10-03 16:41:01', 'nao'),
(91, '9;32;34;', 'sdsdsd', '<p>ssdsd<br></p>', '00917251784', '2017-10-04 14:07:43', 'nao'),
(92, '23;', 'Sem assunto', '<p>3e3e3e3e<br></p>', '17251784009', '2017-10-04 15:13:29', 'sim'),
(93, '9;', 'Sem assunto', '<p>rtrrt5<br></p>', '', '2017-10-10 15:16:29', 'nao'),
(94, '9;1;', 'treggg', '<p>gg rgeg reg<br></p>', '17251784009', '2017-10-16 16:07:46', 'nao'),
(95, '34;', 'ENC: treggg', '<p>gg rgeg reg tgtgtggtgtg<br></p>', '17251784009', '2017-10-16 16:08:08', 'nao'),
(96, '9;32;', 'Sem assunto', '<p>azazaz<br></p>', '00917251784', '2017-10-17 11:25:40', 'nao'),
(97, '9;34;', 'ewew', '<p>rerere<br></p>', '17251784009', '2017-10-18 15:25:04', 'nao'),
(98, '9;1;', 'Sem assunto', '<p>ç,l,çl,l,l,<br></p>', '17251784009', '2017-10-19 13:20:03', 'nao'),
(99, '33;', 'teste', '<p><b><i><u>sssdsas</u></i></b><br></p><br><br><br>', '17251784009', '2017-12-04 13:15:55', 'nao'),
(100, '33;', 'teste', '<p>wefeffefe<br></p>', '17251784009', '2018-01-04 15:53:12', 'nao'),
(101, '33;', 'teste1', '<p>eerrf<br></p>', '17251784009', '2018-01-04 15:53:30', 'nao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `correio_recebidos`
--

CREATE TABLE IF NOT EXISTS `correio_recebidos` (
`id` int(11) NOT NULL,
  `id_correio` int(11) NOT NULL,
  `destinatario` char(11) NOT NULL,
  `lida` char(3) NOT NULL DEFAULT 'nao',
  `pasta` char(8) NOT NULL DEFAULT 'entrada'
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `correio_recebidos`
--

INSERT INTO `correio_recebidos` (`id`, `id_correio`, `destinatario`, `lida`, `pasta`) VALUES
(103, 84, '23', 'sim', 'ja_lidos'),
(104, 84, '32', 'sim', 'ja_lidos'),
(105, 85, '9', 'nao', 'entrada'),
(106, 86, '9', 'sim', 'entrada'),
(107, 87, '34', 'nao', 'entrada'),
(108, 87, '23', 'sim', 'entrada'),
(110, 89, '9', 'sim', 'entrada'),
(111, 89, '1', 'nao', 'entrada'),
(112, 90, '9', 'sim', 'entrada'),
(114, 90, '34', 'nao', 'entrada'),
(115, 90, '1', 'sim', 'entrada'),
(116, 91, '9', 'nao', 'entrada'),
(117, 91, '32', 'sim', 'ja_lidos'),
(118, 91, '34', 'nao', 'entrada'),
(119, 92, '23', 'nao', 'entrada'),
(120, 93, '9', 'nao', 'entrada'),
(121, 94, '9', 'nao', 'entrada'),
(122, 94, '1', 'nao', 'entrada'),
(123, 95, '34', 'nao', 'entrada'),
(125, 97, '9', 'nao', 'entrada'),
(126, 97, '34', 'nao', 'entrada'),
(127, 98, '9', 'nao', 'entrada'),
(128, 98, '1', 'nao', 'entrada'),
(129, 99, '33', 'nao', 'entrada'),
(130, 100, '33', 'nao', 'entrada'),
(131, 101, '32', 'sim', 'entrada');

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
`id_log` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `codom` char(6) NOT NULL,
  `acao` varchar(1000) NOT NULL,
  `tabela` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `logs`
--

INSERT INTO `logs` (`id_log`, `cpf`, `codom`, `acao`, `tabela`, `data`) VALUES
(103, '17251784009', '005801', 'Cadastrou a Subárea <u>2r23r23r23r23r</u> para a Área <u>Área  djf uj uf huef urh ui iwejf oiwefj iowejf iweojf iweofj iweofj iweofjiweofwefwef.</u>.', 'adm_subareas', '2017-11-01 15:51:51'),
(104, '17251784009', '005801', 'Cadastrou a Subárea <u>2r2323r2r</u> para a Área <u>Área 4r uf uf uefh uiweofh wof oiwefoiwefh weofh woefh fh uieo fhuieowfhuiweofhiweofhiweof</u>.', 'adm_subareas', '2017-11-01 16:11:47'),
(105, '17251784009', '005801', 'Cadastrou a Subárea <u>rr3r23r23r23rv</u> para a Área <u>Área 4r uf uf uefh uiweofh wof oiwefoiwefh weofh woefh fh uieo fhuieowfhuiweofhiweofhiweof</u>.', 'adm_subareas', '2017-11-01 16:11:55'),
(106, '17251784009', '005801', 'Alterou a Subárea "<u>2r23r23r23r23r</u>" para <u>2r23r23r</u> da Área <u>Área  djf uj uf huef urh ui iwejf oiwefj iowejf iweojf iweofj iweofj iweofjiweofwefwef.</u>.', 'adm_subareas', '2017-11-06 12:12:11'),
(107, '17251784009', '005801', 'Excluiu a Subarea <u>2r23r23r</u> da Área <u>Área  djf uj uf huef urh ui iwejf oiwefj iowejf iweojf iweofj iweofj iweofjiweofwefwef.</u>.', 'adm_subareas', '2017-11-06 12:12:23'),
(108, '17251784009', '005801', 'Alterou a Subárea "<u>2r2323r2r</u>" para <u>2r2323r2recdccd</u> da Área <u>Área 4r uf uf uefh uiweofh wof oiwefoiwefh weofh woefh fh uieo fhuieowfhuiweofhiweofhiweof</u>.', 'adm_subareas', '2017-11-06 12:12:38'),
(109, '17251784009', '005801', 'Cadastrou a Subárea <u>dsdsds</u> para a Área <u>Área  djf uj uf huef urh ui iwejf oiwefj iowejf iweojf iweofj iweofj iweofjiweofwefwef.</u>.', 'adm_subareas', '2017-11-07 17:33:27'),
(110, '17251784009', '005801', 'Cadastrou a Subárea <u>dgfgfgfgfgfgf</u> para a Área <u>Área  djf uj uf huef urh ui iwejf oiwefj iowejf iweojf iweofj iweofj iweofjiweofwefwef.</u>.', 'adm_subareas', '2017-11-07 17:33:43'),
(111, '17251784009', '005801', 'Cadastrou a Subárea <u>sdsdsdsdsds</u> para a Área <u>Área  djf uj uf huef urh ui iwejf oiwefj iowejf iweojf iweofj iweofj iweofjiweofwefwef.</u>.', 'adm_subareas', '2017-11-07 17:34:00'),
(112, '17251784009', '005801', 'Cadastrou a Área <u>Área 1</u>.', 'adm_areas', '2017-11-08 11:07:55'),
(113, '17251784009', '005801', 'Cadastrou a Área <u>Área 2</u>.', 'adm_areas', '2017-11-08 11:08:07'),
(114, '17251784009', '005801', 'Cadastrou a Subárea <u>Subárea1</u> para a Área <u>Área 1</u>.', 'adm_subareas', '2017-11-08 11:08:28'),
(115, '17251784009', '005801', 'Cadastrou a Subárea <u>Subárea1</u> para a Área <u>Área 2</u>.', 'adm_subareas', '2017-11-08 11:08:44'),
(116, '17251784009', '005801', 'Cadastrou a Subárea <u>Subárea2</u>.', 'adm_subareas', '2017-11-08 12:27:39'),
(117, '17251784009', '005801', 'Excluiu a Subarea <u>dsdsds</u>.', 'adm_subareas', '2017-11-08 13:08:50'),
(118, '17251784009', '005801', 'Excluiu a Subarea <u>2r2323r2recdccd</u>.', 'adm_subareas', '2017-11-08 13:09:00'),
(119, '17251784009', '005801', 'Alterou a Subárea "<u>dgfgfgfgfgfgf</u>" para <u>dgfgfgfgfgfgfqqq qqq</u>.', 'adm_subareas', '2017-11-08 13:09:12'),
(120, '17251784009', '005801', 'Alterou a Área "<u>Área  djf uj uf huef urh ui iwejf oiwefj iowejf iweojf iweofj iweofj iweofjiweofwefwef.</u>" para <u>Área  djf uj uf huef urh ui iwej  wedofdk vpweof pof kpeok rp42o rkp423orkp43orkfr3eff oiwefj iowejf iweojf iweofj iweofj iweofjiweofwefwef.</u>.', 'adm_areas', '2017-11-08 17:25:41'),
(121, '17251784009', '005801', 'Cadastrou a Subárea <u>erercer ce</u>.', 'adm_subareas', '2017-11-08 17:36:31'),
(122, '17251784009', '005801', 'Cadastrou a Subárea <u>f  f4f 4f 3f </u>.', 'adm_subareas', '2017-11-08 17:36:36'),
(123, '17251784009', '005801', 'Cadastrou a Subárea <u> 4fefef ef  ef ef ef ef ef ef ef wef wef wef f f wef wef wef wef w</u>.', 'adm_subareas', '2017-11-08 17:36:47'),
(124, '17251784009', '005801', 'Cadastrou a Subárea <u>Subárea3</u>.', 'adm_subareas', '2017-11-14 16:22:46'),
(125, '17251784009', '005801', 'Alterou a Subárea "<u>f  f4f 4f 3f </u>" para <u>xxxxxxxxxxxxxxxxxxxxxxx</u>.', 'adm_subareas', '2017-11-14 16:27:03'),
(126, '17251784009', '005801', 'Alterou a Subárea "<u>sdsdsdsdsds</u>" para <u>sdsdsdsdsds d wf rf iwof oir jriwfj i3rfj poe fkpo f 4r .</u>.', 'adm_subareas', '2017-11-14 17:26:02'),
(127, '17251784009', '005801', 'Alterou a Área "<u>Área  djf uj uf huef urh ui iwej  wedofdk vpweof pof kpeok rp42o rkp423orkp43orkfr3eff oiwefj iowejf iweojf iweofj iweofj iweofjiweofwefwef.</u>" para <u>Área 8</u>.', 'adm_areas', '2017-11-16 18:18:09'),
(128, '17251784009', '005801', 'Alterou a Área "<u>Área 4r uf uf uefh uiweofh wof oiwefoiwefh weofh woefh fh uieo fhuieowfhuiweofhiweofhiweof</u>" para <u>Área 7</u>.', 'adm_areas', '2017-11-16 18:18:28'),
(129, '17251784009', '005801', 'Alterou a Área "<u>Área 2</u>" para <u>Área 10</u>.', 'adm_areas', '2017-11-16 18:18:47'),
(130, '17251784009', '005801', 'Alterou a Área "<u>Área 1</u>" para <u>Área 9</u>.', 'adm_areas', '2017-11-16 18:19:03'),
(131, '17251784009', '005801', 'Cadastrou a Questão <u>Questão 4</u>.', 'adm_questoes', '2017-12-04 19:14:48'),
(132, '17251784009', '005801', 'Cadastrou a Questão <u>Questão 5</u>.', 'adm_questoes', '2017-12-04 19:24:29'),
(133, '17251784009', '005801', 'Cadastrou a Questão <u>Questão 6</u>.', 'adm_questoes', '2017-12-04 19:25:21'),
(134, '17251784009', '005801', 'Cadastrou a Questão <u>Questão 7</u>.', 'adm_questoes', '2017-12-04 19:32:11'),
(135, '17251784009', '005801', 'Alterou a Questão "<u>Questão 1</u>" para <u>Questão 11</u>.', 'adm_questoes', '2017-12-04 19:39:04'),
(136, '17251784009', '005801', 'Excluiu a Questão <u>Questão 11</u>.', 'adm_questoes', '2017-12-04 19:39:16'),
(137, '17251784009', '005801', 'Alterou a Questão "<u>Questão 2</u>" para <u>Questão 20</u>.', 'adm_questoes', '2017-12-05 15:14:56'),
(138, '17251784009', '005801', 'Excluiu a Questão <u>Questão 20</u>.', 'adm_questoes', '2017-12-05 15:15:09'),
(139, '17251784009', '005801', 'Cadastrou a Informação Requerida <u>Informação teste</u>.', 'adm_questoes', '2017-12-11 15:52:08'),
(140, '17251784009', '005801', 'Alterou a Informação Requerida "<u>Informação teste</u>" para <u>Informação teste1</u>.', 'adm_questoes', '2017-12-11 16:12:59'),
(141, '17251784009', '005801', 'Cadastrou a Informação Requerida <u>Info 2</u>.', 'adm_info_requeridas', '2017-12-11 16:15:40'),
(142, '17251784009', '005801', 'Alterou a Informação Requerida "<u>Info 2</u>" para <u>Infor 2</u>.', 'adm_info_requeridas', '2017-12-11 16:15:51'),
(143, '17251784009', '005801', 'Alterou a Informação Requerida "<u>Infor 2</u>" para <u>Info req 2</u>.', 'adm_info_requeridas', '2017-12-11 16:17:31'),
(144, '17251784009', '005801', 'Excluiu a Informação Requerida <u>Info req 2</u>.', 'adm_info_requeridas', '2017-12-11 16:19:51'),
(145, '17251784009', '005801', 'Cadastrou o Possível Achado <u>POssivel achad o1</u>.', 'adm_poss_achados', '2017-12-11 17:30:52'),
(146, '17251784009', '005801', 'Cadastrou o Possível Achado <u>Possível achado 2</u>.', 'adm_poss_achados', '2017-12-11 17:32:27'),
(147, '17251784009', '005801', 'Alterou a Informação Requerida "<u>POssivel achad o1</u>" para <u>Possível achado 1</u>.', 'adm_poss_achados', '2017-12-11 17:32:56'),
(148, '17251784009', '005801', 'Excluiu o Possível Achado <u>Possível achado 2</u>.', 'adm_poss_achados', '2017-12-11 17:33:07'),
(149, '17251784009', '005801', 'Cadastrou o Procedimento de Análise <u>Proc 1</u>.', 'adm_proc_analise', '2017-12-11 19:15:59'),
(150, '17251784009', '005801', 'Alterou Procedimento de Análise "<u>Proc 1</u>" para <u>Proc 1.</u>.', 'adm_proc_analise', '2017-12-11 19:17:12'),
(151, '17251784009', '005801', 'Excluiu o Possível Achado <u>Proc 1.</u>.', 'adm_proc_analise', '2017-12-11 19:17:32'),
(152, '17251784009', '005801', 'Cadastrou o Procedimento de Análise <u>Proc 1</u>.', 'adm_proc_analise', '2017-12-11 19:17:48'),
(153, '17251784009', '005801', 'Cadastrou o Procedimento de Análise <u>Proc 1</u>.', 'adm_proc_coleta', '2017-12-11 19:42:52'),
(154, '17251784009', '005801', 'Alterou Procedimento de Coleta de Dados "<u>Proc 1</u>" para <u>Proc 1.</u>.', 'adm_proc_coleta', '2017-12-11 19:43:08'),
(155, '17251784009', '005801', 'Excluiu o Possível Achado <u>Proc 1.</u>.', 'adm_proc_coleta', '2017-12-11 19:43:28'),
(156, '17251784009', '005801', 'Cadastrou o Procedimento de Análise <u>Proc 1 coleta</u>.', 'adm_proc_coleta', '2017-12-12 17:20:52'),
(157, '17251784009', '005801', 'Cadastrou a Fonte de Informação <u>fontwe 1</u>.', 'adm_fontes_informacao', '2017-12-12 18:02:47'),
(158, '17251784009', '005801', 'Cadastrou a Fonte de Informação <u>Fonte 2</u>.', 'adm_fontes_informacao', '2017-12-12 18:04:24'),
(159, '17251784009', '005801', 'Excluiu a Fonte de Informação <u>fontwe 1</u>.', 'adm_fontes_informacao', '2017-12-12 18:04:51'),
(160, '17251784009', '005801', 'Alterou a Área "<u>Fonte 2</u>" para <u>Fonte 1</u>.', 'adm_fontes_informacao', '2017-12-12 18:13:12'),
(161, '17251784009', '005801', 'Excluiu a Fonte de Informação <u>Fonte 1</u>.', 'adm_fontes_informacao', '2017-12-12 18:13:31'),
(162, '17251784009', '005801', 'Cadastrou a Fonte de Informação <u>Fonte 1</u>.', 'adm_fontes_informacao', '2017-12-12 18:13:50'),
(163, '17251784009', '005801', 'Alterou o perfil do(a) Cel Ererer  do(a) 11º GAC de <u>Operador</u> para <u>Gestor</u>.', '', '2017-12-13 17:04:40'),
(164, '17251784009', '005801', 'Habilitou o(a) Cel Ererer  do(a) 11º GAC com o perfil Gestor.', '', '2017-12-13 17:04:49'),
(165, '17251784009', '005801', 'Excluiu o(a) Cel Ererer  do(a) 11º GAC.', '', '2017-12-13 17:05:52'),
(166, '17251784009', '005801', 'Cadastrou o Aviso <u>dede</u>.', 'adm_avisos', '2017-12-14 19:31:46'),
(167, '17251784009', '005801', 'Cadastrou o Aviso <u>tee</u>.', 'adm_avisos', '2017-12-14 19:48:18'),
(168, '17251784009', '005801', 'Cadastrou o Aviso <u>s</u>.', 'adm_avisos', '2017-12-14 19:50:58'),
(169, '17251784009', '005801', 'Cadastrou o Aviso <u>erere</u>.', 'adm_avisos', '2017-12-15 11:09:53'),
(170, '17251784009', '005801', 'Cadastrou o Aviso <u>aqa</u>.', 'adm_avisos', '2017-12-15 11:20:22'),
(171, '17251784009', '005801', 'Cadastrou o Aviso <u>2w2w</u>.', 'adm_avisos', '2017-12-15 11:21:28'),
(172, '17251784009', '005801', 'Cadastrou o Aviso <u>2s</u>.', 'adm_avisos', '2017-12-15 11:22:01'),
(173, '17251784009', '005801', 'Cadastrou o Aviso <u>wsws</u>.', 'adm_avisos', '2017-12-15 11:30:07'),
(174, '17251784009', '005801', 'Cadastrou o Aviso <u>wwsws</u>.', 'adm_avisos', '2017-12-15 11:31:45'),
(175, '17251784009', '005801', 'Cadastrou o Aviso <u>ssx</u>.', 'adm_avisos', '2017-12-15 12:48:13'),
(176, '17251784009', '005801', 'Cadastrou o Aviso <u>wswsw</u>.', 'adm_avisos', '2017-12-15 13:53:34'),
(177, '17251784009', '005801', 'Cadastrou o Aviso <u>a2a2</u>.', 'adm_avisos', '2017-12-15 13:53:59'),
(178, '17251784009', '005801', 'Cadastrou o Aviso <u>2w2w2w2w2w</u>.', 'adm_avisos', '2017-12-15 13:54:37'),
(179, '17251784009', '005801', 'Cadastrou o Aviso <u>titulo aviso 1</u>.', 'adm_avisos', '2017-12-18 15:12:21'),
(180, '17251784009', '005801', 'Cadastrou o Aviso <u>frfrfr</u>.', 'adm_avisos', '2017-12-18 15:58:38'),
(181, '17251784009', '005801', 'Cadastrou o Aviso <u>4</u>.', 'adm_avisos', '2017-12-20 16:04:34'),
(182, '17251784009', '005801', 'Cadastrou o Aviso <u>5</u>.', 'adm_avisos', '2017-12-20 16:11:05'),
(183, '17251784009', '005801', 'Cadastrou o Aviso <u>6</u>.', 'adm_avisos', '2017-12-20 16:11:40'),
(184, '17251784009', '005801', 'Cadastrou o Aviso <u>55</u>.', 'adm_avisos', '2017-12-20 16:31:11'),
(185, '17251784009', '005801', 'Cadastrou o Aviso <u>1221</u>.', 'adm_avisos', '2017-12-20 16:34:31'),
(186, '17251784009', '005801', 'Cadastrou o Aviso <u>ewew</u>.', 'adm_avisos', '2017-12-20 16:43:14'),
(187, '17251784009', '005801', 'Cadastrou o Tipo de Auditoria <u>Tipo 1</u>.', 'adm_tipo_auditoria', '2017-12-26 15:55:15'),
(188, '17251784009', '005801', 'Cadastrou o Tipo de Auditoria <u>Tipo 2</u>.', 'adm_tipo_auditoria', '2017-12-26 16:04:23'),
(189, '17251784009', '005801', 'Cadastrou a Fonte de Informação <u>Fonte 4</u>.', 'adm_fontes_informacao', '2017-12-26 16:06:05'),
(190, '17251784009', '005801', 'Alterou o Tipo de Auditoria "<u>Tipo 1</u>" para <u>Tipo 11</u>.', 'adm_tipo_auditoria', '2017-12-26 16:07:40'),
(191, '17251784009', '005801', 'Cadastrou o Aviso <u>Alteração no PAAA</u>.', 'adm_avisos', '2017-12-27 16:47:51'),
(192, '17251784009', '005801', 'Cadastrou o Tipo de Auditoria <u>testete</u>.', 'adm_tipo_evento', '2017-12-27 18:42:03'),
(193, '17251784009', '005801', 'Alterou o Tipo de Evento "<u>testete</u>" para <u>testete ededed</u>.', 'adm_tipo_evento', '2017-12-27 18:42:14'),
(194, '00917251784', '168001', 'Redefiniu a senha do(a) Cap Paulino do(a) CCIEx.', '', '2018-01-04 15:26:17'),
(195, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-08 18:28:05'),
(196, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-08 18:30:48'),
(197, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-08 18:34:27'),
(198, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-08 18:34:35'),
(199, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-08 18:36:48'),
(200, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-08 18:37:54'),
(201, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-08 18:38:13'),
(202, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-08 18:38:17'),
(203, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-08 19:04:02'),
(204, '17251784009', '016139', 'Cadastrou a Área <u>Área 12</u>.', 'adm_areas', '2018-01-09 16:43:07'),
(205, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:34:49'),
(206, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:36:03'),
(207, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:42:12'),
(208, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:42:58'),
(209, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:44:42'),
(210, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:45:30'),
(211, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:45:56'),
(212, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:46:52'),
(213, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:47:09'),
(214, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:48:15'),
(215, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:48:38'),
(216, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:49:15'),
(217, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 18:56:44'),
(218, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:00:16'),
(219, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:00:31'),
(220, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:05:03'),
(221, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:05:20'),
(222, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:05:48'),
(223, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:05:59'),
(224, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:06:11'),
(225, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:06:36'),
(226, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:07:03'),
(227, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-09 19:13:39'),
(228, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:15:16'),
(229, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:15:41'),
(230, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:15:48'),
(231, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:20:50'),
(232, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:24:00'),
(233, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:29:22'),
(234, '17251784009', '016139', 'Excluiu uma de suas habilitações.', 'usuarios_habilitacao', '2018-01-09 19:31:38'),
(235, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:44:49'),
(236, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:45:27'),
(237, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:45:40'),
(238, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:46:07'),
(239, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:47:07'),
(240, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-09 19:47:17'),
(241, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-10 15:08:28'),
(242, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-10 15:15:10'),
(243, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-10 15:15:19'),
(244, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-10 15:15:47'),
(245, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-10 15:15:53'),
(246, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-10 15:16:03'),
(247, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-10 15:17:04'),
(248, '17251784009', '016139', 'Alterou dados referentes à habilitação.', 'usuarios_habilitacao', '2018-01-10 17:57:52'),
(249, '17251784009', '016139', 'Cadastrou o Aviso <u>wrerer</u>.', 'adm_avisos', '2018-01-12 10:52:45'),
(250, '00917251784', '016139', 'Alterou o perfil do(a) Cap Paulino do(a) CCIEx de <u>Administrador</u> para <u>2</u>.', 'usuarios', '2018-01-12 13:37:33'),
(251, '00917251784', '016139', 'Alterou o perfil do(a) Cap Paulino do(a) CCIEx de <u>Administrador</u> para <u>Auditor/Analista</u>.', 'usuarios', '2018-01-12 13:41:56'),
(252, '00917251784', '016139', 'Alterou o perfil do(a) Cap Paulino do(a) CCIEx de <u>Auditor/Analist</u> para <u>Auditor/Analista</u>.', 'usuarios', '2018-01-12 13:42:41'),
(253, '00917251784', '016139', 'Habilitou o(a) Cap Paulino do(a) CCIEx com o perfil .', 'usuarios', '2018-01-12 13:43:02'),
(254, '00917251784', '016139', 'Alterou o perfil do(a) Cap Paulino do(a) CCIEx de <u>Auditor/Analista</u> para <u>Administrador</u>.', 'usuarios', '2018-01-12 13:43:17'),
(255, '00917251784', '016139', 'Alterou o perfil do(a) Asp Of Teste  do(a) CCIEx de <u>Gestor</u> para <u>Coordenador</u>.', 'usuarios', '2018-01-12 13:43:35'),
(256, '00917251784', '167086', 'Cadastrou o Aviso <u>teste</u>.', 'adm_avisos', '2018-01-15 15:27:18'),
(257, '00917251784', '167086', 'Habilitou o(a) Asp Of Teste  do(a) CCIEx com o perfil .', 'usuarios', '2018-01-15 16:03:27'),
(258, '00917251784', '167086', 'Habilitou o(a) 3º Sgt Siclano  do(a) 1º D Sup com o perfil .', 'usuarios', '2018-01-15 18:40:36'),
(259, '00917251784', '167086', 'Alterou o perfil do(a) Cap Paulino do(a) 1º D Sup de <u>Administrador</u> para <u>Gestor</u>.', '', '2018-01-16 16:57:25'),
(260, '00917251784', '167086', 'Habilitou o(a) 3º Sgt Siclano  do(a) 1º D Sup com o perfil Gestor.', 'usuarios', '2018-01-16 18:01:06'),
(261, '00917251784', '167086', 'Habilitou o(a) Cap Paulino do(a) 1ª ICFEx com o perfil Auditor/Analista.', 'usuarios', '2018-01-18 16:37:24'),
(262, '00917251784', '167086', 'Desabilitou o(a) Cap Paulino do(a) 1ª ICFEx.', 'usuarios', '2018-01-18 16:37:41'),
(263, '00917251784', '167086', 'Habilitou o(a) Cap Paulino do(a) 1ª ICFEx com o perfil Auditor/Analista.', 'usuarios', '2018-01-18 16:37:52'),
(264, '00917251784', '167086', 'Habilitou o(a) Cel Fulano1  do(a) CCIEx com o perfil Auditor/Analista.', 'usuarios', '2018-01-18 17:47:35'),
(265, '00917251784', '167086', 'Habilitou o(a) Asp Of Teste  do(a) CCIEx com o perfil Coordenador.', 'usuarios', '2018-01-18 18:53:44'),
(266, '00917251784', '167086', 'Habilitou o(a) Asp Of Teste  do(a) CCIEx com o perfil Coordenador.', 'usuarios', '2018-01-18 19:54:56'),
(267, '00917251784', '167086', 'Habilitou o(a) Cap Paulino do(a) 1ª ICFEx com o perfil Auditor/Analista.', 'usuarios', '2018-01-18 19:55:01'),
(268, '00917251784', '167086', 'Habilitou o(a) Asp Of Teste  do(a) CCIEx com o perfil Coordenador.', 'usuarios', '2018-01-19 11:59:16'),
(269, '17251784009', '062026', 'Habilitou o(a) Cel Fulano1  do(a) 2ª ICFEx com o perfil Administrador.', 'usuarios', '2018-01-22 18:02:16'),
(270, '17251784009', '062026', 'Habilitou o(a) 3º Sgt Siclano  do(a) Cmdo 12ª Bda Inf L (Amv) com o perfil Operador.', 'usuarios', '2018-01-22 18:03:49'),
(271, '17251784009', '062026', 'Cadastrou o Aviso <u>teste</u>.', 'adm_avisos', '2018-01-22 19:22:42'),
(272, '17251784009', '062026', 'Cadastrou o Aviso <u>teste2</u>.', 'adm_avisos', '2018-01-22 19:25:06'),
(273, '17251784009', '062026', 'Cadastrou o Aviso <u>teste</u>.', 'adm_avisos', '2018-01-22 19:26:25'),
(274, '17251784009', '016139', 'Cadastrou o Aviso <u>teste2</u>.', 'adm_avisos', '2018-01-22 19:27:50'),
(275, '17251784009', '016139', 'Cadastrou o Aviso <u>teste3</u>.', 'adm_avisos', '2018-01-22 19:31:19'),
(276, '17251784009', '016139', 'Cadastrou o Aviso <u>qqqq</u>.', 'adm_avisos', '2018-01-22 19:34:33'),
(277, '17251784009', '016139', 'Cadastrou o Aviso <u>eeee</u>.', 'adm_avisos', '2018-01-22 19:35:34'),
(278, '17251784009', '016139', 'Cadastrou o Aviso <u>aaaa</u>.', 'adm_avisos', '2018-01-22 19:38:51'),
(279, '17251784009', '016139', 'Cadastrou o Aviso <u>zzz</u>.', 'adm_avisos', '2018-01-22 19:39:27'),
(280, '17251784009', '016139', 'Cadastrou o Aviso <u>vfv</u>.', 'adm_avisos', '2018-01-22 19:42:00'),
(281, '17251784009', '016139', 'Cadastrou o Aviso <u>eee</u>.', 'adm_avisos', '2018-01-22 19:48:50'),
(282, '17251784009', '016139', 'Cadastrou o Aviso <u>ddded</u>.', 'adm_avisos', '2018-01-22 19:53:48'),
(283, '17251784009', '016139', 'Cadastrou o Aviso <u>ggfgfg</u>.', 'adm_avisos', '2018-01-23 15:10:59'),
(284, '17251784009', '016139', 'Cadastrou o Aviso <u>nbnbn</u>.', 'adm_avisos', '2018-01-23 15:33:02'),
(285, '17251784009', '016139', 'Cadastrou o Aviso <u>zx</u>.', 'adm_avisos', '2018-01-23 15:55:18'),
(286, '17251784009', '016139', 'Cadastrou o Aviso <u>frf</u>.', 'adm_avisos', '2018-01-23 16:49:09'),
(287, '17251784009', '016139', 'Habilitou o(a) 3º Sgt Siclano  do(a) Cmdo 12ª Bda Inf L (Amv) com o perfil Operador.', 'usuarios', '2018-01-23 18:52:46'),
(288, '17251784009', '016139', 'Habilitou o(a) Cel Fulano1  do(a) 2ª ICFEx com o perfil Administrador.', 'usuarios', '2018-01-23 18:53:07'),
(289, '17251784009', '016139', 'Habilitou o(a) 2º Sgt Fulano1 do(a) CCIEx com o perfil Administrador.', 'usuarios', '2018-01-23 19:25:09'),
(290, '17251784009', '016139', 'Habilitou o(a) 2º Sgt Fulano1 do(a) CCIEx com o perfil Administrador.', 'usuarios', '2018-01-25 18:33:16'),
(291, '17251784009', '016139', 'Habilitou o(a) 3º Sgt Siclano  do(a) Cmdo 12ª Bda Inf L (Amv) com o perfil Operador.', 'usuarios', '2018-01-25 18:40:21'),
(292, '17251784009', '016139', 'Habilitou o(a) Cel Fulano1  do(a) 2ª ICFEx com o perfil Administrador.', 'usuarios', '2018-01-25 18:40:39'),
(293, '17251784009', '016139', 'Habilitou o(a) 2º Sgt Fulano1 do(a) CCIEx com o perfil Administrador.', 'usuarios', '2018-01-25 18:40:53'),
(294, '17251784009', '016139', 'Alterou o perfil do(a) 2º Sgt Fulano1 do(a) CCIEx de <u>Administrador</u> para <u>Auditor/Analista</u>.', '', '2018-01-25 18:54:30'),
(295, '17251784009', '016139', 'Habilitou o(a) 2º Sgt Fulano do(a) CCIEx com o perfil Auditor/Analista.', 'usuarios', '2018-01-25 18:57:04'),
(296, '17251784009', '016139', 'Habilitou o(a) 2º Sgt Fulano do(a) CCIEx com o perfil Auditor/Analista.', 'usuarios', '2018-01-25 18:58:06'),
(297, '17251784009', '016139', 'Habilitou o(a) Cel Fulano1  do(a) 2ª ICFEx com o perfil Administrador.', 'usuarios', '2018-01-25 19:00:30'),
(298, '17251784009', '016139', 'Habilitou o(a) 3º Sgt Siclano  do(a) Cmdo 12ª Bda Inf L (Amv) com o perfil Operador.', 'usuarios', '2018-01-25 19:01:18'),
(299, '17251784009', '016139', 'Habilitou o(a) 2º Sgt Fulano do(a) CCIEx com o perfil Auditor/Analista.', 'usuarios', '2018-01-25 19:02:14'),
(300, '17251784009', '016139', 'Habilitou o(a) Cel Fulano1  do(a) 2ª ICFEx com o perfil Administrador.', 'usuarios', '2018-01-25 19:02:46'),
(301, '17251784009', '016139', 'Habilitou o(a) Cel Fulano1  do(a) 2ª ICFEx com o perfil Administrador.', 'usuarios', '2018-01-25 19:06:09'),
(302, '17251784009', '016139', 'Habilitou o(a) 3º Sgt Siclano  do(a) Cmdo 12ª Bda Inf L (Amv) com o perfil Operador.', 'usuarios', '2018-01-25 19:06:20'),
(303, '00917251784', '016139', 'Habilitou o(a) Maj Teste 3  do(a) 2ª ICFEx com o perfil Supervisor.', 'usuarios', '2018-02-01 15:46:08'),
(304, '00917251784', '016139', 'Redefiniu a senha do(a) Ten Cel Aguiar  do(a) 7ª ICFEx.', 'usuarios', '2018-02-01 16:37:21'),
(305, '00917251784', '016139', 'Habilitou o(a) Cel Teste 1  do(a) FEx com o perfil Gestor.', 'usuarios', '2018-02-01 17:42:34'),
(306, '00917251784', '016139', 'Redefiniu a senha do(a) Cel Teste 1  do(a) FEx.', 'usuarios', '2018-02-01 17:43:56'),
(307, '00917251784', '016139', 'Alterou o perfil do(a) Cel Pires  do(a) 7ª ICFEx de <u>Supervisor</u> para <u>Auditor/Analista</u>.', '', '2018-02-01 18:21:47'),
(308, '00917251784', '016139', 'Habilitou o(a) Maj Teste 3  do(a) 2ª ICFEx com o perfil Supervisor.', 'usuarios', '2018-02-01 18:22:00'),
(309, '00917251784', '016139', 'Habilitou o(a) Cap Genilson  do(a) CCIEx com o perfil Administrador.', 'usuarios', '2018-02-01 18:25:28');

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
  `avatar` varchar(255) NOT NULL DEFAULT 'default_avatar.jpg',
  `dt_cad` date NOT NULL,
  `id_posto` char(2) NOT NULL,
  `codom` char(6) NOT NULL,
  `id_perfil` int(11) NOT NULL COMMENT '1=Admin, 2=Aud, 3=Coord, 4=Gestor, 5=Oper, 6=Superv',
  `id_perfil_om` int(11) NOT NULL COMMENT '1=CCIEx 2=ICFEx 3=Unidade',
  `qtde_acessos` int(11) NOT NULL,
  `ultimo_acesso` datetime NOT NULL,
  `acesso_anterior` datetime NOT NULL,
  `status` varchar(200) NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_habilita` int(11) NOT NULL,
  `data_habilita` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cpf`, `rg`, `senha`, `nome_guerra`, `nome`, `email`, `ritex`, `celular`, `avatar`, `dt_cad`, `id_posto`, `codom`, `id_perfil`, `id_perfil_om`, `qtde_acessos`, `ultimo_acesso`, `acesso_anterior`, `status`, `data_cad`, `user_habilita`, `data_habilita`) VALUES
(33, '00917251784', '0623900644', 0x243261243038244d5449314e446b784d7a63774d5456684e7a42695a65574963514a7868484c697a713345697344562e4159594a7a6245557059434f, 'Paulino ', 'Marcelo de Faria Paulino ', 'mfpaulino@uol.com.br', '', '', '00917251784.jpg', '2017-10-31', '7', '016139', 1, 1, 57, '2018-02-01 17:54:57', '2018-02-01 17:53:19', 'Habilitado', '2017-10-31 14:11:44', 32, '2018-01-25 17:02:14'),
(40, '58468552534', '0622914646', 0x243261243038244d5451774d4451354f4463304d5456684e7a466d4d2e6b59666b617371754169375532336656554c31494f323573645061442f3747, 'Oliveira ', 'José Carlos de Oliveira ', 'jc.it2a1969@gmail.com', '8603572', '61981297554', 'default_avatar.jpg', '2018-01-31', '9', '016139', 1, 1, 5, '2018-01-31 14:59:10', '2018-01-31 14:30:07', 'Recebido', '2018-01-31 11:38:15', 33, '2018-01-31 11:58:20'),
(41, '81164432400', '0725077846', 0x243261243038244d544d314d5449304d7a49784d6a56684e7a466d4d65655a744e567868377435336c2e65496b6333784331717a6572762e4b785653, 'Genilson ', 'Genilson Xavier da Silva ', 'genilsonxs@yahoo.com.br33', '8602035', '61982041724', '81164432400.jpg', '2018-01-31', '7', '016139', 1, 1, 5, '2018-01-31 13:35:49', '2018-01-31 13:22:23', 'Habilitado', '2018-01-31 11:45:55', 33, '2018-02-01 16:25:28'),
(42, '11644324008', '0725077846', 0x243261243038244d7a51334d4463794d6a67344e5745334d5759334e65706f4269764733536744646f44776730477162416b4b334f356343326c466d, 'Ribamar ', 'José de Ribamar Sousa Pereira ', 'reeeibamar@yahoo.br', '8602035', '61982041724', 'default_avatar.jpg', '2018-01-31', '11', '062075', 2, 2, 1, '2018-01-31 12:06:53', '0000-00-00 00:00:00', 'Recebido', '2018-01-31 12:05:49', 44, '2018-01-31 13:23:23'),
(43, '64432400811', '0725077846', 0x243261243038244d5441314f5441324e6a59314e5745334d575a684e65656231483434724b2e763235744e674b42746149366a4b4547497731473453, 'Pires ', 'Ronaldo Pires de Andrade ', 'pieeeres@bol.br', '8602035', '61982041724', 'default_avatar.jpg', '2018-01-31', '4', '062075', 2, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Recebido', '2018-01-31 12:18:24', 44, '2018-01-31 13:23:39'),
(44, '16443240081', '0725077846', 0x243261243038244e7a637a4d5455314f5441324e5745334d7a51794e75366334644c624f63494a4c4e326d586b2f793657716a5948355a4563707379, 'Aguiar ', 'Ronaldo Pires Aguiar ', '333@xxx.xom', '8602035', '61982041724', 'default_avatar.jpg', '2018-01-31', '5', '062075', 6, 2, 7, '2018-02-01 15:42:07', '2018-02-01 14:40:33', 'Recebido', '2018-01-31 12:29:53', 41, '2018-01-31 13:17:18'),
(45, '00811644324', '0725077846', 0x243261243038244e7a67354e544d794e7a59794e5745334d575a6d594f632e324649652f324f354a6d446969774d64364f435075394b73434c344a4b, 'Gabe ', 'Leonardo Gabe ', 'faox@gu.com', '8602035', '61982041724', 'default_avatar.jpg', '2018-01-31', '6', '062075', 3, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Recebido', '2018-01-31 12:40:53', 44, '2018-01-31 13:23:29'),
(46, '44324008116', '44324008116', 0x243261243038244e6a517a4d5451784d4441344e5745334d6a41774f4f6144656e6f75494e726a6b425931614d764f69456776386e475274582f5075, 'Robério ', 'Robério Dantas ', 'rodberio@gu.com', '8602035', '61982041724', 'default_avatar.jpg', '2018-01-31', '7', '062075', 1, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Recebido', '2018-01-31 12:44:52', 44, '2018-01-31 13:23:34'),
(47, '84685525345', '123', 0x243261243038244e5449784e7a49344d4467344e5745334d7a55794d2e6e4e6a3238746c614c47685578376939453441364254534e7a2e2e50616e6d, 'Teste 1 ', 'Teste 1 ', 'tenoleeiveira@cciex.eb.mil.br', '8883096', '61999999999', 'default_avatar.jpg', '2018-01-31', '4', '167086', 4, 3, 3, '2018-02-01 16:05:32', '2018-02-01 15:58:39', 'Recebido', '2018-01-31 14:24:31', 33, '2018-02-01 15:42:34'),
(48, '46855253458', '123', 0x243261243038244d7a6b324f4459324e7a4131595463794d54686b4e7533674a4f362e7a6367772e6a2f2e63397862726d70424e325155647a4a6147, 'Teste 2 ', 'Teste 2 ', 'TEeeSTE@GMAIL.COM', '', '', 'default_avatar.jpg', '2018-01-31', '5', '045872', 4, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Recebido', '2018-01-31 14:28:23', 0, '0000-00-00 00:00:00'),
(49, '68552534584', '123', 0x243261243038244d5449334d7a637a4e4467794d7a56684e7a4978594f4d2f496e5566427634774f56556864424133306e5868387767796c7a4c6169, 'Teste 3 ', 'Teste 3 ', 'TEddSTE3@GMAIL.COM', '', '', 'default_avatar.jpg', '2018-01-31', '6', '062026', 6, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Habilitado', '2018-01-31 14:35:48', 33, '2018-02-01 16:22:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_habilitacao`
--

CREATE TABLE IF NOT EXISTS `usuarios_habilitacao` (
`id_habilitacao` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `carga_horaria` varchar(255) NOT NULL,
  `ano_conclusao` varchar(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuarios_habilitacao`
--

INSERT INTO `usuarios_habilitacao` (`id_habilitacao`, `cpf`, `id_area`, `tipo`, `descricao`, `carga_horaria`, `ano_conclusao`) VALUES
(8, '17251784009', 10, 'Experiência', '1234', '---', '---'),
(10, '17251784009', 11, 'Experiência', 'rere', '---', '---'),
(11, '17251784009', 10, 'Experiência', 'wedwewedwe', '---', '---'),
(12, '17251784009', 10, 'Experiência', 'xsqsdwswsw', '---', '---'),
(13, '17251784009', 7, 'Curso', 'wwdwdqqq', '40h', '2000'),
(14, '17251784009', 10, 'Curso', 'e23r23e23r23r23r', '310h', '1999');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `adm_areas`
--
ALTER TABLE `adm_areas`
 ADD PRIMARY KEY (`id_area`), ADD UNIQUE KEY `area` (`area`);

--
-- Índices de tabela `adm_avisos`
--
ALTER TABLE `adm_avisos`
 ADD PRIMARY KEY (`id_aviso`), ADD UNIQUE KEY `titulo` (`titulo`,`status`);

--
-- Índices de tabela `adm_categorias`
--
ALTER TABLE `adm_categorias`
 ADD PRIMARY KEY (`id_categoria`), ADD UNIQUE KEY `descricao` (`categoria`), ADD UNIQUE KEY `localidades` (`localidades`);

--
-- Índices de tabela `adm_diarias`
--
ALTER TABLE `adm_diarias`
 ADD PRIMARY KEY (`id_diaria`), ADD UNIQUE KEY `posto_local` (`id_posto`,`id_categoria`);

--
-- Índices de tabela `adm_fontes_informacao`
--
ALTER TABLE `adm_fontes_informacao`
 ADD PRIMARY KEY (`id_fonte_info`), ADD UNIQUE KEY `fonte_info` (`fonte_info`);

--
-- Índices de tabela `adm_info_requeridas`
--
ALTER TABLE `adm_info_requeridas`
 ADD PRIMARY KEY (`id_info_req`), ADD UNIQUE KEY `info_req` (`info_req`);

--
-- Índices de tabela `adm_perfis`
--
ALTER TABLE `adm_perfis`
 ADD PRIMARY KEY (`id_perfil`);

--
-- Índices de tabela `adm_perfis_administra`
--
ALTER TABLE `adm_perfis_administra`
 ADD PRIMARY KEY (`id_perfil_admin`), ADD UNIQUE KEY `identificador` (`id_perfil_om`,`id_perfil`);

--
-- Índices de tabela `adm_perfis_unidade`
--
ALTER TABLE `adm_perfis_unidade`
 ADD PRIMARY KEY (`id_perfil_om`), ADD UNIQUE KEY `unidade` (`unidade`);

--
-- Índices de tabela `adm_permissoes`
--
ALTER TABLE `adm_permissoes`
 ADD PRIMARY KEY (`id_permissao`), ADD UNIQUE KEY `permissao` (`permissao`);

--
-- Índices de tabela `adm_poss_achados`
--
ALTER TABLE `adm_poss_achados`
 ADD PRIMARY KEY (`id_poss_achado`), ADD UNIQUE KEY `poss_achado` (`poss_achado`);

--
-- Índices de tabela `adm_proc_analise`
--
ALTER TABLE `adm_proc_analise`
 ADD PRIMARY KEY (`id_proc_ana`), ADD UNIQUE KEY `proc_ana` (`proc_ana`);

--
-- Índices de tabela `adm_proc_coleta`
--
ALTER TABLE `adm_proc_coleta`
 ADD PRIMARY KEY (`id_proc_coleta`), ADD UNIQUE KEY `proc_ana` (`proc_coleta`);

--
-- Índices de tabela `adm_questoes`
--
ALTER TABLE `adm_questoes`
 ADD PRIMARY KEY (`id_questao`), ADD UNIQUE KEY `questao` (`questao`);

--
-- Índices de tabela `adm_subareas`
--
ALTER TABLE `adm_subareas`
 ADD PRIMARY KEY (`id_subarea`), ADD UNIQUE KEY `subarea` (`subarea`);

--
-- Índices de tabela `adm_sugestoes`
--
ALTER TABLE `adm_sugestoes`
 ADD PRIMARY KEY (`id_sugestao`), ADD UNIQUE KEY `sugestao` (`sugestao`,`tabela`);

--
-- Índices de tabela `adm_tipo_evento`
--
ALTER TABLE `adm_tipo_evento`
 ADD PRIMARY KEY (`id_tipo_evento`), ADD UNIQUE KEY `fonte_info` (`tipo_evento`);

--
-- Índices de tabela `correio_enviados`
--
ALTER TABLE `correio_enviados`
 ADD PRIMARY KEY (`id_correio`);

--
-- Índices de tabela `correio_recebidos`
--
ALTER TABLE `correio_recebidos`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `identifica` (`id_correio`,`destinatario`) COMMENT 'id_correio + CPF';

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
 ADD PRIMARY KEY (`id_log`);

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
-- Índices de tabela `usuarios_habilitacao`
--
ALTER TABLE `usuarios_habilitacao`
 ADD PRIMARY KEY (`id_habilitacao`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `adm_areas`
--
ALTER TABLE `adm_areas`
MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `adm_avisos`
--
ALTER TABLE `adm_avisos`
MODIFY `id_aviso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de tabela `adm_categorias`
--
ALTER TABLE `adm_categorias`
MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de tabela `adm_diarias`
--
ALTER TABLE `adm_diarias`
MODIFY `id_diaria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de tabela `adm_fontes_informacao`
--
ALTER TABLE `adm_fontes_informacao`
MODIFY `id_fonte_info` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `adm_info_requeridas`
--
ALTER TABLE `adm_info_requeridas`
MODIFY `id_info_req` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `adm_perfis`
--
ALTER TABLE `adm_perfis`
MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `adm_perfis_administra`
--
ALTER TABLE `adm_perfis_administra`
MODIFY `id_perfil_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `adm_perfis_unidade`
--
ALTER TABLE `adm_perfis_unidade`
MODIFY `id_perfil_om` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `adm_permissoes`
--
ALTER TABLE `adm_permissoes`
MODIFY `id_permissao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de tabela `adm_poss_achados`
--
ALTER TABLE `adm_poss_achados`
MODIFY `id_poss_achado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `adm_proc_analise`
--
ALTER TABLE `adm_proc_analise`
MODIFY `id_proc_ana` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `adm_proc_coleta`
--
ALTER TABLE `adm_proc_coleta`
MODIFY `id_proc_coleta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `adm_questoes`
--
ALTER TABLE `adm_questoes`
MODIFY `id_questao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `adm_subareas`
--
ALTER TABLE `adm_subareas`
MODIFY `id_subarea` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de tabela `adm_sugestoes`
--
ALTER TABLE `adm_sugestoes`
MODIFY `id_sugestao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `adm_tipo_evento`
--
ALTER TABLE `adm_tipo_evento`
MODIFY `id_tipo_evento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `correio_enviados`
--
ALTER TABLE `correio_enviados`
MODIFY `id_correio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT de tabela `correio_recebidos`
--
ALTER TABLE `correio_recebidos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=310;
--
-- AUTO_INCREMENT de tabela `postos`
--
ALTER TABLE `postos`
MODIFY `id_posto` tinyint(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de tabela `usuarios_habilitacao`
--
ALTER TABLE `usuarios_habilitacao`
MODIFY `id_habilitacao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
