<?php
/**************************************************************
* Local/nome do script: admin/subarea/subarea_vincular_area.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$altera = "";
	$id_questao = $_POST['id_questao'];

	/******** montando o array com as subareas que possuem essa questao vinculada **************************************/

	$con_subarea = $mysqli->query("SELECT id_subarea FROM adm_subareas WHERE id_questao_vinc like '%:\"$id_questao\";%'");

	while($row_subarea = $con_subarea->fetch_array()){
		$lista_subarea_atual = $lista_subarea_atual . $row_subarea[0] . ","; //cria uma string com os id_subarea separados por ",".
	}
	$lista_subarea_atual = substr($lista_subarea_atual, 0, -1); //elimino a ultima "," da string.
	$lista_subarea_atual = explode(",", $lista_subarea_atual); //crio o array

	/******* montando o array com as subáreas selecionadas para vinculação ***************************/

	$con_qtde_subarea = $mysqli->query("SELECT id_subarea FROM adm_subareas");
	$qtde_subarea = $con_qtde_subarea->num_rows;

	for($i = 1; $i <= $qtde_subarea; $i++){
		if($_POST[$i] <> ""){
			$lista_subarea_nova = $lista_subarea_nova.$_POST[$i].","; //cria uma string com os id_subarea separados por ",".
		}
	}
	$lista_subarea_nova = substr($lista_subarea_nova, 0, -1); //elimino a ultima "," da string.
	$lista_subarea_nova = explode(",", $lista_subarea_nova); //crio o array

	/********* verifico se os arrays são diferentes criando listas com as diferenças *************************/

	$lista_subareas_sim = array_diff($lista_subarea_nova, $lista_subarea_atual); //lista as subareas incluidas com os indices originais Ex (1=>'2', 3=>'6')
	$lista_subareas_sim1  = array(); //cria novos indices para a lista (0=>'2', 1=>'6')
	foreach($lista_subareas_sim  as $r){
		$lista_subareas_sim1[] = $r;
	}

	$lista_subareas_nao = array_diff($lista_subarea_atual, $lista_subarea_nova); // lista as subareas excluidas
	$lista_subareas_nao1  = array();
	foreach($lista_subareas_nao  as $r){
		$lista_subareas_nao1[] = $r;
	}

	$qtde_sim = count($lista_subareas_sim1); //conta os check marcados
	$qtde_nao = count($lista_subareas_nao1); //conta os checks desmarcados

	/********************************* fim ***************************************************************/

	for($i = 0; $i < $qtde_sim; $i++){
		//busca as questoes vinculadas para cada subarea marcada com sim
		$con_id_questao_atual = $mysqli->query("SELECT id_questao_vinc FROM adm_subareas WHERE id_subarea = '$lista_subareas_sim1[$i]' AND id_questao_vinc <> ''");

		if($con_id_questao_atual->num_rows <> 0){//se já houver alguma subarea vinculada:

			$row_questao_atual = $con_id_questao_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_subareas, campo id_questao_vinc

			$lista_questao_atual = unserialize($row_questao_atual[0]); // transforma a string num array

			array_push($lista_questao_atual, $id_questao); //insere nesse array o id da questao

			$lista_questao_nova = serialize($lista_questao_atual); //transforma novamente em string para salvar no banco
		}
		else{
			$lista_questao_nova = serialize(array($id_questao)); //caso nao haja nenhuma questao vinculada para a subárea marcada, insere o id_questao no formato serializado
		}
		//atualiza o campo id_questao_vinc da tabela adm_subareas
		$con_update_lista = $mysqli->query("UPDATE adm_subareas SET id_questao_vinc = '$lista_questao_nova' WHERE id_subarea = '$lista_subareas_sim1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	for($i = 0; $i < $qtde_nao; $i++){
		//busca as questoes vinculadas para cada subarea marcada com nao
		$con_id_questao_atual = $mysqli->query("SELECT id_questao_vinc FROM adm_subareas WHERE id_subarea = '$lista_subareas_nao1[$i]' AND id_questao_vinc <> ''");

		if($con_id_questao_atual->num_rows <> 0){ //se já houver alguma questao vinculada:

			$row_questao_atual = $con_id_questao_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_subareas, campo id_questao_vinc

			$lista_questao_atual = unserialize($row_questao_atual[0]); // transforma a string num array

			$key  = array_search($id_questao, $lista_questao_atual); //procura o id_questao no array

			if($key !== false){
				unset($lista_questao_atual[$key]); //exclui o id_questao
			}

			if(count($lista_questao_atual) <> 0){
				$lista_questao_nova = serialize($lista_questao_atual); //se ainda houver sobrado algum id_questao para a subárea marcada, cria a string serializada
			}
			else {
				$lista_questao_nova = "";
			}
		}
		//atualiza o campo id_questao_vinc da tabela adm_subareas
		$con_update_lista = $mysqli->query("UPDATE adm_subareas SET id_questao_vinc = '$lista_questao_nova' WHERE id_subarea = '$lista_subareas_nao1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	if ($altera == "sim"){
		$_SESSION['questao_vincular'] = "Alteração de vinculação realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['questao_vincular'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}
	$flag = md5("questao_vincular");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
