<?php
/**************************************************************
* Local/nome do script: admin/info_req/info_req_vincular_fonte_info.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$altera = "";
	$id_info_req = $_POST['id_info_req'];

	$busca_fonte_info = $mysqli->query("SELECT id_fonte_info FROM adm_fontes_informacao");
	$qtde = $busca_fonte_info->num_rows;//apenas para calcular a quantidade de fonte_infos

	$id_fonte_info = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST["fonte_info".$i] <> ""){
			$id_fonte_info = $id_fonte_info.$_POST["fonte_info".$i].",";//concatena os id_fonte_info com ",".
		}
	}

	if($id_fonte_info <> ""){
		$id_fonte_info = substr($id_fonte_info, 0, -1);//elimina a ultima ",".
		$id_fonte_info = explode(",",$id_fonte_info);//cria um array separando pelas ",".
		$id_fonte_info_vinc = serialize($id_fonte_info);//cria uma string com o array serializado
	}
	else{
		$id_fonte_info_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_info_requeridas SET id_fonte_info_vinc = '$id_fonte_info_vinc' where id_info_req = '$id_info_req'");//atualiza a lista de info_reqfonte_infos vinculadas

	if ($mysqli->affected_rows <> 0 ){
		$altera = "sim";

	}

	/***************** vincular questao ***************************************/

	/******** montando o array com as questoes que possuem essa info_req vinculada **************************************/

	$con_questao = $mysqli->query("SELECT id_questao FROM adm_questoes WHERE id_info_req_vinc like '%:\"$id_info_req\";%'");

	while($row_questao = $con_questao->fetch_array()){
		$lista_questao_atual = $lista_questao_atual . $row_questao[0] . ","; //cria uma string com os id_questao separados por ",".
	}
	$lista_questao_atual = substr($lista_questao_atual, 0, -1); //elimino a ultima "," da string.
	$lista_questao_atual = explode(",", $lista_questao_atual); //crio o array

	/******* montando o array com as questões selecionadas para vinculação ***************************/

	$con_qtde_questao = $mysqli->query("SELECT id_questao FROM adm_questoes");
	$qtde_questao = $con_qtde_questao->num_rows;

	for($i = 1; $i <= $qtde_questao; $i++){
		if($_POST["questao".$i] <> ""){
			$lista_questao_nova = $lista_questao_nova.$_POST["questao".$i].","; //cria uma string com os id_questao separados por ",".
		}
	}
	$lista_questao_nova = substr($lista_questao_nova, 0, -1); //elimino a ultima "," da string.
	$lista_questao_nova = explode(",", $lista_questao_nova); //crio o array

	/********* verifico se os arrays são diferentes criando listas com as diferenças *************************/

	$lista_questoes_sim = array_diff($lista_questao_nova, $lista_questao_atual); //lista as questoes incluidas com os indices originais Ex (1=>'2', 3=>'6')
	$lista_questoes_sim1  = array(); //cria novos indices para a lista (0=>'2', 1=>'6')
	foreach($lista_questoes_sim  as $r){
		$lista_questoes_sim1[] = $r;
	}

	$lista_questoes_nao = array_diff($lista_questao_atual, $lista_questao_nova); // lista as questoes excluidas
	$lista_questoes_nao1  = array();
	foreach($lista_questoes_nao  as $r){
		$lista_questoes_nao1[] = $r;
	}

	$qtde_sim = count($lista_questoes_sim1); //conta os check marcados
	$qtde_nao = count($lista_questoes_nao1); //conta os checks desmarcados

	/********************************* fim ***************************************************************/

	for($i = 0; $i < $qtde_sim; $i++){
		//busca as questoes vinculadas para cada questao marcada com sim
		$con_id_info_req_atual = $mysqli->query("SELECT id_info_req_vinc FROM adm_questoes WHERE id_questao = '$lista_questoes_sim1[$i]' AND id_info_req_vinc <> ''");

		if($con_id_info_req_atual->num_rows <> 0){//se já houver alguma questao vinculada:

			$row_info_req_atual = $con_id_info_req_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_questoes, campo id_info_req_vinc

			$lista_info_req_atual = unserialize($row_info_req_atual[0]); // transforma a string num array

			array_push($lista_info_req_atual, $id_info_req); //insere nesse array o id da info_req

			/***** esse trecho serve para ordenar o array de id_info_req de forma alfabética em relação às info requeridas***/
			$lista  = implode(',',$lista_info_req_atual);//separa os valores do array com uma virgula
			$lista  = "'".$lista."'";//coloca um ' no inicio e fim da string
			$lista = str_replace(",","','",$lista);//substitui a virgula por "','".

			$con_lista = $mysqli->query("SELECT id_info_req FROM adm_info_requeridas WHERE id_info_req IN ($lista) ORDER BY info_req");

			$lista_info_req_nova = "";

			while($row_lista = $con_lista->fetch_array()){
				$lista_info_req_nova = $lista_info_req_nova . $row_lista[0] . ","; //cria uma string com os id_info_req separados por ",".
			}
			$lista_info_req_nova = substr($lista_info_req_nova, 0, -1); //elimino a ultima "," da string.
			$lista_info_req_nova = explode(",", $lista_info_req_nova); //crio o array
			/*************/

			$lista_info_req_nova = serialize($lista_info_req_nova); //transforma novamente em string para salvar no banco
		}
		else{
			$lista_info_req_nova = serialize(array($id_info_req)); //caso nao haja nenhuma info_req vinculada para a subárea marcada, insere o id_info_req no formato serializado
		}
		//atualiza o campo id_info_req_vinc da tabela adm_questoes
		$con_update_lista = $mysqli->query("UPDATE adm_questoes SET id_info_req_vinc = '$lista_info_req_nova' WHERE id_questao = '$lista_questoes_sim1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	for($i = 0; $i < $qtde_nao; $i++){
		//busca as questoes vinculadas para cada questao marcada com nao
		$con_id_info_req_atual = $mysqli->query("SELECT id_info_req_vinc FROM adm_questoes WHERE id_questao = '$lista_questoes_nao1[$i]' AND id_info_req_vinc <> ''");

		if($con_id_info_req_atual->num_rows <> 0){ //se já houver alguma info_req vinculada:

			$row_info_req_atual = $con_id_info_req_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_questoes, campo id_info_req_vinc

			$lista_info_req_atual = unserialize($row_info_req_atual[0]); // transforma a string num array

			$key  = array_search($id_info_req, $lista_info_req_atual); //procura o id_info_req no array

			if($key !== false){
				unset($lista_info_req_atual[$key]); //exclui o id_info_req
				$lista_info_req_atual = array_values($lista_info_req_atual);//organiza novamente os indices de forma sequencial
			}

			if(count($lista_info_req_atual) <> 0){
				$lista_info_req_nova = serialize($lista_info_req_atual); //se ainda houver sobrado algum id_info_req para a subárea marcada, cria a string serializada
			}
			else {
				$lista_info_req_nova = "";
			}
		}
		//atualiza o campo id_info_req_vinc da tabela adm_questoes
		$con_update_lista = $mysqli->query("UPDATE adm_questoes SET id_info_req_vinc = '$lista_info_req_nova' WHERE id_questao = '$lista_questoes_nao1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}
	/*************************************************************************/

	if ($altera == "sim" ){
		$_SESSION['info_req_vincular'] = "Alteração de vinculação realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['area_vincular'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}

	$flag = md5("info_req_vincular");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
