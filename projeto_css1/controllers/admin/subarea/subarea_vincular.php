<?php
/**************************************************************
* Local/nome do script: admin/subarea/subarea_vincular.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');


	$id_subarea = $_POST['id_subarea'];

	/******** montando o array com as areas que possuem essa subarea vinculada **************************************/

	$con_area = $mysqli->query("SELECT id_area FROM adm_areas WHERE id_subarea_vinc like '%:\"$id_subarea\";%'");

	while($row_area = $con_area->fetch_array()){
		$lista_area_atual = $lista_area_atual . $row_area[0] . ","; //cria uma string com os id_area separados por ",".
	}
	$lista_area_atual = substr($lista_area_atual, 0, -1); //elimino a ultima "," da string.
	$lista_area_atual = explode(",", $lista_area_atual); //crio o array

	/******* montando o array com as áres selecionadas para vinculação ***************************/

	$con_qtde_area = $mysqli->query("SELECT id_area FROM adm_areas");
	$qtde_area = $con_qtde_area->num_rows;

	for($i = 1; $i <= $qtde_area; $i++){
		if($_POST[$i] <> ""){
			$lista_area_nova = $lista_area_nova.$_POST[$i].","; //cria uma string com os id_area separados por ",".
		}
	}
	$lista_area_nova = substr($lista_area_nova, 0, -1); //elimino a ultima "," da string.
	$lista_area_nova = explode(",", $lista_area_nova); //crio o array

	/*************************** fim ***************************************************************/

	/**** verifico se os arrays são diferentes *********/

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

	$qtde_sim = count($lista_areas_sim1);//lista com os indices iniciando em 0
	$qtde_nao = count($lista_areas_nao1);//lista com os indices iniciando em 0

	for($i = 0; $i < $qtde_sim; $i++){
		$con_id_subarea_atual = $mysqli->query("SELECT id_subarea_vinc FROM adm_areas WHERE id_area = '$lista_areas_sim1[$i]' AND id_subarea_vinc <> ''");
		if($con_id_subarea_atual->num_rows <> 0){
			$row_subarea_atual = $con_id_subarea_atual->fetch_array();
			$lista_subarea_atual = unserialize($row_subarea_atual[0]);
			$lista_subarea_nova = array_push($lista_subarea_atual, $id_subarea);
		}
		else{
			$lista_subarea_nova = serialize(array(0 => $id_subarea));
		}
		//$con_update_lista = $mysqli->query("UPDATE adm_areas SET id_subarea_vinc = '$lista_subarea_nova' WHERE id_area = '$lista_areas_sim1[$i]'");
			//echo "UPDATE adm_areas SET id_subarea_vinc = '$lista_subarea_nova' WHERE id_area = '$lista_areas_sim1[$i]'"."<br />";
			//echo "SELECT id_subarea_vinc FROM adm_areas WHERE id_area = '$lista_areas_sim1[$i]'";
echo "<br />";
echo $row_subarea_atual[0];
echo "<br />";
echo $lista_subarea_nova;
echo "<br />";
print_r($lista_subarea_atual);
echo "<br />";
print_r($lista_subarea_nova);
echo "<br />";
	}
	/**excluir do array**/
	//$key = array_search('item 2', $input);
//if($key!==false){
//unset($input[$key]);
//}
/**inserir no array **/
//array_push($frutas, 'melancia', 'pera');

echo "atual: ";
print_r($lista_area_atual);
echo "<br />";
echo "nova: ";
print_r($lista_area_nova);
echo "<br />";
echo "sim: ";
print_r($lista_areas_sim1);
echo "<br />";
echo "nao: ";
print_r($lista_areas_nao1);
echo "<br />";
$var = array( 0 => 19, 1 => 16);
$var1 = 2;
array_push($var,$var1);
print_r($var);
$var2 = serialize($var);
echo "<br />";
echo $var2;

	/*
	$qtde = $busca_area->num_rows;//apenas para calcular a quantidade de areas

	$id_area = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST[$i] <> ""){
			$id_subarea = $id_subarea.$_POST[$i].",";//concatena os id_subarea com ",".
		}
	}

	if($id_subarea <> ""){
		$id_subarea = substr($id_subarea, 0, -1);//elimina a ultima ",".
		$id_subarea = explode(",",$id_subarea);//cria um array separando pelas ",".
		$id_subarea_vinc = serialize($id_subarea);//cria uma string com o array serializado
	}
	else{
		$id_subarea_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_areas SET id_subarea_vinc = '$id_subarea_vinc' where id_area = '$id_area'");//atualiza a lista de subareas vinculadas

	if ($mysqli->affected_rows <> 0 ){
		$_SESSION['area_vincular'] = "Alteração de vinculação realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['area_vincular'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}
	$flag = md5("area_vincular");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
	*/
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
