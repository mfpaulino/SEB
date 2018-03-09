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
	$id_subarea = $_POST['id_subarea'];

	/******** montando o array com as areas que possuem essa subarea vinculada **************************************/

	$con_area = $mysqli->query("SELECT id_area FROM adm_areas WHERE id_subarea_vinc like '%:\"$id_subarea\";%'");

	while($row_area = $con_area->fetch_array()){
		$lista_area_atual = $lista_area_atual . $row_area[0] . ","; //cria uma string com os id_area separados por ",".
	}
	$lista_area_atual = substr($lista_area_atual, 0, -1); //elimino a ultima "," da string.
	$lista_area_atual = explode(",", $lista_area_atual); //crio o array

	/******* montando o array com as áreas selecionadas para vinculação ***************************/

	$con_qtde_area = $mysqli->query("SELECT id_area FROM adm_areas");
	$qtde_area = $con_qtde_area->num_rows;

	for($i = 1; $i <= $qtde_area; $i++){
		if($_POST["s_area".$i] <> ""){
			$lista_area_nova = $lista_area_nova.$_POST["s_area".$i].","; //cria uma string com os id_area separados por ",".
		}
	}
	$lista_area_nova = substr($lista_area_nova, 0, -1); //elimino a ultima "," da string.
	$lista_area_nova = explode(",", $lista_area_nova); //crio o array

	/********* verifico se os arrays são diferentes criando listas com as diferenças *************************/

	$lista_areas_sim = array_diff($lista_area_nova, $lista_area_atual); //lista as areas incluidas com os indices originais Ex (1=>'2', 3=>'6')
	$lista_areas_sim1  = array(); //cria novos indices para a lista (0=>'2', 1=>'6')
	foreach($lista_areas_sim  as $r){
		$lista_areas_sim1[] = $r;
	}

	$lista_areas_nao = array_diff($lista_area_atual, $lista_area_nova); // lista as areas excluidas
	$lista_areas_nao1  = array();
	foreach($lista_areas_nao  as $r){
		$lista_areas_nao1[] = $r;
	}

	$qtde_sim = count($lista_areas_sim1); //conta os check marcados
	$qtde_nao = count($lista_areas_nao1); //conta os checks desmarcados

	/********************************* fim ***************************************************************/

	for($i = 0; $i < $qtde_sim; $i++){
		//busca as subareas vinculadas para cada area marcada com sim
		$con_id_subarea_atual = $mysqli->query("SELECT id_subarea_vinc FROM adm_areas WHERE id_area = '$lista_areas_sim1[$i]' AND id_subarea_vinc <> ''");

		if($con_id_subarea_atual->num_rows <> 0){//se já houver alguma subarea vinculada:

			$row_subarea_atual = $con_id_subarea_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_areas, campo id_subarea_vinc

			$lista_subarea_atual = unserialize($row_subarea_atual[0]); // transforma a string num array

			array_push($lista_subarea_atual, $id_subarea); //insere nesse array o id da subarea

			/***** esse trecho serve para ordenar o array de id_subarea de forma alfabética em relação às subáreas***/
			$lista  = implode(',',$lista_subarea_atual);//separa os valores do array com uma virgula
			$lista  = "'".$lista."'";//coloca um ' no inicio e fim da string
			$lista = str_replace(",","','",$lista);//substitui a virgula por "','".

			$con_lista = $mysqli->query("SELECT id_subarea FROM adm_subareas WHERE id_subarea IN ($lista) ORDER BY subarea");

			$lista_subarea_nova = "";

			while($row_lista = $con_lista->fetch_array()){
				$lista_subarea_nova = $lista_subarea_nova . $row_lista[0] . ","; //cria uma string com os id_subarea separados por ",".
			}
			$lista_subarea_nova = substr($lista_subarea_nova, 0, -1); //elimino a ultima "," da string.
			$lista_subarea_nova = explode(",", $lista_subarea_nova); //crio o array
			/*************/

			$lista_subarea_nova = serialize($lista_subarea_nova); //transforma novamente em string para salvar no banco
		}
		else{
			$lista_subarea_nova = serialize(array($id_subarea)); //caso nao haja nenhuma subarea vinculada para a area marcada, insere o id_subarea no formato serializado
		}
		//atualiza o campo id_subarea_vinc da tabela adm_areas
		$con_update_lista = $mysqli->query("UPDATE adm_areas SET id_subarea_vinc = '$lista_subarea_nova' WHERE id_area = '$lista_areas_sim1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	for($i = 0; $i < $qtde_nao; $i++){
		//busca as subareas vinculadas para cada area marcada com nao
		$con_id_subarea_atual = $mysqli->query("SELECT id_subarea_vinc FROM adm_areas WHERE id_area = '$lista_areas_nao1[$i]' AND id_subarea_vinc <> ''");

		if($con_id_subarea_atual->num_rows <> 0){ //se já houver alguma subarea vinculada:

			$row_subarea_atual = $con_id_subarea_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_areas, campo id_subarea_vinc

			$lista_subarea_atual = unserialize($row_subarea_atual[0]); // transforma a string num array

			$key  = array_search($id_subarea, $lista_subarea_atual); //procura o id_subarea no array

			if($key !== false){
				unset($lista_subarea_atual[$key]); //exclui o id_subarea
				$lista_subarea_atual = array_values($lista_subarea_atual);//organiza novamente os indices de forma sequencial
			}

			if(count($lista_subarea_atual) <> 0){
				$lista_subarea_nova = serialize($lista_subarea_atual); //se ainda houver sobrado algum id_subarea para a area marcada, cria a string serializada
			}
			else {
				$lista_subarea_nova = "";
			}
		}
		//atualiza o campo id_subarea_vinc da tabela adm_areas
		$con_update_lista = $mysqli->query("UPDATE adm_areas SET id_subarea_vinc = '$lista_subarea_nova' WHERE id_area = '$lista_areas_nao1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	/*********** vincular questoes ********************************/

	$busca_questao = $mysqli->query("SELECT id_questao FROM adm_questoes");
	$qtde = $busca_questao->num_rows;//apenas para calcular a quantidade de questoes

	$id_questao = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST["s_questao".$i] <> ""){
			$id_questao = $id_questao.$_POST["s_questao".$i].",";//concatena os id_questao com ",".
		}
	}

	if($id_questao <> ""){
		$id_questao = substr($id_questao, 0, -1);//elimina a ultima ",".
		$id_questao = explode(",",$id_questao);//cria um array separando pelas ",".
		$id_questao_vinc = serialize($id_questao);//cria uma string com o array serializado
	}
	else{
		$id_questao_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_subareas SET id_questao_vinc = '$id_questao_vinc' where id_subarea = '$id_subarea'");//atualiza a lista de questoes vinculadas

	if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
	}

	/***************************************************************/

	if ($altera == "sim"){
		$_SESSION['subarea_vincular'] = "Alteração de vinculação realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['subarea_vincular'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}
	$flag = md5("subarea_vincular");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
