<?php
//form_usuario_cadastrar.inc.php
//if ( ! defined('PATH')){ echo "ACESSO NEGADO"; exit;}//IMPEDE QUE SEJA CHAMADO DIRETAMENTE PELA URL
?>
<div class="modal fade" data-backdrop="static" id="cadastroModal" role="dialog">
	<div class="modal-dialog" style="overflow-y: scroll; max-height:100%;  margin-top: 50px; margin-bottom:50px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Solicitação de acesso</h4>
			</div>
			<div class="modal-body">
				<form name="form_cadastra" id="form_cadastra" role="form" action="../../controllers/usuario/usuario_cadastra.php" method="POST">
					<div class="form-group">
						<label for="cpf" class="control-label">CPF: </label>
						<input class="form-control" type="text" name="cpf" id="cpf" placeholder="CPF" maxlength = "11" />
					</div>
					<div class="form-group">
						<label for="rg" class="control-label">RG: </label>
						<input class="form-control" type="text" name="rg" id="rg"  placeholder="Nr de identidade" maxlength="20" />
					</div>
					<div class="form-group">
						<label for="posto" class="control-label">Posto/Grad:</label>
						<?php include_once __DIR__ .'/../../listas/select_posto.inc.php';?>
					</div>
					<div class="form-group">
						<label for="nome" class="control-label">Nome completo: </label>
						<input class="form-control" type="text" name="nome" placeholder="nome completo" />
					</div>
					<div class="form-group">
						<label for="nome_guerra" class="control-label">Nome de guerra: </label>
						<input class="form-control" type="text" name="nome_guerra" placeholder="nome de guerra" />
					</div>
					<div class="form-group">
						<label for="email" class="control-label">E-mail: </label>
						<input class="form-control" type="email" name="email" id="email" placeholder="digite um e-mail válido" />
					</div>
					<div class="form-group">
						<label for="senha" class="control-label">Senha: </label>
						<input class="form-control" type="password" name="senha" id="senha"  maxlength = "20" placeholder="mínimo de 8 caracteres" onpaste="return false;" />
					</div>
					<div class="form-group">
						<label for="senha1" class="control-label">Confirme a senha: </label>
						<input class="form-control" type="password" name="senha1" id="senha1" maxlength = "20" placeholder="confirme a senha" onpaste="return false;" />
					</div>
					<div class="form-group">
						<label for="unidade_ci" class="control-label">Unidade Controle Interno:</label>
						<?php include __DIR__ .'/../../listas/select_unid_ci.inc.php';?>
					</div>
					<div class="form-group">
						<label for="codom" class="control-label">Unidade do usuário:</label>
						<select class="form-control" name="codom" id="codom">
							<option value="">Aguardando Unidade de Controle Interno...</option>
						</select>
					</div>
					<div class="modal-footer">
						<input  type="hidden" name="flag" />
						<button type="submit" class="btn btn-primary" onClick="return TestaCPF();">Cadastrar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="../../componentes/externos/jquery/jquery.min.js"></script>
<script>
	//script para receber a selecao da unidade de controle interno e atualizar o 2º select
	$(document).ready(function(){
		$("select[name=unidade_ci]").change(function(){
			$("select[name=codom]").html('<option value="">Carregando...</option>');
			$.post("../../listas/select_om.inc.php", {unidade_ci:$(this).val()},function(valor){$("select[name=codom]").html(valor);})
		 })
	 })
</script>