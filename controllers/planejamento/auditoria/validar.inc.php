<?php
/**************************************************************
* Local/nome do script: controllers/planejamento/auditoria/validar.inc.php
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

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	//require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

		/** usadas em ambas as operações **/
		$user_cad = $_SESSION['cpf'];
		$data_cad = date('Y-m-d H:i:s');

		/* vem de ambos os forms */
		$ano 		   = isset($_POST['ano'])  ? $_POST['ano'] : "";
		$natureza 	   = isset($_POST['natureza']) ? $_POST['natureza'] : "";
		$tipo 	   	   = isset($_POST['tipo_evento']) ? $_POST['tipo_evento'] : "";
		$nup 		   = isset($_POST['nup']) ? $_POST['nup'] : "";
		$unidade 	   = isset($_POST['unidade']) ? $_POST['unidade'] : "";
		$equipe 	   = isset($_POST['auditor']) ? $_POST['auditor'] : "";
		$chefe 	   	   = isset($_POST['ch_equipe']) ? $_POST['ch_equipe'] : "";
		$periodo 	   = isset($_POST['periodo']) ? $_POST['periodo'] : "";
		/***/

		$tipo = explode("|",$tipo);
		$tipo = $tipo[1];

		$inicio = converter_data(substr($periodo, 0, 11),'EN');
		$fim = converter_data(substr($periodo, -10), 'EN');

		for($i=0; $i < count($unidade); $i++){
			$lst_unidade = $lst_unidade . $unidade[$i] . ","; //cria uma string com os codom separados por ",".
		}
		$lst_unidade = substr($lst_unidade, 0, -1); //elimino a ultima "," da string.

		for($i=0; $i < count($equipe); $i++){
			$lst_equipe = $lst_equipe . $equipe[$i] . ","; //cria uma string com os id_usuarios separados por ",".
		}

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
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>