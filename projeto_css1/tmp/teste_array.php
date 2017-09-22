<?php
include('../componentes/internos/php/conexao.inc.php');
// ''Administrador', 'Auditor/Analista', 'Coordenador', 'Gerente', 'Gestor', 'Operador', 'Supervisor'
$permissao = serialize(array('Administrador', 'Auditor/Analista', 'Coordenador', 'Gerente', 'Supervisor'));

$sql = "insert into perfis_unidade (unidade, perfis) values ('cciex','$permissao')";

$con = $mysqli->query($sql);
$mysqli->close
?>