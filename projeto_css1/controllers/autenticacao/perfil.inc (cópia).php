<?php
session_start();

$cpf = $_SESSION['cpf'];
$ultimoAcesso = $_SESSION['ultimoAcesso'];

/* consultando os dados do usuario */
$sql = "SELECT id_usuario, rg, nome_guerra, nome, email, ritex, celular, avatar, dt_cad, usuarios.id_posto, p.posto, codom, usuarios.id_perfil, pe.perfil, usuarios.id_perfil_om, pu.unidade as perfil_om, ultimo_acesso, acesso_anterior, status, user_habilita, data_habilita from usuarios, postos p, adm_perfis pe, adm_perfis_unidade pu where cpf = '$cpf' and usuarios.id_posto = p.id_posto and usuarios.id_perfil = pe.id_perfil and usuarios.id_perfil_om = pu.id_perfil_om";
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
$id_perfil_usuario = $row['id_perfil'];
$perfil_usuario = $row['perfil'];
$id_perfil_om = $row['id_perfil_om'];
$perfil_om = $row['perfil_om'];
$status_usuario = $row['status'];
$avatar_usuario = $row['avatar'];
$dt_cad_usuario = date('d/m/Y', strtotime($row['dt_cad']));
$ultimo_acesso_usuario = date('d/m/Y H:i:s', strtotime($row['ultimo_acesso']));
$acesso_anterior_usuario = date('d/m/Y H:i:s', strtotime($row['acesso_anterior']));

/*** responsavel pela habilitação ***/
$user_habilita = $row['user_habilita'];
$sql = "SELECT p.posto, u.nome_guerra, u.codom FROM postos p, usuarios u WHERE u.id_usuario = '$user_habilita' and p.id_posto = u.id_posto";
$con_habilita = $mysqli->query($sql);
$row_habilita = $con_habilita->fetch_assoc();

$codom_habilita = $row_habilita['codom'];
$sql = "SELECT sigla FROM cciex_om WHERE codom = '$codom_habilita'";
$con_om = $mysqli1->query($sql);
$row_om = $con_om->fetch_assoc();

$user_habilita_usuario = $row_habilita['posto'] . ' ' . $row_habilita['nome_guerra']. ' ('.$row_om['sigla'].')';
$data_habilita_usuario = date('d/m/Y H:i:s', strtotime($row['data_habilita']));

/*** usado no menu esquerdo **/
$usuario = $posto_usuario . " " . $nome_guerra_usuario;
if(strlen($usuario) > 19){
	$usuario = substr($usuario, 0, 19)."...";
}
/*** perfil admin - quais usuarios o usuario atual pode administrar ***/
$sql = "SELECT id_perfil_admin, lista_perfis FROM adm_perfis_administra WHERE id_perfil = '$id_perfil_usuario' AND id_perfil_om = '$id_perfil_om'";
$con_admin = $mysqli->query($sql);
$rows_admin = $con_admin->fetch_assoc();

if($rows_admin['lista_perfis'] <> ""){
	$lista = unserialize($rows_admin['lista_perfis']);
	$lista  = implode(',',$lista);//separa os valores do array com uma virgula
	$lista  = "'".$lista."'";//coloca um ' no inicio e fim da string
	$lista_perfis_admin = str_replace(",","','",$lista);//substitui a virgula por "','".
}
else {
	$lista_perfis_admin = "";
}
$id_perfil_admin = $rows_admin['id_perfil_admin'];

/******** cria a lista de permissoes do usuário **************************************/
	$con_permissao = $mysqli->query("SELECT permissao FROM adm_permissoes WHERE lista_perfis like '%:\"$id_perfil_admin\";%'");

	while($row_permissao = $con_permissao->fetch_array()){
		$lista_permissoes = $lista_permissoes . $row_permissao[0] . ","; //cria uma string com os id_permissao separados por ",".
	}
	$lista_permissoes = substr($lista_permissoes, 0, -1); //elimino a ultima "," da string.
	$lista_permissoes = explode(",", $lista_permissoes); //crio o array

/*********** dados OM do usuario ***********************/
$sql = "select sigla, denominacao, icfex from cciex_om where codom = '$codom_usuario'";
$con_om = $mysqli1->query($sql);

$row = $con_om->fetch_assoc();

$sigla_usuario = $row['sigla'];
$denominacao_usuario = $row['denominacao'];

switch ($row['sigla']) {
    case 'CCIEx':
		$nr_ci = 0;//nr icfex da tabela de om, no caso da om ser o CCIEx ou alguma ICFEx
        break;
    case '1ª ICFEx':
		$nr_ci = 1;
        break;
    case '2ª ICFEx':
		$nr_ci= 2;
        break;
    case '3ª ICFEx':
		$nr_ci = 3;
        break;
    case '4ª ICFEx':
		$nr_ci = 4;
        break;
    case '5ª ICFEx':
		$nr_ci = 5;
        break;
    case '6ª ICFEx':
		$nr_ci = 6;
        break;
    case '7ª ICFEx':
		$nr_ci = 7;
        break;
    case '8ª ICFEx':
		$nr_ci = 8;
        break;
    case '9ª ICFEx':
		$nr_ci = 9;
        break;
    case '10ª ICFEx':
		$nr_ci = 10;
        break;
    case '11ª ICFEx':
		$nr_ci = 11;
        break;
    case '12ª ICFEx':
		$nr_ci = 12;
        break;
   default:
		$nr_ci = '';
		break;
}

/************************** lista os codom se o usuario logado for do CCIEx ou ICFEx *********************************/
$sql_codom = "SELECT codom FROM cciex_om WHERE icfex = $nr_ci";
$con_codom = $mysqli1->query($sql_codom);

if($con_codom){
	while($row_codom = $con_codom->fetch_assoc()){
		$lista_codom = $lista_codom . $row_codom['codom'] . ',';
	}
	$lista_codom = substr($lista_codom, 0, -1);//elimina a ultima ",".
}
/**************************** criterio para selecioar apenas os codom que o usuario tem permissao de enxergar **************/
if($id_perfil_om == 3){//Unidade
	$condicao_codom = " AND codom = $codom_usuario";
}
else if($id_perfil_om == 2){//ICFEx
	$condicao_codom = "AND (codom = $codom_usuario or codom in ($lista_codom))";
}
else if($id_perfil_om == 1){//CCIEx
	$condicao_codom = "";
}
?>
