<?php
/**************************************************************
* Local/nome do script: admin/permissao/permissoes_administra1.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$altera = "";
	$id_perfil = $_POST['id_perfil'];

	/******** montando o array com as permissoes do perfil selecionado **************************************/

	$con_permissao = $mysqli->query("SELECT id_permissao FROM adm_permissoes WHERE lista_perfis like '%:\"$id_perfil\";%'");

	while($row_permissao = $con_permissao->fetch_array()){
		$lista_permissao_atual = $lista_permissao_atual . $row_permissao[0] . ","; //cria uma string com os id_permissao separados por ",".
	}
	$lista_permissao_atual = substr($lista_permissao_atual, 0, -1); //elimino a ultima "," da string.
	$lista_permissao_atual = explode(",", $lista_permissao_atual); //crio o array

	/******* montando o array com as permissoes selecionadas para vinculação ***************************/

	$con_qtde_permissao = $mysqli->query("SELECT id_permissao FROM adm_permissoes");
	$qtde_permissao = $con_qtde_permissao->num_rows;

	for($i = 1; $i <= $qtde_permissao; $i++){
		if($_POST[$i] <> ""){
			$lista_permissao_nova = $lista_permissao_nova.$_POST[$i].","; //cria uma string com os id_permissao separados por ",".
		}
	}
	$lista_permissao_nova = substr($lista_permissao_nova, 0, -1); //elimino a ultima "," da string.
	$lista_permissao_nova = explode(",", $lista_permissao_nova); //crio o array

	if($id_perfil == 1){
		$lista_permissao_nova = $lista_permissao_atual; //impede que sejam feitas alterações para o perfil CCIEx-Administrador
	}

	/********* verifico se os arrays são diferentes criando listas com as diferenças *************************/

	$lista_permissoes_sim = array_diff($lista_permissao_nova, $lista_permissao_atual); //lista as permissoes incluidas com os indices originais Ex (1=>'2', 3=>'6')
	$lista_permissoes_sim1  = array(); //cria novos indices para a lista (0=>'2', 1=>'6')
	foreach($lista_permissoes_sim  as $r){
		$lista_permissoes_sim1[] = $r;
	}

	$lista_permissoes_nao = array_diff($lista_permissao_atual, $lista_permissao_nova); // lista as permissoes excluidas
	$lista_permissoes_nao1  = array();
	foreach($lista_permissoes_nao  as $r){
		$lista_permissoes_nao1[] = $r;
	}

	$qtde_sim = count($lista_permissoes_sim1); //conta os check marcados
	$qtde_nao = count($lista_permissoes_nao1); //conta os checks desmarcados

	/********************************* fim ***************************************************************/

	for($i = 0; $i < $qtde_sim; $i++){
		//busca os perfis vinculados para cada permissao marcada com sim
		$con_id_perfil_atual = $mysqli->query("SELECT lista_perfis FROM adm_permissoes WHERE id_permissao = '$lista_permissoes_sim1[$i]' AND lista_perfis <> ''");

		if($con_id_perfil_atual->num_rows <> 0){//se já houver algum perfil vinculado:

			$row_perfil_atual = $con_id_perfil_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_permissoes, campo lista_perfis

			$lista_perfil_atual = unserialize($row_perfil_atual[0]); // transforma a string num array

			array_push($lista_perfil_atual, $id_perfil); //insere nesse array o id do perfil

			$lista_perfil_nova = serialize($lista_perfil_atual); //transforma novamente em string para salvar no banco
		}
		else{
			$lista_perfil_nova = serialize(array($id_perfil)); //caso nao haja nenhum perfil vinculado para a permissao marcada, insere o id_perfil no formato serializado
		}
		//atualiza o campo lista_perfis da tabela adm_permissoes
		$con_update_lista = $mysqli->query("UPDATE adm_permissoes SET lista_perfis = '$lista_perfil_nova' WHERE id_permissao = '$lista_permissoes_sim1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	for($i = 0; $i < $qtde_nao; $i++){
		//busca os perfis vinculados para cada permissao marcada com nao
		$con_id_perfil_atual = $mysqli->query("SELECT lista_perfis FROM adm_permissoes WHERE id_permissao = '$lista_permissoes_nao1[$i]' AND lista_perfis <> ''");

		if($con_id_perfil_atual->num_rows <> 0){ //se já houver algum perfil vinculado:

			$row_perfil_atual = $con_id_perfil_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_permissoes, campo lista_perfis

			$lista_perfil_atual = unserialize($row_perfil_atual[0]); // transforma a string num array

			$key  = array_search($id_perfil, $lista_perfil_atual); //procura o id_perfil no array

			if($key !== false){
				unset($lista_perfil_atual[$key]); //exclui o id_perfil
			}

			if(count($lista_perfil_atual) <> 0){
				$lista_perfil_nova = serialize($lista_perfil_atual); //se ainda houver sobrado algum id_perfil para a permissao marcada, cria a string serializada
			}
			else {
				$lista_perfil_nova = "";
			}
		}
		//atualiza o campo lista_perfis da tabela adm_permissoes
		$con_update_lista = $mysqli->query("UPDATE adm_permissoes SET lista_perfis = '$lista_perfil_nova' WHERE id_permissao = '$lista_permissoes_nao1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	if ($altera == "sim" ){
		$_SESSION['permissao_administrar'] = "Alteração realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['permissao_administrar'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";
	}

	$flag = md5("permissao_administrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
