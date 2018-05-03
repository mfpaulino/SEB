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
		if($_POST["subarea".$i] <> ""){
			$lista_subarea_nova = $lista_subarea_nova.$_POST["subarea".$i].","; //cria uma string com os id_subarea separados por ",".
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

			/***** esse trecho serve para ordenar o array de id_questao de forma alfabética em relação às questões***/
			$lista  = implode(',',$lista_questao_atual);//separa os valores do array com uma virgula
			$lista  = "'".$lista."'";//coloca um ' no inicio e fim da string
			$lista = str_replace(",","','",$lista);//substitui a virgula por "','".

			$con_lista = $mysqli->query("SELECT id_questao FROM adm_questoes WHERE id_questao IN ($lista) ORDER BY questao");

			$lista_questao_nova = "";

			while($row_lista = $con_lista->fetch_array()){
				$lista_questao_nova = $lista_questao_nova . $row_lista[0] . ","; //cria uma string com os id_questao separados por ",".
			}
			$lista_questao_nova = substr($lista_questao_nova, 0, -1); //elimino a ultima "," da string.
			$lista_questao_nova = explode(",", $lista_questao_nova); //crio o array
			/*************/

			$lista_questao_nova = serialize($lista_questao_nova); //transforma novamente em string para salvar no banco
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
				unset($lista_questao_atual[$key]); //exclui o id_questao ( o índice tb é excluído)
				$lista_questao_atual = array_values($lista_questao_atual);//organiza novamente os indices de forma sequencial
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

	/**** informacoes requeridas ********/

	$busca_info_req = $mysqli->query("SELECT id_info_req FROM adm_info_requeridas");
	$qtde = $busca_info_req->num_rows;//apenas para calcular a quantidade de info_reqs

	$id_info_req = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST["info_req".$i] <> ""){
			$id_info_req = $id_info_req.$_POST["info_req".$i].",";//concatena os id_info_req com ",".
		}
	}

	if($id_info_req <> ""){
		$id_info_req = substr($id_info_req, 0, -1);//elimina a ultima ",".
		$id_info_req = explode(",",$id_info_req);//cria um array separando pelas ",".
		$id_info_req_vinc = serialize($id_info_req);//cria uma string com o array serializado
	}
	else{
		$id_info_req_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_questoes SET id_info_req_vinc = '$id_info_req_vinc' where id_questao = '$id_questao'");//atualiza a lista de info_reqs vinculadas

	if ($mysqli->affected_rows <> 0 ){
		$altera = "sim";
	}

	/*********** procedimentos de coleta de dados *************/

	$busca_proc_coleta = $mysqli->query("SELECT id_proc_coleta FROM adm_proc_coleta");
	$qtde = $busca_proc_coleta->num_rows;//apenas para calcular a quantidade de proc_coleta

	$id_proc_coleta = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST["proc_coleta".$i] <> ""){
			$id_proc_coleta = $id_proc_coleta.$_POST["proc_coleta".$i].",";//concatena os id_proc_coleta com ",".
		}
	}

	if($id_proc_coleta <> ""){
		$id_proc_coleta = substr($id_proc_coleta, 0, -1);//elimina a ultima ",".
		$id_proc_coleta = explode(",",$id_proc_coleta);//cria um array separando pelas ",".
		$id_proc_coleta_vinc = serialize($id_proc_coleta);//cria uma string com o array serializado
	}
	else{
		$id_proc_coleta_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_questoes SET id_proc_coleta_vinc = '$id_proc_coleta_vinc' where id_questao = '$id_questao'");//atualiza a lista de proc_coletas vinculadas

	if ($mysqli->affected_rows <> 0 ){
		$altera = "sim";
	}

	/************ procedimentos de analise de dados **********************/

	$busca_proc_ana = $mysqli->query("SELECT id_proc_ana FROM adm_proc_analise");
	$qtde = $busca_proc_ana->num_rows;//apenas para calcular a quantidade de proc_ana

	$id_proc_ana = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST["proc_ana".$i] <> ""){
			$id_proc_ana = $id_proc_ana.$_POST["proc_ana".$i].",";//concatena os id_proc_ana com ",".
		}
	}

	if($id_proc_ana <> ""){
		$id_proc_ana = substr($id_proc_ana, 0, -1);//elimina a ultima ",".
		$id_proc_ana = explode(",",$id_proc_ana);//cria um array separando pelas ",".
		$id_proc_ana_vinc = serialize($id_proc_ana);//cria uma string com o array serializado
	}
	else{
		$id_proc_ana_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_questoes SET id_proc_ana_vinc = '$id_proc_ana_vinc' where id_questao = '$id_questao'");//atualiza a lista de proc_anas vinculadas

	if ($mysqli->affected_rows <> 0 ){
		$altera = "sim";
	}

	/************************** possiveis achados **************************/

	$busca_poss_achado = $mysqli->query("SELECT id_poss_achado FROM adm_poss_achados");
	$qtde = $busca_poss_achado->num_rows;//apenas para calcular a quantidade de poss_achados

	$id_poss_achado = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST["poss_achado".$i] <> ""){
			$id_poss_achado = $id_poss_achado.$_POST["poss_achado".$i].",";//concatena os id_poss_achado com ",".
		}
	}

	if($id_poss_achado <> ""){
		$id_poss_achado = substr($id_poss_achado, 0, -1);//elimina a ultima ",".
		$id_poss_achado = explode(",",$id_poss_achado);//cria um array separando pelas ",".
		$id_poss_achado_vinc = serialize($id_poss_achado);//cria uma string com o array serializado
	}
	else{
		$id_poss_achado_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_questoes SET id_poss_achado_vinc = '$id_poss_achado_vinc' where id_questao = '$id_questao'");//atualiza a lista de poss_achados vinculadas

	if ($mysqli->affected_rows <> 0 ){
		$altera = "sim";
	}

	/********************************************************/

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
