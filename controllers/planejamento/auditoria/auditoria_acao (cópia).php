<?php
/**************************************************************
* Local/nome do script: controllers/plano/auditoria_cadastrar.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* primeiramente destroi as variaveis de sessao de alertas de usuario
* Recebe todos os dados do formulario de cadastro de usuario
* Usa a classe validaForm para fazer a validação dos dados
* Em caso de erros, cria variaveis de sessão com mensagens de alertas que serão utilizadas
* pelo script plano/alertas.inc.php(incluido pelo index.php)
* Em caso de tudo certo, grava no BD
* Ao final de tudo, redireciona para o index.php
* *************************************************************/
session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	if($_POST['flag'] == "cadastrar"){

		$user_cad = $_SESSION['cpf'];
		$data_cad = date('Y-m-d H:i:s');

		$ano 		   = isset($_POST['ano'])  ? $_POST['ano'] : "";
		$natureza 	   = isset($_POST['natureza']) ? $_POST['natureza'] : "";
		$tipo 	   	   = isset($_POST['tipo_evento']) ? $_POST['tipo_evento'] : "";
		$nup 		   = isset($_POST['nup']) ? $_POST['nup'] : "";
		$unidade 	   = isset($_POST['unidade']) ? $_POST['unidade'] : "";
		$equipe 	   = isset($_POST['auditor']) ? $_POST['auditor'] : "";
		$chefe 	   	   = isset($_POST['ch_equipe']) ? $_POST['ch_equipe'] : "";
		$periodo 	   = isset($_POST['periodo']) ? $_POST['periodo'] : "";

		$tipo = explode("|",$tipo);
		$tipo = $tipo[1];

		$inicio = converter_data(substr($periodo, 0, 11),'EN');
		$fim = converter_data(substr($periodo, -10), 'EN');

		for($i=0; $i < count($unidade); $i++){
			$lst_unidade = $lst_unidade . $unidade[$i] . ","; //cria uma string com os codom separados por ",".
		}
		//$lst_unidade = substr($lst_unidade, 0, -1); //elimino a ultima "," da string.

		for($i=0; $i < count($equipe); $i++){
			$lst_equipe = $lst_equipe . $equipe[$i] . ","; //cria uma string com os id_usuarios separados por ",".
		}
		//$lst_equipe = substr($lst_equipe, 0, -1); //elimino a ultima "," da string.

		$validar = new validaForm();

			$ano_corrente = date('Y');
			$ano1 = $ano_corrente - 1;
			$ano2 = $ano_corrente + 2;

			$validar->set('Unidade', 			$unidade)->is_required()
				->set('Equipe', 				$equipe)->is_required()
				->set('Período', 				$periodo)->is_required()
				->set('Chefe de Equipe', 		$chefe)->is_required()
				->set('Tipo de Auditoria', 		$tipo)->is_required()
				->set('Natureza da Auditoria', 	$natureza)->is_required()
				->set('NUP', 					$nup)->is_required()
				->set('Ano',  					$ano)->is_required()->between_values($ano1, $ano2);

		if ($validar->validate()){

			$consulta = $mysqli->query("SELECT nup FROM plan_auditoria WHERE nup = '$nup'");

			if($consulta->num_rows == 0){

				$resultado = $mysqli->query("INSERT INTO plan_auditoria (ano, natureza, tipo, nup, unidades, inicio, fim, equipe, chefe, user_cad, data_cad) VALUES ('$ano', '$natureza', '$tipo', '$nup', '$lst_unidade', '$inicio', '$fim', '$lst_equipe', '$chefe', '$user_cad', '$data_cad')");

				if($resultado){
					$msg = "Cadastro realizado com sucesso!";
					$botao = "success";
				}
				else{
					$msg = "ERRO 098: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
					$botao = "danger";
				}
			}
			else{
				$msg = "NUP já cadastrado!";
				$botao = "danger";
			}
		}
		else {
			$msg = "ERRO 099: dados inconsistentes, preencha novamente o formulário!";
			$botao = "danger";

			$lista_erro_validacao = $validar->get_errors(); //Captura os erros de todos os campos
		}
		include_once(PATH . '/views/planejamento/auditoria/view_alerta.inc.php');
	}
	elseif($_POST['flag'] == "excluir"){
		$id_auditoria = $_POST['id_auditoria'];

		$con_del   = $mysqli->query("DELETE FROM plan_auditoria WHERE id_auditoria = '$id_auditoria'");
		$con_teste = $mysqli->query("SELECT id_auditoria FROM plan_auditoria WHERE id_auditoria = '$id_auditoria'");

		if($con_teste->num_rows == 0){

			$botao = "success";
			$msg = "Auditoria excluída com sucesso!";
		}
		else{
			$botao = "danger";
			$msg = "ERRO 100: auditoria não excluída. Por favor, tente novamente!";
		}
		include_once(PATH . '/views/planejamento/auditoria/view_alerta.inc.php');
	}
	elseif($_POST['flag'] == "alterar"){

		$user_cad = $_SESSION['cpf'];
		$data_cad = date('Y-m-d H:i:s');

		$id_auditoria  = isset($_POST['id_auditoria'])  ? $_POST['id_auditoria'] : "";

		$ano 		   = isset($_POST['ano'])  ? $_POST['ano'] : "";
		$natureza 	   = isset($_POST['natureza']) ? $_POST['natureza'] : "";
		$tipo 	   	   = isset($_POST['tipo_evento']) ? $_POST['tipo_evento'] : "";
		$nup 		   = isset($_POST['nup']) ? $_POST['nup'] : "";
		$unidade 	   = isset($_POST['unidade']) ? $_POST['unidade'] : "";
		$equipe 	   = isset($_POST['auditor']) ? $_POST['auditor'] : "";
		$chefe 	   	   = isset($_POST['ch_equipe']) ? $_POST['ch_equipe'] : "";
		$periodo 	   = isset($_POST['periodo']) ? $_POST['periodo'] : "";


		$ano_atual 		   = isset($_POST['ano_atual'])  ? $_POST['ano_atual'] : "";
		$natureza_atual    = isset($_POST['natureza_atual']) ? $_POST['natureza_atual'] : "";
		$tipo_atual 	   = isset($_POST['tipo_evento_atual']) ? $_POST['tipo_evento_atual'] : "";
		$nup_atual 		   = isset($_POST['nup_atual']) ? $_POST['nup_atual'] : "";
		$unidade_atual 	   = isset($_POST['unidade_atual']) ? $_POST['unidade_atual'] : "";
		$equipe_atual 	   = isset($_POST['auditor_atual']) ? $_POST['auditor_atual'] : "";
		$chefe_atual 	   = isset($_POST['ch_equipe_atual']) ? $_POST['ch_equipe_atual'] : "";
		$periodo_atual 	   = isset($_POST['periodo_atual']) ? $_POST['periodo_atual'] : "";

		$inicio = converter_data(substr($periodo, 0, 11),'EN');
		$fim = converter_data(substr($periodo, -10), 'EN');

		for($i=0; $i < count($unidade); $i++){
			$lst_unidade = $lst_unidade . $unidade[$i] . ","; //cria uma string com os codom separados por ",".
		}

		for($i=0; $i < count($equipe); $i++){
			$lst_equipe = $lst_equipe . $equipe[$i] . ","; //cria uma string com os id_usuarios separados por ",".
		}

		$ano_corrente = date('Y');
		$ano1 = $ano_corrente - 1;
		$ano2 = $ano_corrente + 2;

		$validar = new validaForm();

		$validar->set('Unidade', 				$unidade)->is_required()
				->set('Equipe', 				$equipe)->is_required()
				->set('Período', 				$periodo)->is_required()
				->set('Chefe de Equipe', 		$chefe)->is_required()
				->set('Tipo de Auditoria', 		$tipo)->is_required()
				->set('Natureza da Auditoria', 	$natureza)->is_required()
				->set('NUP', 					$nup)->is_required()
				->set('Ano', 					$ano)->is_required()->between_values($ano1, $ano2);

		if ($validar->validate()){

			$altera = "nao";

			if($tipo <> "" and $tipo <> $tipo_atual){

				$tipo = explode("|",$tipo);
				$tipo = $tipo[1];

				$con_tipo = $mysqli->prepare("UPDATE plan_auditoria SET tipo = ? WHERE id_auditoria ='$id_auditoria'");
				$con_tipo->bind_param('s', $tipo);
				$resultado = $con_tipo->execute();
				$linhas_afetadas = $con_tipo->affected_rows;
			}

			if($periodo <> "" and $periodo <> $periodo_atual){

				$inicio = converter_data(substr($periodo, 0, 11),'EN');
				$fim = converter_data(substr($periodo, -10), 'EN');

				$con_periodo = $mysqli->prepare("UPDATE plan_auditoria SET inicio = ?, fim = ?  WHERE id_auditoria ='$id_auditoria'");
				$con_periodo->bind_param('ss', $inicio, $fim);
				$resultado = $con_periodo->execute();
				$linhas_afetadas = $con_periodo->affected_rows;
			}

			if($ano <> "" and $ano <> $ano_atual){

				$con_ano = $mysqli->prepare("UPDATE plan_auditoria SET ano = ?  WHERE id_auditoria ='$id_auditoria'");
				$con_ano->bind_param('s', $ano);
				$resultado = $con_ano->execute();
				$linhas_afetadas = $con_ano->affected_rows;
			}

			if($natureza <> "" and $natureza <> $natureza_atual){

				$con_natureza= $mysqli->prepare("UPDATE plan_auditoria SET natureza = ?  WHERE id_auditoria ='$id_auditoria'");
				$con_natureza->bind_param('s', $natureza);
				$resultado = $con_natureza->execute();
				$linhas_afetadas = $con_natureza->affected_rows;
			}

			if($lst_equipe <> "" and $lst_equipe <> $equipe_atual){

				$con_equipe= $mysqli->prepare("UPDATE plan_auditoria SET equipe = ?  WHERE id_auditoria ='$id_auditoria'");
				$con_equipe->bind_param('s', $lst_equipe);
				$resultado = $con_equipe->execute();
				$linhas_afetadas = $con_equipe->affected_rows;
			}

			if($lst_unidade <> "" and $lst_unidade <> $unidade_atual){

				$con_unidade= $mysqli->prepare("UPDATE plan_auditoria SET unidades = ?  WHERE id_auditoria ='$id_auditoria'");
				$con_unidade->bind_param('s', $lst_unidade);
				$resultado = $con_unidade->execute();
				$linhas_afetadas = $con_unidade->affected_rows;
			}

			if($chefe <> "" and $chefe <> $chefe_atual){

				$con_chefe= $mysqli->prepare("UPDATE plan_auditoria SET chefe = ?  WHERE id_auditoria ='$id_auditoria'");
				$con_chefe->bind_param('s', $chefe);
				$resultado = $con_chefe->execute();
				$linhas_afetadas = $con_chefe->affected_rows;
			}

			if($nup <> "" and $nup <> $nup_atual){

				$consulta = $mysqli->query("SELECT nup FROM plan_auditoria WHERE nup = '$nup'");

				if($consulta->num_rows == 0){
					$con_nup = $mysqli->prepare("UPDATE plan_auditoria SET nup = ? WHERE id_auditoria ='$id_auditoria'");
					$con_nup->bind_param('s', $nup);
					$resultado = $con_nup->execute();
					$linhas_afetadas = $con_nup->affected_rows;
				}
				else{
					$erro = "sim";
					$msg = "NUP já cadastrado!";
					$botao = "danger";
				}
			}

			if($linhas_afetadas <> 0){

				/** log **/
				$log = "Alterou dados referentes à auditoria (NUP: $nup).";
				$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'plan_auditoria'");
				/** fim log **/

				$msg = "Auditoria alterada com sucesso!";
				$botao = "success";
				$altera = "sim";

			}

			if($altera == "nao" and $erro <> "sim"){
				$msg = "AVISO: nenhuma alteração foi realizada!";
				$botao = "warning";
			}

			include_once(PATH . '/views/planejamento/auditoria/view_alerta.inc.php');
		}
		else {
			$msg = "ERRO 099: dados inconsistentes, preencha novamente o formulário!";
			$botao = "danger";

			$lista_erro_validacao = $validar->get_errors(); //Captura os erros de todos os campos
			include_once(PATH . '/views/planejamento/auditoria/view_alerta.inc.php');
		}
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
<script>
	//exibe o pedido confirmacao
	$(document).ready(function(){
		$('#modalAlertaAuditoria').modal('show');
	});
</script>