<?php
/**************************************************************
* Local/nome do script: admin/fonte_info/fonte_info_vincular_info_req.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$altera = "";
	$id_fonte_info = $_POST['id_fonte_info'];

	/******** montando o array com as info_reqs que possuem essa fonte_info vinculada **************************************/

	$con_info_req = $mysqli->query("SELECT id_info_req FROM adm_info_requeridas WHERE id_fonte_info_vinc like '%:\"$id_fonte_info\";%'");

	while($row_info_req = $con_info_req->fetch_array()){
		$lista_info_req_atual = $lista_info_req_atual . $row_info_req[0] . ","; //cria uma string com os id_info_req separados por ",".
	}
	$lista_info_req_atual = substr($lista_info_req_atual, 0, -1); //elimino a ultima "," da string.
	$lista_info_req_atual = explode(",", $lista_info_req_atual); //crio o array

	/******* montando o array com as áres selecionadas para vinculação ***************************/

	$con_qtde_info_req = $mysqli->query("SELECT id_info_req FROM adm_info_requeridas");
	$qtde_info_req = $con_qtde_info_req->num_rows;

	for($i = 1; $i <= $qtde_info_req; $i++){
		if($_POST[$i] <> ""){
			$lista_info_req_nova = $lista_info_req_nova.$_POST[$i].","; //cria uma string com os id_info_req separados por ",".
		}
	}
	$lista_info_req_nova = substr($lista_info_req_nova, 0, -1); //elimino a ultima "," da string.
	$lista_info_req_nova = explode(",", $lista_info_req_nova); //crio o array

	/********* verifico se os arrays são diferentes criando listas com as diferenças *************************/

	$lista_info_reqs_sim = array_diff($lista_info_req_nova, $lista_info_req_atual); //lista as info_reqs incluidas com os indices originais Ex (1=>'2', 3=>'6')
	$lista_info_reqs_sim1  = array(); //cria novos indices para a lista (0=>'2', 1=>'6')
	foreach($lista_info_reqs_sim  as $r){
		$lista_info_reqs_sim1[] = $r;
	}

	$lista_info_reqs_nao = array_diff($lista_info_req_atual, $lista_info_req_nova); // lista as info_reqs excluidas
	$lista_info_reqs_nao1  = array();
	foreach($lista_info_reqs_nao  as $r){
		$lista_info_reqs_nao1[] = $r;
	}

	$qtde_sim = count($lista_info_reqs_sim1); //conta os check marcados
	$qtde_nao = count($lista_info_reqs_nao1); //conta os checks desmarcados

	/********************************* fim ***************************************************************/

	for($i = 0; $i < $qtde_sim; $i++){
		//busca as fonte_infos vinculadas para cada info_req marcada com sim
		$con_id_fonte_info_atual = $mysqli->query("SELECT id_fonte_info_vinc FROM adm_info_reqs WHERE id_info_req = '$lista_info_reqs_sim1[$i]' AND id_fonte_info_vinc <> ''");

		if($con_id_fonte_info_atual->num_rows <> 0){//se já houver alguma fonte_info vinculada:

			$row_fonte_info_atual = $con_id_fonte_info_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_info_reqs, campo id_fonte_info_vinc

			$lista_fonte_info_atual = unserialize($row_fonte_info_atual[0]); // transforma a string num array

			array_push($lista_fonte_info_atual, $id_fonte_info); //insere nesse array o id da fonte_info

			$lista_fonte_info_nova = serialize($lista_fonte_info_atual); //transforma novamente em string para salvar no banco
		}
		else{
			$lista_fonte_info_nova = serialize(array($id_fonte_info)); //caso nao haja nenhuma fonte_info vinculada para a info_req marcada, insere o id_fonte_info no formato serializado
		}
		//atualiza o campo id_fonte_info_vinc da tabela adm_info_requeridas
		$con_update_lista = $mysqli->query("UPDATE adm_info_requeridas SET id_fonte_info_vinc = '$lista_fonte_info_nova' WHERE id_info_req = '$lista_info_reqs_sim1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	for($i = 0; $i < $qtde_nao; $i++){
		//busca as fonte_infos vinculadas para cada info_req marcada com nao
		$con_id_fonte_info_atual = $mysqli->query("SELECT id_fonte_info_vinc FROM adm_info_requeridas WHERE id_info_req = '$lista_info_reqs_nao1[$i]' AND id_fonte_info_vinc <> ''");

		if($con_id_fonte_info_atual->num_rows <> 0){ //se já houver alguma fonte_info vinculada:

			$row_fonte_info_atual = $con_id_fonte_info_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_info_requeridas, campo id_fonte_info_vinc

			$lista_fonte_info_atual = unserialize($row_fonte_info_atual[0]); // transforma a string num array

			$key  = array_search($id_fonte_info, $lista_fonte_info_atual); //procura o id_fonte_info no array

			if($key !== false){
				unset($lista_fonte_info_atual[$key]); //exclui o id_fonte_info
			}

			if(count($lista_fonte_info_atual) <> 0){
				$lista_fonte_info_nova = serialize($lista_fonte_info_atual); //se ainda houver sobrado algum id_fonte_info para a info_req marcada, cria a string serializada
			}
			else {
				$lista_fonte_info_nova = "";
			}
		}
		//atualiza o campo id_fonte_info_vinc da tabela adm_info_requeridas
		$con_update_lista = $mysqli->query("UPDATE adm_info_requeridas SET id_fonte_info_vinc = '$lista_fonte_info_nova' WHERE id_info_req = '$lista_info_reqs_nao1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	if ($altera == "sim"){
		$_SESSION['fonte_info_vincular'] = "Alteração de vinculação realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['fonte_info_vincular'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}
	$flag = md5("fonte_info_vincular");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
