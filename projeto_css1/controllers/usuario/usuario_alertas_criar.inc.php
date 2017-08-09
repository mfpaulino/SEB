<?php
//usuario/alertas.inc.php
//envia msg de erro para o script index.php

if ($inc == "sim"){
include_once(__DIR__ .'/../../path.inc.php');

	session_start();

	//include_once(__DIR__ .'/../componentes/internos/php/conexao.inc.php');

	if (isset($_GET['flag'])){

			$flag = $_GET['flag'];

			if($flag == md5("usuario_cadastrar")){

				$msg0 = $_SESSION['sucesso_cadastro'];

				$msg1 = $_SESSION['duplo_cpf']."<br />";
				$msg2 = $_SESSION['duplo_email']."<br />";
				$msg4 = $_SESSION['erro_cadastro']."<br />";
				$msg6 = $_SESSION['erro_validacao_cadastrar'];
				$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar'];

				$botao = $_SESSION['botao'];
			}
			else {
				unset($_SESSION['sucesso_cadastro']);
				unset($_SESSION['duplo_cpf']);
				unset($_SESSION['duplo_email']);
				unset($_SESSION['erro_cadastro']);
				unset($_SESSION['erro_validacao_cadastrar']);
				unset($_SESSION['lista_erro_validacao_cadastrar']);
			}
			if($flag == md5("usuario_alterar")){

				$msg0 = $_SESSION['alterar_rg']."<br />";
				$msg1 = $_SESSION['alterar_posto']."<br />";
				$msg2 = $_SESSION['alterar_nome_guerra']."<br />";
				$msg3 = $_SESSION['alterar_nome']."<br />";
				$msg4 = $_SESSION['alterar_email_erro']."<br />";
				$msg5 = $_SESSION['alterar_email']."<br />";
				$msg6 = $_SESSION['alterar_erro_validacao']."<br />";
				$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao'];

				$botao = $_SESSION['botao'];
				$visite = "_visite";
			}
			else {
				unset($_SESSION['alterar_rg']);
				unset($_SESSION['alterar_posto']);
				unset($_SESSION['alterar_nome_guerra']);
				unset($_SESSION['alterar_nome']);
				unset($_SESSION['alterar_email']);
				unset($_SESSION['alterar_email_erro']);
				unset($_SESSION['alterar_erro_validacao']);
				unset($_SESSION['alterar_lista_erro_validacao']);
			}

			if($flag == md5("senha_recuperar")){

				$msg0 = $_SESSION['senha_enviada'];

				$msg1 = $_SESSION['senha_usuario_inexistente']."<br />";
				$msg2 = $_SESSION['senha_nao_enviada']."<br />";

				$botao = $_SESSION['botao'];

			}
			else {
				unset($_SESSION['senha_enviada']);
				unset($_SESSION['senha_usuario_inexistente']);
				unset($_SESSION['senha_nao_enviada']);
			}

			if($flag == md5("usuario_acessar")){

				$msg1 = $_SESSION['acesso_usuario_inexistente']."<br />";
				$msg2 = $_SESSION['senha_errada']."<br />";

				$botao = $_SESSION['botao'];
			}
			else{
				unset($_SESSION['acesso_usuario_inexistente']);
				unset($_SESSION['senha_errada']);
			}

			$msg="x";

		$flag = $_GET['flag'];

		if ($flag == md5("erro_usuario")){
			$msg = "ERRO! Usuário não cadastrado";
			$botao = "danger";
		}
		elseif($flag == md5("erro_senha")){
			$msg= "ERRO! Senha incorreta";
			$botao = "danger";
		}
		elseif($flag == md5("msg_inatividade")){
			$msg = "AVISO! Encerramento por inatividade";
			$botao = "danger";
		}
		elseif($flag == md5("msg_logout")){
			$msg = "Logout realizado com sucesso";
			$botao = "success";
		}
		elseif($flag == md5("cadastro_ok")){
			$msg = "Cadastro com sucesso";
			$botao = "info";
		}
		elseif($flag == md5("cadastro_erro")){
			$msg = "Cadastro não realizado";
			$botao = "danger";
		}
		elseif($flag == md5("erro_nova_senha")){
			$msg = "Erro: senha nao enviada<br />Fale com o administrador!";
			$botao = "danger";
		}
		elseif($flag == md5("ok_nova_senha")){
			$cpf = $_GET['flag1'];
			$con_usuario = $mysqli->query("SELECT email FROM usuarios WHERE cpf = '$cpf'");
			$row_usuario = $con_usuario->fetch_assoc();

			$msg = "Aviso: nova senha enviada para: ".$row_usuario['email'];
			$botao = "success";
		}
		elseif($flag == md5("alteracao_om_sucesso")){
			$msg = "Aviso: Unidade alterada com sucesso!<br />Nova Unidade: ".$denominacao_usuario;
			$botao = "success";
		}
		elseif($flag == md5("alteracao_om_erro")){
			$msg = "ERRO: Unidade não foi alterada!<br />Permanece ".$denominacao_usuario;
			$botao = "danger";
		}
		elseif($flag == md5("msg_logout_troca_senha")){
			$msg = "Aviso: Senha alterada com sucesso!<br />Faça login com a nova senha!";
			$botao = "success";
		}
		elseif($flag == md5("alteracao_senha_erro")){
			$msg = "ERRO: Senha não foi alterada!";
			$botao = "danger";
		}
		elseif($flag == md5("alteracao_usuario_sucesso")){
			$msg = "AVISO: dados alterados com sucesso!";
			$botao = "success";
		}
		elseif($flag == md5("alteracao_usuario_erro")){
			$msg = "ERRO: nenhuma alteração foi realizada!";
			$botao = "danger";
		}
		elseif($flag == md5("exclusao_usuario_sucesso")){
			$msg = "AVISO: cadastro excluído com sucesso!";
			$botao = "danger";
		}
		elseif($flag == md5("exclusao_usuario_erro")){
			$msg = "ERRO: exclusão não realizada!";
			$botao = "danger";
		}
		?>
		<div class="modal modal-<?php echo $botao;?> fade" id="modalAlerta"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
						<h4 class="modal-title" id="modalAlertaLabel">AVISO DO SISTEMA</h4>
					</div>
					<div class="modal-body">
						<?php
							echo "<b>";
							echo $msg6.$msg0.$msg1.$msg2.$msg3.$msg4.$msg5;

							if($lista_erro_validacao){
								foreach ($lista_erro_validacao as $msg_lista){
									echo $msg_lista[0] = "<p>" . $msg_lista[0] . "</p>";
								}
							}
							echo "</b>";
						?>
					</div>
					<div class="modal-footer">
						<a href="index<?php echo $visite;?>.php"><button type="button" class="btn btn-<?php echo $botao;?>">Fechar</button></a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>