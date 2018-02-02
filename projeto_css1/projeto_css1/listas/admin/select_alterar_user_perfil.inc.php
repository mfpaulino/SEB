<?php
//select_alterar_user_perfil.inc.php
include_once ('../../componentes/internos/php/conexao.inc.php');

$user_sigla = $_POST['user_sigla'];//vem do adm/user.js
$user_id_perfil = $_POST['user_id_perfil'];//vem do adm/user.js
$user_perfil = $_POST['user_perfil'];//vem do adm/user.js

$unidade = substr($user_sigla, -5);//pega os 5 ultimos caracteres da sigla
$unidade = ($unidade == 'CCIEx' or $unidade == 'ICFEx') ? $unidade : 'Unidade';

$sql_user_perfis = "SELECT perfis FROM adm_perfis_unidade WHERE unidade = '$unidade'";
$con_user_perfis = $mysqli->query($sql_user_perfis);//verifica os perfis possiveis para a unidade do usuario

$row_user_perfis = $con_user_perfis->fetch_assoc();
$user_perfis = unserialize($row_user_perfis['perfis']);

$user_perfis  = implode(',',$user_perfis);//separa os valores do array com uma virgula
$user_perfis  = "'".$user_perfis."'";//coloca um ' no inicio e fim da string
$user_perfis = str_replace(",","','",$user_perfis);//substitui a virgula por "','".

$sql_user_perfil = "SELECT * FROM adm_perfis WHERE perfil in (".$user_perfis.") ORDER BY perfil";
$con_user_perfil= $mysqli->query($sql_user_perfil);//cria a lista de perfis para o usuario
$num_rows_user_perfil = $con_user_perfil->num_rows;


$pos = strpos($user_perfis, $user_perfil);//verifica se o perfil atual do usuario é válido para sua unidade atual(ele pode ter trocado de unidade)
if ($pos === false){
	$var = " (ESCOLHA OUTRO PERFIL)";
}
?>
<select class="form-control" name="perfil" id="perfil">
	<option value="<?php echo $user_id_perfil;?>"><?php echo $user_perfil.$var;?></option>
	<?php

	if($num_rows_user_perfil == 0){
	}
	else {
		while($rows_user_perfil = $con_user_perfil->fetch_assoc()){
			echo '<option value="' . $rows_user_perfil['id_perfil'] .'">' . $rows_user_perfil['perfil'] . ' - '. $rows_user_perfil['descricao'] .'</option>';
		}
	}
	?>
</select>