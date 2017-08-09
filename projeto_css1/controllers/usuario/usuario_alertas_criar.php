<?php
//usuario/alertas.inc.php
//envia msg de erro para o script index.php

if ($inc == "sim"){

	session_start();

	//include_once(__DIR__ .'/../componentes/internos/php/conexao.inc.php');

	if (isset($_GET['flag'])){

			$flag = $_GET['flag'];

			if($flag == md5("usuario_cadastrar")){

				$msg0 = $_SESSION['sucesso_cadastro'];

				$msg1 = $_SESSION['duplo_cpf']."<br />";
				$msg2 = $_SESSION['duplo_email']."<br />";
				$msg4 = $_SESSION['erro_cadastro']."<br />";
				$msg5 = $_SESSION['erro_validacao'];
				$lista_erro_validacao = $_SESSION['lista_erro_validacao'];

				$botao = $_SESSION['botao'];
			}
			else {
				unset($_SESSION['sucesso_cadastro']);
				unset($_SESSION['duplo_cpf']);
				unset($_SESSION['duplo_email']);
				unset($_SESSION['erro_cadastro']);
				unset($_SESSION['erro_validacao']);
				unset($_SESSION['lista_erro_validacao']);
			}

			if($flag == md5("senha_recuperar")){

				$msg0 = $_SESSION['senha_enviada'];

				$msg1 = $_SESSION['usuario_inexistente'];
				$msg2 = $_SESSION['senha_nao_enviada'];

				$botao = $_SESSION['botao'];

			}
			else {
				unset($_SESSION['senha_enviada']);
				unset($_SESSION['usuario_inexistente']);
				unset($_SESSION['senha_nao_enviada']);
				unset($_SESSION['botao']);
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
		<!--<div class="box-body">
			<div class="col-md-14">
				<div class="alert alert-<?php echo $botao; ?>">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div style="text-align:center;"><b><?php echo $msg; ?></b></div>
				</div>
			</div>
		</div>-->
		<div class="modal modal-<?php echo $botao;?> fade" id="modalAlerta"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
						<h4 class="modal-title" id="modalAlertaLabel">AVISO DO SISTEMA</h4>
					</div>
					<div class="modal-body">
						<?php
							echo $msg5.$msg1.$msg2.$msg3.$msg4;

							if($lista_erro_validacao){
								foreach ($lista_erro_validacao as $msg6){
									echo $msg6[0] = "<p>" . $msg6[0] . "</p>";
								}
							}
						?>
					</div>
					<div class="modal-footer">
						<a href="index.php"><button type="button" class="btn btn-<?php echo $botao;?>">Fechar</button></a>
					</div>
				</div>
			</div>
		</div>
    </section>
  </div>

		<?php
	}
}
else {
	?>
<div style="text-align:center;">
	<br />
	<br />
	<strong><h2>SIAUDI/EB</h2></strong>
	<br />
	<br />
	<b><u>HTTP Erro 401.1</u> - Não autorizado: acesso negado devido a credenciais inválidas.</b>
</div>
<?php
}
?>