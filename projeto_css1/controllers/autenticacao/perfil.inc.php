<?php
session_start();

$cpf = $_SESSION['cpf'];
$ultimoAcesso = $_SESSION['ultimoAcesso'];

/* consultando os dados do usuario */
$sql = "SELECT rg, nome_guerra, nome, email, ritex, celular, avatar, usuarios.id_posto, p.posto, codom, usuarios.id_perfil, pe.perfil, ultimo_acesso, status from usuarios, postos p, perfis pe where cpf = '$cpf' and usuarios.id_posto = p.id_posto and usuarios.id_perfil = pe.id_perfil";
$con_dados = $mysqli->query($sql);
$row = $con_dados->fetch_assoc();

$rg_usuario = $row['rg'];
$id_posto_usuario = $row['id_posto'];
$posto_usuario = $row['posto'];
$nome_guerra_usuario  = $row['nome_guerra'];
$nome_usuario  = $row['nome'];
$ritex_usuario = $row['ritex'];
$celular_usuario = $row['celular'];
$email_usuario = $row['email'];
$codom_usuario = $row['codom'];
$id_perfil_usuario = $row['id_perfil'];
$perfil_usuario = $row['perfil'];
$status_usuario = $row['status'];
$avatar_usuario = $row['avatar'];

$sql = "select sigla, denominacao from cciex_om where codom = '$codom_usuario'";
$con_om = $mysqli1->query($sql);

$row = $con_om->fetch_assoc();

$sigla_usuario = $row['sigla'];
$denominacao_usuario = $row['denominacao'];
/**********************************/
?>
