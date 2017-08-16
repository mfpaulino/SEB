<form name="form_usuario_acessar" id="form_usuario_acessar" role="form" method="POST" action="controllers/autenticacao/login.php">
	<fieldset>
		<div class="form-group">
			<span class="barra-top"><b>SIAUD-EB</b></span>
			<hr>
		</div>
		<div class="form-group has-feedback">
			<input class="form-control" type="text" name="cpf" maxlength="11" placeholder="CPF" onKeyUp="return autoTab(this, 11, event);" />
			<i class="glyphicon glyphicon-user form-control-feedback"></i>
		</div>
		<div class="form-group has-feedback">
			<input class="form-control" type="password" name="senha" placeholder="Senha" />
			<i class="glyphicon glyphicon-lock form-control-feedback"></i>
		</div>
		<div class="form-group has-feedback">
			<img width="100%" height="50px" src="componentes/internos/php/captcha.php?flag=<?php echo md5($inc);?>" alt="Código captcha">
		</div>
		<div class="form-group has-feedback">
			<input class="form-control" type="text" name="captcha" placeholder="Código exibido acima" />
			<i class="glyphicon glyphicon-hand-up form-control-feedback"></i>
		</div>
		<div class="form-group">
			<input type="hidden" name="flag" />
			<button type="submit" class="btn btn-lg btn-success btn-block">Entrar</button>
		</div>
		<div class="form-group">
			<a  style="color:#ffffff" href="#" data-toggle="modal" data-target="#esqueciModal">> <b>Esqueci minha senha</b></a>
			<br />
			<a style="color:#ffffff" href="#" data-toggle="modal" data-target="#cadastroModal">> <b>Solicitar acesso ao sistema</b></a>
			<br />
			<hr>
			<a style="color:#ffffff" href="#" target="_blank">> <b>Guia do Usuário</b></a>
		</div>
	</fieldset>
</form>