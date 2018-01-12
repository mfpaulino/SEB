<?php
session_start();

$cpf = $_SESSION['cpf'];
$ultimoAcesso = $_SESSION['ultimoAcesso'];

/* consultando os dados do usuario */
$sql = "SELECT id_usuario, rg, nome_guerra, nome, email, ritex, celular, avatar, dt_cad, usuarios.id_posto, p.posto, codom, perfil, perfil_om, ultimo_acesso, acesso_anterior, status from usuarios, postos p where cpf = '$cpf' and usuarios.id_posto = p.id_posto";
$con_dados = $mysqli->query($sql);
$row = $con_dados->fetch_assoc();

$id_usuario = $row['id_usuario'];
$rg_usuario = $row['rg'];
$id_posto_usuario = $row['id_posto'];
$posto_usuario = $row['posto'];
$nome_guerra_usuario  = $row['nome_guerra'];
$nome_usuario  = $row['nome'];
$ritex_usuario = $row['ritex'];
$celular_usuario = $row['celular'];
$email_usuario = $row['email'];
$codom_usuario = $row['codom'];
$perfil_usuario = $row['perfil'];
$perfil_om = $row['perfil_om'];
$status_usuario = $row['status'];
$avatar_usuario = $row['avatar'];
$dt_cad_usuario = date('d/m/Y', strtotime($row['dt_cad']));
$ultimo_acesso_usuario = date('d/m/Y H:i:s', strtotime($row['ultimo_acesso']));
$acesso_anterior_usuario = date('d/m/Y H:i:s', strtotime($row['acesso_anterior']));

/*** usado no menu esquerdo **/
$usuario = $posto_usuario . " " . $nome_guerra_usuario;
if(strlen($usuario) > 19){
	$usuario = substr($usuario, 0, 19)."...";
}
/*** fim ***/

$sql = "select sigla, denominacao from cciex_om where codom = '$codom_usuario'";
$con_om = $mysqli1->query($sql);

$row = $con_om->fetch_assoc();

$sigla_usuario = $row['sigla'];
$denominacao_usuario = $row['denominacao'];
?>
