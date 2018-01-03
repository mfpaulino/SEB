-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 03/01/2018 às 14:41
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_areas`
--

INSERT INTO `adm_areas` (`id_area`, `area`, `id_subarea_vinc`) VALUES
(7, 'Área 7', 'a:4:{i:0;s:2:"13";i:1;s:2:"11";i:2;s:2:"17";i:3;s:2:"15";}'),
(8, 'Área 8', 'a:2:{i:1;s:2:"16";i:2;s:2:"13";}'),
(9, 'Área 9', ''),
(10, 'Área 10', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_avisos`
--

INSERT INTO `adm_avisos` (`id_aviso`, `titulo`, `texto`, `autor`, `dt_aviso`, `dt_validade`, `publico`, `status`) VALUES
(9, '3', 'wewe\r\nwew\r\new\r\new\r\ne\r\nwew', '17251784009', '2017-12-27 19:08:28', '2018-01-06', 'a:2:{i:0;s:5:"CCIEx";i:1;s:7:"Unidade";}', 'Ativo'),
(10, '21', '22 \r\neeee\r\neeee', '17251784009', '2018-01-03 16:34:49', '2018-01-13', 'a:2:{i:0;s:5:"CCIEx";i:1;s:5:"ICFEx";}', 'Ativo'),
(13, 'Informações sobre cadastrametno de diárias.', 'Tendo em vista os mais diretos acontecimentos sobre isso ou aquilo.\r\nTemos que vdaao assim, ou mias.', '17251784009', '2018-01-03 14:57:37', '2017-12-30', 'a:3:{i:0;s:5:"CCIEx";i:1;s:5:"ICFEx";i:2;s:7:"Unidade";}', 'Inativo'),
(16, '1221', '1221&lt;br /&gt;\\r\\nddfddf&lt;br /&gt;\\r\\ndfd&lt;br /&gt;\\r\\nfd&lt;br /&gt;\\r\\nfd&lt;br /&gt;\\r\\nfd', '17251784009', '2018-01-03 14:57:37', '2017-12-30', 'a:2:{i:0;s:5:"CCIEx";i:1;s:5:"ICFEx";}', 'Inativo'),
(17, 'Título do Aviso.', 'jo’; DROP\r\n TABLE autores ; —', '17251784009', '2018-01-03 16:34:56', '2018-01-13', 'a:1:{i:0;s:5:"CCIEx";}', 'Ativo'),
(18, 'Alteração no PAAA', 'Foi alterado o PAAA/2017.\r\nHaverá um corte de 10% do planejado.', '17251784009', '2018-01-03 16:33:17', '2018-01-06', 'a:1:{i:0;s:5:"CCIEx";}', 'Ativo');

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
  `descricao` varchar(255) NOT NULL,
  `permissoes` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_perfis`
--

INSERT INTO `adm_perfis` (`id_perfil`, `perfil`, `descricao`, `permissoes`) VALUES
(1, 'Administrador', '(Responsável pelo Sistema na Unidade)', ''),
(2, 'Auditor/Analista', '(Integrante Seção de Auditoria)', ''),
(3, 'Coordenador', '(Ch Seção de Auditoria)', ''),
(4, 'Gerente', '(Integrantes da SPE)', ''),
(5, 'Gestor', '(Cmt/Ch/Dir/OD)', ''),
(6, 'Operador', '(Militar/Servidor Civil Designado pelo Gestor)', ''),
(7, 'Supervisor', '(Ch CCIEX, Ch ICFEx)', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm_perfis_unidade`
--

CREATE TABLE IF NOT EXISTS `adm_perfis_unidade` (
`id` int(11) NOT NULL,
  `unidade` varchar(255) NOT NULL,
  `perfis` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_perfis_unidade`
--

INSERT INTO `adm_perfis_unidade` (`id`, `unidade`, `perfis`) VALUES
(1, 'cciex', 'a:5:{i:0;s:13:"Administrador";i:1;s:16:"Auditor/Analista";i:2;s:11:"Coordenador";i:3;s:7:"Gerente";i:4;s:10:"Supervisor";}'),
(2, 'icfex', 'a:4:{i:0;s:13:"Administrador";i:1;s:16:"Auditor/Analista";i:2;s:11:"Coordenador";i:3;s:10:"Supervisor";}'),
(3, 'unidades', 'a:3:{i:0;s:13:"Administrador";i:1;s:6:"Gestor";i:2;s:8:"Operador";}');

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
(3, 'Questão 3', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"2";}', 'a:1:{i:0;s:1:"1";}'),
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
-- Estrutura para tabela `adm_subareas_bck`
--

CREATE TABLE IF NOT EXISTS `adm_subareas_bck` (
`id_subarea` int(11) NOT NULL,
  `subarea` varchar(255) NOT NULL,
  `id_area` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adm_subareas_bck`
--

INSERT INTO `adm_subareas_bck` (`id_subarea`, `subarea`, `id_area`) VALUES
(10, '2r2323r2recdccd', 7),
(13, 'dgfgfgfgfgfgf', 8),
(12, 'dsdsds', 8),
(11, 'rr3r23r23r23rv', 7),
(14, 'sdsdsdsdsds', 8),
(15, 'Subárea1', 9),
(16, 'Subárea1', 10);

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
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

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
(99, '33;', 'teste', '<p><b><i><u>sssdsas</u></i></b><br></p><br><br><br>', '17251784009', '2017-12-04 13:15:55', 'nao');

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
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `correio_recebidos`
--

INSERT INTO `correio_recebidos` (`id`, `id_correio`, `destinatario`, `lida`, `pasta`) VALUES
(103, 84, '23', 'sim', 'ja_lidos'),
(104, 84, '32', 'sim', 'entrada'),
(105, 85, '9', 'nao', 'entrada'),
(106, 86, '9', 'sim', 'entrada'),
(107, 87, '34', 'nao', 'entrada'),
(108, 87, '23', 'sim', 'entrada'),
(109, 88, '32', 'sim', 'entrada'),
(110, 89, '9', 'sim', 'entrada'),
(111, 89, '1', 'nao', 'entrada'),
(112, 90, '9', 'sim', 'entrada'),
(113, 90, '32', 'sim', 'entrada'),
(114, 90, '34', 'nao', 'entrada'),
(115, 90, '1', 'sim', 'entrada'),
(116, 91, '9', 'nao', 'entrada'),
(117, 91, '32', 'nao', 'entrada'),
(118, 91, '34', 'nao', 'entrada'),
(119, 92, '23', 'nao', 'entrada'),
(120, 93, '9', 'nao', 'entrada'),
(121, 94, '9', 'nao', 'entrada'),
(122, 94, '1', 'nao', 'entrada'),
(123, 95, '34', 'nao', 'entrada'),
(124, 96, '32', 'nao', 'entrada'),
(125, 97, '9', 'nao', 'entrada'),
(126, 97, '34', 'nao', 'entrada'),
(127, 98, '9', 'nao', 'entrada'),
(128, 98, '1', 'nao', 'entrada'),
(129, 99, '33', 'nao', 'entrada');

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
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;

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
(193, '17251784009', '005801', 'Alterou o Tipo de Evento "<u>testete</u>" para <u>testete ededed</u>.', 'adm_tipo_evento', '2017-12-27 18:42:14');

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
  `id_perfil` int(11) NOT NULL,
  `qtde_acessos` int(11) NOT NULL,
  `ultimo_acesso` datetime NOT NULL,
  `acesso_anterior` datetime NOT NULL,
  `status` varchar(200) NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_habilita` int(11) NOT NULL,
  `data_habilita` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cpf`, `rg`, `senha`, `nome_guerra`, `nome`, `email`, `ritex`, `celular`, `avatar`, `dt_cad`, `id_posto`, `codom`, `id_perfil`, `qtde_acessos`, `ultimo_acesso`, `acesso_anterior`, `status`, `data_cad`, `user_habilita`, `data_habilita`) VALUES
(32, '17251784009', '111144', 0x243261243038244d5449304d6a45774d7a49304d7a55355a47526d5a65794b48487530625435476a2f49524b6930424b2f51385a4d4e5570616d434b, 'Paulino', 'Marcelo Paulino ', 'mfpaurlino@uol.com.br', '', '', '17251784009.jpg', '0000-00-00', '7', '016139', 1, 241, '2018-01-03 14:30:56', '2018-01-03 13:52:19', 'Habilitado', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(33, '00917251784', '1111', 0x243261243038244d5441784e6a55794e7a67784e5455355a6a68684d2e6f474836343976656d5732446f46307a3867312e374341644234584a632f71, 'Fulano ', 'Fulano de Tal', 'aaa@uol.com.br', '', '', 'default_avatar.jpg', '2017-10-31', '13', '168001', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Habilitado', '2017-10-31 14:11:44', 33, '2017-10-31 14:13:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_habilitacao`
--

CREATE TABLE IF NOT EXISTS `usuarios_habilitacao` (
`id_habilitacao` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `descricao` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Índices de tabela `adm_perfis_unidade`
--
ALTER TABLE `adm_perfis_unidade`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unidade` (`unidade`);

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
-- Índices de tabela `adm_subareas_bck`
--
ALTER TABLE `adm_subareas_bck`
 ADD PRIMARY KEY (`id_subarea`), ADD UNIQUE KEY `area` (`subarea`,`id_area`);

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
MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `adm_avisos`
--
ALTER TABLE `adm_avisos`
MODIFY `id_aviso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
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
MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `adm_perfis_unidade`
--
ALTER TABLE `adm_perfis_unidade`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
-- AUTO_INCREMENT de tabela `adm_subareas_bck`
--
ALTER TABLE `adm_subareas_bck`
MODIFY `id_subarea` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
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
MODIFY `id_correio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT de tabela `correio_recebidos`
--
ALTER TABLE `correio_recebidos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT de tabela `postos`
--
ALTER TABLE `postos`
MODIFY `id_posto` tinyint(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de tabela `usuarios_habilitacao`
--
ALTER TABLE `usuarios_habilitacao`
MODIFY `id_habilitacao` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
