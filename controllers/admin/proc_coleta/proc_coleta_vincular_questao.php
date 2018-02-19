<?php
/**************************************************************
* Local/nome do script: admin/proc_coleta/proc_coleta_vincular_questao.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$altera = "";
	$id_proc_coleta = $_POST['id_proc_coleta'];

	/******** montando o array com as questoes que possuem esse proc_coleta vinculado **************************************/

	$con_questao = $mysqli->query("SELECT id_questao FROM adm_questoes WHERE id_proc_coleta_vinc like '%:\"$id_proc_coleta\";%'");

	while($row_questao = $con_questao->fetch_array()){
		$lista_questao_atual = $lista_questao_atual . $row_questao[0] . ","; //cria uma string com os id_questao separados por ",".
	}
	$lista_questao_atual = substr($lista_questao_atual, 0, -1); //elimino a ultima "," da string.
	$lista_questao_atual = explode(",", $lista_questao_atual); //crio o array

	/******* montando o array com as questões selecionadas para vinculação ***************************/

	$con_qtde_questao = $mysqli->query("SELECT id_questao FROM adm_questoes");
	$qtde_questao = $con_qtde_questao->num_rows;

	for($i = 1; $i <= $qtde_questao; $i++){
		if($_POST[$i] <> ""){
			$lista_questao_nova = $lista_questao_nova.$_POST[$i].","; //cria uma string com os id_questao separados por ",".
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
		$con_id_proc_coleta_atual = $mysqli->query("SELECT id_proc_coleta_vinc FROM adm_questoes WHERE id_questao = '$lista_questoes_sim1[$i]' AND id_proc_coleta_vinc <> ''");

		if($con_id_proc_coleta_atual->num_rows <> 0){//se já houver alguma questao vinculada:

			$row_proc_coleta_atual = $con_id_proc_coleta_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_questoes, campo id_proc_coleta_vinc

			$lista_proc_coleta_atual = unserialize($row_proc_coleta_atual[0]); // transforma a string num array

			array_push($lista_proc_coleta_atual, $id_proc_coleta); //insere nesse array o id da proc_coleta

			/***** esse trecho serve para ordenar o array de id_proc_coleta de forma alfabética em relação aos proc de coleta de dados ***/
			$lista  = implode(',',$lista_proc_coleta_atual);//separa os valores do array com uma virgula
			$lista  = "'".$lista."'";//coloca um ' no inicio e fim da string
			$lista = str_replace(",","','",$lista);//substitui a virgula por "','".

			$con_lista = $mysqli->query("SELECT id_proc_coleta FROM adm_proc_coleta WHERE id_proc_coleta IN ($lista) ORDER BY proc_coleta");
			while($row_lista = $con_lista->fetch_array()){
				$lista_proc_coleta_nova = $lista_proc_coleta_nova . $row_lista[0] . ","; //cria uma string com os id_proc_coleta separados por ",".
			}
			$lista_proc_coleta_nova = substr($lista_proc_coleta_nova, 0, -1); //elimino a ultima "," da string.
			$lista_proc_coleta_nova = explode(",", $lista_proc_coleta_nova); //crio o array
			/*************/

			$lista_proc_coleta_nova = serialize($lista_proc_coleta_nova); //transforma novamente em string para salvar no banco
		}
		else{
			$lista_proc_coleta_nova = serialize(array($id_proc_coleta)); //caso nao haja nenhuma proc_coleta vinculada para a subárea marcada, insere o id_proc_coleta no formato serializado
		}
		//atualiza o campo id_proc_coleta_vinc da tabela adm_questoes
		$con_update_lista = $mysqli->query("UPDATE adm_questoes SET id_proc_coleta_vinc = '$lista_proc_coleta_nova' WHERE id_questao = '$lista_questoes_sim1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	for($i = 0; $i < $qtde_nao; $i++){
		//busca as questoes vinculadas para cada questao marcada com nao
		$con_id_proc_coleta_atual = $mysqli->query("SELECT id_proc_coleta_vinc FROM adm_questoes WHERE id_questao = '$lista_questoes_nao1[$i]' AND id_proc_coleta_vinc <> ''");

		if($con_id_proc_coleta_atual->num_rows <> 0){ //se já houver alguma proc_coleta vinculada:

			$row_proc_coleta_atual = $con_id_proc_coleta_atual->fetch_array(); //busca a lista ainda serializada (como uma string) olhar na tabela adm_questoes, campo id_proc_coleta_vinc

			$lista_proc_coleta_atual = unserialize($row_proc_coleta_atual[0]); // transforma a string num array

			$key  = array_search($id_proc_coleta, $lista_proc_coleta_atual); //procura o id_proc_coleta no array

			if($key !== false){
				unset($lista_proc_coleta_atual[$key]); //exclui o id_proc_coleta
				$lista_proc_coleta_atual = array_values($lista_proc_coleta_atual);//organiza novamente os indices de forma sequencial
			}

			if(count($lista_proc_coleta_atual) <> 0){
				$lista_proc_coleta_nova = serialize($lista_proc_coleta_atual); //se ainda houver sobrado algum id_proc_coleta para a subárea marcada, cria a string serializada
			}
			else {
				$lista_proc_coleta_nova = "";
			}
		}
		//atualiza o campo id_proc_coleta_vinc da tabela adm_questoes
		$con_update_lista = $mysqli->query("UPDATE adm_questoes SET id_proc_coleta_vinc = '$lista_proc_coleta_nova' WHERE id_questao = '$lista_questoes_nao1[$i]'");

		if ($mysqli->affected_rows <> 0 ){
			$altera = "sim";
		}
	}

	if ($altera == "sim"){
		$_SESSION['proc_coleta_vincular'] = "Alteração de vinculação realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['proc_coleta_vincular'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}
	$flag = md5("proc_coleta_vincular");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
